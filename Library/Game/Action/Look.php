<?php
namespace Game\Action;
class Look extends AbstractAction
{
    protected $name = 'describe';
    protected $synonyms = array(
        'look[ ]?',
        'take a look[ ]?',
        'see[ ]?',
        'view[ ]?',
    );

    public function execute()
    {
        echo $this->subject->getDescription();
    }
}