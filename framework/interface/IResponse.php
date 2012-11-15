<?php

/**
 * The interface for response objects
 *
 * @package interfaces
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
interface IResponse
{
    /**
     * @param string $name
     * @param string $value
     * @return IResponse
     */
    public function addHeader($name, $value);

    /**
     * @see IHttpStatus
     * @param string $status
     * @return IRepsonse
     */
    public function setStatus($status);

    /**
     * Writes data to response body
     * @param string $data
     * @return IRepsonse
     */
    public function write($data);

    /**
     * Sends response
     * @return IRepsonse
     */
    public function flush();

    /**
     * @return string
     */
    public function getBody();

    /**
     * @param string $body
     * @return IRepsonse
     */
    public function setBody($body);
}