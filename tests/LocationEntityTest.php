<?php

namespace Steadweb\Flypay\Tests;

use Steadweb\Flypay\Entities\Location;

class LocationEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Location
     */
    private $location;

    public function setUp()
    {
        $location = new Location();

        $this->id = uniqid();

        $location->setId($this->id);
        $location->setTitle('Foo');
        $location->setAddress('Bar');
        $location->setLatitude('123');
        $location->setLongitude('456');

        $this->location = $location;
    }

    public function testSetAndGetValues()
    {
        $this->assertSame($this->id, $this->location->getId());
        $this->assertSame('Foo', $this->location->getTitle());
        $this->assertSame('Bar', $this->location->getAddress());
        $this->assertSame('123', $this->location->getLatitude());
        $this->assertSame('456', $this->location->getLongitude());
    }

    public function testJsonSerializeReturnsCorrectValues()
    {
        $arr = [
            'id' => $this->location->getId(),
            'title' => 'Foo',
            'address' => 'Bar',
            'latitude' => '123',
            'longitude' => '456'
        ];

        $this->assertSame($arr, $this->location->jsonSerialize());
    }
}
