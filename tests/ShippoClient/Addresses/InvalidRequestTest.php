<?php

namespace ShippoClient\Addresses;

use ShippoClient\Http\Response\Exception\ClientErrorException;
use ShippoClient\ShippoClient;

/**
 * @property string accessToken
 */
class InvalidRequestTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->accessToken = getenv('SHIPPO_PRIVATE_ACCESS_TOKEN');
    }

    public function testWithInvalidPrivateToken()
    {
        try {
            ShippoClient::provider('invalid token')->addresses()->getList();
        } catch (ClientErrorException $e) {
            $this->assertSame(401, $e->getStatusCode());
            $this->assertNotEmpty($e->getMessage());
            $this->assertInternalType('array', $e->getRequest());
            $this->assertInternalType('array', $e->getResponse());
        }
    }

    public function testRetrieveWithInvalidObjectId()
    {
        $this->assertNotNull($this->accessToken, 'You should set env SHIPPO_PRIVATE_ACCESS_TOKEN.');
        try {
            ShippoClient::provider($this->accessToken)->addresses()->retrieve('invalid objectId');
            $this->fail('ClientErrorException is expected');
        } catch (ClientErrorException $e) {
            $this->assertSame(404, $e->getStatusCode());
            $this->assertNotEmpty($e->getMessage());
            $this->assertInternalType('array', $e->getRequest());
            $this->assertInternalType('array', $e->getResponse());
        }
    }

    public function testValidateWithInvalidObjectId()
    {
        $this->assertNotNull($this->accessToken, 'You should set env SHIPPO_PRIVATE_ACCESS_TOKEN.');
        try {
            ShippoClient::provider($this->accessToken)->addresses()->validate('invalid objectId');
            $this->fail('ClientErrorException is expected');
        } catch (ClientErrorException $e) {
            $this->assertSame(404, $e->getStatusCode());
            $this->assertNotEmpty($e->getMessage());
            $this->assertInternalType('array', $e->getRequest());
            $this->assertInternalType('array', $e->getResponse());
        }
    }
}
