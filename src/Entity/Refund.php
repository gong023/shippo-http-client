<?php

namespace ShippoClient\Entity;

use TurmericSpice\Container;
use TurmericSpice\ReadableAttributes;

class Refund extends ObjectInformation
{
    use ReadableAttributes {
        mayHaveAsString as public getTransaction;
    }

    /**
     * @var Container
     */
    protected $attributes;

    /**
     * avoid error 'define the same property in the composition' in php < 5.6.13
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
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
