<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class Tracks
{
    use ReadableAttributes {
        mayHaveAsString as public getCarrier;
        mayHaveAsString as public getTrackingNumber;
        mayHaveAsString as public getEta;
        toArray as public __toArray;
    }

    /**
     * @return \ShippoClient\Entity\TrackingStatus
     */
    public function getTrackingStatus()
    {
        return $this->attributes->mayHave('tracking_status')
            ->asInstanceOf('\\ShippoClient\\Entity\\TrackingStatus');
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

    /**
     * @return \ShippoClient\Entity\Location
     */
    public function getAddressFrom()
    {
        return $this->attributes->mayHave('address_from')->asInstanceOf('\\ShippoClient\\Entity\\Location');
    }

    /**
     * @return \ShippoClient\Entity\Location
     */
    public function getAddressTo()
    {
        return $this->attributes->mayHave('address_to')->asInstanceOf('\\ShippoClient\\Entity\\Location');
    }

    /**
     * @return \ShippoClient\Entity\ServiceLevel
     */
    public function getServiceLevel()
    {
        return $this->attributes->mayHave('servicelevel')->asInstanceOf('\\ShippoClient\\Entity\\ServiceLevel');
    }

    public function toArray()
    {
        return [
            'carrier'          => $this->getCarrier(),
            'tracking_number'  => $this->getTrackingNumber(),
            'tracking_status'  => $this->getTrackingStatus()->toArray(),
            'tracking_history' => $this->getTrackingHistory()->toArray(),
            'eta'              => $this->getEta(),
            'address_from'     => $this->getAddressFrom()->toArray(),
            'address_to'       => $this->getAddressTo()->toArray(),
            'servicelevel'     => $this->getServiceLevel()->toArray(),
        ];
    }
}
