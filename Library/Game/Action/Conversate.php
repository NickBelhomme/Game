<?php
namespace Game\Action;
use Game\Item;
class Conversate extends AbstractAction
{
    protected $name = 'conversate';
    protected $conversation;

    protected $synonyms = array(
        'conversate[ ]+to[ ]+',
        'speak[ ]+to[ ]+',
        'speak[ ]+with[ ]+',
        'talk[ ]+with[ ]+',
        'talk[ ]+to[ ]+',
        'say[ ]\d+'
    );

    public function setSubject(Item $subject)
    {
        parent::setSubject($subject);
        $this->conversation = $this->subject->getConversation();
        if (empty($this->conversation)) {
            throw new Exception('Conversate action set but no conversation found in item '.$this->subject->getName());
        }
    }

    public function setSelectedOptionId($int)
    {
        $this->conversation->setSelectedOptionId($int);
    }

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