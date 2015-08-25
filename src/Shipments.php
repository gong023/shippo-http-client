<?php

namespace ShippoClient;

use ShippoClient\Http\Response\Shipments\Shipment as ShipmentResponse;
use ShippoClient\Http\Response\Shipments\ShipmentCollection as ShipmentResponseCollection;
use ShippoClient\Http\Response\Rates\RateCollection as RateResponseCollection;
use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Shipments\CreateObject;
use ShippoClient\Http\Request\Shipments\CreateObjectByNested;

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

        return new ShipmentResponse($responseArray);
    }

    public function createByNestedCall(array $attributes)
    {
        $createObj = new CreateObjectByNested($attributes);
        $responseArray = $this->request->postWithJsonBody('shipments', $createObj->toArray());

        return new ShipmentResponse($responseArray);
    }

    public function createReturn()
    {
        // TODO
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("shipments/$objectId");

        return new ShipmentResponse($responseArray);
    }

    /**
     * @param null|int $results
     * @return ShipmentResponseCollection
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("shipments", array('results' => $results));

        return new ShipmentResponseCollection($responseArray);
    }

    public function getRatesList($objectId, $currencyCode = '')
    {
        $responseArray = $this->request->get("shipments/$objectId/rates/$currencyCode");

        return new RateResponseCollection($responseArray);
    }
}
