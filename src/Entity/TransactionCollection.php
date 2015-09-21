<?php

namespace ShippoClient\Entity;

class TransactionCollection extends EntityCollection
{
    /**
     * @param Transaction[] $entities
     */
    public function __construct(array $entities)
    {
        parent::__construct($entities);
    }
}
