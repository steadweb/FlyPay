<?php declare(strict_types=1);

namespace Steadweb\Flypay\Entities;

use Doctrine\ORM\Mapping as ORM;
use Steadweb\Flypay\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Steadweb\Flypay\Repositories\LocationRepository")
 * @ORM\Table(name="flypay__locations")
 * @ORM\HasLifecycleCallbacks
 */
class Location extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string")
     */
    protected $title;

    /**
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(name="latitude", type="string", nullable=true)
     */
    protected $latitude;

    /**
     * @ORM\Column(name="longitude", type="string", nullable=true)
     */
    protected $longitude;

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
     * Set the location id.
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
     * Set the title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return (string) $this->title;
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
        return (string) $this->address;
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
        return (string) $this->latitude;
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
        return (string) $this->longitude;
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'address' => $this->getAddress(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude()
        ];
    }
}
