<?php

namespace ShippoClient\Entity;

class ShipmentCollection extends EntityCollection
{
    /**
     * @param Shipment[] $entities
     */
    public function __construct(array $entities)
    {
        parent::__construct($entities);
    }
}
