<?php
namespace Game;
use Game\Action\Go;
class GridTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorNormalParamsWithGetGridSize()
    {
        $x = rand(1,100);
        $y = rand(1,100);
        $grid = new Grid($x,$y);
        $gridSize = $grid->getGridSize();
        $this->assertEquals($x, $gridSize['x']);
        $this->assertEquals($y, $gridSize['y']);

        $grid = new Grid((string) $x, (string) $y);
        $gridSize = $grid->getGridSize();
        $this->assertEquals($x, $gridSize['x']);
        $this->assertEquals($y, $gridSize['y']);
    }

    public function constructorDataProvider()
    {
        return array(
            array(0,0),
            array(0,1),
            array(1,0),
            array(-1,1),
            array(1,-1),
            array(-1,-1),
        );
    }

    /**
     * @dataProvider constructorDataProvider
     */
    public function testConstructWithBadParams($x, $y)
    {
        $this->setExpectedException('Exception');
        $grid = new Grid($x,$y);
    }

    public function testGetTileWhenNoneIsSet()
    {
        $grid = new Grid(1,1);
        $this->assertNull($grid->getTile(0,0));
    }

    public function testGetTileFromPostionWhenNoTileIsSet()
    {
        $grid = new Grid(1,1);
        $this->assertNull($grid->getTileFromPosition());
    }

    public function testAddTile()
    {
        $tile = $this->getMock('\Game\Tile', null, array(), 'Mock', false);
        $grid = new Grid(1,1);
        $this->assertInstanceOf('\Game\Grid', $grid->addTile($tile, 0, 0));
        $this->assertInstanceOf('Mock', $grid->getTile(0,0));
    }

    public function testAddTileOutsideGrid()
    {
        $this->setExpectedException('\Exception');
        $tile = $this->getMock('\Game\Tile');
        $grid = new Grid(1,1);
        $grid->addTile($tile, 2, 3);
    }

    public function tileBlockedDataProvider()
    {
        return array(
            array(false, true, true, true),
            array(true, false, true, true),
            array(true, true, false, true),
            array(true, true, true, false),
        );
    }

    /**
     * @dataProvider tileBlockedDataProvider
     */
    public function testAddTileInsideGridButWithNoBlockageWhereBlackageShouldBeSet($northBlocked, $eastBlocked, $southBlocked, $westBlocked)
    {
        $grid = new Grid(1,1);
        $this->setExpectedException('\Exception');
        $tile = $this->getMock('\Game\Tile', array('isNorthBlocked', 'isEastBlocked', 'isSouthBlocked', 'isWestBlocked'));
        $tile->expects($this->any())
             ->method('isNorthBlocked')
             ->will($this->returnValue($northBlocked));

        $tile->expects($this->any())
             ->method('isEastBlocked')
             ->will($this->returnValue($eastBlocked));

        $tile->expects($this->any())
             ->method('isSouthBlocked')
             ->will($this->returnValue($southBlocked));

        $tile->expects($this->any())
             ->method('isWestBlocked')
             ->will($this->returnValue($westBlocked));

        $grid->addTile($tile, 0, 0);
    }

    public function testIsOnGrid()
    {
        $grid = new Grid(1,1);
        $this->assertTrue($grid->isOnGrid(0,0));
        $this->assertFalse($grid->isOnGrid(0,1));
    }

    public function testPosition()
    {
        $x = rand(1,100);
        $y = rand(1,100);
        $grid = new Grid($x,$y);
        $position = $grid->getPosition();
        $this->assertEquals(0, $position['x']);
        $this->assertEquals(0, $position['y']);

        $newPositionX = rand(0,$x-1);
        $newPositionY = rand(0,$y-1);
        $grid->setPosition($newPositionX, $newPositionY);
        $position = $grid->getPosition();
        $this->assertEquals($newPositionX, $position['x']);
        $this->assertEquals($newPositionY, $position['y']);
    }

    public function testSetPositionOutsideGrid()
    {
        $this->setExpectedException('\Exception');
        $grid = new Grid(1,1);
        $grid->setPosition(3,2);
    }

    public function testAddActionAndGetActions()
    {
        require_once TEST_PATH .'/Action/Stub.php';
        $action = $this->getMock('\Game\Action\Stub');
        $action->expects($this->once())
               ->method('setGrid')
               ->with($this->isInstanceOf('\Game\Grid'));
        $action->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('stubAction'));
        $grid = new Grid(1,1);

        $actions = $grid->getActions();
        $initialActionsCount = count($actions);
        $this->assertInstanceOf('\Game\Grid', $grid->addAction($action));

        $actions = $grid->getActions();
        $this->assertEquals($initialActionsCount+1, count($actions));

        // Same name, it will overwrite the previous one set
        $action2 = $this->getMock('\Game\Action\Stub');
        $action2->expects($this->once())
               ->method('getName')
               ->will($this->returnValue('stubAction'));
        $this->assertInstanceOf('\Game\Grid', $grid->addAction($action2));
        $actions = $grid->getActions();
        $this->assertEquals($initialActionsCount+1, count($actions));
    }

    public function testDefaultGridActions()
    {
        $grid = new Grid(2,2);
        $actions = $grid->getActions();

        $this->assertEquals(4, count($actions));

        $gameActionGoNorthFound = false;
        $gameActionGoEastFound = false;
        $gameActionGoSouthFound = false;
        $gameActionGoWestFound = false;

        foreach ($actions as $action) {
            if ($action instanceof Go\North) {
                $gameActionGoNorthFound = true;
            }
            if ($action instanceof Go\East) {
                $gameActionGoEastFound = true;
            }
            if ($action instanceof Go\South) {
                $gameActionGoSouthFound = true;
            }
            if ($action instanceof Go\West) {
                $gameActionGoWestFound = true;
            }
        }
        $this->assertTrue($gameActionGoNorthFound);
        $this->assertTrue($gameActionGoEastFound);
        $this->assertTrue($gameActionGoSouthFound);
        $this->assertTrue($gameActionGoWestFound);
    }
}