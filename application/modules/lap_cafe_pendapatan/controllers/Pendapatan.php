<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pendapatan extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pendapatan_model');
    }

	
	public function index()
	{
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;

		$periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;

		$dp_data = $this->Pendapatan_model->get_data_dp_all($periode_start,$periode_end);

		$data = array(
			'dp_data' 			=> $dp_data,
			'periode_start' => $periode_start,
			'periode_end' 	=> $periode_end,
			'num_rows'			=> count($dp_data),
		);
		$this->load->view('v_pendapatan', $data);
	}

}



?>
