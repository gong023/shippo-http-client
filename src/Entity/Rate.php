<?php

namespace ShippoClient\Entity;

use ShippoClient\Attributes;

/**
 * Each valid Shipment object will automatically trigger the calculation of all available Rates.
 * Depending on your Addresses and Parcel, there may be none, one or multiple Rates.
 *
 * By default, the calculated Rates will return the price in two currencies under the "amount" and "amount_local" keys, respectively.
 * The "amount" key will contain the price of a Rate expressed in the currency that is used in the country from which Parcel originates,
 * and the "amount_local" key will contain the price expressed in the currency that is used in the country the Parcel is shipped to.
 * You can request Rates with prices expressed in a different currency by adding the desired currency code in the end of the resource URL.
 * The full list of supported currencies along with their codes can be viewed on open exchange rates.
 *
 * Rates are created asynchronously. The response time depends exclusively on the carrier's server.
 */
class Rate extends RootEntity
{
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
        return $this->attributes->mayHave('days')->asInteger();
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

    /**
     * Description is not found in Shippo API doc, but this key is returned in fact.
     *
     * @return mixed|null
     */
    public function getAvailableShippo()
    {
        return $this->attributes->mayHave('available_shippo')->value();
    }

    /**
     * Description is not found in Shippo API doc, but this key is returned in fact.
     *
     * @return mixed|null
     */
    public function getOutboundEndpoint()
    {
        return $this->attributes->mayHave('outbound_endpoint')->value();
    }

    /**
     * Description is not found in Shippo API doc, but this key is returned in fact.
     *
     * @return mixed|null
     */
    public function getInboundEndpoint()
    {
        return $this->attributes->mayHave('inbound_endpoint')->value();
    }

    /**
     * Description is not found in Shippo API doc, but this key is returned in fact.
     *
     * @return mixed|null
     */
    public function getArrivesBy()
    {
        return $this->attributes->mayHave('arrives_by')->value();
    }

    /**
     * Description is not found in Shippo API doc, but this key is returned in fact.
     *
     * @return mixed|null
     */
    public function getDeliveryAttempts()
    {
        return $this->attributes->mayHave('delivery_attempts')->value();
    }

    public function toArray()
    {
        return [
            'object_state'             => $this->getObjectState(),
            'object_purpose'           => $this->getObjectPurpose(),
            'object_created'           => $this->getObjectCreated(),
            'object_updated'           => $this->getObjectUpdated(),
            'object_id'                => $this->getObjectId(),
            'object_owner'             => $this->getObjectOwner(),
            'shipment'                 => $this->getShipment(),
            'attributes'               => $this->getAttributes(),
            'amount_local'             => $this->getAmountLocal(),
            'currency_local'           => $this->getCurrencyLocal(),
            'amount'                   => $this->getAmount(),
            'currency'                 => $this->getCurrency(),
            'provider'                 => $this->getProvider(),
            'provider_image_75'        => $this->getProviderImage75(),
            'provider_image_200'       => $this->getProviderImage200(),
            'servicelevel_name'        => $this->getServicelevelName(),
            'servicelevel_terms'       => $this->getServicelevelTerms(),
            'days'                     => $this->getDays(),
            'duration_terms'           => $this->getDurationTerms(),
            'trackable'                => $this->getTrackable(),
            'insurance'                => $this->getInsurance(),
            'insurance_amount_local'   => $this->getInsuranceAmountLocal(),
            'insurance_currency_local' => $this->getInsuranceCurrencyLocal(),
            'insurance_amount'         => $this->getInsuranceAmount(),
            'insurance_currency'       => $this->getInsuranceCurrency(),
            'carrier_account'          => $this->getCarrierAccount(),
            'messages'                 => $this->getMessages(),
            'available_shippo'         => $this->getAvailableShippo(),
            'outbound_endpoint'        => $this->getOutboundEndpoint(),
            'inbound_endpoint'         => $this->getInboundEndpoint(),
            'arrives_by'               => $this->getArrivesBy(),
            'delivery_attempts'        => $this->getDeliveryAttempts(),
        ];
    }
}
