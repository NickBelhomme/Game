<?php
namespace Game\ItemCombination;
use Game,
    Game\Item,
    Game\Action;
class Stub extends Game\ItemCombination
{
    public function __construct(Item $itemOne = null, Item $itemTwo = null)
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