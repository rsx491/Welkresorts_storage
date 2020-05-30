<?php

namespace Okta;

use GuzzleHttp\Client as GuzzleClient;

/**
 * Okta\Client class
 *
 * @author Chris Kankiewicz <ckankiewicz@io.com>
 */
class Client
{
    /** @var object Instance of GuzzleHttp\Client object */
    protected $client;

    /** @var object Instance of Okta\Resource\App object */
    public $app;

    /** @var object Instance of Okta\Resource\Authentication object */
    public $auth;

    /** @var object Instance of Okta\Resource\Event object */
    public $event;

    /** @var object Instance of Okta\Resource\Factor object */
    public $factor;

    /** @var object Instance of Okta\Resource\Group object */
    public $group;

    /** @var object Instance of Okta\Resource\Role object */
    public $role;

    /** @var object Instance of Okta\Resource\Schema object */
    public $schema;

    /** @var object Instance of Okta\Resource\Session object */
    public $session;

    /** @var object Instance of Okta\Resource\User object */
    public $user;

    /**
     * Okta\Client constructor method
     *
     * @param string $org       Your organization's subdomain (tenant)
     * @param string $key       Your Okta API key
     * @param array  $config    Array of Client config key/values
     */
    public function __construct($org, $key, array $config = [])
    {
        $config = array_merge([
            'apiVersion' => 'v1',
            'bootstrap'  => true,
            'domain'     => 'okta.com',
            'headers'    => [],
            'preview'    => false
        ], $config);

        $domain = $config['preview'] ? 'oktapreview.com' : $config['domain'];

        $this->client = new GuzzleClient ([
            'base_uri'   => 'https://' . $org . '.' . $domain . '/api/' . $config['apiVersion'] . '/',
            'exceptions' => false,
            'headers'    => array_merge([
                'Authorization' => 'SSWS ' . $key,
                'Content-Type'  => 'application/json'
            ], $config['headers'])
        ]);

        if ($config['bootstrap']) $this->bootstrap();
    }

    /**
     * Bootstraps all Okta\Resources for easy access
     *
     * @return object This Okta\Client object
     */
    protected function bootstrap()
    {
        $this->app     = new Resource\App($this);
        $this->auth    = new Resource\Authentication($this);
        $this->event   = new Resource\Event($this);
        $this->factor  = new Resource\Factor($this);
        $this->group   = new Resource\Group($this);
        $this->role    = new Resource\Role($this);
        $this->schema  = new Resource\Schema($this);
        $this->session = new Resource\Session($this);
        $this->user    = new Resource\User($this);

        return $this;
    }

    /**
     * Return $this->client property
     *
     * @return GuzzleClient GuzzleHttp\Client object
     */
    public function instance()
    {
        return $this->client;
    }

    /**
     * Perform a cusom request
     *
     * @param string $method   Set request method
     * @param string $endpoint Set request endpoint
     * @param array  $option   Array of options to send with the request
     *
     * @return object          Request response
     */
    public function request($method, $endpoint, array $options = [])
    {
        $request = new Okta\Request($this);

        $request->method($method)->endpoint($endpoint);

        foreach ($options as $key => $value) {
            $request->option($key, $value);
        }

        return $request->send();
    }
}
