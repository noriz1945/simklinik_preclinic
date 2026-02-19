<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frm_sprit extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');
		$this->load->model('Mdl_sprit','mdl');
	}

  public function frmasm($id_reg){
	$base_url     = base_url('');
	$pasien 		= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
	$id_pasien		= $pasien['id_pasien'];
	$riwayat_pasien	= $this->smartlib->riwayat_pasien($id_pasien);
	$user_all	    = $this->mdl->list_dokter();

	$cek_umur = $this->mdl->get_umur($id_reg);
	$umur = $cek_umur['umur'];

    $data = array(
		'base_url'		=> $base_url,
		'id_reg'		 => $id_reg,
		'riwayat_pasien' => $riwayat_pasien,
		'user_all'  => $user_all
    );
	$this->load->view('frm_asm_sprit', $data);
  }

  public function asm_sprit_add(){
    	$id_doc  = @$this->session->userdata['sp']->id_dokter;
		$creator = @$this->session->userdata['sp']->login_name;
		$date	 = date('Y-m-d H:i:s');
		$id_reg 		 = $this->input->post('id_reg');
		$rs = $this->mdl->data_pasien_ranap($id_reg);

		////////////////////////////
		$id_pasien 		 = $rs['id_pasien'];
		$nama_pasien 	 = $rs['nama_pasien'];
		$diagnosa_kerja  = $this->input->post('diagnosa_kerja');
		$rencana_asuhan  = $this->input->post('rencana_asuhan');
		$hasil_asuhan 	 = $this->input->post('hasil_asuhan');
		$cito 			 = $this->input->post('cito');
		$perkiraan_biaya = $this->input->post('perkiraan_biaya');
		$kecil 			 = $this->input->post('kecil');
		$sedang 		 = $this->input->post('sedang');
		$besar 			 = $this->input->post('besar');
		$khusus 		 = $this->input->post('khusus');
		$dokter_set 	 = $this->input->post('dokter_set');


		///////////////////////////
    	$data = array(
      		'id_reg'			=> $id_reg,
			'id_pasien'			=> $id_pasien,
			'diagnosa_kerja'	=> $diagnosa_kerja,
			'rencana_asuhan'	=> $rencana_asuhan,
			'hasil_asuhan'		=> $hasil_asuhan,
			'cito'           	=> $cito,
			'perkiraan_biaya'	=> $perkiraan_biaya,
			'kecil'           	=> $kecil,
			'sedang'           	=> $sedang,
			'besar'           	=> $besar,
			'khusus'           	=> $khusus,
			'dokter_set'		=> $dokter_set,
      		'created'			=> $date,
      		'creator' 			=> $creator,
      		'updated' 			=> 'null',
      		'updator' 			=> 'null'
    	);

    	$this->mdl->add_data_sprit($data);

    	echo json_encode(array("status" => true));
  }

  public function asm_sprit_upd(){
	$id_doc  = @$this->session->userdata['sp']->id_dokter;
	$creator = @$this->session->userdata['sp']->login_name;
	$date	 = date('Y-m-d H:i:s');
	$id_sprit 		 = $this->input->post('id_sprit');
	$diagnosa_kerja  = $this->input->post('diagnosa_kerja');
	$rencana_asuhan  = $this->input->post('rencana_asuhan');
	$hasil_asuhan 	 = $this->input->post('hasil_asuhan');
	$cito 			 = $this->input->post('cito');
	$perkiraan_biaya = $this->input->post('perkiraan_biaya');
	$kecil 			 = $this->input->post('kecil');
	$sedang 		 = $this->input->post('sedang');
	$besar 			 = $this->input->post('besar');
	$khusus 		 = $this->input->post('khusus');
	$dokter_set 	 = $this->input->post('dokter_set');


	///////////////////////////
	$data = array(
		'diagnosa_kerja'	=> $diagnosa_kerja,
		'rencana_asuhan'	=> $rencana_asuhan,
		'hasil_asuhan'		=> $hasil_asuhan,
		'cito'           	=> $cito,
		'perkiraan_biaya'	=> $perkiraan_biaya,
		'kecil'           	=> $kecil,
		'sedang'           	=> $sedang,
		'besar'           	=> $besar,
		'khusus'           	=> $khusus,
		'dokter_set'		=> $dokter_set,
		'updated' 			=> $date,
		'updator' 			=> $creator
	);
	$where = array(
		'id'				=> $id_sprit
	);

	$table = "frm_asm_sprit";

	$this->mdl->update_data($where,$data,$table);

	echo json_encode(array("status" => true));
  }

  public function asm_sprit_del(){
	$creator 	= @$this->session->userdata['sp']->login_name;
	$date	 	= date('Y-m-d H:i:s');
	$id_sprit	= $this->input->post('idset');


	///////////////////////////
	$data = array(
		'hapus'				=> 1,
		'updated' 			=> $date,
		'updator' 			=> $creator
	);
	$where = array(
		'id'				=> $id_sprit
	);
	$table = "frm_asm_sprit";
	$this->mdl->update_data($where,$data,$table);
	echo json_encode(array("status" => true));
  }

  public function asm_sprit_prt($idset){
	
	//$idset		= $this->input->post('idset');
    $rs_info   	= $this->smartlib->rs_info();
    $nama_rs   	= $rs_info['nama_rs'];
    $alamat_rs 	= $rs_info['alamat_rs'];
    $telp_rs   	= $rs_info['telp_rs'];
    $fax_rs    	= $rs_info['fax_rs'];

    $sprit     	= $this->mdl->get_data_byid($idset);
    $id_reg    	= $sprit->id_reg;
    $pasien    	= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);

    $data = array(
      'sprit'     => $sprit,
      'nama_rs'   => $nama_rs,
      'alamat_rs' => $alamat_rs,
      'telp_rs'   => $telp_rs,
      'fax_rs'    => $fax_rs,
      'pasien'    => $pasien,
    );
    //return $data;
    $this->load->view('print/print', $data);
	}

  function logsprit(){
	$id             = $this->input->post('idreg_set');
    $dataset 	    = $this->mdl->tblogsprit($id);
    $setjson        = json_encode($dataset);
	echo $setjson;
  }

  function det_data(){
	$id             = $this->input->post('id_set');
    $dataset 	    = $this->mdl->detdata($id);
    $setjson        = json_encode($dataset);
	echo $setjson;
  }

}
