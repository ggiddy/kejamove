<?php if(!defined('BASEPATH')) exit("Acess Denied");
/**
 *setup
 *
 *Define setup controller
 *
 *@author Collins Ryan(crryanlink@gmail.com)
 */

/**
 *Setup
 *
 *Onboarding process controller
 *
 *@uses Active/Active_Controller
 */
class Setup extends Active_Controller
{
	/**
	 *@var $models array, controller autoload models
	 */
	protected $models=array('users', 'requests');

	/**
	 *__construct
	 *
	 *Controller constructor and front-controller
	 *
	 *@access public
	 *@return $instance Setup, controller instance
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *newrequest
	 *Start new move request
	 *
	 *@access private
	 */
	public function newrequest()
	{
		if($this->input->post('usr_submit'))
		{
			$request=$this->input->post('request');

			$phone=$request['phone'];

			//Create account if it doesn't exist
			
			$user = $this->db->get_where('users', array('phone' => $phone))->result_array()[0];
			if(!is_array($user))
			{
				$user_data = array(
					'phone'		=> $phone,
					'password'	=> substr(md5($phone), 0, 4),
					'type'		=> 'user',
					'status'	=> 'active',
					'created'	=> time()
				);

				//save user details
				$this->db->insert('users', $user_data);

				//get the user id
				$user_id = $this->db->insert_id();

				//get the user
				$user = $this->db->get_where('users', array('id' => $user_id))->result_array()[0];

			}

			//If account exists login and add the request
			if(is_array($user))
			{
				$user_id = $user['id'];

				if(isset($user_id) && !empty($user_id)){
					$uid = $user_id;
				} 

				$request_data = array(
					'moving_from' 	=> $request['moving_from'],
					'moving_to' 	=> $request['moving_to'],
					'floor_from' 	=> $request['floor_from'],
					'floor_to' 		=> $request['floor_to'],
					'distance'		=> (int)$request['distance'],
					'created'		=> time()
				);

				$this->db->insert('moverequests', array('phone' => $request['phone'], 'users' => $uid));

				$request_id = $this->db->insert_id();

				//echo $request_id; exit();

				//save request information where phone is the user's phone
				$this->db->where('users', $user_id);
				$this->db->update('moverequests', $request_data);

				$rid = $request_id;
	
				redirect(base_url("setup/select_options/$uid/$rid"));
				
			}
		}

		$this->send_response($this->data, array('app/page-start'));
	}

	/**
	 *items
	 *Add the checklist of stuff that will be hauled
	 *
	 *@access private
	 */
	public function items($id=null, $rid=null)
	{
		if(!$user=$this->users->get_user($id)) show_error('User not found');
		if(!$request=$this->requests->get_request($rid)) show_error('Request not found');

		if($this->input->post('usr_submit'))
		{
			$items=$this->input->post('items');
			$items=(is_array($items)) ? $items : array();
			$request_items=array('items'=>'');
			$apartment_from_floor=$this->input->post('apartment_from_floor');
			$apartment_to_floor=$this->input->post('apartment_to_floor');

			foreach ($items as $i=>$item)
			{
				$request_items['items'].=$item.',';
			}

			$this->data=$request->set_attributes($request_items)
								->update();

		    if(false===$this->data['error'] && !$this->is_ajax_request())
		    {
		    	$request->save_info(array(
		    		'moving_to_apartment_floor'=>$apartment_to_floor,
		    		'moving_from_apartment_floor'=>$apartment_from_floor
		    	));
		    	
		    	//send email to kejahunt
		    	$email=get_instance();
		    	$email=$email->email;

				$this->email->from($this->config->item('app-move-request-from-email'), 'Kejamove');
				$this->email->to($this->config->item('app-move-request-receipt-email')); 
				$this->email->cc($this->config->item('app-move-request-cc-emails')); 

				$this->email->subject('New Move Request');
				$this->email->message($this->load->view('email/request', array('request'=>$request ,'ua'=>$this->input->post('ua')), true));	

				//$this->email->send();
		    	$user->do_naive_login(array('phone'=>$user->phone));
		    	redirect(base_url("setup/success/$user->id/$request->id"));
		    }
		}

		$this->data['user']=$user;
		$this->data['request']=$request;
		$this->send_response($this->data, array('setup/page-setup-request-items'));
	}

