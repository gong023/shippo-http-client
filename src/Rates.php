<?php

namespace ShippoClient;

use ShippoClient\Http\Response\Rates\Rate as RateResponse;
use ShippoClient\Http\Response\Rates\RateCollection as RateResponseCollection;
use ShippoClient\Http\Request;

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

        return new RateResponse($responseArray);
    }

    /**
     * @param null|int $results
     * @return RateResponseCollection
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("rates", array('results' => $results));

        return new RateResponseCollection($responseArray);
    }

}

