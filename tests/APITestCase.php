<?php

namespace Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class APITestCase extends TestCase
{
    public static function setUpBeforeClass()
    {
        $dotenv = new Dotenv(__DIR__.'/..');
        $dotenv->load();
        $dotenv->required('API_KEY')->notEmpty();
    }
}
