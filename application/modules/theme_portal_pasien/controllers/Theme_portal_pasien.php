<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Theme_portal_pasien extends MX_Controller {

	function __construct() {
		parent::__construct();
		//modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('FormGenerator');
    $this->load->model('Theme_portal_pasien_model','mdl');
	}

	public function index()
	{
		$this->load->view('vwrapper_open');
  }
  
}