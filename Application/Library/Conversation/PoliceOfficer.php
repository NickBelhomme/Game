<?php
namespace App\Conversation;
use Game\Conversation;
class PoliceOfficer extends Conversation
{
    protected function initDialog()
    {
        $this->give[0] = array('parentId' => 0, 'text' => 'Never Mind');
        $this->receive[0] = array('parentId' => 0, 'text' => 'don\'t leave, please you have to help me');
        $this->give[1] = array('parentId' => 0, 'text' => 'What happened to you, what the hell is going on?!');
        $this->receive[1] = array('parentId' => 1, 'text' => 'Nobody knows where to came from. It is insane, they eat human flesh, ooh god I am bitten.');
        $this->give[2] = array('parentId' => 1, 'text' => 'Bitten by what? What eats human flesh? Is that what happened to your face?');
        $this->receive[2] = array('parentId' => 2, 'text' => 'Please kill me, I have this gun but I can\'t do it myself. Something is wrong with my body, I feel it, aaargh the pain. The thoughts they are becomming dark, so dark.');
    }
}