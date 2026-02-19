<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voucher_disc extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Voucher_disc_model');
		$this->load->library('FormGenerator');
    }

    public function index()
    {
		$q = urldecode($this->input->get('q', TRUE));      
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
			
            $config['base_url'] = base_url() . 'voucher_disc/?q=' . urlencode($q);
						$config['first_url'] = base_url() . 'voucher_disc/?q=' . urlencode($q);					
            
        } else {
            $config['base_url'] = base_url() . 'voucher_disc/';
            $config['first_url'] = base_url() . 'voucher_disc/';
        }

        $config['per_page'] = 100;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Voucher_disc_model->total_rows($q);
        $voucher_disc = $this->Voucher_disc_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'voucher_disc_data' => $voucher_disc,
            'q'                 => $q,
            'pagination'        => $this->pagination->create_links(),
            'total_rows'        => $config['total_rows'],
            'start'             => $start,
        );
        $this->load->view('voucher_disc_list', $data);
    }

    public function cetak_vcr($id_vcr) 
    {
		#$this->load->library('Ciqrcode');
		#$this->Ciqrcode->initialize();
		#$ciqrcode = $this->Ciqrcode;
		
		
		$data_trx_vcr = $this->Voucher_disc_model->data_trx_vcr_disc_by_id_vcr($id_vcr);
		
		foreach($data_trx_vcr as $k => $v)
		{
			$data_trx_vcr_det = $this->Voucher_disc_model->data_trx_vcr_disc_det($v->id_tvd);
			$data_trx_vcr[$k]->items = $data_trx_vcr_det;
			$data_trx_vcr[$k]->qrcode_vcr = $this->get_qrcode($v->kode_vcr,$v->id_tvd);
		}
		
		$data = array(
			'data_trx_vcr' 	=> $data_trx_vcr,
			#'ciqrcode'		=> $ciqrcode,
		);

		$this->load->view('voucher_disc_cetak', $data);
    }
	
	public function cetak_vcr_single($id_tvd) 
    {	
		$id_tvd = base64_decode($id_tvd);
		$data_trx_vcr = $this->Voucher_disc_model->data_trx_vcr_disc($id_tvd);
		
		foreach($data_trx_vcr as $k => $v)
		{
			$data_trx_vcr_det = $this->Voucher_disc_model->data_trx_vcr_disc_det($v->id_tvd);
			$data_trx_vcr[$k]->items = $data_trx_vcr_det;
			$data_trx_vcr[$k]->qrcode_vcr = $this->get_qrcode($v->kode_vcr,$v->id_tvd);
		}
		
		$data = array(
			'data_trx_vcr' 	=> $data_trx_vcr,
			#'ciqrcode'		=> $ciqrcode,
		);

		$this->load->view('voucher_disc_cetak_single', $data);
    }
	
	public function get_qrcode($string,$uniq_id)
	{
		$this->load->library('ciqrcode');

		$params['data'] = $string;
		$params['level'] = 'H';
		$params['size'] = 2;
		$params['savename'] = FCPATH.'qrcode/tes'.$uniq_id.'.png';
		$this->ciqrcode->generate($params);

		return '<img src="'.base_url().'qrcode/tes'.$uniq_id.'.png" />';
	}

    public function create()
    {
		$sql_is_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_penjamin = "	SELECT 'SEMUA' as id,'SEMUA' as name
							UNION ALL 
							SELECT 'TUNAI' as id,'TUNAI' as name
							UNION ALL 
							SELECT 'ASURANSI' as id,'ASURANSI' as name
							";
		$sql_item_vcr = "SELECT 'SEMUA' as id,'SEMUA' as name
							UNION ALL 
							SELECT 'SATUAN' as id,'ITEM TERPILIH' as name";
		$sql_item_vcr_farm = "SELECT 'SEMUA' as id,'SEMUA' as name
								UNION ALL 
								SELECT 'SATUAN' as id,'ITEM TERPILIH' as name";
		
		$data_mst_vcr_disc = array();
		$data_mst_vcr_disc['tindakan'] = array();
		$data_mst_vcr_disc['farmasi'] = array();
		$data_mst_vcr_disc = (object)$data_mst_vcr_disc;
		
        $data = array(
			'disabled'          => '',
			'd-none'			=> '',
			'data_mst_vcr_disc'	=> $data_mst_vcr_disc,
			'button'             => 'Create',
			'action'             => site_url('voucher_disc/create_action'),
			'id_vcr'             => set_value('id_vcr'),
			'radio_is_aktif'     => $this->formgenerator->get_radio('is_aktif',$sql_is_aktif,1),
			
			'prefix_kode_vcr'    => set_value('prefix_kode_vcr'),
			'radio_penjamin'     => $this->formgenerator->get_radio('penjamin',$sql_penjamin,'SEMUA'),
			'radio_item_vcr'     => $this->formgenerator->get_radio('item_vcr',$sql_item_vcr,'SEMUA'),
			'radio_item_vcr_farm' => $this->formgenerator->get_radio('item_vcr_farm',$sql_item_vcr_farm,'SEMUA'),
				
			'start'              => set_value('start'),
			'end'                => set_value('end'),
			'quota'              => set_value('quota',1),
			'diskon_p'           => set_value('diskon_p',0),
			'diskon_p_farm'      => set_value('diskon_p_farm',0),
			'creator'            => set_value('creator',$this->session->userdata['sp']->login_name),
			'created'            => set_value('created'),
			'updater'            => set_value('updater'),
			'updated'            => set_value('updated'),
		);
        $this->load->view('voucher_disc_form', $data);
		//$this->parser->parse('voucher_disc_form', $data);
    }
    
    public function create_action() 
    {
		#$this->output->enable_profiler(true);
		#return;
		$rowno 		       = $this->input->post('rowno');
		$dt_is_farmasi     = $this->input->post('dt_is_farmasi');
		$dt_txt_is_farmasi = $this->input->post('dt_txt_is_farmasi');
		$dt_id_act 		   = $this->input->post('dt_id_act');
		$dt_txt_id_act 	   = $this->input->post('dt_txt_id_act');
		$dt_disc_p 	       = $this->input->post('dt_disc_p');
		$quota 			   = $this->input->post('quota');
		
		$this->db->trans_begin();
		### --- INSERT mst_vcr_disc -------------------------------------------
		$data_mst_vcr_disc               = array();
		$data_mst_vcr_disc['is_aktif']   = $this->input->post('is_aktif');
		$data_mst_vcr_disc['penjamin']   = $this->input->post('penjamin');
		$data_mst_vcr_disc['start']      = $this->input->post('start');
		$data_mst_vcr_disc['end']        = $this->input->post('end');
		$data_mst_vcr_disc['quota']      = $quota;
		$data_mst_vcr_disc['quota_left'] = $quota;
		$data_mst_vcr_disc['creator']    = $this->session->userdata['sp']->name;
		$data_mst_vcr_disc['created']    = date('Y-m-d H:i:s');
		$new_id_vcr = $this->Voucher_disc_model->insert('mst_vcr_disc',$data_mst_vcr_disc);
		
		$data_update_mst_vcr_disc['prefix_kode_vcr'] = 'VCR-'.str_pad($new_id_vcr,4,"0",STR_PAD_LEFT);
		$this->Voucher_disc_model->update('mst_vcr_disc','id_vcr',$new_id_vcr,$data_update_mst_vcr_disc);
		
		### --- INSERT mst_vcr_disc_det -------------------------------------------
		$new_id_vcr_det = array();
		foreach($rowno as $k => $v)
		{
			$data_mst_vcr_disc_det                  = array();
			$data_mst_vcr_disc_det['id_vcr'] 	    = $new_id_vcr;
			$data_mst_vcr_disc_det['is_farmasi']    = $dt_is_farmasi[$k];
			$data_mst_vcr_disc_det['id_act_fa']     = $dt_id_act[$k];
			$data_mst_vcr_disc_det['txt_id_act_fa'] = $dt_txt_id_act[$k];
			$data_mst_vcr_disc_det['primary_disc']  = 'disc_p';
			$data_mst_vcr_disc_det['disc_p'] 	    = $dt_disc_p[$k];
			$new_id_vcr_det[$k] = $this->Voucher_disc_model->insert('mst_vcr_disc_det',$data_mst_vcr_disc_det);
		}
		
		for($i=1;$i<=$quota; $i++)
		{
			### --- INSERT trx_vcr_disc -------------------------------------------
			$data_trx_vcr_disc             = array();
			$data_trx_vcr_disc['is_aktif'] = $this->input->post('is_aktif');
			$data_trx_vcr_disc['id_vcr']   = $new_id_vcr;
			$data_trx_vcr_disc['kode_vcr'] = $data_update_mst_vcr_disc['prefix_kode_vcr'] .'-'. str_pad($i,4,"0",STR_PAD_LEFT);
			$data_trx_vcr_disc['penjamin'] = $this->input->post('penjamin');
			$data_trx_vcr_disc['start']    = $this->input->post('start');
			$data_trx_vcr_disc['end']      = $this->input->post('end');
			$data_trx_vcr_disc['creator']  = $this->session->userdata['sp']->name;
			$data_trx_vcr_disc['created']  = date('Y-m-d H:i:s');
			$new_id_tvd = $this->Voucher_disc_model->insert('trx_vcr_disc',$data_trx_vcr_disc);

			### --- INSERT trx_vcr_disc_det -------------------------------------------
			foreach($rowno as $k => $v)
			{
				$data_trx_vcr_disc_det                  = array();
				$data_trx_vcr_disc_det['id_tvd'] 	    = $new_id_tvd;
				$data_trx_vcr_disc_det['id_vcr_det']    = $new_id_vcr_det[$k];
				$data_trx_vcr_disc_det['id_vcr'] 	    = $new_id_vcr;
				$data_trx_vcr_disc_det['is_farmasi']    = $dt_is_farmasi[$k];
				$data_trx_vcr_disc_det['id_act_fa']     = $dt_id_act[$k];
				$data_trx_vcr_disc_det['txt_id_act_fa'] = $dt_txt_id_act[$k];
				$data_trx_vcr_disc_det['primary_disc']  = 'disc_p';
				$data_trx_vcr_disc_det['disc_p'] 	    = $dt_disc_p[$k];
				$this->Voucher_disc_model->insert('trx_vcr_disc_det',$data_trx_vcr_disc_det);
			}
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
        redirect(site_url('voucher_disc'));
    }
    
    public function update($id_vcr)
    {
        $data_mst_vcr_disc = $this->Voucher_disc_model->data_mst_vcr_disc($id_vcr);
		$sql_is_aktif = "SELECT * FROM reff_aktif ORDER BY aktif";
		$sql_penjamin = "	SELECT 'SEMUA','SEMUA'
							UNION ALL 
							SELECT 'TUNAI','TUNAI'
							UNION ALL 
							SELECT 'ASURANSI','ASURANSI'
							";
		$sql_item_vcr = "SELECT 'SEMUA' as id,'SEMUA' as name
							UNION ALL 
							SELECT 'SATUAN' as id,'ITEM TERPILIH' as name";
		$sql_item_vcr_farm = "SELECT 'SEMUA' as id,'SEMUA' as name
								UNION ALL 
								SELECT 'SATUAN' as id,'ITEM TERPILIH' as name";
		
		$data_mst_vcr_disc_det = $this->Voucher_disc_model->data_mst_vcr_disc_det($data_mst_vcr_disc->id_vcr,$is_farmasi=0);
		$data_mst_vcr_disc->tindakan = $data_mst_vcr_disc_det;
		
		$data_mst_vcr_disc_det = $this->Voucher_disc_model->data_mst_vcr_disc_det($data_mst_vcr_disc->id_vcr,$is_farmasi=1);
		$data_mst_vcr_disc->farmasi = $data_mst_vcr_disc_det;
		
        $data = array(
            'disabled'          => 'disabled',
			'd-none'			=> 'd-none',
			'data_mst_vcr_disc'	=> $data_mst_vcr_disc,
			'button'           => 'Update',
			'action'           => site_url('voucher_disc/update_action'),
			'id_vcr'           => set_value('id_vcr', $data_mst_vcr_disc->id_vcr),
			'radio_is_aktif'   => $this->formgenerator->get_radio('is_aktif',$sql_is_aktif,$data_mst_vcr_disc->is_aktif),			
			'prefix_kode_vcr'  => set_value('prefix_kode_vcr', $data_mst_vcr_disc->prefix_kode_vcr),
			'radio_penjamin'   => $this->formgenerator->get_radio('penjamin',$sql_penjamin,$data_mst_vcr_disc->penjamin,true,'javascript : return false'),
			'radio_item_vcr'     => $this->formgenerator->get_radio('item_vcr',$sql_item_vcr,'SEMUA',true,'javascript : return false'),
			'radio_item_vcr_farm' => $this->formgenerator->get_radio('item_vcr_farm',$sql_item_vcr_farm,'SEMUA',true,'javascript : return false'),
				
			'start'            => set_value('start', $data_mst_vcr_disc->start),
			'end'              => set_value('end', $data_mst_vcr_disc->end),
			'quota'            => set_value('quota', $data_mst_vcr_disc->quota),
			'creator'          => set_value('creator', $data_mst_vcr_disc->creator),
			'created'          => set_value('created', $data_mst_vcr_disc->created),
			'updater'          => set_value('updater', $data_mst_vcr_disc->updater),
			'updated'          => set_value('updated', $data_mst_vcr_disc->updated),
	    );
		$this->load->view('voucher_disc_form', $data);
		//$this->parser->parse('voucher_disc_form', $data);
    }
    
    public function update_action() 
    {
		$id_vcr = $this->input->post('id_vcr', TRUE);
		$data = array(
			'is_aktif' => $this->input->post('is_aktif',TRUE),
			/*
			'penjamin' => $this->input->post('penjamin',TRUE),
			'start'    => $this->input->post('start',TRUE),
			'end'      => $this->input->post('end',TRUE),
			'quota'    => $this->input->post('quota',TRUE),
			*/
			'updater'  => $this->session->userdata['sp']->name,
			'updated'  => date('Y-m-d H:i:s'),
	    );			
		$this->Voucher_disc_model->update('mst_vcr_disc','id_vcr',$id_vcr,$data);
		redirect(site_url('voucher_disc'));
    }
    
    public function delete($id) 
    {
        $row = $this->Voucher_disc_model->get_by_id($id);

        if ($row) {
            $this->Voucher_disc_model->delete($id);
            #$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('voucher_disc'));
        } else {
            #$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('voucher_disc'));
        }
    }

    public function _rules() 
    {
	#$this->form_validation->set_rules('is_aktif', 'is aktif', 'trim|required');
	$this->form_validation->set_rules('nama_promo', 'nama promo', 'trim|required');
	$this->form_validation->set_rules('start', 'start', 'trim|required');
	$this->form_validation->set_rules('end', 'end', 'trim|required');
	$this->form_validation->set_rules('quota', 'quota', 'trim|required');

	$this->form_validation->set_rules('id_promo', 'id_promo', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
function pdf()
		{
				$q = $this->input->get('q', TRUE);      
				$start = intval($this->input->get('start'));
				
				$config['per_page'] = 100000; // LAPORAN GAK PAKE PAGINATION
				$config['page_query_string'] = FALSE;
				$config['total_rows'] = $this->Voucher_disc_model->total_rows($q);
				$voucher_disc = $this->Voucher_disc_model->get_limit_data(@$config['per_page'], $start, $q);
	
				#$this->load->library('pagination');
				#$this->pagination->initialize($config);
	
				$data = array(
						'voucher_disc_data' => $voucher_disc,
						'q' => $q,
						'pagination' => '',
						'total_rows' => $config['total_rows'],
						'start' => $start,
				);
				$this->load->helper('pdf_helper');	
				$this->load->view('voucher_disc_pdf', $data);
		}
		
function xls()
	{
		$this->load->library('Libexcel');
		$parameter = array();
		$q = $this->input->get('q', TRUE);      
		$start = intval($this->input->get('start'));
		$config['per_page'] = 10000;
		$config['page_query_string'] = FALSE;
		$config['total_rows'] = $this->Voucher_disc_model->total_rows($q);
		$rs = $this->Voucher_disc_model->get_limit_data($config['per_page'], $start, $q);
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

	function cek_voucher($kode_vcr)
	{
		$kode_vcr = trim($kode_vcr);
		$data = $this->Voucher_disc_model->data_trx_vcr_disc_by_kode_vcr($kode_vcr);
		if($data->id_tvd!='')
		{
			$data->det = $this->Voucher_disc_model->data_trx_vcr_disc_det($data->id_tvd);
		}
		echo json_encode($data);
	}

}
?>
