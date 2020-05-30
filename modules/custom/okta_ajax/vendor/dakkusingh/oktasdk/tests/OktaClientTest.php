<?php

class OktaClientTest extends PHPUnit_Framework_TestCase
{

    protected $okta;

    public function setUp() {
        $this->okta = new Okta\Client('org', 'key');
    }

    public function testClientObject() {
        $this->assertInstanceOf('Okta\Client', $this->okta);
    }

    public function testClientPropertyObject() {
        $this->assertInstanceOf('GuzzleHttp\Client', $this->okta->instance());
    }

    public function testAppPropertyObject() {
        $this->assertInstanceOf('Okta\Resource\App', $this->okta->app);
    }

    public function testResourcesExtendBase() {
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->app);
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->auth);
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->event);
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->factor);
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->group);
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->role);
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->schema);
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->session);
        $this->assertInstanceOf('Okta\Resource\Base', $this->okta->user);
    }

    public function testResourcePropertyObjects() {
        $this->assertInstanceOf('Okta\Resource\Authentication', $this->okta->auth);
        $this->assertInstanceOf('Okta\Resource\Event', $this->okta->event);
        $this->assertInstanceOf('Okta\Resource\Factor', $this->okta->factor);
        $this->assertInstanceOf('Okta\Resource\Group', $this->okta->group);
        $this->assertInstanceOf('Okta\Resource\Role', $this->okta->role);
        $this->assertInstanceOf('Okta\Resource\Schema', $this->okta->schema);
        $this->assertInstanceOf('Okta\Resource\Session', $this->okta->session);
        $this->assertInstanceOf('Okta\Resource\User', $this->okta->user);
    }

    public function testNonBootstrappedResourcePropertiesAreNull() {
        $okta = new Okta\Client('test', 'not_a_real_key', ['bootstrap' => false]);
        $this->assertNull($okta->app);
        $this->assertNull($okta->auth);
        $this->assertNull($okta->event);
        $this->assertNull($okta->factor);
        $this->assertNull($okta->group);
        $this->assertNull($okta->role);
        $this->assertNull($okta->schema);
        $this->assertNull($okta->session);
        $this->assertNull($okta->user);
    }

}
