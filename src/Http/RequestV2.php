<?php

namespace ShippoClient\Http;

class RequestV2 extends Request
{
    const BASE_URI = 'https://api.goshippo.com/';

    /**
     * @param $accessToken
     * @param null $apiVersion
     */
    public function __construct($accessToken, $apiVersion = null)
    {
        parent::__construct($accessToken);
        $request_headers = ['Authorization' => 'ShippoToken ' . $accessToken];
        if ($apiVersion) {
            $request_headers['Shippo-API-Version'] = $apiVersion;
        }

        $this->delegated->setConfig(['request.options' => ['headers' => $request_headers]]);
    }
}
