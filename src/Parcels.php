<?php

namespace ShippoClient;

use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Parcels\CreateObject;
use ShippoClient\Http\Response\Parcels as ParcelsResponse;
use ShippoClient\Http\Response\ParcelsCollection as ParcelsResponseCollection;

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

        return new ParcelsResponse($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("parcels/$objectId");

        return new ParcelsResponse($responseArray);
    }

    /**
     * @param null|int $results
     * @return ParcelsResponseCollection
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("parcels", array('results' => $results));

        return new ParcelsResponseCollection($responseArray);
    }
}
