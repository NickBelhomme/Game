<?php
namespace Game;
class Response
{
    /**
     * the actual response return value
     * @var array
     */
    protected $messages = array();

    /**
     * The response will be returned as a string
     * This separator will implode the messages together
     * @var string
     */
    protected $separator = PHP_EOL;

    /**
     * add a message to the response
     *
     * @param string $message
     * @return Game\Response
     */
    public function addMessage($message)
    {
        $this->messages[] = $message;
        return $this;
    }

    /**
     * return the response as a string
     *
     * @return string
     */
    public function output()
    {
        ksort($this->messages);
        return implode($this->separator, $this->messages);
    }
}