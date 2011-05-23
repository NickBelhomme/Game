<?php
namespace Game;
use Game\Action\Action,
    Game\Action\AbstractAction,
    Game\Conversation,
    Game\ItemCombination,
    Game\Inventory;
abstract class Item implements Action
{
    protected $name;
    protected $description;
    protected $actions;
    protected $itemCombinations = array();
    protected $conversation;
    protected $inventory;

    public function __construct()
    {
        if (is_null($this->name)) {
            throw new \Exception('You have to specify a name in the Item subclass');
        }

        if (is_null($this->description)) {
            throw new \Exception('You have to specify a description in the Item subclass');
        }
        $this->inventory = new Inventory();
        $this->init();
    }

    public function setConversation(Conversation $conversation)
    {
        $this->conversation = $conversation;
        return $this;
    }

    public function getConversation()
    {
        return $this->conversation;
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

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function addItemCombination(ItemCombination $item)
    {
        $this->itemCombinations[] = $item;
        return $this;
    }

    public function getCombinations()
    {
        return $this->itemCombinations;
    }

    public function getInventory()
    {
        return $this->inventory;
    }

    protected function init()
    {
       // template method
    }
}