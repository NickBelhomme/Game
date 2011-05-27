<?php
namespace Game;
class ItemCombinationTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorSettingOfItemOneAndTwo()
    {
        $item = $this->getMock('\Game\Item', array('additemCombination', 'addAction'), array(), '', false);
        $item->expects($this->once())
             ->method('additemCombination')
             ->with($this->isInstanceOf('\Game\ItemCombination'));
        $item->expects($this->once())
             ->method('addAction');
        $item2 = $this->getMock('\Game\Item', null, array(), '', false);

        require_once TEST_PATH.'/ItemCombination/Stub.php';
        $itemCombination = new \Game\ItemCombination\Stub($item, $item2);

        // assert Setting and Getting
        $this->assertTrue($itemCombination->getItemOne() === $item);
        $this->assertTrue($itemCombination->getItemTwo() === $item2);
    }

    public function testConstructorTestingOfActionProperty()
    {
        $this->setExpectedException('\Game\Exception\RuntimeException' );
        $item = $this->getMock('\Game\Item', null, array(), '', false);
        $itemCombination = $this->getMockForAbstractClass('\Game\ItemCombination', array($item, $item));

    }

    public function testAutomaticCallingOfInitFunction()
    {
        $this->markTestIncomplete('still need to test the invocation of the protected template method _init');
    }
}