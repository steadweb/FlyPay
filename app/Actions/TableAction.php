<?php declare(strict_types=1);

namespace Steadweb\Flypay\Actions;

use Slim\Http\Request;
use Slim\Http\Response;
use Steadweb\Flypay\Repositories\TableRepository;
use Psr\Log\LoggerInterface;

final class TableAction
{
    /**
     *@var TableRepository
     */
    private $tableRepository;

    /**
     * TableAction constructor.
     *
     * @param TableRepository $tableRepository
     */
    public function __construct(
        TableRepository $tableRepository,
        LoggerInterface $logger
    )
    {
        $this->tableRepository = $tableRepository;
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
        return $response->withJson($this->tableRepository->all());
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
            $this->tableRepository->create($details);
        } catch(\Exception $e) {
            $this->logger->error($e->getMessage());
            return $response->withStatus(400, 'Unable to create table.');
        }

        return $response->withStatus(201, 'Table created.');
    }
}
