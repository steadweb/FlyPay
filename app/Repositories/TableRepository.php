<?php

namespace Steadweb\Flypay\Repositories;

use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Entities\Table;

final class TableRepository extends AbstractRepository
{
    /**
     * Create a table.
     *
     * @param array $details
     */
    public function create(array $details)
    {
        $table = new $this->entity;
        $table->setSeats(intval($details['seats']));

        $this->entityManager->persist($table);
        $this->entityManager->flush();
    }
}
