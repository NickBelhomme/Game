<?php
namespace Game\Action\Go;
use Game\Action;
class East extends Action\Go
{
    protected $name = 'goEast';
    protected $synonyms = array(
        '(go|walk|run) (east|right)',
    );

    protected function go()
    {
        $grid = $this->grid;
        $position = $grid->getPosition();
        if ($grid->isOnGrid($position['x']+1, $position['y'])) {
            $currentTile = $grid->getTileFromPosition();
            $desiredTile = $grid->getTile($position['x']+1, $position['y']);
            if (!$currentTile->isEastBlocked() && !$desiredTile->isWestBlocked()) {
                $grid->setPosition($position['x']+1, $position['y']);
                return true;
            }
        }
        return false;
    }
}