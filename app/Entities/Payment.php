<?php declare(strict_types=1);

namespace Steadweb\Flypay\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\ManyToMany as ManyToMany;
use Doctrine\ORM\Mapping\JoinTable as JoinTable;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;
use Steadweb\Flypay\AbstractEntity;
use Steadweb\Flypay\Entities\Card;
use Steadweb\Flypay\Entities\Location;
use Steadweb\Flypay\Entities\Table;

/**
 * @ORM\Entity(repositoryClass="Steadweb\Flypay\Repositories\PaymentRepository")
 * @ORM\Table(name="flypay__payments")
 * @ORM\HasLifecycleCallbacks
 */
class Payment extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(name="amount", type="integer")
     *
     * @var int
     */
    protected $amount;

    /**
     * @ORM\Column(name="gratuity", type="integer", nullable=true)
     *
     * @var int
     */
    protected $gratuity;

    /**
     * @ORM\Column(name="reference", type="string")
     *
     * @var string
     */
    protected $reference;

    /**
     * Each Payment has an associated Card.
     *
     * @ManyToOne(targetEntity="Steadweb\Flypay\Entities\Card")
     * @JoinColumn(name="card_id", referencedColumnName="id", nullable=false)
     *
     * @var Card
     */
    protected $card;

    /**
     * Each Payment has an associated Table.
     *
     * @ManyToMany(targetEntity="Steadweb\Flypay\Entities\Table")
     * @JoinTable(name="flypay__payments_tables",
     *      joinColumns={@JoinColumn(name="payment_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="table_id", referencedColumnName="id")}
     * )
     *
     * @var ArrayCollection
     */
    protected $tables;

    /**
     * Each Payment has an associated Location.
     *
     * @ManyToOne(targetEntity="Steadweb\Flypay\Entities\Location")
     * @JoinColumn(name="location_id", referencedColumnName="id", nullable=false)
     *
     * @var Location
     */
    protected $location;

    /**
     * Payment constructor.
     */
    public function __construct()
    {
        $this->tables = new ArrayCollection();
    }

    /**
     * Get the card relation.
     *
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * Set the card relation.
     *
     * @return void
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Get the ArrayCollcation[Table] relations.
     *
     * @return ArrayCollection
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * Get the location relation.
     *
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the location relation.
     *
     * @return void
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
    }

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
     * Set the payment id.
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
     * Set the amount.
     *
     * @param int $amount
     *
     * @return string
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get the amount in pennies.
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Set the gratuity.
     *
     * @param int $gratuity
     *
     * @return string
     */
    public function setGratuity(int $gratuity)
    {
        $this->gratuity = $gratuity;
    }

    /**
     * Get the gratuity in pennies.
     *
     * @return int
     */
    public function getGratuity(): int
    {
        return $this->gratuity;
    }

    /**
     * Set the reference.
     *
     * @param string $reference
     *
     * @return string
     */
    public function setReference(string $reference)
    {
        $this->reference = $reference;
    }

    /**
     * Get the gratuity in pennies.
     *
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }
}
