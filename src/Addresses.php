<?php

namespace ShippoClient;

use ShippoClient\Http\Response\Addresses\Address as AddressResponse;
use ShippoClient\Http\Response\Addresses\AddressCollection as AddressResponseCollection;
use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Addresses\CreateObject;

class Addresses
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(array $attributes)
    {
        $createObj = new CreateObject($attributes);
        $responseArray = $this->request->post('addresses', $createObj->toArray());

        return new AddressResponse($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("addresses/$objectId");

        return new AddressResponse($responseArray);
    }

    public function validate($objectId)
    {
        $responseArray = $this->request->get("addresses/$objectId/validate");

        return new AddressResponse($responseArray);
    }

    /**
     * @param null|int $results
     * @return AddressResponseCollection
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("addresses", array('results' => $results));

        return new AddressResponseCollection($responseArray);
    }
}
