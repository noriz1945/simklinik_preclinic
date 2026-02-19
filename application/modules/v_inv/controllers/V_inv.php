<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V_inv extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('V_inv_model');
		$this->load->library('FormGenerator');
    }

    public function index()
    {
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;
		
        $periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;
        
		$id_dokter = $this->input->post('id_dokter');
        $v_inv = $this->V_inv_model->get_limit_data($periode_start,$periode_end,$id_dokter);
		
		$sql_id_dokter = "	SELECT 	a.id_dokter,a.name AS name
							FROM 	mst_dokter a
							WHERE	a.id_jenis=1
							ORDER BY a.name";
						
        
		$data = array(
            'v_inv_data' 			=> $v_inv,
            'periode_start' 		=> $periode_start,
			'periode_end' 			=> $periode_end,
			'num_rows'				=> count($v_inv),
			'dropdown_id_dokter' 	=> $this->formgenerator->get_dropdown('id_dokter',$sql_id_dokter,$id_dokter),
        );
        $this->load->view('v_inv_list', $data);
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
