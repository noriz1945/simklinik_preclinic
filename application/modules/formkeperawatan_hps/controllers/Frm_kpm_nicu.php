<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frm_kpm_nicu extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');
		$this->load->model('Mdl_kpm_nicu','mdl');
	}

  public function frmasm($id_reg){
	$creator = @$this->session->userdata['sp']->login_name;
	$base_url     = base_url('');

    $data = array(
		'creator'		=> $creator,
		'base_url'		=> $base_url,
		'id_reg'		=> $id_reg,
    );
	$this->load->view('frm_kpm_nicu', $data);
  }

//NEWS
public function mst(){
	$id_reg 		 = $this->input->post('idreg_set');
    $sql_1="SELECT grup_id,
	(CASE 
	WHEN grup_id='1' THEN 'KRITERIA'
	ELSE '-'
	END
	) AS nama_grup
	,COUNT(id)+1 AS total FROM frm_mst_kpm_nicu GROUP BY grup_id ORDER BY grup_id ASC";
    $query_1 = $this->db->query($sql_1);
    $rs_1 = $query_1->result_array();
  
    foreach($rs_1 as $k1 => $v_1){
  
    $grup_id  = $v_1['grup_id'];
        
    $sql_2 = "SELECT a.id,a.indikator,a.nilai,
	(SELECT nilai FROM frm_trn_kpm_nicu WHERE a.id=id_mst_news AND id_reg='$id_reg') AS nilai_from_trn_1
	FROM frm_mst_kpm_nicu a 
	WHERE a.grup_id='$grup_id' 
	ORDER BY a.grup_id,a.nilai ASC";
    //echo "<pre>".$sql_2;
    $query_2 	= $this->db->query($sql_2);
    $rs2 	= $query_2->result_array();
    $rs_1[$k1]['rs_1'] = $rs2;
  
    }//end lvl 1
  
    echo json_encode($rs_1);
  
  }

  public function save_news(){
	$id_doc  				 = @$this->session->userdata['sp']->id_dokter;
	$creator 				 = @$this->session->userdata['sp']->login_name;
	$date	 				 = date('Y-m-d H:i:s');
	$id_reg 		 		 = $this->input->post('idreg_set');
	$jam12_1 		 		 = $this->input->post('jam12_1_set'); 
	$jam12_1_id_mst  		 = $this->input->post('jam12_1_idmst_set');  
	$diagnosa_penyakit 		 = $this->input->post('diagnosa_penyakit'); 


	foreach($jam12_1 as $x => $jam121){ 
		$checklog_1     	= $this->mdl->tbchecklogjam_1($id_reg,$jam12_1_id_mst[$x]);
		$fnddata_1    		= $checklog_1->fnddata_1;
		if($jam121==""){
			//nothing
		}else{
			//echo $jam121."-".$jam12_1_id_mst[$x]."<br>";
			if($fnddata_1 > 0){
				$data = array(
					'nilai'				=> $jam121,
					'diagnosa_penyakit'	=> $diagnosa_penyakit,
					'updated' 			=> $date,
					'updator' 			=> $creator
				);
				$where = array(
					'id_mst_news'	=> $jam12_1_id_mst[$x],
					'id_reg'		=> $id_reg
				);
				$table = "frm_trn_kpm_nicu";
				$this->mdl->update_data($where,$data,$table);
			}else{
				$data = array(
				  'id_mst_news'			=> $jam12_1_id_mst[$x],
				  'id_reg'				=> $id_reg,
				  'nilai'				=> $jam121,
				  'diagnosa_penyakit'	=> $diagnosa_penyakit,
				  'created'				=> $date,
				  'creator'				=> $creator
		  		);
		  		$this->mdl->add_data_jam121($data);
		  }
		}
	}

	///////////////////////////

	echo json_encode(array("status" => true));
  }

//End NEWS

public function mst_rep(){
	$id_reg 		 = $this->input->post('idreg_set');
    $sql_1="SELECT grup_id,
	(CASE 
	WHEN grup_id='1' THEN 'KRITERIA'
	ELSE '-'
	END
	) AS nama_grup
	,COUNT(id)+1 AS total FROM frm_mst_kpm_nicu GROUP BY grup_id ORDER BY grup_id ASC";
    $query_1 = $this->db->query($sql_1);
    $rs_1 = $query_1->result_array();

    foreach($rs_1 as $k1 => $v_1){
	$grup_id  = $v_1['grup_id'];
        
    $sql_2 = "SELECT a.id,a.indikator,a.nilai
	FROM frm_mst_kpm_nicu a 
	WHERE a.grup_id='$grup_id' 
	ORDER BY a.grup_id,a.nilai ASC";
    $query_2 	= $this->db->query($sql_2);
    $rs2 	= $query_2->result_array();
    $rs_1[$k1]['rs_1'] = $rs2;

    foreach($rs2 as $k2 => $v_2){
	$id_mst_news   = $v_2['id'];
  
    //lvl 2
    $sql_3 = "SELECT
	(SELECT nilai FROM frm_trn_kpm_nicu WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' GROUP BY id_mst_news) AS nilai_1
	FROM frm_trn_kpm_nicu 
	WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg'
	GROUP BY id_mst_news LIMIT 1";
    $query_3 	= $this->db->query($sql_3);
    $rs3 	= $query_3->result_array();     
    $rs_1[$k1]['rs_2'] = $rs3;
    $rs_1[$k1]['rs_1'][$k2]['rs_2'] = $rs3;

    }//end lvl 2

    }//end lvl 1
  
    echo json_encode($rs_1);
  
  }

}
