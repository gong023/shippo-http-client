<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Entity\Refund;
use ShippoClient\Entity\RefundCollection;

class RefundList extends ListResponse
{
    /**
     * @return RefundCollection
     */
    public function getResults()
    {
        $entities = [];
        foreach ($this->attributes->mayHave('results')->asArray() as $attributes) {
            $entities[] = new Refund($attributes);
        }

        return new RefundCollection($entities);
    }
}
