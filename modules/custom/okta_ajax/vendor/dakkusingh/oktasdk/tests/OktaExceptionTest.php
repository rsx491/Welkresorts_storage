<?php

class OktaExceptionTest extends PHPUnit_Framework_TestCase
{

    protected $exception;

    public function setUp() {
        $this->exception = new Okta\Exception(new stdClass);
    }

    public function testExceptionObject() {
        $this->assertInstanceOf('Okta\Exception', $this->exception);
    }

    public function testThrownException() {
        $this->setExpectedException('Okta\Exception');
        throw $this->exception;
    }

}
