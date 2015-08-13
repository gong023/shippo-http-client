<?php

namespace ShippoClient\Http\Response\Parcels;

use ShippoClient\Attributes;
use ShippoClient\Http\ResponseCollection;

class ParcelCollection extends ResponseCollection
{
    /**
     * @return Parcel[]
     */
    public function getResults()
    {
        $results = array();
        foreach ($this->attributes->mayHave('results')->asArray() as $result) {
            $results[] = new Parcel($result);
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
