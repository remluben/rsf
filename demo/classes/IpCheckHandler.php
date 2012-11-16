<?php

/**
 * Checks for blocked ip adresses. Use with HttpAuthFilter 'onLogin' event.
 *
 * @package demo.classes
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class IpCheckHandler implements IEventHandler
{
    private $_blockedIps;
    private $_registry;

    public function __construct(Registry $registry, array $blockedIps)
    {
        $this->_registry = $registry;
        $this->_blockedIps = $blockedIps;
    }

    public function handle(Event $event)
    {
        $ipAdress = $this->_registry->getRequest()->getRemoteAddress();
        if (in_array($ipAdress, $this->_blockedIps)) {
            $event->cancel();
        }
    }
}