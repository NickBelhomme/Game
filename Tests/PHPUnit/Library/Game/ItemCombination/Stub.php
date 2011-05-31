<?php
namespace Game\ItemCombination;
use Game\AbstractItemCombination,
    Game\AbstractItem,
    Game\Action;
class Stub extends AbstractItemCombination
{
    public function __construct(AbstractItem $itemOne = null, AbstractItem $itemTwo = null)
    {
        //supressed the original arguments
        if (!is_null($itemOne) && !is_null($itemTwo)) {
            parent::__construct($itemOne, $itemTwo);
        }
    }

    protected function init()
    {
        require_once TEST_PATH .'/Action/Stub.php';
        $this->action = new Action\Stub();
    }
}