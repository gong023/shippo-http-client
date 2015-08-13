<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Attributes;
use ShippoClient\Http\Response;

class Rate extends Response
{
    public function getObjectState()
    {
        return $this->attributes->mayHave('object_state')->asString();
    }

    public function getObjectPurpose()
    {
        return $this->attributes->mayHave('object_purpose')->asString();
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

    public function getShipment()
    {
        return $this->attributes->mayHave('shipment')->asString();
    }

    public function getAttributes()
    {
        return $this->attributes->mayHave('attributes')->asArray();
    }

    public function getAmountLocal()
    {
        return $this->attributes->mayHave('amount_local')->asFloat();
    }

    public function getCurrencyLocal()
    {
        return $this->attributes->mayHave('currency_local')->asString();
    }

    public function getAmount()
    {
        return $this->attributes->mayHave('amount')->asFloat();
    }

    public function getCurrency()
    {
        return $this->attributes->mayHave('currency')->asString();
    }

    public function getProvider()
    {
        return $this->attributes->mayHave('provider')->asString();
    }

    public function getProviderImage75()
    {
        return $this->attributes->mayHave('provider_image_75')->asString();
    }

    public function getProviderImage200()
    {
        return $this->attributes->mayHave('provider_image_200')->asString();
    }

    public function getServicelevelName()
    {
        return $this->attributes->mayHave('servicelevel_name')->asString();
    }

    public function getServicelevelTerms()
    {
        return $this->attributes->mayHave('servicelevel_terms')->asString();
    }

    public function getDays()
    {
        return $this->attributes->mayHave('days')->asString();
    }

    public function getDurationTerms()
    {
        return $this->attributes->mayHave('duration_terms')->asString();
    }

    public function getTrackable()
    {
        return $this->attributes->mayHave('trackable')->asBoolean();
    }

    public function getInsurance()
    {
        return $this->attributes->mayHave('insurance')->asBoolean();
    }

    public function getInsuranceAmountLocal()
    {
        return $this->attributes->mayHave('insurance_amount_local')->asFloat();
    }

    public function getInsuranceCurrencyLocal()
    {
        return $this->attributes->mayHave('insurance_currency_local')->asString();
    }

    public function getInsuranceAmount()
    {
        return $this->attributes->mayHave('insurance_amount')->asFloat();
    }

    public function getInsuranceCurrency()
    {
        return $this->attributes->mayHave('insurance_currency')->asString();
    }

    public function getCarrierAccount()
    {
        return $this->attributes->mayHave('carrier_account')->asString();
    }

    public function getMessages()
    {
        return $this->attributes->mayHave('messages')->asArray();
    }

    public function toArray()
    {
        return array(
            'object_state' => $this->getObjectState(),
            'object_purpose' => $this->getObjectPurpose(),
            'object_created' => $this->getObjectCreated(),
            'object_updated' => $this->getObjectUpdated(),
            'object_id' => $this->getObjectId(),
            'object_owner' => $this->getObjectOwner(),
            'shipment' => $this->getShipment(),
            'attributes' => $this->getAttributes(),
            'amount_local' => $this->getAmountLocal(),
            'currency_local' => $this->getCurrencyLocal(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'provider' => $this->getProvider(),
            'provider_image_75' => $this->getProviderImage75(),
            'provider_image_200' => $this->getProviderImage200(),
            'servicelevel_name' => $this->getServicelevelName(),
            'servicelevel_terms' => $this->getServicelevelTerms(),
            'days' => $this->getDays(),
            'duration_terms' => $this->getDurationTerms(),
            'trackable' => $this->getTrackable(),
            'insurance' => $this->getInsurance(),
            'insurance_amount_local' => $this->getInsuranceAmountLocal(),
            'insurance_currency_local' => $this->getInsuranceCurrencyLocal(),
            'insurance_amount' => $this->getInsuranceAmount(),
            'insurance_currency' => $this->getInsuranceCurrency(),
            'carrier_account' => $this->getCarrierAccount(),
            'messages' => $this->getMessages(),
        );
    }
}
