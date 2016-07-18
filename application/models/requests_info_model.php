<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'info_model.php';
class Requests_info_model extends Info_Model
{
	public $requests;
	public $name;
	public $value;
	public $created;
	protected $item_name='requests';
	protected $model_table = 'requests_info';
	public function __construct(array $data = array())
	{
		parent::__construct($data);
		$this->errors = array(
			'requests'=>array(),
			'name'=>array(),
			'value'=>array(),
			'created'=>array(),
		);
	}

	public function relations()
	{
		return array(
			'requests'=>array(),
			'name'=>array(),
			'value'=>array(),
			'created'=>array(),
		);
	}
	
	public function rules()
	{
		return array(
			'requests'=>array(),
			'name'=>array(),
			'value'=>array(),
			'created'=>array(),
		);
	}
}
