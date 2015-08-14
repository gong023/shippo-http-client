<?php

namespace ShippoClient\Http\Request;

use ShippoClient\Attributes;

abstract class CommonParameter
{
    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = new Attributes($attributes);
    }

    /**
     * A string of up to 100 characters
     * that can be filled with any additional information you want to attach to the object.
     *
     * @return string
     */
    public function getMetadata()
    {
        return $this->attributes->mayHave('metadata')->asString(function ($metadata) {
//            return mb_strlen($metadata) <= 100;
            return strlen($metadata) <= 100;
        });
    }

    abstract function toArray();
}
