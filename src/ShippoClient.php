<?php
namespace ShippoClient;

use ShippoClient\Http\Request;

class ShippoClient
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function addresses()
    {
        return new Addresses($this->request);
    }

    /**
     * TODO:develop mode
     * @param string $accessToken
     * @return static
     */
    public static function provider($accessToken)
    {
        $request = new Request($accessToken);

        return new static($request);
    }
}
