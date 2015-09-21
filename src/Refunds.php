<?php

namespace ShippoClient;

use ShippoClient\Entity\Refund;
use ShippoClient\Http\Request;
use ShippoClient\Http\Response\RefundList;

class Refunds
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create($transactionObjectId)
    {
        $responseArray = $this->request->post('refunds', ['transaction' => $transactionObjectId]);

        return new Refund($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("refunds/$objectId");

        return new Refund($responseArray);
    }

    /**
     * @param null|int $results
     * @return RefundList
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("refunds", ['results' => $results]);

        return new RefundList($responseArray);
    }
}
