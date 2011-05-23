<?php
namespace Game\Action;
use Game\Grid,
    Game\Item,
    Game\Tile,
    Game\Inventory;
abstract class AbstractAction
{
    protected $subject;
    protected $name = 'action';
    protected $synonyms = array();
    protected $grid;
    protected $personalInventory;

    public function __construct(Grid $grid = null, Inventory $inventory = null)
    {
        $this->grid = $grid;
        $this->personalInventory = $inventory;
        $this->init();
    }

    public function setSubject($subject)
    {
        if (!($subject instanceOf Item) && !($subject instanceOf Tile) && !($subject instanceOf Grid)) {
            throw new \Exception('subject passed should be of type Item, Tile, Grid');
        }
        $this->subject = $subject;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSynonyms()
    {
        return $this->synonyms;
    }

    public function setGrid(Grid $grid)
    {
        $this->grid = $grid;
        return $this;
    }

    public function setPersonalInventory(Inventory $inventory)
    {
        $this->personalInventory = $inventory;
        return $this;
    }

    abstract public function execute();

    protected function getExecutedMessageSuccess()
    {
        echo 'action executed';
    }

    protected function getExecutedMessageFailed()
    {
        echo 'action failed';
    }

    protected function executeSuccess()
    {
        // template method
    }

    protected function executeFailed()
    {
        // template method
    }

    protected function init()
    {
        // template method
    }
}