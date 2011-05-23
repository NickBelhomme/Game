<?php
namespace App\Action\Take;
use Game\Action\Take;
class PrisonDirt extends Take
{
    protected function getExecutedMessageFailed()
    {
        echo 'Ouchoum, dirt makes me sneeze. Better leave that alone.';
    }
}