	/**
	 *success
	 *
	 */
	public function success($id=null, $rid=null)
	{
		if(!$user=$this->users->get_user($id)) show_error('User not found');
		if(!$request=$this->requests->get_request($rid)) show_error('Request not found');
		$this->data['user']=$user;
		$this->data['request']=$request;
		$this->send_response($this->data, array('setup/page-setup-request-success'));
	}

	/**
	 *index
	 *Default controller action, calls new request
	 *
	 *@access private
	 */
	public function index()
	{	
		$this->newrequest();
	}

	/**
	 * select_options
	 * Allows user to select truck and moving options.
	 * 
	 * @param  integer $id  The user id
	 * @param  integer $rid The request id
	 * @return void
	 */
	public function select_options($id=null, $rid=null)
	{
		if(!$user=$this->users->get_user($id)) show_error('User not found');
		if(!$request=$this->requests->get_request($rid)) show_error('Request not found');

		$this->data['user']=$user;
	    $this->data['request']=$request;
	   	
		$this->send_response($this->data, array('setup/page-setup-select-truck'));
	}

	/**
	 * This method processes a move request.
	 * 
	 * @return void
	 */
	public function process_request()
	{
		//get form data
		$user_id    		= $this->input->post('user_id');
		$request_id 		= $this->input->post('request_id');
		$truck 				= $this->input->post('selected_truck');
		$distance 			= $this->input->post('distance');
		$floor_from 		= $this->input->post('floor_from');
		$floor_to 			= $this->input->post('floor_to');
		$pickup_loaders 	= $this->input->post('pickup_loaders');
		$canter_loaders 	= $this->input->post('canter_loaders');
		$fh_loaders 		= $this->input->post('fh_loaders');
		$pickup_packaging 	= $this->input->post('pickup_packaging');
		$canter_packaging 	= $this->input->post('canter_packaging');
		$fh_packaging 		= $this->input->post('fh_packaging');
		$hse_cleaning		= $this->input->post('house_cleaning');
		$interior_dec		= $this->input->post('interior_decorator');
		$mpesa_conf_code	= $this->input->post('confirmation_code');
		$total_cost 		= 0;
		
		if($floor_to > 0 || $floor_from > 0) 
		{
			$floor = 'notground';
		} else {
			$floor = 'ground';
		}

		$request_data = array();

		//perform calculations
		switch ($truck) {
			case 'pickup':

				//floor calculations
				$total_cost += $this->calculate_transit_cost($floor, $distance, $pickup_loaders, $truck);
		
				//packaging calculations
				$total_cost += $this->calculate_packaging_cost($pickup_packaging);

				if($hse_cleaning) {
					$house_cleaning = 1;
					$total_cost += $this->calculate_house_cleaning_cost($house_cleaning);
				} else {
					$house_cleaning = 0;
				}

				if($interior_dec) {
					$interior_decorator = 1;
					$total_cost += $this->calculate_interior_dec_cost($house_cleaning);
				} else {
					$interior_decorator = 0;
				}

				//saving to database
				$request_data = [
	    			'distance' 	 		=> $distance,
	    			'vehicle'	 		=> $truck,
	    			'floor_from'		=> $floor_from,
	    			'floor_to'			=> $floor_to,
	    			'helpers' 	 		=> $pickup_loaders,
	    			'packaging'  		=> $pickup_packaging,
	    			'house_cleaning'	=> $house_cleaning,
	    			'interior_decorator'=> $interior_decorator,
	    			'mpesa_conf_code'	=> $mpesa_conf_code,
	    			'totalcost'  		=> ceil($total_cost)
	    		];

	    		//save to db
				$this->db->where('id', $request_id);
				$this->db->update('moverequests', $request_data);

				//send mail to kejahunt
				$this->send_mail($request_data, $user_id, $request_id); 
	    		
				break;

			case 'canter':
				$total_cost = 0;

				//moving and helper calculations
				$total_cost += $this->calculate_transit_cost($floor, $distance, $canter_loaders, $truck);
				
				//packaging calculations
				$total_cost += $this->calculate_packaging_cost($canter_packaging);

				//addons calculations
				if($hse_cleaning) {
					$house_cleaning = 1;
					$total_cost += $this->calculate_house_cleaning_cost($house_cleaning);
				} else {
					$house_cleaning = 0;
					$total_cost += $this->calculate_house_cleaning_cost($house_cleaning);
				}

				if($interior_dec) {
					$interior_decorator = 1;
					$total_cost += $this->calculate_interior_dec_cost($house_cleaning);
				} else {
					$interior_decorator = 0;
				}

				//saving to database
				$request_data = [
	    			'distance' 	 		=> $distance,
	    			'vehicle'	 		=> $truck,
	    			'floor_from'		=> $floor_from,
	    			'floor_to'			=> $floor_to,
	    			'helpers' 	 		=> $canter_loaders,
	    			'packaging'  		=> $canter_packaging,
	    			'house_cleaning'	=> $house_cleaning,
	    			'interior_decorator'=> $interior_decorator,
	    			'mpesa_conf_code'	=> $mpesa_conf_code,
	    			'totalcost'  		=> ceil($total_cost)
	    		];

				$this->db->where('id', $request_id);
				$this->db->update('moverequests', $request_data);

				//send mail to kejahunt
				$this->send_mail($request_data, $user_id, $request_id);

				break;

			case 'fh':

				//floor calculations
				$total_cost += $this->calculate_transit_cost($floor, $distance, $fh_loaders, $truck);
				
				//packaging calculations
				$total_cost += $this->calculate_packaging_cost($fh_packaging);

				//addons calculations
				if($hse_cleaning) {
					$house_cleaning = 1;
					$total_cost += $this->calculate_house_cleaning_cost($house_cleaning);
				} else {
					$house_cleaning = 0;
				}

				if($interior_dec) {
					$interior_decorator = 1;
					$total_cost += $this->calculate_interior_dec_cost($house_cleaning);
				} else {
					$interior_decorator = 0;
				}

				//saving to database
				$request_data = [
	    			'distance' 	 		=> $distance,
	    			'vehicle'	 		=> $truck,
	    			'floor_from'		=> $floor_from,
	    			'floor_to'			=> $floor_to,
	    			'helpers' 	 		=> $fh_loaders,
	    			'packaging'  		=> $fh_packaging,
	    			'house_cleaning'	=> $house_cleaning,
	    			'interior_decorator'=> $interior_decorator,
	    			'mpesa_conf_code'	=> $mpesa_conf_code,
	    			'totalcost'  		=> ceil($total_cost)
	    		];

				$this->db->where('id', $request_id);
				$this->db->update('moverequests', $request_data);

				//send mail to kejahunt
				$this->send_mail($request_data, $user_id, $request_id);
				
				break;

			default:

				//we won't get here
				$this->index();
				break;
		}

		//redirect to success page
		$this->success($user_id, $request_id);
	}

