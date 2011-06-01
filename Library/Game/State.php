<?php
namespace Game;
class State
{
    protected $sessionName = 'savedGame';

    public function __construct()
    {
        session_start();
    }

    public function load()
    {
        if (! array_key_exists($this->sessionName, $_SESSION)) {
            return false;
        } else {
            return unserialize($_SESSION[$this->sessionName]);
        }
    }

    public function save($container)
    {
        $_SESSION['savedGame'] = serialize($container);
    }
}