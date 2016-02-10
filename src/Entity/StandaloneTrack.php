<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class StandaloneTrack
{
    use ReadableAttributes {
        mayHaveAsString as public getCarrier;
        mayHaveAsString as public getTrackingNumber;
        toArray as public __toArray;
    }

    /**
     * @return \ShippoClient\Entity\TrackingStatus
     */
    public function getTrackingStatus()
    {
        $tracking_status = $this->attributes->mayHave('tracking_status');

        if (!$tracking_status->value()) {
            return new TrackingStatus();
        }

        return $tracking_status->asInstanceOf('\\ShippoClient\\Entity\\TrackingStatus');
    }

    /**
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
            'carrier'          => $this->getCarrier(),
            'tracking_number'  => $this->getTrackingNumber(),
            'tracking_status'  => $this->getTrackingStatus()->toArray(),
            'tracking_history' => $this->getTrackingHistory()->toArray(),
        ];
    }
}
