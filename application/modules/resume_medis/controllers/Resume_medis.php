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
		#print_r($data_resmed);
		$id_pasien 	 	= $data_pasien['id_pasien'];

		$riwayat_pasien 	= $this->smartlib->riwayat_pasien($id_pasien);

		// ------------------------ SETTING UP DATA AWAL ------------------------
		#print_r($data_pasien);echo "<br><br>";
		$data_resmed['riwayat_sakit_dulu'] = str_replace("<br />","",
																				 str_replace("<br /><br />","<br />", 
																				 str_replace("<br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />",  
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 str_replace("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />","<br />", 
																				 $data_resmed['riwayat_sakit_dulu'])))))))))))))))))));
		foreach($data_resmed as $k => $v)
		{
			if($v=='') @$data_resmed[$k] = $data_asmri[$k];
		}
		if(empty($data_resmed['data_resmed'])) $data_resmed['resmed_date'] = date('Y-m-d');
		if(empty($data_resmed['riwayat_pengobatan'])) $data_resmed['riwayat_pengobatan'] = $data_asmri['p_instruksi'];

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

		$data_id_eresep = $this->get_data_resep_pulang($id_reg);

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
			'data_id_eresep'		=> json_encode($data_id_eresep),
			'riwayat_pasien' => $riwayat_pasien,
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
		#$data_insert_update['riwayat_sakit_dulu'] 			= preg_replace('~\\\r\\\n~',"\n", $this->input->post('riwayat_sakit_dulu'));
		$data_insert_update['riwayat_sakit_dulu'] 				= $this->input->post('riwayat_sakit_dulu');
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
		
		$data_insert_update['tanda_vital_saat_pulang'] 		= $this->input->post('tanda_vital_saat_pulang');

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

	public function print_resmed($id_resmed,$id_reg)
	{	
		date_default_timezone_set("ASIA/JAKARTA");
		$rs_info 	= $this->smartlib->rs_info();
		$nama_rs	= $rs_info['nama_rs'];
		$alamat_rs	= $rs_info['alamat_rs'];
		$telp_rs	= $rs_info['telp_rs'];
		$fax_rs		= $rs_info['fax_rs'];

		$pasien 			= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
		$data_pasien 	= $this->mdl->get_data_pasien_byred($id_reg);
		$data_resmed 	= $this->mdl->get_data_resume_medis_by_id_reg($id_reg);
		$id_pasien 	 	= $data_pasien['id_pasien'];

		$data_resmed['diag_medis_banding_text'] = explode(";",$data_resmed['diag_medis_banding_text']);
		$data_resmed['planning_text'] = explode(";",$data_resmed['planning_text']);
		$data_resmed['kondisi_ibadah'] 	= explode(";",$data_resmed['kondisi_ibadah']);
		$data_resmed['kondisi_psiko'] 	= explode(";",$data_resmed['kondisi_psiko']);
		$data_resmed['cara_keluar'] 		= explode(";",$data_resmed['cara_keluar']);
		$data_resmed['kondisi_keluar'] 	= explode(";",$data_resmed['kondisi_keluar']);
		$data_resmed['tindak_lanjut'] 	= explode(";",$data_resmed['tindak_lanjut']);
		$data_resmed['pertanyaan'] 			= explode(";",$data_resmed['pertanyaan']);



		// -- ORDER LAB YG BELUM SELESAI ---
		$sql = "SELECT 	*
						FROM 		`soap_trx_lab_order_digital_request` a
						WHERE 	a.`status_proses` IS NULL AND `registrasi`='".$id_reg."'
						";
		$query = $this->dbhis->query($sql);
		$rs_lab_pending = $query->result_array();

		$data_id_eresep = $this->get_data_resep_pulang($id_reg);
		$data=array(
			'nama_rs'					=> $nama_rs,
			'alamat_rs'				=> $alamat_rs,
			'telp_rs'					=> $telp_rs,
			'fax_rs'					=> $fax_rs,
			'pasien'					=> $pasien,
			'data_pasien'			=> $data_pasien,
			'data_resmed'			=> $data_resmed,
			'rs_lab_pending'	=> $rs_lab_pending,
			'data_id_eresep'	=> json_encode($data_id_eresep),
		);

		$this->load->view('vpasien_pulang', $data);
	}

	public function print_resmed_v2($id_reg)
	{	
		#print_r($this->session->userdata['sp']->sip_str);
		date_default_timezone_set("ASIA/JAKARTA");
		$rs_info 	= $this->smartlib->rs_info();
		$nama_rs	= $rs_info['nama_rs'];
		$alamat_rs	= $rs_info['alamat_rs'];
		$telp_rs	= $rs_info['telp_rs'];
		$fax_rs		= $rs_info['fax_rs'];

		$pasien 			= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
		$data_pasien 	= $this->mdl->get_data_pasien_byred($id_reg);
		$data_resmed 	= $this->mdl->get_data_resume_medis_by_id_reg($id_reg);
		$id_pasien 	 	= $data_pasien['id_pasien'];
		
		#print_r($pasien);
		#print_r($data_pasien);
		#print_r($data_resmed);

		$data_resmed['diag_medis_banding_text'] = explode(";",$data_resmed['diag_medis_banding_text']);
		$data_resmed['planning_text'] = explode(";",$data_resmed['planning_text']);
		$data_resmed['kondisi_ibadah'] 	= explode(";",$data_resmed['kondisi_ibadah']);
		$data_resmed['kondisi_psiko'] 	= explode(";",$data_resmed['kondisi_psiko']);
		$data_resmed['cara_keluar'] 		= explode(";",$data_resmed['cara_keluar']);
		$data_resmed['kondisi_keluar'] 	= explode(";",$data_resmed['kondisi_keluar']);
		$data_resmed['tindak_lanjut'] 	= explode(";",$data_resmed['tindak_lanjut']);
		$data_resmed['pertanyaan'] 			= explode(";",$data_resmed['pertanyaan']);



		// -- ORDER LAB YG BELUM SELESAI ---
		$sql = "SELECT 	*
						FROM 		`soap_trx_lab_order_digital_request` a
						WHERE 	a.`status_proses` IS NULL AND `registrasi`='".$id_reg."'
						";
		$query = $this->dbhis->query($sql);
		$rs_lab_pending = $query->result_array();

		$data_id_eresep = $this->get_data_resep_pulang($id_reg);
		$data=array(
			'nama_rs'					=> $nama_rs,
			'alamat_rs'				=> $alamat_rs,
			'telp_rs'					=> $telp_rs,
			'fax_rs'					=> $fax_rs,
			'pasien'					=> $pasien,
			'data_pasien'			=> $data_pasien,
			'data_resmed'			=> $data_resmed,
			'rs_lab_pending'	=> $rs_lab_pending,
			'data_id_eresep'	=> json_encode($data_id_eresep),
			'id_reg'					=> $id_reg,
			'last_ruangan'		=> $this->smartlib->get_ruangan_pasien($id_reg),
		);

		$this->load->view('vpasien_pulang_v2', $data);
	}
	
	public function get_data_resep_pulang($id_reg)
	{
		$sql = "SELECT * FROM soap_eresep a WHERE a.id_reg='".$id_reg."' AND a.is_eresep_pulang=1";
		$query = $this->dbhis->query($sql);
		$rs = $query->result_array();
		$data_id_eresep = array();
		foreach($rs as $k => $v)
		{
			$data_id_eresep[] = $v['id_eresep'];
		}
		return $data_id_eresep;
	}

	public function monitorng_resmed()
	{
		$id_role  = @$this->session->userdata['sp']->id_role;

		$this->make_bread->add('Rawat Inap', '', 1);
    $this->make_bread->add('Monitoring Resume Medis', '', 0);
    $breadcrumb = $this->make_bread->output();

    $rs = $this->mdl->list_monitoring_resmed();

    //print_r($data_row);
    $data = array(
      'breadcrumb'  => $breadcrumb,
      'rs'          => $rs,
			'id_role'			=> $id_role,
    );

    $this->load->view('vlist_monitoring_resmed', $data);
	}

	public function print_resume_medis_for_nurse()
	{

	}
	
	public function gen_qrcode($str)
  {
		$this->load->library('ciqrcode');
		header("Content-Type: image/png");
		$config['quality']      = true; //boolean, the default is true
		#$config['size']         = '1024'; //interger, the default is 1024
		#$config['black']        = array(224,255,255); // array, default is array(255,255,255)
		#$config['white']        = array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
		$params['data'] = $str;
		$params['level'] = 'H'; //H=High
		$params['size'] = 14;
		$this->ciqrcode->generate($params);
	}

}
