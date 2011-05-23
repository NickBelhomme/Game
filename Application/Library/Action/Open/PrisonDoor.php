<?php
namespace App\Action\Open;
use Game\Action\Open;
class PrisonDoor extends Open
{
    public function execute()
    {
        $tile = $this->grid->getTileFromPosition();

        if ($tile->getInventory()->getItemByName('door')->getIsLocked()) {
            $this->getExecutedMessageFailed();
        } else {
            $tile->setEastBlocked(false);
            $tile->getInventory()->getItemByName('door')->setIsClosed(false);
            $this->getExecutedMessageSuccess();
        }
    }

    protected function getExecutedMessageSuccess()
    {
        echo 'You opened the door';
    }

    protected function getExecutedMessageFailed()
    {
        echo 'The door is locked';
    }
}