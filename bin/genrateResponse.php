<?php
/**
 * WARNING!! THIS SCRIPT IS ONLY FOR DEVELOP.
 */

$className = "Rates";
$attributes = array(
    "object_state"=> array("type" => "string", "required" => false,),
    "object_purpose"=> array("type" => "string", "required" => false,),
    "object_created"=> array("type" => "string", "required" => false,),
    "object_updated"=> array("type" => "string", "required" => false,),
    "object_id"=> array("type" => "string", "required" => false,),
    "object_owner"=> array("type" => "string", "required" => false,),
    "shipment" => array("type" => "string", "required" => false,),
    "attributes" => array("type" => "array", "required" => false,),
    "amount_local"=> array("type" => "float", "required" => false,),
    "currency_local"=> array("type" => "string", "required" => false,),
    "amount"=> array("type" => "float", "required" => false,),
    "currency"=> array("type" => "string", "required" => false,),
    "provider"=> array("type" => "string", "required" => false,),
    "provider_image_75"=> array("type" => "string", "required" => false,),
    "provider_image_200"=> array("type" => "string", "required" => false,),
    "servicelevel_name"=> array("type" => "string", "required" => false,),
    "servicelevel_terms"=> array("type" => "string", "required" => false,),
    "days"=> array("type" => "string", "required" => false,),
    "duration_terms" => array("type" => "string", "required" => false,),
    "trackable"=> array("type" => "boolean", "required" => false,),
    "insurance"=> array("type" => "boolean", "required" => false,),
    "insurance_amount_local"=> array("type" => "float", "required" => false,),
    "insurance_currency_local"=> array("type" => "string", "required" => false,),
    "insurance_amount"=> array("type" => "float", "required" => false,),
    "insurance_currency"=> array("type" => "string", "required" => false,),
    "carrier_account"=> array("type" => "string", "required" => false,),
    "messages"=> array("type" => "array", "required" => false,),
);

function snakeToCamel($val)
{
    return str_replace(' ', '', ucwords(str_replace('_', ' ', $val)));
}

echo <<<HEADER
<?php

namespace ShippoClient\Http\Response;

use ShippoClient\Attributes;
use ShippoClient\Http\Response;

class $className extends Response
{


HEADER;

foreach ($attributes as $attribute => $info) {
    $method = snakeToCamel($attribute);
    $may_or_must = $info['required'] ? 'must' : 'may';
    $type = 'as' . ucfirst($info['type']);
    if ($type === 'asValue') {
        $type = 'value';
    }
    echo <<<METHODS
    public function get$method()
    {
        return \$this->attributes->{$may_or_must}Have('$attribute')->$type();
    }


METHODS;
}

echo <<<TOARRAYHEADER
    public function toArray()
    {
        return array(

TOARRAYHEADER;

foreach ($attributes as $attribute => $info) {
    $method = snakeToCamel($attribute);
    echo <<<TOARRAY
            '$attribute' => \$this->get$method(),

TOARRAY;
}

echo <<<TOARRAYFOOTER
        );
    }

TOARRAYFOOTER;

echo <<<FOOTER
}


FOOTER;
