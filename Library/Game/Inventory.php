<?php
namespace Game;
class Inventory
{
    /**
     * Some items can have an infinite supply, this const will indicate that
     *
     * @var integer
     */
    const ITEM_INFINITE_QUANTITY = -1;

    /**
     * Game\AbstractItem stack with their respective quantities
     *
     * @var array
     */
    protected $itemsWithQuantity = array();

    /**
     * Adds an item to the itemstack. For each item their can be only one instance
     * with a respective quantity registered
     *
     * @param Game\AbstractItem $item
     * @param integer $quantity
     * @return Game\Inventory
     */
    public function addItem(AbstractItem $item, $quantity = 1)
    {
        $this->itemsWithQuantity[$item->getName()] = array($item, (int) $quantity);
        return $this;
    }

    /**
     * Remove an item from the itemstack
     *
     * @param Game\AbstractItem $item
     * @return boolean true on success
     */
    public function removeItem(AbstractItem $item)
    {
        if ($this->itemExists($item)) {
            unset($this->itemsWithQuantity[$item->getName()]);
            return true;
        }
        return false;
    }

    /**
     * Get all the items without their quantity from the itemstack
     *
     * @return array
     */
    public function getItems()
    {
        $items = array();
        foreach ($this->itemsWithQuantity as $itemWithQuantity) {
            $items[] = $itemWithQuantity[0];
        }
        return $items;
    }

    /**
     * Decreases the item with one, you take 1 quantity from the stack
     *
     * @param Item $item
     * @return boolean true on success
     */
    public function takeItem(AbstractItem $item)
    {
        if ($this->itemExists($item)) {
            if (self::ITEM_INFINITE_QUANTITY === $this->itemsWithQuantity[$item->getName()][1]) {
                return true;
            } else {
                return $this->decreaseItemQuantity($item);
            }
        }
        return false;
    }

    /**
     * Get a specific item without its quantities from the itemstack
     *
     * @param $name name of the item
     * @return mixed Game\AbstractItem boolean False on not found
     */
    public function getItemByName($name)
    {
        if (array_key_exists($name, $this->itemsWithQuantity)) {
            return $this->itemsWithQuantity[$name][0];
        }
        return false;
    }

    /**
     * Checks wether a specific item already is registered
     *
     * @param Game\AbstractItem $item
     * @return boolean true when already in stack
     */
    protected function itemExists(AbstractItem $item)
    {
        foreach ($this->itemsWithQuantity as $itemWithQuantity) {
            if ($itemWithQuantity[0]->getName() === $item->getName()) {
                return true;
            }
        }
        return false;
    }

    /**
     * decrease the item quantity with one
     *
     * @param Item $item
     * @return boolean true on decrease
     */
    protected function decreaseItemQuantity(AbstractItem $item)
    {
        if ($this->itemExists($item)) {
            if (0 < $this->itemsWithQuantity[$item->getName()][1]) {
                $this->itemsWithQuantity[$item->getName()][1]--;
                if (0 === $this->itemsWithQuantity[$item->getName()][1]) {
                    $this->removeItem($item);
                }
                return true;
            }
        }
        return false;
    }
}