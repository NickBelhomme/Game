<?php
namespace App\Item;
use Game\AbstractItem,
    Game\Action\Look,
    \App\Action\Take;
class RustyNail extends AbstractItem
{
    protected $name = 'nail';
    protected $description = 'a rusty nail';

    protected function init()
    {
        $this->addAction(new Take\RustyNail())
             ->addAction(new Look());
    }
}