<?php

namespace Steadweb\Flypay\Tests;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\AbstractEntity;
use Steadweb\Flypay\Controllers\LocationController;
use Steadweb\Flypay\Entities\Location;
use Steadweb\Flypay\Repositories\LocationRepository;

class LocationControllerTest extends AbstractControllerTestCase
{
    public function testGetLocationDetails()
    {
        $data = [[
            'id' => uniqid(),
            'title' => 'Foo',
            'address' => 'Bar',
            'latitude' => '1234567890',
            'longitude' => '0987654321',
            'created' => new \DateTime(),
            'updated' => null
        ]];

        $expected = json_encode($data);

        $repo = $this->mockRepository(LocationRepository::class, 'all', $data);

        $controller = new LocationController($repo, $this->mockLogger());
        $request = Request::createFromEnvironment($this->mockEnvironment('GET', '/api/v1/locations'));

        $response = $controller->all($request, $this->mockResponse());
        $this->assertSame((string)$response->getBody(), $expected);
    }

    public function testPostLocationDetailsAndReturnId()
    {
        $location = $this->mockEntity();
        $data = [
            'title' => 'Foo',
            'address' => 'Bar',
            'latitude' => '12345',
            'longitude' => '67890'
        ];

        $response = $this->runMockedSlimApp($data, $location);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame((string)$response->getBody(), '{"id":"'.$location->getId().'"}');
    }

    public function testPostLocationDetailsWithInvalidInput()
    {
        $data = [
            'address' => 'Bar',
            'latitude' => '12345',
            'longitude' => '67890'
        ];

        $response = $this->runMockedSlimApp($data, $this->mockEntity());

        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame((string)$response->getBody(), '{"message":"This request is missing the following data","param":["title"]}');
    }

    /**
     * Run the mocked slim app with Location specific details.
     *
     * @param array $data
     * @param AbstractEntity $entity
     *
     * @return \Slim\Http\Response
     */
    protected function runMockedSlimApp(array $data, AbstractEntity $entity): Response
    {
        $repo = $this->mockRepository(LocationRepository::class, 'create', $entity);
        $response = $this->buildSlimAppAndReturnResponse(
            LocationController::class,
            'create',
            LocationRepository::class,
            $data,
            $repo,
            ['title']
        );

        return $response;
    }

    /**
     * Create a Location object.
     *
     * @return AbstractEntity
     */
    protected function mockEntity(): AbstractEntity
    {
        $id = uniqid();
        $location = new Location();
        $location->setId($id);

        return $location;
    }
}