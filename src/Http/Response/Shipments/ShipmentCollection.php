<?php

namespace ShippoClient\Http\Response\Shipments;

use ShippoClient\Http\ResponseCollection;

class ShipmentCollection extends ResponseCollection
{
    /**
     * @return Shipment[]
     */
    public function getResults()
    {
        $results = array();
        foreach ($this->attributes->mayHave('results')->asArray() as $result) {
            $results[] = new Shipment($result);
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
