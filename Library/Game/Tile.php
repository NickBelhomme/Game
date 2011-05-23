<?php
namespace Game;
use Game\Action\Action,
    Game\Action\AbstractAction,
    Game\Action\Look,
    Game\Inventory;
class Tile implements Action
{
    protected $description = 'tile';
    protected $inventory;
    protected $actions = false;
    protected $northBlocked = true;
    protected $eastBlocked = true;
    protected $southBlocked = true;
    protected $westBlocked = true;

    public function __construct()
    {
        $this->inventory = new Inventory();
        $this->addAction(new Look());
        $this->init();
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getInventory()
    {
        return $this->inventory;
    }

    public function addAction(AbstractAction $action)
    {
        $action->setSubject($this);
        $this->actions[$action->getName()] = $action;
        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function setNorthBlocked($bool)
    {
        $this->northBlocked = (bool) $bool;
        return $this;
    }

    public function setEastBlocked($bool)
    {
        $this->eastBlocked = (bool) $bool;
        return $this;
    }

    public function setSouthBlocked($bool)
    {
        $this->southBlocked = (bool) $bool;
        return $this;
    }

    public function setWestBlocked($bool)
    {
        $this->westBlocked = (bool) $bool;
        return $this;
    }

    public function isNorthBlocked()
    {
        return $this->northBlocked;
    }

    public function isEastBlocked()
    {
        return $this->eastBlocked;
    }

    public function isSouthBlocked()
    {
        return $this->southBlocked;
    }

    public function isWestBlocked()
    {
        return $this->westBlocked;
    }

    protected function init()
    {
       // template method
    }
}