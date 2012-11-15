<?php

/**
 * Provides a central access point for registering event handlers and triggering
 * events.
 *
 * @package events
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class EventDispatcher
{
    private static $_instance;

    private $_handlers = array();

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new EventDispatcher();
        }
        return self::$_instance;
    }

    protected function __construct() {}

    protected function __clone() {}

    /**
     * @param string $eventName
     * @param IEventHandler $handler
     * @return EventDispatcher
     */
    public function addHandler($eventName, IEventHandler $handler)
    {
        if (!isset($this->_handlers[$eventName])) {
            $this->_handlers[$eventName] = array();
        }
        $this->_handlers[$eventName][] = $handler;

        return $this;
    }

    /**
     * @param string | Event $event
     * @param mixed $context
     * @param mixed $info
     * @return Event
     */
    public function triggerEvent($event, $context = null, $info = null)
    {
        if (!$event instanceof Event) {
            $event = new Event($event, $context, $info);
        }

        $eventName = $event->getName();
        if (isset($this->_handlers[$eventName])) {
            foreach ($this->_handlers[$eventName] as $handler) {
                $handler->handle($event);
                if ($event->isCancelled()) {
                    break;
                }
            }
        }

        return $event;
    }
}