<?php

namespace ShippoClient\Http\Response;

class BadResponseException extends \Exception
{
    private $statusCode;
    private $request;
    private $response;

  /**
   * @param string $message
   * @param int $statusCode
   * @param mixed $request
   * @param mixed $response
   */
    public function __construct($message, $statusCode, $request, $response)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->request = $request;
        $this->response = $response;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
