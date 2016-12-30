<?php declare(strict_types=1);

namespace Steadweb\Flypay\Entities;

use Doctrine\ORM\Mapping as ORM;
use Steadweb\Flypay\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="flypay__cards")
 * @ORM\HasLifecycleCallbacks
 */
class Card extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(name="last4", type="string")
     */
    protected $last4;

    /**
     * @ORM\Column(name="type", type="string")
     */
    protected $type;

    const CARD_TYPE_VISA = 'VISA';
    const CARD_TYPE_MAESTRO = 'MAESTRO';
    const CARD_TYPE_MASTERCARD = 'MASTERCARD';
    const CARD_TYPE_AMEX = 'AMEX';

    /**
     * Get the payment id.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the card id.
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'last4' => $this->getLast4(),
            'type' => $this->getType()
        ];
    }
}
