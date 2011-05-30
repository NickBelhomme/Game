<?php
namespace Game\Action\Go;

class South extends AbstractGo
{
    /**
     * name of the action, it is the id of this specific action
     *
     * @var string
     */
    protected $name = 'goSouth';

    /**
     * The commands under which the action can be found and executed
     *
     * @var array of regex compatible strings
     */
    protected $synonyms = array(
        '(go|walk|run) (south|down)',
    );

    /**
     * Go south on the grid
     * @see Game\Action.Go::go()
     * @return boolean true on succesfull move
     */
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