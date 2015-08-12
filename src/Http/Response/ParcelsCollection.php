<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Attributes;

class ParcelsCollection extends Collection
{
    /**
     * @return Parcels[]
     */
    public function getResults()
    {
        $results = array();
        foreach ($this->attributes->mayHave('results')->asArray() as $result) {
            $results[] = new Parcels($result);
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
