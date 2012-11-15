<?php

/**
 * The HTTP request object.
 *
 * @package http
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class HttpRequest implements IRequest
{
    private $_parameters;

    public function __construct()
    {
        $this->_parameters = $_REQUEST;
    }

    public function issetParameter($name)
    {
        return isset($this->_parameters[$name]);
    }

    public function getParameter($name)
    {
        $value = null;
        if ($this->issetParameter($name)) {
            $value = $this->_parameters[$name];
        }
        return $value;
    }

    public function getParameterNames()
    {
        return array_keys($this->_parameters);
    }

    public function getHeader($name)
    {
        $value = null;
        $name = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        if (isset($_SERVER[$name])) {
            $value = $_SERVER[$name];
        }
        return $value;
    }

    public function getAuthData()
    {
        if(!isset($_SERVER['PHP_AUTH_USER'])) {
            return null;
        }
        return array('user'     => $_SERVER['PHP_AUTH_USER'],
                     'password' => $_SERVER['PHP_AUTH_PW']);
    }

    public function getRemoteAddress()
    {
        return $_SERVER['REMOTE_ADDR'];
    }
}