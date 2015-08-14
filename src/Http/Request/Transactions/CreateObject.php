<?php

namespace ShippoClient\Http\Request\Transactions;

use ShippoClient\Attributes\InvalidAttributeException;
use ShippoClient\Attributes;
use ShippoClient\Http\Request\CommonParameter;

/**
 * A Transaction is the purchase of a Shipment Label for a given Shipment Rate.
 * Transactions can be as simple as posting a Rate ID, but also allow you to define further parameters of the desired Label, such as pickup and notifications.
 * Transactions can only be created for Rates that are less than 7 days old and that have an object_purpose of "PURCHASE".
 * Transactions are created asynchronous. The response time depends exclusively on the carrier's server.
 */
class CreateObject extends CommonParameter
{
    /**
     * ID of the Rate object for which a Label has to be obtained.
     * Please note that only rates that are not older than 7 days can be purchased in order to ensure up-to-date pricing.
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getRate()
    {
        return $this->attributes->mustHave('rate')->asString();
    }

    public function toArray()
    {
        return array(
            'rate' => $this->getRate(),
            'metadata' => $this->getMetadata(),
        );
    }
}
