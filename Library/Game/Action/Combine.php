<?php
namespace Game\Action;
use Game\AbstractItemCombination,
    Game\Inventory,
    Game\Grid;
class Combine extends AbstractAction
{
    /**
     * Each Combine action has a name which will be used
     * as a unique identifier
     *
     * @var string
     */
    protected $name = 'combine';

    /**
     * The commands under which the action can be found and executed
     *
     * @var array of regex compatible strings
     */
    protected $synonyms = array(
        'combine[ ]+with[ ]+',
        'use[ ]+(with|on)[ ]+',
        'throw[ ]+in[ ]+',
        'merge[ ]+with[ ]+',
        'drop[ ]+in[ ]+',
    );

    /**
     * an item combination on which the action should be executed
     *
     * @var Game\AbstractItemCombination
     */
    protected $combination;

    /**
     * Constructor
     *
     * @param Game\AbstractItemCombination $combination
     * @param Game\Grid $grid
     * @param Game\Inventory $inventory
     * @return void
     */
    public function __construct(AbstractItemCombination $combination, Grid $grid = null, Inventory $inventory = null)
    {
        parent::__construct($grid, $inventory);
        $this->combination = $combination;

    }

    /**
     * get the item combination
     *
     * @return Game\AbstractItemCombination
     */
    public function getCombination()
    {
        return $this->combination;
    }

    /**
     * try to combine the items
     * @see Game\Action.AbstractAction::execute()
     * @return void
     */
    public function execute()
    {
        $this->executeSuccess();
        $this->getExecutedMessageSuccess();
    }
}