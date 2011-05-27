<?php
namespace Game\Action;
use Game\Grid,
    Game\Item,
    Game\Tile,
    Game\Inventory;
abstract class AbstractAction
{
    /**
     *
     * The subject on which the action will apply
     *
     * @var mixed Game\Item, Game\Tile, Game\Grid
     */
    protected $subject;

    /**
     * name of the action, it is the id of a specific action
     *
     * @var string
     */
    protected $name = 'action';

    /**
     * The commands under which the action can be found and executed
     *
     * @var array of regex compatible strings
     */
    protected $synonyms = array();

    /**
     * some actions must know the grid, because it can potentially manipulate it
     * Think for instance teleportation to another position
     *
     * @var Game\Grid
     */
    protected $grid;

    /**
     * some actions must know the personal inventory, because it can potentially manipulate it
     *
     * @var Game\Inventory
     */
    protected $personalInventory;

    /**
     * Constructor
     * with Grid and Inventory injection for some actions
     * Additional logic at the end of the constructor can be added automatically
     * by implementing the init() method
     *
     * @param Game\Grid $grid
     * @param Game\Inventory $inventory
     * @return void
     */
    public function __construct(Grid $grid = null, Inventory $inventory = null)
    {
        $this->grid = $grid;
        $this->personalInventory = $inventory;
        $this->init();
    }

    /**
     * set the subject
     *
     * @param $subject
     * @return Game\Action\AbstractAction
     */
    public function setSubject($subject)
    {
        if (!($subject instanceOf Item) && !($subject instanceOf Tile) && !($subject instanceOf Grid)) {
            throw new Exception\InvalidArgumentException('subject passed should be of type Item, Tile, Grid');
        }
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the synonyms
     *
     * @return array
     */
    public function getSynonyms()
    {
        return $this->synonyms;
    }

    /**
     * set the grid
     *
     * @param Game\Grid $grid
     * @return Game\Action\AbstractAction
     */
    public function setGrid(Grid $grid)
    {
        $this->grid = $grid;
        return $this;
    }

    /**
     * set the personal inventory
     *
     * @param Game\inventory $inventory
     * @return Game\Action\AbstractAction
     */
    public function setPersonalInventory(Inventory $inventory)
    {
        $this->personalInventory = $inventory;
        return $this;
    }

    /**
     * This method is where the child will put all the logic that
     * needs to be performed to make the action actually do something
     */
    abstract public function execute();

    /**
     * When the action was successfully executed this message could be displayed
     *
     * @return string;
     */
    protected function getExecutedMessageSuccess()
    {
        echo 'action executed';
    }

    /**
     * When the action executed failed this message could be displayed
     *
     * @return string;
     */
    protected function getExecutedMessageFailed()
    {
        echo 'action failed';
    }

    /**
     * When it is a success the logic in this method is a good placeholder
     * for that implementation
     */
    protected function executeSuccess()
    {
        // template method
    }

    /**
     * When it is a failure the logic in this method is a good placeholder
     * for that implementation
     */
    protected function executeFailed()
    {
        // template method
    }

    /**
     * template method, should be used instead of overriding the constructor
     *
     * @return void
     */
    protected function init()
    {
        // template method
    }
}