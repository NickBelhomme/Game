<?php
namespace App\Item;
use Game\AbstractItem,
    Game\Action\Look;
class ShotgunRack extends AbstractItem
{
    protected $name = 'shotgun rack';
    protected $description = 'It is a shotgun rack. It is unlocked so you can freely take whatever gun is available.';

    protected function init()
    {
       $this->addAction(new Look());
       $this->getInventory()->addItem($shotgun = new Shotgun(), 1);
    }
}