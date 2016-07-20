<?php if(!defined('BASEPATH')) exit("Access Denied");

//====================================================================================================
/**
 *@package	 Active
 *@category	 Core
 *@author	 Collins Ryan Ochieng
 *@copyright Copyright (c) 2014. Dala
 */
//====================================================================================================


//====================================================================================================
/**
 *Active_Model
 *Base class for all models implementing the ActiveRecord Pattern
 *
 *@package Active
 *@author  Collins Ryan Ochieng
 */
//====================================================================================================

class Active_Model extends CI_Model
{	

	/**
	 *@var string $id, record id
	 */
	public $id = null;

    /**
	 *@var bool $_valid, boolean flag indicates whether the model is valid or not
	 */
	protected $valid = true;

	/**
	 *@var array $errors, array of validation errors
	 */
	protected $errors = array();

	/**
	 *@var array $_message, message from last operation called that set it, used to pass out messages to the world
	 */
	protected $message = '';

	/**
	 *@var string $query, holds the current query
	 */
	protected $query = '';

	/**
	 *@var string $model_table, holds the table for the model
	 */
	protected $model_table = '';

    /**
	 *Active_Model constructor
	 *
	 *@access public
	 *@return Active_Model instance
	 */
	public function __construct(array $data = array(), $save=false)
	{	
		//call parent constructor
		parent::__construct();

	    //set model instance properties
		$this->set_attributes($data);

		//persist if requested
		if($save)
		{
			$this->save();
		}
	}

	protected function relations()
	{
		return array();
	}

	protected function rules()
	{
		return array();
	}


	public function get_created()
	{
		return $this->created;
	}
	/**
	 *errors
	 *Gets the array for attribute validation errors
	 *
	 *@access public
	 *@return array $errors, instance private field of attributes' validation errors
	 */
	public function errors()
	{
		return $this->errors;
	}


	/**
	 *message
	 *Gets the last operation's output message 
	 *
	 *@access public
	 *@return string $message, instance private field of last operation's output message
	 */
	public function message()
	{	
		return $this->message;
	}

    /**
	 *is_valid
	 *Checks state of the model via the valid attribute
	 *
	 *@access public
	 *@return bool $valid, true for valid, false otherwise
	 */
	public function is_valid()
	{
		return $this->valid;
	}


	/**
	 *table
	 *Gets the model table
	 *
	 *@access public
	 *@return string $modeltable, model table name
	 */
	public function model_table()
	{	
		return $this->model_table;
	}
	
	public function time_elapsed_string($datetime, $full = false)
	{
		if(is_numeric($datetime)) $datetime=date('Y-m-d H:i:s', $datetime);

	    $now = new DateTime();
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );

	    foreach ($string as $k => &$v)
	    {
	        if ($diff->$k) 
	        {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } 
	        else 
	        {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);

	    return $string ? implode(', ', $string) . ' ago' : 'just now';
   }




	public function decode_json($field, $assoc=true)
	{
		if(property_exists(get_class($this), strtolower($field)))
		{
			return json_decode($this->$field, $assoc);
		}
		return null;
	}


	public function write($field)
	{
		if(property_exists(get_class($this), strtolower($field)))
		{
			echo $this->$field;
		}
	}

	public function filter(array $params)
	{
		$values = array();

		foreach($params as $param=>$param_value)
		{
			if(trim($param_value) && property_exists(get_class($this), $param))
		    {
	    		if(active_model_exists($param))
	    		{
	    			$model = strtolower($param).'_model';

	    			$this->load->model($model);

	    			$model = $this->$model;

	    			$records = array();

	    			foreach($model->relations() as $field=>$val)
	    			{
	    				$args = array();
	    				var_dump($model->where($field, $param_value)->results());
	    			}

	    			 exit;

	    			foreach ($records as $key => $model)
	    			{
	    				$values = array_merge($values, (
	    					(array) $model->get_values_except_id()
	    				));
	    			}
	    		}
	    		else
	    		{
	    			$values = array_merge($values, array($value));
	    		}
			}
		}


		if(!empty($values))
		{
			foreach($this->relations() as $field=>$val)
			{
				$this->or_where_in($field, $values);
			}
		}

		return $this->paged_results();
	}

