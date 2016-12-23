<?php declare(strict_types=1);

namespace Steadweb\Flypay;

use Doctrine\ORM\Mapping as ORM;
use Steadweb\Flypay\Traits\Dates;
use Steadweb\Flypay\Traits\PrePersist;
use Steadweb\Flypay\Traits\PreUpdate;

/**
 * Class AbstractEntity
 *
 * @ORM\HasLifecycleCallbacks
 */
abstract class AbstractEntity
{
    use Dates, PrePersist, PreUpdate;
}