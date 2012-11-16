<?php

/**
 * Logs user authentication information. Use with HttpAuthFilter 'onInvalidLogin'
 * event.
 *
 * @package demo.classes
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class AuthLoggingHandler implements IEventHandler
{
    private $_logFile;
    private $_registry;

    /**
     * @throws InvalidArgumentException
     *         for invalid logfile path
     * @param Registry $registry
     * @param string $logFile
     *        the path to the logfile
     */
    public function __construct(Registry $registry, $logFile)
    {
        if (!is_file($logFile)) {
            throw new InvalidArgumentException("Invalid log file path '$logFile'.");
        }
        $this->_registry = $registry;
        $this->_logFile = $logFile;
    }

    public function handle(Event $event)
    {
        $authData = $event->getInfo();

        $fields = array(
                    date('Y-m-d H:i:s'),
                    $this->_registry->getRequest()->getRemoteAddress(),
                    $event->getName(),
                    $authData['user'],
        );

        error_log(implode('|', $fields) . "\n", 3, $this->_logFile);
    }
}