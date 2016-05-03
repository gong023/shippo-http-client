<?php

namespace ShippoClient\Http\Request\Refunds;

use AssertChain\AssertChain;
use ShippoClient\Entity\Address;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    use AssertChain;

    /**
     * @test
     */
    public function transliterateToAscii()
    {
        $address = new Address([
            'name'      => 'Hello world!',
            'company'   => 'ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ"`\'^~',
            'street1'   => 'ŻŹĆŃĄŚŁĘÓżźćńąśłęó"`\'^~',
            'street2'   => 'Γειά σου Κόσμε!',
            'street_no' => '세계 안녕하세요!',
            'city'      => 'こんにちは世界！',
            'state'     => '你好，世界！',
        ]);

        $this->assert()
            ->same('Hello world!', $address->getName())
            ->same('SOEZsoezYyenuAAAAAAAECEEEEIIIIDNOOOOOOUUUUYssaaaaaaaeceeeeiiiidnoooooouuuuyy"`\'^~', $address->getCompany())
            ->same('ZZCNASLEOzzcnasleo"`\'^~', $address->getStreet1())
            ->same('  !', $address->getStreet2())
            ->same(' !', $address->getStreetNo())
            ->same('!', $address->getCity())
            ->same(',!', $address->getState());
    }
}
