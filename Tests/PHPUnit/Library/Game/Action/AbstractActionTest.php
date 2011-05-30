<?php
namespace Game\Action;
class AbstractActionTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->action = $this->getMockForAbstractClass(__NAMESPACE__.'\AbstractAction');
    }

    public function testConstructorWithParams()
    {
        $grid = $this->getMock('\Game\Grid', null, array(1,1));
        $inventory = $this->getMock('\Game\Inventory', null, array());
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->getMockForAbstractClass(__NAMESPACE__.'\AbstractAction', array($grid, $inventory)));
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->getMockForAbstractClass(__NAMESPACE__.'\AbstractAction', array($grid)));
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->getMockForAbstractClass(__NAMESPACE__.'\AbstractAction', array(null, $inventory)));
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->getMockForAbstractClass(__NAMESPACE__.'\AbstractAction', array(null, null)));
    }

    public function testConstructorWithParamsNotGrid()
    {
        $this->setExpectedException('\PHPUnit_Framework_Error');
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->getMockForAbstractClass(__NAMESPACE__.'\AbstractAction', array('blabla')));
    }

    public function testConstructorWithParamsNotInventory()
    {
        $this->setExpectedException('\PHPUnit_Framework_Error');
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->getMockForAbstractClass(__NAMESPACE__.'\AbstractAction', array(null, 'blabla')));
    }

    public function testSetItem()
    {
        require_once TEST_PATH.'/Item/Stub.php';
        $item = new \Game\Item\Stub();
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->action->setSubject($item));
        $tile = $this->getMock('\Game\Tile');
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->action->setSubject($tile));
        $grid = $this->getMock('\Game\Grid', null, array(1,1));
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->action->setSubject($grid));
    }

    public function testSetItemIncorrectParam()
    {
        $this->setExpectedException('\Game\Action\Exception\InvalidArgumentException');
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->action->setSubject('blabla'));
    }

    public function testGetName()
    {
        $this->assertEquals('action', $this->action->getName());
    }

    public function testGetSynonyms()
    {
        $this->assertInternalType('array', $this->action->getSynonyms());
    }

    public function testSetGrid()
    {
        $grid = $this->getMock('\Game\Grid', null, array(1,1));
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->action->setGrid($grid));
    }

    public function testSetGridWithFaultyParam()
    {
        $this->setExpectedException('\PHPUnit_Framework_Error');
        $this->action->setGrid('should be type \Game\Grid');
    }

    public function testSetPersonalInventory()
    {
        $inventory = $this->getMock('\Game\Inventory');
        $this->assertInstanceOf(__NAMESPACE__.'\AbstractAction', $this->action->setPersonalInventory($inventory));
    }

    public function testSetPersonalInventoryWithFaultyParam()
    {
        $this->setExpectedException('\PHPUnit_Framework_Error');
        $this->action->setPersonalInventory('Should be type \Game\Inventory');
    }
}