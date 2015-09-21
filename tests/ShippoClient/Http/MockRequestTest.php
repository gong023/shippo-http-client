<?php

namespace ShippoClient\Http;

use ShippoClient\ShippoClient;

class MockRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \ShippoClient\Http\Response\Exception\ServerErrorException
     */
    public function imitateInternalServerError()
    {
        ShippoClient::mock()->add('addresses', 500, []);
        ShippoClient::provider('anything good because mock works')->addresses()->getList();
    }
}
