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
     * @param callable|null $validate
     * @return string
     */
    public function asString($validate = null)
    {
        if (empty($this->optionalValue)) {
            return '';
        }

        if ($validate !== null && ! $validate($this->optionalValue)) {
            return '';
        }

        return (string)$this->optionalValue;
    }

    /**
     * @param callable|null $validate
     * @return int
     */
    public function asInteger($validate = null)
    {
        if (empty($this->optionalValue)) {
            return 0;
        }

        if ($validate !== null && ! $validate($this->optionalValue)) {
            return 0;
        }

        return (int)$this->optionalValue;
    }

    /**
     * @param callable|null $validate
     * @return float
     */
    public function asFloat($validate = null)
    {
        if (empty($this->optionalValue)) {
            return 0.0;
        }

        if ($validate !== null && ! $validate($this->optionalValue)) {
            return 0.0;
        }

        return (float)$this->optionalValue;
    }

    /**
     * @param callable|null $validate
     * @return bool
     */
    public function asBoolean($validate = null)
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
     * @param callable|null $validate
     * @return array
     */
    public function asArray($validate = null)
    {
        if (! is_array($this->optionalValue)) {
            return array();
        }

        if ($validate !== null && ! $validate($this->optionalValue)) {
            return array();
        }

        return $this->optionalValue;
    }

    /**
     * Only Optional value is allowed to return null
     *
     * @return mixed|null
     */
    public function value()
    {
        return $this->optionalValue;
    }
}
