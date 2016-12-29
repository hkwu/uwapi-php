# uwapi-php

[![Latest Stable Version](https://poser.pugx.org/hkwu/uwapi-php/v/stable)](https://packagist.org/packages/hkwu/uwapi-php)
[![Build Status](https://travis-ci.org/hkwu/uwapi-php.svg?branch=master)](https://travis-ci.org/hkwu/uwapi-php)
[![License](https://poser.pugx.org/hkwu/uwapi-php/license)](https://packagist.org/packages/hkwu/uwapi-php)

A PHP wrapper for the University of Waterloo's [Open Data API](https://uwaterloo.ca/api/) supporting asynchronous requests through [Guzzle](http://docs.guzzlephp.org/en/latest/).

This library requires PHP 7.0 or greater.

## Installation

Install the client via [Composer](https://getcomposer.org/).

For global installations,
```bash
composer require hkwu/uwapi-php
```

For local installations,
```bash
php composer.phar require hkwu/uwapi-php
```

## Usage

All request methods are wrapped inside the library's `Client` class.

```php
<?php

// require the Composer autoloader
require __DIR__.'/vendor/autoload.php';

use UWaterlooAPI\Client;
use UWaterlooAPI\Endpoints;

// make a client
$client = new Client([
    'key' => '6b9e30736f2c741ee02c431dc1cf68b0', // your API key
]);

// change some client configuration options
// setConfig() will merge the provided options into the existing client configuration
$client->setConfig([
    'format' => Client::XML,
]);
```

The configuration options the `Client` constructor takes are listed below.

| Option | Default | Description |
| :----: | :-----: | :---------- |
| `key`  | -       | Your API access key. |
| `format` | `'json'` | The format you wish the API response to be in. The `Client` provides these values as constants (e.g. `Client::JSON`). |
| `async` | `true` | True if requests should be made asynchronously. |

### Making Requests

The `Client` class comes with the `request()` method for sending requests to the API.

```php
/**
 * MAKE A REQUEST
 * 
 * By default, requests are asynchronous and return promises.
 */
$promise = $client->request(Endpoints::FS_MENU); // request constants are available in the Endpoints class
$promise->then(
    function ($model) { // the success callback will receive an APIModel object
        echo $model->getMeta()['message'].PHP_EOL;
    },
    function ($error) { // the error callback will receive a Guzzle RequestException
        echo $error->getMessage().PHP_EOL;
    }
);

/**
 * PARAMETERIZED REQUESTS
 *
 * Some endpoints are parameterized and require a second argument 
 *   to be supplied to request().
 */
$promise = $client->request(Endpoints::BLOGS_SITE_ID, [
    'site' => 'student-success',
    'id' => 7721,
]);

/**
 * FORMATTING ENDPOINT STRINGS
 *
 * If you don't want to use the provided request constants,
 *   you can provide a string which will be formatted by the client.
 */
$promise = $client->request('news/{myParam1}/{myParam2}', [
    'myParam1' => 'student-success',
    'myParam2' => 7721,
]);

/**
 * OVERRIDING THE CLIENT CONFIGURATION
 *
 * You can also override client config options on a per-request 
 *   basis by supplying a third argument to request().
 */
$model = $client->request(
    Endpoints::BLOGS_SITE_ID, 
    [
        'site' => 'student-success',
        'id' => 7721,
    ], 
    [
        'async' => false, // make this request synchronous
    ]
);
```

You can send several requests all at once by using the `batch()` method.

```php

/**
 * SPECIFY ENDPOINTS
 *
 * Array containing endpoints to send requests to the
 *   keys are optional, an indexed array works as well.
 */
$endpoints = [
    'menu' => Endpoints::FS_MENU,
    'events' => Endpoints::EVENTS_SITE_ID,
    'news' => Endpoints::NEWS_SITE_ID,
];

/**
 * SPECIFY PARAMETERS
 *
 * The parameters for each endpoint request.
 * The keys here should match the ones specified in $endpoints.
 * For endpoints requiring no parameters, you may simply omit their key.
 */
$params = [
    'events' => [
        'site' => 'engineering',
        'id' => 1701,
    ],
    'news' => [
        'site' => 'science',
        'id' => 881,
    ],
];

/**
 * SPECIFY OPTIONS
 *
 * Options that affect the entire batch of requests.
 * Only the 'format' option will be accepted here.
 */
$options = [
    'format' => Client::XML,
];

/**
 * MAKE THE REQUESTS
 *
 * Returns an array of APIModels where each key corresponds
 *   to the keys provided in $endpoints.
 * Both $params and $options are optional.
 */
$models = $client->batch($endpoints, $params, $options);
```

### Accessing Response Data

Returned responses from the API are wrapped in data model classes. All data models provide the `getRawData()` method, which returns the API response as a string.

The JSON (and by extension, GeoJSON) data models provide some additional convenience methods.

```php
$jsonModel = $client->request(Endpoints::FS_MENU, [], [
    'format' => Client::JSON,
    'async' => false,
]);

$jsonModel->getDecodedData(); // json_decodes the response into an array
$jsonModel->getMeta(); // equivalent to $jsonModel->getDecodedData()['meta']
$jsonModel->getData(); // equivalent to $jsonModel->getDecodedData()['data']

// equivalent to $jsonModel->getDecodedData()['data']['date']['year']
$jsonModel->get('data', 'date', 'year');
```

### Endpoints

The library provides a number of constants to use when making requests. Most of these constants follow directly from the endpoints as provided in the API documentation, but a few have been tweaked to be more usable.

| Constant | Value |
| -------- | ----- |
| `FS_MENU` | `'foodservices/menu'` |
| `FS_NOTES` | `'foodservices/notes'` |
| `FS_DIETS` | `'foodservices/diets'` |
| `FS_OUTLETS` | `'foodservices/outlets'` |
| `FS_LOCATIONS` | `'foodservices/locations'` |
| `FS_WATCARD` | `'foodservices/watcard'` |
| `FS_ANNOUNCEMENTS` | `'foodservices/announcements'` |
| `FS_PRODUCTS_ID` | `'foodservices/products/{product_id}'` |
| `FS_YEAR_WEEK_MENU` | `'foodservices/{year}/{week}/menu'` |
| `FS_YEAR_WEEK_NOTES` | `'foodservices/{year}/{week}/notes'` |
| `FS_YEAR_WEEK_ANNOUNCEMENTS` | `'foodservices/{year}/{week}/announcements'` |
| `FEDS_EVENTS` | `'feds/events'` |
| `FEDS_EVENTS_ID` | `'feds/events/{id}'` |
| `FEDS_LOCATIONS` | `'feds/locations'` |
| `COURSES` | `'courses'` |
| `COURSES_SUBJECT` | `'courses/{subject}'` |
| `COURSES_ID` | `'courses/{course_id}'` |
| `COURSES_CLASS_SCHEDULE` | `'courses/{class_number}/schedule'` |
| `COURSES_SUBJECT_CATALOG` | `'courses/{subject}/{catalog_number}'` |
| `COURSES_SUBJECT_CATALOG_SCHEDULE` | `'courses/{subject}/{catalog_number}/schedule'` |
| `COURSES_SUBJECT_CATALOG_PREREQUISITES` | `'courses/{subject}/{catalog_number}/prerequisites'` |
| `COURSES_SUBJECT_CATALOG_EXAMSCHEDULE` | `'courses/{subject}/{catalog_number}/examschedule'` |
| `AWARDS_GRAD` | `'awards/graduate'` |
| `AWARDS_UNDERGRAD` | `'awards/undergraduate'` |
| `EVENTS` | `'events'` |
| `EVENTS_SITE` | `'events/{site}'` |
| `EVENTS_SITE_ID` | `'events/{site}/{id}'` |
| `EVENTS_HOLIDAYS` | `'events/holidays'` |
| `BLOGS_SITE` | `'blogs/{site}'` |
| `BLOGS_SITE_ID` | `'blogs/{site}/{id}'` |
| `NEWS` | `'news'` |
| `NEWS_SITE` | `'news/{site}'` |
| `NEWS_SITE_ID` | `'news/{site}/{id}'` |
| `OPPORTUNITIES` | `'opportunities'` |
| `OPPORTUNITIES_SITE` | `'opportunities/{site}'` |
| `OPPORTUNITIES_SITE_ID` | `'opportunities/{site}/{id}'` |
| `SERVICES_SITE` | `'services/{site}'` |
| `WEATHER_CURRENT` | `'weather/current'` |
| `TERMS_LIST` | `'terms/list'` |
| `TERMS_TERM_COURSES` | `'terms/{term}/courses'` |
| `TERMS_TERM_EXAMS` | `'terms/{term}/examschedule'` |
| `TERMS_TERM_SUBJECT_SCHEDULE` | `'terms/{term}/{subject}/schedule'` |
| `TERMS_TERM_SUBJECT_CATALOG_SCHEDULE` | `'terms/{term}/{subject}/{catalog_number}/schedule'` |
| `TERMS_TERM_ENROLLMENT` | `'terms/{term}/enrollment'` |
| `TERMS_TERM_SUBJECT_ENROLLMENT` | `'terms/{term}/{subject}/enrollment'` |
| `TERMS_TERM_INFOSESSIONS` | `'terms/{term}/infosessions'` |
| `RESOURCES_TUTORS` | `'resources/tutors'` |
| `RESOURCES_INFOSESSIONS` | `'resources/infosessions'` |
| `RESOURCES_GOOSEWATCH` | `'resources/goosewatch'` |
| `RESOURCES_SUNSHINELIST` | `'resources/sunshinelist'` |
| `CODES_UNITS` | `'codes/units'` |
| `CODES_TERMS` | `'codes/terms'` |
| `CODES_GROUPS` | `'codes/groups'` |
| `CODES_SUBJECTS` | `'codes/subjects'` |
| `CODES_INSTRUCTIONS` | `'codes/instructions'` |
| `BUILDINGS_LIST` | `'buildings/list'` |
| `BUILDINGS_CODE` | `'buildings/{building_code}'` |
| `BUILDINGS_BUILDING_ROOM_COURSES` | `'buildings/{building}/{room}/courses'` |
| `BUILDINGS_CODE_ACCESSPOINTS` | `'buildings/{building_code}/accesspoints'` |
| `BUILDINGS_CODE_VENDINGMACHINES` | `'buildings/{building_code}/vendingmachines'` |
| `POI_ATMS` | `'poi/atms'` |
| `POI_GREYHOUND` | `'poi/greyhound'` |
| `POI_HELPLINES` | `'poi/helplines'` |
| `POI_LIBRARIES` | `'poi/libraries'` |
| `POI_PHOTOSPHERES` | `'poi/photospheres'` |
| `POI_DEFIBRILLATORS` | `'poi/defibrillators'` |
| `POI_CONSTRUCTIONSITES` | `'poi/constructionsites'` |
| `POI_ACCESSIBLEENTRANCES` | `'poi/accessibleentrances'` |
| `POI_VISITORINFORMATION` | `'poi/visitorinformation'` |
| `PARKING_WATPARK` | `'parking/watpark'` |
| `PARKING_LOTS_METER` | `'parking/lots/meter'` |
| `PARKING_LOTS_PERMIT` | `'parking/lots/permit'` |
| `PARKING_LOTS_VISITOR` | `'parking/lots/visitor'` |
| `PARKING_LOTS_SHORTTERM` | `'parking/lots/shortterm'` |
| `PARKING_LOTS_ACCESSIBLE` | `'parking/lots/accessible'` |
| `PARKING_LOTS_MOTORCYCLE` | `'parking/lots/motorcycle'` |
| `TRANSIT_GRT` | `'transit/grt'` |
| `TRANSIT_GRT_STOPS` | `'transit/grt/stops'` |
| `DIRECTORY_ID` | `'directory/{user_id}'` |
| `API_USAGE` | `'api/usage'` |
| `API_SERVICES` | `'api/services'` |
| `API_METHODS` | `'api/methods'` |
| `API_VERSIONS` | `'api/versions'` |
| `API_CHANGELOG` | `'api/changelog'` |
| `SERVER_TIME` | `'server/time'` |
| `SERVER_CODES` | `'server/codes'` |

## Contributing

Feel free to make pull requests for any changes.

Just a couple of things:
* Add unit tests for any new functionality.
  * You can run the entire test suite using `vendor/bin/phpunit` from the project root.
* Follow the [PSR-1](http://www.php-fig.org/psr/psr-1/) and [PSR-2](http://www.php-fig.org/psr/psr-2/) style guides.
