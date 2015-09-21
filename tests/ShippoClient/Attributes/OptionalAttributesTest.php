<?php

namespace ShippoClient\Attributes;

class OptionalAttributesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider emptyValueProvider
     * @param $emptyValue
     */
    public function asStringWithEmptyValue($emptyValue)
    {
        $optional = new Optional($emptyValue);
        $this->assertSame('', $optional->asString());
    }

    /**
     * @test
     * @dataProvider emptyValueProvider
     * @param $emptyValue
     */
    public function asIntegerWithEmptyValue($emptyValue)
    {
        $optional = new Optional($emptyValue);
        $this->assertSame(0, $optional->asInteger());
    }

    /**
     * @test
     * @dataProvider emptyValueProvider
     * @param $emptyValue
     */
    public function asFloatWithEmptyValue($emptyValue)
    {
        $optional = new Optional($emptyValue);
        $this->assertSame(0.0, $optional->asFloat());
    }

    /**
     * @test
     * @dataProvider emptyValueProvider
     * @param $emptyValue
     */
    public function asBooleanWithEmptyValue($emptyValue)
    {
        $optional = new Optional($emptyValue);
        $this->assertFalse($optional->asBoolean());
    }

    /**
     * @test
     * @dataProvider emptyValueProvider
     * @param $emptyValue
     */
    public function asArrayWithEmptyValue($emptyValue)
    {
        $optional = new Optional($emptyValue);
        $this->assertSame([], $optional->asArray());
    }

    /**
     * @test
     */
    public function asInstanceWithEmptyValue()
    {
        $optional = new Optional('2015-01-01 00:00:00');
        $this->assertInstanceOf('\\DateTime', $optional->asInstance('\\DateTime'));
    }

    public function emptyValueProvider()
    {
        return [
            [0], [''], [null], [false]
        ];
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @param $falseValidate
     */
    public function asStringWithFalseValidate($falseValidate)
    {
        $optional = new Optional('not empty value');
        $this->assertSame('', $optional->asString($falseValidate));
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @param $falseValidate
     */
    public function asIntegerWithFalseValidate($falseValidate)
    {
        $optional = new Optional(100);
        $this->assertSame(0, $optional->asInteger($falseValidate));
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @param $falseValidate
     */
    public function asFloatWithFalseValidate($falseValidate)
    {
        $optional = new Optional(100.0);
        $this->assertSame(0.0, $optional->asFloat($falseValidate));
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @param $falseValidate
     */
    public function asBooleanWithFalseValidate($falseValidate)
    {
        $optional = new Optional(true);
        $this->assertFalse($optional->asBoolean($falseValidate));
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @param $falseValidate
     */
    public function asArrayWithFalseValidate($falseValidate)
    {
        $optional = new Optional(['not empty array']);
        $this->assertSame([], $optional->asArray($falseValidate));
    }

    /**
     * @test
     */
    public function asInstanceWithFalseValidate()
    {
        $optional = new Optional(new \DateTime('2015-01-01 00:00:00'));
        $now = new \DateTime('2016-01-01 00:00:00');
        $ret = $optional->asInstance('\\DateTime', function ($value) use ($now) {
            return $value === $now;
        });

        $this->assertNull($ret);
    }

    public function falseValidateProvider()
    {
        return [
            [function () { return false; }],
        ];
    }
}
