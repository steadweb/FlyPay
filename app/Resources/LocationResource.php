<?php

namespace Steadweb\Flypay\Resources;

use Steadweb\Flypay\AbstractResource;
use Steadweb\Flypay\Entities\Location;

class LocationResource extends AbstractResource
{
    /**
     * Create a Location.
     *
     * @param array $details
     */
    public function create(array $details)
    {
        $location = new $this->entity;

        $location->setTitle($details['title']);
        $location->setAddress($details['address']);
        $location->setLatitude($details['latitude']);
        $location->setLongitude($details['longitude']);

        $this->entityManager->persist($location);
        $this->entityManager->flush();
    }
}
