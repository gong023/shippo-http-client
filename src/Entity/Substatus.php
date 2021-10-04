<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class Substatus {
    use ReadableAttributes {
        mayHaveAsString  as public getCode;
        mayHaveAsString  as public getText;
        mayHaveAsBoolean as public getActionRequired;
    }
}
