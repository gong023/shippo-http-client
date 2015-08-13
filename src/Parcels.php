<?php

namespace ShippoClient;

use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Parcels\CreateObject;
use ShippoClient\Http\Response\Parcels\Parcel as ParcelResponse;
use ShippoClient\Http\Response\Parcels\ParcelCollection as ParcelResponseCollection;

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

        return new ParcelResponse($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("parcels/$objectId");

        return new ParcelResponse($responseArray);
    }

    /**
     * @param null|int $results
     * @return ParcelResponseCollection
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("parcels", array('results' => $results));

        return new ParcelResponseCollection($responseArray);
    }
}
