<?php

namespace ShippoClient\Http;

use ShippoClient\Attributes;

abstract class ResponseCollection
{
    public function __construct(array $attributes)
    {
        $this->attributes = new Attributes($attributes);
    }

    public function getCount()
    {
        return $this->attributes->mayHave('count')->asInteger();
    }

    public function getNext()
    {
        return $this->attributes->mayHave('next')->value();
    }

    public function getPrevious()
    {
        return $this->attributes->mayHave('previous')->value();
    }

    abstract public function toArray();
}