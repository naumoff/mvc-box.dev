<?php
/**
 * Central Router Class for MVC framework.
 */

namespace Core;

/**
 * Class Router
 * @package Core
 */

class Router {
	
	/**
	 * @var array $routes Assotiative array of routes
	 */
	protected $routes = [];
	
	/**
	 * @var array $params Parameters from matched route.
	 */
	protected $params = [];
	
	/**
	 * function that created regEx pattern for routing table.
	 * @param string $route The Route URL
	 * @param array $params Parameters (controllers, actions, etc)
	 * @return void
	 */
	public function addRoute($route,$params = [])
	{
		//transform $route to RegExp pattern
		//replace '/' to '\/' in '{controller}/{action}/{id:\d+}'
		$pattern = '/\//';
		$replacement = '\\/';
		$route = preg_replace($pattern, $replacement, $route);
		
		// transform to (?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)\/{id:\d+}
		$pattern = '/\{([a-z-]+)\}/';
		$replacement = '(?P<\1>[a-z-]+)';
		$route = preg_replace($pattern, $replacement, $route);
		
		// transform to (?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)\/(?P<id>\d+)
		$pattern = '/\{([a-z-]+):([^\}]+)\}/';
		$replacement = '(?P<\1>\2)';
		$route = preg_replace($pattern, $replacement, $route);
		
		$route = '/^' .$route. '$/i';
		
		$this->routes[$route]=$params;
	}
	
	/**
	 * Get all routes from routing table
	 * @return array
	 */
	public function getRoutes()
	{
		return $this->routes;
	}
	
	/**
	 * Match the url to the routes in the routing table, setting the $params
	 * property if a url is found in routing table
	 * @param  string $url The route URL
	 * @return bool TRUE if match found OR FALSE otherwise
	 */
	public function matchURL($url)
	{
		foreach ($this->routes AS $route=>$params){
			if(preg_match($route, $url, $matches)){
				foreach ($matches as $key=>$match) {
					if(is_string($key)){
						$params[$key]=$match;
					}
				}
				$this->params = $params;
				return TRUE;
			}
		}
		return FALSE;
	}
	
	/**
	 * method 'dispatch' creates controller object and call for controller object's method
	 *
	 * method dispatch take url and convert it to class name and its method name, then
	 * creates object based on class name and call its method from created object
	 * @param string $url web path
	 * @return void
	 */
	public function dispatch($url)
	{
		if($this->matchURL($url)){
			$controller = $this->params['controller'];
			$controller = $this->convertToStudlyCaps($controller);
			$controller = '\\App\\Controllers\\'.$controller;
			
			if(class_exists($controller)){
				$controllerObject = new $controller();
				$action = $this->params['action'];
				$action = $this->convertToCamelCase($action);
				if(is_callable([$controllerObject,$action])){
					$controllerObject->$action();
				}else{
					echo "Method {$action} in Controller {$controller} not found!";
				}
			}else{
				echo "Controller class {$controller} not found!";
			}
		}else{
			echo 'No route matched!';
		}
	}
	
	/**
	 * function converts camel-case to CamelCase.
	 * used to convert url path to Controller Class name
	 * @param string $string
	 * @return string returns Controller Class Name
	 *
	 */
	protected function convertToStudlyCaps($string)
	{
		$string = str_replace('-', ' ', $string);
		$string = ucwords($string);
		$string = str_replace(' ', '', $string);
		return $string;
	}
	
	/**
	 * function converts camel-case to camelCale.
	 * used to convert url path to Controler Action name (methods)
	 * @param $string
	 * @return string returns Controller Action (method) name
	 */
	protected function convertToCamelCase($string)
	{
		$string = $this->convertToStudlyCaps($string);
		$string = lcfirst($string);
		return $string;
	}
	
	/**
	 * Get the currently matched parameters (controller,action)
	 * @return array $params
	 */
	public function getParams()
	{
		return $this->params;
	}
}