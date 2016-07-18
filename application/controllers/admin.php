<?php if(!defined('BASEPATH')) exit("Acess Denied");
/*
** 
*/
class Admin extends Active_Controller
{	
	public function __construct()
	{
		parent::__construct();
	}
	public function index($page='stats')
	{
		if(!$this->dashboard->isadmin()) redirect('admin/login');
		if($page)
		{
			$this->load->view('admin/dashboard/welcome',array('page' => $page, 'data' => $this->getdata($page),'feedback' => null));		
		}
		else
		{
			$this->logout();
		}
	}
	public function getdata($page)
	{
		switch ($page) 
		{
			case 'stats':
				return $this->dashboard->filterreports($data=null);
				break;

			case 'requests':
				return $this->dashboard->getrequests();
				break;
			
			default:
				return null;
				break;
		}
	}
	public function login()
	{
		$data = $this->input->post();
		if($data)
		{
			$this->dashboard->login($data);
		}
		else
		{
			$this->load->view('admin/dashboard/login');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('admin/login'));
	}
	public function removerequest($id)
	{
		if(is_numeric($id))
		{
			$this->dashboard->removerequest($id);
			redirect(base_url('admin/index/requests'));
		}
	}
	public function updaterequest()
	{
		$data = $this->input->post();
		if($data)
		{
			$this->dashboard->updaterequest($data);
			$this->getrequestcontent($this->uri->segment(3));
		}
	}
	public function getrequestcontent($id=null)
	{
		$this->load->view('admin/dashboard/request-modal-content',array('data' => $this->dashboard->getrequestcontent($id)));
	}
	public function filterrequests()
	{
		$data = $this->input->post();
		if($data)
		{
			$this->load->view('admin/dashboard/requests-view',array('data' => $this->dashboard->filterrequests($data)));
		}
	}
	public function filterreports()
	{
		$data = $this->input->post();
		if($data)
		{
			$this->load->view('admin/dashboard/welcome',array('page' => 'stats', 'data' => $this->dashboard->filterreports($data),'feedback' => null));		
		}
	}
}