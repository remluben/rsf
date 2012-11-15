<?php

/**
 * HTML template view object, with view helper functions.
 *
 * From within the loaded template all assigned variables are available as
 * $this->varname and available view helpers can be used by calling
 * $this->myfunc ( myfunc refers to the view helper object of type
 * MyFuncViewHelper )
 *
 * @package classes
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class HtmlTemplateView implements ITemplateView
{
    private $_helpers = array();
    private $_template;
    private $_vars = array();

    /**
     * @param string $template
     *        the path to template
     */
    public function __construct($template)
    {
        $this->_template = $template;
    }

    /**
     * This method is called automatically, whenever someone is trying to access
     * a method not available.
     *
     * It allows accessing view helpers, by calling them as 'methods', i.e.:
     * > $this->escape(array('my_value')) // executes the EscapeViewHelper
     * > $this->uppercase(array('my_value')) // executes the UppercaseViewHelper
     *
     * @param string $methodName
     *        the method called
     * @param array $args
     *        the method arguments
     * @return string
     */
    public function __call($methodName, $args)
    {
        $helper = $this->_loadViewHelper($methodName);
        if ($helper === null) {
            $value = "Invalid view helper '$methodName'";
        }
        else {
            $value = $helper->execute($args);
        }

        return $value;
    }

    /**
     * This method is called automatically, whenever someone is trying to access
     * public variables.
     *
     * It allows accessing the template variables from HtmlTemplateView::_vars
     * as public member variables.
     *
     * @param string $property
     * @return mixed | null
     */
    public function __get($property)
    {
        if (isset($this->_vars[$property])) {
            return $this->_vars[$property];
        }
        return null;
    }

    public function assign($name, $value)
    {
        $this->_vars[$name] = $value;
        return $this;
    }

    public function parse()
    {
        ob_start();
        include_once $this->_template;
        $data = ob_get_clean();
        return $data;
    }

    /**
     * @param string $helper
     *        the view helper's name
     * @return IViewHelper | null
     */
    protected function _loadViewHelper($helper)
    {
        $helperName = ucfirst($helper);
        if (!isset($this->_helpers[$helper])) {
            $className = $helperName . 'ViewHelper';
            if (!class_exists($className)) {
                return null;
            }
            $this->_helpers[$helper] = new $className();
        }
        return $this->_helpers[$helper];
    }
}