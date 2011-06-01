<?php
namespace App\Action\Go;
use Game\Action\Go\East;
class PrisonDoor extends East
{
    protected $name = 'goPrisonDoor';
    protected $synonyms = array(
        '(go|walk|run|step) (through|thru|out of)',
    );

    public function execute()
    {
        if ($this->grid->getTileFromPosition()->getInventory()->getItemByName('door')->getIsClosed()) {
            return $this->getSuccessMessageFailed();
        } else {
            return parent::execute();
        }
    }

    protected function getSuccessMessageFailed()
    {
        return 'you have to open the door first';
    }
}