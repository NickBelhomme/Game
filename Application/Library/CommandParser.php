<?php
namespace App;
use Game;
class CommandParser extends Game\CommandParser
{
    protected $combinationRegistryClass = '\App\CombinationRegistry';
}