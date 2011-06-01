<?php
namespace App\Action\Take;
use Game\Action\Take;
class RustyNail extends Take
{
    protected function executeSuccess()
    {
        if ($dirt = $this->grid->getTileFromPosition()->getInventory()->getItemByName('dirt')) {
            $dirt->switchDescriptionToWithoutNail();
        }
    }

    protected function getExecutedMessageFailed()
    {
        return 'You already have the nail';
    }
}