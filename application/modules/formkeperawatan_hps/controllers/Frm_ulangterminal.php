<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frm_ulangterminal extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');
		$this->load->model('Mdl_ulangterminal','mdl');
	}

  public function frmasm($id_reg){
	$pasien 		= $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
	$id_pasien		= $pasien['id_pasien'];
	$base_url   = base_url('');

    $data = array(
		'base_url'		 => $base_url,
		'id_reg'		 => $id_reg,
    );
	$this->load->view('frm_asm_ulangterminal', $data);
  }

  public function asm_ulangterminal_add($id_reg){
		$creator = @$this->session->userdata['sp']->login_name;

		$rs = $this->mdl->data_pasien_ranap($id_reg);

		////////////////////////////
		$dateasmri  					= date('Y-m-d H:i:s');
		$id_pasien 						= $rs['id_pasien'];
		$asal_ulang 					= $this->input->post('asal_ulang');
		$tgl_asulang 					= $this->input->post('tgl_asulang');
		$chk_aupt_1_a					= $this->input->post('aupt_1_a'); $aupt_1_a	= implode(';',(array)$chk_aupt_1_a);
		$chk_aupt_1_b					= $this->input->post('aupt_1_b'); $aupt_1_b	= implode(';',(array)$chk_aupt_1_b);
		$chk_aupt_1_c					= $this->input->post('aupt_1_c'); $aupt_1_c	= implode(';',(array)$chk_aupt_1_c);
		$chk_aupt_1_d					= $this->input->post('aupt_1_d'); $aupt_1_d	= implode(';',(array)$chk_aupt_1_d);
		$chk_aupt_2_a					= $this->input->post('aupt_2_a'); $aupt_2_a	= implode(';',(array)$chk_aupt_2_a);
		$aupt_2_a_text 					= $this->input->post('aupt_2_a_text');
		$chk_aupt_3_a					= $this->input->post('aupt_3_a'); $aupt_3_a	= implode(';',(array)$chk_aupt_3_a);
		$aupt_3_a_text					= $this->input->post('aupt_3_a_text');
		$chk_aupt_4_a					= $this->input->post('aupt_4_a'); $aupt_4_a	= implode(';',(array)$chk_aupt_4_a);
		$chk_aupt_5_a					= $this->input->post('aupt_5_a'); $aupt_5_a	= implode(';',(array)$chk_aupt_5_a);
		$aupt_5_a_1_text 				= $this->input->post('aupt_5_a_1_text');
		$aupt_5_a_2_text 				= $this->input->post('aupt_5_a_2_text');
		$aupt_5_a_3_text 				= $this->input->post('aupt_5_a_3_text');
		$aupt_5_a_4_text 				= $this->input->post('aupt_5_a_4_text');
		$chk_aupt_6_a					= $this->input->post('aupt_6_a'); $aupt_6_a	= implode(';',(array)$chk_aupt_6_a);
		$chk_aupt_6_b					= $this->input->post('aupt_6_b'); $aupt_6_b	= implode(';',(array)$chk_aupt_6_b);
		$aupt_6_b_1_text 				= $this->input->post('aupt_6_b_1_text');
		$chk_aupt_6_c					= $this->input->post('aupt_6_c'); $aupt_6_c	= implode(';',(array)$chk_aupt_6_c);
		$chk_aupt_6_d					= $this->input->post('aupt_6_d'); $aupt_6_d	= implode(';',(array)$chk_aupt_6_d);
		$chk_aupt_7_a					= $this->input->post('aupt_7_a'); $aupt_7_a	= implode(';',(array)$chk_aupt_7_a);
		$chk_aupt_8_a					= $this->input->post('aupt_8_a'); $aupt_8_a	= implode(';',(array)$chk_aupt_8_a);
		$aupt_8_a_1_text 				= $this->input->post('aupt_8_a_1_text');
		$aupt_8_a_2_text 				= $this->input->post('aupt_8_a_2_text');
		$chk_aupt_9_a					= $this->input->post('aupt_9_a'); $aupt_9_a	= implode(';',(array)$chk_aupt_9_a);
		$chk_aupt_9_b					= $this->input->post('aupt_9_b'); $aupt_9_b	= implode(';',(array)$chk_aupt_9_b);
		$aupt_10_a_1_text 				= $this->input->post('aupt_10_a_1_text');




		///////////////////////////
	  $data_ott = array(
		'dateasmri' 		=>	$dateasmri,
		'id_reg' 			=>	$id_reg,
		'id_pasien' 		=>	$id_pasien,
		'asal_ulang' 		=>	$asal_ulang,
		'tgl_asulang'		=>	$tgl_asulang,
		'chk_aupt_1_a' 		=>	$aupt_1_a,
		'chk_aupt_1_b' 		=>	$aupt_1_b,
		'chk_aupt_1_c' 		=>	$aupt_1_c,
		'chk_aupt_1_d' 		=>	$aupt_1_d,
		'chk_aupt_2_a' 		=>	$aupt_2_a,
		'aupt_2_a_text' 	=>	$aupt_2_a_text,
		'chk_aupt_3_a' 		=>	$aupt_3_a,
		'aupt_3_a_text' 	=>	$aupt_3_a_text,
		'chk_aupt_4_a' 		=>	$aupt_4_a,
		'chk_aupt_5_a' 		=>	$aupt_5_a,
		'aupt_5_a_1_text' 	=>	$aupt_5_a_1_text,
		'aupt_5_a_2_text' 	=>	$aupt_5_a_2_text,
		'aupt_5_a_3_text' 	=>	$aupt_5_a_3_text,
		'aupt_5_a_4_text' 	=>	$aupt_5_a_4_text,
		'chk_aupt_6_a' 		=>	$aupt_6_a,
		'chk_aupt_6_b' 		=>	$aupt_6_b,
		'aupt_6_b_1_text' 	=>	$aupt_6_b_1_text,
		'chk_aupt_6_c' 		=>	$aupt_6_c,
		'chk_aupt_6_d' 		=>	$aupt_6_d,
		'chk_aupt_7_a' 		=>	$aupt_7_a,
		'chk_aupt_8_a' 		=>	$aupt_8_a,
		'aupt_8_a_1_text' 	=>	$aupt_8_a_1_text,
		'aupt_8_a_2_text' 	=>	$aupt_8_a_2_text,
		'chk_aupt_9_a' 		=>	$aupt_9_a,
		'chk_aupt_9_b' 		=>	$aupt_9_b,
		'aupt_10_a_1_text' 	=>	$aupt_10_a_1_text,
		'created'			=>  date('Y-m-d H:i:s'),
		'status'			=>  '0',
		'creator'			=> $creator,
		'updated'			=> 'null',
		'updator'			=> 'null',
	  );
		
		$this->mdl->add_data_asm_ranap_ott($data_ott);


    	echo json_encode(array("status" => true));
  }

  public function deletelogterminal(){
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
	$table = "frm_asm_terminal";
		
	$this->mdl->update_data($where, $data, $table);
    echo json_encode(array("status" => true));
  }

  public function tblogterminal(){
	$id_reg	= $this->input->post('id_reg');
	$data = $this->mdl->getlogterminal($id_reg);
	echo json_encode($data);
  }

  public function detaillogterminal(){
	$id		= $this->input->post('id');
	$data 	= $this->mdl->getdetaillogterminal($id);
	echo json_encode($data);
  }

}
