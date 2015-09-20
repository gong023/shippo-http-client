<?php

namespace ShippoClient;

use ShippoClient\Entity\Rate;
use ShippoClient\Http\Request;
use ShippoClient\Http\Response\RateList;

class Rates
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("rates/$objectId");

        return new Rate($responseArray);
    }

    /**
     * @param null|int $results
     * @return RateList
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("rates", ['results' => $results]);

        return new RateList($responseArray);
    }
}
