<?php declare(strict_types=1);

namespace Steadweb\Flypay\Actions;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Repositories\ClientRepository;
use Psr\Log\LoggerInterface;

final class ClientAction
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
     * ClientAction constructor.
     *
     * @param ClientRepository $clientRepository
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
            $this->clientRepository->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to register public key.');
        }

        return $response->withStatus(201, 'Public key registered.');
    }
}
