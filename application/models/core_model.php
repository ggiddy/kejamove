<?php defined ('BASEPATH') OR exit('Access Denied');

class Core_Model extends CI_model
{
	public $uid;
	public $admin;
	public $feedback;
	public $images_dir;
	public $temp_dir;

	public function __construct()
	{
		parent::__construct();
		
		$this->uid = $this->session_data('id');

		$this->images_dir = './images/';

		$this->temp_dir = './images/temp/';

		$this->feedback = array();

	}

	public function get($specs=array())
	{
		if(!empty($specs['order_field']) && !empty($specs['order']))
		{
			$this->db->order_by($specs['order_field'],$specs['order']);
		}

		if(!empty($specs['limit']) && isset($specs['offset']))
		{
			$this->db->limit($specs['limit'],$specs['offset']);
		}

		if(!empty($specs['filter_field']))
		{
			$this->db->where($specs['filter_field'],$specs['filter_value']);
		}

		if(!empty($specs['user_field']) && !empty($specs['user_id']) && !$this->admin)
		{
			$this->db->where($specs['user_field'], $specs['user_id']);
		}

		if(!empty($specs['distinct']) && $specs['distinct'])
		{
			$this->db->distinct();
		}

		return $this->db->get($specs['table'])->result();
	}

	public function add_one($specs=array())
	{
		$this->db->insert($specs['table'],$specs['data']);

		return $this->db->insert_id();
	}

	public function edit_one($specs=array())
	{
		return $this->db->update($specs['table'],$specs['data'],array($specs['field'] => $specs['var']));
	}

	public function remove_one($specs=array())
	{
		return $this->db->delete($specs['table'],array($specs['field'] => $specs['var']));
	}

	public function get_one($specs=array())
	{
		$this->db->order_by($specs['field'], 'desc');

		return array_pop($this->db->get_where($specs['table'],array($specs['field'] => $specs['var']))->result());
	}

	public function where($specs=array())
	{
		$conditions = $specs['conditions'];

		$this->db->where($conditions);

		$this->db->order_by('id','desc');

		$this->db->from($specs['table']);

		return $this->db->get()->result();
	}

	public function get_sum($specs=array())
	{
		$this->db->where($specs['filter_field'],$specs['filter_value']);

		$this->db->select_sum($specs['field']);

		return $this->db->get($specs['table'])->result();
	}

	public function set_log($var=null,$data)
	{
		$this->session->set_userdata($var,$data);
	}

	public function session_data($var=null)
	{
		if($this->session->userdata($var))
		{
			return $this->session->userdata($var);
		}
	}

	public function write($data)
	{
		switch (gettype($data)) {
			case 'array':
				var_dump($data);
				break;
			
			case 'object':
				var_dump($data);
				break;
			
			default:
				echo $data;
				break;
		}
	}

	public function file_upload($userfile,$dir=null,$watermark=null,$compare=null)
	{
		$dir = (empty($dir)) ? $this->temp_dir : $dir;

		$config = array(
			'upload_path' => $dir,
			'allowed_types' => 'gif|jpg|png|jpeg'
		);		
		
		$this->upload->initialize($config);

		ini_set('memory_limit', '128M');
		
		if ( ! $this->upload->do_upload())
		{
			$this->feedback = array(
				'file'	=> null,
				'message' => $this->upload->display_errors()
			);

		}
		else
		{
			$upload_data = $this->upload->data();

			$file = $upload_data['file_name'];

			$this->feedback = array(
				'file'=>$file,
				'message' => 'Uploaded successfully'
			);
			
			$dir = ($dir) ? $dir : null;

			$this->file_resize($file,$dir);

			if($watermark)
			{
				$this->file_watermark($file,$dir);
			}

			if($compare)
			{
				$message = $this->file_compare($file);
			}

			if(!empty($message))
			{
				$this->feedback = array(
					'file' => null,
					'message' => $message
				);
			} 

		}

		return $this->feedback;

	}

	public function file_resize($file,$dir=null)
	{
		$dir = (empty($dir)) ? $this->temp_dir : $dir;

		$config = array(
			'image_library' => 'gd2',
			'source_image' => $dir.$file,
			'new_image' => $dir.$file,
			'create_thumb' => false,
			'maintain_ratio' => true,
			'width' => 450,
			'height' => 500
			);	 

		$this->image_lib->initialize($config);

		ini_set('memory_limit', '128M');
		
		if(!$this->image_lib->resize()){

			return $this->image_lib->display_errors();

		}
		
	}

	public function file_watermark($file,$dir=null)
	{
		$dir = (empty($dir)) ? $this->temp_dir : $dir;

		$config = array(
			'image_library' => 'gd2',
			'source_image' => $dir.$file,
			'wm_type' => 'overlay',
			'wm_overlay_path' => './images/watermarks/soko-huru.png',
			'wm_opacity' => 50,
			'wm_hor_alignment' => 'right'
		);		

		$this->image_lib->initialize($config);
		 
		if(!$this->image_lib->watermark())
		{
			return $this->image_lib->display_errors();
		} 

	}

