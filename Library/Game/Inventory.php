<?php
namespace Game;
class Inventory
{
    const ITEM_INFINITE_QUANTITY = -1;

    protected $itemsWithQuantity = array();

    public function addItem(Item $item, $quantity = 1)
    {
        $this->itemsWithQuantity[$item->getName()] = array($item, (int) $quantity);
        return $this;
    }

    public function removeItem(Item $item)
    {
        if ($this->itemExists($item)) {
            unset($this->itemsWithQuantity[$item->getName()]);
            return true;
        }
        return false;
    }

    public function getItems()
    {
        $items = array();
        foreach ($this->itemsWithQuantity as $itemWithQuantity) {
            $items[] = $itemWithQuantity[0];
        }
        return $items;
    }

    public function takeItem(Item $item)
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

    public function getItemByName($name)
    {
        if (array_key_exists($name, $this->itemsWithQuantity)) {
            return $this->itemsWithQuantity[$name][0];
        }
        return false;
    }

    protected function itemExists(Item $item)
    {
        foreach ($this->itemsWithQuantity as $itemWithQuantity) {
            if ($itemWithQuantity[0]->getName() === $item->getName()) {
                return true;
            }
        }
        return false;
    }

    protected function decreaseItemQuantity(Item $item)
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