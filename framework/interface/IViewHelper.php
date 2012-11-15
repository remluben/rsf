<?php

/**
 * View helper interface
 *
 * @package interfaces
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
interface IViewHelper
{
    /**
     * @param array $args [optional]
     */
    public function execute($args = array());
}