<?php declare(strict_types=1);

namespace Steadweb\Flypay\Repositories;

use Steadweb\Flypay\AbstractRepository;
use Steadweb\Flypay\Entities\Location;

class LocationRepository extends AbstractRepository
{
    /**
     * Create a Location.
     *
     * @param array $details
     *
     * @return Location;
     */
    public function create(array $details): Location
    {
        $location = new Location;
        $em = $this->getEntityManager();

        $location->setTitle($details['title']);
        $location->setAddress($details['address']);
        $location->setLatitude($details['latitude']);
        $location->setLongitude($details['longitude']);

        $em->persist($location);
        $em->flush();

        return $location;
    }
}
