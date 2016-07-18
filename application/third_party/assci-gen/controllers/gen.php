<?php if(!defined('BASEPATH')) exit("Access Denied");
/**
 * ASS-CodeIgniter
 *
 * Internal Async Systems CodeIgniter Framework
 *
 * @package		ASS_CodeIgniter
 * @author		ASS Development Team
 * @copyright	Copyright (c) 2014, Async Systems, Inc.
 * @license		http://asyncsystems.co.ke/ass_codeigniter/licensing/
 * @link		http://asyncsystems.co.ke/ass_codeigniter/
 * @since		Version 1.0
 * @filesource
 *
 */
 
// ------------------------------------------------------------------------

/**
 * Generator Controller
 *
 * @package		ASS_CodeIgniter
 * @subpackage	Core
 * @category	Core
 * @author		ASS Development Team
 * @link     	http://asyncsystems.co.ke/ass_codeigniter/generator/
 */
class Gen extends JKP_Controller
{
	/**
	 * index
	 *
	 * Index Page of Generator Controller
	 *
	 *
	 * @access public
	 */
	public function index()
	{
		if($this->input->post('generate'))
		{
			//get model details
			$model_class  = $this->input->post('model_class'); //model class name
			$model_table  = $this->input->post('model_table'); //model table name
			$model_dir    = $this->input->post('model_dir'); //models directory
			$bmodel_prefx = $this->input->post('bmodel_prefix');//base model prefix
			
			//check if all requirements have been provided
			if(isset($model_class, $model_table, $model_dir))
			{
			     //check if the database table exists
				 if($this->db->table_exists($model_table))
				 {
				 	  //get the table fields
				 	  $table_fields = $this->db->list_fields($model_table);
				 	  
				 	  //model template data
				 	  $properties_array = 'array(';
				 	  $properties       = '';
				 	  
				 	  //create the model properties arrays and model properties template list
				 	  foreach($table_fields as $field)
				 	  {
				 	  	  $properties .='\t\t\tprotected $'.$field.';\r\n';
				 	  	  $properties_array .= '\t\t\t\t\''.$field.'\'=>'\'\',\r\n'
				 	  }
				 	  
				 	  //close the properties array
				 	  $properties_array .='\t\t\t);';
				 	  
				 	  
				 	  //read in the model template file
				 	  $template_file = APP_PATH.'third_party/assci-gen/views/model-template.txt';
				 	  
				 	  //check if the template file is readable
				 	  if(is_readable($template_file))
				 	  {
				 	  	 $model_template  = read_file($template_file);
				 		 $model_dir       = $model_dir ?: APP_PATH.'models/';
				 		 $model_path      = $model_dir.strtolower($model_class);
				 
				 		 
				 	  	 $model = str_replace('{class}', $properties, $model_template);
				 	  	 $model = str_replace('{class-prefix}', ($bmodel_prefix ?: 'CI_'), $model_template);
				 	  	 $model = str_replace('{properties}', $properties, $model_template);
				 	  	 $model = str_replace('{errors}', $properties_array, $model_template);
				 	  	 $model = str_replace('{relations}', $properties_array, $model_template);
				 	  	 if(write_file($model_path, $model))
				 	  	 {
				 	  	 	$this->data = array(
				 	  	 		'message'=>'Success. Model Generated successfully.<br/>Path=>'.$model_path,
				 	  	 		'type'=>'success'
				 	  	 	);
				 	  	 }
				 	  	 else
				 	  	 {	
				 	  	 	 $this->data = array(
				 	  	 	 	'message'=>'Error!. Error writing to model file.<br/>PATH=>'.$model_path,
				 	  	 	 	'type'=>'error'
				 	  	 	 );
				 	  	 }
					  }
					  else
					  {
					  	 $this->data = array(
					  	 	'message'=>'Error!. Model template file not found or is unreadable. <br/>
					  	 	 Check if template file exists or is readable by the server daemon<br/>
					  	 	PATH=>'.$template_file,
					  	 	'type'=>'error'
					  	 );
					  }
				 }
				 else
				 {
				 	$this->data = array(
				 		'message'=>'Error!. Model table doesn\'t exist',
				 		'type'=>'error'
				 	);
				 }
			}
			else
			{
				$this->data = array(
					'message'=>'Error!. Generating models requires atleast, model class name and table name',
					'type'=>'error'
				);
			}
		}
		
		$this->send_response($this->data, array(
			'generators'
		));
	}
	
	/**
	 * model
	 *
	 * Generates ASS model skeletons
	 *
	 * @access public
	 */
	public function model()
	{
	
	}
	
	/**
	 * controller
	 *
	 * Generates a controller skeleton
	 *
	 * @access public
	 */
	public function controller()
	{
	
	}
	
	/**
	 * package
	 *
	 * Generates a package skeleton
	 *
	 * @access public
	 */
	public function package()
	{
		
	}
	
	/**
	 * helper
	 *
	 * Generates a helper skeleton
	 *
	 * @access public
	 */
	public function helper()
	{
	
	}
	
	/**
	 * library
	 *
	 * Generates a library skeleton
	 *
	 * @access public
	 */
	public function library()
	{
	
	}
}
