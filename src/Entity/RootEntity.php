<?php

namespace ShippoClient\Entity;

use ShippoClient\Attributes;

abstract class RootEntity extends Entity
{
    public function getObjectState()
    {
        return $this->attributes->mayHave('object_state')->asString();
    }

    public function getObjectPurpose()
    {
        return $this->attributes->mayHave('object_purpose')->asString();
    }

    public function getObjectSource()
    {
        return $this->attributes->mayHave('object_source')->asString();
    }

    /**
     * Date and time of object creation.
     *
     * @return \DateTime
     */
    public function getObjectCreated()
    {
        return $this->attributes->mayHave('object_created')->asInstance('\\DateTime');
    }

    /**
     * Date and time of last object update.
     *
     * @return \DateTime
     */
    public function getObjectUpdated()
    {
        return $this->attributes->mayHave('object_updated')->asInstance('\\DateTime');
    }

    /**
     * Unique identifier of the given object.
     *
     * @return string
     */
    public function getObjectId()
    {
        return $this->attributes->mayHave('object_id')->asString();
    }

    /**
     * Username of the user who created the object.
     *
     * @return string
     */
    public function getObjectOwner()
    {
        return $this->attributes->mayHave('object_owner')->asString();
    }
}
