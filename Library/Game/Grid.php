<?php
namespace Game;
use Game\Action\Go,
    Game\Action\AbstractAction,
    Game\Tile,
    Game\Action\Action;
class Grid implements Action
{
    protected $grid;
    protected $position = array('x' => 0, 'y' => 0);
    protected $actions;

    public function __construct($gridSizeX, $gridSizeY)
    {
        if (0 >= (int) $gridSizeX || 0 >= (int) $gridSizeY) {
          throw new \Exception('Grid size cannot be zero or negative');
        }

        $this->buildGrid($gridSizeX, $gridSizeY);
        $this->initializeActions();
    }

    public function getGridSize()
    {
        return array('x' => count($this->grid), 'y' => count($this->grid[0]));
    }

    public function addAction(AbstractAction $action)
    {
        $this->actions[$action->getName()] = $action;
        $action->setGrid($this);
        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function addTile(Tile $tile, $x, $y)
    {
        $this->ifNotOnGridThrowException($x, $y);
        $this->isTileValidOnGrid($tile, $x, $y);
        $this->grid[$x][$y] = $tile;
        return $this;
    }

    public function getTile($x, $y)
    {
        $this->ifNotOnGridThrowException($x, $y);
        return $this->grid[$x][$y];
    }

    public function getTileFromPosition()
    {
        $position = $this->getPosition();
        return $this->getTile($position['x'], $position['y']);
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($x,$y)
    {
        $this->ifNotOnGridThrowException($x, $y);
        $this->position = array('x' => $x, 'y' => $y);
    }

    public function isOnGrid($x, $y)
    {
        if (!array_key_exists($x, $this->grid) || !array_key_exists($y, $this->grid[$x])) {
            return false;
        }
        return true;
    }

    protected function ifNotOnGridThrowException($x, $y)
    {
        if (!$this->isOnGrid($x, $y)) {
            throw new \Exception('Tile position is not valid on grid');
        }
    }

    protected function initializeActions()
    {
        $this->addAction(new Go\North())
             ->addAction(new Go\South())
             ->addAction(new Go\West())
             ->addAction(new Go\East());
    }

    protected function buildGrid($sizeX, $sizeY)
    {
        for ($x = 0; $x < (int) $sizeX; $x++) {
            for ($y = 0; $y < (int) $sizeY; $y++) {
                $this->grid[$x][$y] = null;
            }
        }
    }

    protected function isTileValidOnGrid($tile, $x, $y)
    {
        if ($y == 0) {
            if (! $tile->isNorthBlocked()) {
                throw new \Exception ('Tile placement on grid is not valid, North');
            }
        }

        if ($y == count($this->grid[0])-1) {
            if (! $tile->isSouthBlocked()) {
                throw new \Exception ('Tile placement on grid is not valid, South');
            }
        }

        if ($x == 0) {
            if (! $tile->isWestBlocked()) {
                throw new \Exception ('Tile placement on grid is not valid, West');
            }
        }

        if ($x == count($this->grid) - 1) {
            if (! $tile->isEastBlocked()) {
                throw new \Exception ('Tile placement on grid is not valid, East');
            }
        }
        return true;
    }
}