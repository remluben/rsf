<?php

/**
 * Decorates objects of type IFilter with additional functionality. When
 * extending this class the method FilterDecorator::doExecute() has to be
 * implemented and allows custom operations after the wrapped filter was
 * executed.
 *
 * @package classes
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
abstract class FilterDecorator implements IFilter
{
    private $_filter;

    public function __construct(IFilter $filter)
    {
        $this->_filter = $filter;
    }

    public final function execute(IRequest $request, IResponse $response)
    {
        $this->_filter->execute($request, $response);
        $this->doExecute($request, $response);
    }

    abstract public function doExecute(IRequest $request, IResponse $response);
}