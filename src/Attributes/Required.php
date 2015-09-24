<?php

namespace ShippoClient\Attributes;

class Required implements AttributeInterface
{
    /**
     * @var mixed|null
     */
    private $requiredValue = null;

    public function __construct($value)
    {
        $this->requiredValue = $value;
    }

    /**
     * @param callable|null $validate
     * @return string
     * @throws InvalidAttributeException
     */
    public function asString(callable $validate = null)
    {
        if (empty($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if ($validate !== null && ! $validate($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        return (string)$this->requiredValue;
    }

    /**
     * @param callable|null $validate
     * @return int
     * @throws InvalidAttributeException
     */
    public function asInteger(callable $validate = null)
    {
        if ($this->requiredValue === null) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if ($validate !== null && ! $validate($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        return (int)$this->requiredValue;
    }

    /**
     * @param callable|null $validate
     * @return float
     * @throws InvalidAttributeException
     */
    public function asFloat(callable $validate = null)
    {
        if ($this->requiredValue === null) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if ($validate !== null && ! $validate($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        return (float)$this->requiredValue;
    }

    /**
     * @param callable|null $validate
     * @return bool
     * @throws InvalidAttributeException
     */
    public function asBoolean(callable $validate = null)
    {
        if ($this->requiredValue === null) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if ($validate !== null && ! $validate($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        return (bool)$this->requiredValue;
    }

    /**
     * @param string $className
     * @param callable|null $validate
     * @return mixed
     * @throws InvalidAttributeException
     */
    public function asInstance($className, callable $validate = null)
    {
        if (! $this->requiredValue instanceof $className) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if ($validate !== null && ! $validate($this->requiredValue)) {
            throw new InvalidAttributeException(get_class($this->requiredValue));
        }

        return $this->requiredValue;
    }

    /**
     * @param callable|null $validate
     * @return array
     * @throws InvalidAttributeException
     */
    public function asArray(callable $validate = null)
    {
        if (! is_array($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if ($validate !== null && ! $validate($this->requiredValue)) {
            // Exception class cannot take array at first argument.
            throw new InvalidAttributeException($this->requiredValue[0]);
        }

        return $this->requiredValue;
    }
}
