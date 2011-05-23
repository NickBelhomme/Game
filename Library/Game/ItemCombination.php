<?php
namespace Game;
use Game\Item,
    Game\Action\AbstractAction;
abstract class ItemCombination
{
    protected $itemOne;
    protected $itemTwo;
    protected $action;

    public function __construct(Item $itemOne, Item $itemTwo)
    {
        $this->init();
        if (! ($this->action instanceof AbstractAction)) {
            throw new \Exception('subclass should set property action to a Game_Action');
        }

        $this->itemOne = $itemOne;
        $this->itemTwo = $itemTwo;
        $this->registerCombinationToItems();
    }

    public function getItemOne()
    {
        return $this->itemOne;
    }

    public function getItemTwo()
    {
        return $this->itemTwo;
    }

    public function isValidItem(Item $item)
    {
        return ($item === $this->itemTwo);
    }

    abstract protected function init();

    protected function registerCombinationToItems()
    {
        $this->itemOne->addItemCombination($this);
        $this->itemOne->addAction($this->action);
    }
}