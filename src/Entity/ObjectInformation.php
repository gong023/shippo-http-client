<?php

namespace ShippoClient\Entity;

use TurmericSpice\Container\OptionalValue;
use TurmericSpice\ReadableAttributes;

class ObjectInformation
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
        $optionalValue = $this->attributes->mayHave('object_created');
        if ($optionalValue->value() === null) {
            $optionalValue = new OptionalValue('object_created', '');
        }

        return $optionalValue->asInstanceOf('\\DateTime');
    }

    /**
     * Date and time of last object update.
     *
     * @return \DateTime
     */
    public function getObjectUpdated()
    {
        $optionalValue = $this->attributes->mayHave('object_updated');
        if ($optionalValue->value() === null) {
            $optionalValue = new OptionalValue('object_updated', '');
        }

        return $optionalValue->asInstanceOf('\\DateTime');
    }
}
