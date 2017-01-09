<?php
/**
 * Posts Controller
 *
 */

namespace App\Controllers;

/**
 * Class Posts
 * @package App\Controllers
 */
class Posts {
	/**
	 * Show index page.
	 * @return void
	 */
	public function index()
	{
		echo 'Hello from index Action in the Post Controller!';
	}
	
	/**
	 * Show add new Post Page.
	 * @return void
	 */
	public function addNew()
	{
		echo "Hello from the addNew action in the Post controller!";
	}
}