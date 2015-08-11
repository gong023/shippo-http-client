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
     * @param callable $validate
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
     * @param callable $validate
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
     * @param callable $validate
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
     * @param callable $validate
     * @return array
     * @throws InvalidAttributeException
     */
    public function asArray(callable $validate = null)
    {
        if (! is_array($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        if ($validate !== null && ! $validate($this->requiredValue)) {
            throw new InvalidAttributeException($this->requiredValue);
        }

        return $this->requiredValue;
    }
}