	public function paged_results($limit = 20, $base_url=null, $page_break_point=5, $pages_before_break=5, $max_pages=5)
	{
		$current_start_page = 0;

		$model_pg_hash = md5(get_class($this));

		$page = ($this->input->get_post($model_pg_hash.'_pg_page') ?: 0);

		$page_limit = ($this->input->get_post($model_pg_hash.'_pg_page_limit') ?: $limit);

		$offset = ($page_limit * $page);

		$this->db->limit($page_limit, $offset);

		$results = $this->db->get($this->model_table)->result(get_class($this));

		$results = $this->process_result($results);

		$page_count = floor($this->db->count_all($this->model_table)/$page_limit);

		$pages  = array();

		if($page >= $page_break_point)
		{
			$current_start_page = $page-$pages_before_break;
		}

		for($i=$current_start_page; $i < $page_count; $i++)
		{
			if($i > ($current_start_page+$max_pages)) break;

			$pages[$i+1] = array(
				'url'=>'?'.$model_pg_hash.'_pg_page='.($i).'&'.$model_pg_hash.'_pg_page_limit='.$page_limit
			);
		}

		return array(
			'results'=>$results,
			'current_page'=> $page,
			'next_page'=> '?'.$model_pg_hash.'_pg_page='.($page + 1).'&'.$model_pg_hash.'_pg_page_limit='.$page_limit,
			'prev_page'=> '?'.$model_pg_hash.'_pg_page='.((($page-1) > -1) ? ($page-1) : 0).'&'.$model_pg_hash.'_pg_page_limit='.$page_limit,
			'last_page'=> '?'.$model_pg_hash.'_pg_page='.($page_count).'&'.$model_pg_hash.'_pg_page_limit='.$page_limit,
			'first_page'=>'?'.$model_pg_hash.'_pg_page=0&'.$model_pg_hash.'_pg_page_limit='.$page_limit,
			'pages'=>$pages
		);
	}

	public function results()
	{
	    $result = $this->db->get($this->model_table);

		return $this->process_result($result->result(get_class($this)));
	}

	public function process_result($result)
	{
		$processed_result = array();

		if(is_array($result))
		{
			for($i=0; $l=count($result), $i < $l; $i++)
			{
				$processed_result['id-'.$result[$i]->id] = $result[$i]->load_relations();
			}
		}
		else
		{
			if($result instanceof Active_Model)
			{
				 $result->load_relations();

				 $processed_result['id-'.$result->id] = $result;
			}
		}

		return $processed_result;
	}

	public  function add_one($model)
	{
		$class = get_class($this);

		$model = new $class($model);

		return $model->save();
	}

	public  function update_one($model)
	{
		$class = get_class($this);

		$model = new $class($model);

		return $model->update();
	}

	public  function remove_one($id)
	{
		$removed = $this->db->delete($id, $this->model_table);

		if($removed)
		{
			return array(
				'error'=>false,
				'message'=>'deleted successfully'
			);
		}

		return array(
			'error'=>true,
			'message'=>'not deleted'
		);
	}

	/**
	 *delete
	 *deletes the model instance record from the databases
	 *
	 *@access public
	 *@return bool $success, true for success, false for error
	 */
	public function remove()
	{
		$removed  = $this->db->delete($this->model_table, array('id'=>$this->id));

		if($removed)
		{
			return array(
				'error'=>false,
				'message'=>'removed successfully'
			);
		}
		else
		{
			return array(
				'error'=>true,
				'message'=>'error deleting record'
			);
		}
	}


	/**
	 *update
	 *updates the model instance record on the database
	 *
	 *@access public
	 *@return bool $success, true for success, false for error
	 */

	public function update()
	{
		$this->process_model($this);

		$this->validate($this, array(
			'is_update'=>true,
			'id'=>$this->id
		));

		$return  = null;

		if($this->valid)
		{
			$this->save_fields();
		    
		    $this->db->update($this->model_table, $this->get_record(true), array('id'=>$this->id));

		    $return  = $this->id;
		}

		if($return)
		{
			return array(
				'error'=>false,
				'errors'=>$this->errors(),
				'id'=>$this->id,
				'message'=>$this->message()
			);
		}
		else
		{
			if($this->valid)
			{
				//log error here for review
				 return array(
				 	'error'=>true,
				 	'errors'=>array('server'=>'Server error'),
				 	'message'=>'Server error'
				 );
			}
			else
			{
				return array(
					'error'=>true,
					'errors'=>$this->errors(),
					'id'=>$this->id,
					'message'=>$this->message()
				);
			}
		}
	}

