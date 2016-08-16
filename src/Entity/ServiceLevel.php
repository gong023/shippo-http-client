<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class ServiceLevel
{
    use ReadableAttributes {
        mayHaveAsString as public getToken;
        mayHaveAsString as public getName;
    }
}
