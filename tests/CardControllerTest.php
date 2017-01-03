<?php

namespace Steadweb\Flypay\Tests;

use Steadweb\Flypay\Controllers\CardController;

class CardControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCardDetails()
    {
        $data = [[
            'id' => uniqid(),
            'last4' => '7890',
            'type' => 'VISA',
            'created' => new \DateTime(),
            'updated '=> null
        ]];

        $expected = json_encode($data);

        $cardRepository = \Mockery::mock('Steadweb\Flypay\Repositories\CardRepository')
            ->makePartial()
            ->shouldReceive('all')
            ->andReturn($data)
            ->getMock();

        $logger = \Mockery::mock('Psr\Log\LoggerInterface')->makePartial();

        $controller = new CardController($cardRepository, $logger);

        $environment = \Slim\Http\Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => '/api/v1/payments',
            'QUERY_STRING'=> ''
        ]);

        $request = \Slim\Http\Request::createFromEnvironment($environment);
        $response = new \Slim\Http\Response();

        $response = $controller->all($request, $response);
        $this->assertSame((string)$response->getBody(), $expected);
    }
}
