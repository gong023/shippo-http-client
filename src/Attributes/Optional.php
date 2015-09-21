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
    public function asString(callable $validate = null)
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
    public function asInteger(callable $validate = null)
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
    public function asFloat(callable $validate = null)
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
     * @param callable|null $validate
     * @return array
     */
    public function asArray(callable $validate = null)
    {
        if (! is_array($this->optionalValue)) {
            return [];
        }

        if ($validate !== null && ! $validate($this->optionalValue)) {
            return [];
        }

        return $this->optionalValue;
    }

    /**
     * If validation result is false, this function returns null.
     *
     * @param string $className
     * @param callable|null $validate
     * @return mixed|null
     */
    public function asInstance($className, callable $validate = null)
    {
        if (! $this->optionalValue instanceof $className) {
            return new $className($this->optionalValue);
        }

        if ($validate != null && ! $validate($this->optionalValue)) {
            return null;
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
