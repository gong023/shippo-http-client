<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Entity\EntityCollection;
use TurmericSpice\ReadWriteAttributes;

abstract class ListResponse
{
    use ReadWriteAttributes {
        mayHaveAsInt as public getCount;
        toArray      as public __toArray;
    }

    public function getNext()
    {
        return $this->attributes->mayHave('next')->value();
    }

    public function getPrevious()
    {
        return $this->attributes->mayHave('previous')->value();
    }

    public function toArray()
    {
        $array = $this->__toArray();
        $array['results'] = $this->getResults()->toArray();

        return $array;
    }

    /**
     * @return EntityCollection
     */
    abstract public function getResults();
}
