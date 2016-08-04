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
        return new TrackingStatus($this->attributes->mayHave('tracking_status')->asArray());
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
        $addressFrom = $this->attributes->mayHave('address_from')->asArray();

        return new Location($addressFrom);
    }

    /**
     * @return \ShippoClient\Entity\Location
     */
    public function getAddressTo()
    {
        $addressTo = $this->attributes->mayHave('address_to')->asArray();

        return new Location($addressTo);
    }

    /**
     * @return \ShippoClient\Entity\ServiceLevel
     */
    public function getServiceLevel()
    {
        $serviceLevel = $this->attributes->mayHave('servicelevel')->asArray();

        return new ServiceLevel($serviceLevel);
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
