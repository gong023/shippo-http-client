<?php

namespace ShippoClient\Entity;

class RefundCollection extends EntityCollection
{
    /**
     * @param Refund[] $entities
     */
    public function __construct(array $entities)
    {
        parent::__construct($entities);
    }
}
