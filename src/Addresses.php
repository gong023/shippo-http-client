<?php

namespace ShippoClient;

use ShippoClient\Http\Request;
use ShippoClient\Addresses\Request as RequestObj;

class Addresses
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create(array $attributes)
    {
        $requestObj = new RequestObj($attributes);

        return $this->request->post('addresses', $requestObj->getRequestArray());
    }
}
