<?php

namespace ShippoClient;

use ShippoClient\Entity\Address;
use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Addresses\CreateObject;
use ShippoClient\Http\Response\AddressList;

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

        return new Address($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("addresses/$objectId");

        return new Address($responseArray);
    }

    public function validate($objectId)
    {
        $responseArray = $this->request->get("addresses/$objectId/validate");

        return new Address($responseArray);
    }

    /**
     * @param null|int $results
     * @return AddressList
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("addresses", array('results' => $results));

        return new AddressList($responseArray);
    }
}
