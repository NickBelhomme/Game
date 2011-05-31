<?php
namespace Game;
use Game\AbstractItem,
    Game\Action,
    Game\AbstractItemCombination;
require_once TEST_PATH.'/Item/Stub.php';
require_once TEST_PATH.'/ItemCombination/Stub.php';
require_once TEST_PATH.'/Action/Stub.php';
class ItemTest extends \PHPUnit_Framework_TestCase
{
    protected $item;

    public function setUp()
    {
        $this->item = $this->getMock('Game\Item\Stub', null);
    }

    public function constructorExceptionDataProvider()
    {
        return array(
            array(null, 'description'),
            array('name', null),
        );
    }

    /**
     * @dataProvider  constructorExceptionDataProvider
     */
    public function testConstructorForExceptions($name, $description)
    {
        $this->setExpectedException('\Game\Exception\RuntimeException');
        $item = new Item\Stub();
        $item->setName($name);
        $item->setDescription($description);
        $item->__construct();
    }

    public function testConversationSetAndGetting()
    {
        $conversation = $this->getMock('Game\Conversation');
        $this->assertNull($this->item->getConversation());
        $this->assertInstanceOf('\Game\AbstractItem', $this->item->setConversation($conversation));
        $this->assertInstanceOf('\Game\Conversation', $this->item->getConversation());
    }

    public function testActionsSetAndGetting()
    {
        $action = new Action\Stub();
        $this->assertNull($this->item->getActions());
        $this->assertInstanceOf('\Game\AbstractItem', $this->item->addAction($action));
        $this->assertEquals(1, count($this->item->getActions()));

        // because action name is the same the second time an action is added, the old gets overwritten
        $this->assertInstanceOf('\Game\AbstractItem', $this->item->addAction($action));
        $this->assertEquals(1, count($this->item->getActions()));

        $action->setName('b');
        $this->assertInstanceOf('\Game\AbstractItem', $this->item->addAction($action));
        $this->assertEquals(2, count($this->item->getActions()));
    }

    public function testNameGetting()
    {
        $this->assertNotNull($this->item->getName());
    }

    public function testDescriptionGetting()
    {
        $this->assertNotNull($this->item->getDescription());
    }

    public function testCombinationsSetAndGetting()
    {
        $combination = new ItemCombination\Stub();
        $this->assertInternalType('array', $this->item->getCombinations());
        $this->assertEquals(0, count($this->item->getCombinations()));
        $this->assertInstanceOf('\Game\AbstractItem', $this->item->addItemCombination($combination));
        $this->assertEquals(1, count($this->item->getCombinations()));

        $this->assertInstanceOf('\Game\AbstractItem', $this->item->addItemCombination($combination));
        $this->assertEquals(2, count($this->item->getCombinations()));
    }
}