<?php

namespace ShippoClient;

use ShippoClient\Attributes\InvalidAttributeException;
use ShippoClient\Attributes\Optional;
use ShippoClient\Attributes\Required;

class Attributes
{
    private $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function mustHave($value)
    {
        if (empty($this->attributes[$value])) {
            throw new InvalidAttributeException;
        }

        return new Required($this->attributes[$value]);
    }

    public function mayHave($value)
    {
        if (empty($this->attributes[$value])) {
            return new Optional(null);
        }

        return new Optional($this->attributes[$value]);
    }
}
