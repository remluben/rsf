<?php

/**
 * A command resolver determines and instantiates the requested command.
 *
 * @package interfaces
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
interface ICommandResolver
{
    /**
     * @param IRequest $request
     * @return ICommand
     */
    public function getCommand(IRequest $request);
}