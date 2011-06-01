<?php
namespace App\Action\Combine;
use Game\Action\Combine;
class RustyNailPrisonLock extends Combine
{
    protected function executeSuccess()
    {
        $tile = $this->grid->getTileFromPosition();
        $this->personalInventory->removeItem($this->getCombination()->getItemOne());
        $door = $tile->getInventory()->getItemByName('door')->setIsLocked(false);
    }

    protected function getExecutedMessageSuccess()
    {
        return 'you picked the lock';
    }
}