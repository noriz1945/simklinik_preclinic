<?php
defined('BASEPATH') or exit('No direct script access allowed');

//load Spout Library
require_once APPPATH . 'third_party/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Home extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        //load model
        $this->load->helper('url');
        $this->load->helper('html');
		$this->load->module('auth');
		$this->auth->check_session();
		$this->load->model('Globalmodel', 'mdl');
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    }

    public function index()
    {
        $username               = @$this->session->userdata['sp']->username;
        $idrole                 = @$this->session->userdata['sp']->id_role;
        $datet                  = date('Y-m-d H:i:s');

        $datamv = array(
			'username'	=> $username,
            'idrole'    => $idrole
        );

        $this->load->view('vhome', $datamv);
    }

    public function data_poli_umum(){
        $tgl_1_set                  = $this->input->post('tgl_1');
        if($tgl_1_set==""){
            $tgl_1 = DATE('Y-m-d');
        }else{
            $tgl_1 = $tgl_1_set;
        }
        $data   = $this->mdl->getdatapoliumum7($tgl_1);
        $datasend = json_encode($data);
        echo $datasend;
    }

    
    public function data_penjualan_obat(){
        $tgl_1_set                  = $this->input->post('tgl_1');
        if($tgl_1_set==""){
            $tgl_1 = DATE('Y-m-d');
        }else{
            $tgl_1 = $tgl_1_set;
        }
        $data   = $this->mdl->getdatapenjualanobat($tgl_1);
        $datasend = json_encode($data);
        echo $datasend;
    }


    function graphmanajemen_3(){
        $tgl_1_set                  = $this->input->post('set_1');
        $tgl_2_set                  = $this->input->post('set_2');
        if($tgl_1_set==""){
            $tgl_1 = DATE('m');
        }else{
            $tgl_1 = $tgl_1_set;
        }

        if($tgl_2_set==""){
            $tgl_2 = DATE('Y');
        }else{
            $tgl_2 = $tgl_2_set;
        }
        $datadashboard                   = $this->mdl->getdatapoliumum7_range($tgl_1,$tgl_2);
        $datasend = json_encode($datadashboard);
        echo $datasend;
      }

      function graphmanajemen_4(){
        $tgl_1_set                  = $this->input->post('set_1');
        $tgl_2_set                  = $this->input->post('set_2');
        if($tgl_1_set==""){
            $tgl_1 = DATE('m');
        }else{
            $tgl_1 = $tgl_1_set;
        }

        if($tgl_2_set==""){
            $tgl_2 = DATE('Y');
        }else{
            $tgl_2 = $tgl_2_set;
        }
        $datadashboard                   = $this->mdl->getdatapenjualanobat_range($tgl_1,$tgl_2);
        $datasend = json_encode($datadashboard);
        echo $datasend;
      }
}
