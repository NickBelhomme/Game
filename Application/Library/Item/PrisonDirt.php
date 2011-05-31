<?php
namespace App\Item;
use Game\AbstractItem,
    Game\Action\Look,
    \App\Action\Take;
class PrisonDirt extends AbstractItem
{
    protected $name = 'dirt';
    protected $description = 'A rusty nail is laying in the dirt';
    protected $descriptionWithoutNail = 'it\'s just dirt';

    protected function init()
    {
       $this->addAction(new Look())
            ->addAction(new Take\PrisonDirt());
       $this->inventory->addItem(new RustyNail(), 1);
    }

    public function switchDescriptionToWithoutNail()
    {
        $this->description = $this->descriptionWithoutNail;
    }
}