<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Entity\Address;
use ShippoClient\Entity\AddressCollection;
use TurmericSpice\ReadableAttributes;

class AddressList extends ListResponse
{
    use ReadableAttributes;

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
