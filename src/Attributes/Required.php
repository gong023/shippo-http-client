<?php

namespace ShippoClient\Attributes;

class Required implements AttributeInterface
{
    /**
     * @var null|mixed
     */
    private $requiredValue = null;

    public function __construct($value)
    {
        $this->requiredValue = $value;
    }

    /**
     * @param callable $validate
     * @return string
     * @throws InvalidAttributeException
     */
    public function toString(callable $validate = null)
    {
        if (empty($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if (! is_null($validate) && ! $validate($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        return (string)$this->requiredValue;
    }

    /**
     * @param callable $validate
     * @return int
     * @throws InvalidAttributeException
     */
    public function toInteger(callable $validate = null)
    {
        if (empty($value)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if (! is_null($validate) && ! $validate($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        return (int)$this->requiredValue;
    }

    /**
     * @param callable $validate
     * @return bool
     * @throws InvalidAttributeException
     */
    public function toBoolean(callable $validate = null)
    {
        if (empty($value)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if (! is_null($validate) && ! $validate($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        return (bool)$this->requiredValue;
    }
}
