<?php

/**
 * Objects of this class execute multiple filters added to the chain.
 *
 * @package classes
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class FilterChain implements IFilter
{
    private $_filters = array();

    public function addFilter(IFilter $filter)
    {
        $this->_filters[] = $filter;
    }

    public function execute(IRequest $request, IResponse $response)
    {
        foreach ($this->_filters as $filter) {
            $filter->execute($request, $response);
        }
    }
}