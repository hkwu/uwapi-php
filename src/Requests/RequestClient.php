<?php

namespace UWaterlooAPI\Requests;

use GuzzleHttp\Client;
use UWaterlooAPI\Data\APIModelFactory;

require __DIR__.'/../../vendor/autoload.php';

class RequestClient
{
    private $apiKey;
    private $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => RequestConstants::BASE_API_URL
        ]);
    }

    /**
     * Sends a request to the API. Can take parameters to specify specific endpoints.
     *
     * @param string $endpoint The API endpoint.
     * @param array $params Array containing parameters to be substituted into
     *   the request URL, in the order given.
     * @param string $type The desired response format from the API.
     * @throws \GuzzleHttp\Exception\RequestException Exception thrown when Guzzle
     *   encounters an error.
     * @return \UWaterlooAPI\Data\APIModel Returns API model object.
     */
    public function makeRequest($endpoint, $params, $type)
    {
        $response = $this->client->get($this->buildRequest($endpoint, $params, $type));
        $responseBody = $this->decodeResponseBody($response->getBody());

        return APIModelFactory::makeModel($type, $responseBody);
    }

    private function buildRequest($endpoint, $params, $type)
    {
        $queryStringParams = [
            'key' => $this->apiKey
        ];

        return vsprintf($endpoint, $params).'.'.$type.'?'.http_build_query($queryStringParams);
    }

    private function decodeResponseBody($responseBody)
    {
        return (string) $responseBody;
    }
}
