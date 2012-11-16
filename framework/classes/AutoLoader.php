<?php

/**
 * This class can be used to register as a autoloader by using
 * spl_autoload_register. Use AutoLoader::addPath() to add paths, where class
 * files should be loaded from.
 *
 * Usage:
 *    $loader = new Autoloader();
 *    $loader->addPath('../path/to/classes');
 *    spl_autoload_register(array($loader, 'load'));
 *
 * @package classes
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class AutoLoader
{
    private $_paths = array();

    public function __construct(array $paths = array())
    {
        foreach($paths as $path) {
            $this->addPath($path);
        }
    }

    /**
     * @param string $path
     * @return AutoLoader
     */
    public function addPath($path) {
        $path = $this->_getPathWithTrailingSlash($path);
        if (!in_array($path, $this->_paths)) {
            $this->_paths[] = $path;
        }
        return $this;
    }

    /**
     * Loads the class file if available
     * @param string $className
     */
    public function load($className)
    {
        foreach ($this->_paths as $path) {
            $filePath = $path . $className . '.php';
            if (file_exists($filePath)) {
                include $filePath;
            }
        }
    }

    /**
     * @param string $path
     * @return string the path with trailing slash
     */
    private function _getPathWithTrailingSlash($path)
    {
        if (strrpos($path, '/') !== (strlen($path) - 1)) {
            $path .= '/';
        }
        return $path;
    }
}