<?php declare(strict_types=1);

namespace Steadweb\Flypay\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait PrePersist
{
    /**
     * Gets triggered only on insert
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->setCreated(new DateTime('now'));
    }
}