	/**
	 *save
	 *saves the model instance record to the database creating a new record if it doesn't exist
	 *
	 *@access public
	 *@return bool $success, true for success, false for error
	 */
	public function save()
	{	
		$this->process_model($this);

		$this->validate($this);

		$return = null;

		if($this->valid) 
		{
		    $this->save_fields();

			$query = $this->db->insert_string($this->model_table, $this->get_record());

		    $this->db->query($query);

		    $return  = ($this->id = $this->db->insert_id());
		}


		if($return)
		{
			return array(
				'error'=>false,
				'errors'=>$this->errors(),
				'id'=>$this->id,
				'message'=>$this->message()
			);
		}
		else
		{
			if($this->valid)
			{
				//log error here for review
				 return array(
				 	'error'=>true,
				 	'errors'=>array('server'=>'Server error'),
				 	'message'=>'Server error'
				 );
			}
			else
			{
				return array(
					'error'=>true,
					'errors'=>$this->errors(),
					'id'=>$this->id,
					'message'=>$this->message()
				);
			}
		}
	}

	/** 
	 *save_fields
	 *Save and normalize model fields
	 *
	 *@access private
	 *@return Active_Model $instance, current model instance
	 */
	private function save_fields()
	{
		foreach($this->errors as $field=>$value)
	    {
	    	if($this->$field instanceof Active_Model 
	    						|| is_array($this->$field))
	    	{
	    		$fields = array();

	    		if(is_array($this->$field))
	    		{
	    			$fields = $this->$field;
	    		}
	    		else	    		
	    		{
	    			$fields[$this->$field->id.'-id'] = $this->$field;
	    		}

	    		foreach($fields as $key=>$fld)
	    		{
	    			if($fld instanceof Active_Model)
	    			{
	    				if(!$fld->id)
			    		{
			    			$fld->save(); 
			    		}
			    		else
			    		{
			    			$fld->update();
			    		}
			    	}

		    	    $fields[$key] = $this->clean_field($fld);
		    	}

		    	if(is_array($this->$field)) 
		    	{
		    		$this->$field = $fields;
		    	}
		    	else
		    	{
		    		$this->$field = array_pop($fields);
		    	}
	    	}
	    }
	    return $this;
	}

	
	

	/**
	 *set_attributes
	 *Sets up the model instance attributes
	 *
	 *@access public
	 *@return Active_Model $instance, current model instance always
	 */
	public function set_attributes(array $attributes = array())
	{
		foreach ($attributes as $attr=>$value) 
		{
			if(array_key_exists($attr, get_object_vars($this)))
			{
				$this->$attr = $value;
			}
		}

		return $this;
	}

	public function get_values_except_id()
	{
		$record = array();

		foreach ($this->errors as $attr=>$value) 
		{
			if($attr !== 'id')
			{
				$record[] = $this->$attr;
			}
		}

		return $record;
	}

	/**
	 *get_record
	 *Gets the model instance attributes
	 *
	 *@access public
	 *@return $record array, current model instance db record array
	 */
	public function get_record($no_id=false)
	{
		$record = array();

		foreach ($this->errors as $attr=>$value) 
		{
			if($no_id && $attr=='id') continue;
			$record[$attr] = $this->$attr;
		}

		return $record;
	}
	
    protected  function rinse($results)
    {
    	foreach($results as $instance)
    	{
    		$instance->load_relations();
    	}

    	return $results;
    } 

