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
}
