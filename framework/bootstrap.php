<?php

/*******************************************************************************
 *
 * Application default bootstrap file
 *
 * Usage:
 * - Copy this file to your application folder
 * - Replace all occurences of  {app} with your application's directory name
 *   i.e. demo
 * - Include this file on top of your application's index.php file
 * - Add your application's class file paths to the autoloader by using
 *   $registry->get('AutoLoader')->addPath('{your_path}');
 *
 * When bootstrapping your application, after this file has been included, the
 * following objects and variables are available:
 * - constants:
 *   > __ROOT_PATH - the root path
 *   > __APP_PATH - the application path
 *   > __FW_PATH - the framework path
 * - $registry - the Registry
 * - $registry->getRequest() - the HttpRequest
 * - $registry->getResponse() - the HttpResponse
 * - $registry->get('EventDispatcher') - the EventDispatcher
 * - $registry->get('AutoLoader') - the AutoLoader
 *
 * @package {app}
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 *
******************************************************************************/

$appName = '{app}';

define('__ROOT_PATH', dirname(dirname(realpath(__FILE__))) . '/');
define('__APP_PATH', __ROOT_PATH . $appName . '/');
define('__FW_PATH', __ROOT_PATH . 'framework/');

require_once __FW_PATH . 'classes/AutoLoader.php';

$loader = new AutoLoader(array(
        __FW_PATH . 'classes/',
        __FW_PATH . 'events/',
        __FW_PATH . 'http/',
        __FW_PATH . 'interface/',
));

spl_autoload_register(array($loader, 'load'));

$dispatcher = EventDispatcher::getInstance();
$request = new HttpRequest();
$response = new HttpResponse();
$registry = Registry::getInstance();
$registry->setRequest($request);
$registry->setResponse($response);
$registry->set('EventDispatcher', $dispatcher);
$registry->set('AutoLoader', $loader);
