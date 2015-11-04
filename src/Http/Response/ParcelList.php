<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Entity\Parcel;
use ShippoClient\Entity\ParcelCollection;
use TurmericSpice\ReadableAttributes;

class ParcelList extends ListResponse
{
    use ReadableAttributes;

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