	/**
	 * This method sends an email to kejahunt.
	 *
	 * @param array $request_data The relevant data.
	 * @param integer $id The user id.
	 * @param integer $rid The request id.
	 * @return  void
	 */
	private function send_mail($request_data=array(), $id=0, $rid=0)
	{
		if(!$user=$this->users->get_user($id)) show_error('User not found');
		if(!$request=$this->requests->get_request($rid)) show_error('Request not found');
		
		$additional_info = array(
			'phone' => $user->phone, 
			'moving_from'=>$request->moving_from, 
			'moving_to'=>$request->moving_to,
			'floor_from'=> $request->floor_from,
			'floor_to'=> $request->floor_to,
			'created' => $request->created
		);

		//get the request
		$request_data = array_merge($request_data, $additional_info);

		//send email to kejahunt
		$this->load->library('email');

		$this->email->from($this->config->item('app-move-request-from-email'), 'Kejamove');
		$this->email->to($this->config->item('app-move-request-receipt-email')); 
		$this->email->cc($this->config->item('app-move-request-cc-emails')); 

		$this->email->subject('New Move Request');
		$this->email->message($this->load->view('email/request', array('request'=>$request_data ,'ua'=>$this->input->post('ua'))));
		//$this->email->send();
	}

	/**
	 * This method returns the cost of the packaging material.
	 * 
	 * @param  strng $packaging The packaging material name.
	 * @return integer The cost of the packaging material.
	 */
	public function calculate_packaging_cost($packaging=null)
	{
		if($packaging === 'little') {
			return PACKAGING_SMALL;
		} else if($packaging === 'normal') {
			return PACKAGING_NORMAL;
		} else if($packaging === 'big') {
			return PACKAGING_BIG;
		} else if($packaging === 'jumbo') {
			return PACKAGING_JUMBO;
		}
	}

