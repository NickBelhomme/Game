<?php
namespace App\Item;
use Game\AbstractItem,
    Game\Action\Conversate,
    Game\Action\Look,
    App\Conversation;
class PoliceOfficer extends AbstractItem
{
    protected $name = 'police officer';
    protected $description = 'The police officer looks as if he was attacked by some vicious animal. Half of his cheek has been ripped from his face. He has a terrifried expression on his face. His hair sticks to his forehead in a mix of sweat, grease and blood. He holds a gun on his lap and is murmering: I can\'t, oh God please help me.';

    protected function init()
    {
       $this->addAction(new Look());

       $this->setConversation(new Conversation\PoliceOfficer());
       $this->addAction(new Conversate());
    }
}