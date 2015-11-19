<?php
namespace ShippoClient\Http;

use Guzzle\Http\Client;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Exception\ClientErrorResponseException as GuzzleClientErrorException;
use Guzzle\Http\Exception\ServerErrorResponseException as GuzzleServerErrorException;
use ShippoClient\Http\Request\MockCollection;
use ShippoClient\Http\Response\Exception\ClientErrorException;
use ShippoClient\Http\Response\Exception\ServerErrorException;

class Request
{
    const BASE_URI = 'https://api.goshippo.com/v1/';

    private $delegated;
    private $mockContainer;

    public function __construct($accessToken)
    {
        $this->delegated = new Client(static::BASE_URI, [
            'request.options' => [
                'headers' => ['Authorization' => 'ShippoToken ' . $accessToken],
            ]
        ]);
        $this->mockContainer = MockCollection::getInstance();
    }

    public function post($endPoint, $body = [])
    {
        $this->mockFilter($endPoint);
        $request = $this->delegated->post($endPoint, null, $body);
        $guzzleResponse = $this->sendWithCheck($request);

        return $guzzleResponse->json();
    }

    public function postWithJsonBody($endPoint, $body = [])
    {
        $this->mockFilter($endPoint);
        $request = $this->delegated->post($endPoint, ['Content-Type' => 'application/json']);
        $request->setBody(json_encode($body));
        $guzzleResponse = $this->sendWithCheck($request);

        return $guzzleResponse->json();
    }

    public function get($endPoint, $parameter = [])
    {
        $this->mockFilter($endPoint);
        $queryString = http_build_query($parameter);
        $request = $this->delegated->get("$endPoint?$queryString");
        $guzzleResponse = $this->sendWithCheck($request);

        return $guzzleResponse->json();
    }

    public function setDefaultOption($keyOrPath, $value)
    {
        $this->delegated->setDefaultOption($keyOrPath, $value);
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

    /**
     * ダサい
     *
     * @param $endPoint
     */
    private function mockFilter($endPoint)
    {
        if ($this->mockContainer->has($endPoint)) {
            $this->delegated->addSubscriber($this->mockContainer->getMockResponse($endPoint));
            $this->mockContainer->clear();
        }
    }
}
