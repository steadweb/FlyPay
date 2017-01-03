<?php

namespace Steadweb\Flypay\Tests;

use Steadweb\Flypay\Controllers\LocationController;

class LocationControllerTest extends \PHPUnit_Framework_TestCase
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

        $locationRepository = \Mockery::mock('Steadweb\Flypay\Repositories\LocationRepository')
            ->makePartial()
            ->shouldReceive('all')
            ->andReturn($data)
            ->getMock();

        $logger = \Mockery::mock('Psr\Log\LoggerInterface')->makePartial();

        $controller = new LocationController($locationRepository, $logger);

        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/api/v1/locations',
            'QUERY_STRING'=> ''
        ]);

        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $response = new \Slim\Http\Response();

        $response = $controller->all($request, $response);
        $this->assertSame((string)$response->getBody(), $expected);
    }
}