<?php declare(strict_types=1);

namespace Steadweb\Flypay\Repositories;

use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Entities\Payment;
use Steadweb\Flypay\Entities\Table;
use Steadweb\Flypay\Entities\Card;
use Steadweb\Flypay\Entities\Location;

class PaymentRepository extends AbstractRepository
{
    /**
     * Create a payment.
     *
     * @param array $details
     *
     * @return Payment
     */
    public function create(array $details): Payment
    {
        $payment = new Payment;
        $em = $this->getEntityManager();

        $payment->setAmount(intval($details['amount']));
        $payment->setReference($details['reference']);

        if($card = $em->getRepository(Card::class)->find($details['card'])) {
            $payment->setCard($card);
        }

        if($location = $em->getRepository(Location::class)->find($details['location'])) {
            $payment->setLocation($location);
        }

        $payment->getTables()->add($em->getRepository(Table::class)->find($details['table']));

        $em->persist($payment);
        $em->flush();

        return $payment;
    }
}
