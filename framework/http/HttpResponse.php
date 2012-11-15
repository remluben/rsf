<?php

/**
 * The HTTP response object.
 *
 * @package http
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class HttpResponse implements IResponse
{
    private $_status = '200 OK';
    private $_headers = array();
    private $_body;

    public function setStatus($status)
    {
        $this->_status = $status;
        return $this;
    }

    public function addHeader($name, $value)
    {
        $this->_headers[$name] = $value;
        return $this;
    }

    public function write($data)
    {
        $this->_body .= $data;
        return $this;
    }

    public function flush()
    {
        header("HTTP/1.0 {$this->_status}");
        foreach($this->_headers as $name => $value) {
            header("{$name}: {$value}");
        }
        print $this->_body;
        $this->_headers = array();
        $this->_body = null;
        return $this;
    }

    public function getBody()
    {
        return $this->_body;
    }

    public function setBody($body)
    {
        $this->_body = $body;
        return $this;
    }
}