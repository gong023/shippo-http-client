<?php

namespace ShippoClient\Http\Request\Parcels;

use ShippoClient\Http\Request\CommonParameter;
use TurmericSpice\Container;
use TurmericSpice\Container\InvalidAttributeException;
use TurmericSpice\ReadWriteAttributes;

/**
 * Parcel objects are used for creating Shipment, obtaining Rates and printing Labels,
 * and thus are one of the fundamental building blocks of the Shippo API.
 * Parcel are created with their basic dimensions and their weight.
 */
class CreateObject extends CommonParameter
{
    use ReadWriteAttributes {
        toArray as public __toArray;
        __construct as public __t_construct;
    }

    /**
     * First dimension of the Parcel.
     * The length should always be the largest of the three dimensions length, width and height;
     * our API will automatically order them if this is not the case.
     * Up to six digits in front and four digits after the decimal separator are accepted.
     *
     * Required
     *
     * @return int
     * @throws InvalidAttributeException
     */
    public function getLength()
    {
        return $this->attributes->mustHave('length')->asInteger();
    }

    /**
     * Second dimension of the Parcel.
     * The width should always be the second largest of the three dimensions length, width and height;
     * our API will automatically order them if this is not the case.
     * Up to six digits in front and four digits after the decimal separator are accepted.
     *
     * Required
     *
     * @return int
     * @throws InvalidAttributeException
     */
    public function getWidth()
    {
        return $this->attributes->mustHave('width')->asInteger();
    }

    /**
     * Third dimension of the parcel.
     * The height should always be the smallest of the three dimensions length, width and height;
     * our API will automatically order them if this is not the case.
     * Up to six digits in front and four digits after the decimal separator are accepted.
     *
     * Required
     *
     * @return int
     * @throws InvalidAttributeException
     */
    public function getHeight()
    {
        return $this->attributes->mustHave('height')->asInteger();
    }

    /**
     * The unit used for length, width and height.
     *
     * Required
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getDistanceUnit()
    {
        return $this->attributes->mustHave('distance_unit')->asString(function ($distanceUnit) {
            return in_array($distanceUnit, ['cm', 'in', 'ft', 'mm', 'm', 'yd'], true);
        });
    }

    /**
     * Weight of the parcel. Up to six digits in front and four digits after the decimal separator are accepted.
     *
     * Required
     *
     * @return int
     * @throws InvalidAttributeException
     */
    public function getWeight()
    {
        return $this->attributes->mustHave('weight')->asInteger();
    }

    /**
     * The unit used for weight.
     *
     * Required
     *
     * @return string
     * @throws InvalidAttributeException
     */
    public function getMassUnit()
    {
        return $this->attributes->mustHave('mass_unit')->asString(function ($massUnit) {
            return in_array($massUnit, ['g', 'oz', 'lb', 'kg'], true);
        });
    }

    /**
     * A parcel template is a predefined package used by one or multiple carriers.
     * See the table below for all available values and the corresponding tokens.
     * When a template is given, the parcel dimensions have to be sent, but will not be used for the Rate generation.
     * The dimensions below will instead be used. The parcel weight is not affected by the use of a template.
     *
     * Optional
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->attributes->mayHave('template')->asString();
    }

    public function toArray()
    {
        return array_filter($this->__toArray());
    }
}
