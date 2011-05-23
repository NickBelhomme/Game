<?php
namespace App\ItemCombination;
use Game\ItemCombination,
    App\Action\Combine;
class RustyNailPrisonLock extends ItemCombination
{
    protected function init()
    {
        $this->action = new Combine\RustyNailPrisonLock($this);
    }
}