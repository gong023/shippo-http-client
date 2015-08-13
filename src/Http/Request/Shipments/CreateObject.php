<?php

namespace ShippoClient\Http\Request\Shipments;

use ShippoClient\Attributes;
use ShippoClient\Attributes\InvalidAttributeException;

/**
 * The heart of the Shippo API, a Shipment is made up of "to" and "from" Addresses and the Parcel to be shipped.
 * Once created, a Shipment object can be used to retrieve shipping Rates and purchase a shipping Label.
 */
class CreateObject
{
    const OBJECT_PURPOSE_QUOTE = 'QUOTE';
    const OBJECT_PURPOSE_PURCHASE = 'PURCHASE';
    const SUBMISSION_TYPE_DROPOFF = 'DROPOFF';
    const SUBMISSION_TYPE_PICKUP = 'PICKUP';

    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = new Attributes($attributes);
    }

    /**
     * Quote Shipments can only be used to obtain quote Rates;
     * at the same time, they accept any valid or completed Address object.
     * Purchase Shipments can be used to obtain Rates and purchase Labels,
     * but only accept purchase Addresses that have been fully entered.
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getObjectPurpose()
    {
        $allowed = array(static::OBJECT_PURPOSE_QUOTE, static::OBJECT_PURPOSE_PURCHASE);

        return $this->attributes->mustHave('object_purpose')->asString(function ($value) use ($allowed) {
            return in_array($value, $allowed);
        });
    }

    /**
     * ID of the Address object that should be used as sender Address.
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getAddressFrom()
    {
        return $this->attributes->mustHave('address_from')->asString();
    }

    /**
     * ID of the Address object that should be used as recipient Address.
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getAddressTo()
    {
        return $this->attributes->mustHave('address_to')->asString();
    }

    /**
     * ID of the Parcel object to be shipped.
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getParcel()
    {
        return $this->attributes->mustHave('parcel')->asString();
    }

    /**
     * Indicates whether the parcel will be dropped off at a carrier location or will be picked up.
     * Selecting 'PICKUP' does not request a carrier pickup.
     * A pickup always needs to be requested separately.
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getSubmissionType()
    {
        $allowed = array(static::SUBMISSION_TYPE_DROPOFF, static::SUBMISSION_TYPE_PICKUP);

        return $this->attributes->mustHave('submission_type')->asString(function ($value) use ($allowed) {
            return in_array($value, $allowed);
        });
    }

    /**
     * ID of the Transaction object of the outbound shipment.
     * This field triggers the creation of a scan-based return shipments.
     * See the Create a return shipment section for more details.
     *
     * @return string
     */
    public function getReturnOf()
    {
        return $this->attributes->mayHave('return_of')->asString();
    }

    /**
     * Desired pickup date. Must be in the format "2014-01-18T00:35:03.463Z" (ISO 8601 date).
     * Please note that for some carriers, not all pickup dates are available.
     * The API will return the corresponding error message if not available.
     * If no pickup_date is given, the value will default to tomorrow's date
     * (including Saturday or Sunday, which can lead to no carrier availability).
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getSubmissionDate()
    {
        $isIOS8601Format = function ($datetime) {
            // this pattern is not strict but is sufficient
            return preg_match('/^(\d{4}-\d{2}-\d{2}|\d{8})[t|T]\d{2}:\d{2}:\d{2}([,|\.]\d+[z|Z]|\+\d+)$/', $datetime);
        };

        if ($this->getSubmissionType() === static::SUBMISSION_TYPE_PICKUP) {
            return $this->attributes->mustHave('submission_date')->asString($isIOS8601Format);
        }

        return $this->attributes->mayHave('submission_date')->asString($isIOS8601Format);
    }

    /**
     * ID of the Address object where the shipment will be sent back to if it is not delivered
     * (Only available for UPS, USPS, and Fedex shipments).
     * If this field is not set, your shipments will be returned to the address_form.
     *
     * @return string
     */
    public function getAddressReturn()
    {
        return $this->attributes->mayHave('address_return')->asString();
    }

    /**
     * ID of the Customs Declarations object for an international shipment.
     *
     * @return string
     */
    public function getCustomsDeclaration()
    {
        return $this->attributes->mayHave('customs_declaration')->asString();
    }

    /**
     * Total Parcel value to be insured.
     * Please note that you need to specify the "insurance_currency" as well as the "insurance_content"
     * (via the extra field below, if your package content is not general cargo) as well.
     *
     * @return int
     */
    public function getInsuranceAmount()
    {
        return $this->attributes->mayHave('insurance_amount')->asInteger();
    }

    /**
     * Currency used for insurance_amount.
     * The official ISO 4217 currency codes are used, e.g. "USD" or "EUR".
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getInsuranceCurrency()
    {
        if ($this->attributes->mayHave('insurance_amount')->value() === null) {
            return $this->attributes->mayHave('insurance_currency')->asString();
        }

        return $this->attributes->mustHave('insurance_currency')->asString();
    }

    /**
     * An array of extra services to be requested.
     * The following services are currently available. We are continuously adding new ones.
     *     - signature_confirmation (string, "standard" for standard signature confirmation, "adult" for adult signature)
     *     - insurance_content (string, specify package content for insurance)
     *     - saturday_delivery (boolean, marks shipment as to be delivered on a Saturday)
     *     - bypass_address_validation (boolean, bypassed address validation, if applicable)
     *     - use_manifests (boolean, shipment to be linked with a manifest (Canada Post only), if applicable)
     *     - saturday_delivery (boolean, marks shipment as to be delivered on a Saturday. Available for UPS and FedEx.)
     *     - bypass_address_validation (boolean, bypassed address validation. Available for USPS, FedEx and UPS.)
     *     - request_retail_rates (boolean, request retail/list rates. Available for FedEx.)
     *     - use_manifests (boolean, shipment to be linked with a manifest (Canada Post only), if applicable)
     *
     * @return array
     */
    public function getExtra()
    {
        return $this->attributes->mayHave('extra')->asArray();
    }

    /**
     * Optional text to be printed on the shipping label.
     *
     * @return string
     */
    public function getReference1()
    {
        return $this->attributes->mayHave('reference_1')->asString();
    }

    /**
     * Optional text to be printed on the shipping label.
     *
     * @return string
     */
    public function getReference2()
    {
        return $this->attributes->mayHave('reference_2')->asString();
    }

    /**
     * An array of object_ids of the carrier account objects to be used for getting shipping rates for this shipment.
     * If no carrier account object_ids are set in this field,
     * Shippo will attempt to generate rates using all the carrier accounts that have the 'active' field set.
     *
     * @return string
     */
    public function getCarrierAccounts()
    {
        return $this->attributes->mayHave('carrier_accounts')->asArray();
    }

    /**
     * A string of up to 100 characters
     * that can be filled with any additional information you want to attach to the object.
     *
     * @return string
     */
    public function getMetadata()
    {
        return $this->attributes->mayHave('metadata')->asString(function ($metadata) {
//            return mb_strlen($metadata) <= 100;
            return strlen($metadata) <= 100;
        });
    }

    public function toArray()
    {
        return array_filter(array(
            'object_purpose'      => $this->getObjectPurpose(),
            'address_from'        => $this->getAddressFrom(),
            'address_to'          => $this->getAddressTo(),
            'parcel'              => $this->getParcel(),
            'submission_type'     => $this->getSubmissionType(),
            'return_of'           => $this->getReturnOf(),
            'submission_date'     => $this->getSubmissionDate(),
            'address_return'      => $this->getAddressReturn(),
            'customs_declaration' => $this->getCustomsDeclaration(),
            'insurance_amount'    => $this->getInsuranceAmount(),
            'insurance_currency'  => $this->getInsuranceCurrency(),
            'extra'               => $this->getExtra(),
            'reference_1'         => $this->getReference1(),
            'reference_2'         => $this->getReference2(),
            'carrier_accounts'    => $this->getCarrierAccounts(),
            'metadata'            => $this->getMetadata(),
        ));
    }
}
