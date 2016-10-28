<?php

namespace ShippoClient;

use ShippoClient\Entity\Tracks as TracksResponse;
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

        return new TracksResponse($responseArray);
    }

    public function create($carrier, $trackingNumber, $metadata = null)
    {
        $responseArray = $this->request->post('tracks/', [
            'carrier'         => $carrier,
            'tracking_number' => $trackingNumber,
            'metadata'        => $metadata,
        ]);

        return new TracksResponse($responseArray);
    }
}
