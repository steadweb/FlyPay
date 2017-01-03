<?php

namespace Steadweb\Flypay\Tests;

use Steadweb\Flypay\Controllers\TableController;

class TableControllerTest extends \PHPUnit_Framework_TestCase
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

        $tableRepository = \Mockery::mock('Steadweb\Flypay\Repositories\TableRepository')
            ->makePartial()
            ->shouldReceive('all')
            ->andReturn($data)
            ->getMock();

        $logger = \Mockery::mock('Psr\Log\LoggerInterface')->makePartial();

        $controller = new TableController($tableRepository, $logger);

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