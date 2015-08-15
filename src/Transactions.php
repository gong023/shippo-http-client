<?php

namespace ShippoClient;

use ShippoClient\Http\Response\Transactions\Transaction as TransactionsResponse;
use ShippoClient\Http\Response\Transactions\TransactionCollection as TransactionsResponseCollection;
use ShippoClient\Http\Request;
use ShippoClient\Http\Request\Transactions\CreateObject;

class Transactions
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function purchase($rateObjectId)
    {
        $createObject = new CreateObject(array('rate' => $rateObjectId));
        $responseArray = $this->request->post("transactions", $createObject->toArray());

        return new TransactionsResponse($responseArray);
    }

    public function retrieve($objectId)
    {
        $responseArray = $this->request->get("transactions/$objectId");

        return new TransactionsResponse($responseArray);
    }

    /**
     * @param null|int $results
     * @return TransactionsResponseCollection
     */
    public function getList($results = null)
    {
        $responseArray = $this->request->get("transactions", array('results' => $results));

        return new TransactionsResponseCollection($responseArray);
    }

}

