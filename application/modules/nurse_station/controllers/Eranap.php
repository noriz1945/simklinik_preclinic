<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Eranap extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		#if($session_name !='') $this->check_session($session_name);
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');
		$this->load->model('Eranap_model','mdl');
	}

  public function index(){
    $this->make_bread->add('Nurse Station', '', 1);
    $this->make_bread->add('e-Ranap', '', 0);
    $breadcrumb = $this->make_bread->output();

    $rs = $this->mdl->list_pasien_ranap();

    //print_r($data_row);
    $data = array(
      'breadcrumb'  => $breadcrumb,
      'rs'          => $rs,
    );

    $this->load->view('eranap/vlist_pasien_ranap', $data);
	}

  public function erm_header($id_reg)
  {
    $rs = $this->mdl->data_pasien_ranap($id_reg);
    $data   = array(
      'rs'  => $rs,
    );
    return $this->load->view('eranap/verm_header', $data, true);
  }

  public function main_content($id_reg)
  {
    $this->make_bread->add('Nurse Station', '', 1);
    $this->make_bread->add('e-Ranap', '', 0);
    $breadcrumb = $this->make_bread->output();

    $header = $this->erm_header($id_reg);
		$jenis_asm='NURSE';

		$sql = "SELECT  a.*
            FROM    soap_asm_ri a
            WHERE   a.id_reg = '".$id_reg."'
            AND a.jenis_asm = '".$jenis_asm."'
          ";
    //echo "<pre>".$sql."</pre>";
    $query = $this->dbsupp->query($sql);
    $rs = $query->row_array();

		$id_asmri = $rs['id_asmri'];

		$sql2 = "SELECT  a.*
            FROM    trx_reg a
            WHERE   a.id_reg = '".$id_reg."'
          ";
    //echo "<pre>".$sql."</pre>";
    $query2 = $this->dbhis->query($sql2);
    $rs2 = $query2->row_array();
		$id_pasien = $rs2['id_pasien'];

		// if (empty($id_asmri)) {
		// 	$link = 'nurse_station/eranap/asm_ranap/'.$id_reg;
		// }else {
		// 	$link = 'nurse_station/eranap/asm_ranap_edit/'.$id_asmri;
		// }

    //print_r($data_row);
    $data = array(
      'breadcrumb'  => $breadcrumb,
      'header'      => $header,
			'id_reg'			=> $id_reg,
			//'link'				=> $link,
			'id_asmri'		=> $id_asmri,
			'id_pasien'		=> $id_pasien,
    );

    $this->load->view('eranap/vmain_content', $data);
  }

  public function asm_ranap($id_reg)
	{
		$pasien 		= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
		$id_pasien	= $pasien['id_pasien'];
		$riwayat_pasien 	= $this->smartlib->riwayat_pasien($id_pasien);

		$jenis_asm='NURSE';
		$sql = "SELECT  a.id_asmri
            FROM    soap_asm_ri a
            WHERE   a.id_reg = '".$id_reg."'
            AND a.jenis_asm = '".$jenis_asm."'
          ";
    //echo "<pre>".$sql."</pre>";
    $query = $this->dbsupp->query($sql);
    $rs = $query->row_array();

		$id_asmri = $rs['id_asmri'];

		$cek_umur = $this->mdl->get_umur($id_reg);
		$umur = $cek_umur['umur'];

		if ($umur < 18) {
			$vasm_anak = $this->view_asm_anak($id_reg);
		}else {
			$vasm_anak = '';
		}

    $data = array(
			'id_asmri'		=> $id_asmri,
			'id_reg'			=> $id_reg,
			'vasm_anak'		=> $vasm_anak,
			'riwayat_pasien' => $riwayat_pasien,
    );
		$this->load->view('eranap/vasm_ranap', $data);
	}

	public function view_asm_anak($id_reg)
  {
    $data   = array(
      'id_reg'  => $id_reg,
    );
    return $this->load->view('eranap/vasm_anak', $data, true);
  }

	public function asm_ranap_add($id_reg,$kategori)
  {
    $id_doc  = @$this->session->userdata['sp']->id_dokter;
    if ($id_doc != NULL) {
      $id_dokter = $id_doc;
    } else {
      $id_dokter = '';
    }
		$creator    = @$this->session->userdata['sp']->login_name;

		$rs = $this->mdl->data_pasien_ranap($id_reg);

		$chk_status_psikologi	= $this->input->post('status_psikologi');
		$status_psikologi			= implode(';',(array)$chk_status_psikologi);

		$chk_bim_spiritual_muslim	= $this->input->post('bim_spiritual_muslim');
		$bim_spiritual_muslim			= implode(';',(array)$chk_bim_spiritual_muslim);

		$chk_bim_spiritual_nonmuslim	= $this->input->post('bim_spiritual_nonmuslim');
		$bim_spiritual_nonmuslim			= implode(';',(array)$chk_bim_spiritual_nonmuslim);

		$chk_keluhan_saat_ini	= $this->input->post('keluhan_saat_ini');
		$keluhan_saat_ini			= implode(';',(array)$chk_keluhan_saat_ini);

		$chk_edukasi	= $this->input->post('edukasi');
		$edukasi			= implode(';',(array)$chk_edukasi);

		$chk_pasien_pulang	= $this->input->post('pasien_pulang');
		$pasien_pulang			= implode(';',(array)$chk_pasien_pulang);

		$chk_anak_riwayat_imunisasi	= $this->input->post('anak_riwayat_imunisasi');
		$anak_riwayat_imunisasi			= implode(';',(array)$chk_anak_riwayat_imunisasi);

    $data = array(
			//'id_asmri'           => '',
      'asmri_date'				=> date('Y-m-d H:i:s'),
			'regdate'           => $rs['regdate'],
			'tgl_pengkajian'    => date('Y-m-d H:i:s'),
			'asal_masuk'        => $this->input->post('asal_masuk'),
			'cara_masuk'        => $this->input->post('cara_masuk'),

			'id_reg'            => $id_reg,
			'id_pasien'         => $rs['id_pasien'],
      'nama_pasien'       => $rs['nama_pasien'],
      'id_dokter'         => $id_dokter,
      'id_type'           => '2',
			'jenis_asm'         => 'NURSE',
			'kategori'	        => $kategori,

			// SUBJECTIVE START
			'keluhan_utama'         	=> $this->input->post('keluhan_utama'),
			'riwayat_sakit'						=> $this->input->post('riwayat_sakit'),
			'riwayat_sakit_dulu'     	=> $this->input->post('riwayat_sakit_dulu'),
			'riwayat_pengobatan'     	=> $this->input->post('riwayat_pengobatan'),
			'riwayat_sakit_keluarga' 	=> $this->input->post('riwayat_sakit_keluarga'),
			'riwayat_alergi'         	=> $this->input->post('riwayat_alergi'),
			// SUBJECTIVE END

			// OBJECTIVE START
			'objective'         	=> $this->input->post('objective'),
			'status_psikologi'    => $status_psikologi,

			'sse_nikah'	=> $this->input->post('sse_nikah'),
			'sse_study' => $this->input->post('sse_study'),
			'sse_job'   => $this->input->post('sse_job'),
			'sse_live'  => $this->input->post('sse_live'),
			'sse_agama' => $this->input->post('sse_agama'),

			'status_kultural'         => $this->input->post('status_kultural'),
			'ibadah'         					=> $this->input->post('ibadah'),
			'thaharoh'         				=> $this->input->post('thaharoh'),
			'sholat'         					=> $this->input->post('sholat'),
			'bim_spiritual_muslim'    => $bim_spiritual_muslim,
			'bim_spiritual_nonmuslim'	=> $bim_spiritual_nonmuslim,

			'kesadaran'    	=> $this->input->post('kesadaran'),
			'keadaan_umum' 	=> $this->input->post('keadaan_umum'),
			'td'         		=> $this->input->post('td'),
			'gcs'         	=> $this->input->post('gcs'),
			'nadi'         	=> $this->input->post('nadi'),
			'suhu'         	=> $this->input->post('suhu'),
			'nafas'         => $this->input->post('nafas'),
			'reaksi_cahaya' => $this->input->post('reaksi_cahaya'),
			'tinggi'        => $this->input->post('tinggi'),
			'berat'         => $this->input->post('berat'),

			'fisik_khusus'  => $this->input->post('fisik_khusus'),

			'pu_kepala'       => $this->input->post('pu_kepala'),
			'pu_rambut'       => $this->input->post('pu_rambut'),
			'pu_wajah'       	=> $this->input->post('pu_wajah'),
			'pu_mata'         => $this->input->post('pu_mata'),
			'pu_gigi'         => $this->input->post('pu_gigi'),
			'pu_tenggorokan'  => $this->input->post('pu_tenggorokan'),
			'pu_lidah'        => $this->input->post('pu_lidah'),
			'pu_leher'        => $this->input->post('pu_leher'),
			'pu_abdomen'      => $this->input->post('pu_abdomen'),
			'pu_dada'         => $this->input->post('pu_dada'),
			'pu_respirasi'    => $this->input->post('pu_respirasi'),
			'pu_jantung'      => $this->input->post('pu_jantung'),
			'pu_integumen'    => $this->input->post('pu_integumen'),
			'pu_ekstremitas'	=> $this->input->post('pu_ekstremitas'),
			'pu_genetalia'    => $this->input->post('pu_genetalia'),
			'pu_elimitas'     => $this->input->post('pu_elimitas'),

			'kualitas_nyeri'    => $this->input->post('kualitas_nyeri'),
			'frekuensi_nyeri'   => $this->input->post('frekuensi_nyeri'),
			'waktu_nyeri'       => $this->input->post('waktu_nyeri'),
			'intesnsitas_nyeri'	=> $this->input->post('intesnsitas_nyeri'),
			'nyeri'         		=> $this->input->post('nyeri'),
			'pengaruh_nyeri'    => $this->input->post('pengaruh_nyeri'),
			'aktivitas'         => $this->input->post('aktivitas'),
			'restrain'         	=> $this->input->post('restrain'),

			// objective anak disini
			'anak_nyeri_face'        	=> $this->input->post('anak_nyeri_face'),
			'anak_nyeri_legs'        	=> $this->input->post('anak_nyeri_legs'),
			'anak_nyeri_activity'     => $this->input->post('anak_nyeri_activity'),
			'anak_nyeri_cry'         	=> $this->input->post('anak_nyeri_cry'),
			'anak_nyeri_consolability'=> $this->input->post('anak_nyeri_consolability'),
			'anak_nyeri_total'        => $this->input->post('anak_nyeri_total'),

			'anak_riwayat_imunisasi'  => $anak_riwayat_imunisasi,

			'anak_tk_senyum'         	=> $this->input->post('anak_tk_senyum'),
			'anak_tk_tengkurap'       => $this->input->post('anak_tk_tengkurap'),
			'anak_tk_duduk'         	=> $this->input->post('anak_tk_duduk'),
			'anak_tk_merangkak'       => $this->input->post('anak_tk_merangkak'),
			'anak_tk_berdiri'        	=> $this->input->post('anak_tk_berdiri'),
			'anak_tk_berjalan'        => $this->input->post('anak_tk_berjalan'),
			'anak_tk_bicara'         	=> $this->input->post('anak_tk_bicara'),
			'anak_tk_sekolah'        	=> $this->input->post('anak_tk_sekolah'),

			// objective anak disini end

			'bb_turun'         	=> $this->input->post('bb_turun'),
			'bb_turun_qty'      => $this->input->post('bb_turun_qty'),
			'nafsu_makan'       => $this->input->post('nafsu_makan'),
			'total_skor'        => $this->input->post('total_skor'),
			'diagnosa_khusus'   => $this->input->post('diagnosa_khusus'),
			'pola_makan'        => $this->input->post('pola_makan'),
			'keluhan_saat_ini'	=> $keluhan_saat_ini,

			'sf_makan'      => $this->input->post('sf_makan'),
			'sf_transfer'   => $this->input->post('sf_transfer'),
			'sf_grooming'   => $this->input->post('sf_grooming'),
			'sf_toilet'     => $this->input->post('sf_toilet'),
			'sf_mandi'      => $this->input->post('sf_mandi'),
			'sf_jalan'      => $this->input->post('sf_jalan'),
			'sf_tangga'     => $this->input->post('sf_tangga'),
			'sf_berpakaian'	=> $this->input->post('sf_berpakaian'),
			'sf_bowel'      => $this->input->post('sf_bowel'),
			'sf_bladder'    => $this->input->post('sf_bladder'),
			'sf_total'      => $this->input->post('sf_total'),

			'resiko_jatuh_dws'	=> $this->input->post('resiko_jatuh_dws'),
			'resiko_jatuh_gr'   => $this->input->post('resiko_jatuh_gr'),
			'resiko_jatuh_anak' => $this->input->post('resiko_jatuh_anak'),

			'pemeriksaan_penunjang'	=> $this->input->post('pemeriksaan_penunjang'),
			'masalah_kesehatan'     => $this->input->post('masalah_kesehatan'),

			// OBJECTIVE END

			// ASSESMENT
			'masalah_keperawatan'	=> $this->input->post('masalah_keperawatan'),
			// ASSESMENT END

			// PLANNING
			'rencana_keperawatan'	=> $this->input->post('rencana_keperawatan'),
			'edukasi'         		=> $edukasi,
			'pasien_pulang'       => $pasien_pulang,
			// PLANNING END

      'created'	=> date('Y-m-d H:i:s'),
      'creator' => $creator,
      'updated' => 'null',
      'updator' => 'null',
    );

		// $data_riwayat = array(
		// 		'id_pasien'					=> $rs['id_pasien'],
		// 		'penyakit_sekarang'	=> $this->input->post('riwayat_sakit'),
		// 		'penyakit_dahulu'		=> $this->input->post('riwayat_sakit_dulu'),
		// 		'penyakit_keluarga'	=> $this->input->post('riwayat_sakit_keluarga'),
		// 		'pengobatan'				=> $this->input->post('riwayat_pengobatan'),
		// 		'alergi'						=> $this->input->post('riwayat_alergi'),
		//
		// 		'created'						=> date('Y-m-d H:i:s'),
		// 		'creator'						=> $creator,
		// 	);
		//
		// $store_riwayat	= $this->smartlib->store_riwayat_pasien($rs['id_pasien'], $data_riwayat);

    $insert = $this->mdl->add_data_asm_ranap($data);
    echo json_encode(array("status" => true));
  }

	public function asm_ranap_edit($id_asmri)
  {
    $data = $this->mdl->get_asm_ranap_byid($id_asmri);
    echo json_encode($data);
  }

	public function asm_ranap_edit_act($id_reg)
  {
		$id_doc  = @$this->session->userdata['sp']->id_dokter;
    if ($id_doc != NULL) {
      $id_dokter = $id_doc;
    } else {
      $id_dokter = '';
    }
		$creator    = @$this->session->userdata['sp']->login_name;

		$rs = $this->mdl->data_pasien_ranap($id_reg);

		$chk_status_psikologi	= $this->input->post('status_psikologi');
		$status_psikologi			= implode(';',(array)$chk_status_psikologi);

		$chk_bim_spiritual_muslim	= $this->input->post('bim_spiritual_muslim');
		$bim_spiritual_muslim			= implode(';',(array)$chk_bim_spiritual_muslim);

		$chk_bim_spiritual_nonmuslim	= $this->input->post('bim_spiritual_nonmuslim');
		$bim_spiritual_nonmuslim			= implode(';',(array)$chk_bim_spiritual_nonmuslim);

		$chk_keluhan_saat_ini	= $this->input->post('keluhan_saat_ini');
		$keluhan_saat_ini			= implode(';',(array)$chk_keluhan_saat_ini);

		$chk_edukasi	= $this->input->post('edukasi');
		$edukasi			= implode(';',(array)$chk_edukasi);

		$chk_pasien_pulang	= $this->input->post('pasien_pulang');
		$pasien_pulang			= implode(';',(array)$chk_pasien_pulang);

		$chk_anak_riwayat_imunisasi	= $this->input->post('anak_riwayat_imunisasi');
		$anak_riwayat_imunisasi			= implode(';',(array)$chk_anak_riwayat_imunisasi);

    $data = array(
			'id_asmri'          => $this->input->post('id_asmri'),
      'asmri_date'				=> date('Y-m-d H:i:s'),
			'regdate'           => $rs['regdate'],
			'tgl_pengkajian'    => date('Y-m-d H:i:s'),
			'asal_masuk'        => $this->input->post('asal_masuk'),
			'cara_masuk'        => $this->input->post('cara_masuk'),

			'id_reg'            => $id_reg,
			'id_pasien'         => $rs['id_pasien'],
      'nama_pasien'       => $rs['nama_pasien'],
      'id_dokter'         => $id_dokter,
      'id_type'           => '2',
			'jenis_asm'         => 'NURSE',
			'kategori'	        => $this->input->post('kategori'),

			// SUBJECTIVE START
			'keluhan_utama'         	=> $this->input->post('keluhan_utama'),
			'riwayat_sakit'						=> $this->input->post('riwayat_sakit'),
			'riwayat_sakit_dulu'     	=> $this->input->post('riwayat_sakit_dulu'),
			'riwayat_pengobatan'     	=> $this->input->post('riwayat_pengobatan'),
			'riwayat_sakit_keluarga' 	=> $this->input->post('riwayat_sakit_keluarga'),
			'riwayat_alergi'         	=> $this->input->post('riwayat_alergi'),
			// SUBJECTIVE END

			// OBJECTIVE START
			'objective'         	=> $this->input->post('objective'),
			'status_psikologi'    => $status_psikologi,

			'sse_nikah'	=> $this->input->post('sse_nikah'),
			'sse_study' => $this->input->post('sse_study'),
			'sse_job'   => $this->input->post('sse_job'),
			'sse_live'  => $this->input->post('sse_live'),
			'sse_agama' => $this->input->post('sse_agama'),

			'status_kultural'         => $this->input->post('status_kultural'),
			'ibadah'         					=> $this->input->post('ibadah'),
			'thaharoh'         				=> $this->input->post('thaharoh'),
			'sholat'         					=> $this->input->post('sholat'),
			'bim_spiritual_muslim'    => $bim_spiritual_muslim,
			'bim_spiritual_nonmuslim'	=> $bim_spiritual_nonmuslim,

			'kesadaran'    	=> $this->input->post('kesadaran'),
			'keadaan_umum' 	=> $this->input->post('keadaan_umum'),
			'td'         		=> $this->input->post('td'),
			'gcs'         	=> $this->input->post('gcs'),
			'nadi'         	=> $this->input->post('nadi'),
			'suhu'         	=> $this->input->post('suhu'),
			'nafas'         => $this->input->post('nafas'),
			'reaksi_cahaya' => $this->input->post('reaksi_cahaya'),
			'tinggi'        => $this->input->post('tinggi'),
			'berat'         => $this->input->post('berat'),

			'fisik_khusus'  => $this->input->post('fisik_khusus'),

			'pu_kepala'       => $this->input->post('pu_kepala'),
			'pu_rambut'       => $this->input->post('pu_rambut'),
			'pu_wajah'       	=> $this->input->post('pu_wajah'),
			'pu_mata'         => $this->input->post('pu_mata'),
			'pu_gigi'         => $this->input->post('pu_gigi'),
			'pu_tenggorokan'  => $this->input->post('pu_tenggorokan'),
			'pu_lidah'        => $this->input->post('pu_lidah'),
			'pu_leher'        => $this->input->post('pu_leher'),
			'pu_abdomen'      => $this->input->post('pu_abdomen'),
			'pu_dada'         => $this->input->post('pu_dada'),
			'pu_respirasi'    => $this->input->post('pu_respirasi'),
			'pu_jantung'      => $this->input->post('pu_jantung'),
			'pu_integumen'    => $this->input->post('pu_integumen'),
			'pu_ekstremitas'	=> $this->input->post('pu_ekstremitas'),
			'pu_genetalia'    => $this->input->post('pu_genetalia'),
			'pu_elimitas'     => $this->input->post('pu_elimitas'),

			'kualitas_nyeri'    => $this->input->post('kualitas_nyeri'),
			'frekuensi_nyeri'   => $this->input->post('frekuensi_nyeri'),
			'waktu_nyeri'       => $this->input->post('waktu_nyeri'),
			'intesnsitas_nyeri'	=> $this->input->post('intesnsitas_nyeri'),
			'nyeri'         		=> $this->input->post('nyeri'),
			'pengaruh_nyeri'    => $this->input->post('pengaruh_nyeri'),
			'aktivitas'         => $this->input->post('aktivitas'),
			'restrain'         	=> $this->input->post('restrain'),

			// objective anak disini
			'anak_nyeri_face'        	=> $this->input->post('anak_nyeri_face'),
			'anak_nyeri_legs'        	=> $this->input->post('anak_nyeri_legs'),
			'anak_nyeri_activity'     => $this->input->post('anak_nyeri_activity'),
			'anak_nyeri_cry'         	=> $this->input->post('anak_nyeri_cry'),
			'anak_nyeri_consolability'=> $this->input->post('anak_nyeri_consolability'),
			'anak_nyeri_total'        => $this->input->post('anak_nyeri_total'),

			'anak_riwayat_imunisasi'  => $anak_riwayat_imunisasi,

			'anak_tk_senyum'         	=> $this->input->post('anak_tk_senyum'),
			'anak_tk_tengkurap'       => $this->input->post('anak_tk_tengkurap'),
			'anak_tk_duduk'         	=> $this->input->post('anak_tk_duduk'),
			'anak_tk_merangkak'       => $this->input->post('anak_tk_merangkak'),
			'anak_tk_berdiri'        	=> $this->input->post('anak_tk_berdiri'),
			'anak_tk_berjalan'        => $this->input->post('anak_tk_berjalan'),
			'anak_tk_bicara'         	=> $this->input->post('anak_tk_bicara'),
			'anak_tk_sekolah'        	=> $this->input->post('anak_tk_sekolah'),

			// objective anak disini end

			'bb_turun'         	=> $this->input->post('bb_turun'),
			'bb_turun_qty'      => $this->input->post('bb_turun_qty'),
			'nafsu_makan'       => $this->input->post('nafsu_makan'),
			'total_skor'        => $this->input->post('total_skor'),
			'diagnosa_khusus'   => $this->input->post('diagnosa_khusus'),
			'pola_makan'        => $this->input->post('pola_makan'),
			'keluhan_saat_ini'	=> $keluhan_saat_ini,

			'sf_makan'      => $this->input->post('sf_makan'),
			'sf_transfer'   => $this->input->post('sf_transfer'),
			'sf_grooming'   => $this->input->post('sf_grooming'),
			'sf_toilet'     => $this->input->post('sf_toilet'),
			'sf_mandi'      => $this->input->post('sf_mandi'),
			'sf_jalan'      => $this->input->post('sf_jalan'),
			'sf_tangga'     => $this->input->post('sf_tangga'),
			'sf_berpakaian'	=> $this->input->post('sf_berpakaian'),
			'sf_bowel'      => $this->input->post('sf_bowel'),
			'sf_bladder'    => $this->input->post('sf_bladder'),
			'sf_total'      => $this->input->post('sf_total'),

			'resiko_jatuh_dws'	=> $this->input->post('resiko_jatuh_dws'),
			'resiko_jatuh_gr'   => $this->input->post('resiko_jatuh_gr'),
			'resiko_jatuh_anak' => $this->input->post('resiko_jatuh_anak'),

			'pemeriksaan_penunjang'	=> $this->input->post('pemeriksaan_penunjang'),
			'masalah_kesehatan'     => $this->input->post('masalah_kesehatan'),

			// OBJECTIVE END

			// ASSESMENT
			'masalah_keperawatan'	=> $this->input->post('masalah_keperawatan'),
			// ASSESMENT END

			// PLANNING
			'rencana_keperawatan'	=> $this->input->post('rencana_keperawatan'),
			'edukasi'         		=> $edukasi,
			'pasien_pulang'       => $pasien_pulang,
			// PLANNING END

      //'created'	=> date('Y-m-d H:i:s'),
      //'creator' => $creator,
      'updated' => date('Y-m-d H:i:s'),
      'updator' => $creator,
    );

		// $data_riwayat = array(
		// 		'id_pasien'					=> $rs['id_pasien'],
		// 		'penyakit_sekarang'	=> $this->input->post('riwayat_sakit'),
		// 		'penyakit_dahulu'		=> $this->input->post('riwayat_sakit_dulu'),
		// 		'penyakit_keluarga'	=> $this->input->post('riwayat_sakit_keluarga'),
		// 		'pengobatan'				=> $this->input->post('riwayat_pengobatan'),
		// 		'alergi'						=> $this->input->post('riwayat_alergi'),
		//
		// 		'updated' => date('Y-m-d H:i:s'),
	  //     'updator' => $creator,
		// 	);
		//
		// $store_riwayat	= $this->smartlib->store_riwayat_pasien($rs['id_pasien'], $data_riwayat);

		$update = $this->mdl->edit_data_asm_ranap(array('id_asmri' => $this->input->post('id_asmri')), $data);
    echo json_encode(array("status" => true));
  }

	public function asm_ranap_delete($id_asmri)
	{
		$this->mdl->delete_asm_ranap_byid($id_asmri);
		echo json_encode(array("status" => true));
	}

	public function cppt_ranap($id_reg)
	{
		$id_role  = @$this->session->userdata['sp']->id_role;
    $rs = $this->mdl->get_data_cppt($id_reg);
		$pasien 		= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
		$id_pasien	= $pasien['id_pasien'];
		$riwayat_pasien 	= $this->smartlib->riwayat_pasien($id_pasien);

    $data = array(
			'id_reg'	=> $id_reg,
      'rs'      => $rs,
			'id_role'  => $id_role,
			'riwayat_pasien'	=> $riwayat_pasien,
    );
    $this->load->view('eranap/vcppt_ranap', $data);
	}

	public function main_cppt_ranap($id_reg)
	{
		$pasien 		= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
		$id_pasien	= $pasien['id_pasien'];
		$riwayat_pasien 	= $this->smartlib->riwayat_pasien($id_pasien);

    $data = array(
			'id_reg'					=> $id_reg,
			'riwayat_pasien'	=> $riwayat_pasien,
    );
		$this->load->view('eranap/vcppt_ranap', $data);
	}

	public function cppt_viewer($id_reg)
	{
		$id_role = @$this->session->userdata['sp']->id_role;
		$id_dokter_login  = @$this->session->userdata['sp']->id_dokter;
		$data_pasien = $this->mdl->data_pasien_ranap($id_reg);
		$data_cppt = $this->mdl->get_data_cppt($id_reg);
		$cppt_igd  = $this->mdl->get_cppt_igd($id_reg);

    $data = array(
			'id_reg'=> $id_reg,
			'data_cppt'	=> $data_cppt,
			'cppt_igd'	=> $cppt_igd,
			'data_pasien' => $data_pasien,
			'id_role' => $id_role,
			'id_dokter_login' => $id_dokter_login,
    );
		$this->load->view('eranap/vcppt_viewer', $data);
	}

	public function update_review($id_asmri)
	{
		$data = $this->mdl->get_asm_ranap_byid($id_asmri);
    echo json_encode($data);
	}

	public function update_review_act($id_asmri)
	{
		$creator    = @$this->session->userdata['sp']->login_name;
		$id = $this->input->post('id_asmri');
		$data = array(
				'is_review' => intval($this->input->post('is_review')),
				'is_verif' 	=> intval($this->input->post('is_verif')) ,
				'review'		=> $this->input->post('review'),
				'updated' 	=> date('Y-m-d H:i:s'),
	      'updator' 	=> $creator,
			);

		$this->mdl->update_review($id, $data);
		echo json_encode(array("status" => true));
	}

}
