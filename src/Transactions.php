<?php

namespace ShippoClient;

use ShippoClient\Entity\Transaction;
use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Transactions\CreateObject;
use ShippoClient\Http\Response\TransactionList;

class Transactions
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function purchase($rateObjectId)
    {
        $createObject = new CreateObject(['rate' => $rateObjectId]);
        $responseArray = $this->request->post("transactions", $createObject->toArray());

        return new Transaction($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("transactions/$objectId");

        return new Transaction($responseArray);
    }

    /**
     * @param null|int $results
     * @return TransactionList
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("transactions", ['results' => $results]);

        return new TransactionList($responseArray);
    }
}
