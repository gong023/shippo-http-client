<?php

namespace ShippoClient\Http\Request\Shipments;

use ShippoClient\Http\Request\Addresses\CreateObject as AddressCreate;
use ShippoClient\Http\Request\Parcels\CreateObject as ParcelCreate;

class CreateObjectByNested extends CreateObject
{
    public function getAddressFrom()
    {
        $addressFrom = $this->attributes->mustHave('address_from')->asArray();
        $addressFromObj = new AddressCreate($addressFrom);

        return $addressFromObj->toArray();
    }

    public function getAddressTo()
    {
        $addressTo = $this->attributes->mustHave('address_to')->asArray();
        $addressToObj = new AddressCreate($addressTo);

        return $addressToObj->toArray();
    }

    public function getParcel()
    {
        $parcel = $this->attributes->mustHave('parcel')->asArray();
        $parcelObj = new ParcelCreate($parcel);

        return $parcelObj->toArray();
    }
}
