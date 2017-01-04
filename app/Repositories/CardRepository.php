<?php declare(strict_types=1);

namespace Steadweb\Flypay\Repositories;

use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Entities\Card;

class CardRepository extends AbstractRepository
{
    /**
     * Create a card.
     *
     * @param array $details
     *
     * @return Card
     */
    public function create(array $details): Card
    {
        $card = new Card;
        $em = $this->getEntityManager();

        $card->setLast4($details['last4']);
        $card->setType($details['type']);

        $em->persist($card);
        $em->flush();

        return $card;
    }
}
