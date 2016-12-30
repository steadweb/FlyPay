<?php declare(strict_types=1);

namespace Steadweb\Flypay\Actions;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Resources\CardResource;
use Psr\Log\LoggerInterface;

final class CardAction
{
    /**
     * @var CardResource
     */
    private $cardResource;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * CardAction constructor.
     *
     * @param CardResource $cardResource
     */
    public function __construct(
        CardResource $cardResource,
        LoggerInterface $logger
    )
    {
        $this->cardResource = $cardResource;
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
        return $response->withJson($this->cardResource->all());
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
            $this->cardResource->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to create card.');
        }

        return $response->withStatus(201, 'Card created.');
    }
}
