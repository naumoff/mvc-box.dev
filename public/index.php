<?php
/**
 * Front Controller.
 * Front controller (public folder)
 * @filesource
 */

// require the controller class
require '../App/Controllers/Posts.php';

/**
 * Routing
 */
require '../Core/Router.php';

$router = new \Core\Router();

// add routes section $routerObject->addRoute($url,$params)
// precise patterns
$router->addRoute('', ['controller'=>'Home','action'=>'index']);

// route patters
$router->addRoute('{controller}/{action}');
$router->addRoute('{controller}/{action}/{id:\d+}');
$router->addRoute('admin/{controller}/{action}');

//setting the current $url
$url = $_SERVER['QUERY_STRING'];

$router->dispatch($url);

//if($router->matchURL($url)){
//	$router->getParams();
//	echo "<pre>";
//	echo "params found for current {$url}\n";
//	print_r($router->getParams());
//}else{
//	echo "No route found for {$url} request";
//}






// display routing table
//echo "<pre>";
//echo "\n*******************************\n";
//print_r($router->getRoutes());
//echo "</pre>";

//echo get_class($router);
//
//echo "<pre>";
//print_r($_SERVER);
//echo "</pre>";