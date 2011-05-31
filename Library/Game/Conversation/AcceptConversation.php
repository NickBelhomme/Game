<?php
namespace Game\Conversation;
use Game\Conversation;
interface AcceptConversation
{
    /**
     * Set a conversation to the item
     * @param Game\Conversation $conversation
     * @return Game\Tile
     */
    public function setConversation(Conversation $conversation);

    /**
     * Gets the stored conversation
     *
     * @return Game\Conversation
     */
    public function getConversation();
}