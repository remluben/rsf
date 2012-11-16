<?php

/**
 * This view helper generates html output
 *
 * @package demo.helpers
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class EscapeViewHelper implements IViewHelper
{
    public function execute($args = array())
    {
        return htmlspecialchars($args[0]);
    }
}