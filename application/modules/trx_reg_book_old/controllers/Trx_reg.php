<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_reg extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trx_reg_model');
		$this->load->library('FormGenerator');
    }

    public function index()
    {
		$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'trx_reg_book/trx_reg/?q=' . urlencode($q);
			$config['first_url'] = base_url() . 'trx_reg_book/trx_reg/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'trx_reg_book/trx_reg/';
            $config['first_url'] = base_url() . 'trx_reg_book/trx_reg/';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Trx_reg_model->total_rows($q);
        $trx_reg = $this->Trx_reg_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'trx_reg_data' 	=> $trx_reg,
            'q' 			=> $q,
            'pagination' 	=> $this->pagination->create_links(),
            'total_rows' 	=> $config['total_rows'],
            'start' 		=> $start,
        );
        $this->load->view('trx_reg_list', $data);
    }
	
	public function tab_reg()
    {
		$data = array(
		
        );
	    $this->load->view('tab_reg', $data);
    }
	
	public function inner_pasien_lama_list()
    {
	    $this->load->view('inner_pasien_lama_list');
    }

	public function listdata_inner_pasienlama(){
		$id_dokter	= $this->input->post('set_id_dokter');
		$tgl_slot 	= $this->input->post('set_tgl_slot');
		$id_pasien 	= $this->input->post('set_cr_id_pasien');
		$nama 		= $this->input->post('set_cr_nama');
		$nik 		= $this->input->post('set_cr_nik');
		$birthdate 	= $this->input->post('set_cr_birthdate');
		
		$mst_pasien = $this->Trx_reg_model->get_last_pasien(100,$id_dokter,$tgl_slot,$id_pasien,$nama,$nik,$birthdate);
		echo json_encode($mst_pasien);
	}
	
	public function inner_pasien_lama_reg($id_pasien) 
    {
		#$this->output->enable_profiler(true);
		$row = $this->Trx_reg_model->get_pasien_by_id($id_pasien);
		$row->id_reg = '';
		$row->diag = '';
		$row->penanggung = '';
		$row->penanggung = '';
		$row->id_asuransi = '0001';
		$row->asuransi = 'TUNAI';
		$row->card_id = '';
		$row->note = '';
		$sql_id_dokter_prt1 = "SELECT a.id_dokter,a.name FROM mst_dokter a ORDER BY a.name";
		$data = array(
			'button' 	=> 'Create',
			'action' 	=> site_url('trx_reg_book/trx_reg/create_action'),
			'row'		=> $row, 
			'dropdown_id_dokter_prt1' => $this->formgenerator->get_dropdown('id_dokter_prt1',$sql_id_dokter_prt1,'')
		);
		
        $this->load->view('inner_pasien_lama_reg', $data);
		#$this->parser->parse('trx_reg_form', $data);
    }
	
    public function create($id_pasien) 
    {
		#$this->output->enable_profiler(true);
		$row = $this->Trx_reg_model->get_pasien_by_id($id_pasien);
		$row->id_reg = '';
		$row->diag = '';
		$row->penanggung = '';
		$row->penanggung = '';
		$row->id_asuransi = '0001';
		$row->asuransi = 'TUNAI';
		$row->card_id = '';
		$row->note = '';
		$sql_id_dokter_prt1 = "SELECT a.id_dokter,a.name FROM mst_dokter a ORDER BY a.name";
		$data = array(
			'button' 	=> 'Create',
			'action' 	=> site_url('trx_reg_book/trx_reg/create_action'),
			'row'		=> $row, 
			'dropdown_id_dokter_prt1' => $this->formgenerator->get_dropdown('id_dokter_prt1',$sql_id_dokter_prt1,'')
		);
		
        $this->load->view('trx_reg_form', $data);
		#$this->parser->parse('trx_reg_form', $data);
    }
    
    public function create_action() 
    {
			
            $data = array(
				//'regdate' 			=> date('Y-m-d H:i:s'),
				'id_pasien' 		=> $this->input->post('id_pasien',TRUE),
				'id_dokter' 		=> $this->input->post('id_dokter',TRUE),
				'diag' 				=> $this->input->post('diag',TRUE),
				'id_asuransi' 		=> $this->input->post('id_asuransi',TRUE),
				'note' 				=> $this->input->post('note',TRUE),
				'penanggung' 		=> $this->input->post('penanggung',TRUE),
				'card_id' 			=> $this->input->post('card_id',TRUE),
				'slot'				=> $this->input->post('slot_booknyah_set',TRUE),
				'jam_slot'			=> $this->input->post('jamslot_booknyah_set',TRUE),
				'tanggal'			=> $this->input->post('tanggalslot_booknyah_set',TRUE),
				'created'			=> date('Y-m-d H:i:s')

	    	);
			$data = $data;
			$this->Trx_reg_model->insert($data);
			$datarespon = "ok";
			echo json_encode($datarespon);
    }

	public function create_action_checkin() 
    {
		$id_reg 		= $this->Trx_reg_model->get_new_id_reg();
		$id_pasien		= $this->input->post('id_pasien');
		$slot 			= $this->input->post('slot_booknyah_set');
		$tanggal_slot 	= $this->input->post('tanggalslot_booknyah_set');
            $data = array(
				'id_reg'			=> $id_reg,
				'regdate' 			=> date('Y-m-d H:i:s'),
				'id_pasien' 		=> $this->input->post('id_pasien',TRUE),
				'id_dokter_prt1' 	=> $this->input->post('id_dokter',TRUE),
				'diag' 				=> $this->input->post('diag',TRUE),
				'id_asuransi' 		=> $this->input->post('id_asuransi',TRUE),
				'note' 				=> $this->input->post('note',TRUE),
				'penanggung' 		=> $this->input->post('penanggung',TRUE),
				'card_id' 			=> $this->input->post('card_id',TRUE),
				'slot_book'			=> $this->input->post('slot_booknyah_set',TRUE),//hilangkan jika tidak perlu
				'tanggal_book'		=> $this->input->post('tanggalslot_booknyah_set',TRUE),//hilangkan jika tidak perlu
				'created'			=> date('Y-m-d H:i:s')

	    	);
			$data = $data;
			$this->Trx_reg_model->insert_checkin($data);

			$data = array(  
				'id_reg'          	   => $id_reg,
				'sudah_checkin'  	   => 1
			);
		
			$where = array(
				'id_pasien'				=> $id_pasien,
				'slot'                  => $slot,
				'tanggal'               => $tanggal_slot
			);
		 
			$this->Trx_reg_model->update_trx_book($where, $data,'trx_reg_book');

			$datarespon = "ok";
			echo json_encode($datarespon);
    }
    
    public function _rules() 
    {
		$this->form_validation->set_rules('id_dokter_prt1', 'id dokter prt1', 'trim|required');
		$this->form_validation->set_rules('id_reg', 'id_reg', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

	public function inner_get_data_autocomplete_id_asuransi()
	{
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_company AS idx,a.`name` AS label
				FROM 	mst_company a
				WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'
						AND a.aktif = 1
				";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
		}
		$data = json_encode($rs);
		echo $data;
	}


	public function inner_pasien_checkin_list()
    {
		$id_pasien = $this->input->post('cr_id_pasien');
		$nama = $this->input->post('cr_nama');
		$nik = $this->input->post('cr_nik');
		$birthdate = $this->input->post('cr_birthdate');
		
		$mst_pasien = $this->Trx_reg_model->get_checkin_pasien(100,$id_pasien,$nama,$nik,$birthdate);
		$data = array(
            'mst_pasien_data' 	=> $mst_pasien,
        );
	    $this->load->view('inner_pasien_checkin_list', $data);
    }


	public function inner_pasien_lama_reg_checkin($id_pasien) 
    {
		#$this->output->enable_profiler(true);
		$row = $this->Trx_reg_model->get_pasien_by_id($id_pasien);
		$row->id_reg = '';
		$row->diag = '';
		$row->penanggung = '';
		$row->penanggung = '';
		$row->id_asuransi = '0001';
		$row->asuransi = 'TUNAI';
		$row->card_id = '';
		$row->note = '';
		$sql_id_dokter_prt1 = "SELECT a.id_dokter,a.name FROM mst_dokter a ORDER BY a.name";
		$data = array(
			'button' 	=> 'Create',
			'action' 	=> site_url('trx_reg_book/trx_reg/create_action_checkin'),
			'row'		=> $row, 
			'dropdown_id_dokter_prt1' => $this->formgenerator->get_dropdown('id_dokter_prt1',$sql_id_dokter_prt1,'')
		);
		
        $this->load->view('inner_pasien_lama_reg_checkin', $data);
		#$this->parser->parse('trx_reg_form', $data);
    }

}

?>
