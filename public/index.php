<?php
/**
 * Front controller
 *
 * PHP version 7.4
 */

require dirname( __DIR__ ) . '/vendor/autoload.php';

$router = new Core\Router();
//Add the routers
$router->add( '', ['controller' => 'Home', 'action' => 'index'] );
$router->add( '{controller}' );
$router->add( '{controller}/{action}' );
$router->add( '{controller}/{id:\d+}/{action}' );

// Match the requested router
$requestedUrl = trim( $_SERVER['REQUEST_URI'], '/' );
$router->dispatch( $requestedUrl );