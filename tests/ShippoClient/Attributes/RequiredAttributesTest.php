<?php

namespace ShippoClient\Attributes;

class RequiredAttributesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider emptyValueProvider
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     * @param $emptyValue
     */
    public function asStringThrowsWithEmptyValue($emptyValue)
    {
        $requiredValue = new Required($emptyValue);
        $requiredValue->asString();
    }

    /**
     * @test
     * @dataProvider emptyValueProvider
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     * @param $emptyValue
     */
    public function asArrayThrowsWithEmptyValue($emptyValue)
    {
        $requiredValue = new Required($emptyValue);
        $requiredValue->asArray();
    }

    /**
     * @test
     */
    public function asInstance()
    {
        $requiredValue = new Required(new \DateTime('2015-01-01 00:00:00'));
        $this->assertInstanceOf('\\DateTime', $requiredValue->asInstance('\\DateTime'));
    }

    /**
     * @test
     * @dataProvider emptyValueProvider
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     * @param $emptyValue
     */
    public function asInstanceThrowsWithEmptyValid($emptyValue)
    {
        $requiredValue = new Required($emptyValue);
        $requiredValue->asInstance('\\DateTime');
    }

    public function emptyValueProvider()
    {
        return [
            [0], [''], [null], [false]
        ];
    }

    /**
     * @test
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     */
    public function asIntegerThrowsWithEmptyValue()
    {
        $requiredValue = new Required(null);
        $requiredValue->asInteger();
    }

    /**
     * @test
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     */
    public function asFloatThrowsWithEmptyValue()
    {
        $requiredValue = new Required(null);
        $requiredValue->asFloat();
    }

    /**
     * @test
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     */
    public function asBooleanThrowsWithEmptyValue()
    {
        $requiredValue = new Required(null);
        $requiredValue->asBoolean();
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     * @param $falseValidate
     */
    public function asStringThrowsWithFalseValidate($falseValidate)
    {
        $requireValue = new Required("valid string");
        $requireValue->asString($falseValidate);
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     * @param $falseValidate
     */
    public function asIntegerThrowsWithFalseValidate($falseValidate)
    {
        $requireValue = new Required(1);
        $requireValue->asInteger($falseValidate);
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     * @param $falseValidate
     */
    public function asFloatThrowsWithFalseValidate($falseValidate)
    {
        $requireValue = new Required(1.0);
        $requireValue->asFloat($falseValidate);
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     * @param $falseValidate
     */
    public function asBooleanThrowsWithFalseValidate($falseValidate)
    {
        $requireValue = new Required(true);
        $requireValue->asBoolean($falseValidate);
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     * @param $falseValidate
     */
    public function asArrayThrowsWithFalseValidate($falseValidate)
    {
        $requireValue = new Required(['valid array']);
        $requireValue->asArray($falseValidate);
    }

    /**
     * @test
     * @dataProvider falseValidateProvider
     * @expectedException \ShippoClient\Attributes\InvalidAttributeException
     * @param $falseValidate
     */
    public function asInstanceThrowsWithFalseValidate($falseValidate)
    {
        $requireValue = new Required(new \DateTime('2015-01-01 00:00:00'));
        $requireValue->asInstance('\\DateTime', $falseValidate);
    }

    public function falseValidateProvider()
    {
        return [
            [function () { return false; }],
        ];
    }
}
