<?php

/**
 * Template views provide a method for adding variables to template and allow
 * parsing a template with this variables.
 *
 * @package interfaces
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
interface ITemplateView
{
    /**
     * Assigns a value and template variable of specified name
     * @param string $name
     * @param mixed $value
     * @return ITemplateView
     */
    public function assign($name, $value);

    /**
     * @return string the parsed view
     */
    public function parse();
}