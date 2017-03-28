<?php

namespace ShippoClient\Entity;

use TurmericSpice\ReadableAttributes;

class Address extends ObjectInformation
{
    use ReadableAttributes {
        mayHaveAsString as public getZip;
        mayHaveAsString as public getCountry;
        mayHaveAsString as public getPhone;
        mayHaveAsString as public getEmail;
        mayHaveAsString as public getIp;
        mayHaveAsString as public getMetadata;
        mayHaveAsArray  as public getMessages;
    }

    public function getName()
    {
        return $this->mayHaveAsAsciiString('name');
    }

    public function getCompany()
    {
        return $this->mayHaveAsAsciiString('company');
    }

    public function getStreet1()
    {
        return $this->mayHaveAsAsciiString('street1');
    }

    public function getStreet2()
    {
        return $this->mayHaveAsAsciiString('street2');
    }

    public function getStreetNo()
    {
        return $this->mayHaveAsAsciiString('street_no');
    }

    public function getCity()
    {
        return $this->mayHaveAsAsciiString('city');
    }

    public function getState()
    {
        return $this->mayHaveAsAsciiString('state');
    }

    public function getIsResidential()
    {
        $is_residential = $this->attributes->mayHave('is_residential')->value();
        if ($is_residential === null) {
            return null;
        }

        return (bool)$is_residential;
    }

    private function mayHaveAsAsciiString($propertyName, callable $validate = null)
    {
        return $this->transliterateToAscii(
            $this->attributes->mayHave($propertyName)->asString($validate)
        );
    }

    private function mustHaveAsAsciiString($propertyName, callable $validate = null)
    {
        return $this->transliterateToAscii(
            $this->attributes->mustHave($propertyName)->asString($validate)
        );
    }

    private function transliterateToAscii($str)
    {
        $ret = '';
        foreach (preg_split('//u', $str) as $ch) {
            $ch = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $ch);
            if (strlen($ch) > 1) {
                $ch = preg_replace('/[^0-9A-Za-z]/', '', $ch);
            }
            $ret .= $ch;
        }
        return $ret;
    }
}
