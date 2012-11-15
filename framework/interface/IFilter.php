<?php

/**
 * A filter may changes request or response data.
 *
 * @package interfaces
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
interface IFilter
{
    public function execute(IRequest $request, IResponse $response);
}