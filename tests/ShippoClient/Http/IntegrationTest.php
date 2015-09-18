<?php

namespace ShippoClient\Http;

use ShippoClient\Entity\Transaction;
use ShippoClient\ShippoClient;

/**
 * ugly and helpful test class
 */
class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    private static $accessToken = null;

    public function setUp()
    {
        self::$accessToken = getenv('SHIPPO_PRIVATE_ACCESS_TOKEN');
    }

    /**
     * @test
     * @return array
     */
    public function createAddress()
    {
        $this->assertNotFalse(self::$accessToken, 'You should set env SHIPPO_PRIVATE_ACCESS_TOKEN.');

        $param = array(
            "object_purpose" => "PURCHASE",
            "name"           => "Address From User",
            "company"        => "Shippo",
            "street1"        => "215 Clayton St.",
            "street2"        => "",
            "city"           => "San Francisco",
            "state"          => "CA",
            "zip"            => "94117",
            "country"        => "US",
            "phone"          => "+1 555 341 9393",
            "email"          => "api@goshippo.com",
            "is_residential" => true,
            "metadata"       => "integration test"
        );
        $addressFrom = ShippoClient::provider(self::$accessToken)->addresses()->create($param);
        $this->assertInstanceOf('ShippoClient\\Entity\\Address', $addressFrom);

        $addressFromArray = $addressFrom->toArray();
        $this->assertSame('VALID', $addressFromArray['object_state']);
        $this->assertSame('FULLY_ENTERED', $addressFromArray['object_source']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $addressFromArray['object_created']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $addressFromArray['object_updated']);
        $this->assertNotEmpty($addressFromArray['object_id']);
        $this->assertNotEmpty($addressFromArray['object_owner']);
        $this->assertSame('Address From User', $addressFromArray['name']);
        $this->assertSame('Shippo', $addressFromArray['company']);
        $this->assertSame("", $addressFromArray['street_no']);
        $this->assertSame("215 Clayton St.", $addressFromArray['street1']);
        $this->assertSame("", $addressFromArray['street2']);
        $this->assertSame("San Francisco", $addressFromArray['city']);
        $this->assertSame("CA", $addressFromArray['state']);
        $this->assertSame("94117", $addressFromArray['zip']);
        $this->assertSame("US", $addressFromArray['country']);
        $this->assertSame("0015553419393", $addressFromArray['phone']); // casted
        $this->assertSame("api@goshippo.com", $addressFromArray['email']); // casted
        $this->assertTrue($addressFromArray['is_residential']);
        $this->assertSame("", $addressFromArray['ip']);
        $this->assertInternalType('array', $addressFromArray['messages']);
        $this->assertSame("integration test", $addressFromArray['metadata']);

        $param = array(
            "object_purpose" => "PURCHASE",
            "name"           => "Address To User",
            "company"        => "Shippo",
            "street1"        => "215 Clayton St.",
            "street2"        => "",
            "city"           => "San Francisco",
            "state"          => "CA",
            "zip"            => "94117",
            "country"        => "US",
            "phone"          => "+1 555 341 9393",
            "email"          => "api@goshippo.com",
            "is_residential" => true,
            "metadata"       => "integration test"
        );
        $addressTo = ShippoClient::provider(self::$accessToken)->addresses()->create($param);
        $this->assertInstanceOf('ShippoClient\\Entity\\Address', $addressTo);

        return array(
            'address_from' => $addressFrom->getObjectId(),
            'address_to' => $addressTo->getObjectId(),
        );
    }

    /**
     * @test
     * @depends createAddress
     * @param $objectIds
     */
    public function retrieveAddress($objectIds)
    {
        $response = ShippoClient::provider(self::$accessToken)->addresses()->retrieve($objectIds['address_from']);
        $this->assertInstanceOf('ShippoClient\\Entity\\Address', $response);
    }

    /**
     * @test
     * @depends createAddress
     * @param $objectIds
     */
    public function validateAddress($objectIds)
    {
        $response = ShippoClient::provider(self::$accessToken)->addresses()->validate($objectIds['address_from']);
        $this->assertInstanceOf('ShippoClient\\Entity\\Address', $response);
    }

    /**
     * @test
     * @depends createAddress
     */
    public function getListOfAddress()
    {
        $response = ShippoClient::provider(self::$accessToken)->addresses()->getList();

        $this->assertInstanceOf('ShippoClient\\Http\\Response\\AddressList', $response);
        $responseArray = $response->toArray();
        $this->assertGreaterThanOrEqual(1, $responseArray['count']);
        $this->assertArrayHasKey('next', $responseArray);
        $this->assertArrayHasKey('previous', $responseArray);
        $this->assertContainsOnlyInstancesOf('ShippoClient\\Entity\\Address', $response->getResults()->getArrayCopy());
    }

    /**
     * @test
     * @depends createAddress
     * @param $objectIds
     */
    public function createParcel($objectIds)
    {
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
        $parcel = ShippoClient::provider(self::$accessToken)->parcels()->create($param);

        $this->assertInstanceOf('ShippoClient\\Entity\\Parcel', $parcel);
        $parcelArray = $parcel->toArray();
        $this->assertSame('VALID', $parcelArray['object_state']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $parcelArray['object_created']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $parcelArray['object_updated']);
        $this->assertNotEmpty($parcelArray['object_id']);
        $this->assertNotEmpty($parcelArray['object_owner']);
        $this->assertSame('', $parcelArray['template']);
        $this->assertSame(5.0, $parcelArray['length']);
        $this->assertSame(5.0, $parcelArray['width']);
        $this->assertSame(5.0, $parcelArray['height']);
        $this->assertSame('cm', $parcelArray['distance_unit']);
        $this->assertSame(2.0, $parcelArray['weight']);
        $this->assertSame('lb', $parcelArray['mass_unit']);
        $this->assertSame('', $parcelArray['value_amount']);
        $this->assertSame('', $parcelArray['value_currency']);
        $this->assertSame('Customer ID 123456', $parcelArray['metadata']);

        $objectIds['parcel'] = $parcel->getObjectId();

        return $objectIds;
    }

    /**
     * @test
     * @depends createParcel
     * @param $objectIds
     */
    public function retrieveParcel($objectIds)
    {
        $response = ShippoClient::provider(self::$accessToken)->parcels()->retrieve($objectIds['parcel']);
        $this->assertInstanceOf('ShippoClient\\Entity\\Parcel', $response);
    }

    /**
     * @test
     * @depends createParcel
     */
    public function getListOfParcel()
    {
        $response = ShippoClient::provider(self::$accessToken)->parcels()->getList();
        $this->assertInstanceOf('ShippoClient\\Http\\Response\\ParcelList', $response);
        $responseArray = $response->toArray();
        $this->assertGreaterThanOrEqual(1, $responseArray['count']);
        $this->assertArrayHasKey('next', $responseArray);
        $this->assertArrayHasKey('previous', $responseArray);
        $this->assertContainsOnlyInstancesOf('ShippoClient\\Entity\\Parcel', $response->getResults()->getArrayCopy());
    }

    /**
     * @test
     * @depends createParcel
     * @param $objectIds
     */
    public function createShipment($objectIds)
    {
        $param = array(
            'object_purpose'  => 'PURCHASE',
            'address_from'    => $objectIds['address_from'],
            'address_to'      => $objectIds['address_to'],
            'parcel'          => $objectIds['parcel'],
            'submission_type' => 'PICKUP',
            'submission_date' => date(\DateTime::ISO8601),
        );

        $shipment = ShippoClient::provider(self::$accessToken)->shipments()->create($param);

        $this->assertInstanceOf('ShippoClient\\Entity\\Shipment', $shipment);
        $shipmentArray = $shipment->toArray();
        $this->assertInternalType('array', $shipmentArray['carrier_accounts']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $shipmentArray['object_created']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $shipmentArray['object_updated']);
        $this->assertNotEmpty($shipmentArray['object_id']);
        $this->assertNotEmpty($shipmentArray['object_owner']);
        $this->assertSame('VALID', $shipmentArray['object_state']);
        $this->assertSame('QUEUED', $shipmentArray['object_status']);
        $this->assertSame('PURCHASE', $shipmentArray['object_purpose']);
        $this->assertSame($objectIds['address_from'], $shipmentArray['address_from']);
        $this->assertSame($objectIds['address_to'], $shipmentArray['address_to']);
        $this->assertSame($objectIds['parcel'], $shipmentArray['parcel']);
        $this->assertSame('PICKUP', $shipmentArray['submission_type']);
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}/', $shipmentArray['submission_date']);
        $this->assertNotEmpty($shipmentArray['address_return']);
        $this->assertSame('', $shipmentArray['return_of']);
        $this->assertSame('', $shipmentArray['customs_declaration']);
        $this->assertSame(0, $shipmentArray['insurance_amount']);
        $this->assertSame('', $shipmentArray['insurance_currency']);
        $this->assertInternalType('array', $shipmentArray['extra']);
        $this->assertSame('', $shipmentArray['reference_1']);
        $this->assertSame('', $shipmentArray['reference_2']);
        $this->assertNotEmpty($shipmentArray['rates_url']);
        $this->assertInternalType('array', $shipmentArray['messages']);
        $this->assertSame('', $shipmentArray['metadata']);

        $objectIds['shipment'] = $shipment->getObjectId();
        return $objectIds;
    }

    /**
     * @test
     * @depends createShipment
     * @param $objectIds
     */
    public function retrieveShipment($objectIds)
    {
        $response = ShippoClient::provider(self::$accessToken)->shipments()->retrieve($objectIds['shipment']);
        $this->assertInstanceOf('ShippoClient\\Entity\\Shipment', $response);
    }

    /**
     * @test
     * @depends createShipment
     */
    public function getListOfShipment()
    {
        $response = ShippoClient::provider(self::$accessToken)->shipments()->getList();
        $this->assertInstanceOf('ShippoClient\\Http\\Response\\ShipmentList', $response);
        $responseArray = $response->toArray();
        $this->assertGreaterThanOrEqual(1, $responseArray['count']);
        $this->assertArrayHasKey('next', $responseArray);
        $this->assertArrayHasKey('previous', $responseArray);
        $this->assertContainsOnlyInstancesOf('ShippoClient\\Entity\\Shipment', $response->getResults()->getArrayCopy());
    }

    /**
     * Rates objects are created asynchronously. Below tests may fail.
     * But they success in most cases.
     *
     * @test
     * @depends createShipment
     * @param $objectIds
     * @return \ShippoClient\Entity\Rate
     */
    public function getListOfRateByShipment($objectIds)
    {
        $response = ShippoClient::provider(self::$accessToken)->shipments()->getRateList($objectIds['shipment'], 'USD');
        $this->assertInstanceOf('ShippoClient\\Http\\Response\\RateList', $response);
        $responseArray = $response->toArray();
        $this->assertGreaterThanOrEqual(1, $responseArray['count']);
        $this->assertArrayHasKey('next', $responseArray);
        $this->assertArrayHasKey('previous', $responseArray);
        $this->assertContainsOnlyInstancesOf('ShippoClient\\Entity\\Rate', $response->getResults()->getArrayCopy());

        return $response->getResults()->offsetGet(0);
    }

    /**
     * @test
     * @depends getListOfRateByShipment
     * @param \ShippoClient\Entity\Rate $rate
     * @return \ShippoClient\Entity\Rate
     */
    public function retrieveRate($rate)
    {
        $response = ShippoClient::provider(self::$accessToken)->rates()->retrieve($rate->getObjectId());
        $this->assertInstanceOf('ShippoClient\\Entity\\Rate', $response);
        $responseArray = $response->toArray();
        $this->assertSame("VALID", $responseArray['object_state']);
        $this->assertSame("PURCHASE", $responseArray['object_purpose']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $responseArray['object_created']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $responseArray['object_updated']);
        $this->assertNotEmpty($responseArray['object_id']);
        $this->assertNotEmpty($responseArray['object_owner']);
        $this->assertNotEmpty($responseArray['shipment']);
        $this->assertTrue($responseArray['available_shippo']);
        $this->assertInternalType('array', $responseArray['attributes']);
        $this->assertInternalType('float', $responseArray['amount']);
        $this->assertSame("USD", $responseArray['currency']);
        $this->assertInternalType('float', $responseArray['amount_local']);
        $this->assertSame("USPS", $responseArray['provider']);
        $this->assertNotEmpty($responseArray['provider_image_75']);
        $this->assertNotEmpty($responseArray['provider_image_200']);
        $this->assertArrayHasKey('servicelevel_name', $responseArray);
        $this->assertArrayHasKey('servicelevel_terms', $responseArray);
        $this->assertInternalType('int', $responseArray['days']);
        $this->assertArrayHasKey('arrives_by', $responseArray);
        $this->assertNotEmpty($responseArray['duration_terms']);
        $this->assertTrue($responseArray['trackable']);
        $this->assertFalse($responseArray['insurance']);
        $this->assertSame(0.0, $responseArray['insurance_amount']);
        $this->arrayHasKey($responseArray['insurance_currency']);
        $this->assertSame(0.0, $responseArray['insurance_amount_local']);
        $this->arrayHasKey($responseArray['insurance_currency_local']);
        $this->arrayHasKey($responseArray['delivery_attempts']);
        $this->arrayHasKey($responseArray['outbound_endpoint']);
        $this->arrayHasKey($responseArray['inbound_endpoint']);
        $this->assertInternalType('array', $responseArray['messages']);
        $this->assertNotEmpty($responseArray['carrier_account']);

        return $rate;
    }

    /**
     * @test
     * @depends createShipment
     */
    public function getRateList()
    {
        $response = ShippoClient::provider(self::$accessToken)->rates()->getList();
        $this->assertInstanceOf('ShippoClient\\Http\\Response\\RateList', $response);
        $responseArray = $response->toArray();
        $this->assertGreaterThanOrEqual(1, $responseArray['count']);
        $this->assertArrayHasKey('next', $responseArray);
        $this->assertArrayHasKey('previous', $responseArray);
        $this->assertContainsOnlyInstancesOf('ShippoClient\\Entity\\Rate', $response->getResults()->getArrayCopy());
    }

    /**
     * @test
     * @depends retrieveRate
     * @param \ShippoClient\Entity\Rate $rate
     * @return \ShippoClient\Entity\Transaction
     */
    public function purchaseTransaction($rate)
    {
        // required purchased account...
        ShippoClient::mock()->add("transactions", 200, array(
            "object_state"             => "VALID",
            "object_status"            => "QUEUED",
            "object_created"           => "2014-07-25T02:09:34.422Z",
            "object_updated"           => "2014-07-25T02:09:34.513Z",
            "object_id"                => "ef8808606f4241ee848aa5990a09933c",
            "object_owner"             => "api@goshippo.com",
            "was_test"                 => true,
            "rate"                     => "ee81fab0372e419ab52245c8952ccaeb",
            "tracking_number"          => "",
            "tracking_status"          => null,
            "tracking_url_provider"    => "",
            "tracking_history"         => array(),
            "label_url"                => "",
            "commercial_invoice_url"   =>  "",
            "messages"                 => array(),
            "customs_note"             => "",
            "order"                    => "",
            "submission_note"          => "",
            "metadata"                 => "",
            "pickup_date"              => '2014-07-25T02:09:34.422Z',
            "notification_email_from"  => 'api@goshippo.com',
            "notification_email_to"    => 'api@goshippo.com',
            "notification_email_other" => 'api@goshippo.com',
        ));
        $transaction = ShippoClient::provider(self::$accessToken)->transactions()->purchase($rate->getObjectId());

        $this->assertInstanceOf('ShippoClient\\Entity\\Transaction', $transaction);
        $transactionArray = $transaction->toArray();
        $this->assertSame('VALID', $transactionArray['object_state']);
        $this->assertSame('QUEUED', $transactionArray['object_status']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $transactionArray['object_created']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $transactionArray['object_updated']);
        $this->assertNotEmpty($transactionArray['object_id']);
        $this->assertNotEmpty($transactionArray['object_owner']);
        $this->assertInternalType('bool', $transactionArray['was_test']);
        $this->assertNotEmpty($transactionArray['rate']);
        $this->assertArrayHasKey('pickup_date', $transactionArray);
        $this->assertArrayHasKey('notification_email_from', $transactionArray);
        $this->assertArrayHasKey('notification_email_to', $transactionArray);
        $this->assertArrayHasKey('notification_email_other', $transactionArray);
        $this->assertArrayHasKey('tracking_number', $transactionArray);
        $this->assertArrayHasKey('tracking_status', $transactionArray);
        $this->assertInternalType('array', $transactionArray['tracking_history']);
        $this->assertArrayHasKey('tracking_url_provider', $transactionArray);
        $this->assertArrayHasKey('label_url', $transactionArray);
        $this->assertArrayHasKey('commercial_invoice_url', $transactionArray);
        $this->assertInternalType('array', $transactionArray['messages']);
        $this->assertArrayHasKey('customs_note', $transactionArray);
        $this->assertArrayHasKey('submission_note', $transactionArray);
        $this->assertArrayHasKey('order', $transactionArray);
        $this->assertArrayHasKey('metadata', $transactionArray);

        return $transaction;
    }

    /**
     * @test
     * @depends purchaseTransaction
     * @param \ShippoClient\Entity\Transaction $transaction
     */
    public function retrieveTransaction($transaction)
    {
        ShippoClient::mock()->add("transactions/" . $transaction->getObjectId(), 200, array(
            "object_state"             => "VALID",
            "object_status"            => "QUEUED",
            "object_created"           => "2014-07-25T02:09:34.422Z",
            "object_updated"           => "2014-07-25T02:09:34.513Z",
            "object_id"                => "ef8808606f4241ee848aa5990a09933c",
            "object_owner"             => "api@goshippo.com",
            "was_test"                 => true,
            "rate"                     => "ee81fab0372e419ab52245c8952ccaeb",
            "tracking_number"          => "",
            "tracking_status"          => null,
            "tracking_url_provider"    => "",
            "tracking_history"         => array(),
            "label_url"                => "",
            "commercial_invoice_url"   =>  "",
            "messages"                 => array(),
            "customs_note"             => "",
            "order"                    => "",
            "submission_note"          => "",
            "metadata"                 => "",
            "pickup_date"              => '2014-07-25T02:09:34.422Z',
            "notification_email_from"  => 'api@goshippo.com',
            "notification_email_to"    => 'api@goshippo.com',
            "notification_email_other" => 'api@goshippo.com',
        ));

        $transaction = ShippoClient::provider(self::$accessToken)->transactions()->retrieve($transaction->getObjectId());
        $this->assertInstanceOf('ShippoClient\\Entity\\Transaction', $transaction);
    }

    /**
     * @test
     * @depends purchaseTransaction
     */
    public function getTransactionList()
    {
        ShippoClient::mock()->add("transactions", 200, array(
            'count'    => 1,
            'next'     => null,
            'previous' => null,
            'results'  => array(
                array(
                    "object_state"             => "VALID",
                    "object_status"            => "QUEUED",
                    "object_created"           => "2014-07-25T02:09:34.422Z",
                    "object_updated"           => "2014-07-25T02:09:34.513Z",
                    "object_id"                => "ef8808606f4241ee848aa5990a09933c",
                    "object_owner"             => "api@goshippo.com",
                    "was_test"                 => true,
                    "rate"                     => "ee81fab0372e419ab52245c8952ccaeb",
                    "tracking_number"          => "",
                    "tracking_status"          => null,
                    "tracking_url_provider"    => "",
                    "tracking_history"         => array(),
                    "label_url"                => "",
                    "commercial_invoice_url"   =>  "",
                    "messages"                 => array(),
                    "customs_note"             => "",
                    "order"                    => "",
                    "submission_note"          => "",
                    "metadata"                 => "",
                    "pickup_date"              => '2014-07-25T02:09:34.422Z',
                    "notification_email_from"  => 'api@goshippo.com',
                    "notification_email_to"    => 'api@goshippo.com',
                    "notification_email_other" => 'api@goshippo.com',
                ),
            ),
        ) );

        $transaction = ShippoClient::provider(self::$accessToken)->transactions()->getList();
        $this->assertInstanceOf('ShippoClient\\Http\\Response\\TransactionList', $transaction);
        $responseArray = $transaction->toArray();
        $this->assertGreaterThanOrEqual(1, $responseArray['count']);
        $this->assertArrayHasKey('next', $responseArray);
        $this->assertArrayHasKey('previous', $responseArray);
        $this->assertContainsOnlyInstancesOf('ShippoClient\\Entity\\Transaction', $transaction->getResults()->getArrayCopy());
    }

    /**
     * @test
     * @depends purchaseTransaction
     * @param Transaction $transaction
     * @return \ShippoClient\Entity\Refund
     */
    public function createRefund($transaction)
    {
        ShippoClient::mock()->add("refunds", 200, array(
            "object_created" =>  "2014-04-21T07:12:41.044Z",
            "object_updated" =>  "2014-04-21T07:12:41.045Z",
            "object_id"      =>  "bd7b8379a2e847bcb0818125943dde5d",
            "object_owner"   =>  "tech@goshippo.com",
            "object_status"  =>  "QUEUED",
            "transaction"    =>  "35ed59f23a514ecfa2faeaed93a00086"
        ));

        $refund = ShippoClient::provider(self::$accessToken)->refunds()->create($transaction->getObjectId());
        $this->assertInstanceOf('ShippoClient\\Entity\\Refund', $refund);
        $refundArray = $refund->toArray();
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $refundArray['object_created']);
        $this->assertRegExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $refundArray['object_updated']);
        $this->assertNotEmpty($refundArray['object_id']);
        $this->assertNotEmpty($refundArray['object_owner']);
        $this->assertSame("35ed59f23a514ecfa2faeaed93a00086", $refundArray['transaction']);
        $this->assertNotEmpty($refundArray['object_status']); // maybe ERROR

        return $refund;
    }

    /**
     * @test
     * @depends createRefund
     * @param \ShippoClient\Entity\Refund $refund
     */
    public function retrieveRefund($refund)
    {
        ShippoClient::mock()->add("refunds/" . $refund->getObjectId(), 200, array(
            "object_created" =>  "2014-04-21T07:12:41.044Z",
            "object_updated" =>  "2014-04-21T07:12:41.045Z",
            "object_id"      =>  "bd7b8379a2e847bcb0818125943dde5d",
            "object_owner"   =>  "tech@goshippo.com",
            "object_status"  =>  "QUEUED",
            "transaction"    =>  "35ed59f23a514ecfa2faeaed93a00086"
        ));

        $refundResponse = ShippoClient::provider(self::$accessToken)->refunds()->retrieve($refund->getObjectId());
        $this->assertEquals($refund, $refundResponse);
    }

    /**
     * @test
     * @depends createRefund
     */
    public function getRefundList()
    {
        ShippoClient::mock()->add("refunds", 200, array(
            'count'    => 1,
            'next'     => null,
            'previous' => null,
            'results'  => array(
                array(
                    "object_created" =>  "2014-04-21T07:12:41.044Z",
                    "object_updated" =>  "2014-04-21T07:12:41.045Z",
                    "object_id"      =>  "bd7b8379a2e847bcb0818125943dde5d",
                    "object_owner"   =>  "tech@goshippo.com",
                    "object_status"  =>  "QUEUED",
                    "transaction"    =>  "35ed59f23a514ecfa2faeaed93a00086"
                ),
            )
        ));

        $refund = ShippoClient::provider(self::$accessToken)->refunds()->getList();
        $this->assertInstanceOf('ShippoClient\\Http\\Response\\RefundList', $refund);
        $responseArray = $refund->toArray();
        $this->assertGreaterThanOrEqual(1, $responseArray['count']);
        $this->assertArrayHasKey('next', $responseArray);
        $this->assertArrayHasKey('previous', $responseArray);
        $this->assertContainsOnlyInstancesOf('ShippoClient\\Entity\\Refund', $refund->getResults()->getArrayCopy());
    }
}
