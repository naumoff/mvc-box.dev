<?php
/**
 * administration file
 */

namespace App\Controllers\Admin;

/**
 * Class Users.
 * User admin controller
 * @package App\Controllers\Admin
 */

class Users extends \Core\Controller
{
	/**
	 * Before filter
	 * @return void
	 */
	protected function before()
	{
		// make sure the admin user is logged in
		// return false;
	}
	
	/**
	 * Show the index page
	 * @return void
	 */
	public function indexAction()
	{
		echo 'User admin index';
	}
}