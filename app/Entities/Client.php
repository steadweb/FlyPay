<?php declare(strict_types=1);

namespace Steadweb\Flypay\Entities;

use Doctrine\ORM\Mapping as ORM;
use Steadweb\Flypay\AbstractEntity;

/**
 * @ORM\Entity(repositoryClass="Steadweb\Flypay\Repositories\ClientRepository")
 * @ORM\Table(name="flypay__clients")
 * @ORM\HasLifecycleCallbacks
 */
class Client extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(name="domain", type="string")
     */
    protected $domain;

    /**
     * @ORM\Column(name="public_key", type="text")
     */
    protected $public_key;

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
     * Get the domain.
     *
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Set the domain.
     *
     * @param string $domain
     */
    public function setDomain(string $domain)
    {
        $this->domain = $domain;
    }

    /**
     * Get the decoded public key.
     *
     * @return string
     */
    public function getPublicKey(): string
    {
        return base64_decode($this->public_key);
    }

    /**
     * Get the encoded public key.
     *
     * @return string
     */
    public function getEncodedPublicKey(): string
    {
        return $this->public_key;
    }

    /**
     * Set the public key.
     *
     * @param string $public_key
     */
    public function setPublicKey(string $public_key)
    {
        $this->public_key = $public_key;
    }
}
