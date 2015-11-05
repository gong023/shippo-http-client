<?php

namespace ShippoClient\Entity;

use TurmericSpice\Container;
use TurmericSpice\ReadableAttributes;

class Parcel extends ObjectInformation
{
    use ReadableAttributes {
        mayHaveAsString as public getTemplate;
        mayHaveAsFloat  as public getLength;
        mayHaveAsFloat  as public getWidth;
        mayHaveAsFloat  as public getHeight;
        mayHaveAsFloat  as public getWeight;
        mayHaveAsString as public getDistanceUnit;
        mayHaveAsString as public getMassUnit;
        mayHaveAsString as public getValueAmount;
        mayHaveAsString as public getValueCurrency;
        mayHaveAsString as public getMetadata;
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
