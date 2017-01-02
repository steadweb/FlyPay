<?php declare(strict_types=1);

namespace Steadweb\Flypay\Actions;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Repositories\LocationRepository;
use Psr\Log\LoggerInterface;

final class LocationAction
{
    /**
     * @var LocationRepository
     */
    private $locationRepository;

    /**
     * LocationAction constructor.
     *
     * @param LocationRepository $locationRepository
     */
    public function __construct(
        LocationRepository $locationRepository,
        LoggerInterface $logger
    )
    {
        $this->locationRepository = $locationRepository;
        $this->logger = $logger;
    }

    /**
     * Get all the locations.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     */
    public function all(Request $request, Response $response)
    {
        return $response->withJson($this->locationRepository->all());
    }

    /**
     * Create a Location.
     *
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function create(Request $request, Response $response)
    {
        try {
            $details = $request->getParsedBody();
            $this->locationRepository->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to create location.');
        }

        return $response->withStatus(201, 'Location created.');
    }
}
