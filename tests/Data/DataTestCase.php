<?php

namespace Tests\Data;

use Tests\APITestCase;
use UWaterlooAPI\Requests\RequestClient;

class DataTestCase extends APITestCase
{
    const FLOAT_DELTA = 0.0001;

    protected $client;

    public function setUp()
    {
        $this->client = new RequestClient(getenv('API_KEY'));
    }
}
