<?php

namespace UWaterlooAPI\Requests;

use GuzzleHttp\Client;
use UWaterlooAPI\Data\APIModelFactory;

require __DIR__.'/../../vendor/autoload.php';

class RequestClient
{
    // API constants
    const BASE_API_URL = 'https://api.uwaterloo.ca/v2/';
    const JSON = 'json';
    const XML = 'xml';

    // food services
    const FS_MENU = 'foodservices/menu';
    const FS_NOTES = 'foodservices/notes';
    const FS_DIETS = 'foodservices/diets';
    const FS_OUTLETS = 'foodservices/outlets';
    const FS_LOCATIONS = 'foodservices/locations';
    const FS_WATCARD = 'foodservices/watcard';
    const FS_ANNOUNCEMENTS = 'foodservices/announcements';
    const FS_PRODUCTS = 'foodservices/products/%d';
    const FS_MENU_YW = 'foodservices/%d/%d/menu';
    const FS_NOTES_YW = 'foodservices/%d/%d/notes';
    const FS_ANNOUNCEMENTS_YW = 'foodservices/%d/%d/announcements';

    private $apiKey;
    private $client;
    private $format;

    public function __construct($apiKey, $format = null)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => self::BASE_API_URL,
        ]);
        $this->format = $format;
    }

    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    public function getFSMenu()
    {
        if (func_num_args() === 2) {
            return $this->translateRequest(self::FS_MENU_YW, func_get_args());
        } else {
            return $this->translateRequest(self::FS_MENU);
        }
    }

    public function getFSNotes()
    {
        if (func_num_args() === 2) {
            return $this->translateRequest(self::FS_NOTES_YW, func_get_args());
        } else {
            return $this->translateRequest(self::FS_NOTES);
        }
    }

    public function getFSDiets()
    {
        return $this->translateRequest(self::FS_DIETS);
    }

    public function getFSOutlets()
    {
        return $this->translateRequest(self::FS_DIETS);
    }
    
    public function getFSLocations()
    {
        return $this->translateRequest(self::FS_LOCATIONS);
    }
    
    public function getFSWatCard()
    {
        return $this->translateRequest(self::FS_WATCARD);
    }
    
    public function getFSAnnouncements()
    {
        if (func_num_args() === 2) {
            return $this->translateRequest(self::FS_ANNOUNCEMENTS_YW, func_get_args());
        } else {
            return $this->translateRequest(self::FS_ANNOUNCEMENTS);
        }
    }
    
    public function getFSProducts($productId)
    {
        return $this->translateRequest(self::FS_PRODUCTS, [$productId]);
    }

    /**
     * Sends a request to the API. Can take parameters to specify specific endpoints.
     *
     * @param string $endpoint The API endpoint.
     * @param array  $params   Array containing parameters to be substituted into
     *                         the request URL, in the order given.
     * @param string $format   The desired response format from the API.
     *
     * @throws \GuzzleHttp\Exception\RequestException Exception thrown when Guzzle encounters an error.
     *
     * @return \UWaterlooAPI\Data\APIModel Returns API model object.
     */
    public function makeRequest($endpoint, array $params, $format)
    {
        $response = $this->client->get($this->buildRequest($endpoint, $params, $format));
        $responseBody = $this->decodeResponseBody($response->getBody());

        return APIModelFactory::makeModel($format, $endpoint, $responseBody);
    }

    private function buildRequest($endpoint, array $params, $format)
    {
        $queryStringParams = [
            'key' => $this->apiKey,
        ];

        return vsprintf($endpoint, $params).'.'.$format.'?'.http_build_query($queryStringParams);
    }

    private function translateRequest($endpoint, array $params = [])
    {
        return $this->makeRequest($endpoint, $params, $this->format);
    }

    private function decodeResponseBody($responseBody)
    {
        return (string) $responseBody;
    }
}
