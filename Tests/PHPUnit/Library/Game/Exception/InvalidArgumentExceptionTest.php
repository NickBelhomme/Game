<?php
namespace Game\Exception;
class InvalidArgumentExceptionTest extends \PHPUnit_Framework_TestCase
{
    protected $exception;

    public function setup()
    {
        $this->exception = new InvalidArgumentException();
    }

    public function testExceptionInterface()
    {
        $this->assertInstanceOf('\Game\Exception', $this->exception);
    }

    public function testInvalidArgumentException()
    {
        $this->assertInstanceOf('\InvalidArgumentException', $this->exception);
    }
}