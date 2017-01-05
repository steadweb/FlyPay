<?php

namespace Steadweb\Flypay\Fixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Steadweb\Flypay\Entities\Table;

class TableFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $table = new Table();

        $table->setSeats(4);

        $manager->persist($table);
        $manager->flush();

        $this->addReference('table', $table);
    }
}
