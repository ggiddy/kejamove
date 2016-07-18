<?php if(!defined('BASEPATH')) exit("Access Denied");
/**
 * Ptolem-CodeIgniter
 *
 * Internal Ptolem Technologies CodeIgniter Framework
 *
 * @package		Ptolem_CodeIgniter
 * @author		Ptolem Development Team
 * @copyright	Copyright (c) 2014, Ptolem Technologies, Inc.
 * @license		http://ptolem.com/ptolem_codeigniter/licensing/
 * @link		http://ptolem.com/ptolem_codeigniter/
 * @since		Version 1.0
 * @filesource
 *
 */
 
// ------------------------------------------------------------------------

/**
 * Generator Controller
 *
 * @package		Ptolem_CodeIgniter
 * @subpackage	Core
 * @category	Core
 * @author		Ptolem Development Team
 * @link     	http://ptolem/ptolem_codeigniter/generator/
 */
class Gen extends Active_Controller
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
		
		$this->send_response($this->data, array(
			'generators'
		));
	}
	
	/**
	 * model
	 *
	 * Generates Ptolem model skeletons
	 *
	 * @access public
	 */
	public function model()
	{
		if($this->input->post('generate'))
		{
			//get model details
			$model_class  = $this->input->post('model_class'); //model class name
			$model_table  = $this->input->post('model_table'); //model table name
			$model_dir    = $this->input->post('model_dir'); //models directory
			$bmodel_prefx = $this->input->post('bmodel_prefix');//base model prefix
			$model_api_class = $this->input->post('model_api_class');//base model class
			
			//check if all requirements have been provided
			if(isset($model_class, $model_table, $model_dir))
			{
			     //check if the database table exists
				 if($this->db->table_exists($model_table))
				 {
				 	  //get the table fields
				 	  $table_fields = $this->db->list_fields($model_table);
				 	  
				 	  //model template data
				 	  $properties_array = "array(\r\n";
				 	  $properties       = '';
				 	  
				 	  //create the model properties arrays and model properties template list
				 	  foreach($table_fields as $field)
				 	  {
				 	  	  if(strtolower($field) === 'id') continue;
				 	  	  $properties .="public $".$field.";\r\n\t";
				 	  	  $properties_array .= "\t\t\t'".$field."'=>array(),\r\n";
				 	  }
				 	  
				 	  //close the properties array
				 	  $properties_array .="\t\t);";
				 	  
				 	  
				 	  //read in the model template file
				 	  $template_file = APPPATH.'third_party/assci-gen/assets/templates/model-template.txt';
				 	  
				 	  //read in the model template file
				 	  $api_template_file = APPPATH.'third_party/assci-gen/assets/templates/model-api-template.txt';
				 	  
				 	  //check if the template file is readable
				 	  if(is_readable($template_file) && is_readable($api_template_file))
				 	  {
				 	  	 $model_api_path  = $model_api_template = '';

				 	  	 $model_template  = read_file($template_file);

				 	  	 if($model_api_class) 
				 	  	 	$model_api_template  = read_file($api_template_file);
				 		 
				 		 $model_dir       = $model_dir ?: APPPATH.'models/';
				 		 
				 		 $model_path      = $model_dir.strtolower($model_class).'.php';
				 		 
				 		 if($model_api_class) 
				 		 	$model_api_path = $model_dir.strtolower($model_api_class).'.php';
				 		 
				 		 //replace template placeholders
				 	  	 $model = str_replace('{class}', ucfirst(strtolower($model_class)), $model_template);
				 	  	 $model = str_replace('{class-prefix}', ($bmodel_prefx ?: 'CI_'), $model);
				 	  	 $model = str_replace('{properties}', $properties, $model);
				 	  	 $model = str_replace('{table}', $model_table, $model);
				 	  	 $model = str_replace('{errors}', $properties_array, $model);
				 	  	 $model = str_replace('{relations}', $properties_array, $model);
				 	  	 $model = str_replace('{rules}', $properties_array, $model);
				 	  	 
				 	  	if($model_api_class) 
				 	  	{
				 	  		 $model_api_template = str_replace('{include-file}', strtolower($model_class), $model_api_template);
					 	  	 $model_api_template = str_replace('{class}', $model_api_class, $model_api_template);
					 	  	 $model_api_template = str_replace('{parent-class}', ucfirst(strtolower($model_class)), $model_api_template);
				 	  		 $done = write_file($model_api_path, $model_api_template);
				 	  	}
				 	  	 //write model out to file
				 	  	 $done = write_file($model_path, $model);

				 	  	 if($done && $done)
				 	  	 {
				 	  	 	$this->data = array(
				 	  	 		'message'=>'Success!. Model Generated successfully. Path=>'.$model_path,
				 	  	 		'type'=>'success'
				 	  	 	);
				 	  	 }
				 	  	 else
				 	  	 {	
				 	  	 	 $this->data = array(
				 	  	 	 	'message'=>'Error!. Error writing to model file. PATH=>'.$model_path,
				 	  	 	 	'type'=>'danger'
				 	  	 	 );
				 	  	 }
					  }
					  else
					  {
					  	 $this->data = array(
					  	 	'message'=>'Error!. Model template file not found or is unreadable. 
					  	 	 Check if template file exists or is readable by the server daemon
					  	 	. PATH=>'.$template_file,
					  	 	'type'=>'danger'
					  	 );
					  }
				 }
				 else
				 {
				 	$this->data = array(
				 		'message'=>'Error!. Model table doesn\'t exist',
				 		'type'=>'danger'
				 	);
				 }
			}
			else
			{
				$this->data = array(
					'message'=>'Error!. Generating models requires atleast, model class name and table name',
					'type'=>'warning'
				);
			}
		}
		
		$this->send_response($this->data, array(
			'generators'
		));
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
