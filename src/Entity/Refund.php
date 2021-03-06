<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class Refund extends ObjectInformation
{
    use ReadableAttributes {
        mayHaveAsString as public getTransaction;
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
