<?php declare(strict_types=1);

namespace Steadweb\Flypay\Repositories;

use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Entities\Table;

class TableRepository extends AbstractRepository
{
    /**
     * Create a table.
     *
     * @param array $details
     *
     * @return Table
     */
    public function create(array $details): Table
    {
        $table = new Table;
        $em = $this->getEntityManager();

        $table->setSeats(intval($details['seats']));

        $em->persist($table);
        $em->flush();

        return $table;
    }
}
