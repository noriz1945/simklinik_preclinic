<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Epoli extends MX_Controller {
	var $session_name='sp';
	var $cetak_modal = false;

	function __construct() {
		parent::__construct();
		modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		#if($session_name !='') $this->check_session($session_name);
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');

		$this->load->model('Epoli_model');
  }

  public function erm_poli()
  {
    $this->make_bread->add('Dokter', '', 1);
    $this->make_bread->add('e-Poliklinik', '', 0);
    $breadcrumb = $this->make_bread->output();
    $data=array(
			'breadcrumb'	=> $breadcrumb,
		);
    $this->load->view('vsoap_epoli',$data);
  }

  public function erm_poliklinik()
  {
    $this->make_bread->add('Dokter', '', 1);
    $this->make_bread->add('e-Poliklinik', '', 0);
    $breadcrumb = $this->make_bread->output();
    $data=array(
			'breadcrumb'	=> $breadcrumb,
		);
    $this->load->view('verm_poli',$data);
  }
  
}