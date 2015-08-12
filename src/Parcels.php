<?php

namespace ShippoClient;

use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Parcels\CreateObject;
use ShippoClient\Http\Response\Parcels as ParcelsResponse;

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
}