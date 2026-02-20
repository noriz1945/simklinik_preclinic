<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_paket extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mst_paket_model');
		$this->load->library('FormGenerator');
    }

    public function index()
    {
			$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'mst_paket/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'mst_paket/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'mst_paket/';
            $config['first_url'] = base_url() . 'mst_paket/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Mst_paket_model->total_rows($q);
        $mst_paket = $this->Mst_paket_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);


        $data = array(
            'mst_paket_data' => $mst_paket,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,


        );
        $this->load->view('mst_paket_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Mst_paket_model->get_by_id($id);
				$sql_aktif = "SELECT * FROM template_dummy_reff ORDER BY title";
			
        if ($row) {
            $data = array(
		'id_paket' => set_value('id_paket', $row->id_paket),
		'name' => set_value('name', $row->name),
		'id_type' => set_value('id_type', $row->id_type),
		'duration' => set_value('duration', $row->duration),
		'price' => set_value('price', $row->price),'radio-aktif' => $this->formgenerator->get_radio('aktif',$sql_aktif,$row->aktif),
			
		'created' => set_value('created', $row->created),
		'creator' => set_value('creator', $row->creator),
		'updated' => set_value('updated', $row->updated),
		'updater' => set_value('updater', $row->updater),
	    );
						
            //$this->load->view('mst_paket_read', $data);
						$this->parser->parse('mst_paket_read', $data);
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_paket'));
        }
    }

    public function create() 
    {
		#$this->output->enable_profiler(true);
		$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_penjamin = "	SELECT 'SEMUA' as id,'SEMUA' as name
							UNION ALL 
							SELECT 'TUNAI' as id,'TUNAI' as name
							UNION ALL 
							SELECT 'ASURANSI' as id,'ASURANSI' as name
							";
		$tuslah = $this->Mst_paket_model->get_main_setting_value('rspfee_med_item');
        $data = array(
            'button' 		=> 'Create',
            'action' 		=> site_url('mst_paket/create_action'),
			'id_paket' 		=> set_value('id_paket'),
			'radio-aktif'	=> $this->formgenerator->get_radio('aktif',$sql_aktif,1),
			'radio-penjamin' => $this->formgenerator->get_radio('penjamin',$sql_penjamin,'SEMUA',false,'javascript: return false'),
			'name' 			=> set_value('name'),
			'id_type' 		=> set_value('id_type'),
			'duration' 		=> set_value('duration',1),
			'price' 		=> set_value('price',0),
			'tuslah'		=> $tuslah,
			
			'created' => set_value('created'),
			'creator' => set_value('creator'),
			'updated' => set_value('updated'),
			'updater' => set_value('updater'),
			
			'rs'	=> json_encode(''),
		);
        //$this->load->view('mst_paket_form', $data);
		$this->parser->parse('mst_paket_form', $data);
    }
    
    public function create_action() 
    {
		#$this->output->enable_profiler(true);
		#return;
		
		$id_reg 				= $this->input->post('id_reg');
		$rowno 					= $this->input->post('det_id_act');
		$det_id_group 			= $this->input->post('det_id_group');
		$det_no_kunj 			= $this->input->post('det_no_kunj');
		$det_id_act 			= $this->input->post('det_id_act');
		$det_id_act_txt 		= $this->input->post('det_id_act_txt');
		$det_price_ori 			= $this->input->post('det_price_ori');
		$det_disc_pkt 			= $this->input->post('det_disc_pkt');
		$det_price_pkt 			= $this->input->post('det_price_pkt');
		$det_qty 				= $this->input->post('det_qty');
		$det_price_subtotal_ori = $this->input->post('det_price_subtotal_ori');
		$det_price_subtotal_pkt = $this->input->post('det_price_subtotal_pkt');
		$det_no_kunj 			= $this->input->post('det_no_kunj');
		$det_tuslah 			= $this->input->post('det_tuslah');
		$det_jenis_obat 		= $this->input->post('det_jenis_obat');
		$det_dosis 				= $this->input->post('det_dosis');
		$det_frekwensi 			= $this->input->post('det_frekwensi');
		$det_tme 				= $this->input->post('det_tme');	
		
		$this->db->trans_begin();
		
		$data_mst_paket = array();
		$data_mst_paket['name'] 	= $this->input->post('name');
		$data_mst_paket['duration'] = (($this->input->post('duration')==0)?1:$this->input->post('duration'));
		$data_mst_paket['price'] 	= $this->input->post('price');
		$data_mst_paket['penjamin'] = $this->input->post('penjamin');
		$data_mst_paket['creator'] 	= $this->session->userdata['sp']->name;
		$data_mst_paket['created'] 	= date('Y-m-d H:i:s');
		$new_id_paket = $this->Mst_paket_model->insert('mst_paket',$data_mst_paket);
		
		foreach($det_id_act as $k => $v)
		{
			$data_mst_paket_det = array();
			$data_mst_paket_det['id_paket'] 	= $new_id_paket;
			$data_mst_paket_det['id_group'] 	= $det_id_group[$k];
			$data_mst_paket_det['id_trx_det'] 	= $det_id_act[$k];
			$data_mst_paket_det['price_src'] 	= $det_price_ori[$k];
			$data_mst_paket_det['disc_p'] 		= $det_disc_pkt[$k];
			$data_mst_paket_det['disc_m'] 		= (intval($det_price_ori[$k]) - intval($det_price_pkt[$k]));
			$data_mst_paket_det['price'] 		= $det_price_pkt[$k];
			$data_mst_paket_det['qty'] 			= $det_qty[$k];
			$data_mst_paket_det['total_src'] 	= $det_price_subtotal_ori[$k];
			$data_mst_paket_det['total'] 		= $det_price_subtotal_pkt[$k];
			$data_mst_paket_det['no_kunj'] 		= $det_no_kunj[$k];
			
			$data_mst_paket_det['tuslah'] 		= $det_tuslah[$k];
			$data_mst_paket_det['jenis_obat'] 	= $det_jenis_obat[$k];
			$data_mst_paket_det['dosis'] 		= $det_dosis[$k];
			$data_mst_paket_det['frekwensi'] 	= $det_frekwensi[$k];
			$data_mst_paket_det['tme'] 		    = $det_tme[$k];
			
			$data_mst_paket_det['creator'] 		= $this->session->userdata['sp']->name;
			$data_mst_paket_det['created'] 		= date('Y-m-d H:i:s');
			$this->Mst_paket_model->insert('mst_paket_det',$data_mst_paket_det);
		}
		
		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
		}
		else
		{
				#$this->db->trans_rollback();
				$this->db->trans_commit();
		}
        redirect(site_url('mst_paket'));
        
    }
    
    public function update($id) 
    {
		$sql_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_penjamin = "	SELECT 'SEMUA' as id,'SEMUA' as name
							UNION ALL 
							SELECT 'TUNAI' as id,'TUNAI' as name
							UNION ALL 
							SELECT 'ASURANSI' as id,'ASURANSI' as name
							";
	
		$row 	= $this->Mst_paket_model->get_mst_paket_by_id($id);
		$rs 	= $this->Mst_paket_model->get_mst_paket_det_by_id($id);
		$tuslah = $this->Mst_paket_model->get_main_setting_value('rspfee_med_item');
		
		$data = array(
			'button' 			=> 'Update',
			'action' 			=> site_url('mst_paket/update_action'),
			'id_paket'	 		=> set_value('id_paket', $row->id_paket),
			'name'	 			=> set_value('name', $row->name),
			'radio-aktif' 		=> $this->formgenerator->get_radio('aktif',$sql_aktif,$row->aktif),
			'radio-penjamin' 	=> $this->formgenerator->get_radio('penjamin',$sql_penjamin,'SEMUA',false,'javascript: return false'),
			'name' 				=> set_value('name', $row->name),
			'id_type' 			=> set_value('id_type', $row->id_type),
			'duration' 			=> set_value('duration', $row->duration),
			'price' 			=> set_value('price', round($row->price,0)),
			'tuslah'		=> $tuslah,
			
			'created' 			=> set_value('created', $row->created),
			'creator' 			=> set_value('creator', $row->creator),
			'updated' 			=> set_value('updated', $row->updated),
			'updater' 			=> set_value('updater', $row->updater),
			
			'rs'				=> json_encode($rs),
		);
		//$this->load->view('mst_paket_form', $data);
		$this->parser->parse('mst_paket_form', $data);
    }
    
    public function update_action() 
    {
		#$this->output->enable_profiler(true);
		#return;
		
		$id_paket 				= $this->input->post('id_paket');
		$id_reg 				= $this->input->post('id_reg');
		$rowno 					= $this->input->post('det_id_act');
		$det_id_group 			= $this->input->post('det_id_group');
		$det_no_kunj 			= $this->input->post('det_no_kunj');
		$det_id_act 			= $this->input->post('det_id_act');
		$det_id_act_txt 		= $this->input->post('det_id_act_txt');
		$det_price_ori 			= $this->input->post('det_price_ori');
		$det_disc_pkt 			= $this->input->post('det_disc_pkt');
		$det_price_pkt 			= $this->input->post('det_price_pkt');
		$det_qty 				= $this->input->post('det_qty');
		$det_price_subtotal_ori = $this->input->post('det_price_subtotal_ori');
		$det_price_subtotal_pkt = $this->input->post('det_price_subtotal_pkt');
		$det_no_kunj 			= $this->input->post('det_no_kunj');
		$det_tuslah 			= $this->input->post('det_tuslah');
		$det_jenis_obat 		= $this->input->post('det_jenis_obat');
		$det_dosis 				= $this->input->post('det_dosis');
		$det_frekwensi 			= $this->input->post('det_frekwensi');
		$det_tme 				= $this->input->post('det_tme');		
		
		$this->db->trans_begin();
		
		$data_mst_paket = array();
		$data_mst_paket['name'] 	= $this->input->post('name');
		$data_mst_paket['duration'] = $this->input->post('duration');
		$data_mst_paket['price'] 	= $this->input->post('price');
		$data_mst_paket['penjamin'] = $this->input->post('penjamin');
		$data_mst_paket['updater'] 	= $this->session->userdata['sp']->name;
		$data_mst_paket['updated'] 	= date('Y-m-d H:i:s');
		$this->Mst_paket_model->update('mst_paket','id_paket',$id_paket,$data_mst_paket);
		
		$this->Mst_paket_model->delete('mst_paket_det','id_paket',$id_paket);
		foreach($det_id_act as $k => $v)
		{
			$data_mst_paket_det = array();
			$data_mst_paket_det['id_paket'] 	= $id_paket;
			$data_mst_paket_det['id_group'] 	= $det_id_group[$k];
			$data_mst_paket_det['id_trx_det'] 	= $det_id_act[$k];
			$data_mst_paket_det['price_src'] 	= $det_price_ori[$k];
			$data_mst_paket_det['disc_p'] 		= $det_disc_pkt[$k];
			$data_mst_paket_det['disc_m'] 		= (intval($det_price_ori[$k]) - intval($det_price_pkt[$k]));
			$data_mst_paket_det['price'] 		= $det_price_pkt[$k];
			$data_mst_paket_det['qty'] 			= $det_qty[$k];
			$data_mst_paket_det['total_src'] 	= $det_price_subtotal_ori[$k];
			$data_mst_paket_det['total'] 		= $det_price_subtotal_pkt[$k];
			$data_mst_paket_det['no_kunj'] 		= $det_no_kunj[$k];
			
			$data_mst_paket_det['tuslah'] 		= $det_tuslah[$k];
			$data_mst_paket_det['jenis_obat'] 	= $det_jenis_obat[$k];
			$data_mst_paket_det['dosis'] 		= $det_dosis[$k];
			$data_mst_paket_det['frekwensi'] 	= $det_frekwensi[$k];
			$data_mst_paket_det['tme'] 		    = $det_tme[$k];
			
			$data_mst_paket_det['creator'] 		= $this->session->userdata['sp']->name;
			$data_mst_paket_det['created'] 		= date('Y-m-d H:i:s');
			$this->Mst_paket_model->insert('mst_paket_det',$data_mst_paket_det);
		}
		
		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
		}
		else
		{
				#$this->db->trans_rollback();
				$this->db->trans_commit();
		}
        redirect(site_url('mst_paket'));
    }
    
    public function delete($id) 
    {
        $row = $this->Mst_paket_model->get_by_id($id);

        if ($row) {
            $this->Mst_paket_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mst_paket'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mst_paket'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('id_type', 'id type', 'trim|required');
	$this->form_validation->set_rules('duration', 'duration', 'trim|required');
	$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
	#$this->form_validation->set_rules('aktif', 'aktif', 'trim|required');
	$this->form_validation->set_rules('created', 'created', 'trim|required');
	$this->form_validation->set_rules('creator', 'creator', 'trim|required');
	$this->form_validation->set_rules('updated', 'updated', 'trim|required');
	$this->form_validation->set_rules('updater', 'updater', 'trim|required');

	$this->form_validation->set_rules('id_paket', 'id_paket', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->Mst_paket_model->total_rows($q);
				$mst_paket = $this->Mst_paket_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'mst_paket_data' => $mst_paket,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('mst_paket_pdf', $data);
		}
		
function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->Mst_paket_model->total_rows($q);
		$rs = $this->Mst_paket_model->get_limit_data($config['per_page'], $start, $q);
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

	public function inner_get_data_autocomplete_tindakan()
	{
		$term = $this->input->get('term',true);
		$sql = "SELECT 	a.id_act AS idx, a.`name` AS label
						,(CASE WHEN COALESCE(b.`price`,0)>0 THEN b.price
							ELSE COALESCE(a.`price`,0) END 
						) AS price
				FROM 	mst_tindakan a
						LEFT JOIN mst_tindakan_prc b ON (b.`id_act`=a.`id_act` AND b.`id_comp`='0001' AND b.`id_kelas`=1 AND b.aktif=1)
				WHERE	UPPER(a.`name`) LIKE '%".strtoupper($term)."%' AND a.aktif=1
		";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['price'] = $v['price'];
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
		}
		$data = json_encode($rs);
		echo $data;
	}
	
	public function inner_get_data_autocomplete_farmasi()
	{
		$term = $this->input->get('term',true);
		$sql = "SELECT  b.id_fa AS idx, b.`name` AS label
						,IF(ROUND(COALESCE(a.harga_margin,0))>0 , ROUND(COALESCE(a.harga_margin,0)) , ROUND(b.`sale_price`)) AS price
						,(CASE WHEN b.id_src=0 THEN 'Oral' ELSE 'Obat Luar' END) AS jenis_obat
						-- ,ROUND(b.`sale_price`)
				FROM 	`mst_farmalkes` b 
						LEFT JOIN ish_mstrumus_det a ON (a.`id_obat`=b.`id_fa` AND a.id_comp='0001' AND a.status='0') 
				WHERE 	UPPER(b.`name`) LIKE '%".strtoupper($term)."%' 
						AND IF(ROUND(COALESCE(a.harga_margin,0))>0 , ROUND(COALESCE(a.harga_margin,0)) , ROUND(b.`sale_price`)) > 0
						AND b.aktif=1
				-- GROUP BY a.id_comp 
				ORDER BY b.name";
		$query = $this->db->query($sql);
		$rs = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['price'] = $v['price'];
			$rs[$k]['label'] = $v['label'];
			$rs[$k]['id'] = $v['idx'];
		}
		$data = json_encode($rs);
		echo $data;
	}
	
}
?>
