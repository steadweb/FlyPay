<?php declare(strict_types=1);

namespace Steadweb\Flypay\Repositories;

use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Entities\Client;

class ClientRepository extends AbstractRepository
{
    /**
     * Finds a client based on the domain.
     *
     * @param string $domain
     *
     * @throws |Error

     * @return Client
     */
    public function findByDomain(string $domain)
    {
        if($client = $this->findOneBy(['domain' => $domain])) {
            return $client;
        }

        throw new \Error('Domain not found');
    }

    /**
     * Create a client.
     *
     * @param array $details
     */
    public function create(array $details)
    {
        $client = new Client;
        $em = $this->getEntityManager();

        $client->setDomain($details['domain']);
        $client->setPublicKey($details['public_key']);

        $em->persist($client);
        $em->flush();
    }
}
