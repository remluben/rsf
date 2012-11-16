<?php

/**
 * This view helper creates uppercase strings.
 *
 * @package demo.helpers
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class UpperCaseViewHelper implements IViewHelper
{
    public function execute($args = array())
    {
        return strtoupper($args[0]);
    }
}