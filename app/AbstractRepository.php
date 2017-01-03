<?php declare(strict_types=1);

namespace Steadweb\Flypay;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class AbstractRepository extends EntityRepository
{
    /**
     * Return all entities.
     *
     * @return array
     */
    public function all()
    {
        $entities = $this->findAll();
        $entities = array_map(
            function (AbstractEntity $entity) {
                return $entity->getArrayCopy();
            },
            $entities
        );

        return $entities;
    }
}
