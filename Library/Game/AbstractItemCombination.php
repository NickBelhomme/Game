<?php
namespace Game;
use Game\AbstractItem,
    Game\Action\AbstractAction;
abstract class AbstractItemCombination
{
    /**
     * first item of the combination
     *
     * @var Game\AbstractItem
     */
    protected $itemOne;

    /**
     * second item of the combination
     *
     * @var Game\AbstractItem
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
     * @param \Game\AbstractItem $itemOne
     * @param \Game\AbstractItem $itemTwo
     * @throws \Game\Exception\RuntimeException
     * @return void
     */
    public function __construct(AbstractItem $itemOne, AbstractItem $itemTwo)
    {
        $this->init();
        if (! ($this->action instanceof AbstractAction)) {
            throw new Exception\RuntimeException('subclass should set property action to a Game_Action');
        }

        $this->itemOne = $itemOne;
        $this->itemTwo = $itemTwo;
        $this->registerCombinationToItems();
    }

    /**
     * returns the first item from the combination
     *
     * @return Game\AbstractItem
     */
    public function getItemOne()
    {
        return $this->itemOne;
    }

    /**
     * returns the second item from the combination
     *
     * @return Game\AbstractItem
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