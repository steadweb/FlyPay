<?php declare(strict_types=1);

namespace Steadweb\Flypay\Actions;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Resources\LocationResource;
use Psr\Log\LoggerInterface;

final class LocationAction
{
    /**
     * @var LocationResource
     */
    private $locationResource;

    /**
     * LocationAction constructor.
     *
     * @param LocationResource $locationResource
     */
    public function __construct(
        LocationResource $locationResource,
        LoggerInterface $logger
    )
    {
        $this->locationResource = $locationResource;
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
        return $response->withJson($this->locationResource->all());
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
            $this->locationResource->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to create location.');
        }

        return $response->withStatus(201, 'Location created.');
    }
}
