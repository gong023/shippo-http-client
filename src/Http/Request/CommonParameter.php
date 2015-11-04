<?php

namespace ShippoClient\Http\Request;

use TurmericSpice\ReadWriteAttributes;

abstract class CommonParameter
{
    use ReadWriteAttributes;

    /**
     * A string of up to 100 characters
     * that can be filled with any additional information you want to attach to the object.
     *
     * @return string
     */
    public function getMetadata()
    {
        return $this->attributes->mayHave('metadata')->asString(function ($metadata) {
            return mb_strlen($metadata) <= 100;
        });
    }
}
