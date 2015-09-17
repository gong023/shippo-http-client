<?php

namespace ShippoClient\Entity;

use ShippoClient\Attributes;

class Location extends Entity
{
    /**
     * @return string
     */
    public function getCity()
    {
        return $this->attributes->mayHave('city')->asString();
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->attributes->mayHave('state')->asString();
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->attributes->mayHave('zip')->asString();
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->attributes->mayHave('country')->asString();
    }

    public function toArray()
    {
        return array(
            'city'    => $this->getCity(),
            'state'   => $this->getState(),
            'zip'     => $this->getZip(),
            'country' => $this->getCountry(),
        );
    }
}
