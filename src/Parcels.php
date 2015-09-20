<?php

namespace ShippoClient;

use ShippoClient\Entity\Parcel;
use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Parcels\CreateObject;
use ShippoClient\Http\Response\ParcelList;

class Parcels
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(array $attributes)
    {
        $createObj = new CreateObject($attributes);
        $responseArray = $this->request->post('parcels', $createObj->toArray());

        return new Parcel($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("parcels/$objectId");

        return new Parcel($responseArray);
    }

    /**
     * @param null|int $results
     * @return ParcelList
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("parcels", ['results' => $results]);

        return new ParcelList($responseArray);
    }
}
