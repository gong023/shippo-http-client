<?php

namespace ShippoClient\Attributes;

class Optional implements AttributeInterface
{
    /**
     * @var null|mixed
     */
    private $optionalValue = null;

    public function __construct($value)
    {
        $this->optionalValue = $value;
    }

    /**
     * @param callable $validate
     * @return string
     */
    public function toString(callable $validate = null)
    {
        if (empty($this->optionalValue)) {
            return '';
        }

        if (! is_null($validate) && ! $validate($this->optionalValue)) {
            return '';
        }

        return $this->optionalValue;
    }

    /**
     * @param callable $validate
     * @return int
     */
    public function toInteger(callable $validate = null)
    {
        if (empty($this->optonalValue)) {
            return 0;
        }

        if (! is_null($validate) && ! $validate($this->optionalValue)) {
            return 0;
        }

        return $this->optionalValue;
    }

    /**
     * @param callable $validate
     * @return bool
     */
    public function toBoolean(callable $validate = null)
    {
        if (empty($this->optionalValue)) {
            return false;
        }

        if (! is_null($validate) && ! $validate($this->optionalValue)) {
            return false;
        }

        return (bool)$this->optionalValue;
    }
}
