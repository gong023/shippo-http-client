<?php

namespace ShippoClient;

use ShippoClient\Addresses\Response as AddressesResponse;
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
}
