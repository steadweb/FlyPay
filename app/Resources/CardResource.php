<?php declare(strict_types=1);

namespace Steadweb\Flypay\Resources;

use Steadweb\Flypay\AbstractResource;
use Steadweb\Flypay\Entities\Card;

final class CardResource extends AbstractResource
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
