<?php
namespace ShippoClient;

class ShippoClientTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateAddress()
    {
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
        $accessToken = getenv('SHIPPO_PRIVATE_ACCESS_TOKEN');

        $response = ShippoClient::provider($accessToken)->addresses()->create($param);

        $this->assertInstanceOf('ShippoClient\\Addresses\\Response', $response);
    }
}
