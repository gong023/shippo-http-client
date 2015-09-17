<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Entity\Rate;
use ShippoClient\Entity\RateCollection;

class RateList extends ListResponse
{
    /**
     * @return RateCollection
     */
    public function getResults()
    {
        $entities = array();
        foreach ($this->attributes->mayHave('results')->asArray() as $attributes) {
            $entities[] = new Rate($attributes);
        }

        return new RateCollection($entities);
    }
}
