<?php
namespace Game\Action;
use Game\AbstractItem;
class Conversate extends AbstractAction
{
    /**
     * name of the action, it is the id of a specific action
     *
     * @var string
     */
    protected $name = 'conversate';

    /**
     * The conversation known to the subject
     * @var Game\Conversation
     */
    protected $conversation;

    /**
     * The commands under which the action can be found and executed
     *
     * @var array of regex compatible strings
     */
    protected $synonyms = array(
        'conversate[ ]+to[ ]+',
        'speak[ ]+to[ ]+',
        'speak[ ]+with[ ]+',
        'talk[ ]+with[ ]+',
        'talk[ ]+to[ ]+',
        'say[ ]\d+'
    );

    /**
     * set the subject and extracts whether it can conversate
     *
     * @param Game\AbstractItem $subject
     * @return Game\Action\AbstractAction
     */
    public function setSubject(AbstractItem $subject)
    {
        parent::setSubject($subject);
        $this->conversation = $this->subject->getConversation();
        if (empty($this->conversation)) {
            throw new Exception('Conversate action set but no conversation found in item '.$this->subject->getName());
        }
    }

    /**
     * sets the player his response Id in the conversate object
     * @param integer $int
     * @return void
     */
    public function setSelectedOptionId($int)
    {
        $this->conversation->setSelectedOptionId($int);
    }

    /**
     * try to conversate
     * @see Game\Action.AbstractAction::execute()
     * @return void
     */
    public function execute()
    {
        echo 'you can talk by typing "say #dialognumber to '.$this->subject->getName().'".<br /> ';
        $conversation = $this->conversation->get();
        if ($conversation['answer']) {
            echo $this->subject->getName(). ' says: '.$conversation['answer'].'<br />';
        }
        var_dump($this->conversation->get());
        foreach ($conversation['optionsNext'] as $option) {
            echo $option['id']. ' => '.$option['text'].'<br />';
        }
    }
}