<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Resume_medis extends MX_Controller {
	var $session_name='sp';
	var $start = 0;

	function __construct() {
		parent::__construct();
		#if($session_name !='') $this->check_session($session_name);
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');

		$this->load->model('History_pasien_model','mdl');
  }

	function index($id_reg)
	{
		$data_asmri 	= $this->mdl->get_data_asm_ri_dokter($id_reg);
		$data_pasien 	= $this->mdl->get_data_pasien_byred($id_reg);
		$data_resmed 	= $this->mdl->get_data_resume_medis_by_id_reg($id_reg);
		$id_pasien 	 	= $data_pasien['id_pasien'];
		#print_r($data_resmed);
		
		// ------------------------ SETTING UP DATA AWAL ------------------------
		#print_r($data_pasien);echo "<br><br>";
		foreach($data_resmed as $k => $v)
		{
			if($v=='') @$data_resmed[$k] = $data_asmri[$k];
		}
		if(empty($data_resmed['data_resmed'])) $data_resmed['resmed_date'] = date('Y-m-d');
		if(empty($data_resmed['riwayat_pengobatan'])) $data_resmed['riwayat_pengobatan'] = $data_resmed['p_instruksi'];
		
		#print_r($data_resmed);
		
		#print_r($row);
		if(empty($arr_ten)) $arr_ten = array('','','','','');
		if(empty($arr_ten_text)) $arr_ten_text = array('','','','','');
		if(empty($arr_nine)) $arr_nine = array('','','','','');
		if(empty($arr_nine_text)) $arr_nine_text = array('','','','','');
		
		$sql_command = ($data_resmed['id_resmed']=='') ? 'insert' : 'update' ;
		#if($sql_command=='update')
		#{
			if($data_resmed['diag_medis_banding_text']!='')
				$arr_ten_text = explode(';',$data_resmed['diag_medis_banding_text']);
			if($data_resmed['diag_medis_banding']!='')
				$arr_ten = explode(';',$data_resmed['diag_medis_banding']);
			if($data_resmed['planning_text']!='')
				$arr_nine_text = explode(';',$data_resmed['planning_text']);
			if($data_resmed['planning']!='')
				$arr_nine = explode(';',$data_resmed['planning']);
		#}
		
		$data = array(
			'sql_command'				=> $sql_command,
			'id_reg'						=> $id_reg,
			'id_pasien'					=> $id_pasien,
			'data_pasien'				=> $data_pasien,
			'data_pasien_json'	=> json_encode($data_pasien),
			
			'data_resmed'				=> $data_resmed,
			'data_resmed_json'	=> json_encode($data_resmed),
      'arr_ten_text'			=> $arr_ten_text,
			'arr_ten'						=> $arr_ten,
			'arr_nine_text'			=> $arr_nine_text,
			'arr_nine'					=> $arr_nine,
    );
    $this->load->view('vform_resume_medis', $data);
	}
	
	function get_checkbox_implode($name_form,$glue=';')
	{
		$var = $this->input->post($name_form);
		if(!empty($var)) 
			$var_imp = implode($glue,$var);
		else
			$var_imp = '';
			
		return $var_imp;
	}
	
	function act_resume_medis($id_reg,$id_pasien)
	{		
		$id_resmed = $this->input->post('id_resmed');
		$sql_command = $this->input->post('sql_command');
		
		$kondisi_psiko 	= $this->get_checkbox_implode('kondisi_psiko');
		$kondisi_ibadah = $this->get_checkbox_implode('kondisi_ibadah');
		$cara_keluar 		= $this->get_checkbox_implode('cara_keluar');
		$kondisi_keluar = $this->get_checkbox_implode('kondisi_keluar');
		$tindak_lanjut 	= $this->get_checkbox_implode('tindak_lanjut');
		$pertanyaan 		= $this->get_checkbox_implode('pertanyaan');
		
		$name_icd_ten = $this->input->post('name_icd_ten');
		$diag_medis_banding_text = implode(';',$name_icd_ten);
		
		$id_icd_ten = $this->input->post('id_icd_ten');
		$diag_medis_banding = implode(';',$id_icd_ten);
		

		$name_icd_nine = $this->input->post('name_icd_nine');
		$planning_text = implode(';',$name_icd_nine);
		
		$id_icd_nine = $this->input->post('id_icd_nine');
		$planning = implode(';',$id_icd_nine);
		
		$data_insert_update = array();
		$data_insert_update['resmed_date'] 							= $this->input->post('resmed_date');
		$data_insert_update['id_reg'] 									= $id_reg;
		$data_insert_update['id_pasien'] 								= $id_pasien;
		$data_insert_update['regdate'] 									= $this->input->post('regdate');
		$data_insert_update['tgl_keluar'] 							= $this->input->post('tgl_keluar');
		$data_insert_update['id_dokter'] 								= $this->session->userdata['sp']->id_dokter;
		$data_insert_update['keluhan_utama'] 						= $this->input->post('keluhan_utama');
		$data_insert_update['riwayat_sakit_dulu'] 			= $this->input->post('riwayat_sakit_dulu');
		$data_insert_update['keadaan_umum'] 						= $this->input->post('keadaan_umum');
		$data_insert_update['kesadaran'] 								= $this->input->post('kesadaran');
		$data_insert_update['td'] 											= $this->input->post('td');
		$data_insert_update['nadi'] 										= $this->input->post('nadi');
		$data_insert_update['nafas'] 										= $this->input->post('nafas');
		$data_insert_update['gcs'] 											= $this->input->post('gcs');
		$data_insert_update['suhu'] 										= $this->input->post('suhu');
		$data_insert_update['reaksi_cahaya'] 						= $this->input->post('reaksi_cahaya');
		$data_insert_update['tinggi'] 									= $this->input->post('tinggi');
		$data_insert_update['berat'] 										= $this->input->post('berat');
		$data_insert_update['pemeriksaan_penunjang'] 		= $this->input->post('pemeriksaan_penunjang');
		$data_insert_update['riwayat_pengobatan'] 			= $this->input->post('riwayat_pengobatan');
		$data_insert_update['hasil_konsultasi'] 				= $this->input->post('hasil_konsultasi');
		
		$data_insert_update['diag_medis_banding'] 			= $diag_medis_banding;
		$data_insert_update['diag_medis_banding_text'] 	= $diag_medis_banding_text;
		$data_insert_update['planning'] 								= $planning;
		$data_insert_update['planning_text'] 						= $planning_text;
		
		$data_insert_update['riwayat_alergi'] 					= $this->input->post('riwayat_alergi');
		$data_insert_update['lab_belum_selesai'] 				= $this->input->post('lab_belum_selesai');
		$data_insert_update['p_instruksi_terakhir'] 		= $this->input->post('p_instruksi_terakhir');
		
		$data_insert_update['kondisi_psiko'] 					= $kondisi_psiko;
		$data_insert_update['kondisi_ibadah'] 				= $kondisi_ibadah;
		$data_insert_update['cara_keluar'] 						= $cara_keluar;
		$data_insert_update['kondisi_keluar'] 				= $kondisi_keluar;
		$data_insert_update['tindak_lanjut'] 					= $tindak_lanjut;
		$data_insert_update['pertanyaan'] 						= $pertanyaan;
		
		$data_insert_update['diet'] 				= $this->input->post('diet');
		$data_insert_update['keluarga'] 		= $this->input->post('penanggung');
		
		if($sql_command=='insert')
		{
			$data_insert_update['created'] 		= date('Y-m-d');
			$data_insert_update['creator'] 		= $this->session->userdata['sp']->login_name;
			
			$this->mdl->add_data_resmed($data_insert_update);
		}
		else
		{
			$data_insert_update['updated'] 		= date('Y-m-d');
			$data_insert_update['updator'] 		= $this->session->userdata['sp']->login_name;
			
			$this->mdl->update_resmed($id_resmed,$data_insert_update);
		}
		
		#redirect('erm_ranap/main_content/'.$id_reg);
		#echo 'Input/Update Berhasil : '.$this->db->last_query();
		echo 'Input/Update Berhasil';
	}
	

}