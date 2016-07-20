<?php defined ('BASEPATH') or exit('Access Denied!');

class Core_Controller extends CI_Controller
{
	public $uid;

	public $admin;

	public $users;

	public $core;

	public $facebook;

	public $twitter;

	public $messages;

	public $artist;

	public $events;

	public $subscriptions;


	public function __construct()
	{
		parent::__construct();

		$models =array(
			'users_model' => 'users',
			'request_model' => 'request'
		);

		foreach ($models as $file => $object_name) 
		{
			$this->load->model($file,$object_name);
		}

		if($this->users->log('uid'))
		{
			$this->uid = $this->users->log('uid');

			$this->admin = ($this->users->log('admin')) ? true : false;
		}				

		$this->core = new Core_Model();


	}
	

}