<?php
namespace Game\Exception;
class RuntimeExceptionTest extends \PHPUnit_Framework_TestCase
{
    protected $exception;

    public function setup()
    {
        $this->exception = new RuntimeException();
    }

    public function testExceptionInterface()
    {
        $this->assertInstanceOf('\Game\Exception', $this->exception);
    }

    public function testRuntimeException()
    {
        $this->assertInstanceOf('\RuntimeException', $this->exception);
    }
}