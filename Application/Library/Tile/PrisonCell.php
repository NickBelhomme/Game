<?php
namespace App\Tile;
use Game\Tile,
    Game\Inventory,
    App\Item\PrisonDoor,
    App\Item\PrisonDirt;
class PrisonCell extends Tile
{
    protected $description = 'A room which looks like a prison. The light is broken and blinks. During the blinks
    you see a floor covered with dirt. On the walls you see splattered blood stains and squashed insects. The
    air is moist and cold in here. On your east you see a door made of bars. It looks like it is the only way out
    or in of this room.';

    protected function init()
    {
       $this->inventory = new Inventory();
       $this->inventory->addItem($prisonDoor = new PrisonDoor(), 0)
                        ->addItem($prisonDirt = new PrisonDirt(), 0);
    }
}