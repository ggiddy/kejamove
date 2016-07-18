<?php defined('BASEPATH') or exit ('Access Denied!');
/**
* 
*/
class Dashboard_model extends Core_model
{	
	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
	{

	}

	public function requests()
	{
		
	}
	public function login($data)
	{
		if($this->validate(array('field' => 'email', 'value' => $data['email'])))
		{
			$user = $this->where(array('table' => 'admin','conditions' => array('email' => $data['email'],'password' => md5($data['password']))));
			if($user)
			{
				$user = array_pop($user);
				$this->session->set_userdata(array('id' => $user->id,'admin' => $user->admin));
				redirect(base_url('admin'));
			}
			else
			{
				echo
					'Wrong email or password,try again'.
					'<script>'.
						"setTimeout(function(){
							window.location='/admin/login';
						},2000);".
					'</script>';
			}
		}
		else
		{
			exit('Access Denied! Wrong email, try again');
		}
	}
	public function isadmin()
	{
		if(!$this->session->userdata('admin'))
		{
			return false;
		}
		else return true;
	}
	public function getrequests()
	{		
		$requests['new'] =  $this->where(array('table' => 'moverequests','conditions' => array('status' => 'New')));
		$requests['scheduled'] =  $this->where(array('table' => 'moverequests','conditions' => array('status' => 'Scheduled')));
		$requests['completed'] =  $this->where(array('table' => 'moverequests','conditions' => array('status' => 'Completed')));
		$requests['failed'] =  $this->where(array('table' => 'moverequests','conditions' => array('status' => 'Failed')));
		return $requests;
	}
	public function removerequest($id)
	{
		$this->remove_one(array('table' => 'moverequests','field' => 'id','var' => $id));		
	}
	public function updaterequest($data)
	{
		$request = array('status' => $data['status'],'cost' => $data['cost'],'phone' => $data['phone']);
		$user = array('phone' => $data['phone'],'email' => $data['email'],'firstname' => $data['name']);
		$this->edit_one(array('table' => 'moverequests','data' => $request,'field' => 'id','var' => $this->uri->segment(3)));
		$this->edit_one(array('table' => 'users','data' => $user,'field' => 'id','var' => $this->uri->segment(4)));
	}
	public function isspot()
	{
		if(strpos(current_url(), '/admin/index/requests'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function getrequestcontent($id)
	{
		return $this->get_one(array('table' => 'moverequests','field' => 'id','var' => $id));
	}
	public function getuser($id)
	{
		return $this->get_one(array('table' => 'users','field' => 'id', 'var' => $id));
	}
	public function filterrequests($data)
	{
		if(!empty($data['phone']))
		{
			$this->db->like('phone',$data['phone'],'both');
		}
		if(!empty($data['startdate']))
		{
			$start = strtotime($data['startdate']);
			$this->db->where('created >',$start);
		}
		if(!empty($data['enddate']))
		{
			$end = strtotime($data['enddate']);
			$this->db->where('created <',$end);
		}
		$this->db->order_by('id','desc');
		return $this->db->get('moverequests')->result();	
	}
	public function filterreports($data)
	{
		if(!empty($data['startdate']))
		{
			$start = strtotime($data['startdate']);
			$this->db->where('created >',$start);
		}
		if(!empty($data['enddate']))
		{
			$end = strtotime($data['enddate']);
			$this->db->where('created <',$end);
		}
		$this->db->from('moverequests');
		$requests['all'] = count($this->db->get()->result());
		$requests['scheduled'] = $this->countstatus('Scheduled',$data);
		$requests['completed'] = $this->countstatus('Completed',$data);
		$requests['failed'] = $this->countstatus('Failed',$data);
		if($requests['completed'] > 0)
		{
			$requests['c_rate'] = ceil($requests['all'] / ($requests['completed'] * 100));
		}
		else
		{
			$requests['c_rate'] = 0;
		}
		return $requests;
	}
	public function countstatus($status,$data)
	{
		if(!empty($data['startdate']))
		{
			$start = strtotime($data['startdate']);
			$this->db->where('created >',$start);
		}
		if(!empty($data['enddate']))
		{
			$end = strtotime($data['enddate']);
			$this->db->where('created <',$end);
		}
		$this->db->where('status',$status);
		return count($this->db->get('moverequests')->result());
	}
}