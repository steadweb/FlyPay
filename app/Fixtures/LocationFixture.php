<?php

namespace Steadweb\Flypay\Fixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Steadweb\Flypay\Entities\Location;

class LocationFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $location = new Location();

        $location->setTitle("Foo");
        $location->setAddress("Bar");
        $location->setLatitude("123");
        $location->setLongitude("456");

        $manager->persist($location);
        $manager->flush();

        $this->addReference('location', $location);
    }
}
