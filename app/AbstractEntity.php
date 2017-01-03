<?php declare(strict_types=1);

namespace Steadweb\Flypay;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Steadweb\Flypay\Traits\Dates;
use Steadweb\Flypay\Traits\PrePersist;
use Steadweb\Flypay\Traits\PreUpdate;

/**
 * Class AbstractEntity
 *
 * @ORM\HasLifecycleCallbacks
 */
abstract class AbstractEntity implements JsonSerializable
{
    use Dates, PrePersist, PreUpdate;

    /**
     * Get array copy of object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        $data = get_object_vars($this);

        foreach($data as $key => $property) {
            if(is_object($property) && method_exists($property, 'toArray')) {
                $data[$key] = $property->toArray();
            }
        }

        return $data;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [];
    }
}
