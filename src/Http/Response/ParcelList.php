<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Entity\Parcel;
use ShippoClient\Entity\ParcelCollection;
use TurmericSpice\Container;

class ParcelList extends ListResponse
{
    /**
     * @return ParcelCollection
     */
    public function getResults()
    {
        $entities = [];
        foreach ($this->attributes->mayHave('results')->asArray() as $attributes) {
            $entities[] = new Parcel($attributes);
        }

        return new ParcelCollection($entities);
    }
}
