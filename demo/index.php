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

require_once 'bootstrap.php';

// if running on a local lampp, set IP adress to 127.0.0.1 in order to block
// yourself
$ipCheckHandler = new IpCheckHandler($registry, array('127.0.0.2'));
$authLoggingHandler = new AuthLoggingHandler($registry,
                                             __APP_PATH . 'logs/auth.log');

$dispatcher = $registry->get('EventDispatcher');
$dispatcher->addHandler('onLogin', $ipCheckHandler);
$dispatcher->addHandler('onInvalidLogin', $authLoggingHandler);

$resolver = new FileSystemCommandResolver(__APP_PATH . 'commands', 'Default');

$controller = new FrontController($resolver);
$controller->addPreFilter(new HttpAuthFilter($registry, array('user' => 'password')));
$controller->handleRequest($registry->getRequest(), $registry->getResponse());