<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Erm_ranap extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		#if($session_name !='') $this->check_session($session_name);
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');

		$this->load->model('Erm_ranap_model','mdl');
  }

  public function index()
  {
    $this->make_bread->add('Rawat Inap', '', 1);
    $this->make_bread->add('e-Ranap', '', 0);
    $breadcrumb = $this->make_bread->output();

    $rs = $this->mdl->list_pasien_ranap();

    //print_r($data_row);
    $data = array(
      'breadcrumb'  => $breadcrumb,
      'rs'          => $rs,
    );

    $this->load->view('vlist_pasien_ranap', $data);
  }

  function erm_header($id_reg)
  {
    $rs = $this->mdl->data_pasien_ranap($id_reg);
    $data   = array(
      'rs'  => $rs,
    );
    return $this->load->view('verm_header', $data, true);
  }

  public function main_content($id_reg)
  {
    $this->make_bread->add('Rawat Inap', '', 1);
    $this->make_bread->add('e-Ranap', '', 0);
    $breadcrumb = $this->make_bread->output();

    $header = $this->erm_header($id_reg);

    //print_r($data_row);
		$id_pasien	= $this->smartlib->get_id_pasien_by_id_reg($id_reg);
    $data = array(
      'breadcrumb'  => $breadcrumb,
      'header'      => $header,
			'id_reg'			=> $id_reg,
			'id_pasien'		=> $id_pasien,
    );

    $this->load->view('verm_main_content', $data);
  }

  public function asm_ranap($id_reg)
  {
		print_r($this);
		$id_pasien	= $this->smartlib->get_id_pasien_by_id_reg($id_reg);
    $data = array(
			'id_reg'			=> $id_reg,
			'id_pasien'		=> $id_pasien,
    );
    $this->load->view('vmain_asm_awal',$data);
  }
	
	public function act_asm_ranap($id_reg)
  {
		#$this->input->post('keluhan_utama',true);
		#$id_asmri				= $xxxxxx;
		$asmri_date			= $this->input->post('tgl_pengkajian',true);
		$regdate				= $this->input->post('xxxxxxxxx',true);
		$tgl_pengkajian	= $this->input->post('tgl_pengkajian',true);
		$asal_masuk			= $this->input->post('asal_masuk',true);
		$cara_masuk			= $this->input->post('cara_masuk',true);
		$id_reg					= $this->input->post('xxxxxxxxx',true);
		$id_pasien			= $this->input->post('xxxxxxxxx',true);
		$nama_pasien		= $this->input->post('xxxxxxxxx',true);
		$id_dokter			= $this->input->post('xxxxxxxxx',true);
		$id_type				= $this->input->post('xxxxxxxxx',true);
		$jenis_asm			= 'DOKTER';
		$subjective			= $this->input->post('xxxxxxxxx',true);
		$objective			= $this->input->post('xxxxxxxxx',true);
		$assesment			= $this->input->post('xxxxxxxxx',true);
		$planning				= $this->input->post('xxxxxxxxx',true);
		$keluhan_utama					= $this->input->post('keluhan_utama',true);
		$riwayat_sakit					= $this->input->post('xxxxxxxxx',true);
		$riwayat_sakit_dulu			= $this->input->post('xxxxxxxxx',true);
		$riwayat_pengobatan			= $this->input->post('xxxxxxxxx',true);
		$riwayat_sakit_keluarga	= $this->input->post('xxxxxxxxx',true);
		$riwayat_alergi					= $this->input->post('xxxxxxxxx',true);
		$status_psikologi				= $this->input->post('xxxxxxxxx',true);
		$status_kultural				= $this->input->post('xxxxxxxxx',true);
		$ibadah									= $this->input->post('xxxxxxxxx',true);
		$thaharoh								= $this->input->post('xxxxxxxxx',true);
		$sholat									= $this->input->post('xxxxxxxxx',true);
		$bim_spiritual_muslim		= $this->input->post('xxxxxxxxx',true);
		$bim_spiritual_nonmuslim	= $this->input->post('xxxxxxxxx',true);
		$kesadaran			= $this->input->post('xxxxxxxxx',true);
		$td							= $this->input->post('xxxxxxxxx',true);
		$nadi						= $this->input->post('xxxxxxxxx',true);
		$nafas					= $this->input->post('xxxxxxxxx',true);
		$keadaan_umum		= $this->input->post('xxxxxxxxx',true);
		$gcs						= $this->input->post('xxxxxxxxx',true);
		$suhu						= $this->input->post('xxxxxxxxx',true);
		$reaksi_cahaya	= $this->input->post('xxxxxxxxx',true);
		$tinggi					= $this->input->post('xxxxxxxxx',true);
		$berat					= $this->input->post('xxxxxxxxx',true);
		$fisik_khusus		= $this->input->post('xxxxxxxxx',true);
		$pu_kepala			= $this->input->post('xxxxxxxxx',true);
		$pu_rambut			= $this->input->post('xxxxxxxxx',true);
		$pu_wajah				= $this->input->post('xxxxxxxxx',true);
		$pu_mata				= $this->input->post('xxxxxxxxx',true);
		$pu_gigi				= $this->input->post('xxxxxxxxx',true);
		$pu_tenggorokan	= $this->input->post('xxxxxxxxx',true);
		$pu_lidah				= $this->input->post('xxxxxxxxx',true);
		$pu_leher				= $this->input->post('xxxxxxxxx',true);
		$pu_abdomen			= $this->input->post('xxxxxxxxx',true);
		$pu_dada				= $this->input->post('xxxxxxxxx',true);
		$pu_respirasi		= $this->input->post('xxxxxxxxx',true);
		$pu_jantung			= $this->input->post('xxxxxxxxx',true);
		$pu_integumen		= $this->input->post('xxxxxxxxx',true);
		$pu_ekstremitas	= $this->input->post('xxxxxxxxx',true);
		$pu_genetalia		= $this->input->post('xxxxxxxxx',true);
		$pu_elimitas		= $this->input->post('xxxxxxxxx',true);
		/*
		$anak_nyeri_face= '';
		$anak_nyeri_legs= $this->input->post('xxxxxxxxx',true);
		$anak_nyeri_activity= $this->input->post('xxxxxxxxx',true);
		$anak_nyeri_cry= $this->input->post('xxxxxxxxx',true);
		$anak_nyeri_consolability= $this->input->post('xxxxxxxxx',true);
		$anak_nyeri_total= $this->input->post('xxxxxxxxx',true);
		$anak_riwayat_imunisasi= $this->input->post('xxxxxxxxx',true);
		$anak_tk_senyum= $this->input->post('xxxxxxxxx',true);
		$anak_tk_berdiri= $this->input->post('xxxxxxxxx',true);
		$anak_tk_tengkurap= $this->input->post('xxxxxxxxx',true);
		$anak_tk_berjalan= $this->input->post('xxxxxxxxx',true);
		$anak_tk_duduk= $this->input->post('xxxxxxxxx',true);
		$anak_tk_bicara= $this->input->post('xxxxxxxxx',true);
		$anak_tk_merangkak= $this->input->post('xxxxxxxxx',true);
		$anak_tk_sekolah= $this->input->post('xxxxxxxxx',true);
		*/
		$kualitas_nyeri		= $this->input->post('xxxxxxxxx',true);
		$frekuensi_nyeri	= $this->input->post('xxxxxxxxx',true);
		$waktu_nyeri			= $this->input->post('xxxxxxxxx',true);
		$intesnsitas_nyeri= $this->input->post('xxxxxxxxx',true);
		$nyeri						= $this->input->post('xxxxxxxxx',true);
		$pengaruh_nyeri		= $this->input->post('xxxxxxxxx',true);
		$aktivitas				= $this->input->post('xxxxxxxxx',true);
		$restrain					= $this->input->post('xxxxxxxxx',true);
		$bb_turun					= $this->input->post('xxxxxxxxx',true);
		$bb_turun_qty			= $this->input->post('xxxxxxxxx',true);
		$nafsu_makan			= $this->input->post('xxxxxxxxx',true);
		$total_skor				= $this->input->post('xxxxxxxxx',true);
		$diagnosa_khusus	= $this->input->post('xxxxxxxxx',true);
		$pola_makan				= $this->input->post('xxxxxxxxx',true);
		$keluhan_saat_ini	= $this->input->post('xxxxxxxxx',true);
		$sf_makan					= $this->input->post('xxxxxxxxx',true);
		$sf_transfer			= $this->input->post('xxxxxxxxx',true);
		$sf_grooming			= $this->input->post('xxxxxxxxx',true);
		$sf_toilet				= $this->input->post('xxxxxxxxx',true);
		$sf_mandi					= $this->input->post('xxxxxxxxx',true);
		$sf_jalan					= $this->input->post('xxxxxxxxx',true);
		$sf_tangga				= $this->input->post('xxxxxxxxx',true);
		$sf_berpakaian		= $this->input->post('xxxxxxxxx',true);
		$sf_bowel					= $this->input->post('xxxxxxxxx',true);
		$sf_bladder				= $this->input->post('xxxxxxxxx',true);
		$sf_total					= $this->input->post('xxxxxxxxx',true);
		$resiko_jatuh_dws	= $this->input->post('xxxxxxxxx',true);
		$resiko_jatuh_gr	= $this->input->post('xxxxxxxxx',true);
		$pemeriksaan_penunjang	= $this->input->post('xxxxxxxxx',true);
		$masalah_kesehatan			= $this->input->post('xxxxxxxxx',true);
		$masalah_keperawatan		= $this->input->post('xxxxxxxxx',true);
		$rencana_keperawatan		= $this->input->post('xxxxxxxxx',true);
		$diag_medis_banding			= $this->input->post('xxxxxxxxx',true);
		$rencana_medis	= $this->input->post('xxxxxxxxx',true);
		$edukasi				= $this->input->post('xxxxxxxxx',true);
		$pasien_pulang	= $this->input->post('xxxxxxxxx',true);
		$created				= $this->input->post('xxxxxxxxx',true);
		$creator				= $this->input->post('xxxxxxxxx',true);
		$updated				= $this->input->post('xxxxxxxxx',true);
		$updator				= $this->input->post('xxxxxxxxx',true);
		
		$kategori = 'ASM';
		
		$data = array(
			//'id_asmri'           => '',
      'asmri_date'				=> date('Y-m-d H:i:s'),
			'regdate'           => $rs['regdate'],
			'tgl_pengkajian'    => $this->input->post('tgl_pengkajian'),
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
			'status_psikologi'        => $status_psikologi,
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
		
		$sql = "
						INSERT INTO `soap_asm_ri` (`id_asmri`, `asmri_date`, `regdate`, `tgl_pengkajian`, `asal_masuk`, `cara_masuk`, `id_reg`, `id_pasien`, `nama_pasien`, `id_dokter`, `id_type`, `jenis_asm`, `subjective`, `objective`, `assesment`, `planning`, `keluhan_utama`, `riwayat_sakit`, `riwayat_sakit_dulu`, `riwayat_pengobatan`, `riwayat_sakit_keluarga`, `riwayat_alergi`, `status_psikologi`, `status_kultural`, `ibadah`, `thaharoh`, `sholat`, `bim_spiritual_muslim`, `bim_spiritual_nonmuslim`, `kesadaran`, `td`, `nadi`, `nafas`, `keadaan_umum`, `gcs`, `suhu`, `reaksi_cahaya`, `tinggi`, `berat`, `fisik_khusus`, `pu_kepala`, `pu_rambut`, `pu_wajah`, `pu_mata`, `pu_gigi`, `pu_tenggorokan`, `pu_lidah`, `pu_leher`, `pu_abdomen`, `pu_dada`, `pu_respirasi`, `pu_jantung`, `pu_integumen`, `pu_ekstremitas`, `pu_genetalia`, `pu_elimitas`, `anak_nyeri_face`, `anak_nyeri_legs`, `anak_nyeri_activity`, `anak_nyeri_cry`, `anak_nyeri_consolability`, `anak_nyeri_total`, `anak_riwayat_imunisasi`, `anak_tk_senyum`, `anak_tk_berdiri`, `ana																				k_tk_tengkurap`, `anak_tk_berjalan`, `anak_tk_duduk`, `anak_tk_bicara`, `anak_tk_merangkak`, `anak_tk_sekolah`, `kualitas_nyeri`, `frekuensi_nyeri`, `waktu_nyeri`, `intesnsitas_nyeri`, `nyeri`, `pengaruh_nyeri`, `aktivitas`, `restrain`, `bb_turun`, `bb_turun_qty`, `nafsu_makan`, `total_skor`, `diagnosa_khusus`, `pola_makan`, `keluhan_saat_ini`, `sf_makan`, `sf_transfer`, `sf_grooming`, `sf_toilet`, `sf_mandi`, `sf_jalan`, `sf_tangga`, `sf_berpakaian`, `sf_bowel`, `sf_bladder`, `sf_total`, `resiko_jatuh_dws`, `resiko_jatuh_gr`, `pemeriksaan_penunjang`, `masalah_kesehatan`, `masalah_keperawatan`, `rencana_keperawatan`, `diag_medis_banding`, `rencana_medis`, `edukasi`, `pasien_pulang`, `created`, `creator`, `updated`, `updator`) 
						VALUES (1, NULL, NULL, NULL, '', '', 123123123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		";
	}


}
