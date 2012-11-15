<?php

/**
 * A simple registry object
 *
 * @package classes
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class Registry
{
    const KEY_CONFIG = 'config';
    const KEY_REQUEST = 'request';
    const KEY_RESPONSE = 'response';

    private $_values = array();

    public function get($key)
    {
        if (isset($this->_values[$key])) {
            return $this->_values[$key];
        }
        return null;
    }

    public function set($key, $value)
    {
        $this->_values[$key] = $value;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
       return $this->get(self::KEY_CONFIG);
    }

    /**
     * @return IRequest
     */
    public function getRequest()
    {
        return $this->get(self::KEY_REQUEST);
    }

    /**
     * @return IResponse
     */
    public function getResponse()
    {
        return $this->get(self::KEY_RESPONSE);
    }

    public function setConfig(Config $config)
    {
        return $this->set(self::KEY_CONFIG, $config);
    }

    public function setRequest(IRequest $request)
    {
        $this->set(self::KEY_REQUEST, $request);
    }

    public function setResponse(IResponse $response)
    {
        return $this->set(self::KEY_RESPONSE, $response);
    }
}