<?php

namespace ShippoClient\Http\Response\Rates;

use ShippoClient\Http\ResponseCollection;

class RateCollection extends ResponseCollection
{
    /**
     * @return Rate[]
     */
    public function getResults()
    {
        $results = array();
        foreach ($this->attributes->mayHave('results')->asArray() as $result) {
            $results[] = new Rate($result);
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