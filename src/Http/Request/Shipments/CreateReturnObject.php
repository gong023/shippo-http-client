<?php

namespace ShippoClient\Http\Request\Shipments;

use TurmericSpice\Container\InvalidAttributeException;

class CreateReturnObject extends CreateObject
{
    /**
     * {@inheritdoc}
     * @throws InvalidAttributeException
     */
    public function getReturnOf()
    {
        $this->attributes->mustHave('return_of')->asString();
    }
}
