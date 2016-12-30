<?php declare(strict_types=1);

namespace Steadweb\Flypay\Entities;

use Doctrine\ORM\Mapping as ORM;
use Steadweb\Flypay\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="flypay__tables")
 * @ORM\HasLifecycleCallbacks
 */
final class Table extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    /**
     * Get the payment id.
     *
     * @ORM\return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the table id.
     *
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Get the UUID.
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Set the UUID.
     *
     * @param string $uuid
     *
     * @return string
     */
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * Get the amount of seats the table holds.
     *
     * @return int
     */
    public function getSeats(): int
    {
        return $this->seats;
    }

    /**
     * Set the number of seats the table holds.
     *
     * @param int $seats
     */
    public function setSeats(int $seats)
    {
        $this->seats = $seats;
    }
}