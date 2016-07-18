<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Request_model extends Active_Model
{
	public $users;
	public $moving_from;
	public $moving_to;
	public $items;
	public $phone;
	public $created;
	protected $model_table = 'moverequests';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'users'=>array(),
			'moving_from'=>array(),
			'moving_to'=>array(),
			'items'=>array(),
			'phone'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'users'=>array(),
			'moving_from'=>array(),
			'moving_to'=>array(),
			'items'=>array(),
			'phone'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'users'=>array(),
			'moving_from'=>array(),
			'moving_to'=>array(),
			'items'=>array(),
			'phone'=>array(),
			'created'=>array(),
		);
	}
}