	public function load_relations()
	{
		$class = get_called_class();

		foreach ($this->relations() as $field =>$value)
		{	
			if(is_array($value) && array_key_exists('model', $value) && array_key_exists('type', $value))
			{
				$model = ucfirst(strtolower($value['model'])).'_model';

				$type = strtolower($value['type']);

			    $this->load->model($model);

			    $table = $this->$model->model_table();

				if($type === 'many-to-one' || $type === 'one-to-one')
				{
					$query = $this->$model->where(array('id'=>$this->$field))->results();
				}

				if($type === 'one-to-many' || $type === 'many-to-many')
				{
					$params = array();
					$params[$table] = $this->id;
					$query = $this->$model->where($params)->results();
				}

                $result = $query;

                if(is_array($result) && count($result) > 1 && ($type==='one-to-many' || $type === 'many-to-many'))
                {
                	$this->$field = $result;
                }
                else
                {
                	if((is_array($result) || $result instanceof Active_Model) && count($result) > 0)
                	{
                		$this->$field = array_pop($result);
                	}		
                }
			}
		}

		return $this;
	}

    protected  function process_model($model)
    {
    	foreach($model->relations() as $field=>$value)
    	{
    		if(is_array($value) && !empty($value))
    		{
    			$type  = $value['type'];
    			$model = $value['model'];

    			$class = ucfirst(strtolower($model)).'_model';

    			if($type === 'one-to-one' || $type === 'many-to-one')
    			{
    				if(is_array($this->$field))
    				{
    					$this->$field = new $class($this->$field);
    				}

    			}

    			if($type === 'one-to-many' || $type === 'many-to-many')
    			{
    				if(is_array($this->$field))
    				{
    					foreach($this->$field as $f=>$value)
    					{
    						if(is_array($value)) $this->$field[$f] =  new $class($value);
    					}
    				}
    			}
    		}
    	}
    }

    protected  function clean_field($field)
    {
    	if($field instanceof Active_Model)
    	{
    		return $field->id;
    	}

    	return $field;
    }

	/**
	 *validate
	 *validates a model instance
	 *
	 *@access private
	 *@return bool $valid, true for success, false otherwise
	 */
	private function validate($model, $params=array())
	{
		$rules = $model->rules();

		if(is_array($rules))
		{
			foreach($rules as $field=>$field_rules)
			{
				foreach ($field_rules as $rule => $arguments) 
				{
					$message = $is_valid = null; 

					if(!is_array($arguments)) $arguments=array();

					$arguments=array_merge($arguments, $params);

					if($model->$field instanceof Active_Model)
					{
						
						$message = $is_valid = $this->validate($model->$field, $rule, $arguments);
					}
					else
					{
						$arguments['field']=$field;
						$message = $is_valid = $this->get_validation_result(
													$model->$field, $rule, $arguments);
					}

					if(is_string($is_valid) || false === $is_valid)
					{ 
						$model->valid = false;
						$model->errors[$field] = $message;
						$model->message = ucfirst(strtolower($field)).'.'.$message;
					}
				}
			}
		}
	}

	/**
	 *Sets the validation results for a particular property
	 *
	 *@access public 
	 *@params $property mixed, model property
	 *@params $message string, validation message 
	 */
	public function get_validation_result($property, $validation_op, $arguments =null)
	{
		 
		 switch($validation_op)
		 {   
		 	case 'unique': 
		 	 	return  ($this->is_unique($property, $arguments)) ? true : ' already exists'; 
		 	 case 'required': 
		 	 	return  (!$this->is_empty($property, $arguments)) ? true : ' is required'; 
		 	 case 'numeric':  
		 	 	return ($this->is_numeric($property, $arguments)) ? true : ' invalid numeric value';
		 	 case 'alphabet': 
		 	 	return  ($this->is_alphabet($property, $arguments)) ? true : ' invalid value, alphabet characters only';
		 	 case 'alphanum': 
		 	 	return  ($this->is_alphanumeric($property, $arguments)) ? true : ' invalid value, alphanumerical characters only';
		 	 case 'minimum':
		 	 	return  ($this->is_above_minimum($property, $arguments)) ? true : ' invalid value, minimum value passed'; 
		 	 case 'maximum': 
		 	 	return  ($this->is_below_maximum($property, $arguments)) ? true : ' invalid value, maximum value passed';
		 	 case 'minimumchars':
		 	 	return  ($this->is_below_minimum_chars($property, $arguments)) ? true : ' invalid value, less than minimum allowed characters'; 
		 	 case 'maximumchars': 
		 	 	return  ($this->is_above_maximum_chars($property, $arguments)) ? true : ' invalid value, more than maximum allowed characters'; 
		 	 case 'range': 
		 	 	return ($this->is_within_range($property, $arguments)) ? true : ' invalid value, not within accepted range'; 
		 	 case 'url': 
		 	 	return ($this->is_url($property, $arguments)) ? true : ' invalid url'; 
		 	 case 'email':
		 	 	return ($this->is_email($property, $arguments)) ? true : ' invalid email address'; 
		 }
	}
	
