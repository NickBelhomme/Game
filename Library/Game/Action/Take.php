<?php
namespace Game\Action;
class Take extends AbstractAction
{
    protected $name = 'take';
    protected $synonyms = array(
        'take[ ]?',
        'pick[ ]?up[ ]?',
        'get[ ]?',
    );

    public function execute()
    {
        if ($this->grid->getTileFromPosition()->getInventory()->takeItem($this->subject)) {
            $this->personalInventory->addItem($this->subject, 1);
            $this->executeSuccess();
            $this->getExecutedMessageSuccess();
            return true;
        } else  {
            foreach ($this->grid->getTileFromPosition()->getInventory()->getItems() as $item) {
                if ($item->getInventory()->takeItem($this->subject)) {
                      $this->personalInventory->addItem($this->subject, 1);
                   $this->executeSuccess();
                   $this->getExecutedMessageSuccess();
                   return true;
               }
            }
        }
        $this->executeFailed();
        $this->getExecutedMessageFailed();
        return false;
    }

    protected function getExecutedMessageSuccess()
    {
        echo $this->subject->getName().' taken';
    }

    protected function getExecutedMessageFailed()
    {
        echo 'could not take '.$this->subject->getName();
    }
}