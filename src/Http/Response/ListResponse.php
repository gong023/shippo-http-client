<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Attributes;
use ShippoClient\Entity\EntityCollection;

abstract class ListResponse
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

    public function toArray()
    {
        return [
            'count'    => $this->getCount(),
            'next'     => $this->getNext(),
            'previous' => $this->getPrevious(),
            'results'  => $this->getResults()->toArray(),
        ];
    }

    /**
     * @return EntityCollection
     */
    abstract public function getResults();
}
