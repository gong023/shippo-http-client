<?php

namespace ShippoClient\Entity;

use TurmericSpice\Container;
use TurmericSpice\ReadableAttributes;

class Transaction extends ObjectInformation
{
    use ReadableAttributes {
        mayHaveAsString  as public getCustomsNote;
        mayHaveAsString  as public getSubmissionNote;
        mayHaveAsString  as public getMetadata;
        mayHaveAsBoolean as public getNotificationEmailFrom;
        mayHaveAsBoolean as public getNotificationEmailTo;
        mayHaveAsString  as public getNotificationEmailOther;
        toArray          as public __toArray;
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

    /**
     * Indicates the status of the Transaction.
     *  - "WAITING"
     *  - "QUEUED"
     *  - "SUCCESS"
     *  - "ERROR"
     *  - "REFUNDED"
     *  - "REFUNDPENDING"
     *  - "REFUNDREJECTED"
     *
     * @return string
     */
    public function getObjectStatus()
    {
        return $this->attributes->mayHave('object_status')->asString();
    }

    /**
     * Indicates whether the transaction has been sent to the corresponding carrier's test or production server.
     *
     * @return bool
     */
    public function getWasTest()
    {
        return $this->attributes->mayHave('was_test')->asBoolean();
    }

    /**
     * Rate object id.
     *
     * @return string
     */
    public function getRate()
    {
        return $this->attributes->mayHave('rate')->asString();
    }

    /**
     * @return mixed|null
     */
    public function getPickUpDate()
    {
        return $this->attributes->mayHave('pickup_date')->value();
    }

    /**
     * The carrier-specific tracking number that can be used to track the Shipment.
     * A value will only be returned if the Rate is for a trackable Shipment and if the Transactions has been processed successfully.
     *
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->attributes->mayHave('tracking_number')->asString();
    }

    /**
     * The tracking information we currently have on file for this shipment. We regularly update this information.
     *
     * @return TrackingStatus
     */
    public function getTrackingStatus()
    {
        return new TrackingStatus($this->attributes->mayHave('tracking_status')->asArray());
    }

    /**
     * @return TrackingHistory
     */
    public function getTrackingHistory()
    {
        $entities = $this->attributes->mayHave('tracking_history')
            ->asInstanceArray('ShippoClient\\Entity\\TrackingStatus');

        return new TrackingHistory($entities);
    }

    /**
     * A link to track this item on the carrier-provided tracking website.
     * A value will only be returned if tracking is available and the carrier provides such a service.
     *
     * @return string
     */
    public function getTrackingUrlProvider()
    {
        return $this->attributes->mayHave('tracking_url_provider')->asString();
    }

    /**
     * A URL pointing directly to the label in the format you've set in your settings.
     * A value will only be returned if the Transactions has been processed successfully.
     *
     * @return string
     */
    public function getLabelUrl()
    {
        return $this->attributes->mayHave('label_url')->asString();
    }

    /**
     * A URL pointing to the commercial invoice as a 8.5x11 inch PDF file.
     * A value will only be returned if the Transactions has been processed successfully and if the shipment is international.
     *
     * @return string
     */
    public function getCommercialInvoiceUrl()
    {
        return $this->attributes->mayHave('commercial_invoice_url')->asString();
    }

    /**
     * An array containing elements of the following schema:
     * "code" (string): an identifier for the corresponding message (not always available")
     * "message" (string): a publishable message containing further information.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->attributes->mayHave('messages')->asArray();
    }

    /**
     * @return mixed|null
     */
    public function getOrder()
    {
        return $this->attributes->mayHave('order')->value();
    }

    /**
     * @return string
     */
    public function getMetadata()
    {
        return $this->attributes->mayHave('metadata')->asString();
    }

    public function toArray()
    {
        $array = $this->__toArray();
        $array['tracking_status'] = $this->getTrackingStatus()->toArray();
        $array['tracking_history'] = $this->getTrackingHistory()->toArray();

        return $array;
    }
}
