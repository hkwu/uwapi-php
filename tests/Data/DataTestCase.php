<?php

namespace Tests\Data;

use Tests\APITestCase;
use UWaterlooAPI\Requests\RequestClient;

class DataTestCase extends APITestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = new RequestClient(getenv('API_KEY'));
    }
}
