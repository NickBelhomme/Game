<?php
namespace Game;
use Game\Item,
    Game\Action\AbstractAction;
abstract class ItemCombination
{
    /**
     * first item of the combination
     *
     * @var Game\Item
     */
    protected $itemOne;

    /**
     * second item of the combination
     *
     * @var Game\Item
     */
    protected $itemTwo;

    /**
     * Action to perform to combine the two items
     *
     * @var Game\Action\ActionAbstract
     */
    protected $action;

    /**
     * constructor
     * Will create the complete combination by accepting two items
     * Calls the template method init() at the beginning
     *
     * @param \Game\Item $itemOne
     * @param \Game\Item $itemTwo
     * @throws \Exception
     * @return void
     */
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

    /**
     * returns the first item from the combination
     *
     * @return Game\Item
     */
    public function getItemOne()
    {
        return $this->itemOne;
    }

    /**
     * returns the second item from the combination
     *
     * @return Game\Item
     */
    public function getItemTwo()
    {
        return $this->itemTwo;
    }

    /**
     * a template method that needs to be implemented
     * is used to do some additional stuff before the constructor
     * runs
     *
     * @return void
     */
    abstract protected function init();

    /**
     * Will register the combination to the items
     *
     * @return void
     */
    protected function registerCombinationToItems()
    {
        $this->itemOne->addItemCombination($this);
        $this->itemOne->addAction($this->action);
    }
}