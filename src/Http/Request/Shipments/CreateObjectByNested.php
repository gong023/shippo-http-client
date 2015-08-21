<?php

namespace ShippoClient\Http\Request\Shipments;

use ShippoClient\Http\Request\CommonParameter;
use ShippoClient\Http\Request\Addresses\CreateObject as AddressCreate;
use ShippoClient\Http\Request\Parcels\CreateObject as ParcelCreate;

class CreateObjectByNested extends CommonParameter
{
    public function getObjectPurpose()
    {
        return $this->attributes->mustHave('object_purpose')->asString();
    }

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

    public function getReference1()
    {
        return $this->attributes->mayHave('reference_1')->asString();
    }

    public function getReference2()
    {
        return $this->attributes->mayHave('reference_2')->asString();
    }

    public function toArray()
    {
        return array_filter(array(
            'object_purpose' => $this->getObjectPurpose(),
            'address_from'   => $this->getAddressFrom(),
            'address_to'     => $this->getAddressTo(),
            'parcel'         => $this->getParcel(),
            'reference_1'    => $this->getReference1(),
            'reference_2'    => $this->getReference2(),
            'metadata'       => $this->getMetadata(),
        ));
    }
}

