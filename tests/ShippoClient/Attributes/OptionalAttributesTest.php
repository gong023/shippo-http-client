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
        $this->assertSame(array(), $optional->asArray());
    }

    public function emptyValueProvider()
    {
        return array(
            array(0), array(''), array(null), array(false)
        );
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
        $optional = new Optional(array('not empty array'));
        $this->assertSame(array(), $optional->asArray($falseValidate));
    }

    public function falseValidateProvider()
    {
        return array(
            array(function () { return false; }),
        );
    }
}
