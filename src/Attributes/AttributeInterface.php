<?php

namespace ShippoClient\Attributes;

interface AttributeInterface
{
    /**
     * @param callable $validate
     * @return string
     */
    public function asString(callable $validate = null);

    /**
     * @param callable $validate
     * @return int
     */
    public function asInteger(callable $validate = null);

    /**
     * @param callable $validate
     * @return bool
     */
    public function asBoolean(callable $validate = null);

    /**
     * @param callable $validate
     * @return array
     */
    public function asArray(callable $validate = null);
}
