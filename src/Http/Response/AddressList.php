<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Attributes;
use ShippoClient\Entity\Address;
use ShippoClient\Entity\AddressCollection;

class AddressList extends ListResponse
{
    /**
     * @return AddressCollection
     */
    public function getResults()
    {
        $entities = array();
        foreach ($this->attributes->mayHave('results')->asArray() as $attributes) {
            $entities[] = new Address($attributes);
        }

        return new AddressCollection($entities);
    }
}
