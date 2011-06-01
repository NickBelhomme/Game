<?php
namespace Game;
class State
{
    /**
     * This state manager uses session, and this is the
     * session its index
     * @var string
     */
    protected $sessionName = 'savedGame';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * Will load the stored state if available
     *
     * @return Game\Container
     */
    public function load()
    {
        if ($this->isStored()) {
            return unserialize($_SESSION[$this->sessionName]);
        }
        return false;
    }

    /**
     * Will store the container so it has state
     * @param $container
     *
     * @return Game\State
     */
    public function save($container)
    {
        $_SESSION[$this->sessionName] = serialize($container);
        return $this;
    }

    /**
     * Will reset the current state
     *
     * @return Game\State
     */
    public function reset()
    {
        if ($this->isStored()) {
            unset($_SESSION[$this->sessionName]);
        }
        return $this;
    }

    /**
     * Will check whether the container has a state
     *
     * @return boolean
     */
    protected function isStored()
    {
        return array_key_exists($this->sessionName, $_SESSION);
    }
}