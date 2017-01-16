<?php
/**
 * Posts Controller
 */

namespace App\Controllers;

/**
 * Class Posts
 * @package App\Controllers
 */
class Posts extends \Core\Controller
{
	/**
	 * Show index page.
	 * @return void
	 */
	public function indexAction()
	{
		echo 'Hello from index Action in the Post Controller!';
	}
	
	/**
	 * Show add new Post Page.
	 * @return void
	 */
	public function addNewAction()
	{
		echo "Hello from the addNew action in the Post controller!";
	}
	
	/**
	 * Show the edit page.
	 * @return void
	 */
	public function editAction()
	{
		echo '<pre>';
		echo "Hello from edit action in the Post Controller\n";
		echo "Route parameters:\n";
		echo htmlspecialchars(print_r($this->route_params));
	}
}