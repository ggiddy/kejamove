<?php if(!defined('BASEPATH')) exit("Acess Denied");
/**
 *welcome
 *
 *Define welcome controller
 *
 *@author Collins Ryan(crryanlink@gmail.com)
 */

/**
 *Welcome
 *
 *Default controller
 *
 *@uses Active/Active_Controller
 */
class Welcome extends Active_Controller
{
	/**
	 *__construct
	 *
	 *Controller constructor and front-controller
	 *
	 *@access public
	 *@return $instance Welcome, controller instance
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *index
	 *Default controller action
	 *
	 *@access public
	 */
	public function index()
	{
		redirect(base_url('app'));
	}
}