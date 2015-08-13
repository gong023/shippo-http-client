<?php

namespace ShippoClient\Http\Response\Addresses;

use ShippoClient\Attributes;
use ShippoClient\Http\ResponseCollection;

class AddressCollection extends ResponseCollection
{
    /**
     * @return Address[]
     */
    public function getResults()
    {
        $results = array();
        foreach ($this->attributes->mayHave('results')->asArray() as $result) {
            $results[] = new Address($result);
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
