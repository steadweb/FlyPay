<?php

namespace Steadweb\Flypay\Tests;

use Steadweb\Flypay\Entities\Client;

class ClientEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $client = new Client();

        $this->id = uniqid();

        $client->setId($this->id);
        $client->setDomain('https://steadweb.flypay.com');
        $client->setPublicKey(base64_encode('foo.bar.baz'));

        $this->client = $client;
    }

    public function testSetAndGetValues()
    {
        $this->assertSame($this->id, $this->client->getId());
        $this->assertSame('https://steadweb.flypay.com', $this->client->getDomain());
        $this->assertSame('foo.bar.baz', $this->client->getPublicKey());
        $this->assertSame(json_encode('foo.bar.baz'), $this->client->getEncodedPublicKey());
    }
}
