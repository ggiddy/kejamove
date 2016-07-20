<?php if(!defined('BASEPATH')) exit('Access Denied');
require_once 'user_model.php';
class Users_model extends User_model
{
	public function __construct(array $data = array(), $save=false)
	{
		parent::__construct($data, $save);
	}

	/**
	 *set_attributes
	 *
	 *@access public
	 *@return $this Active_model, current object to allow chaining
	 */
	public function set_attributes(array $attributes)
	{
		if(array_key_exists('fullname', $attributes))
		{
			$fullname=explode(' ', $attributes['fullname']);
			$attributes['firstname']=array_shift($fullname);
			$attributes['lastname']=array_shift($fullname);
		}

		return parent::set_attributes($attributes);
	}


	/**
	 *edit_user
	 *
	 *@access public
	 *@return bool, operation status
	 */
	public function edit_user(array $settings, $user=null)
	{
		if($user) $this->id=$user;

		$user=$this->get_user($this->id);

		$user->set_attributes($settings);

		return $user->update();
	}

	/**
	 *save_setting
	 *
	 *@access public
	 *@return $result bool, operation status
	 */
	public function save_settings($settings, $user=null)
	{
		$this->load->model('users_info_model', 'user_settings');

		if($user) $this->id = $user;

		return $this->user_settings->save_settings($settings, $this->id);
	}

	/**
	 *setting
	 *
	 *@access public
	 *@return mixed, value of user setting variable
	 */
	public function setting($setting, $user=null)
	{
		if($user) $this->id = $user;

		$this->load->model('users_info_model', 'user_settings');

		$setting = array_pop($this->user_settings->where(array(
			'users'=>$user,
			'name'=>$setting
		))->results());

		if($setting) return $setting->value;
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
			$this->load->model('users_info_model', 'user_settings');

			$setting = array_pop($this->user_settings->where(array(
				'users'=>$this->id,
				'name'=>$info
			))->results());
		}

