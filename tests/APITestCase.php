<?php

namespace Tests;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use UWaterlooAPI\Client;

class APITestCase extends TestCase
{
    const FAKER_SEED = 1000;

    protected static $faker;
    protected $client;

    public static function setUpBeforeClass()
    {
        self::$faker = Factory::create();
        self::$faker->seed(self::FAKER_SEED);
    }

    public function setUp()
    {
        $this->client = new Client([
            'key' => getenv('API_KEY'),
        ]);
    }
}
