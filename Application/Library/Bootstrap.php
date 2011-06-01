<?php
namespace App;
class Bootstrap
{
    protected $container;
    protected $state;
    protected $request;
    protected $response;

    public function __construct()
    {
        $this->request = $this->createRequest();
        $this->response = $this->createResponse();
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
        $parser = new CommandParser($this->request, $this->response, $this->container['grid'], $this->container['personalInventory']);
        $response = $parser->parseCommand();
        echo str_replace(PHP_EOL, '<br />',  $response->output());
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

    protected function createResponse()
    {
        $response = new \App\Response();
        return $response;
    }

    public function createPersonalInventory()
    {
        return new \Game\Inventory();
    }
}