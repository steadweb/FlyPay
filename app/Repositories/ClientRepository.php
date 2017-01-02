<?php declare(strict_types=1);

namespace Steadweb\Flypay\Repositories;

use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Entities\Client;

final class ClientRepository extends AbstractRepository
{
    /**
     * Create a client.
     *
     * @param array $details
     */
    public function create(array $details)
    {
        $client = new $this->entity;

        $client->setDomain($details['domain']);
        $client->setPublicKey($details['public_key']);

        $this->entityManager->persist($client);
        $this->entityManager->flush();
    }
}
