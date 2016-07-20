<?php	if(!defined('BASEPATH')) exit('Access Denied');
require_once 'request_model.php';
class Requests_model extends Request_model
{
	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}

	/**
	 *get_items
	 *Get request items
	 *
	 *@access  public
	 *@return $result array, associative array of request items
	 */
	public function get_items()
	{
		$items=explode(',', $this->items);
		$result=array();

		foreach($items as $i => $item)
		{
			$item=explode(':', $item);

			if(array_key_exists(0, $item)
				&& array_key_exists(1, $item)) 
				$result[$item[1]]=$item[0];
		}

		return $result;
	}

	/**
	 *remove
	 *Delete request item
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function remove()
	{
		parent::remove();
	}

	/**
	 *close_request
	 *Close request item
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function close_request()
	{
		parent::remove();
	}

	/**
	 *mark_in_progress
	 *Mark request as on going
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function mark_in_progress()
	{
		parent::remove();
	}

	/**
	 *mark_pending
	 *Mark request as unattended
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function mark_pending()
	{
		parent::remove();
	}

	/**
	 *mark_read
	 *Mark request item as seen
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function mark_read()
	{
		parent::remove();
	}

	/**
	 *mark_unread
	 *Mark request item as not yet seen
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function mark_unread()
	{
		parent::remove();
	}

	/**
	 *save_setting
	 *
	 *@access public
	 *@return $result bool, operation status
	 */
	public function save_info($settings, $user=null)
	{
		$this->load->model('requests_info_model', 'requests_info');

		if($user) $this->id = $user;

		return $this->requests_info->save_info($settings, $this->id);
	}

	/**
	 *save_setting
	 *
	 *@access public
	 *@return mixed, value of session variable
	 */
	public function get_info($info)
	{
		if(property_exists(get_class($this),$info))
		{
			return $this->$info;
		}
		else
		{
			$this->load->model('requests_info_model', 'requests_info');

			$setting = array_pop($this->requests_info->where(array(
				'requests'=>$this->id,
				'name'=>$info
			))->results());
		}

		if($setting) return $setting->value;
	}

	/**
	 *add_comment
	 *Add comment to request
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function add_comment()
	{
		parent::remove();
	}

	/**
	 *update_comment
	 *Update request comment
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function update_comment()
	{
		parent::remove();
	}

	/**
	 *remove_comment
	 *Remove request comment
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function remove_comment()
	{
		parent::remove();
	}

	/**
	 *add_note
	 *Add note to request
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function add_note()
	{
		parent::remove();
	}

	/**
	 *update_note
	 *Update request note
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function update_note()
	{
		parent::remove();
	}

	/**
	 *remove_note
	 *Remove request note
	 *
	 *@access  public
	 *@return $result array, result of action
	 */
	public function remove_note()
	{
		parent::remove();
	}

	/**
	 *add_request
	 *Add a new request item
	 *
	 *@access  public
	 *@param $request array, associative array defining request
	 *@return $result array, result of action
	 */
	public function add_request($request)
	{
		return (new Request_model(array_merge($request, array(
			'created'=>time()
		))))->save();
	}	

	/**
	 *edit_request
	 *Edit request item
	 *
	 *@access  public
	 *@param $request array, associative array defining request
	 *@return $result array, result of action
	 */
	public function edit_request($request)
	{
		return (new Request_model($request))->update();
	}

	/**
	 *get_requests
	 *Get request items that matches the params
	 *
	 *@access  public
	 *@param $request array, associative array defining request
	 *@return $result array, Array of Video_model items
	 */
	public function get_requests($params)
	{
		return $this->where($params)->results();
	}


	/**
	 *get_request
	 *Get first request item that matches the params
	 *
	 *@access  public
	 *@param $params mixed, associative array defining request
	 *@return $request Video_model, request item
	 */
	public function get_request($params)
	{
		if(is_numeric($params)) $params=array('id'=>$params);

		return array_pop($this->get_requests($params));
	}
}
