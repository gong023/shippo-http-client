<?php
/**
 * WARNING!! THIS SCRIPT IS ONLY FOR DEVELOP.
 */

$domain = 'refunds';
$singleUpperDomain = 'Refunds';
$upperDomain = ucfirst($domain);
$config = array(
    'create' => array(
        'exist' => true,
    ),
    'retrieve' => array(
        'exist' => true,
    ),
    'getList' => array(
        'exist' => true,
    ),
);

echo <<<HEADER
<?php

namespace ShippoClient;

use ShippoClient\Http\Response\\{$upperDomain}\\{$singleUpperDomain} as {$singleUpperDomain}Response;
use ShippoClient\Http\Response\\{$upperDomain}\\{$singleUpperDomain}Collection as {$singleUpperDomain}ResponseCollection;
use ShippoClient\Http\Request;
use ShippoClient\Http\Request\\{$upperDomain}\CreateObject;

class {$upperDomain}
{
    private \$request;

    public function __construct(Request \$request)
    {
        \$this->request = \$request;
    }


HEADER;

if ($config['create']['exist']) {
    echo <<<CREATEMETHOD
    public function create(array \$attributes)
    {
        \$createObj = new CreateObject(\$attributes);
        \$responseArray = \$this->request->post('$domain', \$createObj->toArray());

        return new {$singleUpperDomain}Response(\$responseArray);
    }


CREATEMETHOD;
}

if ($config['retrieve']['exist']) {
    echo <<<RETRIVEMETHOD
    public function retrieve(\$objectId)
    {
        \$responseArray = \$this->request->get("$domain/\$objectId");

        return new {$singleUpperDomain}Response(\$responseArray);
    }


RETRIVEMETHOD;
}

if ($config['getList']['exist']) {
    echo <<<GETLISTMETHOD
    /**
     * @param null|int \$results
     * @return {$singleUpperDomain}ResponseCollection
     */
    public function getList(\$results = null)
    {
        \$responseArray = \$this->request->get("$domain", array('results' => \$results));

        return new {$singleUpperDomain}ResponseCollection(\$responseArray);
    }


GETLISTMETHOD;
}

echo <<<FOOTER
}


FOOTER;
