<?php
namespace Game\Action;
class Stub extends AbstractAction
{
    public function execute()
    {
        return null;
    }

    // helper function for testing
    public function setName($name)
    {
        $this->name = $name;
    }
}