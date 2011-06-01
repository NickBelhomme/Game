<?php
namespace App;
class Bootstrap
{
    protected $container;
    protected $state;
    protected $request;

    public function __construct()
    {
        $this->request = $this->createRequest();
        $this->state = new \Game\State();
        if ($this->request->getCmd() == 'reset') {
            $this->state->reset();
            $this->request->setCmd('');
        }
        if (!$container = $this->state->load()) {
            $container = new \Game\Container();
            $container->offsetSet('grid', $this->createGrid());
            $container->offsetSet('personalInventory', $this->createPersonalInventory());
        }
        $this->container = $container;
    }


    public function run()
    {
        new CommandParser($this->request, $this->container['grid'], $this->container['personalInventory']);
        $this->state->save($this->container);
    }

    protected function createGrid()
    {
        $grid = new \Game\Grid(2, 2);
        $grid->addTile(new \App\Tile\PrisonCell(), 0, 0)
             ->addTile(new \App\Tile\PrisonOffice(), 1, 0);
        return $grid;
    }

    protected function createRequest()
    {
        $request = new \Game\Request();
        if (!empty($_GET['cmd'])) {
            $request->setCmd($_GET['cmd']);
        }
        return $request;
    }

    public function createPersonalInventory()
    {
        return new \Game\Inventory();
    }
}