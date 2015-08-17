<?php

namespace ShippoClient\Http;

use ShippoClient\Attributes;

abstract class Response
{
    protected $attributes;

    public function __construct(array $rawResponse)
    {
        $this->attributes = new Attributes($rawResponse);
    }

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
     * @return string
     */
    public function getObjectCreated()
    {
        return $this->attributes->mayHave('object_created')->asString();
    }

    /**
     * Date and time of last object update.
     *
     * @return string
     */
    public function getObjectUpdated()
    {
        return $this->attributes->mayHave('object_updated')->asString();
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

    abstract public function toArray();
}
