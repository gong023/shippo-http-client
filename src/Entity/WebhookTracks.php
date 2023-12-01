<?php

namespace ShippoClient\Entity;

use TurmericSpice\Container\OptionalValue;
use TurmericSpice\ReadableAttributes;

/**
 * response type is different between each carrier.
 * if carrier label is generated via shippo, you will get type same to Transaction object.
 * if not, you will get type same to Tracks object.
 */
class WebhookTracks
{
    use ReadableAttributes {
        // tracks object properties
        mayHaveAsString as public getCarrier;
        mayHaveAsString as public getEta;
        // transaction object properties
        mayHaveAsString as public getObjectState;
        mayHaveAsString as public getObjectStatus;
        mayHaveAsString as public getObjectId;
        mayHaveAsString as public getObjectOwner;
        mayHaveAsString as public getLabelUrl;
        mayHaveAsString as public getTrackingUrlProvider;
        mayHaveAsString as public getCommercialInvoiceUrl;
        mayHaveAsString as public getCustomsNote;
        mayHaveAsString as public getSubmissionNote;
        mayHaveAsString as public getMetadata;
        mayHaveAsArray  as public getMessages;
        // common properties
        mayHaveAsString as public getTrackingNumber;
        toArray as public __toArray;
    }

    /**
     * transaction object property
     *
     * @return \DateTime
     */
    public function getObjectCreated()
    {
        $optionalValue = $this->attributes->mayHave('object_created');
        if ($optionalValue->value() === null) {
            $optionalValue = new OptionalValue('object_created', '');
        }

        return $optionalValue->asInstanceOf('\\DateTime');
    }

    /**
     * transaction object property
     *
     * @return \DateTime
     */
    public function getObjectUpdated()
    {
        $optionalValue = $this->attributes->mayHave('object_updated');
        if ($optionalValue->value() === null) {
            $optionalValue = new OptionalValue('object_updated', '');
        }

        return $optionalValue->asInstanceOf('\\DateTime');
    }

    /**
     * tracks object property
     *
     * @return \ShippoClient\Entity\Location
     */
    public function getAddressFrom()
    {
        $addressFrom = $this->attributes->mayHave('address_from')->asArray();

        return new Location($addressFrom);
    }

    /**
     * tracks object property
     *
     * @return \ShippoClient\Entity\Location
     */
    public function getAddressTo()
    {
        $addressTo = $this->attributes->mayHave('address_to')->asArray();

        return new Location($addressTo);
    }

    /**
     * tracks object property
     *
     * @return \ShippoClient\Entity\ServiceLevel
     */
    public function getServiceLevel()
    {
        $serviceLevel = $this->attributes->mayHave('servicelevel')->asArray();

        return new ServiceLevel($serviceLevel);
    }

    /**
     * common property
     *
     * @return \ShippoClient\Entity\TrackingStatus
     */
    public function getTrackingStatus()
    {
        return new TrackingStatus($this->attributes->mayHave('tracking_status')->asArray());
    }

    /**
     * common property
     *
     * @return \ShippoClient\Entity\TrackingHistory
     */
    public function getTrackingHistory()
    {
        $entities = $this->attributes->mayHave('tracking_history')
            ->asInstanceArray('ShippoClient\\Entity\\TrackingStatus');

        return new TrackingHistory($entities);
    }

    public function toArray()
    {
        return [
            // tracks
            'carrier'                => $this->getCarrier(),
            'tracking_number'        => $this->getTrackingNumber(),
            'tracking_status'        => $this->getTrackingStatus()->toArray(),
            'tracking_history'       => $this->getTrackingHistory()->toArray(),
            'eta'                    => $this->getEta(),
            'address_from'           => $this->getAddressFrom()->toArray(),
            'address_to'             => $this->getAddressTo()->toArray(),
            'servicelevel'           => $this->getServiceLevel()->toArray(),
            // transaction
            'object_state'           => $this->getObjectState(),
            'object_status'          => $this->getObjectStatus(),
            'object_created'         => $this->getObjectCreated(),
            'object_updated'         => $this->getObjectUpdated(),
            'object_id'              => $this->getObjectId(),
            'object_owner'           => $this->getObjectOwner(),
            'label_url'              => $this->getLabelUrl(),
            'tracking_url_provider'  => $this->getTrackingUrlProvider(),
            'commercial_invoice_url' => $this->getCommercialInvoiceUrl(),
            'customs_note'           => $this->getCustomsNote(),
            'submission_note'        => $this->getSubmissionNote(),
            'metadata'               => $this->getMetadata(),
            'messages'               => $this->getMessages(),
        ];
    }
}
