<?php

namespace ShippoClient\Entity;

use TurmericSpice\Container;
use TurmericSpice\ReadableAttributes;

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
class Rate extends ObjectInformation
{
    use ReadableAttributes {
        mayHaveAsString  as public getShipment;
        mayHaveAsArray   as public getAttributes;
        mayHaveAsFloat   as public getAmountLocal;
        mayHaveAsString  as public getCurrencyLocal;
        mayHaveAsFloat   as public getAmount;
        mayHaveAsString  as public getCurrency;
        mayHaveAsString  as public getProvider;
        mayHaveAsString  as public getServicelevelName;
        mayHaveAsString  as public getServicelevelTerms;
        mayHaveAsInt     as public getDays;
        mayHaveAsBoolean as public getTrackable;
        mayHaveAsBoolean as public getInsurance;
        mayHaveAsFloat   as public getInsuranceAmountLocal;
        mayHaveAsString  as public getInsuranceCurrencyLocal;
        mayHaveAsFloat   as public getInsuranceAmount;
        mayHaveAsString  as public getInsuranceCurrency;
        mayHaveAsString  as public getCarrierAccount;
        mayHaveAsString  as public getDurationTerms;
        mayHaveAsArray   as public getMessages;
    }

    /**
     * @var Container
     */
    protected $attributes;

    /**
     * avoid error 'define the same property in the composition' in php < 5.6.13
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function getProviderImage75()
    {
        return $this->attributes->mayHave('provider_image_75')->asString();
    }

    public function getProviderImage200()
    {
        return $this->attributes->mayHave('provider_image_200')->asString();
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
}
