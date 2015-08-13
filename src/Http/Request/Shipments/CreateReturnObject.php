<?php

namespace ShippoClient\Http\Request\Shipments;

class CreateReturnObject extends CreateObject
{
    /**
     * {@inheritdoc}
     */
    public function getReturnOf()
    {
        $this->attributes->mustHave('return_of')->asString();
    }
}
