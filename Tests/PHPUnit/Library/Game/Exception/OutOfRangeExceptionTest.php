<?php
namespace Game\Exception;
class OutOfRangeExceptionTest extends \PHPUnit_Framework_TestCase
{
    protected $exception;

    public function setup()
    {
        $this->exception = new OutOfRangeException();
    }

    public function testExceptionInterface()
    {
        $this->assertInstanceOf('\Game\Exception', $this->exception);
    }

    public function testOutOfRangeException()
    {
        $this->assertInstanceOf('\OutOfRangeException', $this->exception);
    }
}