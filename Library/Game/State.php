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
        if ($this->isStored()) {
            return unserialize($_SESSION[$this->sessionName]);
        }
        return false;
    }

    public function save($container)
    {
        $_SESSION[$this->sessionName] = serialize($container);
    }

    public function reset()
    {
        if ($this->isStored()) {
            unset($_SESSION[$this->sessionName]);
        }
    }

    protected function isStored()
    {
        return array_key_exists($this->sessionName, $_SESSION);
    }
}