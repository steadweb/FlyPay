<?php declare(strict_types=1);

namespace Steadweb\Flypay\Entities;

use Doctrine\ORM\Mapping as ORM;
use Steadweb\Flypay\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="flypay__locations")
 */
final class Location extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(name="latitude", type="string", nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(name="longitude", type="string", nullable=true)
     */
    private $longitude;

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
     * Set the location id.
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
     * Set the title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the title.
     *
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get the address.
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Set the address.
     *
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * Get the latitude.
     *
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * Set the latitude.
     *
     * @param string $latitude
     */
    public function setLatitude(string $latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Get the longitude.
     *
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * Set the longitude.
     *
     * @param string $longitude
     */
    public function setLongitude(string $longitude)
    {
        $this->longitude = $longitude;
    }
}