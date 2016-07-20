<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'info_model.php';
class Users_info_model extends Info_Model
{
	public $users;
	public $name;
	public $value;
	public $created;
	protected $model_table = 'users_info';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'users'=>array(),
			'name'=>array(),
			'value'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'users'=>array(),
			'name'=>array(),
			'value'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'users'=>array(),
			'name'=>array(),
			'value'=>array(),
			'created'=>array(),
		);
	}
}