	/**
	 *Checks whether the value is not truly empty, null, not set, '' e.t.c
	 *
	 *@access public 
	 *@params $value numerice, value to check
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_empty($value)
	{
		 $value = trim($value);

		 if(isset($value) && null != $value && '' != $value)
		 {
		    return false;
		 }
		 else
		 {
		 	return true;
		 }
	}
	
	/**
	 *Checks whether the value is a valid numerical value
	 *
	 *@access public 
	 *@params $value numerice, value to validate
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_numeric($value)
	{
	   if(!$this->is_empty($value))
	   {
	   	   if(is_numeric($value))
		   {
		   	    return true;
		   }

	   	   return false; 
	   }
	   else
	   {
	   	 return true;
	   }
	}

	/**
	 *Checks whether the value already exists
	 *
	 *@access public 
	 *@param $value mixed, value to check
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_unique($value, array $args=array())
	{
		$is_update=array_key_exists('is_update', $args) ? $args['is_update'] : false;

		if(!$this->is_empty($value) && !$is_update)
	    {
	   	   $params = array();

		   $params[$args['field']] = $value;

		   $result = $this->where($params)->results();

		   if(is_array($result) && count($result) > 0)
		   {
		      return false;
		   }

	   }
	   elseif(!$this->is_empty($value) && $is_update)
	   {	
	   	   $params = array();

		   $params[$args['field']] = $value;

		   $result = $this->where($params)->results();

		   if(is_array($result) && count($result) > 0)
		   {
		      $record=array_pop($result);

		      if($record->id === $args['id']) return true;
		   }

		   return false;
	   }

	   return true; 
	}
	
	/**
	 *Checks whether the value is a valid url
	 *
	 *@access public 
	 *@params $value numerice, value to validate
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_url($value)
	{
		 if($this->is_empty($value))
		 {
			 return true;
		 }
		 elseif(preg_match('/^/', $value))
		 {
			 return false;
		 }
		 return false;
	}	
	
	/**
	 *Checks whether the value is a valid email address
	 *
	 *@access public 
	 *@params $value numerice, value to validate
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_email($value)
	{
		 if($this->is_empty($value))
		 {
		 	return true;
		 }
		 elseif(
		 	preg_match('/^[a-zA-Z0-9.-_]+@[a-zA-Z0-9.-_]+\.[a-zA-Z0-9.-_]+$/', 
		 		trim($value)))
		 {
		 	return true;
		 }
		 return false;
	}
	
	/**
	 *Checks whether the value is alpabetical
	 *
	 *@access public 
	 *@params $value numerice, value to validate
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_alphabet($value)
	{
		if($this->is_empty($value))
		{
			return true;
		}
		elseif(preg_match('/^[a-zA-Z]+$/', trim($value))) 
		{
		 	return true;
		}
		 return false;
	}
	
	
	/**
	 *Checks whether the value is an alphanumeric value
	 *
	 *@access public 
	 *@params $value alphanumeric, value to validate
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_alphanumeric($value)
	{
		if($this->is_empty($value))
		{
			return true;
		}
		elseif(preg_match('/^[a-zA-Z0-9\._\/\\&*!#$()@`?;:"\'\t\s\rn\n\a><{}[]+$/', trim($value))) 
		{
		 	return true;
		}
		
		return false;
	}

	/**
	 *Checks whether the string is below the maximum number of chars
	 *
	 *@access public 
	 *@params $value string, value to validate
	 *@params $maximum int, maximum threshold
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_below_minimum_chars($value, $max)
	{
		if($this->is_empty($value))
		{
			return true;
		}
		elseif((is_string($value) AND strlen($value) <= $max))
		{
		 	return true;
		} 

		return false;
	}

	/**
	 *Checks whether the string is below the maximum number of chars
	 *
	 *@access public 
	 *@params $value string, value to validate
	 *@params $maximum int, maximum threshold
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_above_maximum_chars($value, $max)
	{
		if($this->is_empty($value))
		{
			return true;
		}	
		elseif((is_string($value) AND strlen($value) >= $max))
		{
		 	return true;
		} 
		return false;
	}
	
	
	/**
	 *Checks whether the value is below the maximum
	 *
	 *@access public 
	 *@params $value numerice, value to validate
	 *@params $maximum numeric, maximum threshold
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_below_maximum($value, $max)
	{
		if($this->is_empty($value))
		{
			return true;
		}
		elseif((is_numeric($value) AND $value <= $max))
		{
		 	return true;
		} 
		return false;
	}
	
	
    /**
	 *Checks whether the value is above the minimum
	 *
	 *@access public 
	 *@params $value numerice, value to validate
	 *@params $minimum numeric, minimum threshold
	 *@return boolean, true for valid, false for invalid
	 */
	public  function is_above_minimum($value, $min)
    {
    	if($this->is_empty($value))
    	{
    		return true;
    	}
    	elseif(is_numeric($value) AND $value >= $min)
    	{
		 	return true;
    	} 
		 return false;
    }
    
    
    /**
	 *Checks whethe the value is within the provided range
	 *
	 *@access public 
	 *@params $value numeric, value to validate
	 *@params $args array, max and min values
	 *@return boolean, true for valid, false for invalid
	 */
    public  function is_within_range($value, $range)
    {
    	if($this->is_empty($value))
    	{
    		return true;
    	}
    	elseif(is_numeric($value) AND ($value <= $range[0] AND $value >= $range[1]))
    	{
		 	return true;
    	} 
		
		return false;
    }

