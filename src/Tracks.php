<?php

namespace ShippoClient;

use ShippoClient\Entity\StandaloneTrack;
use ShippoClient\Http\Request;

class Tracks
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getStandaloneTrack($carrier, $trackingNumber)
    {
        $responseArray = $this->request->get("tracks/$carrier/$trackingNumber");

        return new StandaloneTrack($responseArray);
    }
}

