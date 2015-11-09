<?php

namespace ShippoClient\Entity;

use TurmericSpice\Container;
use TurmericSpice\ReadableAttributes;

class Refund extends ObjectInformation
{
    use ReadableAttributes {
        mayHaveAsString as public getTransaction;
        __construct as public __t_construct;
    }

    /**
     * Indicates the status of the Refund.
     *  - PENDING
     *  - SUCCESS
     *  - ERROR
     *
     * @return string
     */
    public function getObjectStatus()
    {
        return $this->attributes->mayHave('object_status')->asString();
    }
}
