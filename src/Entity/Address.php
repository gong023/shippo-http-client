<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class Address extends RootEntity
{
    use ReadableAttributes {
        mayHaveAsString as public getName;
        mayHaveAsString as public getCompany;
        mayHaveAsString as public getStreet1;
        mayHaveAsString as public getStreet2;
        mayHaveAsString as public getStreetNo;
        mayHaveAsString as public getCity;
        mayHaveAsString as public getState;
        mayHaveAsString as public getZip;
        mayHaveAsString as public getCountry;
        mayHaveAsString as public getPhone;
        mayHaveAsString as public getEmail;
        mayHaveAsString as public getIp;
        mayHaveAsString as public getMetadata;
        mayHaveAsArray  as public getMessages;
    }

    public function getIsResidential()
    {
        $is_residential = $this->attributes->mayHave('is_residential')->value();
        if ($is_residential === null) {
            return null;
        }

        return (bool)$is_residential;
    }
}
