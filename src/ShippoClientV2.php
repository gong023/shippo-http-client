<?php

namespace ShippoClient;

use ShippoClient\Http\Request\MockCollection;
use ShippoClient\Http\RequestV2;

class ShippoClientV2
{
    /**
     * @var RequestV2
     */
    private $request;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var static|null
     */
    private static $instance = null;

    private function __construct(RequestV2 $request)
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

    public function tracks()
    {
        return new Tracks($this->request);
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setRequestOption($keyOrPath, $value)
    {
        $this->request->setDefaultOption($keyOrPath, $value);

        return $this;
    }

    /**
     * @param string $accessToken
     * @param null|string $apiVersion
     * @return static
     */
    public static function provider($accessToken, $apiVersion = null)
    {
        if (static::$instance !== null && static::$instance->getAccessToken() === $accessToken) {
            return static::$instance;
        }

        static::$instance = new static(new RequestV2($accessToken, $apiVersion));

        return static::$instance;
    }

    public static function mock()
    {
        return MockCollection::getInstance();
    }
}
