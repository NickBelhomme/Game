<?php
namespace Game;
use Game\Grid,
    Game\Inventory;
class CommandParser
{
    protected $input;
    protected $parsedInput;
    protected $action;
    protected $tile;
    protected $personalInventory;
    protected $itemPrimary = false;
    protected $itemPrimaryInventory = false;
    protected $itemSecondary = false;
    protected $itemSecondaryInventory = false;
    protected $grid;
    protected $combinationRegistryClass;

    public function __construct($cmd, Grid $grid, Inventory $personalInventory)
    {
        $this->input = trim($cmd);
        $this->parsedInput = $this->input;
        $this->personalInventory = $personalInventory;
        $this->grid = $grid;
        $this->tile = $grid->getTileFromPosition();
        $this->parseCommand();
    }

    protected function parseCommand()
    {
        $completeInventoryList = $this->getItemListFromInventory($this->tile->getInventory()) + $this->getItemListFromInventory($this->personalInventory);
        ksort($completeInventoryList);
        $completeInventoryList = array_reverse($completeInventoryList);

        if (!is_null($this->combinationRegistryClass)) {
            new $this->combinationRegistryClass($completeInventoryList);
        }

        foreach ($completeInventoryList as $itemInfo) {
            if ($this->itemPrimary = $this->getItemForAction($itemInfo['item'])) {
                $this->itemPrimaryInventory = $itemInfo['inventory'];
                unset($completeInventoryList[$itemInfo['item']->getName()]);
                break;
            }
        }

        foreach ($completeInventoryList as $itemInfo) {
            if ($this->itemSecondary = $this->getItemForAction($itemInfo['item'])) {
                $this->itemSecondaryInventory = $itemInfo['inventory'];
                unset($completeInventoryList[$itemInfo['item']->getName()]);
                break;
            }
        }

        if (!$this->itemPrimary) {
            $this->itemPrimary = $this->tile;
        }

        if (!$action = $this->getAction()) {
            $this->itemPrimary = $this->grid;
            $action = $this->getAction();
        }

        if ($action) {
            $action->setGrid($this->grid);
            $action->setPersonalInventory($this->personalInventory);
            $action->execute();
            return;
        }
        echo 'you cannot do that';
    }

    protected function getItemListFromInventory(Inventory $inventory)
    {
        $inventoryList = array();
        foreach ($inventory->getItems() as $item) {
            $inventoryList[$item->getName()] = array('item' => $item, 'inventory' => $inventory);
            $inventoryList = $inventoryList + $this->getItemListFromInventory($item->getInventory());
        }
        return $inventoryList;
    }

    protected function getAction()
    {
        if ($action = $this->getActionFromInput()) {
            if($action instanceof Game_Action_Combine) {
                if ($this->itemSecondary !== $action->getCombination()->getItemTwo()) {
                    $action = false;
                }
            }
        }
        return $action;
    }

    protected function getActionFromInput()
    {
        if ($actions = $this->itemPrimary->getActions()) {
            foreach ($actions as $action) {
                foreach ($action->getSynonyms() as $synonym) {
                    if (preg_match('#^'.$synonym.'#i', $this->parsedInput)) {
                        if ('conversate' === $action->getName()) {
                            if (preg_match('#say (\d)+#', $this->parsedInput, $match)) {
                                $action->setSelectedOptionId($match[1]);
                            }
                        }
                        return $action;
                    }
                }
            }
        }
        return false;
    }

    protected function getItemForActionFromInventory(Inventory $itemsAvailable)
    {
        foreach ($itemsAvailable->getItems() as $item) {
            if ($item = $this->getItemForAction($item)) {
                return $item;
            }
        }
        return false;
    }

    protected function getItemForAction($item)
    {
        if (stripos($this->parsedInput, $item->getName()) !== false) {
            $this->parsedInput = str_ireplace($item->getName(), '', $this->parsedInput);
            return $item;
        }
        return false;
    }

    public function executeCommand()
    {
        return $this->action;
    }
}