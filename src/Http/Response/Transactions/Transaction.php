<?php

namespace ShippoClient\Http\Response\Transactions;

use ShippoClient\Attributes;
use ShippoClient\Http\Response;

class Transaction extends Response
{
    public function getObjectStatus()
    {
        return $this->attributes->mayHave('object_status')->asString();
    }
    public function getWasTest()
    {
        return $this->attributes->mayHave('was_test')->asBoolean();
    }

    public function getRate()
    {
        return $this->attributes->mayHave('rate')->asString();
    }

    public function getTrackingNumber()
    {
        return $this->attributes->mayHave('tracking_number')->asString();
    }

    public function getTrackingStatus()
    {
        return $this->attributes->mayHave('tracking_status')->asArray();
    }

    public function getTrackingUrlProvider()
    {
        return $this->attributes->mayHave('tracking_url_provider')->asString();
    }

    public function getLabelUrl()
    {
        return $this->attributes->mayHave('label_url')->asString();
    }

    public function getCommercialInvoiceUrl()
    {
        return $this->attributes->mayHave('commercial_invoice_url')->asString();
    }

    public function getMessages()
    {
        return $this->attributes->mayHave('messages')->asArray();
    }

    public function getCustomsNote()
    {
        return $this->attributes->mayHave('customs_note')->asString();
    }

    public function getSubmissionNote()
    {
        return $this->attributes->mayHave('submission_note')->asString();
    }

    public function getMetadata()
    {
        return $this->attributes->mayHave('metadata')->asString();
    }

    public function toArray()
    {
        return array(
            'object_state'           => $this->getObjectState(),
            'object_status'          => $this->getObjectStatus(),
            'object_created'         => $this->getObjectCreated(),
            'object_updated'         => $this->getObjectUpdated(),
            'object_id'              => $this->getObjectId(),
            'object_owner'           => $this->getObjectOwner(),
            'was_test'               => $this->getWasTest(),
            'rate'                   => $this->getRate(),
            'tracking_number'        => $this->getTrackingNumber(),
            'tracking_status'        => $this->getTrackingStatus(),
            'tracking_url_provider'  => $this->getTrackingUrlProvider(),
            'label_url'              => $this->getLabelUrl(),
            'commercial_invoice_url' => $this->getCommercialInvoiceUrl(),
            'messages'               => $this->getMessages(),
            'customs_note'           => $this->getCustomsNote(),
            'submission_note'        => $this->getSubmissionNote(),
            'metadata'               => $this->getMetadata(),
        );
    }
}

