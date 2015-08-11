<?php

namespace ShippoClient\Addresses;

use ShippoClient\Attributes;

class Response
{
    public function __construct(array $rawResponse)
    {
        $this->attributes = new Attributes($rawResponse);
    }

    public function getObjectState()
    {
        return $this->attributes->mayHave('object_state')->asString();
    }

    public function getObjectPurpose()
    {
        return $this->attributes->mayHave('object_purpose')->asString();
    }

    public function getObjectSource()
    {
        return $this->attributes->mayHave('object_source')->asString();
    }

    public function getObjectCreated()
    {
        return $this->attributes->mayHave('object_created')->asString();
    }

    public function getObjectUpdated()
    {
        return $this->attributes->mayHave('object_updated')->asString();
    }

    public function getObjectId()
    {
        return $this->attributes->mayHave('object_id')->asString();
    }

    public function getObjectOwner()
    {
        return $this->attributes->mayHave('object_owner')->asString();
    }

    public function getName()
    {
        return $this->attributes->mayHave('name')->asString();
    }

    public function getCompany()
    {
        return $this->attributes->mayHave('company')->asString();
    }

    public function getStreet1()
    {
        return $this->attributes->mayHave('street1')->asString();
    }

    public function getStreet2()
    {
        return $this->attributes->mayHave('street2')->asString();
    }

    public function getStreetNo()
    {
        return $this->attributes->mayHave('street_no')->asString();
    }

    public function getCity()
    {
        return $this->attributes->mayHave('city')->asString();
    }

    public function getState()
    {
        return $this->attributes->mayHave('state')->asString();
    }

    public function getZip()
    {
        return $this->attributes->mayHave('zip')->asString();
    }

    public function getCountry()
    {
        return $this->attributes->mayHave('country')->asString();
    }

    public function getPhone()
    {
        return $this->attributes->mayHave('phone')->asString();
    }

    public function getEmail()
    {
        return $this->attributes->mayHave('email')->asString();
    }

    public function getIp()
    {
        return $this->attributes->mayHave('ip')->asString();
    }

    public function getIsResidential()
    {
        $is_residential = $this->attributes->mayHave('is_residential')->value();
        if ($is_residential === null) {
            return null;
        }

        return (bool)$is_residential;
    }

    public function getMetadata()
    {
        return $this->attributes->mayHave('metadata')->asString();
    }

    public function getMessages()
    {
        return $this->attributes->mayHave('messages')->asArray();
    }

    public function toArray()
    {
        return array(
            "object_state"   => $this->getObjectState(),
            "object_purpose" => $this->getObjectPurpose(),
            "object_source"  => $this->getObjectSource(),
            "object_created" => $this->getObjectCreated(),
            "object_updated" => $this->getObjectUpdated(),
            "object_id"      => $this->getObjectId(),
            "object_owner"   => $this->getObjectOwner(),
            "name"           => $this->getName(),
            "company"        => $this->getCompany(),
            "street1"        => $this->getStreet1(),
            "street2"        => $this->getStreet2(),
            "street_no"      => $this->getStreetNo(),
            "city"           => $this->getCity(),
            "state"          => $this->getState(),
            "zip"            => $this->getZip(),
            "country"        => $this->getCountry(),
            "phone"          => $this->getPhone(),
            "email"          => $this->getEmail(),
            "ip"             => $this->getIp(),
            "is_residential" => $this->getIsResidential(),
            "metadata"       => $this->getMetadata(),
            "messages"       => $this->getMessages()
        );
    }
}
