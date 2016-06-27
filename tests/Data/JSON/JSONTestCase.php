<?php

namespace Tests\Data\JSON;

use Tests\Data\DataTestCase;
use UWaterlooAPI\Requests\RequestClient;

class JSONTestCase extends DataTestCase
{
    protected $model;

    public function setUp()
    {
        parent::setUp();
        $this->client->setFormat(RequestClient::JSON);
    }
}
