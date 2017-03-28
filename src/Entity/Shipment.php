<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class Shipment extends ObjectInformation
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
        mayHaveAsString as public getReference_1;
        mayHaveAsString as public getReference_2;
    }
}
