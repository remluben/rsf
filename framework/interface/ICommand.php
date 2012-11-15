<?php

/**
 * A command defines the smallest unit of work and provides only one method,
 * that is used for execution: ICommand::execute()
 *
 * @package interfaces
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
interface ICommand
{
    /**
     * @param IRequest $request
     * @param IResponse $response
     */
    public function execute(IRequest $request, IResponse $response);
}