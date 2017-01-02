<?php declare(strict_types=1);

namespace Steadweb\Flypay\Repositories;

use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Entities\Card;

final class CardRepository extends AbstractRepository
{
    /**
     * Create a card.
     *
     * @param array $details
     */
    public function create(array $details)
    {
        $card = new $this->entity;

        $card->setLast4($details['last4']);
        $card->setType($details['type']);

        $this->entityManager->persist($card);
        $this->entityManager->flush();
    }
}
