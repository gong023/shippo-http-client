<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

abstract class EntityCollection extends \ArrayObject
{
    public function toArray()
    {
        $ret = [];
        /** @var ReadableAttributes $entity */
        foreach ($this->getArrayCopy() as $entity) {
            $ret[] = $entity->toArray();
        }
        return $ret;
    }
}