	/**
	 * This function returns the cost of house cleaning.
	 * 
	 * @param  integer $house_cleaning Whether house cleaning is selected.
	 * @return integer  The cost of house cleaning.
	 */
	public function calculate_house_cleaning_cost($house_cleaning=0)
	{
		if ($house_cleaning == 1) {
			return HOUSE_CLEANING;
		} else {
			return 0;
		}
	}

	/**
	 * This function returns the cost of interior decoration.
	 * 
	 * @param  integer $interior_dec Whether interior dec is selected.
	 * @return integer  The cost of interior decoration.
	 */
	public function calculate_interior_dec_cost($interior_dec=0)
	{
		if ($interior_dec == 1) {
			return INTERIOR_DECORATOR;
		} else {
			return 0;
		}
	}

	/**
	 * This method calculates the cost of transit.
	 * 
	 * @param  srting  $floor    Building floor.
	 * @param  integer $distance Distance to destination.
	 * @param  integer $helpers  Number of helpers.
	 * @param  string  $vehicle  The vehicle to be used.
	 * @return integer $cost     The calculated cost.
	 */
	public function calculate_transit_cost($floor=null, $distance=0, $helpers=0, $vehicle=null) 
	{
		switch ($vehicle) {
			case 'pickup':
				
				if($floor === 'ground') {
					return $cost = PICKUP_BASE_FARE + ($distance*PICKUP_KM_FARE) + ($helpers*HELPER_GROUND);
				} else if($floor === 'notground') {
					return $cost = PICKUP_BASE_FARE + ($distance*PICKUP_KM_FARE) + ($helpers*HELPER_NOT_GROUND);
				}

			break;

			case 'canter':
				
				if($floor === 'ground') {
					return $cost = CANTER_BASE_FARE + ($distance*CANTER_KM_FARE) + ($helpers*HELPER_GROUND);
				} else if($floor === 'notground') {
					return $cost = CANTER_BASE_FARE + ($distance*CANTER_KM_FARE) + ($helpers*HELPER_NOT_GROUND);
				}

			break;

			case 'fh':
				
				if($floor === 'ground') {
					return $cost = FH_BASE_FARE + ($distance*FH_KM_FARE) + ($helpers*HELPER_GROUND);
				} else if($floor === 'notground') {
					return $cost = FH_BASE_FARE + ($distance*FH_KM_FARE) + ($helpers*HELPER_NOT_GROUND);
				}

			break;
			
			default:
				//we shouldn't get here
				$this->index();
			break;
		}
		
	}
}
