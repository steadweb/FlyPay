<?php

namespace Steadweb\Flypay\Fixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Steadweb\Flypay\Entities\Card;

class CardFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $card = new Card();

        $card->setLast4('6352');
        $card->setType('VISA');

        $manager->persist($card);
        $manager->flush();

        $this->addReference('card', $card);
    }
}
