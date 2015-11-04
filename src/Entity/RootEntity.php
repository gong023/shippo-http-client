<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

abstract class RootEntity
{
    use ReadableAttributes {
        mayHaveAsString as public getObjectState;
        mayHaveAsString as public getObjectPurpose;
        mayHaveAsString as public getObjectSource;
        mayHaveAsString as public getObjectId;
        mayHaveAsString as public getObjectOwner;
    }

    /**
     * Date and time of object creation.
     *
     * @return \DateTime
     */
    public function getObjectCreated()
    {
        return $this->attributes->mayHave('object_created')->asInstanceOf('\\DateTime');
    }

    /**
     * Date and time of last object update.
     *
     * @return \DateTime
     */
    public function getObjectUpdated()
    {
        return $this->attributes->mayHave('object_updated')->asInstanceOf('\\DateTime');
    }
}
