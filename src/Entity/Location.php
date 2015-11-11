<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class Location
{
    use ReadableAttributes {
        mayHaveAsString as public getCity;
        mayHaveAsString as public getState;
        mayHaveAsString as public getZip;
        mayHaveAsString as public getCountry;
    }
}
