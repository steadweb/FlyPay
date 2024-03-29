<?php declare(strict_types=1);

namespace Steadweb\Flypay\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Repositories\ClientRepository;
use Psr\Log\LoggerInterface;

final class ClientController
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ClientController constructor.
     *
     * @param ClientRepository $clientRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ClientRepository $clientRepository,
        LoggerInterface $logger
    )
    {
        $this->clientRepository = $clientRepository;
        $this->logger = $logger;
    }

    /**
     * Registers a public key.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function register(Request $request, Response $response)
    {
        try {
            $details = $request->getParsedBody();
            $client = $this->clientRepository->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to register public key.');
        }

        return $response->withStatus(201, 'Public key registered.')->withJson([
            'id' => $client->getId()
        ]);
    }
}
