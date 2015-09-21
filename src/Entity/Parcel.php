<?php

namespace ShippoClient\Entity;

use ShippoClient\Attributes;

class Parcel extends RootEntity
{
    public function getTemplate()
    {
        return $this->attributes->mayHave('template')->asString();
    }

    public function getLength()
    {
        return $this->attributes->mayHave('length')->asFloat();
    }

    public function getWidth()
    {
        return $this->attributes->mayHave('width')->asFloat();
    }

    public function getHeight()
    {
        return $this->attributes->mayHave('height')->asFloat();
    }

    public function getDistanceUnit()
    {
        return $this->attributes->mayHave('distance_unit')->asString();
    }

    public function getWeight()
    {
        return $this->attributes->mayHave('weight')->asFloat();
    }

    public function getMassUnit()
    {
        return $this->attributes->mayHave('mass_unit')->asString();
    }

    public function getValueAmount()
    {
        return $this->attributes->mayHave('value_amount')->asString();
    }

    public function getValueCurrency()
    {
        return $this->attributes->mayHave('value_currency')->asString();
    }

    public function getMetadata()
    {
        return $this->attributes->mayHave('metadata')->asString();
    }

    public function toArray()
    {
        return [
            "object_state"   => $this->getObjectState(),
            "object_created" => $this->getObjectCreated(),
            "object_updated" => $this->getObjectUpdated(),
            "object_id"      => $this->getObjectId(),
            "object_owner"   => $this->getObjectOwner(),
            "template"       => $this->getTemplate(),
            "length"         => $this->getLength(),
            "width"          => $this->getWidth(),
            "height"         => $this->getHeight(),
            "distance_unit"  => $this->getDistanceUnit(),
            "weight"         => $this->getWeight(),
            "value_amount"   => $this->getValueAmount(),
            "value_currency" => $this->getValueCurrency(),
            "mass_unit"      => $this->getMassUnit(),
            "metadata"       => $this->getMetadata(),
        ];
    }
}
