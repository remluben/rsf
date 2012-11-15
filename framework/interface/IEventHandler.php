<?php

/**
 * An event handler provides the IEventHandler::handle() method for handling
 * events.
 *
 * @package interfaces
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
interface IEventHandler
{
    public function handle(Event $event);
}