<?php

namespace ShippoClient\Http\Request;

use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;
use ShippoClient\Http\Request;

class MockCollection
{
    /**
     * @var static|null
     */
    private static $instance = null;

    private static $container = [];

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (static::$instance !== null) {
            return static::$instance;
        }
        static::$instance = new static();

        return static::$instance;
    }

    public function has($endPoint)
    {
        return array_key_exists($endPoint, static::$container);
    }

    /**
     * @param string $endPoint
     * @return MockPlugin
     */
    public function getMockResponse($endPoint)
    {
        $response = new Response(static::$container[$endPoint]['statusCode']);
        $response->setBody(json_encode(static::$container[$endPoint]['response']));
        $mock = new MockPlugin();
        $mock->addResponse($response);

        return $mock;
    }

    public function add($path, $statusCode, $response)
    {
        static::$container[$path] = [
            'statusCode' => $statusCode,
            'response'   => $response,
        ];

        return $this;
    }

    public function clear()
    {
        static::$container = [];
    }
}
