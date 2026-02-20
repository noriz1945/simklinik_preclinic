<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V_inv_farm extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('V_inv_farm_model');
		$this->load->library('FormGenerator');
    }

    public function index()
    {
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;
		
        $periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;
        
        $v_inv_farm = $this->V_inv_farm_model->get_limit_data($periode_start,$periode_end);
		$curr_id_reg = '';
		$i = 1;
		foreach ($v_inv_farm as $k => $v)
		{
			if($curr_id_reg != $v->id_reg)
			{
				$v_inv_farm[$k]->nomor = $i;
				$v_inv_farm[$k]->id_reg_text = $v->id_reg;
				
				$curr_id_reg = $v->id_reg;
				$i++;
			}
			else
			{
				$v_inv_farm[$k]->nomor = '';
				$v_inv_farm[$k]->nama_pasien = '';
				$v_inv_farm[$k]->id_pasien = '';
				$v_inv_farm[$k]->id_reg_text = '';
				$v_inv_farm[$k]->tgl_reg = '';
				$v_inv_farm[$k]->reg_text = '';
				$v_inv_farm[$k]->asuransi = '';
			}
		}
        $data = array(
            'v_inv_farm_data' 	=> $v_inv_farm,
            'periode_start' => $periode_start,
			'periode_end' 	=> $periode_end,
			'num_rows'		=> $i-1,
        );
        $this->load->view('v_inv_farm_list', $data);
    }

    
	function pdf()
	{
			$q = $this->input->get('q', TRUE);      
			$start = intval($this->input->get('start'));
			
			$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
			$config['page_query_string'] = FALSE;
			$config['total_rows'] = $this->V_inv_farm_model->total_rows($q);
			$v_inv_farm = $this->V_inv_farm_model->get_limit_data(@$config['per_page'], $start, $q);

			#$this->load->library('pagination');
			#$this->pagination->initialize($config);

			$data = array(
					'v_inv_farm_data' => $v_inv_farm,
					'q' => $q,
					'pagination' => '',
					'total_rows' => $config['total_rows'],
					'start' => $start,
			);
			$this->load->helper('pdf_helper');	
			$this->load->view('v_inv_farm_pdf', $data);
	}
		
	function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;
		
        $periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;
		
		$rs = $this->V_inv_farm_model->get_limit_data($periode_start,$periode_end);
		foreach($rs[0] as $k => $v)
		{
			$fields[] = (object)array('name' => $k);
		}

		foreach($fields as $k => $v)
		{
			$no = $k+1;
			$arrCol[] = array('urutan'=>($no), 'nilai'=>$v->name,'fontsize'=> '12', 'bold'=>true, 'namanya'=>$v->name, 'format'=>'string');
		}
		$arrExcel = array('sNAMESS'=>'sarkodan', 'sFILNAM'=>$parameter,'col'=>$arrCol, 'rsl'=>$rs);
		$this->libexcel->bangunexcel($arrExcel);
	}


}

?>
