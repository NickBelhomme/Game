<?php
namespace Game\Item;
use Game\AbstractItem;
class Stub extends AbstractItem
{
    protected $name = 'test';
    protected $description = 'this is a test';

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

}