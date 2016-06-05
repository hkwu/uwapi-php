<?php

namespace UWaterlooAPI\Requests;

use GuzzleHttp\Client;

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
     * @param array $params Array containing parameters to be substituted into
     *   the request URL, in the order given.
     * @throws \GuzzleHttp\Exception\RequestException Exception thrown when Guzzle
     *   encounters an error.
     * @return array Returns response body.
     */
    public function makeRequest($endpoint, $params = [])
    {
        $responseBody = null;

        $response = $this->client->get($this->buildRequest($endpoint, $params));
        $responseBody = $this->decodeResponseBody($response->getBody());

        return $responseBody;
    }

    // TODO make it work with XML
    private function buildRequest($endpoint, $params)
    {
        $queryStringParams = [
            'key' => $this->apiKey
        ];

        return vsprintf($endpoint, $params).'.json?'.http_build_query($queryStringParams);
    }

    // TODO make it work with XML
    private function decodeResponseBody($responseBody)
    {
        return json_decode((string) $responseBody, true);
    }
}
