<?php declare(strict_types=1);

namespace Steadweb\Flypay\Traits;

use DateTime;

trait Dates
{
    /**
     * @ORM\Column(name="created", type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    protected $updated;

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return new DateTime($this->created);
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * @return DateTime
     */
    public function getUpdated(): DateTime
    {
        return new DateTime($this->updated);
    }

    /**
     * @param DateTime $updated
     */
    public function setUpdated(DateTime $updated)
    {
        $this->updated = $updated;
    }
}