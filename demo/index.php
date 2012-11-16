<?php

/*******************************************************************************
 *
 * DEMO application
 *
 * @package demo
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 *
 * - Access with
 *       user: user
 *       password: password
 * - Ensure, that demo/logs/auth.log is writeable by your webserver
 *
 ******************************************************************************/

// Define important paths as global constants

define('__ROOT_PATH', '../');
define('__APP_PATH', __ROOT_PATH . 'demo/');
define('__FF_PATH', __ROOT_PATH . 'framework/');

// setup autoloader ( for demo application as well as the framework classes )

require_once __FF_PATH . 'classes/AutoLoader.php';

$loader = new AutoLoader();
$loader->addPath(__FF_PATH . 'classes/')
       ->addPath(__FF_PATH . 'events/')
       ->addPath(__FF_PATH . 'http/')
       ->addPath(__FF_PATH . 'interface/')
       ->addPath(__APP_PATH . 'classes/')
       ->addPath(__APP_PATH . 'commands/')
       ->addPath(__APP_PATH . 'filters/')
       ->addPath(__APP_PATH . 'helpers/');

spl_autoload_register(array($loader, 'load'));

// create request, response and registry objects
// register event handlers
// add the authentication filter
// let the FrontController do its work

$dispatcher = EventDispatcher::getInstance();
$request = new HttpRequest();
$response = new HttpResponse();
$registry = new Registry();
$registry->setRequest($request);
$registry->setResponse($response);
$registry->set('EventDispatcher', $dispatcher);

// if running on a local lampp, set IP adress to 127.0.0.1 in order to block
// yourself
$ipCheckHandler = new IpCheckHandler($registry, array('127.0.0.2'));
$authLoggingHandler = new AuthLoggingHandler($registry,
                                             __APP_PATH . 'logs/auth.log');

$dispatcher->addHandler('onLogin', $ipCheckHandler);
$dispatcher->addHandler('onInvalidLogin', $authLoggingHandler);

$resolver = new FileSystemCommandResolver(__APP_PATH . 'commands', 'Default');

$controller = new FrontController($resolver);
$controller->addPreFilter(new HttpAuthFilter($registry, array('user' => 'password')));
$controller->handleRequest($request, $response);