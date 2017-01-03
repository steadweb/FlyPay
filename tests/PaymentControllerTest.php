<?php

namespace Steadweb\Flypay\Tests;

use Steadweb\Flypay\Controllers\PaymentController;

class PaymentControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetPaymentDetails()
    {
        $card = [
            'id' => uniqid(),
            'last4' => '7890',
            'type' => 'VISA'
        ];

        $table = [
            'id' => uniqid(),
            'seats' => 4,
        ];

        $location = [
            'id' => uniqid(),
            'title' => 'Foo',
            'address' => 'Bar',
            'latitude' => '1234567890',
            'longitude' => '0987654321',
        ];

        $data = [[
            'id' => uniqid(),
            'amount' => 12000,
            'gratuity' => 10000,
            'reference' => 'uygfuyg1uygsduyfguffdgjihga',
            'card' => $card,
            'tables' => [$table],
            'location' => $location,
            'created' => new \DateTime(),
            'updated' => null
        ]];

        $expected = json_encode($data);

        $paymentRepository = \Mockery::mock('Steadweb\Flypay\Repositories\PaymentRepository')
            ->makePartial()
            ->shouldReceive('all')
            ->andReturn($data)
            ->getMock();

        $logger = \Mockery::mock('Psr\Log\LoggerInterface')->makePartial();

        $controller = new PaymentController($paymentRepository, $logger);

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