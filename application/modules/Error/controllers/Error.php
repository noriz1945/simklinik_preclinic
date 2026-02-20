<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends MX_Controller {
	//var $session_name='sgs';

	function __construct() {
		parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');
	}

	public function index()
	{
    $this->load->view('verror404');
  }
}