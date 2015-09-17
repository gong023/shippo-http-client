<?php

namespace ShippoClient\Entity;

abstract class EntityCollection extends \ArrayObject
{
    public function toArray()
    {
        $ret = array();
        /** @var Entity $entity */
        foreach ($this->getArrayCopy() as $entity) {
            $ret[] = $entity->toArray();
        }
        return $ret;
    }
}
