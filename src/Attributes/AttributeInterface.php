<?php

namespace ShippoClient\Attributes;

interface AttributeInterface
{
    /**
     * @param callable|null $validate
     * @return string
     */
    public function asString($validate = null);

    /**
     * @param callable|null $validate
     * @return int
     */
    public function asInteger($validate = null);

    /**
     * @param callable|null $validate
     * @return mixed
     */
    public function asFloat($validate = null);

    /**
     * @param callable|null $validate
     * @return bool
     */
    public function asBoolean($validate = null);

    /**
     * @param callable|null $validate
     * @return array
     */
    public function asArray($validate = null);
}
