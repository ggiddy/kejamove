<?php if(!defined('BASEPATH')) exit('Access Denied');
/**
 * Active Controller
 *
 *
 * @package		Active
 * @author		Collins Ryan Ochieng
 * @copyright	Copyright (c) 2014
 * @since		Version 1.0
 * @filesource
 *
 */
  
// ------------------------------------------------------------------------

/**
 * Generator Controller
 *
 * @package		Active)CodeIgniter
 * @subpackage	Core
 * @category	Core
 * @author		Collins Ryan Ochieng
 */
class Active_Controller extends CI_Controller 
{
	/**
	 * @var models, models to be loaded for this controller
	 */
	protected $models = array();
	
	/**
	 * @var data, associative array of template variables
	 */
	protected $data  = array();
	
	/**
	 * __construct
	 *
	 * Class constructor
	 *
	 * @access public
	 */
	public function __construct()
	{
		parent::__construct();
		
		// Added By Raph
		$models =array(
			'core_model' => 'core',
			'dashboard_model' => 'dashboard'
		);

		foreach ($models as $file => $object_name) 
		{
			$this->load->model($file,$object_name);
		}
	   
	    //load the controller models
	    foreach($this->models as $model)
	    {
	    	 $name  = strtolower($model);
	    	 $model = ucfirst($name).'_'.ucfirst('model');
	    	 $this->load->model($model, $name);
	    }

	   
	}

    /**
     *json_to_array
     *
     *Converts a json object to array 
     *
     *@access protected
     *@return $array array, json object as associative array
     */
	protected function json_to_array($json)
	{
		return (array) json_decode($json);
	}

    /**
     *get_content_mimetype
     *
     *Gets the current http request content mime type
     *
     *@access protected
     *@return $return string, http request content mime type
     */
    protected function get_content_mimetype()
    {
    	//get the http accept field from the server super global
    	$http_accept = explode(',', $_SERVER['HTTP_ACCEPT']);
    	//break it down to get the mime type
    	$http_accept = explode('/', $http_accept[0]);
    	//return the mime type
    	return ((is_array($http_accept) && count($http_accept) > 0) ? $http_accept[1] : null);
    }
	

    /**
     *is_ajax_request
     *
     *Checks whether the current request is a XhttpRequest
     *
     *@access protected
     *@return $return bool
     */
	protected function is_ajax_request() 
	{
		 //get the prefered response mime type
		 if($this->input->is_ajax_request() ||
		 			in_array($this->get_content_mimetype(), array('xml', 'json')))
		 {
		 	return true;
		 }

		 return false;
	}
	
	/**
	 * send_json
	 *
	 * Sends response as json data or jsonp
	 *
	 * @access public
	 */
	protected function send_json($data) 
	{ 
       $this->output->set_content_type('application/json')
    				->set_output(json_encode($data));
	}
	
	/**
	 * send_markup
	 *
	 * Sends response as some markup/template file
	 *
	 * @access public
	 */
	protected function send_markup($data, $templates = array()) 
	{
		if(is_array($templates))
		{
		   for($i =0; $l=count($templates), $i < $l; $i++) 
		   {
		   	   $this->load->view($templates[$i], $data);
		   }
		}
		else 
		{
			if(is_array($data))
			{
			     $this->send_json($data);
			}
		}
	}

	/**
	 * send_page
	 *
	 * Sends response as some markup/template file
	 *
	 * @access public
	 */
	protected function send_page($templates = array(), $data=array()) 
	{
		$this->send_markup($data, $templates);
	}
	
	/**
	 * send_response
	 * 
	 * Send the response back to the browser
	 *
	 * @param $data array, template data,
	 * @param $templates array, template files to load, LIFO
	 * @return none
	 */
	protected function send_response(array $data = array(), $templates = array()) 
	{
		 //get the prefered response mime type
		 switch(strtolower($this->get_content_mimetype()))
		 {
		 	 case 'json': $this->send_json($data); break;
		 	 case 'html': //fall through
		 	 case 'xml' : //fall through
		 	 default: $this->send_markup($data, $templates);break;
		 }
	}
}

// END ASS Controller Class

/* End of file ./Application/Core/Active_Controller.php */
/* Location: ./Application/Core/Active_Controller.php */
