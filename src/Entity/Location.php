<?php

namespace ShippoClient\Entity;

use ShippoClient\Attributes;
use TurmericSpice\ReadableAttributes;

class Location extends Entity
{
    use ReadableAttributes {
        mayHaveAsString as public getCity;
        mayHaveAsString as public getState;
        mayHaveAsString as public getZip;
        mayHaveAsString as public getCountry;
    }
}
