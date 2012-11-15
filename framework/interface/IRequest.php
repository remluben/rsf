<?php

/**
 * The interface for request objects
 *
 * @package interfaces
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
interface IRequest
{
    /**
     * @param sting $name
     * @return mixed
     */
    public function getParameter($name);

    /**
     * @return array
     *         the array of available parameters
     */
    public function getParameterNames();

    /**
     * @param string $name
     * @return bool
     */
    public function issetParameter($name);

    /**
     * @param string $name
     */
    public function getHeader($name);

    /**
     * @return mixed
     */
    public function getAuthData();

    /**
     * @return string
     */
    public function getRemoteAddress();
}