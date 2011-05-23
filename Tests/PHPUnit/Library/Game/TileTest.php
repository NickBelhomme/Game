<?php
namespace Game;
use Game\Tile,
    Game\Action;
class TileTest extends \PHPUnit_Framework_TestCase
{
    protected $tile;

    public function setUp()
    {
        $this->tile = new Tile();
    }

    public function testGetDescription()
    {
        $this->assertEquals('tile', $this->tile->getDescription());
    }

    public function testGetInventory()
    {
        $this->assertInstanceOf('\Game\Inventory', $this->tile->getInventory());
    }

    public function testActionsSetAndGetting()
    {
        require_once TEST_PATH.'/Action/Stub.php';
        $action = new Action\Stub();

        $actionsRegistered = $this->tile->getActions();
        $this->assertEquals(1, count($actionsRegistered));
        $this->assertInstanceOf('\Game\Action\Look', $actionsRegistered['describe']);
        $this->assertInstanceOf('\Game\Tile', $this->tile->addAction($action));
        $this->assertEquals(2, count($this->tile->getActions()));

        // because action name is the same the second time an action is added, the old gets overwritten
        $this->assertInstanceOf('\Game\Tile', $this->tile->addAction($action));
        $this->assertEquals(2, count($this->tile->getActions()));

        $action->setName('b');
        $this->assertInstanceOf('\Game\Tile', $this->tile->addAction($action));
        $this->assertEquals(3, count($this->tile->getActions()));
    }

    public function    testSetNorthBlockedAndIsNorthBlocked()
    {
        $this->assertTrue($this->tile->isNorthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setNorthBlocked(false));
        $this->assertFalse($this->tile->isNorthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setNorthBlocked(true));
        $this->assertTrue($this->tile->isNorthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setNorthBlocked(0));
        $this->assertFalse($this->tile->isNorthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setNorthBlocked(1));
        $this->assertTrue($this->tile->isNorthBlocked());

        // all strings will be converted to boolean values
        $this->assertInstanceOf('\Game\Tile', $this->tile->setNorthBlocked('unknownstring'));
        $this->assertTrue($this->tile->isNorthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setNorthBlocked('false'));
        $this->assertTrue($this->tile->isNorthBlocked());
    }


    public function    testSetEastBlockedAndIsEastBlocked()
    {
        $this->assertTrue($this->tile->isEastBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setEastBlocked(false));
        $this->assertFalse($this->tile->isEastBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setEastBlocked(true));
        $this->assertTrue($this->tile->isEastBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setEastBlocked(0));
        $this->assertFalse($this->tile->isEastBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setEastBlocked(1));
        $this->assertTrue($this->tile->isEastBlocked());

        // all strings will be converted to boolean values
        $this->assertInstanceOf('\Game\Tile', $this->tile->setEastBlocked('unknownstring'));
        $this->assertTrue($this->tile->isEastBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setEastBlocked('false'));
        $this->assertTrue($this->tile->isEastBlocked());
    }


    public function    testSetSouthBlockedAndIsSouthBlocked()
    {
        $this->assertTrue($this->tile->isSouthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setSouthBlocked(false));
        $this->assertFalse($this->tile->isSouthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setSouthBlocked(true));
        $this->assertTrue($this->tile->isSouthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setSouthBlocked(0));
        $this->assertFalse($this->tile->isSouthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setSouthBlocked(1));
        $this->assertTrue($this->tile->isSouthBlocked());

        // all strings will be converted to boolean values
        $this->assertInstanceOf('\Game\Tile', $this->tile->setSouthBlocked('unknownstring'));
        $this->assertTrue($this->tile->isSouthBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setSouthBlocked('false'));
        $this->assertTrue($this->tile->isSouthBlocked());
    }


    public function    testSetWestBlockedAndIsWestBlocked()
    {
        $this->assertTrue($this->tile->isWestBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setWestBlocked(false));
        $this->assertFalse($this->tile->isWestBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setWestBlocked(true));
        $this->assertTrue($this->tile->isWestBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setWestBlocked(0));
        $this->assertFalse($this->tile->isWestBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setWestBlocked(1));
        $this->assertTrue($this->tile->isWestBlocked());

        // all strings will be converted to boolean values
        $this->assertInstanceOf('\Game\Tile', $this->tile->setWestBlocked('unknownstring'));
        $this->assertTrue($this->tile->isWestBlocked());
        $this->assertInstanceOf('\Game\Tile', $this->tile->setWestBlocked('false'));
        $this->assertTrue($this->tile->isWestBlocked());
    }
}