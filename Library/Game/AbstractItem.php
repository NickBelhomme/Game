<?php
namespace Game;
use Game\Action\AcceptAction,
    Game\Action\AbstractAction,
    Game\Conversation,
    Game\Conversation\AcceptConversation,
    Game\AbstractItemCombination,
    Game\Inventory;
abstract class AbstractItem implements AcceptAction, AcceptConversation
{
    /**
     * Each item has a name which will be used
     * to call the item from the game
     *
     * @var string
     */
    protected $name;

    /**
     * Each item has a description which will be used when the look command will be invoked
     *
     * @var string
     */
    protected $description;

    /**
     * an Game\Action\AbstractAction stack can be added to the item
     *
     * @var array
     */
    protected $actions;

    /**
     * If the item is combinable with other actions
     * the combinations will be stored here
     *
     * @var Game\AbstractItemCombination
     */
    protected $itemCombinations = array();

    /**
     * Sometimes talking (making a conversation) to an item can be done
     *
     * @var Game\Conversation
     */
    protected $conversation;

    /**
     * A tile can have interactive items, these items are stored in an inventory.
     *
     * @var Game\Inventory
     */
    protected $inventory;

    /**
     * Constructor
     * Checks whether the subclass has implemented all the needed dependencies
     * Calls the template method init() at the end
     * @throws \Game\Exception\RuntimeException
     */
    public function __construct()
    {
        if (is_null($this->name)) {
            throw new Exception\RuntimeException('You have to specify a name in the Item subclass');
        }

        if (is_null($this->description)) {
            throw new Exception\RuntimeException('You have to specify a description in the Item subclass');
        }
        $this->inventory = new Inventory();
        $this->init();
    }

    /**
     * Set a conversation to the item
     * @param Game\Conversation $conversation
     * @return Game\Tile
     */
    public function setConversation(Conversation $conversation)
    {
        $this->conversation = $conversation;
        return $this;
    }

    /**
     * Gets the stored conversation
     *
     * @return Game\Conversation
     */
    public function getConversation()
    {
        return $this->conversation;
    }

    /**
     * adds an action to the action stack
     *
     * @see Game\Action.Action::addAction()
     * @return Game\Tile
     */
    public function addAction(AbstractAction $action)
    {
        $action->setSubject($this);
        $this->actions[$action->getName()] = $action;
        return $this;
    }

    /**
     * get the actions stack registered to the tile
     *
     * @see Game\Action.Action::getActions()
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * gets the name of the item
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * gets the description of the item
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Adds a combination to the item
     * @param Game\AbstractItemCombination $item
     * @return Game\AbstractItem
     */
    public function addItemCombination(AbstractItemCombination $combination)
    {
        $this->itemCombinations[] = $combination;
        return $this;
    }

    /**
     * Get back all registered combinations from the item
     *
     * @return array
     */
    public function getCombinations()
    {
        return $this->itemCombinations;
    }

    /**
     * Returns the inventory of the tile
     *
     * @return Game\Inventory
     */
    public function getInventory()
    {
        return $this->inventory;
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