<?php

namespace ShippoClient\Http\Request\Transactions;

use ShippoClient\Attributes\InvalidAttributeException;
use ShippoClient\Attributes;

class CreateObject
{
    public function __construct(array $attributes)
    {
        $this->attributes = new Attributes($attributes);
    }

    public function getRate()
    {
        return $this->attributes->mustHave('rate')->asString();
    }

    public function getMetadata()
    {
        return $this->attributes->mayHave('metadata')->asString();
    }

    public function toArray()
    {
        return array(
            'rate' => $this->getRate(),
            'metadata' => $this->getMetadata(),
        );
    }
}
