<?php
namespace Game\Action\Go;
use Game\Action\AbstractAction;
abstract class AbstractGo extends AbstractAction
{
    /**
     * must know the grid, because it can potentially manipulate it
     * Think for instance moving to another position
     *
     * @var Game\Grid
     */
    protected $grid;

    /**
     * name of the action, it is the id of this specific action
     *
     * @var string
     */
    protected $name = 'go';


    /**
     * Try to move on the grid
     *
     * @return void
     */
    public function execute()
    {
        if ($this->go()) {
            return $this->getExecutedMessageSuccess();
        } else {
            return $this->getExecutedMessageFailed();
        }
    }

    /**
     * When the action was successfully executed this message could be displayed
     *
     * @return string;
     */
    protected function getExecutedMessageSuccess()
    {
        return $this->grid->getTileFromPosition()->getDescription();
    }

    /**
     * When the action executed failed this message could be displayed
     *
     * @return string;
     */
    protected function getExecutedMessageFailed()
    {
        return 'you cannot go that way, it is blocked.';
    }

    /**
     * template method for the logic to really move on the grid
     *
     * @return boolean true on success
     */
    abstract protected function go();
}