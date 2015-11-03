<?php

namespace ShippoClient\Entity;

use ShippoClient\Attributes;
use TurmericSpice\ReadableAttributes;

class Parcel extends RootEntity
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
}
