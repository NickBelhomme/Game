<?php
namespace Game\Exception;
class DomainExceptionTest extends \PHPUnit_Framework_TestCase
{
    protected $exception;

    public function setup()
    {
        $this->exception = new DomainException();
    }

    public function testExceptionInterface()
    {
        $this->assertInstanceOf('\Game\Exception', $this->exception);
    }

    public function testDomainException()
    {
        $this->assertInstanceOf('\DomainException', $this->exception);
    }
}