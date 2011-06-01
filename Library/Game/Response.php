<?php
namespace Game;
class Response
{
    protected $messages = array();
    protected $separator = PHP_EOL;

    public function addMessage($message)
    {
        $this->messages[] = $message;
    }

    public function output()
    {
        ksort($this->messages);
        return implode($this->separator, $this->messages);
    }
}