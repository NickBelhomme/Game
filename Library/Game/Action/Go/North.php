<?php
namespace Game\Action\Go;

class North extends AbstractGo
{
    /**
     * name of the action, it is the id of this specific action
     *
     * @var string
     */
    protected $name = 'goNorth';

    /**
     * The commands under which the action can be found and executed
     *
     * @var array of regex compatible strings
     */
    protected $synonyms = array(
        '(go|walk|run) (north|up)',
    );

    /**
     * Go north on the grid
     * @see Game\Action.Go::go()
     * @return boolean true on succesfull move
     */
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