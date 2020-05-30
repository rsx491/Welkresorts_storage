<?php

namespace Okta;

use Okta;
use Exception;

/**
 * Okta\Request class
 *
 * @author Chris Kankiewicz <ckankiewicz@io.com>
 */
class Request
{
    /** @var object Okta\Client instance  */
    protected $client;

    /** @var string Request HTTP method (GET|POST|PUT|DELETE) */
    protected $method;

    /** @var string Request endpoint */
    protected $endpoint;

    /** @var array Array of request options */
    protected $options = [];

    /** @var boolean Wether or not to return associative arrays */
    protected $assoc = false;

    /**
     * Okta\Request contructor method
     *
     * @param object $client Instance of Okta\Client
     */
    public function __construct(Okta\Client $client)
    {
        $this->client = $client->instance();
    }

    /**
     * Set request method
     *
     * @param  string $method HTTP method (GET|POST|PUT|DELETE)
     *
     * @return object         This Okta\Request object
     */
    public function method($method)
    {
        if (! in_array($method, ['GET', 'POST', 'PUT', 'DELETE'])) {
            throw new Exception('Method parameter not an acceptable HTTP method (GET, POST, PUT, DELETE)');
        }

        $this->method = $method;

        return $this;
    }

    /**
     * Set request endpoint
     *
     * @param  string $endpoint Request endpoint (absolute path or relative to
     *                          the base URI)
     *
     * @return object           This Okta\Request object
     */
    public function endpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * Convenience function for making an HTTP GET request
     *
     * @param  string $endpoint Request endpoint
     *
     * @return object           This Okta\Request object
     */
    public function get($endpoint)
    {
        $this->method('GET')->endpoint($endpoint);
        return $this;
    }

    /**
     * Convenience function for making an HTTP POST request
     *
     * @param  string $endpoint Request endpoint
     *
     * @return object           This Okta\Request object
     */
    public function post($endpoint)
    {
        $this->method('POST')->endpoint($endpoint);
        return $this;
    }

    /**
     * Convenience function for making an HTTP PUT request
     *
     * @param  string $endpoint Request endpoint
     *
     * @return object           This Okta\Request object
     */
    public function put($endpoint)
    {
        $this->method('PUT')->endpoint($endpoint);
        return $this;
    }

    /**
     * Convenience function for making an HTTP DELETE request
     *
     * @param  string $endpoint Request endpoint
     * @return object           This Okta\Request object
     */
    public function delete($endpoint)
    {
        $this->method('DELETE')->endpoint($endpoint);
        return $this;
    }

    /**
     * Set an arbitrary request option
     *
     * @param  string $key   Option key
     * @param  strgin $value Option value
     *
     * @return object        This Okta\Request object
     */
    public function option($key, $value)
    {
        $this->options[$key] = $value;
        return $this;
    }

    /**
     * Associative array of query string values to add to the request.
     *
     * @param  array  $query    Associative array of query string values
     * @param  bool   $override If true override all currently stored query
     *                          values with the new values being provided
     *
     * @return object           This Okta\Request object
     */
    public function query(array $query, $override = false)
    {
        if (! $override && ! empty($this->options['query'])) {
            $query = array_merge($this->options['query'], $query);
        }

        $this->option('query', $query);

        return $this;
    }

    /**
     * The json option is used to easily upload JSON encoded data as the body of
     * a request. A Content-Type header of application/json will be added if no
     * Content-Type header is already present on the message.
     *
     * Alias: $this->data()
     *
     * @param  array  $data     Any PHP type that can be operated on by PHP's
     *                          json_encode() function.
     * @param  bool   $override If true override all currently stored json data
     *                          with the new data being provided
     *
     * @return object           This Okta\Request object
     */
    public function json(array $data, $override = false)
    {
        if (! $override && ! empty($this->options['json'])) {
            $data = array_merge($this->options['json'], $data);
        }

        $this->option('json', $data);

        return $this;
    }

    /**
     * Alias of $this->json()
     *
     * @param  array  $data     Any PHP type that can be operated on by PHP's
     *                          json_encode() function.
     * @param  bool   $override If true override all currently stored json data
     *                          with the new data being provided
     *
     * @return object           This Okta\Request object
     */
    public function data(array $data, $override = false)
    {
        return $this->json($data, $override);
    }

    /**
     * Float describing the timeout of the request in seconds. Use 0 to wait
     * indefinitely (the default behavior).
     *
     * @param  float  $seconds Seconds to wait before request times out
     *
     * @return object          This Okta\Request object
     */
    public function timeout($seconds)
    {
        $this->option('timeout', $seconds);
        return $this;
    }

    /**
     * When true, returned objects will be converted into associative arrays.
     *
     * @param  bool   $assoc Wether or not to return associative arrays
     *
     * @return object        This request object
     */
    public function assoc($assoc)
    {
        $this->assoc = $assoc;
        return $this;
    }

    /**
     * Sends an Okta API request using this request object.
     *
     * @return object Decoded API response object
     */
    public function send()
    {
        $response = $this->client->request($this->method, $this->endpoint, $this->options);

        $bodyContents = $response->getBody()->getContents();

        if (! in_array($response->getStatusCode(), [200, 201, 202, 203, 204, 205, 206])) {
            throw new Okta\Exception(json_decode($bodyContents));
        }

        return json_decode($bodyContents, $this->assoc);
    }
}
