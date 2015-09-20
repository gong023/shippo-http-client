<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Entity\Transaction;
use ShippoClient\Entity\TransactionCollection;

class TransactionList extends ListResponse
{
    /**
     * @return TransactionCollection
     */
    public function getResults()
    {
        $entities = [];
        foreach ($this->attributes->mayHave('results')->asArray() as $attributes) {
            $entities[] = new Transaction($attributes);
        }

        return new TransactionCollection($entities);
    }
}
