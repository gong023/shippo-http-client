<?php

namespace ShippoClient\Attributes;

interface AttributeInterface
{
    /**
     * @param callable|null $validate
     * @return string
     */
    public function asString(callable $validate = null);

    /**
     * @param callable|null $validate
     * @return int
     */
    public function asInteger(callable $validate = null);

    /**
     * @param callable|null $validate
     * @return mixed
     */
    public function asFloat(callable $validate = null);

    /**
     * @param callable|null $validate
     * @return bool
     */
    public function asBoolean(callable $validate = null);

    /**
     * @param callable|null $validate
     * @return array
     */
    public function asArray(callable $validate = null);

    /**
     * @param string $className
     * @param callable|null $validate
     * @return mixed
     */
    public function asInstance($className, callable $validate = null);
}
