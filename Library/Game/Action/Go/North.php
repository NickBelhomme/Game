<?php
namespace Game\Action\Go;
use Game\Action;
class North extends Action\Go
{
    protected $name = 'goNorth';
    protected $synonyms = array(
        '(go|walk|run) (north|up)',
    );

    protected function go()
    {
        $grid = $this->grid;
        $position = $grid->getPosition();
        if ($grid->isOnGrid($position['x'], $position['y']-1)) {
            $currentTile = $grid->getTileFromPosition();
            $desiredTile = $grid->getTile($position['x'], $position['y']-1);
            if (!$currentTile->isNorthBlocked() && !$desiredTile->isSouthBlocked()) {
                $grid->setPosition($position['x'], $position['y']-1);
                return true;
            }
        }
        return false;
    }
}