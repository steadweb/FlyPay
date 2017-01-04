<?php

namespace Steadweb\Flypay\Tests;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\AbstractEntity;
use Steadweb\Flypay\Controllers\PaymentController;
use Steadweb\Flypay\Entities\Payment;
use Steadweb\Flypay\Repositories\PaymentRepository;

class PaymentControllerTest extends AbstractControllerTestCase
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

        $repo = $this->mockRepository(PaymentRepository::class, 'all', $data);

        $controller = new PaymentController($repo, $this->mockLogger());
        $request = Request::createFromEnvironment($this->mockEnvironment('GET', '/api/v1/payments'));

        $response = $controller->all($request, $this->mockResponse());
        $this->assertSame((string)$response->getBody(), $expected);
    }

    public function testPostPaymentDetailsAndReturnId()
    {
        $card = $this->mockEntity();
        $data = [
            'amount' => 10000,
            'card' => uniqid(),
            'location' => uniqid(),
            'table' => uniqid()
        ];

        $response = $this->runMockedSlimApp($data, $card);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame((string)$response->getBody(), '{"id":"'.$card->getId().'"}');
    }

    public function testPostPaymentDetailsWithInvalidInput()
    {
        $data = [
            'card' => uniqid(),
            'location' => uniqid(),
            'table' => uniqid()
        ];

        $response = $this->runMockedSlimApp($data, $this->mockEntity());

        $this->assertSame(400, $response->getStatusCode());
        $this->assertSame((string)$response->getBody(), '{"message":"This request is missing the following data","param":["amount"]}');
    }

    /**
     * {@inheritdoc}
     */
    protected function mockEntity(): AbstractEntity
    {
        $id = uniqid();
        $payment = new Payment();
        $payment->setId($id);

        return $payment;
    }

    /**
     * {@inheritdoc}
     */
    protected function runMockedSlimApp(array $data, AbstractEntity $abstractEntity): Response
    {
        $repo = $this->mockRepository(PaymentRepository::class, 'create', $abstractEntity);
        $response = $this->buildSlimAppAndReturnResponse(
            PaymentController::class,
            'create',
            PaymentRepository::class,
            $data,
            $repo,
            ['amount', 'card', 'location', 'table']
        );

        return $response;
    }
}