<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frm_geriatri extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');
		$this->load->model('Mdl_geriatri','mdl');
	}

  public function frmasm($id_reg){
	$pasien 		= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
	$id_pasien		= $pasien['id_pasien'];
	$riwayat_pasien	= $this->smartlib->riwayat_pasien($id_pasien);

	$jenis_asm='NURSE';
	$sql = "SELECT a.id_asmri
        FROM soap_asm_ri a
        WHERE a.id_reg = '".$id_reg."'
        AND a.jenis_asm = '".$jenis_asm."'
		AND a.kategori <>'CPPT' ORDER BY a.created DESC";
    //echo "<pre>".$sql."</pre>";
    $query = $this->dbsupp->query($sql);
    $rs = $query->row_array();

	$id_asmri = $rs['id_asmri'];

	$cek_umur = $this->mdl->get_umur($id_reg);
	$umur = $cek_umur['umur'];

    $data = array(
		'id_asmri'		 => $id_asmri,
		'id_reg'		 => $id_reg,
		'riwayat_pasien' => $riwayat_pasien,
    );
	$this->load->view('frm_asm_geriatri', $data);
  }

  public function asm_geriatri_add($id_reg,$kategori){
    	$id_doc  = @$this->session->userdata['sp']->id_dokter;
    	if ($id_doc != NULL) {
    	  $id_dokter = $id_doc;
    	} else {
    	  $id_dokter = '';
    	}
		$creator = @$this->session->userdata['sp']->login_name;

		$rs = $this->mdl->data_pasien_ranap($id_reg);

		$sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'dbsupp' AND TABLE_NAME = 'soap_asm_ri'";
		$query = $this->dbsupp->query($sql);
		$row = $query->row_array();
		
		////////////////////////////
		$id_asmri 						= $row['id'];
		$dateasmri  					= date('Y-m-d H:i:s');
		$datepengkajian 				= date('Y-m-d H:i:s');
		$regdate 						= $rs['regdate'];
		$asal_masuk 					= $this->input->post('asal_masuk');
		$cara_masuk 					= $this->input->post('cara_masuk');
		$id_pasien 						= $rs['id_pasien'];
		$nama_pasien 					= $rs['nama_pasien'];
		$keluhan_utama 					= $this->input->post('keluhan_utama');
		$riwayat_sakit 					= $this->input->post('riwayat_sakit');
		$riwayat_sakit_dulu 			= $this->input->post('riwayat_sakit_dulu');
		$riwayat_pengobatan 			= $this->input->post('riwayat_pengobatan');
		$riwayat_sakit_keluarga 		= $this->input->post('riwayat_sakit_keluarga');
		$riwayat_alergi 				= $this->input->post('riwayat_alergi');
		$chk_status_psikologi			= $this->input->post('status_psikologi');
		$status_psikologi	    		= implode(';',(array)$chk_status_psikologi);
		$sse_nikah						= $this->input->post('sse_nikah');
		$sse_study						= $this->input->post('sse_study');
		$sse_job						= $this->input->post('sse_job');
		$sse_live						= $this->input->post('sse_live');
		$sse_agama						= $this->input->post('sse_agama');
		$status_kultural 				= $this->input->post('status_kultural');
		$ibadah 						= $this->input->post('ibadah');
		$thaharoh 						= $this->input->post('thaharoh');
		$sholat 						= $this->input->post('sholat');
		$chk_bim_spiritual_muslim		= $this->input->post('bim_spiritual_muslim');
		$bim_spiritual_muslim			= implode(';',(array)$chk_bim_spiritual_muslim);
		$chk_bim_spiritual_nonmuslim	= $this->input->post('bim_spiritual_nonmuslim');
		$bim_spiritual_nonmuslim		= implode(';',(array)$chk_bim_spiritual_nonmuslim);
		$kesadaran 						= $this->input->post('kesadaran');
		$keadaan_umum 					= $this->input->post('keadaan_umum');
		$td 							= $this->input->post('td');
		$gcs 							= $this->input->post('gcs');
		$nadi 							= $this->input->post('nadi');
		$suhu 							= $this->input->post('suhu');
		$nafas 							= $this->input->post('nafas');
		$reaksi_cahaya 					= $this->input->post('reaksi_cahaya');
		$saturasi_oksigen 				= $this->input->post('saturasi_oksigen');
		$tinggi 						= $this->input->post('tinggi');
		$berat 							= $this->input->post('berat');
		$fisik_khusus 					= $this->input->post('fisik_khusus');
		$pu_kepala						= $this->input->post('pu_kepala');
		$pu_rambut						= $this->input->post('pu_rambut');
		$pu_wajah						= $this->input->post('pu_wajah');
		$pu_mata						= $this->input->post('pu_mata');
		$pu_gigi						= $this->input->post('pu_gigi');
		$pu_tenggorokan					= $this->input->post('pu_tenggorokan');
		$pu_lidah						= $this->input->post('pu_lidah');
		$pu_leher						= $this->input->post('pu_leher');
		$pu_abdomen						= $this->input->post('pu_abdomen');
		$pu_dada						= $this->input->post('pu_dada');
		$pu_respirasi					= $this->input->post('pu_respirasi');
		$pu_jantung						= $this->input->post('pu_jantung');
		$pu_integumen					= $this->input->post('pu_integumen');
		$pu_ekstremitas					= $this->input->post('pu_ekstremitas');
		$pu_genetalia					= $this->input->post('pu_genetalia');
		$pu_elimitas					= $this->input->post('pu_elimitas');
		$kualitas_nyeri					= $this->input->post('kualitas_nyeri');
		$frekuensi_nyeri				= $this->input->post('frekuensi_nyeri');
		$waktu_nyeri					= $this->input->post('waktu_nyeri');
		$intesnsitas_nyeri				= $this->input->post('intesnsitas_nyeri');
		$nyeri							= $this->input->post('nyeri');
		$pengaruh_nyeri					= $this->input->post('pengaruh_nyeri');
		$aktivitas						= $this->input->post('aktivitas');
		$restrain						= $this->input->post('restrain');
		$total_skor2					= $this->input->post('total_skor2');
		$chk_keluhan_saat_ini			= $this->input->post('keluhan_saat_ini'); $keluhan_saat_ini = implode(';',(array)$chk_keluhan_saat_ini);
		$sf_makan 						= $this->input->post('sf_makan');
		$sf_transfer 					= $this->input->post('sf_transfer');
		$sf_grooming 					= $this->input->post('sf_grooming');
		$sf_toilet 						= $this->input->post('sf_toilet');
		$sf_mandi 						= $this->input->post('sf_mandi');
		$sf_jalan 						= $this->input->post('sf_jalan');
		$sf_tangga 						= $this->input->post('sf_tangga');
		$sf_berpakaian 					= $this->input->post('sf_berpakaian');
		$sf_bowel 						= $this->input->post('sf_bowel');
		$sf_bladder 					= $this->input->post('sf_bladder');
		$sf_total 						= $this->input->post('sf_total');
		$resiko_jatuh_dws 				= $this->input->post('resiko_jatuh_dws');
		$pemeriksaan_penunjang 			= $this->input->post('pemeriksaan_penunjang');
		$masalah_kesehatan 				= $this->input->post('masalah_kesehatan');
		$masalah_keperawatan 			= $this->input->post('masalah_keperawatan');
		$rencana_keperawatan 			= $this->input->post('rencana_keperawatan');
		$rencana_medis 					= $this->input->post('rencana_medis');
		$chk_edukasi					= $this->input->post('edukasi'); $edukasi = implode(';',(array)$chk_edukasi);
		$chk_pasien_pulang				= $this->input->post('pasien_pulang'); $pasien_pulang = implode(';',(array)$chk_pasien_pulang);

		$skr_id_risiko_tinggi		= $this->input->post('skr_id_risiko_tinggi');
		$skr_id_text_pasien_rt		= $this->input->post('skr_id_text_pasien_rt');
		$skr_id_text_pelayanan_rt	= $this->input->post('skr_id_text_pelayanan_rt');
		$skr_id_text_tambahan_rt	= $this->input->post('skr_id_text_tambahan_rt');
		$skr_id_text_bukan_rt		= $this->input->post('skr_id_text_bukan_rt');
			
		//geriatri item
		$chk_mna_1						= $this->input->post('mna_1'); $mna_1 = implode(';',(array)$chk_mna_1);
		$chk_mna_2						= $this->input->post('mna_2'); $mna_2 = implode(';',(array)$chk_mna_2);
		$chk_mna_3						= $this->input->post('mna_3'); $mna_3 = implode(';',(array)$chk_mna_3);
		$chk_mna_4						= $this->input->post('mna_4'); $mna_4 = implode(';',(array)$chk_mna_4);
		$chk_mna_5						= $this->input->post('mna_5'); $mna_5 = implode(';',(array)$chk_mna_5);
		$chk_mna_6						= $this->input->post('mna_6'); $mna_6 = implode(';',(array)$chk_mna_6);
		$sudah_dibaca					= $this->input->post('sudah_dibaca');
		
		$chk_pareting					= $skr_id_risiko_tinggi;
		$pareting_txt_1					= $skr_id_text_pasien_rt;
		$pareting_txt_2					= $skr_id_text_pelayanan_rt;
		$pareting_txt_3					= $skr_id_text_tambahan_rt;
		/*
		$chk_pareting					= $this->input->post('pareting'); $pareting = implode(';',(array)$chk_pareting);
		$pareting_txt_1					= $this->input->post('pareting_txt_1');
		$pareting_txt_2					= $this->input->post('pareting_txt_2');
		$pareting_txt_3					= $this->input->post('pareting_txt_3');
		*/
		
		$chk_prior						= $this->input->post('prior'); $prior = implode(';',(array)$chk_prior);
		$diagnosa_medis 				= $this->input->post('diagnosa_medis'); 
		//end geriatri item

		///////////////////////////
    	$data = array(
			'id_asmri'			=> $id_asmri,
      		'asmri_date'				=> $dateasmri,
			'regdate'           		=> $regdate,
			'tgl_pengkajian'    		=> $datepengkajian,
			'asal_masuk'        		=> $asal_masuk,
			'cara_masuk'        		=> $cara_masuk,
			'id_reg'            		=> $id_reg,
			'id_pasien'         		=> $id_pasien,
      		'nama_pasien'       		=> $nama_pasien,
      		'id_dokter'         		=> $id_dokter,
      		'id_type'           		=> '2',
			'jenis_asm'         		=> 'NURSE',
			'kategori'	        		=> $kategori,
			'keluhan_utama'         	=> $keluhan_utama,
			'riwayat_sakit'				=> $riwayat_sakit,
			'riwayat_sakit_dulu'     	=> $riwayat_sakit_dulu,
			'riwayat_pengobatan'     	=> $riwayat_pengobatan,
			'riwayat_sakit_keluarga' 	=> $riwayat_sakit_keluarga,
			'riwayat_alergi'         	=> $riwayat_alergi,
			'status_psikologi'    		=> $status_psikologi,
			'sse_nikah'					=> $sse_nikah,
			'sse_study' 				=> $sse_study,
			'sse_job'   				=> $sse_job,
			'sse_live'  				=> $sse_live,
			'sse_agama' 				=> $sse_agama,
			'status_kultural'         	=> $status_kultural,
			'ibadah'         			=> $ibadah,
			'thaharoh'         			=> $thaharoh,
			'sholat'         			=> $sholat,
			'bim_spiritual_muslim'    	=> $bim_spiritual_muslim,
			'bim_spiritual_nonmuslim'	=> $bim_spiritual_nonmuslim,
			'kesadaran'    				=> $kesadaran,
			'keadaan_umum' 				=> $keadaan_umum,
			'td'         				=> $td,
			'gcs'         				=> $gcs,
			'nadi'         				=> $nadi,
			'suhu'         				=> $suhu,
			'nafas'         			=> $nafas,
			'reaksi_cahaya' 			=> $reaksi_cahaya,
			'saturasi_oksigen' 			=> $saturasi_oksigen,
			'tinggi'        			=> $tinggi,
			'berat'         			=> $berat,
			'fisik_khusus'  			=> $fisik_khusus,
			'pu_kepala'       			=> $pu_kepala,
			'pu_rambut'       			=> $pu_rambut,
			'pu_wajah'       			=> $pu_wajah,
			'pu_mata'         			=> $pu_mata,
			'pu_gigi'         			=> $pu_gigi,
			'pu_tenggorokan'  			=> $pu_tenggorokan,
			'pu_lidah'        			=> $pu_lidah,
			'pu_leher'        			=> $pu_leher,
			'pu_abdomen'      			=> $pu_abdomen,
			'pu_dada'         			=> $pu_dada,
			'pu_respirasi'    			=> $pu_respirasi,
			'pu_jantung'      			=> $pu_jantung,
			'pu_integumen'    			=> $pu_integumen,
			'pu_ekstremitas'			=> $pu_ekstremitas,
			'pu_genetalia'    			=> $pu_genetalia,
			'pu_elimitas'     			=> $pu_elimitas,
			'kualitas_nyeri'    		=> $kualitas_nyeri,
			'frekuensi_nyeri'   		=> $frekuensi_nyeri,
			'waktu_nyeri'       		=> $waktu_nyeri,
			'intesnsitas_nyeri'			=> $intesnsitas_nyeri,
			'nyeri'         			=> $nyeri,
			'pengaruh_nyeri'    		=> $pengaruh_nyeri,
			'aktivitas'         		=> $aktivitas,
			'restrain'         			=> $restrain,
			'total_skor2'       		=> $total_skor2,
			'keluhan_saat_ini'			=> $keluhan_saat_ini,
			'sf_makan'      			=> $sf_makan,
			'sf_transfer'   			=> $sf_transfer,
			'sf_grooming'   			=> $sf_grooming,
			'sf_toilet'     			=> $sf_toilet,
			'sf_mandi'      			=> $sf_mandi,
			'sf_jalan'      			=> $sf_jalan,
			'sf_tangga'     			=> $sf_tangga,
			'sf_berpakaian'				=> $sf_berpakaian,
			'sf_bowel'      			=> $sf_bowel,
			'sf_bladder'    			=> $sf_bladder,
			'sf_total'      			=> $sf_total,
			'resiko_jatuh_dws'			=> $resiko_jatuh_dws,
			'pemeriksaan_penunjang'		=> $pemeriksaan_penunjang,
			'masalah_kesehatan'     	=> $masalah_kesehatan,
			'masalah_keperawatan'		=> $masalah_keperawatan,
			'rencana_keperawatan'		=> $rencana_keperawatan,
			'rencana_medis'				=> $rencana_medis,
			
			'skr_id_risiko_tinggi'		=> $skr_id_risiko_tinggi,
			'skr_id_text_pasien_rt'		=> $skr_id_text_pasien_rt,
			'skr_id_text_pelayanan_rt'	=> $skr_id_text_pelayanan_rt,
			'skr_id_text_tambahan_rt'	=> $skr_id_text_tambahan_rt,
			'skr_id_text_bukan_rt'		=> $skr_id_text_bukan_rt,
			
			'edukasi'         			=> $edukasi,
			'pasien_pulang'       		=> $pasien_pulang,
      		'created'					=> date('Y-m-d H:i:s'),
      		'creator' 					=> $creator,
      		'updated' 					=> 'null',
      		'updator' 					=> 'null',
    	);

		$data_ott = array(
		  'id_reg'            		=> $id_reg,
		  'id_pasien'         		=> $id_pasien,
		  'id_asmri_from'			=> $id_asmri,
		  'mna_1'					=> $mna_1,
		  'mna_2'					=> $mna_2,
		  'mna_3'					=> $mna_3,
		  'mna_4'					=> $mna_4,
		  'mna_5'					=> $mna_5,
		  'mna_6'					=> $mna_6,
		  'sudah_dibaca'			=> $sudah_dibaca,
		  'pareting'				=> $pareting,
		  'pareting_txt_1'			=> $pareting_txt_1,
		  'pareting_txt_2'			=> $pareting_txt_2,
		  'pareting_txt_3'			=> $pareting_txt_3,
		  'prior'					=> $prior,
		  'diagnosa_medis'			=> $diagnosa_medis,
		  'created'					=> date('Y-m-d H:i:s'),
		  'creator' 				=> $creator,
		  'updated' 				=> 'null',
		  'updator' 				=> 'null',
	  );
		
    	$this->mdl->add_data_asm_ranap($data);
		$this->mdl->add_data_asm_ranap_ott($data_ott);

		$data_riwayat = array(
			'id_pasien'			=> $id_pasien,
			'penyakit_sekarang'	=> $riwayat_sakit,
			'penyakit_dahulu'	=> $riwayat_sakit_dulu,
			'penyakit_keluarga'	=> $riwayat_sakit_keluarga,
			'pengobatan'		=> $riwayat_pengobatan,
			'alergi'			=> $riwayat_alergi,
			'created'			=> date('Y-m-d H:i:s'),
			'creator'			=> $creator,
		);

		$store_riwayat	= $this->smartlib->store_riwayat_pasien($id_pasien, $data_riwayat);

    	echo json_encode(array("status" => true));
  }

	public function asm_geriatri_edit_act($id_reg){
		$id_doc  = @$this->session->userdata['sp']->id_dokter;
    	if ($id_doc != NULL) {
    	  $id_dokter = $id_doc;
    	} else {
    	  $id_dokter = '';
    	}
		$creator = @$this->session->userdata['sp']->login_name;

		$rs = $this->mdl->data_pasien_ranap($id_reg);

		////////////////////////////
		$id_asmri 						= $this->input->post('id_asmri');
		$dateasmri  					= date('Y-m-d H:i:s');
		$datepengkajian 				= date('Y-m-d H:i:s');
		$regdate 						= $rs['regdate'];
		$asal_masuk 					= $this->input->post('asal_masuk');
		$cara_masuk 					= $this->input->post('cara_masuk');
		$id_pasien 						= $rs['id_pasien'];
		$nama_pasien 					= $rs['nama_pasien'];
		$keluhan_utama 					= $this->input->post('keluhan_utama');
		$riwayat_sakit 					= $this->input->post('riwayat_sakit');
		$riwayat_sakit_dulu 			= $this->input->post('riwayat_sakit_dulu');
		$riwayat_pengobatan 			= $this->input->post('riwayat_pengobatan');
		$riwayat_sakit_keluarga 		= $this->input->post('riwayat_sakit_keluarga');
		$riwayat_alergi 				= $this->input->post('riwayat_alergi');
		$chk_status_psikologi			= $this->input->post('status_psikologi');
		$status_psikologi	    		= implode(';',(array)$chk_status_psikologi);
		$sse_nikah						= $this->input->post('sse_nikah');
		$sse_study						= $this->input->post('sse_study');
		$sse_job						= $this->input->post('sse_job');
		$sse_live						= $this->input->post('sse_live');
		$sse_agama						= $this->input->post('sse_agama');
		$status_kultural 				= $this->input->post('status_kultural');
		$ibadah 						= $this->input->post('ibadah');
		$thaharoh 						= $this->input->post('thaharoh');
		$sholat 						= $this->input->post('sholat');
		$chk_bim_spiritual_muslim		= $this->input->post('bim_spiritual_muslim');
		$bim_spiritual_muslim			= implode(';',(array)$chk_bim_spiritual_muslim);
		$chk_bim_spiritual_nonmuslim	= $this->input->post('bim_spiritual_nonmuslim');
		$bim_spiritual_nonmuslim		= implode(';',(array)$chk_bim_spiritual_nonmuslim);
		$kesadaran 						= $this->input->post('kesadaran');
		$keadaan_umum 					= $this->input->post('keadaan_umum');
		$td 							= $this->input->post('td');
		$gcs 							= $this->input->post('gcs');
		$nadi 							= $this->input->post('nadi');
		$suhu 							= $this->input->post('suhu');
		$nafas 							= $this->input->post('nafas');
		$reaksi_cahaya 					= $this->input->post('reaksi_cahaya');
		$saturasi_oksigen 				= $this->input->post('saturasi_oksigen');
		$tinggi 						= $this->input->post('tinggi');
		$berat 							= $this->input->post('berat');
		$fisik_khusus 					= $this->input->post('fisik_khusus');
		$pu_kepala						= $this->input->post('pu_kepala');
		$pu_rambut						= $this->input->post('pu_rambut');
		$pu_wajah						= $this->input->post('pu_wajah');
		$pu_mata						= $this->input->post('pu_mata');
		$pu_gigi						= $this->input->post('pu_gigi');
		$pu_tenggorokan					= $this->input->post('pu_tenggorokan');
		$pu_lidah						= $this->input->post('pu_lidah');
		$pu_leher						= $this->input->post('pu_leher');
		$pu_abdomen						= $this->input->post('pu_abdomen');
		$pu_dada						= $this->input->post('pu_dada');
		$pu_respirasi					= $this->input->post('pu_respirasi');
		$pu_jantung						= $this->input->post('pu_jantung');
		$pu_integumen					= $this->input->post('pu_integumen');
		$pu_ekstremitas					= $this->input->post('pu_ekstremitas');
		$pu_genetalia					= $this->input->post('pu_genetalia');
		$pu_elimitas					= $this->input->post('pu_elimitas');
		$kualitas_nyeri					= $this->input->post('kualitas_nyeri');
		$frekuensi_nyeri				= $this->input->post('frekuensi_nyeri');
		$waktu_nyeri					= $this->input->post('waktu_nyeri');
		$intesnsitas_nyeri				= $this->input->post('intesnsitas_nyeri');
		$nyeri							= $this->input->post('nyeri');
		$pengaruh_nyeri					= $this->input->post('pengaruh_nyeri');
		$aktivitas						= $this->input->post('aktivitas');
		$restrain						= $this->input->post('restrain');
		$total_skor2					= $this->input->post('total_skor2');
		$chk_keluhan_saat_ini			= $this->input->post('keluhan_saat_ini'); $keluhan_saat_ini = implode(';',(array)$chk_keluhan_saat_ini);
		$sf_makan 						= $this->input->post('sf_makan');
		$sf_transfer 					= $this->input->post('sf_transfer');
		$sf_grooming 					= $this->input->post('sf_grooming');
		$sf_toilet 						= $this->input->post('sf_toilet');
		$sf_mandi 						= $this->input->post('sf_mandi');
		$sf_jalan 						= $this->input->post('sf_jalan');
		$sf_tangga 						= $this->input->post('sf_tangga');
		$sf_berpakaian 					= $this->input->post('sf_berpakaian');
		$sf_bowel 						= $this->input->post('sf_bowel');
		$sf_bladder 					= $this->input->post('sf_bladder');
		$sf_total 						= $this->input->post('sf_total');
		$resiko_jatuh_gr 				= $this->input->post('resiko_jatuh_gr');
		$pemeriksaan_penunjang 			= $this->input->post('pemeriksaan_penunjang');
		$masalah_kesehatan 				= $this->input->post('masalah_kesehatan');
		$masalah_keperawatan 			= $this->input->post('masalah_keperawatan');
		$rencana_keperawatan 			= $this->input->post('rencana_keperawatan');
		$rencana_medis 					= $this->input->post('rencana_medis');
		$chk_edukasi					= $this->input->post('edukasi'); $edukasi = implode(';',(array)$chk_edukasi);
		$chk_pasien_pulang				= $this->input->post('pasien_pulang'); $pasien_pulang = implode(';',(array)$chk_pasien_pulang);
		
		$skr_id_risiko_tinggi		= $this->input->post('skr_id_risiko_tinggi');
		$skr_id_text_pasien_rt		= $this->input->post('skr_id_text_pasien_rt');
		$skr_id_text_pelayanan_rt	= $this->input->post('skr_id_text_pelayanan_rt');
		$skr_id_text_tambahan_rt	= $this->input->post('skr_id_text_tambahan_rt');
		$skr_id_text_bukan_rt		= $this->input->post('skr_id_text_bukan_rt');
			
		//geriatri item
		$chk_mna_1						= $this->input->post('mna_1'); $mna_1 = implode(';',(array)$chk_mna_1);
		$chk_mna_2						= $this->input->post('mna_2'); $mna_2 = implode(';',(array)$chk_mna_2);
		$chk_mna_3						= $this->input->post('mna_3'); $mna_3 = implode(';',(array)$chk_mna_3);
		$chk_mna_4						= $this->input->post('mna_4'); $mna_4 = implode(';',(array)$chk_mna_4);
		$chk_mna_5						= $this->input->post('mna_5'); $mna_5 = implode(';',(array)$chk_mna_5);
		$chk_mna_6						= $this->input->post('mna_6'); $mna_6 = implode(';',(array)$chk_mna_6);
		$sudah_dibaca					= $this->input->post('sudah_dibaca');
		
		$chk_pareting					= $skr_id_risiko_tinggi;
		$pareting_txt_1					= $skr_id_text_pasien_rt;
		$pareting_txt_2					= $skr_id_text_pelayanan_rt;
		$pareting_txt_3					= $skr_id_text_tambahan_rt;
		/*
		$chk_pareting					= $this->input->post('pareting'); $pareting = implode(';',(array)$chk_pareting);
		$pareting_txt_1					= $this->input->post('pareting_txt_1');
		$pareting_txt_2					= $this->input->post('pareting_txt_2');
		$pareting_txt_3					= $this->input->post('pareting_txt_3');
		*/

		$chk_prior						= $this->input->post('prior'); $prior = implode(';',(array)$chk_prior);
		$diagnosa_medis 				= $this->input->post('diagnosa_medis'); 
		//end geriatri item

		///////////////////////////
    	$data = array(
      		'asmri_date'				=> $dateasmri,
			'regdate'           		=> $regdate,
			'tgl_pengkajian'    		=> $datepengkajian,
			'asal_masuk'        		=> $asal_masuk,
			'cara_masuk'        		=> $cara_masuk,
			'id_reg'            		=> $id_reg,
			'id_pasien'         		=> $id_pasien,
      		'nama_pasien'       		=> $nama_pasien,
      		'id_dokter'         		=> $id_dokter,
      		'id_type'           		=> '2',
			'jenis_asm'         		=> 'NURSE',
			'keluhan_utama'         	=> $keluhan_utama,
			'riwayat_sakit'				=> $riwayat_sakit,
			'riwayat_sakit_dulu'     	=> $riwayat_sakit_dulu,
			'riwayat_pengobatan'     	=> $riwayat_pengobatan,
			'riwayat_sakit_keluarga' 	=> $riwayat_sakit_keluarga,
			'riwayat_alergi'         	=> $riwayat_alergi,
			'status_psikologi'    		=> $status_psikologi,
			'sse_nikah'					=> $sse_nikah,
			'sse_study' 				=> $sse_study,
			'sse_job'   				=> $sse_job,
			'sse_live'  				=> $sse_live,
			'sse_agama' 				=> $sse_agama,
			'status_kultural'         	=> $status_kultural,
			'ibadah'         			=> $ibadah,
			'thaharoh'         			=> $thaharoh,
			'sholat'         			=> $sholat,
			'bim_spiritual_muslim'    	=> $bim_spiritual_muslim,
			'bim_spiritual_nonmuslim'	=> $bim_spiritual_nonmuslim,
			'kesadaran'    				=> $kesadaran,
			'keadaan_umum' 				=> $keadaan_umum,
			'td'         				=> $td,
			'gcs'         				=> $gcs,
			'nadi'         				=> $nadi,
			'suhu'         				=> $suhu,
			'nafas'         			=> $nafas,
			'reaksi_cahaya' 			=> $reaksi_cahaya,
			'saturasi_oksigen' 			=> $saturasi_oksigen,
			'tinggi'        			=> $tinggi,
			'berat'         			=> $berat,
			'fisik_khusus'  			=> $fisik_khusus,
			'pu_kepala'       			=> $pu_kepala,
			'pu_rambut'       			=> $pu_rambut,
			'pu_wajah'       			=> $pu_wajah,
			'pu_mata'         			=> $pu_mata,
			'pu_gigi'         			=> $pu_gigi,
			'pu_tenggorokan'  			=> $pu_tenggorokan,
			'pu_lidah'        			=> $pu_lidah,
			'pu_leher'        			=> $pu_leher,
			'pu_abdomen'      			=> $pu_abdomen,
			'pu_dada'         			=> $pu_dada,
			'pu_respirasi'    			=> $pu_respirasi,
			'pu_jantung'      			=> $pu_jantung,
			'pu_integumen'    			=> $pu_integumen,
			'pu_ekstremitas'			=> $pu_ekstremitas,
			'pu_genetalia'    			=> $pu_genetalia,
			'pu_elimitas'     			=> $pu_elimitas,
			'kualitas_nyeri'    		=> $kualitas_nyeri,
			'frekuensi_nyeri'   		=> $frekuensi_nyeri,
			'waktu_nyeri'       		=> $waktu_nyeri,
			'intesnsitas_nyeri'			=> $intesnsitas_nyeri,
			'nyeri'         			=> $nyeri,
			'pengaruh_nyeri'    		=> $pengaruh_nyeri,
			'aktivitas'         		=> $aktivitas,
			'restrain'         			=> $restrain,
			'total_skor2'       		=> $total_skor2,
			'keluhan_saat_ini'			=> $keluhan_saat_ini,
			'sf_makan'      			=> $sf_makan,
			'sf_transfer'   			=> $sf_transfer,
			'sf_grooming'   			=> $sf_grooming,
			'sf_toilet'     			=> $sf_toilet,
			'sf_mandi'      			=> $sf_mandi,
			'sf_jalan'      			=> $sf_jalan,
			'sf_tangga'     			=> $sf_tangga,
			'sf_berpakaian'				=> $sf_berpakaian,
			'sf_bowel'      			=> $sf_bowel,
			'sf_bladder'    			=> $sf_bladder,
			'sf_total'      			=> $sf_total,
			'resiko_jatuh_gr'			=> $resiko_jatuh_gr,
			'pemeriksaan_penunjang'		=> $pemeriksaan_penunjang,
			'masalah_kesehatan'     	=> $masalah_kesehatan,
			'masalah_keperawatan'		=> $masalah_keperawatan,
			'rencana_keperawatan'		=> $rencana_keperawatan,
			'rencana_medis'				=> $rencana_medis,
			
			'skr_id_risiko_tinggi'		=> $skr_id_risiko_tinggi,
			'skr_id_text_pasien_rt'		=> $skr_id_text_pasien_rt,
			'skr_id_text_pelayanan_rt'	=> $skr_id_text_pelayanan_rt,
			'skr_id_text_tambahan_rt'	=> $skr_id_text_tambahan_rt,
			'skr_id_text_bukan_rt'		=> $skr_id_text_bukan_rt,
			
			'edukasi'         			=> $edukasi,
			'pasien_pulang'       		=> $pasien_pulang,
      		'created'					=> date('Y-m-d H:i:s'),
      		'creator' 					=> $creator,
      		'updated' 					=> 'null',
      		'updator' 					=> 'null',
    	);

		$data_ott = array(
		  'id_reg'            		=> $id_reg,
		  'id_pasien'         		=> $id_pasien,
		  'id_asmri_from'			=> $id_asmri,
		  'mna_1'					=> $mna_1,
		  'mna_2'					=> $mna_2,
		  'mna_3'					=> $mna_3,
		  'mna_4'					=> $mna_4,
		  'mna_5'					=> $mna_5,
		  'mna_6'					=> $mna_6,
		  'sudah_dibaca'			=> $sudah_dibaca,
		  'pareting'				=> $pareting,
		  'pareting_txt_1'			=> $pareting_txt_1,
		  'pareting_txt_2'			=> $pareting_txt_2,
		  'pareting_txt_3'			=> $pareting_txt_3,
		  'prior'					=> $prior,
		  'diagnosa_medis'			=> $diagnosa_medis,
		  'created'					=> date('Y-m-d H:i:s'),
		  'creator' 				=> $creator,
		  'updated' 				=> 'null',
		  'updator' 				=> 'null',
	  	);

		$data_riwayat = array(
			'id_pasien'					=> $rs['id_pasien'],
			'penyakit_sekarang'			=> $this->input->post('riwayat_sakit'),
			'penyakit_dahulu'			=> $this->input->post('riwayat_sakit_dulu'),
			'penyakit_keluarga'			=> $this->input->post('riwayat_sakit_keluarga'),
			'pengobatan'				=> $this->input->post('riwayat_pengobatan'),
			'alergi'					=> $this->input->post('riwayat_alergi'),
			'created'					=> date('Y-m-d H:i:s'),
			'creator'					=> $creator,
		);
	
		$this->smartlib->store_riwayat_pasien($id_pasien, $data_riwayat);

		$rs_ott = $this->mdl->data_pasien_ranap_ott($id_reg);
		if($rs_ott['fnddata']=='0'){
			$this->mdl->add_data_asm_ranap($data);
			$this->mdl->add_data_asm_ranap_ott($data_ott);
		}else{
			$this->mdl->edit_data_asm_ranap(array('id_asmri' => $id_asmri), $data);
			#$this->mdl->edit_data_asm_ranap_ott(array('id_asmri_from' => $id_asmri), $data_ott);
			$this->mdl->edit_data_asm_ranap_ott(array('id_reg' => $id_reg), $data_ott);
		}

    	echo json_encode(array("status" => true));
  	}

	public function asm_geriatri_edit($id_asmri){
    	$data = $this->mdl->get_asm_ranap_byid($id_asmri);
    	echo json_encode($data);
  	}

	public function asm_ranap_delete($id_asmri){
		$this->mdl->delete_asm_ranap_byid($id_asmri);
		echo json_encode(array("status" => true));
	}
}
