<?php	if(!defined('BASEPATH')) exit('Access Denied');
class Info_model extends Active_model
{
	protected $item_name='item_name';

	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}

	public function save_info_item($item_id, $name, $value=null)
	{
		$record=array(
			'name'=>$name,
			'value'=>$value,
			'created'=>time()
		);

		$record[$this->item_name]=$item_id;

		return $this->add_one($record);
	}

	public function save_info(array $settings, $user)
	{	
		foreach ($settings as $name => $value)
		{
			$result = $this->save_info_item($user, $name, $value);
		}

		return $result;
	}

	public function get_name()
	{
		return $this->name;
	}

	public function get_value()
	{
		return $this->value;
	}

	public function get_created()
	{
		return $this->created;
	}
}
