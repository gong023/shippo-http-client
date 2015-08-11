<?php

namespace ShippoClient;

class ShippoClientTest extends \PHPUnit_Framework_TestCase
{
    private static $accessToken = null;

    public function setUp()
    {
        self::$accessToken = getenv('SHIPPO_PRIVATE_ACCESS_TOKEN');
    }

    public function testCreateAddress()
    {
        $this->assertNotNull(self::$accessToken, 'You should set env SHIPPO_PRIVATE_ACCESS_TOKEN.');

        $param = array(
            "object_purpose" => "PURCHASE",
            "name" => "Shawn Ippotle",
            "company" => "Shippo",
            "street1" => "215 Clayton St.",
            "street2" => "",
            "city" => "San Francisco",
            "state" => "CA",
            "zip" => "94117",
            "country" => "US",
            "phone" => "+1 555 341 9393",
            "email" => "api@goshippo.com",
            "is_residential" => true,
            "metadata" => "Customer ID 123456"
        );
        $response = ShippoClient::provider(self::$accessToken)->addresses()->create($param);

        $this->assertInstanceOf('ShippoClient\\Http\\Response\\Addresses', $response);
        $responseArray = $response->toArray();
        $this->assertSame('VALID', $responseArray['object_state']);
        $this->assertSame('FULLY_ENTERED', $responseArray['object_source']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $responseArray['object_created']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $responseArray['object_updated']);
        $this->assertNotEmpty($responseArray['object_id']);
        $this->assertNotEmpty($responseArray['object_owner']);
        $this->assertSame('Shawn Ippotle', $responseArray['name']);
        $this->assertSame('Shippo', $responseArray['company']);
        $this->assertSame("", $responseArray['street_no']);
        $this->assertSame("215 Clayton St.", $responseArray['street1']);
        $this->assertSame("", $responseArray['street2']);
        $this->assertSame("San Francisco", $responseArray['city']);
        $this->assertSame("CA", $responseArray['state']);
        $this->assertSame("94117", $responseArray['zip']);
        $this->assertSame("US", $responseArray['country']);
        $this->assertSame("0015553419393", $responseArray['phone']); // casted
        $this->assertSame("api@goshippo.com", $responseArray['email']); // casted
        $this->assertTrue($responseArray['is_residential']);
        $this->assertSame("", $responseArray['ip']);
        $this->assertInternalType('array', $responseArray['messages']);
        $this->assertSame("Customer ID 123456", $responseArray['metadata']);

        return $response->getObjectId();
    }

    /**
     * @depends testCreateAddress
     * @param $objectId
     */
    public function testRetrieve($objectId)
    {
        $response = ShippoClient::provider(self::$accessToken)->addresses()->retrieve($objectId);

        $this->assertInstanceOf('ShippoClient\\Http\\Response\\Addresses', $response);
    }

    /**
     * @depends testCreateAddress
     * @param $objectId
     * @return string
     */
    public function testValidate($objectId)
    {
        $response = ShippoClient::provider(self::$accessToken)->addresses()->validate($objectId);

        $this->assertInstanceOf('ShippoClient\\Http\\Response\\Addresses', $response);
    }

    /**
     * @depends testCreateAddress
     */
    public function testGetList()
    {
        $response = ShippoClient::provider(self::$accessToken)->addresses()->getList();

        $this->assertInstanceOf('ShippoClient\\Http\\Response\\AddressesCollection', $response);
        $responseArray = $response->toArray();
        $this->assertGreaterThanOrEqual(1, $responseArray['count']);
        $this->assertArrayHasKey('next', $responseArray);
        $this->assertArrayHasKey('previous', $responseArray);
        $this->assertContainsOnlyInstancesOf('ShippoClient\\Http\\Response\\Addresses', $responseArray['results']);
    }
}
