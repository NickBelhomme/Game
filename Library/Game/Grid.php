<?php
namespace Game;
use Game\Action\Go,
    Game\Action\AbstractAction,
    Game\Tile,
    Game\Action\AcceptAction;
class Grid implements AcceptAction
{
    /**
     * The actual grid where the tiles will be stored
     *
     * @var array
     */
    protected $grid;

    /**
     * The actual x-y position of the player on the grid (refers to
     * a specific tile location)
     *
     * @var array
     */
    protected $position = array('x' => 0, 'y' => 0);

    /**
     * an Game\Action\AbstractAction stack can be added to the item
     *
     * @var array
     */
    protected $actions;

    /**
     * Constructor
     * accepts the size of the grid. Equal to the number of tiles
     * it can accept
     *
     * @param integer $gridSizeX
     * @param integer $gridSizeY
     * @return void
     */
    public function __construct($gridSizeX, $gridSizeY)
    {
        if (0 >= (int) $gridSizeX || 0 >= (int) $gridSizeY) {
            throw new Exception\OutOfRangeException('Grid size cannot be zero or negative');
        }

        $this->buildGrid($gridSizeX, $gridSizeY);
        $this->initializeActions();
    }

    /**
     * Returns the grid size by x and y max bounds
     *
     * @return array
     */
    public function getGridSize()
    {
        return array('x' => count($this->grid), 'y' => count($this->grid[0]));
    }

    /**
     * adds an action to the action stack
     *
     * @see Game\Action.Action::addAction()
     * @return Game\Grid
     */
    public function addAction(AbstractAction $action)
    {
        $this->actions[$action->getName()] = $action;
        $action->setGrid($this);
        return $this;
    }

    /**
     * get the actions stack registered to the Grid
     *
     * @see Game\Action.Action::getActions()
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * adds a tile to a specific location on the grid
     *
     * @param Game\Tile $tile
     * @param integer $x
     * @param integer $y
     * @return Game\Grid
     */
    public function addTile(Tile $tile, $x, $y)
    {
        $this->ifNotOnGridThrowException($x, $y);
        $this->isTileValidOnGrid($tile, $x, $y);
        $this->grid[$x][$y] = $tile;
        return $this;
    }

    /**
     * gets a tile from a specific location on the grid
     *
     * @param integer $x
     * @param integer $y
     * @return Game\Tile
     */
    public function getTile($x, $y)
    {
        $this->ifNotOnGridThrowException($x, $y);
        return $this->grid[$x][$y];
    }

    /**
     * gets a tile from the current location on the grid
     *
     * @return Game\Tile
     */
    public function getTileFromPosition()
    {
        $position = $this->getPosition();
        return $this->getTile($position['x'], $position['y']);
    }

    /**
     * returns the current x-y position of the player
     *
     * @return array
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * set the player his x-y position on the grid
     *
     * @param integer $x
     * @param integer $y
     * @return Game\Grid
     */
    public function setPosition($x,$y)
    {
        $this->ifNotOnGridThrowException($x, $y);
        $this->position = array('x' => $x, 'y' => $y);
        return $this;
    }

    /**
     * Check whether the x-y position is in the boundaries of the grid
     *
     * @param integer $x
     * @param integer $y
     * @return boolean
     */
    public function isOnGrid($x, $y)
    {
        if (!array_key_exists($x, $this->grid) || !array_key_exists($y, $this->grid[$x])) {
            return false;
        }
        return true;
    }

    /**
     * Exception raiser for x-y position on grid.
     * forces an exception if not on grid
     *
     * @param integer $x
     * @param integer $y
     * @throws Game\Exception\OutOfRangeException
     * @return void
     */
    protected function ifNotOnGridThrowException($x, $y)
    {
        if (!$this->isOnGrid($x, $y)) {
            throw new Exception\OutOfRangeException('Tile position is not valid on grid');
        }
    }

    /**
     * By default a grid knows some actions. These are defined here
     *
     * @return void
     */
    protected function initializeActions()
    {
        $this->addAction(new Go\North())
             ->addAction(new Go\South())
             ->addAction(new Go\West())
             ->addAction(new Go\East());
    }

    /**
     * build the actual grid depending on the given sizes
     *
     * @param integer $sizeX
     * @param integer $sizeY
     * @return void
     */
    protected function buildGrid($sizeX, $sizeY)
    {
        for ($x = 0; $x < (int) $sizeX; $x++) {
            for ($y = 0; $y < (int) $sizeY; $y++) {
                $this->grid[$x][$y] = null;
            }
        }
    }

    /**
     * Checks whether the given tile can be placed on the grid.
     * Tiles which are blocked on a certain wind direction cannot be placed
     * on that same grid boundary
     *
     * @param Game\Tile $tile
     * @param integer $x
     * @param integer $y
     * @throws Game\Exception\DomainException
     * @return boolean
     */
    protected function isTileValidOnGrid(Tile $tile, $x, $y)
    {
        if ($y == 0) {
            if (! $tile->isNorthBlocked()) {
                throw new Exception\DomainException('Tile placement on grid is not valid, North');
            }
        }

        if ($y == count($this->grid[0])-1) {
            if (! $tile->isSouthBlocked()) {
                throw new Exception\DomainException('Tile placement on grid is not valid, South');
            }
        }

        if ($x == 0) {
            if (! $tile->isWestBlocked()) {
                throw new Exception\DomainException('Tile placement on grid is not valid, West');
            }
        }

        if ($x == count($this->grid) - 1) {
            if (! $tile->isEastBlocked()) {
                throw new Exception\DomainException('Tile placement on grid is not valid, East');
            }
        }
        return true;
    }
}