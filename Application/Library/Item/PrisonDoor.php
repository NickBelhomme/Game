<?php
namespace App\Item;
use Game\Item,
    Game\Action\Look,
    \App\Action\Take,
    \App\Action\Go,
    \App\Action\Open;
class PrisonDoor extends Item
{
    protected $name = 'door';
    protected $description = 'It is a rusty door made of bars. There is a lock locking the door.';
    protected $descriptionUnlocked = 'It is a rusty door made of bars. It looks unlocked';
    protected $isLocked = true;
    protected $isClosed = true;

    protected function init()
    {
        $this->addAction(new Look())
            ->addAction(new Open\PrisonDoor())
            ->addAction(new Go\PrisonDoor());
       $this->inventory->addItem($prisonLock = new PrisonLock(), 0);
    }

    public function getDescription()
    {
        if($this->isLocked) {
            return $this->description;
        } else {
            return $this->descriptionUnlocked;
        }
    }

    public function setIsLocked($bool)
    {
       $this->isLocked = (bool) $bool;
       return $this;
    }

    public function getIsLocked()
    {
       return $this->isLocked;
    }

    public function setIsClosed($bool)
    {
       $this->isClosed = (bool) $bool;
       return $this;
    }

    public function getIsClosed()
    {
       return $this->isClosed;
    }
}