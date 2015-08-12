<?php

namespace ShippoClient;

use ShippoClient\Http\Response\Shipments as ShipmentsResponse;
use ShippoClient\Http\Response\ShipmentsCollection as ShipmentsResponseCollection;
use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Shipments\CreateObject;

class Shipments
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(array $attributes)
    {
        $createObj = new CreateObject($attributes);
        $responseArray = $this->request->post('shipments', $createObj->toArray());

        return new ShipmentsResponse($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("shipments/$objectId");

        return new ShipmentsResponse($responseArray);
    }

    /**
     * @param null|int $results
     * @return ShipmentsResponseCollection
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("shipments", array('results' => $results));

        return new ShipmentsCollection($responseArray);
    }

}

