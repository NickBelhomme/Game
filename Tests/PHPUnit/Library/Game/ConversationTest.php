<?php
namespace Game;
class ConversationTest extends \PHPUnit_Framework_TestCase
{
    protected $conversation;

    public function setUp()
    {
        $this->conversation = new Conversation();
    }

    public function testGet()
    {
        //On Initialization
        $this->assertInternalType('array', $result = $this->conversation->get());
        $this->assertArrayHasKey('answer', $result);
        $this->assertArrayHasKey('optionsNext', $result);
        $this->assertArrayHasKey('optionsPrev', $result);

        $this->assertFalse($result['answer']);
        $this->assertFalse($result['optionsPrev']);

        // should always be set
        $this->assertequals(0, $result['optionsNext'][0]['id']);
        $this->assertequals('Never Mind', $result['optionsNext'][0]['text']);
    }

    public function testSetSelectedOptionId()
    {
        $this->assertInstanceOf('\Game\Conversation', $this->conversation->setSelectedOptionId(rand(0,100)));
        // should integer cast it.
        $this->assertInstanceOf('\Game\Conversation', $this->conversation->setSelectedOptionId('hallo'));
    }
}