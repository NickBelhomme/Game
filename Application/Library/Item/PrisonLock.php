<?php
namespace App\Item;
use Game\AbstractItem,
    Game\Action\Look;
class PrisonLock extends AbstractItem
{
    protected $name = 'lock';
    protected $description = 'It is one of those old fashioned hanging locks. It looks easily picked.
    If only you had something to pick it with.';

    protected function init()
    {
       $this->addAction(new Look());
    }
}