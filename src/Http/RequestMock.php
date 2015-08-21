<?php

namespace ShippoClient\Http;

use ShippoClient\Http\Response\Exception\ClientErrorException;
use ShippoClient\Http\Response\Exception\ServerErrorException;

class RequestMock
{
    private static $container;

    /**
     * @var \ShippoClient\Http\Request
     */
    private $default;

    public function __construct($default)
    {
        $this->default = $default;
    }

    public function post($endPoint, $body = array())
    {
        if (array_key_exists($endPoint, static::$container)) {
            return $this->sendWithCheck(static::$container['statusCode'], $body, static::$container['response']);
        }

        return $this->default->post($endPoint, $body);
    }

    public function get($endPoint, $parameter = array())
    {
        if (array_key_exists($endPoint, static::$container)) {
            return $this->sendWithCheck(static::$container['statusCode'], http_build_query($parameter), static::$container['response']);
        }

        return $this->default->get($endPoint, $parameter);
    }

    private function sendWithCheck($statusCode, $sendBody, $responseBody)
    {
        if ($statusCode >= 400) {
            throw new ClientErrorException(
                'client exception from mock',
                $statusCode,
                $sendBody,
                $responseBody
            );
        }

        if ($statusCode >= 500) {
            throw new ServerErrorException(
                'server exception from mock',
                $statusCode,
                $sendBody,
                $responseBody
            );
        }

        return $responseBody;
    }

    public static function set($path, $statusCode, array $response)
    {
        static::$container[$path] = array(
            'statusCode' => $statusCode,
            'response'   => $response,
        );
    }
}
