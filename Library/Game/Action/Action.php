<?php
namespace Game\Action;
interface Action
{
    /**
     * Allows the implementing class to accept action(s)
     * @param \Game\Action\AbstractAction $action
     */
    public function addAction(AbstractAction $action);

    /**
     * Getter for the actions stored in the implementing class
     *
     * @return array
     */
    public function getActions();
}