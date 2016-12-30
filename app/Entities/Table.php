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
    protected $id;

    /**
     * @ORM\Column(name="seats", type="integer")
     */
    protected $seats;

    /**
     * Get the table id.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the table id.
     *
     * @param string $id
     *
     * @return void
     */
    public function setId(string $id)
    {
        $this->id = $id;
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
