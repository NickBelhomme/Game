<?php
namespace App\Item;
use Game\Item,
    Game\Action\Look,
    \App\Action\Take;
class Shotgun extends Item
{
    protected $name = 'shotgun';
    protected $description = 'a shotgun. It looks like it can do serious damage';

    protected function init()
    {
       $this->addAction(new Take\Shotgun())
            ->addAction(new Look());
    }
}