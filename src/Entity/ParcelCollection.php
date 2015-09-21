<?php

namespace ShippoClient\Entity;

class ParcelCollection extends EntityCollection
{
    /**
     * @param Parcel[] $entities
     */
    public function __construct(array $entities)
    {
        parent::__construct($entities);
    }
}
