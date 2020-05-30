<?php

class OktaRequestTest extends PHPUnit_Framework_TestCase
{

    protected $request;

    public function setUp() {
        $this->request = new Okta\Request(new Okta\Client('org', 'key'));
    }

     public function testExceptionObject() {
        $this->assertInstanceOf('Okta\Request', $this->request);
    }

    public function testCanSetValidMethods() {
        $this->assertInstanceOf('Okta\Request', $this->request->method('GET'));
        $this->assertInstanceOf('Okta\Request', $this->request->method('POST'));
        $this->assertInstanceOf('Okta\Request', $this->request->method('PUT'));
        $this->assertInstanceOf('Okta\Request', $this->request->method('DELETE'));
    }

    public function testCantSetInvalidMethod() {
        $this->setExpectedException('Exception');
        $this->request->method('INVALID');
    }

    public function testCanSetEndpoint() {
        $this->assertInstanceOf('Okta\Request', $this->request->endpoint('foo/bar'));
    }

    public function testConvenienceFunctions() {
        $this->assertInstanceOf('Okta\Request', $this->request->get('foo/bar'));
        $this->assertInstanceOf('Okta\Request', $this->request->post('foo/bar'));
        $this->assertInstanceOf('Okta\Request', $this->request->put('foo/bar'));
        $this->assertInstanceOf('Okta\Request', $this->request->delete('foo/bar'));
    }

    public function testCanSetArbitraryOption() {
        $this->assertInstanceOf('Okta\Request', $this->request->option('foo', 'bar'));
    }

    public function testCanSetQueryOption() {
        $this->assertInstanceOf('Okta\Request', $this->request->query(['foo' => 'bar']));
    }

    public function testCanSetJsonOption() {
        $this->assertInstanceOf('Okta\Request', $this->request->json(['foo' => 'bar']));
    }

    public function testCanSetDataOption() {
        $this->assertInstanceOf('Okta\Request', $this->request->data(['foo' => 'bar']));
    }

    public function testCanSetTimeoutOption() {
        $this->assertInstanceOf('Okta\Request', $this->request->timeout(42));
    }

    public function testCanSetAssoc() {
        $this->assertInstanceOf('Okta\Request', $this->request->assoc(true));
    }

}
