<?php declare(strict_types=1);

namespace Steadweb\Flypay\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Repositories\CardRepository;
use Psr\Log\LoggerInterface;

final class CardController
{
    /**
     * @var CardRepository
     */
    private $cardRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * CardController constructor.
     *
     * @param CardRepository $cardRepository
     */
    public function __construct(
        CardRepository $cardRepository,
        LoggerInterface $logger
    )
    {
        $this->cardRepository = $cardRepository;
        $this->logger = $logger;
    }

    /**
     * Get all the cards.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     */
    public function all(Request $request, Response $response)
    {
        return $response->withJson($this->cardRepository->all());
    }

    /**
     * Create a card.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function create(Request $request, Response $response)
    {
        try {
            $details = $request->getParsedBody();
            $this->cardRepository->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to create card.');
        }

        return $response->withStatus(201, 'Card created.');
    }
}
