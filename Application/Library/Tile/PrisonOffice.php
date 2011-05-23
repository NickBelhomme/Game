<?php
namespace App\Tile;
use Game\Tile,
    Game\Inventory,
    App\Item\ShotgunRack,
    App\Item\PoliceOfficer;
class PrisonOffice extends Tile
{
    protected $description = 'The office of the Police station. It looks abandoned. It is dead silent in here.
        You see a shotgun rack on the wall, it appears all but one shotguns have been taken.
        Through a smashed window you see it is night. It looks like all hell has broken loose.
        Outside a car seems to be on fire. You hear a wailing which at first impression comes from the wind but paying more
        attention it resembles more human like. In the far right corner you see an injured police officer sitting on a chair.';
    protected $westBlocked = false;

    protected function init()
    {
       $this->inventory = new Inventory();
       $this->inventory->addItem(new ShotgunRack(), 0)
                        ->addItem(new PoliceOfficer(), 0);
    }
}