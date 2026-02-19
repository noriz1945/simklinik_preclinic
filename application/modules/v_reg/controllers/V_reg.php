<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V_reg extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('V_reg_model');
		$this->load->library('FormGenerator');
    }

    public function index()
    {
        // =============================
        // PERIODE
        // =============================
        $periode_start = $this->input->post('periode_start');
        $periode_start = ($periode_start == '') ? date('Y-m-d') : $periode_start;
    
        $periode_end = $this->input->post('periode_end');
        $periode_end = ($periode_end == '') ? date('Y-m-d') : $periode_end;
    
        // =============================
        // DOKTER (FILTER)
        // =============================
        $id_dokter = $this->input->post('id_dokter');
    
        // =============================
        // DATA REGISTRASI
        // =============================
        $v_reg = $this->V_reg_model->get_limit_data(
            $periode_start,
            $periode_end,
            $id_dokter
        );
    
        // =============================
        // DROPDOWN DOKTER
        // =============================
        $sql_id_dokter = "
            SELECT  a.id_dokter,
                    a.name AS name
            FROM    mst_dokter a
            WHERE   a.id_jenis = 1
            ORDER BY a.name
        ";
    
        // generate dropdown dari formgenerator
        $dropdown_id_dokter = $this->formgenerator->get_dropdown(
            'id_dokter',
            $sql_id_dokter,
            $id_dokter
        );
    
        // =============================
        // VIEW
        // =============================
        $data = array(
            'v_reg_data'          => $v_reg,
            'periode_start'      => $periode_start,
            'periode_end'        => $periode_end,
            'num_rows'           => count($v_reg),
            'dropdown_id_dokter' => $dropdown_id_dokter,
        );
    
        $this->load->view('v_reg_list', $data);
    }


    
	function pdf()
	{
			$q = $this->input->get('q', TRUE);      
			$start = intval($this->input->get('start'));
			
			$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
			$config['page_query_string'] = FALSE;
			$config['total_rows'] = $this->V_reg_model->total_rows($q);
			$v_reg = $this->V_reg_model->get_limit_data(@$config['per_page'], $start, $q);

			#$this->load->library('pagination');
			#$this->pagination->initialize($config);

			$data = array(
					'v_reg_data' => $v_reg,
					'q' => $q,
					'pagination' => '',
					'total_rows' => $config['total_rows'],
					'start' => $start,
			);
			$this->load->helper('pdf_helper');	
			$this->load->view('v_reg_pdf', $data);
	}
		
	function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		
		$periode_start = $this->input->post('periode_start');
		$periode_start = ($periode_start=='')?date('Y-m-d'):$periode_start;
		
        $periode_end = $this->input->post('periode_end');
		$periode_end = ($periode_end=='')?date('Y-m-d'):$periode_end;
		
		$rs = $this->V_reg_model->get_limit_data($periode_start,$periode_end);
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
