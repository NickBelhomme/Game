<?php
namespace App\Action\Open;
use Game\Action\Open;
class PrisonDoor extends Open
{
    public function execute()
    {
        $tile = $this->grid->getTileFromPosition();

        if ($tile->getInventory()->getItemByName('door')->getIsLocked()) {
            return $this->getExecutedMessageFailed();
        } else {
            $tile->setEastBlocked(false);
            $tile->getInventory()->getItemByName('door')->setIsClosed(false);
            return $this->getExecutedMessageSuccess();
        }
    }

    protected function getExecutedMessageSuccess()
    {
        return 'You opened the door';
    }

    protected function getExecutedMessageFailed()
    {
        return 'The door is locked';
    }
}