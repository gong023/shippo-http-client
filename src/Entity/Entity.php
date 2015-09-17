<?php

namespace ShippoClient\Entity;

use ShippoClient\Attributes;

abstract class Entity
{
    protected $attributes;

    public function __construct(array $rawResponse)
    {
        $this->attributes = new Attributes($rawResponse);
    }

    abstract public function toArray();
}
