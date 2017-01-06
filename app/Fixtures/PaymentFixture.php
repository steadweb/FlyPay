<?php

namespace Steadweb\Flypay\Fixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Steadweb\Flypay\Entities\Payment;

class PaymentFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $payment = new Payment();

        $payment->setAmount(10000);
        $payment->setGratuity(1000);
        $payment->setReference("demo");

        $payment->setCard($this->getReference('card'));
        $payment->setLocation($this->getReference('location'));
        $payment->getTables()->add($this->getReference('table'));

        $manager->persist($payment);
        $manager->flush();

        $this->addReference('payment', $payment);
    }
}
