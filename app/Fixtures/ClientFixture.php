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
        $client->setPublicKey('LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0NCk1JSUJJakFOQmdrcWhraUc5dzBCQVFFRkFBT0NBUThBTUlJQkNnS0NBUUVBdTJsZCtIeXh1dVFFQlVwcUdMcU4NCnNka0dOZVdqVE1TN2V2WU4rZzN4WlRtT3NVN1p6ZkxOaklFWnFMU3pGTUc1WUU3eFlBVFF4cGlNWlhCckN4VHgNCi9kQUo3YWM4NWsyMHVVQTF2WXhndmxUOW5aYTJBTVZJVlNSampPK3IvYWtISjh5QXFxU0pnZ3p6WkFWTDJZS00NCldUUDZ4TlFiNU9RSjBzWGhhQ3dmdnp2TlM0MVhocHgreEZEbkRVMTJ0UDFjUjNvQy83SWhOMjc0RExuS2hOQ1ENCjN6U055RUlqYm9QT09pRWQ1b21BVTlMTWlMbU0zR0NWRFlQWFAwVnMzZERxc1pFNmdqcGFaL01zNnRtQ2NzYmwNCm5PVk5rcjhuRkQxL0hvdFNvODdpYzBZK3NzcFFYR2IzcGlEamkzcHQ5Y2d1RHFieUtEUHV6R2gvbDNOTzcxWUENCnh3SURBUUFCDQotLS0tLUVORCBQVUJMSUMgS0VZLS0tLS0=');

        $manager->persist($client);
        $manager->flush();
    }
}
