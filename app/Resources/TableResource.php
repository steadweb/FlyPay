<?php

namespace Steadweb\Flypay\Resources;

use Steadweb\Flypay\AbstractResource;
use Steadweb\Flypay\Entities\Table;

final class TableResource extends AbstractResource
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
