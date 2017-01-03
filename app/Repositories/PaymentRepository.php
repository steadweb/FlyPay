<?php declare(strict_types=1);

namespace Steadweb\Flypay\Repositories;

use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Entities\Payment;
use Steadweb\Flypay\Entities\Table;
use Steadweb\Flypay\Entities\Card;
use Steadweb\Flypay\Entities\Location;

final class PaymentRepository extends AbstractRepository
{
    /**
     * Create a payment.
     *
     * @param array $details
     */
    public function create(array $details)
    {
        $payment = new $this->entity;

        $payment->setAmount(intval($details['amount']));
        $payment->setReference($details['reference']);

        if($card = $this->getEntityManager()->getRepository(Card::class)->find($details['card'])) {
            $payment->setCard($card);
        }

        if($location = $this->getEntityManager()->getRepository(Location::class)->find($details['location'])) {
            $payment->setLocation($location);
        }

        $payment->getTables()->add($this->getEntityManager()->getRepository(Table::class)->find($details['table']));

        $this->entityManager->persist($payment);
        $this->entityManager->flush();
    }
}
