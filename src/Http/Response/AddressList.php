<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Entity\Address;
use ShippoClient\Entity\AddressCollection;
use TurmericSpice\Container;

class AddressList extends ListResponse
{
    /**
     * @return AddressCollection
     */
    public function getResults()
    {
        $entities = [];
        foreach ($this->attributes->mayHave('results')->asArray() as $attributes) {
            $entities[] = new Address($attributes);
        }

        return new AddressCollection($entities);
    }
}
