<?php

namespace ShippoClient\Addresses;

use ShippoClient\Attributes;

class ResponseCollection
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

    /**
     * @return Response[]
     */
    public function getResults()
    {
        $results = array();
        foreach($this->attributes->mayHave('results')->asArray() as $result) {
            $results[] = new Response($result);
        }

        return $results;
    }

    public function toArray()
    {
        return array(
            'count'    => $this->getCount(),
            'next'     => $this->getNext(),
            'previous' => $this->getPrevious(),
            'results'  => $this->getResults(),
        );
    }
}

