<?php

namespace ShippoClient;

use ShippoClient\Http\Response\Refunds\Refund as RefundResponse;
use ShippoClient\Http\Response\Refunds\RefundCollection as RefundResponseCollection;
use ShippoClient\Http\Request;

class Refunds
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create($transactionObjectId)
    {
        $responseArray = $this->request->post('refunds', array('transaction' => $transactionObjectId));

        return new RefundResponse($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("refunds/$objectId");

        return new RefundResponse($responseArray);
    }

    /**
     * @param null|int $results
     * @return RefundResponseCollection
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("refunds", array('results' => $results));

        return new RefundResponseCollection($responseArray);
    }
}
