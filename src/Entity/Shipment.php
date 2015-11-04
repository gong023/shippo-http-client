<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class Shipment extends RootEntity
{
    use ReadableAttributes {
        mayHaveAsString as public getObjectStatus;
        mayHaveAsString as public getAddressFrom;
        mayHaveAsString as public getAddressTo;
        mayHaveAsString as public getAddressReturn;
        mayHaveAsString as public getParcel;
        mayHaveAsString as public getSubmissionType;
        mayHaveAsString as public getSubmissionDate;
        mayHaveAsString as public getRatesUrl;
        mayHaveAsString as public getCustomsDeclaration;
        mayHaveAsInt    as public getInsuranceAmount;
        mayHaveAsString as public getInsuranceCurrency;
        mayHaveAsArray  as public getExtra;
        mayHaveAsString as public getReturnOf;
        mayHaveAsArray  as public getCarrierAccounts;
        mayHaveAsArray  as public getMessages;
        mayHaveAsString as public getMetadata;
    }

    public function getReference1()
    {
        return $this->attributes->mayHave('reference_1')->asString();
    }

    public function getReference2()
    {
        return $this->attributes->mayHave('reference_2')->asString();
    }
}
