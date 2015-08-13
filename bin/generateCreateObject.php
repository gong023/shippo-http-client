<?php
/**
 * WARNING!! THIS SCRIPT IS ONLY FOR DEVELOP.
 */

$nameSpace = "Transactions";
$attributes = array(
    "rate"=> array("type" => "string", "required" => true,),
    "metadata"=> array("type" => "string", "required" => false,),
);

function snakeToCamel($val)
{
    return str_replace(' ', '', ucwords(str_replace('_', ' ', $val)));
}

echo <<<HEADER
<?php

namespace ShippoClient\Http\Request\\{$nameSpace};

use ShippoClient\Attributes\InvalidAttributeException;
use ShippoClient\Attributes;

class CreateObject
{
    public function __construct(array \$attributes)
    {
        \$this->attributes = new Attributes(\$attributes);
    }


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
