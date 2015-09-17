<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Attributes;
use ShippoClient\Entity\Parcel;
use ShippoClient\Entity\ParcelCollection;

class ParcelList extends ListResponse
{
    /**
     * @return ParcelCollection
     */
    public function getResults()
    {
        $entities = array();
        foreach ($this->attributes->mayHave('results')->asArray() as $attributes) {
            $entities[] = new Parcel($attributes);
        }

        return new ParcelCollection($entities);
    }
}
