<?php

namespace ShippoClient\Entity;

use ShippoClient\Attributes;

class Transaction extends RootEntity
{
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
     * @return bool
     */
    public function getNotificationEmailFrom()
    {
        return $this->attributes->mayHave('notification_email_from')->asBoolean();
    }

    /**
     * @return bool
     */
    public function getNotificationEmailTo()
    {
        return $this->attributes->mayHave('notification_email_to')->asBoolean();
    }

    /**
     * @return string
     */
    public function getNotificationEmailOther()
    {
        return $this->attributes->mayHave('notification_email_other')->asString();
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
        $attributes = $this->attributes->mayHave('tracking_status')->asArray();
        return new TrackingStatus($attributes);
    }

    /**
     * @return TrackingHistory
     */
    public function getTrackingHistory()
    {
        $attributes = $this->attributes->mayHave('tracking_history')->asArray();
        $entities = [];
        foreach ($attributes as $attribute) {
            $entities[] = new TrackingStatus($attribute);
        }
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
     * @return string
     */
    public function getCustomsNote()
    {
        return $this->attributes->mayHave('customs_note')->asString();
    }

    /**
     * @return string
     */
    public function getSubmissionNote()
    {
        return $this->attributes->mayHave('submission_note')->asString();
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
        return [
            'object_state'             => $this->getObjectState(),
            'object_status'            => $this->getObjectStatus(),
            'object_created'           => $this->getObjectCreated(),
            'object_updated'           => $this->getObjectUpdated(),
            'object_id'                => $this->getObjectId(),
            'object_owner'             => $this->getObjectOwner(),
            'was_test'                 => $this->getWasTest(),
            'rate'                     => $this->getRate(),
            'pickup_date'              => $this->getPickUpDate(),
            'notification_email_from'  => $this->getNotificationEmailFrom(),
            'notification_email_to'    => $this->getNotificationEmailTo(),
            'notification_email_other' => $this->getNotificationEmailOther(),
            'tracking_number'          => $this->getTrackingNumber(),
            'tracking_status'          => $this->getTrackingStatus()->toArray(),
            'tracking_history'         => $this->getTrackingHistory()->toArray(),
            'tracking_url_provider'    => $this->getTrackingUrlProvider(),
            'label_url'                => $this->getLabelUrl(),
            'commercial_invoice_url'   => $this->getCommercialInvoiceUrl(),
            'messages'                 => $this->getMessages(),
            'customs_note'             => $this->getCustomsNote(),
            'submission_note'          => $this->getSubmissionNote(),
            'order'                    => $this->getOrder(),
            'metadata'                 => $this->getMetadata(),
        ];
    }
}
