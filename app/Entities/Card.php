<?php declare(strict_types=1);

namespace Steadweb\Flypay\Entities;

use Doctrine\ORM\Mapping as ORM;
use Steadweb\Flypay\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="flypay__cards")
 * @ORM\HasLifecycleCallbacks
 */
final class Card extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(name="last4", type="string")
     */
    private $last4;

    /**
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    const CARD_TYPE_VISA = 'VISA';
    const CARD_TYPE_MAESTRO = 'MAESTRO';
    const CARD_TYPE_MASTERCARD = 'MASTERCARD';
    const CARD_TYPE_AMEX = 'AMEX';

    /**
     * Get the payment id.
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the card id.
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
     * Get the last 4 digits of the card.
     *
     * @return string
     */
    public function getLast4(): string
    {
        return $this->last4;
    }

    /**
     * Set the last 4 digits.
     *
     * @param string $last4
     */
    public function setLast4(string $last4)
    {
        $this->last4 = $last4;
    }

    /**
     * Get the card type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set the card type.
     *
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}