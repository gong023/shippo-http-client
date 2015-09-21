<?php

namespace ShippoClient\Entity;

class AddressCollection extends EntityCollection
{
    /**
     * @param Address[] $entities
     */
    public function __construct(array $entities)
    {
        parent::__construct($entities);
    }
}
