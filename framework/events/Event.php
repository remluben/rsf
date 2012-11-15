<?php

/**
 * The Event event object defines the simplest version of event objects without
 * any typesafe methods.
 *
 * @package events
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class Event
{
    private $_name;
    private $_context;
    private $_info;
    private $_cancelled = false;

    /**
     * @param string $name
     * @param mixed $context
     * @param mixed $info
     */
    public function __construct($name, $context = null, $info = null)
    {
        $this->_name = $name;
        $this->_context = $context;
        $this->_info = $info;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->_context;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->_info;
    }

    /**
     * @return bool
     */
    public function isCancelled()
    {
        return $this->_cancelled;
    }

    /**
     * @return Event
     */
    public function cancel()
    {
        $this->_cancelled = true;
        return $this;
    }
}