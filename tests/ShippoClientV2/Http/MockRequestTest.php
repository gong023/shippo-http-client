<?php

namespace ShippoClientV2\Http;

use ShippoClient\ShippoClientV2;

class MockRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \ShippoClient\Http\Response\Exception\ServerErrorException
     */
    public function imitateInternalServerError()
    {
        ShippoClientV2::mock()->add('addresses', 500, []);
        ShippoClientV2::provider('anything good because mock works')->addresses()->getList();
    }
}
