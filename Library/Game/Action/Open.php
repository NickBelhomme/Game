<?php
namespace Game\Action;
class Open extends AbstractAction
{
    protected $name = 'open';
    protected $synonyms = array(
        'open[ ]?',
    );

    public function execute()
    {
        echo $this->getExecuteMessageSuccess();
    }
}