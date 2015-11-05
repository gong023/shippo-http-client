<?php

namespace ShippoClient\Http\Request\Shipments;

use TurmericSpice\Container;
use TurmericSpice\ReadableAttributes;

class CreateReturnObject extends CreateObject
{
    use ReadableAttributes {
        mustHaveAsString as public getReturnOf;
        toArray          as public __toArray;
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
}
