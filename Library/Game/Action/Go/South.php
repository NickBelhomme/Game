<?php
namespace Game\Action\Go;
use Game\Action;
class South extends Action\Go
{
    protected $name = 'goSouth';
    protected $synonyms = array(
        '(go|walk|run) (south|down)',
    );

    protected function go()
    {
        $grid = $this->grid;
        $position = $grid->getPosition();
        if ($grid->isOnGrid($position['x'], $position['y']+1)) {
            $currentTile = $grid->getTileFromPosition();
            $desiredTile = $grid->getTile($position['x'], $position['y']+1);
            if (!$currentTile->isSouthBlocked() && !$desiredTile->isNorthBlocked()) {
                $grid->setPosition($position['x'], $position['y']+1);
                return true;
            }
        }
        return false;
    }
}