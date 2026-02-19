<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {
	var $session_name = 'sp';
	function __construct()
	{
			parent::__construct();
			#if($session_name!='') $this->check_session($session_name);
			$this->load->model('Models_auth');
			$this->load->library('session');
			$this->load->helper('url');
			$this->load->helper('html');
			$this->load->library('encryption');
	}
	
	function check_session()
	{
		$ok = $this->session->has_userdata($this->session_name);
		if(!$ok)
			redirect('auth/login');
	}
	
	function login()
	{
		$this->load->view('vlogin');
	}
	
	function do_login()
	{
		#$this->output->enable_profiler(TRUE);
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		
		$sql = "SELECT 	a.* 
						FROM 		mst_nav_user a
						WHERE		a.login_name='".$username."' AND a.login_pass='".$password."'
						";
		$query = $this->db->query($sql);
		$row = $query->row();
		

		if (!isset($row))
		{
			$this->session->set_flashdata('message', 'Login gagal, silahkan coba lagi');
			redirect('auth/login');
		}

		//jika role id nya selain 1 (admin)
		if($username==$row->login_name && $password==$row->login_pass)
		{
			$row_new = $row;				
			$this->session->set_userdata($this->session_name,$row_new);
			// FUNGSI akses level here
			#print_r($this->session->userdata['bo']);
			#die();
			$is_role = $row_new->id_role;
			if(!empty($is_role))
				redirect('home');
			else
				redirect('home');
	
		}
		else
			echo 'Login gagal';
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect();
	}
     //end task item

	
}
