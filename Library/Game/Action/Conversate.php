<?php
namespace Game\Action;
use Game\Conversation\AcceptConversation;
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
     * @param Game\Conversation\AcceptConversation $subject
     * @return Game\Action\AbstractAction
     */
    public function setSubject(AcceptConversation $subject)
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
        $result = 'you can talk by typing "say #dialognumber to '.$this->subject->getName().PHP_EOL;
        $conversation = $this->conversation->get();
        if ($conversation['answer']) {
            $result .= $this->subject->getName(). ' says: '.$conversation['answer'].PHP_EOL;
        }
        foreach ($conversation['optionsNext'] as $option) {
            $result .= $option['id']. ' => '.$option['text'].PHP_EOL;
        }
        return $result;
    }
}