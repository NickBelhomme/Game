<?php
namespace Game;
require_once TEST_PATH.'/Item/Stub.php';
class InventoryTest extends \PHPUnit_Framework_TestCase
{
    protected $inventory;

    public function setUp()
    {
        $this->inventory = new Inventory();
    }

    public function testAddAndGetItem()
    {
        $item = $this->getMock('\Game\Item\Stub', null);
        $item->setName('a');
        $this->assertInstanceOf('\Game\Inventory', $this->inventory->addItem($item, 0));
        $this->assertEquals(1, count($this->inventory->getItems()));
        $this->assertInstanceOf('\Game\Item', $this->inventory->getItemByName('a'));

        // item with name b not yet added to the inventory
        $this->assertFalse($this->inventory->getItemByName('b'));

        // Should still return 1, because the item has the same name
        $this->assertInstanceOf('\Game\Inventory', $this->inventory->addItem($item, 1));
        $this->assertEquals(1, count($this->inventory->getItems()));

        $item = $this->getMock('\Game\Item\Stub', null);
        $item->setName('b');
        $this->inventory->addItem($item, 1);
        $this->assertEquals(2, count($this->inventory->getItems()));
        $this->assertInstanceOf('\Game\Item', $this->inventory->getItemByName('b'));

        $item = $this->getMock('\Game\Item\Stub', null);
        $item->setName('c');
        $this->inventory->addItem($item, 'aStringShouldConvertToZeroOrIntegerEquivalent');
        $this->assertEquals(3, count($this->inventory->getItems()));
        $this->assertInstanceOf('\Game\Item', $this->inventory->getItemByName('c'));

        foreach ($this->inventory->getItems() as $item) {
            $this->assertInstanceOf('\Game\Item', $item);
        }
    }

    public function testRemoveItem()
    {
        $item = $this->getMock('\Game\Item\Stub', null);
        $item->setName('a');
        $this->inventory->addItem($item, 0);
        $this->assertEquals(1, count($this->inventory->getItems()));
        $this->assertTrue($this->inventory->removeItem($item));
        $this->assertEquals(0, count($this->inventory->getItems()));
        $this->assertFalse($this->inventory->removeItem($item));
    }

    public function testTakeItem()
    {
        $item = $this->getMock('\Game\Item\Stub', null);
        $item->setName('a');
        $this->inventory->addItem($item, 2);
        $this->assertTrue($this->inventory->takeItem($item));
        $this->assertTrue($this->inventory->takeItem($item));
        $this->assertFalse($this->inventory->takeItem($item));

        $item2 = $this->getMock('\Game\Item\Stub', null);
        $item2->setName('b');
        $this->inventory->addItem($item2, 0);
        $this->assertFalse($this->inventory->takeItem($item2));

        $this->inventory->addItem($item, Inventory::ITEM_INFINITE_QUANTITY);
        for($x = 0; $x < 10; $x++) {
            $this->assertTrue($this->inventory->takeItem($item));
        }
    }
}