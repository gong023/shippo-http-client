<?php

namespace ShippoClientV2\Http\Parcels;

use ShippoClient\Http\Response\Exception\ClientErrorException;
use ShippoClient\ShippoClientV2;

/**
 * @property string accessToken
 */
class InvalidRequestTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->accessToken = getenv('SHIPPO_PRIVATE_ACCESS_TOKEN');
    }

    public function testRetrieveWithInvalidObjectId()
    {
        $this->assertNotFalse($this->accessToken, 'You should set env SHIPPO_PRIVATE_ACCESS_TOKEN.');
        try {
            ShippoClientV2::provider($this->accessToken)
                ->setRequestOption('curl.options', [
                    CURLOPT_ENCODING          => 'gzip',
                    CURLE_OPERATION_TIMEOUTED => 30,
                ])
                ->parcels()->retrieve('invalid objectId');
            $this->fail('ClientErrorException is expected');
        } catch (ClientErrorException $e) {
            $this->assertSame(404, $e->getStatusCode());
            $this->assertNotEmpty($e->getMessage());
            $this->assertInternalType('array', $e->getRequest());
            $this->assertInternalType('array', $e->getResponse());
        }
    }
}