	public function begin_transaction()
	{
		$this->db->trans_begin();
		return $this;
	}

	public function end_transaction()
	{
		$this->db->trans_complete();
		return $this;
	}

	public function rollback_transaction()
	{
		$this->db->trans_rollback();

		return $this;
	}

	public function commit_transaction()
	{
		$this->db->trans_commit();

		return $this;
	}

	public function get_transaction_status()
	{
		return $this->db->trans_status();
	}

	public function count_all()
	{
		return $this->db->count_all($this->model_table);
	}

	public function fields_set(array $fields)
	{
		for($i=0; $i < count($fields); $i++)
		{
			if(!$this->is_isset($this->$fields[$i])) return false;
		}

		return true;
	}	

	public function fields_set_count(array $fields)
	{
		$set = 0;

		for($i=0; $i < count($fields); $i++)
		{
			if(!!$this->is_isset($this->$fields[$i])) $set+=1;
		}

		return $set;
	}	

	// Added by kinoti.raphs@gmail.com------------------------------------------------------------
	public function edit_one($specs=array())
	{
		return $this->db->update($specs['table'],$specs['data'],array($specs['field'] => $specs['var']));
	}

	public function value_exists($specs = array())
	{
		$exists = $this->db->get_where($specs['table'], array($specs['field'] => $specs['value']))->result();

		($exists) ?  true : false;

		return $exists;
	}

	public function _validate($field,$value)
	{
		switch ($field) {
			case 'email':

				if(filter_var($value, FILTER_VALIDATE_EMAIL) === false)
				{
					return false;	
				}

				else
				{
					return true;
				}
				
				break;
			
			default:
				# code...
				break;
		}
	}

	public function sendmail($specs)
	{	
		$CI = &get_instance();

		$email = $CI->email;
	
		$email->from($specs['sender_mail'], $specs['sender_name']);
		$email->to($specs['recipient_mail']);
		$email->reply_to($specs['reply_to']);
		
		$email->subject($specs['subject']);
		$email->message($specs['message']);
		
		$email->send();	
		
	}

	public function _add_one($specs=array())
	{
		$this->db->insert($specs['table'],$specs['data']);

		return $this->db->insert_id();
	}


	public function __call($name, $args)
	{
		if(method_exists($this->db, $name))
		{
		   call_user_func_array(array($this->db, $name), $args);
		}

		return $this;
	}

	/**
	 * __get
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string
	 * @access private
	 */
	function __get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}

}