<?php
namespace App;
class CombinationRegistry
{
    protected $inventoryList;

    public function __construct(array $inventoryList)
    {
        $this->inventoryList = $inventoryList;
        $this->registerCombination('App\ItemCombination\RustyNailPrisonLock', 'nail', 'lock', 'You unlocked the door');
    }

    protected function registerCombination($combination, $itemOne, $itemTwo, $message)
    {
        if (array_key_exists($itemOne, $this->inventoryList) && array_key_exists($itemTwo, $this->inventoryList)) {
           new $combination($this->inventoryList[$itemOne]['item'], $this->inventoryList[$itemTwo]['item'], $message);
        }
    }
}