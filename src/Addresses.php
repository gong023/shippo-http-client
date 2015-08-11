<?php

namespace ShippoClient;

use ShippoClient\Addresses\Response as AddressesResponse;
use ShippoClient\Addresses\ResponseCollection as AddressesResponseCollection;
use ShippoClient\Http\Request;
use ShippoClient\Addresses\CreateRequest;

class Addresses
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(array $attributes)
    {
        $requestObj = new CreateRequest($attributes);
        $responseArray = $this->request->post('addresses', $requestObj->toArray());

        return new AddressesResponse($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("addresses/$objectId");

        return new AddressesResponse($responseArray);
    }

    public function validate($objectId)
    {
        $responseArray = $this->request->get("addresses/$objectId/validate");

        return new AddressesResponse($responseArray);
    }

    /**
     * @param null|int $results
     * @return AddressesResponseCollection
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("addresses", array('results' => $results));

        return new AddressesResponseCollection($responseArray);
    }
}
