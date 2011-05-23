<?php
namespace Game\Action;
abstract class Go extends AbstractAction
{
    protected $grid;
    protected $name = 'go';

    public function execute()
    {
        if ($this->go()) {
            echo $this->getExecutedMessageSuccess();
        } else {
            echo $this->getExecutedMessageFailed();
        }
    }

    protected function getExecutedMessageSuccess()
    {
        echo $this->grid->getTileFromPosition()->getDescription();
    }

    protected function getExecutedMessageFailed()
    {
        echo 'you cannot go that way, it is blocked.';
    }

    abstract protected function go();
}