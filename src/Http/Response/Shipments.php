<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Http\Response;

class Shipments extends Response
{
    public function getObjectStatus()
    {
        return $this->attributes->mayHave('object_status')->asString();
    }

    public function getAddressFrom()
    {
        return $this->attributes->mayHave('address_from')->asString();
    }

    public function getAddressTo()
    {
        return $this->attributes->mayHave('address_to')->asString();
    }

    public function getAddressReturn()
    {
        return $this->attributes->mayHave('address_return')->asString();
    }

    public function getParcel()
    {
        return $this->attributes->mayHave('parcel')->asString();
    }

    public function getSubmissionType()
    {
        return $this->attributes->mayHave('submission_type')->asString();
    }

    public function getSubmissionDate()
    {
        return $this->attributes->mayHave('submission_date')->asString();
    }

    public function getRatesUrl()
    {
        return $this->attributes->mayHave('rates_url')->asString();
    }

    public function getCustomsDeclaration()
    {
        return $this->attributes->mayHave('customs_declaration')->asString();
    }

    public function getInsuranceAmount()
    {
        return $this->attributes->mayHave('insurance_amount')->asString();
    }

    public function getInsuranceCurrency()
    {
        return $this->attributes->mayHave('insurance_currency')->asString();
    }

    public function getExtra()
    {
        return $this->attributes->mayHave('extra')->asString();
    }

    public function getReference1()
    {
        return $this->attributes->mayHave('reference_1')->asString();
    }

    public function getReference2()
    {
        return $this->attributes->mayHave('reference_2')->asString();
    }

    public function getCarrierAccounts()
    {
        return $this->attributes->mayHave('carrier_accounts')->asArray();
    }

    public function getMessages()
    {
        return $this->attributes->mayHave('messages')->asArray();
    }

    public function getMetadata()
    {
        return $this->attributes->mayHave('metadata')->asString();
    }

    public function toArray()
    {
        return array(
            "object_created"      => $this->getObjectCreated(),
            "object_updated"      => $this->getObjectUpdated(),
            "object_id"           => $this->getObjectId(),
            "object_owner"        => $this->getObjectOwner(),
            "object_state"        => $this->getObjectState(),
            "object_status"       => $this->getObjectStatus(),
            "object_purpose"      => $this->getObjectPurpose(),
            "address_from"        => $this->getAddressFrom(),
            "address_to"          => $this->getAddressTo(),
            "parcel"              => $this->getParcel(),
            "submission_type"     => $this->getSubmissionType(),
            "submission_date"     => $this->getSubmissionDate(),
            "address_return"      => $this->getAddressReturn(),
            "customs_declaration" => $this->getCustomsDeclaration(),
            "insurance_amount"    => $this->getInsuranceAmount(),
            "insurance_currency"  => $this->getInsuranceCurrency(),
            "extra"               => $this->getExtra(),
            "reference_1"         => $this->getReference1(),
            "reference_2"         => $this->getReference2(),
            "rates_url"           => $this->getRatesUrl(),
            "carrier_accounts"    => $this->getCarrierAccounts(),
            "messages"            => $this->getMessages(),
            "metadata"            => $this->getMetadata()
        );
    }
}
