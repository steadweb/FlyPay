<?php declare(strict_types=1);

namespace Steadweb\Flypay\Repositories;

use Doctrine\ORM\Query;
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

    /**
     * Find all payments within the last 24 hours, based on a location, if passed.
     *
     * @param string $location
     *
     * @return array
     */
    public function getLast24HoursByLocation(string $location = null): array
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $params = [
            'from' => new \DateTime('-1 day'),
            'to' => new \DateTime('now')
        ];

        $query = $qb->select('p')->from(Payment::class, 'p');

        if(!is_null($location)) {
            $query->where('p.location = ' . ':location');
            $params += ['location' => $location];
        }

        $data = $query->andWhere($qb->expr()->between('p.created', ':from', ':to'))
            ->setParameters($params)
            ->getQuery();

        $payments = [];

        foreach($data->getResult() as $payment) {
            $payments[] = $payment->getArrayCopy();
        }

        return $payments;
    }
}
