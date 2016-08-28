<?php

require __DIR__.'/../vendor/autoload.php';

use Dotenv\Dotenv;

if (!getenv('TRAVIS')) {
    $dotenv = new Dotenv(__DIR__.'/..');
    $dotenv->load();
    $dotenv->required('API_KEY')->notEmpty();
}
