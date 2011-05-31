<?php
namespace Game;
use Game\Action\AcceptAction,
    Game\Action\AbstractAction,
    Game\Action\Look,
    Game\Inventory;
class Tile implements AcceptAction
{
    /**
     * Each tile has a description which will be used when the look command will be invoked
     *
     * @var string
     */
    protected $description = 'tile';

    /**
     * A tile can have interactive items, these items are stored in an inventory.
     *
     * @var Game\Inventory
     */
    protected $inventory;

    /**
     * an Game\Action\AbstractAction stack can be added to the item
     *
     * @var array
     */
    protected $actions = false;

    /**
     * A tile needs to be aligned to other tiles in a grid
     * Depending on the position on the grid or adjoining tile
     * the player cannot move towards the north direction
     *
     * @var boolean
     */
    protected $northBlocked = true;

    /**
     * A tile needs to be aligned to other tiles in a grid
     * Depending on the position on the grid or adjoining tile
     * the player cannot move towards the east direction
     *
     * @var boolean
     */
    protected $eastBlocked = true;

    /**
     * A tile needs to be aligned to other tiles in a grid
     * Depending on the position on the grid or adjoining tile
     * the player cannot move towards the south direction
     *
     * @var boolean
     */
    protected $southBlocked = true;

    /**
     * A tile needs to be aligned to other tiles in a grid
     * Depending on the position on the grid or adjoining tile
     * the player cannot move towards the west direction
     *
     * @var boolean
     */
    protected $westBlocked = true;

    /**
     * constructor
     * sets up an inventory and the action look automatically
     * Calls the template method init() at the end
     *
     * @return void
     */
    public function __construct()
    {
        $this->inventory = new Inventory();
        $this->addAction(new Look());
        $this->init();
    }

    /**
     * Returns the description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the inventory of the tile
     *
     * @return Game\Inventory
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * adds an action to the action stack
     *
     * @see Game\Action.Action::addAction()
     * @return Game\Tile
     */
    public function addAction(AbstractAction $action)
    {
        $action->setSubject($this);
        $this->actions[$action->getName()] = $action;
        return $this;
    }

    /**
     * get the actions stack registered to the tile
     *
     * @see Game\Action.Action::getActions()
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Blocks the north of the tile
     *
     * @param boolean $bool
     * @return Game\Tile
     */
    public function setNorthBlocked($bool)
    {
        $this->northBlocked = (bool) $bool;
        return $this;
    }

    /**
     * Blocks the east of the tile
     *
     * @param boolean $bool
     * @return Game\Tile
     */
    public function setEastBlocked($bool)
    {
        $this->eastBlocked = (bool) $bool;
        return $this;
    }

    /**
     * Blocks the south of the tile
     *
     * @param boolean $bool
     * @return Game\Tile
     */
    public function setSouthBlocked($bool)
    {
        $this->southBlocked = (bool) $bool;
        return $this;
    }

    /**
     * Blocks the west of the tile
     *
     * @param boolean $bool
     * @return Game\Tile
     */
    public function setWestBlocked($bool)
    {
        $this->westBlocked = (bool) $bool;
        return $this;
    }

    /**
     * checks whether the north of the tile is blocked
     *
     * @return boolean
     */
    public function isNorthBlocked()
    {
        return $this->northBlocked;
    }

    /**
     * checks whether the east of the tile is blocked
     *
     * @return boolean
     */
    public function isEastBlocked()
    {
        return $this->eastBlocked;
    }

    /**
     * checks whether the south of the tile is blocked
     *
     * @return boolean
     */
    public function isSouthBlocked()
    {
        return $this->southBlocked;
    }

    /**
     * checks whether the west of the tile is blocked
     *
     * @return boolean
     */
    public function isWestBlocked()
    {
        return $this->westBlocked;
    }


    /**
     * template method, should be used instead of overriding the constructor
     *
     * @return void
     */
    protected function init()
    {
       // template method
    }
}