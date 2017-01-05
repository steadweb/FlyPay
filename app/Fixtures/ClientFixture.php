<?php

namespace Steadweb\Flypay\Fixtures;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Steadweb\Flypay\Entities\Client;

class ClientFixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $client = new Client();

        $client->setDomain('https://flypay.steadweb.com');
        $client->setPublicKey('ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKU1V6STFOaUo5LmV5SnBjM01pT2lKb2RIUndjenBjTDF3dlpteDVjR0Y1TG5OMFpXRmtkMlZpTG1OdmJTSXNJbUYxWkNJNkltaDBkSEJ6T2x3dlhDOW1iSGx3WVhrdWMzUmxZV1IzWldJdVkyOXRJbjAuSjZ5UnZlekhISndNLTlfbnlIZC0yUG1jUkRJQXRxbUpsSEtjZ0VFdVd4UDFBNi0tQTVLN2J2bTBLaHlfNTI3UWxDMy0wTnB1RWZldl95UnQyTUl4T1Znb1Nzbl9qRHQyTnkzd0RVTkZXZGFBV3dtZTZUZVRtNVRWdHN6VGNqMWhJMUpYb0ZmeGJrWTFrSXphZktRQ1pGTElLTmgwOEhvS2prMlBIclpWMko2azdQVVRuenhvWi1GdjZVcHNiYlY5X2U0WGJQYmpWdHJZMjMtT2xZZU04Z2xkUWlmMkVNYUZUWThTSUR1TjZPdEJWREpvR0ctLXJzSE9GZkkxbkdqekJEbkZBdmZMSml4R1pMUFRfREM0WWhSSy0tSDJrSkx3Y0xVT3p4S0I2M2I1Z1dISGRDZGRTV0FETGdRLW5PWnNBOEx5SFFjQ0pxWTdDMVF1bWhCaExR');

        $manager->persist($client);
        $manager->flush();
    }
}