		if($setting) return $setting->value;
	}

	/**
	 *send_email
	 *
	 *@access public
	 *@return array, results
	 */
	public function send_email(array $email, $user=null)
	{
		if($user)$this->id=$user;

		if($user=$this->get_user($this->id))
		{	
			$CI = &get_instance(); $email_client=$CI->email;
			$email_client->clear();
			$email_client->from($email['from'], $email['subject']);
			$email_client->to($user->email);
			$email_client->reply_to($email['reply_to']);
			$email_client->subject($email['subject']);
			$email_client->message($email['message']);

			if(array_key_exists('cc', $email)) $email_client->to($email['cc']);

			return $email_client->send();
		}

		return false;
	}

	/**
	 *text_user
	 *
	 *@access public
	 *@return array, results
	 */
	public function send_text(array $message, $user=null)
	{
		return true;
	}	

	/**
	 *send_whatsapp_text
	 *
	 *@access public
	 *@return array, results
	 */
	public function send_whatsapp_text(array $message, $user=null)
	{
		return true;
	}

	/**
	 *get_activation_code
	 *
	 *@access public
	 *@param user mixed, user details
	 *@return code string, random md5 based on email and current system time code
	 */
	public function get_activation_code($user)
	{
		if(is_array($user))
		{
			$email = $user['email'];
		}
		elseif($user instanceof Active_Model)
		{
			$email = $user->email;
		}

		return md5($email.time());
	}

	/**
	 *get_activation_expiry
	 */
	public function get_activation_expiry()
	{
		return (time()+(7*24*60*60));
	}

	/**
	 *create_account
	 *
	 *@access public
	 *@return array, results
	 */
	public function create_account(array $user, array $account)
	{	
		if(array_key_exists('password', $user) && $user['password'])
		{
			if(array_key_exists('c_password', $user) && $user['c_password']==$user['password'])
			{
				$user['password'] = md5($user['password']);
			}
			else
			{
				return array_merge($user, array(
					'error'=>true,
					'message'=>'Passwords do not match'
				));
			}
		}

		if(array_key_exists('fullname', $user))
		{
			$fullname=explode(' ', $user['fullname']);
			$user['firstname']=array_shift($fullname);
			$user['lastname']=array_shift($fullname);
		}

		$user = array_merge($user, array(
			'status'=>'inactive',
			'type'=>'admin',
			'activation_code'=>$this->get_activation_code($user),
			'activation_expiry'=>$this->get_activation_expiry(),
			'created'=>time()
		));

		if(array_key_exists('company', $account) && $account['company'])
		{
			if(array_key_exists('accepts_terms', $account) && $account['accepts_terms']==='yes')
			{
				$result = $this->add_one($user);

				if(false === $result['error'])
				{
					$user_id=$result['id']; 

					$result = $this->save_settings($account, $user_id);

					if(false === $result['error'])
					{
						$result['message'] = 'Account created successfully';
					}
					else
					{
						$this->remove_one($user_id);

						$result['message'] = 'Error saving account. Please try again later';
					}
				}
			}
			else
			{
				$result['message'] = 'You have to accept the terms and conditions';
				$result['error']=true;
			}
		}
		else
		{
			$result['message'] = 'Please provide a company name';
			$result['error']=true;
		}

		return array_merge($result, $user);
	}


	/**
	 *send_account_activation_code
	 *
	 *@access public
	 *@return array, results
	 */
	public function send_account_activation_code(array $user)
	{
		$params = $user;

		$user = array_pop($this->where($params)->results());

		if($user)
		{
			if($user->status !== 'active')
			{
				$user->activation_code = $this->get_activation_code($user);
				$user->activation_expiry = $this->get_activation_expiry();

				$result = $user->update();

				if(false === $result['error'])
				{
					$result['message'] = 'Activation code sent to your email successfully!';
				} 

				return $result;
			}
			else
			{
				return array(
					'error'=>true,
					'message'=>'Account already activated. Please login or request a password reset'
				);
			}
		}

		return array(
			'error'=>true,
			'message'=>'Account doesn\'t exist'
		);
	}

	/**
	 *activate_account
	 *
	 *@access public
	 *@return array, results
	 */
	public function activate_account($code)
	{
		$params = array('activation_code'=>$code);

		$user = array_pop($this->where($params)->results());

		if($user)
		{
			$user->status = 'active';

			$result = $user->update();

			return $result;
		}

		return array(
			'error'=>true,
			'message'=>'Account doesn\'t exist'
		);
	}

	/**
	 *deactivate_account
	 *
	 *@access public
	 *@return array, results
	 */
	public function deactivate_account(array $user)
	{
		$params = $user;

		$user = array_pop($this->where($params)->results());

		if($user)
		{
			$user->status = 'inactive';

			$result = $user->update();

			if(false === $result['error'])
			{
				return $result;
			} 
		}

		return array(
			'error'=>true,
			'message'=>'Account doesn\'t exist'
		);
	}

	/**
	 *suspend_account
	 *
	 *@access public
	 *@return array, results
	 */
	public function suspend_account(array $user)
	{
		$params = $user;

		$user = array_pop($this->where($params)->results());

		if($user)
		{
			$user->status = 'suspended';

			$result = $user->update();

			if(false === $result['error'])
			{

				return $result;
			} 
		}

		return array(
			'error'=>true,
			'message'=>'Account doesn\'t exist'
		);
	}

	/**
	 *send_password_reset_link
	 *
	 *@access public
	 *@return array, results
	 */
	public function send_account_password_reset_link(array $user)
	{
		$params = $user; $user = array_pop($this->where($params)->results());

		if($user)
		{
			if($user->status==='active')
			{
				$link_code = md5(date('Y-m-d H:i:s').$user->email.time());

				$user->preset_code = $link_code;

				$user->preset_expiry = $this->get_activation_expiry();

				$result = $user->update();

				if(false === $result['error'])
				{
					$email_sent = $this->send_email(array(
					   'from'=>$this->config->item('app-noreply-email'),
					   'subject'=>'SecureFood Password Reset',
					   'message'=>$this->load->view('email/accounts/password-reset', array(
					   		'fullname'=>$user->get_fullname(),
					   		'activation_code'=>$link_code
					   ), true),
					   'reply_to'=>$this->config->item('app-noreply-email')
					), $user->id);

					if($email_sent)
					{

						return array(
							'error'=>false,
							'message'=>'Password reset link sent successfully to your email'
						);
					}
				}
			}
			else
			{
				return array(
					'error'=>true,
					'message'=>'Please activate your account first. Click on the link sent to your email'
				);
			}
		}

		return array(
			'error'=>true,
			'message'=>'Error. Invalid user, please try again'
		);
	}

	/**
	 *password_change_code_exists
	 *
	 *@access public
	 *@return array, results
	 */
	public function password_change_code_exists($code)
	{
		$user = array_pop($this->where(array(
			'preset_code'=>$code
		))->results());

		if($user && $user->preset_code)
		{
			//add preset code expiry logic here

			return array(
				'error'=>false
			);
		}

		return array(
			'error'=>true,
			'message'=>'Error. Invalid user, please try again'
		);
	}

	/**
	 *change_account_password
	 *
	 *@access public
	 *@return array, results
	 */
	public function change_account_password(array $user)
	{
		$params = $user;
		
		if(array_key_exists('email', $params) && $params['email'])
		{
			if(array_key_exists('password', $params) && !$this->is_empty($params['password']))
			{
				if(array_key_exists('password', $params) 
					&& $params['c_password']==$params['password'])
				{
					$s_params=array(
						'email'=>$params['email'],
						'preset_code'=>$params['preset_code']
					);

					$user = array_pop($this->where($s_params)->results());

					if($user)
					{
						if($user->status === 'active')
						{
			
							$user->password = md5($params['password']);

							$result = $user->update();

							if(false === $result['error'])
							{	
								return array(
									'error'=>false,
									'message'=>'Password changed successfully'
								);
							}
							else
							{
								return $result;
							}
						}
						else
						{
							return array(
								'error'=>true,
								'message'=>'Please activate your account first. Click on the link sent to your email'
							);
						}
					}
					else
					{
						return array(
							'error'=>true,
							'message'=>'Error. Invalid user, please try again'
						);
					}
				}
				else
				{
					return array(
						'error'=>true,
						'message'=>'Passwords do not match'
					);
				}
			}
			else
			{
				return array(
					'error'=>true,
					'message'=>'Please enter the new password'
				);
			}
		}
		else
		{
			return array(
				'error'=>true,
				'message'=>'Please enter your account email'
			);
		}
	}



	/**
	 *create_session
	 *
	 *@access public
	 *@return array, results
	 */
	public function create_session()
	{
		$this->session->set_userdata(array(
			'is_signed_in'=>true,
			'uid'=>$this->id,
			'email'=>$this->email,
			'firstname'=>$this->firstname,
			'lastname'=>$this->lastname,
			'username'=>ucwords(strtolower($this->firstname.' '.$this->lastname)),
			'user_type'=>$this->get_setting('type'),
			'last_login'=>$this->lastlogin,
			'account_created'=>$this->created,
			'home_url'=>'dashboard/'.$this->id,
			'profile_pic'=>base_url($this->config->item('app-profile-pics-location').($this->pic ? $this->pic : 'default.png'))
		));
	}


	/**
	 *login_account
	 *
	 *@access public
	 *@return array, results
	 */
	public function login_account(array $user)
	{

		$params = $user; $params['password'] = md5($params['password']);

		$user = array_pop($this->where($params)->results());

		if($user)
		{
			if($user->status === 'active')
			{
				$user->lastlogin = time();

				$user->update(); $user->create_session();

				return array(
					'error'=>false,
					'message'=>'Login successful'
				);
			}
			else
			{
				return array(
					'error'=>true,
					'message'=>'Error. Please activate your account first. Click on the link sent to your email'
				);
			}
		}

		return array(
			'error'=>true,
			'message'=>'Error. Invalid password or email'
		);
	}

	/**
	 *do_naive_login
	 *
	 *@access public
	 *@return array, results
	 */
	public function do_naive_login(array $user)
	{

		$user = array_pop($this->where($user)->results());

		if($user)
		{
			if($user->status === 'active')
			{
				$user->lastlogin = time();

				$user->update(); $user->create_session();

				return array(
					'error'=>false,
					'message'=>'Login successful'
				);
			}
			else
			{
				return array(
					'error'=>true,
					'message'=>'Error. Please activate your account first. Click on the link sent to your email'
				);
			}
		}

		return array(
			'error'=>true,
			'message'=>'Error. Invalid password or email'
		);
	}


	/**
	 *logout_account
	 *
	 *@access public
	 *@return array, results
	 */
	public function logout_account()
	{
		$this->session->sess_destroy();

		return array('error'=>false, 'message'=>'logged out successfully');
	}


	/**
	 *current_user
	 *
	 *@access public
	 *@return mixed, value of session variable
	 */
	public function current_user($session_var)
	{
		if($session_var)
		{
			$value = $this->session->userdata($session_var);

			if($value) return $value;

			return $this->setting($session_var, $this->session->userdata('uid'));
		}
	}

	/**
	 *get_users
	 *
	 *Gets particular users record by search params
	 *
	 *@access public
	 *@param $params array, user search params
	 *@return $results mixed, user model instances or empty arrays
	 */
	public function get_users(array $params=array())
	{
		if(!empty($params)) return $this->where($params)->paged_results();
		return $this->paged_results();
	}

	/**
	 *get_user
	 *
	 *Gets a particular user record by id
	 *
	 *@access public
	 *@param $id int, user id
	 *@return $results mixed, user model instance or null
	 */
	public function get_user($params)
	{
		if(is_numeric($params))$params=array('id'=>$params);

		$results=$this->get_users($params);

		return array_pop($results['results']);
	}


	/**
	 *search_users
	 *
	 *Gets particular users record by search params
	 *
	 *@access public
	 *@param $params array, user search params
	 *@return $results mixed, user model instances or empty arrays
	 */
	public function search_users(array $params)
	{
		$basic=$settings=array();

		foreach ($params as $key => $value)
		{
			if(property_exists(get_class($this), $key))
			{
				$basic[$key]=$value;
			}
			else
			{
				$settings[$key]=$value;
			}
		}

		$basic_matchs=$this->or_where($basic)->results();
		
		$settings_matchs=array();

		$users=$this->where(array('type'=>'professional'))->results();

		foreach($users as $user)
		{
			foreach($settings as $setting=>$value)
			{
				if($user->setting($setting)==$value)
				{
					$settings_match['id-'.$user->id]=$user;
				}
			}
		}

		return array_merge($basic_matchs, $settings_matchs);
	}
}
