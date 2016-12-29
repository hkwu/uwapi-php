<?php

namespace UWaterlooAPI;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\RejectedPromise;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use StringTemplate\Engine;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UWaterlooAPI\Data\APIModel;
use UWaterlooAPI\Data\APIModelFactory;
use function GuzzleHttp\Promise\unwrap;

/**
 * The library client.
 */
class Client
{
    // API constants
    const BASE_API_URL = 'https://api.uwaterloo.ca/v2/';
    const JSON = 'json';
    const GEOJSON = 'geojson';
    const XML = 'xml';

    /**
     * @var array A set of configuration options for the client
     */
    private $config;

    /**
     * @var array The formats which are valid for making requests with
     */
    private $validFormats = [
        self::JSON,
        self::GEOJSON,
        self::XML,
    ];

    /**
     * @var OptionsResolver Options resolver for the client
     */
    private $resolver;

    /**
     * @var Engine The string templating engine
     */
    private $templateEngine;

    /**
     * @var GuzzleClient The Guzzle client
     */
    private $client;

    /**
     * RequestClient constructor.
     *
     * @param array $config Configuration options for the client
     */
    public function __construct(array $config = [])
    {
        $this->resolver = new OptionsResolver();
        $this->resolver->setRequired([
            'key',
        ])->setDefaults([
            'format' => self::JSON,
            'async' => true,
        ])->setAllowedTypes('key', 'string')
          ->setAllowedTypes('format', 'string')
          ->setAllowedTypes('async', 'bool')
          ->setAllowedValues('format', $this->validFormats);

        $this->config = $this->resolver->resolve($config);
        $this->templateEngine = new Engine();
        $this->client = new GuzzleClient([
            'base_uri' => self::BASE_API_URL,
        ]);
    }

    /**
     * Computes the resolved options from a given config array
     *   and merges them into the current client configs.
     *
     * @param array $config Array containing options to change in the config
     *
     * @return Client The client
     */
    public function setConfig(array $config): Client
    {
        $this->config = $this->resolver->resolve(array_merge($this->config, $config));

        return $this;
    }

    /**
     * Sends a request to the API. Can take parameters to specify specific endpoints.
     *
     * @param string $endpoint The API endpoint
     * @param array  $params   Array containing parameters to be substituted into
     *                         the request URL, in the order given
     * @param array  $options  Array of options for this request
     *
     * @throws \Exception Exception thrown when options array is configured incorrectly
     *
     * @return APIModel|\GuzzleHttp\Promise\PromiseInterface Returns API model object, or a promise if request was asynchronous
     */
    public function request(string $endpoint, array $params = [], array $options = [])
    {
        $format = $this->getDefaultOption($options, 'format');
        $async = $this->getDefaultOption($options, 'async');

        if (!in_array($format, $this->validFormats, true)) {
            throw new \Exception(sprintf('Invalid format specified for request: %s.', $format));
        }

        if ($async) {
            return $this->client->getAsync($this->buildRequestURL(
                $endpoint,
                $params,
                $format
            ))->then(
                function (ResponseInterface $response) use ($format) {
                    return APIModelFactory::makeModel(
                        $format,
                        $this->decodeResponseBody($response->getBody())
                    );
                },
                function (RequestException $exception) {
                    return new RejectedPromise($exception);
                }
            );
        }

        $response = $this->client->get($this->buildRequestURL($endpoint, $params, $format));
        $responseBody = $this->decodeResponseBody($response->getBody());

        return APIModelFactory::makeModel($format, $responseBody);
    }

    /**
     * Takes an array of endpoints to hit and their respective parameters,
     *   then sends all the requests concurrently.
     *
     * @param array $endpoints The API endpoints to hit
     * @param array $params    The parameters to be substituted into each endpoint stub.
     *                         Should have the same keys as $endpoints
     * @param array $options   Options to be applied to the entire batch of requests
     *
     * @return array Array of models built using returned data for each endpoint given as input.
     *               Array keys are preserved as given in $endpoints
     */
    public function batch(array $endpoints, array $params = [], array $options = []): array
    {
        $promises = [];
        $options['format'] = $this->getDefaultOption($options, 'format');

        foreach ($endpoints as $key => $endpoint) {
            $endpointParams = isset($params[$key]) ? $params[$key] : [];
            $promises[$key] = $this->client->getAsync(
                $this->buildRequestURL($endpoint, $endpointParams, $options['format'])
            );
        }

        $results = unwrap($promises);
        $models = [];

        foreach ($results as $key => $response) {
            $models[$key] = APIModelFactory::makeModel(
                $options['format'],
                $this->decodeResponseBody($response->getBody())
            );
        }

        return $models;
    }

    /**
     * Decodes the body of a Guzzle response.
     *
     * @param StreamInterface $responseBody The Guzzle response body
     *
     * @return string The body in string form
     */
    private function decodeResponseBody(StreamInterface $responseBody): string
    {
        return (string) $responseBody;
    }

    /**
     * Gets the value of a certain option, picking from a provided
     *   options array or the client's currently defined config.
     *
     * @param array  $options The array of options to pick from
     * @param string $option  The specific option to resolve
     *
     * @return mixed The value of the resolved option
     */
    private function getDefaultOption(array $options, string $option)
    {
        return $options[$option] ?? $this->config[$option];
    }

    /**
     * Returns the request URL for an API call.
     *
     * @param string $endpoint The API endpoint to call
     * @param array  $params   Parameters to substitute into the API endpoint string
     * @param string $format   The format of the response
     *
     * @return string The request URL
     */
    private function buildRequestURL(string $endpoint, array $params, string $format): string
    {
        $queryStringParams = [
            'key' => $this->config['key'],
        ];

        return $this->templateEngine->render($endpoint, $params).'.'.$format.'?'.http_build_query($queryStringParams);
    }
}
