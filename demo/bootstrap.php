<?php

/*******************************************************************************
 *
 * Application default bootstrap file
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
 * @package demo
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 *
******************************************************************************/

$appName = 'demo';

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
