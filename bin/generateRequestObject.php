<?php
/**
 * WARNING!! THIS SCRIPT IS ONLY FOR DEVELOP.
 */

$domain = 'shipments';
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

use ShippoClient\Http\Response\\{$upperDomain} as {$upperDomain}Response;
use ShippoClient\Http\Response\\{$upperDomain}Collection as {$upperDomain}ResponseCollection;
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

        return new {$upperDomain}Response(\$responseArray);
    }


CREATEMETHOD;
}

if ($config['retrieve']['exist']) {
    echo <<<RETRIVEMETHOD
    public function retrieve(\$objectId)
    {
        \$responseArray = \$this->request->get("$domain/\$objectId");

        return new {$upperDomain}Response(\$responseArray);
    }


RETRIVEMETHOD;
}

if ($config['getList']['exist']) {
    echo <<<GETLISTMETHOD
    /**
     * @param null|int \$results
     * @return {$upperDomain}ResponseCollection
     */
    public function getList(\$results = null)
    {
        \$responseArray = \$this->request->get("$domain", array('results' => \$results));

        return new {$upperDomain}ResponseCollection(\$responseArray);
    }


GETLISTMETHOD;
}

echo <<<FOOTER
}


FOOTER;
