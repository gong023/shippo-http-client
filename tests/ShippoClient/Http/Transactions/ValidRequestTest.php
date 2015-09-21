<?php

namespace ShippoClient\Http\Request\Transactions;

use AssertChain\AssertChain;
use ShippoClient\ShippoClient;

/**
 * transaction domain is required purchased account.
 */
class ValidRequestTest extends \PHPUnit_Framework_TestCase
{
    use AssertChain;

    /**
     * @test
     */
    public function purchaseTransaction()
    {
        ShippoClient::mock()->add("transactions", 200, [
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
            "tracking_history"         => [],
            "label_url"                => "",
            "commercial_invoice_url"   =>  "",
            "messages"                 => [],
            "customs_note"             => "",
            "order"                    => "",
            "submission_note"          => "",
            "metadata"                 => "",
            "pickup_date"              => '2014-07-25T02:09:34.422Z',
            "notification_email_from"  => 'api@goshippo.com',
            "notification_email_to"    => 'api@goshippo.com',
            "notification_email_other" => 'api@goshippo.com',
        ]);
        $transaction = ShippoClient::provider('dummy token')->transactions()->purchase('dummy rate object id');

        $this->assertInstanceOf('ShippoClient\\Entity\\Transaction', $transaction);
        $transactionArray = $transaction->toArray();
        $this->assert()
            ->same('VALID', $transactionArray['object_state'])
            ->same('QUEUED', $transactionArray['object_status'])
            ->regExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $transactionArray['object_created'])
            ->regExp('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}.\d{3}Z/', $transactionArray['object_updated'])
            ->notEmpty($transactionArray['object_id'])
            ->notEmpty($transactionArray['object_owner'])
            ->internalType('bool', $transactionArray['was_test'])
            ->notEmpty($transactionArray['rate'])
            ->arrayHasKey('pickup_date', $transactionArray)
            ->arrayHasKey('notification_email_from', $transactionArray)
            ->arrayHasKey('notification_email_to', $transactionArray)
            ->arrayHasKey('notification_email_other', $transactionArray)
            ->arrayHasKey('tracking_number', $transactionArray)
            ->arrayHasKey('tracking_status', $transactionArray)
            ->internalType('array', $transactionArray['tracking_history'])
            ->arrayHasKey('tracking_url_provider', $transactionArray)
            ->arrayHasKey('label_url', $transactionArray)
            ->arrayHasKey('commercial_invoice_url', $transactionArray)
            ->internalType('array', $transactionArray['messages'])
            ->arrayHasKey('customs_note', $transactionArray)
            ->arrayHasKey('submission_note', $transactionArray)
            ->arrayHasKey('order', $transactionArray)
            ->arrayHasKey('metadata', $transactionArray);
    }

    /**
     * @test
     */
    public function retrieveTransaction()
    {
        $dummyObjectId = 'dummy transaction object id';
        $mockObject = [
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
            "tracking_history"         => [],
            "label_url"                => "",
            "commercial_invoice_url"   =>  "",
            "messages"                 => [],
            "customs_note"             => "",
            "order"                    => "",
            "submission_note"          => "",
            "metadata"                 => "",
            "pickup_date"              => '2014-07-25T02:09:34.422Z',
            "notification_email_from"  => 'api@goshippo.com',
            "notification_email_to"    => 'api@goshippo.com',
            "notification_email_other" => 'api@goshippo.com',
        ];
        ShippoClient::mock()->add("transactions/" . $dummyObjectId, 200, $mockObject);

        $transaction = ShippoClient::provider('dummy token')->transactions()->retrieve($dummyObjectId);
        $this->assertInstanceOf('ShippoClient\\Entity\\Transaction', $transaction);
    }

    /**
     * @test
     */
    public function getTransactionList()
    {
        ShippoClient::mock()->add("transactions", 200, [
            'count'    => 1,
            'next'     => null,
            'previous' => null,
            'results'  => [
                [
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
                    "tracking_history"         => [],
                    "label_url"                => "",
                    "commercial_invoice_url"   =>  "",
                    "messages"                 => [],
                    "customs_note"             => "",
                    "order"                    => "",
                    "submission_note"          => "",
                    "metadata"                 => "",
                    "pickup_date"              => '2014-07-25T02:09:34.422Z',
                    "notification_email_from"  => 'api@goshippo.com',
                    "notification_email_to"    => 'api@goshippo.com',
                    "notification_email_other" => 'api@goshippo.com',
                ],
            ],
        ]);

        $transaction = ShippoClient::provider('dummy token')->transactions()->getList();
        $this->assertInstanceOf('ShippoClient\\Http\\Response\\TransactionList', $transaction);
        $responseArray = $transaction->toArray();
        $this->assert()
            ->greaterThanOrEqual(1, $responseArray['count'])
            ->arrayHasKey('next', $responseArray)
            ->arrayHasKey('previous', $responseArray)
            ->containsOnlyInstancesOf('ShippoClient\\Entity\\Transaction', $transaction->getResults()->getArrayCopy());
    }

}
