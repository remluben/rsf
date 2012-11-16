<?php

/*******************************************************************************
 *
 * Application default bootstrap file
 *
 * TODO:
 * Replace all occurences of {app} by your application's directory name.
 *
 * When bootstrapping your application, after this file has been included, the
 * following objects and variables are available:
 * - constants:
 *   > __ROOT_PATH
 *   > __APP_PATH
 *   > __FW_PATH
 * - $registry - the Registry
 * - $registry->getRequest() - the HttpRequest
 * - $registry->getResponse() - the HttpResponse
 * - $registry->get('EventDispatcher') - the EventDispatcher
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
        __APP_PATH . 'classes/',
        __APP_PATH . 'commands/',
        __APP_PATH . 'filters/',
        __APP_PATH . 'helpers/',
));

spl_autoload_register(array($loader, 'load'));

$dispatcher = EventDispatcher::getInstance();
$request = new HttpRequest();
$response = new HttpResponse();
$registry = new Registry();
$registry->setRequest($request);
$registry->setResponse($response);
$registry->set('EventDispatcher', $dispatcher);