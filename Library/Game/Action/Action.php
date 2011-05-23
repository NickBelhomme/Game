<?php
namespace Game\Action;
interface Action
{
    public function addAction(AbstractAction $action);
    public function getActions();
}