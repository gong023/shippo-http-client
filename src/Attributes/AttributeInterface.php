<?php

namespace ShippoClient\Attributes;

interface AttributeInterface
{
    /**
     * @param callable $validate
     * @return string
     */
    public function toString(callable $validate = null);

    /**
     * @param callable $validate
     * @return int
     */
    public function toInteger(callable $validate = null);

    /**
     * @param callable $validate
     * @return bool
     */
    public function toBoolean(callable $validate = null);
}
