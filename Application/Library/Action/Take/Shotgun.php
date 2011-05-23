<?php
namespace App\Action\Take;
use Game\Action\Take;
class Shotgun extends Take
{
    protected function getExecutedMessageFailed()
    {
        echo 'You already have the shotgun. It makes you feel safe.';
    }
}