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

        $this->assertInstanceOf('ShippoClient\\Addresses\\Response', $response);

        return $response->getObjectId();
    }

    /**
     * @depends testCreateAddress
     * @param $objectId
     */
    public function testRetrieve($objectId)
    {
        $response = ShippoClient::provider(self::$accessToken)->addresses()->retrieve($objectId);

        $this->assertInstanceOf('ShippoClient\\Addresses\\Response', $response);
    }
}
