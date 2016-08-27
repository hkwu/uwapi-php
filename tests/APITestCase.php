<?php

namespace Tests;

use Dotenv\Dotenv;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use UWaterlooAPI\Requests\Client;

class APITestCase extends TestCase
{
    const FAKER_SEED = 1000;

    protected static $faker;
    protected $client;

    public static function setUpBeforeClass()
    {
        $dotenv = new Dotenv(__DIR__.'/..');
        $dotenv->load();
        $dotenv->required('API_KEY')->notEmpty();

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
