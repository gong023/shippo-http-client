<?php
namespace ShippoClient;

use ShippoClient\Http\Request;

class ShippoClient
{
    private $request;
    private $accessToken;
    private static $instance = null;

    private function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function addresses()
    {
        return new Addresses($this->request);
    }

    public function parcels()
    {
        return new Parcels($this->request);
    }

    public function shipments()
    {
        return new Shipments($this->request);
    }

    public function rates()
    {
        return new Rates($this->request);
    }

    public function transactions()
    {
        return new Transactions($this->request);
    }

    public function refunds()
    {
        return new Refunds($this->request);
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * TODO:develop mode
     * @param string $accessToken
     * @return static
     */
    public static function provider($accessToken)
    {
        if (static::$instance !== null) {
            return static::$instance;
        }

        $request = new Request($accessToken);

        return new static($request);
    }

    public static function setMock($endPoint, $status, $body)
    {
    }
}
