<?php

/**
 * Loads requested ICommand objects from the 'cmd' request parameter.
 *
 * @package classes
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class FileSystemCommandResolver implements ICommandResolver
{
    private $_path;
    private $_defaultCommand;

    /**
     * @param string $defaultCommand
     */
    public function __construct($path, $defaultCommand)
    {
        $this->_setPath($path);
        $this->_defaultCommand = $defaultCommand;
    }

    public function getCommand(IRequest $request)
    {
        if ($request->issetParameter('cmd')) {
            $cmdName = $request->getParameter('cmd');
            $command = $this->_loadCommand($cmdName);
            if ($command instanceof ICommand) {
                return $command;
            }
        }
        $command = $this->_loadCommand($this->_defaultCommand);
        return $command;
    }

    /**
     * @param string $path
     */
    protected function _setPath($path)
    {
        if (strrpos($path, '/') !== (strlen($path) - 1)) {
            $path .= '/';
        }
        $this->_path = $path;
    }

    /**
     * @param string $cmdName
     * @return ICommand | false
     */
    protected function _loadCommand($cmdName)
    {
        $cmdName .= 'Command';
        $cmdClassFile = $cmdName . '.php';
        if (!file_exists($this->_path . $cmdClassFile)) {
            return false;
        }

        require_once $this->_path . $cmdClassFile;

        if (!class_exists($cmdName)) {
            return false;
        }

        $command = new $cmdName();
        return $command;
    }

}