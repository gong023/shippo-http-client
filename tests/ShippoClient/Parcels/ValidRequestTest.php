<?php

namespace ShippoClient\Addresses\Parcels;

use ShippoClient\ShippoClient;

class ValidRequestTest extends \PHPUnit_Framework_TestCase
{
    private static $accessToken = null;

    public function setUp()
    {
        self::$accessToken = getenv('SHIPPO_PRIVATE_ACCESS_TOKEN');
    }

    public function testCreateParcel()
    {
        $this->assertNotFalse(self::$accessToken, 'You should set env SHIPPO_PRIVATE_ACCESS_TOKEN.');

        $param = array(
            'length'        => 5,
            'width'         => 5,
            'height'        => 5,
            'distance_unit' => 'cm',
            'weight'        => 2,
            'mass_unit'     => 'lb',
            'template'      => '',
            'metadata'      => 'Customer ID 123456',
        );
        $response = ShippoClient::provider(self::$accessToken)->parcels()->create($param);

        $this->assertInstanceOf('ShippoClient\\Http\\Response\\Parcels', $response);
        $responseArray = $response->toArray();
        $this->assertSame('VALID', $responseArray['object_state']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $responseArray['object_created']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $responseArray['object_updated']);
        $this->assertNotEmpty($responseArray['object_id']);
        $this->assertNotEmpty($responseArray['object_owner']);
        $this->assertSame('', $responseArray['template']);
        $this->assertSame(5.0, $responseArray['length']);
        $this->assertSame(5.0, $responseArray['width']);
        $this->assertSame(5.0, $responseArray['height']);
        $this->assertSame('cm', $responseArray['distance_unit']);
        $this->assertSame(2.0, $responseArray['weight']);
        $this->assertSame('lb', $responseArray['mass_unit']);
        $this->assertSame('', $responseArray['value_amount']);
        $this->assertSame('', $responseArray['value_currency']);
        $this->assertSame('Customer ID 123456', $responseArray['metadata']);

        return $response->getObjectId();
    }

    /**
     * @depends testCreateParcel
     * @param $objectId
     */
    public function testRetrieveParcel($objectId)
    {
        $response = ShippoClient::provider(self::$accessToken)->parcels()->retrieve($objectId);

        $this->assertInstanceOf('ShippoClient\\Http\\Response\\Parcels', $response);
    }

    /**
     * @depends testCreateParcel
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
