<?php

namespace ShippoClient\Entity;

class RateCollection extends EntityCollection
{
    /**
     * @param Rate[] $entities
     */
    public function __construct(array $entities)
    {
        parent::__construct($entities);
    }
}
