<?php
namespace App\ItemCombination;
use Game\AbstractItemCombination,
    App\Action\Combine;
class RustyNailPrisonLock extends AbstractItemCombination
{
    protected function init()
    {
        $this->action = new Combine\RustyNailPrisonLock($this);
    }
}