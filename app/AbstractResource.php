<?php declare(strict_types=1);

namespace Steadweb\Flypay;

use Doctrine\ORM\EntityManager;

abstract class AbstractResource
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager = null;

    /**
     * @var AbstractEntity
     */
    protected $entity = null;

    /**
     * AbstractResource constructor.
     *
     * @param EntityManager $entityManager
     * @param AbstractEntity $entity
     */
    public function __construct(
        EntityManager $entityManager,
        AbstractEntity $entity
    )
    {
        $this->entityManager = $entityManager;
        $this->entity = $entity;
    }

    /**
     * Return all entities.
     *
     * @return array
     */
    public function all()
    {
        $entities = $this->entityManager->getRepository(get_class($this->entity))->findAll();
        $entities = array_map(
            function ($entity) {
                return $entity->getArrayCopy();
            },
            $entities
        );

        return $entities;
    }
}
