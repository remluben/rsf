<?php

/**
 * Simple front controller for handling requests, by executing the commands
 * retrieved from ICommandResolver object. Pre- and postfilters available.
 *
 * @package classes
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class FrontController
{
    private $_resolver;
    private $_preFilters;
    private $_postFilters;

    public function __construct(ICommandResolver $resolver)
    {
        $this->_resolver = $resolver;
        $this->_preFilters = new FilterChain();
        $this->_postFilters = new FilterChain();
    }

    public function handleRequest(IRequest $request, IResponse $response)
    {
        $this->_preFilters->execute($request, $response);
        $command = $this->_resolver->getCommand($request);
        $command->execute($request, $response);
        $this->_postFilters->execute($request, $response);

        $response->flush();
    }

    /**
     * @param IFilter $filter
     * @return FrontController
     */
    public function addPreFilter(IFilter $filter)
    {
        $this->_preFilters->addFilter($filter);
        return $this;
    }

    /**
     * @param IFilter $filter
     * @return FrontController
     */
    public function addPostFilter(IFilter $filter)
    {
        $this->_postFilters->addFilter($filter);
        return $this;
    }
}