<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logistik extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Logistik_model');
    }

	
	public function index()
	{
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;

		$periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;

		$dp_data = $this->Logistik_model->get_data_dp_all($periode_start,$periode_end);

		$data = array(
			'dp_data' 			=> $dp_data,
			'periode_start' => $periode_start,
			'periode_end' 	=> $periode_end,
			'num_rows'			=> count($dp_data),
		);
		$this->load->view('v_logistik', $data);
	}

}



?>
