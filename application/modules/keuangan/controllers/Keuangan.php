<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuangan extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Keuangan_model');
		$this->load->library('FormGenerator');
    }

    public function tindakan_list()
    {
			$periode_start = $this->input->post('periode_start');
			$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;

			$periode_end = $this->input->post('periode_end');
			$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;

			$id_dokter 	= $this->input->post('id_dokter');
			$id_act 		= $this->input->post('id_act');
			
			$tindakan_data = $this->Keuangan_model->get_data_tindakan($periode_start,$periode_end,$id_dokter,$id_act);

			$sql_id_dokter = "	SELECT 	a.id_dokter,a.name AS name
							FROM 	mst_dokter a
							WHERE	a.id_jenis=1
							ORDER BY a.name";
			
			$sql_id_act = "	SELECT 	a.id_act,a.name AS name
							FROM 	mst_tindakan a
							ORDER BY a.name";
						#print_r($tindakan_data);
			$data = array(
				'tindakan_data' 		=> $tindakan_data,
				'periode_start' 			=> $periode_start,
				'periode_end' 				=> $periode_end,
				'num_rows'						=> count($tindakan_data),
				'dropdown_id_dokter'	=> $this->formgenerator->get_dropdown('id_dokter',$sql_id_dokter,$id_dokter),
				'dropdown_id_act' 		=> $this->formgenerator->get_dropdown('id_act',$sql_id_act,$id_act),
      );
      $this->load->view('v_tindakan_list', $data);
    }

    
	function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->V_inv_model->total_rows($q);
				$v_inv = $this->V_inv_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'v_inv_data' => $v_inv,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('v_inv_pdf', $data);
		}
		
	function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;
		
        $periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;
		
		$rs = $this->V_inv_model->get_limit_data($periode_start,$periode_end);
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
