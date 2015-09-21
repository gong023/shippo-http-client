<?php

namespace ShippoClient;

use ShippoClient\Entity\Shipment;
use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Shipments\CreateObject;
use ShippoClient\Http\Request\Shipments\CreateObjectByNested;
use ShippoClient\Http\Response\RateList;
use ShippoClient\Http\Response\ShipmentList;

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

        return new Shipment($responseArray);
    }

    public function createByNestedCall(array $attributes)
    {
        $createObj = new CreateObjectByNested($attributes);
        $responseArray = $this->request->postWithJsonBody('shipments', $createObj->toArray());

        return new Shipment($responseArray);
    }

    public function createReturn()
    {
        // TODO
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("shipments/$objectId");

        return new Shipment($responseArray);
    }

    /**
     * @param null|int $results
     * @return ShipmentList
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("shipments", ['results' => $results]);

        return new ShipmentList($responseArray);
    }

    public function getRateList($objectId, $currencyCode = '')
    {
        $responseArray = $this->request->get("shipments/$objectId/rates/$currencyCode");

        return new RateList($responseArray);
    }
}