	public function file_compare($check_file,$dir_one=null,$dir_two=null)
	{
		$images = $this->get_filenames();

		$dir_one = (!isset($dir_one)) ? $this->images_dir : $dir_one;

		$dir_two = (!isset($dir_two)) ? $this->temp_dir : $dir_two;
		
		$message = null;

		foreach($images as $old)
		{
			if(hash_file('md5', $dir_two.$check_file) === hash_file('md5',$dir_one.$old))
			{
				$this->delete_file($check_file);

				return $message = 'Hey '.$this->session_data('name').', we found a similar photo in our store, upload a new one.';
			}
			
		}

		if(copy($dir_two.$check_file, $dir_one.$check_file))
		{
			$this->delete_file($check_file,$dir_two);
		}

		return $message;

	}

	public function get_filenames($dir=null)
	{
		$dir = (empty($dir)) ? $this->images_dir : $dir;

		$raw_files = scandir($dir);

		foreach($raw_files as $file)
		{
			if(in_array($file, array('.','..'))) continue;

			$files[] = $file;
		}

		return $files;
	}

	public function delete_file($file,$dir=null)
	{
		$dir = (empty($dir)) ? $this->temp_dir : $dir;

		if($file && is_file($dir.$file))
		{
			unlink($dir.$file);
		}
	}

	public function jencode($data=array())
	{
		return json_encode($data);
	}

	public function jdecode($jdata)
	{
		return json_decode($jdata,true);
	}

	public function rurl($string,$replacement)
	{
		$regex = "/[a-zA-Z]*[:\/\/]*[A-Za-z0-9\-_]+\.+[A-Za-z0-9\.\/%&=\?\-_]+/i";

		return preg_replace($regex, $replacement,$string);

	}

	public function clean_str($string) 
	{
	   $string = str_replace(' ', '', $string); 

	   return preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($string)); 
	}

	public function format_date($date,$format=null)
	{	
		$format = ($format) ? $format : "F j, Y H:i:s a";

		return date($format,strtotime($date));
	}

	public function add_days($specs)
	{
		$date = new DateTime($specs['currentdate']);

		$date->add(new DateInterval('P'.$specs['days'].'D'));

		return $date->format('Y-m-d H:i:s');
	}

	public function time_counter($date,$when=null)
	{
		$time = strtotime($date);

		if($when === 'ago')
		{
			$time = time() - $time;
		}
		else
		{
			$time = $time- time();
		}

		$tokens = array(
			31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
		);

		foreach($tokens as $unit => $text)
		{
			if($time < $unit) continue;

			$units = floor($time/$unit);

			$append = ($units>1) ? 's' : '';
			
			return $units . ' ' . $text . $append;
		}		
	}

	public function value_exists($specs = array())
	{
		$exists = $this->db->get_where($specs['table'], array($specs['field'] => $specs['value']))->result();

		($exists) ?  true : false;

		return $exists;
	}

	public function page_exists($dir,$file)
	{
		$dir = ($dir) ? $dir : './application/views/';

		if(is_file($dir.$file.'.php')): return true; else: return false; endif;
	}

	public function _404()
	{
		$this->load->view('static/404');
	}

	public function validate($specs=array())
	{
		switch ($specs['field']) 
		{
			case 'email':

				$test = (filter_var($specs['value'], FILTER_VALIDATE_EMAIL) === false) ? false : true;

				return $test;
				
				break;

			case 'numeric':
				$test = (is_numeric($specs['value'])) ? true : false;

				return $test;

				break;
			
			default:
				# code...
				break;
		}
	}

	public function required($data)
	{
		
	}

	public function sendmail($specs,$data=null)
	{		
		$this->email->from($specs['sender_mail'], $specs['sender_name']);
		$this->email->to($specs['recipient_mail']);
		$this->email->reply_to($specs['reply_to']);

		if(!empty($data))
		{
			$template = $data['template'];

			$data = ($data['data']) ? $data['data'] : null;

			$specs['message'] = $this->load->view($template,array('data' => $data),true);
		}
		
		$this->email->subject($specs['subject']);
		$this->email->message($specs['message']);
		
		$this->email->send();	
		
	}


	public function salthash($specs)
	{
		define('MAX_LENGTH',6);

		$tempsalt = md5(uniqid(rand(),true));
		
		$salt = ($specs['salt']) ? $specs['salt'] : substr($tempsalt, 0, MAX_LENGTH);

		return array('hash' => hash('sha256',$specs['1234'],$salt), 'salt' => $salt);
	}

	
	
}