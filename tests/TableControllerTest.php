<?php

namespace Steadweb\Flypay\Tests;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\AbstractEntity;
use Steadweb\Flypay\Controllers\TableController;
use Steadweb\Flypay\Entities\Table;
use Steadweb\Flypay\Repositories\TableRepository;

class TableControllerTest extends AbstractControllerTestCase
{
    public function testGetTableDetails()
    {
        $data = [[
            'id' => uniqid(),
            'seats' => 4,
            'created' => new \DateTime(),
            'updated' => null
        ]];

        $expected = json_encode($data);

        $repo = $this->mockRepository(TableRepository::class, 'all', $data);

        $controller = new TableController($repo, $this->mockLogger());
        $request = Request::createFromEnvironment($this->mockEnvironment('GET', '/api/v1/tables'));

        $response = $controller->all($request, $this->mockResponse());
        $this->assertSame((string)$response->getBody(), $expected);
    }

    public function testPostTableDetailsAndReturnId()
    {
        $table = $this->mockEntity();
        $data = [
            'seats' => 4,
        ];

        $response = $this->runMockedSlimApp($data, $table);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame((string)$response->getBody(), '{"id":"'.$table->getId().'"}');
    }

    public function testPostTableDetailsWithInvalidInput()
    {
        $data = [];

        $response = $this->runMockedSlimApp($data, $this->mockEntity());

        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame((string)$response->getBody(), '{"message":"This request is missing the following data","param":["seats"]}');
    }

    /**
     * {@inheritdoc}
     */
    protected function mockEntity(): AbstractEntity
    {
        $id = uniqid();
        $table = new Table();
        $table->setId($id);

        return $table;
    }

    /**
     * {@inheritdoc}
     */
    protected function runMockedSlimApp(array $data, AbstractEntity $abstractEntity): Response
    {
        $repo = $this->mockRepository(TableRepository::class, 'create', $abstractEntity);
        $response = $this->buildSlimAppAndReturnResponse(
            TableController::class,
            'create',
            TableRepository::class,
            $data,
            $repo,
            ['seats']
        );

        return $response;
    }
}