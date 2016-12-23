<?php

namespace Steadweb\Flypay\Traits;

use DateTime;

trait PreUpdate
{
    /**
     * Gets triggered every time on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->setCreated(new DateTime('now'));
    }
}