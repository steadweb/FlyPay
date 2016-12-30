<?php declare(strict_types=1);

namespace Steadweb\Flypay\Actions;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Resources\TableResource;
use Psr\Log\LoggerInterface;

final class TableAction
{
    /**
     *@var TableResource
     */
    private $tableResource;

    /**
     * TableAction constructor.
     *
     * @param TableResource $tableResource
     */
    public function __construct(
        TableResource $tableResource,
        LoggerInterface $logger
    )
    {
        $this->tableResource = $tableResource;
        $this->logger = $logger;
    }

    /**
     * Get all the tables.
     *
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     */
    public function all(Request $request, Response $response)
    {
        return $response->withJson($this->tableResource->all());
    }

    /**
     * Create a table.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function create(Request $request, Response $response)
    {
        try {
            $details = $request->getParsedBody();
            $this->tableResource->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to create table.');
        }

        return $response->withStatus(201, 'Table created.');
    }
}
