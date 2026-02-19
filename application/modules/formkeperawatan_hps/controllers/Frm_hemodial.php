<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frm_hemodial extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');
		$this->load->model('Mdl_hemodial','mdl');
	}

  public function frmasm($id_reg){
	$pasien 		= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
	$id_pasien		= $pasien['id_pasien'];
	$base_url   = base_url('');

    $data = array(
		'base_url'		 => $base_url,
		'id_reg'		 => $id_reg,
		'id_pasien'		 => $id_pasien
    );
	$this->load->view('frm_asm_hemodial', $data);
  }

  public function asm_hemodial_add($id){
		$creator = @$this->session->userdata['sp']->login_name;
		$dateasmri  					= date('Y-m-d H:i:s');
		$id		 						= $this->input->post('id');
		$id_pasien 						= $rs['id_pasien'];
		$id_reg 						= $this->input->post('id_reg');
		$tgl_haritgljam 				= $this->input->post('tgl_haritgljam');
		$nomesin 						= $this->input->post('nomesin');
		$hdke 							= $this->input->post('hdke');
		$tipe_dializer 					= $this->input->post('tipe_dializer');
		$riwalergiobat 					= $this->input->post('riwalergiobat');
		$riwalergiobat_text 			= $this->input->post('riwalergiobat_text');
		$diagnosamedis 					= $this->input->post('diagnosamedis');
		$carabayar 						= $this->input->post('carabayar');
		$carabayar_text 				= $this->input->post('carabayar_text');
		$chk_keluhan_utama				= $this->input->post('keluhan_utama'); $keluhan_utama	= implode(';',(array)$chk_keluhan_utama);
		$keluhan_utama_rad 				= $this->input->post('keluhan_utama_rad');
		$keluhan_utama_1_text 			= $this->input->post('keluhan_utama_1_text');
		$keluhan_utama_2_text 			= $this->input->post('keluhan_utama_2_text');
		$chk_keadaan_umum_1				= $this->input->post('keadaan_umum_1'); $keadaan_umum_1	= implode(';',(array)$chk_keadaan_umum_1);
		$keadaan_umum_2_a_text			= $this->input->post('keadaan_umum_2_a_text');
		$keadaan_umum_2_b_text			= $this->input->post('keadaan_umum_2_b_text');
		$chk_keadaan_umum_3				= $this->input->post('keadaan_umum_3'); $keadaan_umum_3	= implode(';',(array)$chk_keadaan_umum_3);
		$keadaan_umum_3_a_text 			= $this->input->post('keadaan_umum_3_a_text');
		$chk_keadaan_umum_4				= $this->input->post('keadaan_umum_4'); $keadaan_umum_4	= implode(';',(array)$chk_keadaan_umum_4);
		$keadaan_umum_4_a_text 			= $this->input->post('keadaan_umum_4_a_text');
		$chk_keadaan_umum_5				= $this->input->post('keadaan_umum_5'); $keadaan_umum_5	= implode(';',(array)$chk_keadaan_umum_5);
		$chk_keadaan_umum_6				= $this->input->post('keadaan_umum_6'); $keadaan_umum_6	= implode(';',(array)$chk_keadaan_umum_6);
		$keadaan_umum_7_a_text 			= $this->input->post('keadaan_umum_7_a_text');
		$keadaan_umum_7_b_text 			= $this->input->post('keadaan_umum_7_b_text');
		$keadaan_umum_7_c_text 			= $this->input->post('keadaan_umum_7_c_text');
		$keadaan_umum_7_d_text 			= $this->input->post('keadaan_umum_7_d_text');
		$chk_keadaan_umum_8				= $this->input->post('keadaan_umum_8'); $keadaan_umum_8	= implode(';',(array)$chk_keadaan_umum_8);
		$keadaan_umum_8_a_text 			= $this->input->post('keadaan_umum_8_a_text');
		$keadaan_umum_9_a 				= $this->input->post('keadaan_umum_9_a');
		$keadaan_umum_9_b 				= $this->input->post('keadaan_umum_9_b');
		$keadaan_umum_9_c 				= $this->input->post('keadaan_umum_9_c');
		$keadaan_umum_9_d 				= $this->input->post('keadaan_umum_9_d');
		$keadaan_umum_9_e 				= $this->input->post('keadaan_umum_9_e');
		$keadaan_umum_9_f 				= $this->input->post('keadaan_umum_9_f');
		$skor_9 						= $this->input->post('skor_9');
		$pemeriksaan_penunjang_10 		= $this->input->post('pemeriksaan_penunjang_10');
		$krn_a_text 					= $this->input->post('krn_a_text');
		$krn_b_text 					= $this->input->post('krn_b_text');
		$krn_c_text 					= $this->input->post('krn_c_text');
		$ksm_a 							= $this->input->post('ksm_a');
		$chk_rikul_a					= $this->input->post('rikul_a'); $rikul_a	= implode(';',(array)$chk_rikul_a);
		$rikul_a_text 					= $this->input->post('rikul_a_text');
		$chk_rikul_b					= $this->input->post('rikul_b'); $rikul_b	= implode(';',(array)$chk_rikul_b);
		$rikul_b_text 					= $this->input->post('rikul_b_text');
		$chk_rikul_c					= $this->input->post('rikul_c'); $rikul_c	= implode(';',(array)$chk_rikul_c);
		$chk_rikul_d					= $this->input->post('rikul_d'); $rikul_d	= implode(';',(array)$chk_rikul_d);
		$chk_diagnosa_kepe				= $this->input->post('diagnosa_kepe'); $diagnosa_kepe	= implode(';',(array)$chk_diagnosa_kepe);
		$diagnosa_kepe_text 			= $this->input->post('diagnosa_kepe_text');
		$chk_perlu_doa_a				= $this->input->post('perlu_doa_a'); $perlu_doa_a	= implode(';',(array)$chk_perlu_doa_a);
		$chk_intimp_a					= $this->input->post('intimp_a'); $intimp_a	= implode(';',(array)$chk_intimp_a);
		$chk_intimp_b					= $this->input->post('intimp_b'); $intimp_b	= implode(';',(array)$chk_intimp_b);
		$chk_instruksi_medik_a			= $this->input->post('instruksi_medik_a'); $instruksi_medik_a	= implode(';',(array)$chk_instruksi_medik_a);
		$instruksi_medik_a_text 		= $this->input->post('instruksi_medik_a_text');
		$instruksi_medik_b_text 		= $this->input->post('instruksi_medik_b_text');
		$instruksi_medik_c_text 		= $this->input->post('instruksi_medik_c_text');
		$instruksi_medik_d_text 		= $this->input->post('instruksi_medik_d_text');
		$instruksi_medik_e_text 		= $this->input->post('instruksi_medik_e_text');
		$instruksi_medik_f_text 		= $this->input->post('instruksi_medik_f_text');
		$instruksi_medik_g_text 		= $this->input->post('instruksi_medik_g_text');
		$instruksi_medik_h_text 		= $this->input->post('instruksi_medik_h_text');
		$instruksi_medik_i_text 		= $this->input->post('instruksi_medik_i_text');
		$instruksi_medik_j_text 		= $this->input->post('instruksi_medik_j_text');
		$instruksi_medik_k_text 		= $this->input->post('instruksi_medik_k_text');
		$instruksi_medik_l_text 		= $this->input->post('instruksi_medik_l_text');
		$chk_penyulit					= $this->input->post('obs_a'); $penyulit	= implode(';',(array)$chk_penyulit);
		$penyulit_txt 					= $this->input->post('obs_lainnya_txt');
		$chk_eva_kep_a					= $this->input->post('eva_kep_a'); $eval_kepe	= implode(';',(array)$chk_eva_kep_a);

		$rs = $this->mdl->data_pasien_ranap($id_reg);

		$checkdatadulu = $this->mdl->datahdnemu($id);
		$checknemu = $checkdatadulu->nemu;

		if($checknemu==1){
			///////////////////////////
			$data_hemo = array(
				'tgl_haritgljam' 			=>	$tgl_haritgljam,
				'nomesin'					=>	$nomesin,
				'hdke'						=>	$hdke,
				'tipe_dializer'				=>	$tipe_dializer,
				'riwalergiobat'				=>	$riwalergiobat,
				'riwalergiobat_text'		=>	$riwalergiobat_text,
				'diagnosamedis'				=>	$diagnosamedis,
				'carabayar'					=>	$carabayar,
				'carabayar_text'			=>	$carabayar_text,
				'keluhan_utama'				=>	$keluhan_utama,
				'keluhan_utama_rad'			=>	$keluhan_utama_rad,
				'keluhan_utama_1_text'		=>	$keluhan_utama_1_text,
				'keluhan_utama_2_text'		=>	$keluhan_utama_2_text,
				'keadaan_umum_1'			=>	$keadaan_umum_1,
				'keadaan_umum_2_a_text'		=>	$keadaan_umum_2_a_text,
				'keadaan_umum_2_b_text'		=>	$keadaan_umum_2_b_text,
				'keadaan_umum_3'			=>	$keadaan_umum_3,
				'keadaan_umum_3_a_text'		=>	$keadaan_umum_3_a_text,
				'keadaan_umum_4'			=>	$keadaan_umum_4,
				'keadaan_umum_4_a_text'		=>	$keadaan_umum_4_a_text,
				'keadaan_umum_5'			=>	$keadaan_umum_5,
				'keadaan_umum_6'			=>	$keadaan_umum_6,
				'keadaan_umum_7_a_text'		=>	$keadaan_umum_7_a_text,
				'keadaan_umum_7_b_text'		=>	$keadaan_umum_7_b_text,
				'keadaan_umum_7_c_text'		=>	$keadaan_umum_7_c_text,
				'keadaan_umum_7_d_text'		=>	$keadaan_umum_7_d_text,
				'keadaan_umum_8'			=>	$keadaan_umum_8,
				'keadaan_umum_8_a_text'		=>	$keadaan_umum_8_a_text,
				'keadaan_umum_9_a'			=>	$keadaan_umum_9_a,
				'keadaan_umum_9_b'			=>	$keadaan_umum_9_b,
				'keadaan_umum_9_c'			=>	$keadaan_umum_9_c,
				'keadaan_umum_9_d'			=>	$keadaan_umum_9_d,
				'keadaan_umum_9_e'			=>	$keadaan_umum_9_e,
				'keadaan_umum_9_f'			=>	$keadaan_umum_9_f,
				'skor_9'					=>	$skor_9,
				'pemeriksaan_penunjang_10'	=>	$pemeriksaan_penunjang_10,
				'krn_a_text'				=>	$krn_a_text,
				'krn_b_text'				=>	$krn_b_text,
				'krn_c_text'				=>	$krn_c_text,
				'ksm_a'						=>	$ksm_a,
				'rikul_a'					=>	$rikul_a,
				'rikul_a_text'				=>	$rikul_a_text,
				'rikul_b'					=>	$rikul_b,
				'rikul_b_text'				=>	$rikul_b_text,
				'rikul_c'					=>	$rikul_c,
				'rikul_d'					=>	$rikul_d,
				'diagnosa_kepe'				=>	$diagnosa_kepe,
				'diagnosa_kepe_text'		=>	$diagnosa_kepe_text,
				'perlu_doa_a'				=>	$perlu_doa_a,
				'intimp_a'					=>	$intimp_a,
				'intimp_b'					=>	$intimp_b,
				'instruksi_medik_a'			=>	$instruksi_medik_a,
				'instruksi_medik_a_text'	=>	$instruksi_medik_a_text,
				'instruksi_medik_b_text'	=>	$instruksi_medik_b_text,
				'instruksi_medik_c_text'	=>	$instruksi_medik_c_text,
				'instruksi_medik_d_text'	=>	$instruksi_medik_d_text,
				'instruksi_medik_e_text'	=>	$instruksi_medik_e_text,
				'instruksi_medik_f_text'	=>	$instruksi_medik_f_text,
				'instruksi_medik_g_text'	=>	$instruksi_medik_g_text,
				'instruksi_medik_h_text'	=>	$instruksi_medik_h_text,
				'instruksi_medik_i_text'	=>	$instruksi_medik_i_text,
				'instruksi_medik_j_text'	=>	$instruksi_medik_j_text,
				'instruksi_medik_k_text'	=>	$instruksi_medik_k_text,
				'instruksi_medik_l_text'	=>	$instruksi_medik_l_text,
				'penyulit'					=>	$penyulit,
				'penyulit_txt'				=>	$penyulit_txt,
				'eval_kepe'					=>	$eval_kepe,
				'updated'					=>  date('Y-m-d H:i:s'),
				'status'					=>  '0',
				'updator'					=> $creator
			);

			$where_hemo = array(
				'id'	 					=>	$id
			);

			$this->mdl->edit_data_asm_ranap_hemodial($where_hemo, $data_hemo);

		}else{
			///////////////////////////
			$data_hemo = array(
				'dateasmri' 				=>	$dateasmri,
				'id_reg' 					=>	$id_reg,
				'id_pasien' 				=>	$id_pasien,
				'tgl_haritgljam' 			=>	$tgl_haritgljam,
				'nomesin'					=>	$nomesin,
				'hdke'						=>	$hdke,
				'tipe_dializer'				=>	$tipe_dializer,
				'riwalergiobat'				=>	$riwalergiobat,
				'riwalergiobat_text'		=>	$riwalergiobat_text,
				'diagnosamedis'				=>	$diagnosamedis,
				'carabayar'					=>	$carabayar,
				'carabayar_text'			=>	$carabayar_text,
				'keluhan_utama'				=>	$keluhan_utama,
				'keluhan_utama_rad'			=>	$keluhan_utama_rad,
				'keluhan_utama_1_text'		=>	$keluhan_utama_1_text,
				'keluhan_utama_2_text'		=>	$keluhan_utama_2_text,
				'keadaan_umum_1'			=>	$keadaan_umum_1,
				'keadaan_umum_2_a_text'		=>	$keadaan_umum_2_a_text,
				'keadaan_umum_2_b_text'		=>	$keadaan_umum_2_b_text,
				'keadaan_umum_3'			=>	$keadaan_umum_3,
				'keadaan_umum_3_a_text'		=>	$keadaan_umum_3_a_text,
				'keadaan_umum_4'			=>	$keadaan_umum_4,
				'keadaan_umum_4_a_text'		=>	$keadaan_umum_4_a_text,
				'keadaan_umum_5'			=>	$keadaan_umum_5,
				'keadaan_umum_6'			=>	$keadaan_umum_6,
				'keadaan_umum_7_a_text'		=>	$keadaan_umum_7_a_text,
				'keadaan_umum_7_b_text'		=>	$keadaan_umum_7_b_text,
				'keadaan_umum_7_c_text'		=>	$keadaan_umum_7_c_text,
				'keadaan_umum_7_d_text'		=>	$keadaan_umum_7_d_text,
				'keadaan_umum_8'			=>	$keadaan_umum_8,
				'keadaan_umum_8_a_text'		=>	$keadaan_umum_8_a_text,
				'keadaan_umum_9_a'			=>	$keadaan_umum_9_a,
				'keadaan_umum_9_b'			=>	$keadaan_umum_9_b,
				'keadaan_umum_9_c'			=>	$keadaan_umum_9_c,
				'keadaan_umum_9_d'			=>	$keadaan_umum_9_d,
				'keadaan_umum_9_e'			=>	$keadaan_umum_9_e,
				'keadaan_umum_9_f'			=>	$keadaan_umum_9_f,
				'skor_9'					=>	$skor_9,
				'pemeriksaan_penunjang_10'	=>	$pemeriksaan_penunjang_10,
				'krn_a_text'				=>	$krn_a_text,
				'krn_b_text'				=>	$krn_b_text,
				'krn_c_text'				=>	$krn_c_text,
				'ksm_a'						=>	$ksm_a,
				'rikul_a'					=>	$rikul_a,
				'rikul_a_text'				=>	$rikul_a_text,
				'rikul_b'					=>	$rikul_b,
				'rikul_b_text'				=>	$rikul_b_text,
				'rikul_c'					=>	$rikul_c,
				'rikul_d'					=>	$rikul_d,
				'diagnosa_kepe'				=>	$diagnosa_kepe,
				'diagnosa_kepe_text'		=>	$diagnosa_kepe_text,
				'perlu_doa_a'				=>	$perlu_doa_a,
				'intimp_a'					=>	$intimp_a,
				'intimp_b'					=>	$intimp_b,
				'instruksi_medik_a'			=>	$instruksi_medik_a,
				'instruksi_medik_a_text'	=>	$instruksi_medik_a_text,
				'instruksi_medik_b_text'	=>	$instruksi_medik_b_text,
				'instruksi_medik_c_text'	=>	$instruksi_medik_c_text,
				'instruksi_medik_d_text'	=>	$instruksi_medik_d_text,
				'instruksi_medik_e_text'	=>	$instruksi_medik_e_text,
				'instruksi_medik_f_text'	=>	$instruksi_medik_f_text,
				'instruksi_medik_g_text'	=>	$instruksi_medik_g_text,
				'instruksi_medik_h_text'	=>	$instruksi_medik_h_text,
				'instruksi_medik_i_text'	=>	$instruksi_medik_i_text,
				'instruksi_medik_j_text'	=>	$instruksi_medik_j_text,
				'instruksi_medik_k_text'	=>	$instruksi_medik_k_text,
				'instruksi_medik_l_text'	=>	$instruksi_medik_l_text,
				'penyulit'					=>	$penyulit,
				'penyulit_txt'				=>	$penyulit_txt,
				'eval_kepe'					=>	$eval_kepe,
				'created'					=>  date('Y-m-d H:i:s'),
				'status'					=>  '0',
				'creator'					=> $creator,
				'updated'					=> 'null',
				'updator'					=> 'null',
			  );
		  
			  $this->mdl->add_data_asm_ranap_hemodial($data_hemo);
			}
			////////////////////////////
    		echo json_encode(array("status" => true));
  }

  public function asm_hemodial_add_pre(){
	$creator = @$this->session->userdata['sp']->login_name;

	$id					= $this->input->post('id');
	$id_reg				= $this->input->post('id_reg');
	$line_1_a			= $this->input->post('line_1_a');
	$line_1_b			= $this->input->post('line_1_b');
	$line_1_c			= $this->input->post('line_1_c');
	$line_1_d			= $this->input->post('line_1_d');
	$line_1_e			= $this->input->post('line_1_e');
	$line_1_f			= $this->input->post('line_1_f');
	$line_1_g			= $this->input->post('line_1_g');
	$line_1_h			= $this->input->post('line_1_h');
	$line_1_i			= $this->input->post('line_1_i');
	$line_1_j			= $this->input->post('line_1_j');
	$line_1_k			= $this->input->post('line_1_k');
	$line_1_l			= $this->input->post('line_1_l');
	$line_1_m			= $this->input->post('line_1_m');


	$checkdatadulu = $this->mdl->datahdprenemu($id);
	$checknemu = $checkdatadulu->nemu;

	if($checknemu < 1){
		$dateasmri  		= date('Y-m-d H:i:s');
		$rs = $this->mdl->data_pasien_ranap($id_reg);
		$id_pasien 			= $rs['id_pasien'];
	///////////////////////////
	  $data_hemo = array(
		'dateasmri' 	=>	$dateasmri,
		'id_reg' 		=>	$id_reg,
		'id_hd'			=> 	$id,
		'id_pasien' 	=>	$id_pasien,
		'jam'			=>	$line_1_a,
		'qb'			=>	$line_1_b,
		'ufrate'		=>	$line_1_c,
		'tekdarah'		=>	$line_1_d,
		'nadi'			=>	$line_1_e,
		'suhu'			=>	$line_1_f,
		'resp'			=>	$line_1_g,
		'nacl'			=>	$line_1_h,
		'dektrose'		=>	$line_1_i,
		'makanminum'	=>	$line_1_j,
		'lainlain'		=>	$line_1_k,
		'ufvolume'		=>	$line_1_l,
		'ket'			=>	$line_1_m,
		'status'		=>  '0',
		'created'		=>  date('Y-m-d H:i:s'),
		'creator'		=> $creator
	  );
		$this->mdl->add_data_asm_ranap_hemodial_pre($data_hemo);
	}else{
	  $data_hemo = array(
		'jam'			=>	$line_1_a,
		'qb'			=>	$line_1_b,
		'ufrate'		=>	$line_1_c,
		'tekdarah'		=>	$line_1_d,
		'nadi'			=>	$line_1_e,
		'suhu'			=>	$line_1_f,
		'resp'			=>	$line_1_g,
		'nacl'			=>	$line_1_h,
		'dektrose'		=>	$line_1_i,
		'makanminum'	=>	$line_1_j,
		'lainlain'		=>	$line_1_k,
		'ufvolume'		=>	$line_1_l,
		'ket'			=>	$line_1_m,
		'status'		=>  '0',
		'updated'		=>  date('Y-m-d H:i:s'),
		'updator'		=> $creator
	  );

	  $where_hemo = array(
		'id_hd'			=>	$id
	  );
		
		$this->mdl->edit_data_asm_ranap_hemodial_pre($where_hemo, $data_hemo);
	}

	////////////////////////////



	echo json_encode(array("status" => true));
  }

  public function asm_hemodial_add_intra(){
	$creator = @$this->session->userdata['sp']->login_name;

	$id					= $this->input->post('id');
	$id_reg				= $this->input->post('id_reg');
	$line_2_a			= $this->input->post('line_2_a');
	$line_2_b			= $this->input->post('line_2_b');
	$line_2_c			= $this->input->post('line_2_c');
	$line_2_d			= $this->input->post('line_2_d');
	$line_2_e			= $this->input->post('line_2_e');
	$line_2_f			= $this->input->post('line_2_f');
	$line_2_g			= $this->input->post('line_2_g');
	$line_2_h			= $this->input->post('line_2_h');
	$line_2_i			= $this->input->post('line_2_i');
	$line_2_j			= $this->input->post('line_2_j');
	$line_2_k			= $this->input->post('line_2_k');
	$line_2_l			= $this->input->post('line_2_l');
	$line_2_m			= $this->input->post('line_2_m');

	$dateasmri  		= date('Y-m-d H:i:s');
	$rs = $this->mdl->data_pasien_ranap($id_reg);
	$id_pasien 			= $rs['id_pasien'];
	///////////////////////////
	  $data_hemo = array(
		'dateasmri' 	=>	$dateasmri,
		'id_reg' 		=>	$id_reg,
		'id_hd'			=> 	$id,
		'id_pasien' 	=>	$id_pasien,
		'jam'			=>	$line_2_a,
		'qb'			=>	$line_2_b,
		'ufrate'		=>	$line_2_c,
		'tekdarah'		=>	$line_2_d,
		'nadi'			=>	$line_2_e,
		'suhu'			=>	$line_2_f,
		'resp'			=>	$line_2_g,
		'nacl'			=>	$line_2_h,
		'dektrose'		=>	$line_2_i,
		'makanminum'	=>	$line_2_j,
		'lainlain'		=>	$line_2_k,
		'ufvolume'		=>	$line_2_l,
		'ket'			=>	$line_2_m,
		'status'		=>  '0',
		'created'		=>  date('Y-m-d H:i:s'),
		'creator'		=> $creator
	  );
		$this->mdl->add_data_asm_ranap_hemodial_intra($data_hemo);

	////////////////////////////



	echo json_encode(array("status" => true));
  }

  public function asm_hemodial_add_post(){
	$creator = @$this->session->userdata['sp']->login_name;

	$id					= $this->input->post('id');
	$id_reg				= $this->input->post('id_reg');
	$line_3_a			= $this->input->post('line_3_a');
	$line_3_b			= $this->input->post('line_3_b');
	$line_3_c			= $this->input->post('line_3_c');
	$line_3_d			= $this->input->post('line_3_d');
	$line_3_e			= $this->input->post('line_3_e');
	$line_3_f			= $this->input->post('line_3_f');
	$line_3_g			= $this->input->post('line_3_g');
	$line_3_h			= $this->input->post('line_3_h');
	$line_3_i			= $this->input->post('line_3_i');
	$line_3_j			= $this->input->post('line_3_j');
	$line_3_k			= $this->input->post('line_3_k');
	$line_3_l			= $this->input->post('line_3_l');
	$line_3_m			= $this->input->post('line_3_m');


	$checkdatadulu = $this->mdl->datahdpostnemu($id_reg);
	$checknemu = $checkdatadulu->nemu;

	if($checknemu < 1){
		$dateasmri  		= date('Y-m-d H:i:s');
		$rs = $this->mdl->data_pasien_ranap($id_reg);
		$id_pasien 			= $rs['id_pasien'];
	///////////////////////////
	  $data_hemo = array(
		'dateasmri' 	=>	$dateasmri,
		'id_reg' 		=>	$id_reg,
		'id_hd'			=> 	$id,
		'id_pasien' 	=>	$id_pasien,
		'jam'			=>	$line_3_a,
		'qb'			=>	$line_3_b,
		'ufrate'		=>	$line_3_c,
		'tekdarah'		=>	$line_3_d,
		'nadi'			=>	$line_3_e,
		'suhu'			=>	$line_3_f,
		'resp'			=>	$line_3_g,
		'nacl'			=>	$line_3_h,
		'dektrose'		=>	$line_3_i,
		'makanminum'	=>	$line_3_j,
		'lainlain'		=>	$line_3_k,
		'ufvolume'		=>	$line_3_l,
		'ket'			=>	$line_3_m,
		'status'		=>  '0',
		'created'		=>  date('Y-m-d H:i:s'),
		'creator'		=> $creator
	  );
		$this->mdl->add_data_asm_ranap_hemodial_post($data_hemo);
	}else{
	  $data_hemo = array(
		'jam'			=>	$line_3_a,
		'qb'			=>	$line_3_b,
		'ufrate'		=>	$line_3_c,
		'tekdarah'		=>	$line_3_d,
		'nadi'			=>	$line_3_e,
		'suhu'			=>	$line_3_f,
		'resp'			=>	$line_3_g,
		'nacl'			=>	$line_3_h,
		'dektrose'		=>	$line_3_i,
		'makanminum'	=>	$line_3_j,
		'lainlain'		=>	$line_3_k,
		'ufvolume'		=>	$line_3_l,
		'ket'			=>	$line_3_m,
		'status'		=>  '0',
		'updated'		=>  date('Y-m-d H:i:s'),
		'updator'		=> $creator
	  );

	  $where_hemo = array(
		'id'			=>	$id
	  );
		
		$this->mdl->edit_data_asm_ranap_hemodial_post($where_hemo, $data_hemo);
	}

	////////////////////////////



	echo json_encode(array("status" => true));
  }

  public function listprehd(){
	$id			= $this->input->post('id');
	$data		= $this->mdl->datahdprelist($id);
	echo json_encode($data);
  }

  public function listintrahd(){
	$id			= $this->input->post('id');
	$data		= $this->mdl->datahdintralist($id);
	echo json_encode($data);
  }

  public function listposthd(){
	$id			= $this->input->post('id');
	$data		= $this->mdl->datahdpostlist($id);
	echo json_encode($data);
  }

  public function deleteloghemodial(){
	$creator 				= @$this->session->userdata['sp']->login_name;
	$id 					= $this->input->post('id');
	$data = array(
		'status'	 		=> '1',
		'updated'			=> date('Y-m-d H:i:s'),
		'updator'			=> $creator
	  );

	$where = array(
		'id'				=> $id
	);
	$table = "frm_asm_hemodialisa";
		
	$this->mdl->update_data($where, $data, $table);
    echo json_encode(array("status" => true));
  }

  public function delintra(){
	$creator 				= @$this->session->userdata['sp']->login_name;
	$id 					= $this->input->post('id');
	$data = array(
		'status'	 		=> '1',
		'updated'			=> date('Y-m-d H:i:s'),
		'updator'			=> $creator
	  );

	$where = array(
		'id'				=> $id
	);
	$table = "frm_asm_hemodialisa_intra";
		
	$this->mdl->update_data($where, $data, $table);
    echo json_encode(array("status" => true));
  }

  public function tbloghemodial(){
	$id_reg	= $this->input->post('id_reg');
	$data = $this->mdl->getloghemodial($id_reg);
	echo json_encode($data);
  }

  public function detailloghemodial(){
	$id		= $this->input->post('id');
	$data 	= $this->mdl->getdetailloghemodial($id);
	echo json_encode($data);
  }

}
