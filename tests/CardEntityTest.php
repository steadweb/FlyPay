<?php

namespace Steadweb\Flypay\Tests;

use Steadweb\Flypay\Entities\Card;

class CardEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Card
     */
    private $card;

    public function setUp()
    {
        $card = new Card();

        $this->id = uniqid();

        $card->setId($this->id);
        $card->setLast4('1234');
        $card->setType('VISA');

        $this->card = $card;
    }

    public function testSetAndGetValues()
    {
        $this->assertSame($this->id, $this->card->getId());
        $this->assertSame('1234', $this->card->getLast4());
        $this->assertSame('VISA', $this->card->getType());
    }

    public function testJsonSerializeReturnsCorrectValues()
    {
        $arr = [
            'id' => $this->card->getId(),
            'last4' => '1234',
            'type' => 'VISA'
        ];

        $this->assertSame($arr, $this->card->jsonSerialize());
    }

    public function testSetPrePersist()
    {
        $this->card->onPrePersist();
        $this->assertInstanceOf('\DateTime', $this->card->getCreated());
    }

    public function testSetPreUpdate()
    {
        $this->card->onPreUpdate();
        $this->assertInstanceOf('\DateTime', $this->card->getUpdated());
    }
}
