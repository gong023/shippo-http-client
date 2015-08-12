<?php
namespace ShippoClient\Http;

use Guzzle\Http\Client;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Exception\ClientErrorResponseException as GuzzleClientErrorException;
use Guzzle\Http\Exception\ServerErrorResponseException as GuzzleServerErrorException;
use ShippoClient\Http\Response\Exception\ClientErrorException;
use ShippoClient\Http\Response\Exception\ServerErrorException;

class Request
{
    const BASE_URI = 'https://api.goshippo.com/v1/';

    private $accessToken;
    private $delegated;

    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
        $this->delegated = new Client(static::BASE_URI, array(
            'request.options' => array(
                'headers' => array('Authorization' => 'ShippoToken ' . $this->getAccessToken()),
            )
        ));
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function post($endPoint, $body = array())
    {
        $request = $this->delegated->post($endPoint, null, $body);
        $guzzleResponse = $this->sendWithCheck($request);

        return $guzzleResponse->json();
    }

    public function get($endPoint, $parameter = array())
    {
        $queryString = http_build_query($parameter);
        $request = $this->delegated->get("$endPoint?$queryString");
        $guzzleResponse = $this->sendWithCheck($request);

        return $guzzleResponse->json();
    }

    private function sendWithCheck(RequestInterface $request)
    {
        try {
            return $request->send();
        } catch (GuzzleClientErrorException $e) {
            throw new ClientErrorException(
                $e->getMessage(),
                $e->getResponse()->getStatusCode(),
                explode("\r\n", $e->getRequest()->__toString()),
                explode("\r\n", $e->getResponse()->__toString())
            );
        } catch (GuzzleServerErrorException $e) {
            throw new ServerErrorException(
                $e->getMessage(),
                $e->getResponse()->getStatusCode(),
                explode("\r\n", $e->getRequest()->__toString()),
                explode("\r\n", $e->getResponse()->__toString())
            );
        }
    }
}
