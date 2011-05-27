<?php
namespace Game\Action\Go;
use Game\Action;
class East extends Action\Go
{
    /**
     * name of the action, it is the id of this specific action
     *
     * @var string
     */
    protected $name = 'goEast';

    /**
     * The commands under which the action can be found and executed
     *
     * @var array of regex compatible strings
     */
    protected $synonyms = array(
        '(go|walk|run) (east|right)',
    );

    /**
     * Go east on the grid
     * @see Game\Action.Go::go()
     * @return boolean true on succesfull move
     */
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