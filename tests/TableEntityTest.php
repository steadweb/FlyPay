<?php

namespace Steadweb\Flypay\Tests;

use Steadweb\Flypay\Entities\Table;

class TableEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Table
     */
    private $table;

    public function setUp()
    {
        $table = new Table();

        $this->id = uniqid();

        $table->setId($this->id);
        $table->setSeats(4);

        $this->table = $table;
    }

    public function testSetAndGetValues()
    {
        $this->assertSame($this->id, $this->table->getId());
        $this->assertSame(4, $this->table->getSeats());
    }

    public function testJsonSerializeReturnsCorrectValues()
    {
        $arr = [
            'id' => $this->table->getId(),
            'seats' => 4
        ];

        $this->assertSame($arr, $this->table->jsonSerialize());
    }
}
