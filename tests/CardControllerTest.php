<?php

namespace Steadweb\Flypay\Tests;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\AbstractEntity;
use Steadweb\Flypay\Controllers\CardController;
use Steadweb\Flypay\Entities\Card;
use Steadweb\Flypay\Repositories\CardRepository;

class CardControllerTest extends AbstractControllerTestCase
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

        $repo = $this->mockRepository(CardRepository::class, 'all', $data);

        $controller = new CardController($repo, $this->mockLogger());
        $request = Request::createFromEnvironment($this->mockEnvironment('GET', '/api/v1/cards'));

        $response = $controller->all($request, $this->mockResponse());
        $this->assertSame((string)$response->getBody(), $expected);
    }

    public function testPostCardDetailsAndReturnId()
    {
        $card = $this->mockEntity();
        $data = [
            'last4' => '1234',
            'type' => 'VISA'
        ];

        $response = $this->runMockedSlimApp($data, $card);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame((string)$response->getBody(), '{"id":"'.$card->getId().'"}');
    }

    /**
     * Run the mocked slim app with Card specific details.
     *
     * @param array $data
     * @param AbstractEntity $abstractEntity
     *
     * @return \Slim\Http\Response
     */
    protected function runMockedSlimApp(array $data, AbstractEntity $abstractEntity): Response
    {
        $repo = $this->mockRepository(CardRepository::class, 'create', $abstractEntity);
        $response = $this->buildSlimAppAndReturnResponse(
            CardController::class,
            'create',
            CardRepository::class,
            $data,
            $repo,
            ['last4', 'type']
        );

        return $response;
    }

    /**
     * Create a Card object.
     *
     * @return AbstractEntity
     */
    protected function mockEntity(): AbstractEntity
    {
        $id = uniqid();
        $card = new Card();
        $card->setId($id);

        return $card;
    }
}