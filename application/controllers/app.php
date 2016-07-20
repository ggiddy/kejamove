<?php if(!defined('BASEPATH')) exit("Acess Denied");
/**
 *app
 *
 *Define app controller
 *
 *@author Collins Ryan(crryanlink@gmail.com)
 */

/**
 *App
 *
 *Default Application controller
 *
 *@uses Active/Active_Controller
 */
class App extends Active_Controller
{
	/**
	 *@var $models array, controller autoload models
	 */
	protected $models=array('users');

	/**
	 *__construct
	 *
	 *Controller constructor and front-controller
	 *
	 *@access public
	 *@return $instance App, controller instance
	 */
	public function __construct()
	{
		parent::__construct();
		$this->pre_action();
	}

	/**
	 *pre_action
	 *Called before any controller action is accessed,
	 *performs access control among other things
	 *
	 *@access private
	 */
	private function pre_action()
	{
		if($this->users->current_user('is_signed_in'))
		{
			redirect($this->users->current_user('home_url'));
		}
	}

	/**
	 *start
	 *App start page
	 *
	 *@access private
	 */
	public function start()
	{
		$this->send_page(array('app/page-start'));
	}

	/**
	 *howitworks
	 *App how it works page
	 *
	 *@access private
	 */
	public function howitworks()
	{
		$this->send_page(array('app/page-how-it-works'));
	}

	/**
	 *index
	 *Default controller action, calls start
	 *
	 *@access private
	 */
	public function index()
	{
		$this->start();
	}
}