<?php
namespace ShippoClient\Http;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response as GuzzleResponse;
use ShippoClient\Http\Response\ClientErrorException;
use ShippoClient\Http\Response\ServerErrorException;

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
        $guzzleResponse = $this->delegated->post($endPoint, null, $body)->send();
        $this->checkError($guzzleResponse, $body);

        return $guzzleResponse->json();
    }

    public function get($endPoint, $parameter = array())
    {
        $queryString = http_build_query($parameter);
        $guzzleResponse = $this->delegated->get("$endPoint?$queryString")->send();
        $this->checkError($guzzleResponse, $parameter);

        return $guzzleResponse->json();
    }

    private function checkError(GuzzleResponse $response, array $request)
    {
        if ($response->isClientError()) {
            $responseArray = $response->serialize();
            throw new ClientErrorException(
              $response->getMessage(),
              $responseArray['status'],
              $request,
              $responseArray['body']
          );
        }

        if ($response->isServerError()) {
            $responseArray = $response->serialize();
            throw new ServerErrorException(
              $response->getMessage(),
              $responseArray['status'],
              $request,
              $responseArray['body']
          );
        }
    }
}
