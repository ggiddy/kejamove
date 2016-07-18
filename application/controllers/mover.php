<?php if(!defined('BASEPATH')) exit("Acess Denied");
/**
 *mover
 *
 *Define mover controller
 *
 *@author Collins Ryan(crryanlink@gmail.com)
 */

/**
 *Mover
 *
 *Mover dashboard management and access
 *
 *@uses Active/Active_Controller
 */
class Mover extends Active_Controller
{
	/**
	 *@var $models array, controller autoload models
	 */
	protected $models=array('users', 'requests');

	/**
	 *__construct
	 *
	 *Controller constructor and front-controller
	 *
	 *@access public
	 *@return $instance Setup, controller instance
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

	}

	/**
	 *newrequest
	 *Start new move request
	 *
	 *@access private
	 */
	public function home($id=null, $rid=null)
	{
		if(!$user=$this->users->get_user($id)) show_error('User not found');
		if(!$request=$this->requests->get_request($rid)) show_error('Request not found');

		$this->data['user']=$user;
	    $this->data['request']=$request;
	    $this->send_response($this->data, array('mover/page-home'));
	}

	/**
	 *index
	 *Default controller action, calls new request
	 *
	 *@access private
	 */
	public function index($id=null)
	{	
		$this->home($id);
	}
}