<?php
namespace Game\Action\Go;
use Game\Action;
class West extends Action\Go
{
    protected $name = 'goWest';
    protected $synonyms = array(
        '(go|walk|run) (west|left)',
    );

    protected function go()
    {
        $grid = $this->grid;
        $position = $grid->getPosition();
        if ($grid->isOnGrid($position['x']-1, $position['y'])) {
            $currentTile = $grid->getTileFromPosition();
            $desiredTile = $grid->getTile($position['x']-1, $position['y']);
            if (!$currentTile->isWestBlocked() && !$desiredTile->isEastBlocked()) {
                $grid->setPosition($position['x']-1, $position['y']);
                return true;
            }
        }
        return false;
    }
}