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
    public function asString(callable $validate = null)
    {
        if (empty($this->optionalValue)) {
            return '';
        }

        if ($validate !== null && ! $validate($this->optionalValue)) {
            return '';
        }

        return $this->optionalValue;
    }

    /**
     * @param callable $validate
     * @return int
     */
    public function asInteger(callable $validate = null)
    {
        if (empty($this->optonalValue)) {
            return 0;
        }

        if ($validate !== null && ! $validate($this->optionalValue)) {
            return 0;
        }

        return $this->optionalValue;
    }

    /**
     * @param callable $validate
     * @return bool
     */
    public function asBoolean(callable $validate = null)
    {
        if ($this->optionalValue === null) {
            return false;
        }

        if ($validate !== null && ! $validate($this->optionalValue)) {
            return false;
        }

        return (bool)$this->optionalValue;
    }

    /**
     * @param callable $validate
     * @return array
     */
    public function asArray(callable $validate = null)
    {
        if (! is_array($this->optionalValue)) {
            return array();
        }

        if ($validate !== null && ! $validate($this->optionalValue)) {
            return array();
        }

        return $this->optionalValue;
    }

    public function value()
    {
        return $this->optionalValue;
    }
}
