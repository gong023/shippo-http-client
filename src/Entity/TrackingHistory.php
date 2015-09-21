<?php

namespace ShippoClient\Entity;

class TrackingHistory extends EntityCollection
{
    /**
     * @param TrackingStatus[] $entities
     */
    public function __construct(array $entities)
    {
        parent::__construct($entities);
    }
}
