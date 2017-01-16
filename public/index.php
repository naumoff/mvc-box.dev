<?php
/**
 * Front Controller.
 * Front controller (public folder)
 * @filesource
 */

/**
 * Autoloader.
 * Function that autoloads files that contains requested Class names
 * @param string $class class name
 * @return void
 */
spl_autoload_register(function($class){
	$root = dirname(__DIR__);
	$file = $root.'/'.str_replace('\\', '/', $class).'.php';
	if(is_readable($file)){
		require $file;
	}
});

$router = new Core\Router();

// add routes section $routerObject->addRoute($url,$params)
// precise patterns
$router->addRoute('', ['controller'=>'Home','action'=>'index']);

// web route patters
$router->addRoute('{controller}/{action}');
$router->addRoute('{controller}/{id:\d+}/{action}');

// admin route patterns
$router->addRoute('admin/{controller}/{action}',['namespace'=>'Admin']);

//setting the current $url
$url = $_SERVER['QUERY_STRING'];

$router->dispatch($url);

