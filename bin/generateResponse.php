<?php
/**
 * WARNING!! THIS SCRIPT IS ONLY FOR DEVELOP.
 */

$domain = 'Transactions';
$className = "Transaction";
$attributes = array(
    "object_state" => array('required' => false, 'type' => 'string'),
    "object_status" => array('required' => false, 'type' => 'string'),
    "object_created" => array('required' => false, 'type' => 'string'),
    "object_updated" => array('required' => false, 'type' => 'string'),
    "object_id" => array('required' => false, 'type' => 'string'),
    "object_owner" => array('required' => false, 'type' => 'string'),
    "was_test" => array('required' => false, 'type' => 'boolean'),
    "rate" => array('required' => false, 'type' => 'string'),
    "tracking_number" => array('required' => false, 'type' => 'string'),
    "tracking_status" => array('required' => false, 'type' => 'array'),
    "tracking_url_provider" => array('required' => false, 'type' => 'string'),
    "label_url" => array('required' => false, 'type' => 'string'),
    "commercial_invoice_url"  => array('required' => false, 'type' => 'string'),
    "messages" => array('required' => false, 'type' => 'array'),
    "customs_note" => array('required' => false, 'type' => 'string'),
    "submission_note" => array('required' => false, 'type' => 'string'),
    "metadata" => array('required' => false, 'type' => 'string')
);

function snakeToCamel($val)
{
    return str_replace(' ', '', ucwords(str_replace('_', ' ', $val)));
}

echo <<<HEADER
<?php

namespace ShippoClient\Http\Response\\{$domain};

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
