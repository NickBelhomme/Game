<?php
namespace Game\Action;
use Game\ItemCombination,
    Game\Inventory,
    Game\Grid;
class Combine extends AbstractAction
{
    protected $name = 'combine';
    protected $synonyms = array(
        'combine[ ]+with[ ]+',
        'use[ ]+(with|on)[ ]+',
        'throw[ ]+in[ ]+',
        'merge[ ]+with[ ]+',
        'drop[ ]+in[ ]+',
    );

    protected $combination;

    public function __construct(ItemCombination $combination, Grid $grid = null, Inventory $inventory = null)
    {
        parent::__construct($grid, $inventory);
        $this->combination = $combination;

    }

    public function getCombination()
    {
        return $this->combination;
    }

    public function execute()
    {
        $this->executeSuccess();
        $this->getExecutedMessageSuccess();
    }
}