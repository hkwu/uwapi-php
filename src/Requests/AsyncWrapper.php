<?php

namespace UWaterlooAPI\Requests;

class AsyncWrapper
{
    private $promise;
    private $endpoint;
    private $format;

    /**
     * AsyncWrapper constructor.
     *
     * @param \GuzzleHttp\Promise\PromiseInterface $promise
     * @param string $endpoint
     * @param string $format
     */
    public function __construct($promise, $endpoint, $format)
    {
        $this->promise = $promise;
        $this->endpoint = $endpoint;
        $this->format = $format;
    }

    /**
     * @return \GuzzleHttp\Promise\Promise
     */
    public function getPromise()
    {
        return $this->promise;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }
}
