<?php
/**
 * Base view file
 */

namespace Core;

/**
 * Central Class View.
 * Provides function to render html files
 * @package Core
 */

class View {
	
	/**
	 * Render a view file
	 * @param string $view the path to view file
	 * @param array $args arguments passed to view
	 * @return void
	 */
	public static function render($view, $args=[])
	{
		extract($args,EXTR_SKIP);
		$file = "../App/Views/{$view}"; // relative to core directory
		if(is_readable($file)){
			require $file;
		}else{
			echo "{$file} not found!";
		}
	}
}