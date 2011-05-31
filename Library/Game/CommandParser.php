<?php
namespace Game;
use Game\Grid,
    Game\AbstractItem,
    Game\Inventory;
class CommandParser
{
    /**
     * The user input
     *
     * @var string
     */
    protected $input;

    /**
     *
     * Input after Game\Actions are applied to Game\AbstractItem(s)
     * When such a thing has happened the reference to the item / action
     * is removed from the string. Making the string ready for further parsing
     *
     * @var string
     */
    protected $parsedInput;

    /**
     * the current tile on which the player is
     *
     * @var Game\Tile
     */
    protected $tile;

    /**
     * The personal inventory of the player
     *
     * @var Game\Inventory
     */
    protected $personalInventory;

    /**
     *
     * The object which implements Game\Action\Action
     *
     * @var mixed
     */
    protected $itemPrimary = false;

    /**
     *
     * The primary item its inventory
     *
     * @var Game\Inventory
     */
    protected $itemPrimaryInventory = false;

    /**
     *
     * The second object which implements Game\Action\Action so it can be inspected for a potential
     * itemcombination
     *
     * @var mixed
     */
    protected $itemSecondary = false;

    /**
     *
     * The second item its inventory
     *
     * @var Game\Inventory
     */
    protected $itemSecondaryInventory = false;

    /**
     * The grid of the game
     * @var Game\Grid
     */
    protected $grid;

    /**
     *
     * a itemcombination factory name taking care of creating and
     * registering all the item combinations in the game
     *
     * @var string
     */
    protected $combinationRegistryClass;

    /**
     * Constructor
     * Will setup the entire parser and run it automatically
     *
     * @param string $input
     * @param Game\Grid $grid
     * @param Game\Inventory $personalInventory
     * @return void
     */
    public function __construct($input, Grid $grid, Inventory $personalInventory)
    {
        $this->input = trim($input);
        $this->parsedInput = $this->input;
        $this->personalInventory = $personalInventory;
        $this->grid = $grid;
        $this->tile = $grid->getTileFromPosition();
        $this->parseCommand();
    }

    /**
     * Parses the input
     *
     * @return mixed
     */
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

    /**
     * Get the itemlist from the inventory while keeping an item-inventory reference
     *
     * @param $inventory
     * @return array
     */
    protected function getItemListFromInventory(Inventory $inventory)
    {
        $inventoryList = array();
        foreach ($inventory->getItems() as $item) {
            $inventoryList[$item->getName()] = array('item' => $item, 'inventory' => $inventory);
            $inventoryList = $inventoryList + $this->getItemListFromInventory($item->getInventory());
        }
        return $inventoryList;
    }

    /**
     * Will extract the Game\Action from the input
     *
     * @return Game\Action
     */
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

    /**
     * Will extract the Game\Action from the primary item using the input
     *
     * @return Game\Action
     */
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

    /**
     * Get the Game\AbstractItem from the inventory depending on the input
     * @param Game\Inventory $itemsAvailable
     * @return Game\AbstractItem
     */
    protected function getItemForActionFromInventory(Inventory $itemsAvailable)
    {
        foreach ($itemsAvailable->getItems() as $item) {
            if ($item = $this->getItemForAction($item)) {
                return $item;
            }
        }
        return false;
    }

    /**
     * Check whether an item matches a specific input
     * @param Game\AbstractItem $item
     *
     * @return Game\AbstractItem
     */
    protected function getItemForAction(AbstractItem $item)
    {
        if (stripos($this->parsedInput, $item->getName()) !== false) {
            $this->parsedInput = str_ireplace($item->getName(), '', $this->parsedInput);
            return $item;
        }
        return false;
    }
}