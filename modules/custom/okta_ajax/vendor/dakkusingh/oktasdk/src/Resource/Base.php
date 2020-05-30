<?php

namespace Okta\Resource;

use Okta;

/**
 * Okta resource base class.  All Okta resources should extend this class.
 */
abstract class Base
{
    /** @var object Okta\Request object*/
    protected $request;

    /**
     * Okta\Resources\Base constructor method
     *
     * @param object $client Instance of GuzzleClient
     */
    public function __construct(Okta\Client $client)
    {
        $this->request = new Okta\Request($client);
    }
}
