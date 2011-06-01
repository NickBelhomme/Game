<?php
namespace Game;
class Request
{
    /**
     * the user his command to the game
     * @var string
     */
    protected $cmd;

    /**
     * Setter for the command
     *
     * @param string $cmd
     * @return \Game\Request
     */
    public function setCmd($cmd)
    {
        if (!is_string($cmd)) {
            throw new Exception\InvalidArgumentException('cmd should be a string');
        }
        $this->cmd = trim($cmd);
        return $this;
    }

    /**
     * getter for the command
     *
     * @return string
     */
    public function getCmd()
    {
        return $this->cmd;
    }
}