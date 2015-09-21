<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Entity\Shipment;
use ShippoClient\Entity\ShipmentCollection;

class ShipmentList extends ListResponse
{
    /**
     * @return ShipmentCollection
     */
    public function getResults()
    {
        $entities = [];
        foreach ($this->attributes->mayHave('results')->asArray() as $attributes) {
            $entities[] = new Shipment($attributes);
        }

        return new ShipmentCollection($entities);
    }
}
