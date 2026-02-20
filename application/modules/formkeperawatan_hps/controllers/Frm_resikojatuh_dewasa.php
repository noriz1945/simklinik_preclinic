<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frm_resikojatuh_dewasa extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');
		$this->load->model('Mdl_resikojatuh_dewasa','mdl');
	}

  public function frmasm($id_reg){
	$creator = @$this->session->userdata['sp']->login_name;
	$base_url     = base_url('');

    $data = array(
		'creator'		=> $creator,
		'base_url'		=> $base_url,
		'id_reg'		=> $id_reg,
    );
	$this->load->view('frm_resikojatuh_dewasa', $data);
  }

//NEWS
  public function mst(){
	$id_reg 		 = $this->input->post('idreg_set');
	$tanggal_post 	 = $this->input->post('tanggal_set');
	$tanggal_set=date_create($tanggal_post);
	$tanggal = date_format($tanggal_set,"Y-m-d");
	$jam_post 	 	 = $this->input->post('jam_set');
    $sql_1="SELECT grup_id,
	(CASE 
	WHEN grup_id='1' THEN '1'
	WHEN grup_id='2' THEN '2'
	WHEN grup_id='3' THEN '3 (Alat bantu jalan)'
	WHEN grup_id='4' THEN '4'
	WHEN grup_id='5' THEN '5 (Cara berjalan / berpindah)'
	WHEN grup_id='6' THEN '6 (Status Mental)'
	ELSE '-'
	END
	) AS nama_grup
	,COUNT(id)+1 AS total FROM frm_mst_resikojatuh_dewasa GROUP BY grup_id ORDER BY grup_id,nilai + 0 ASC";
    $query_1 = $this->db->query($sql_1);
    $rs_1 = $query_1->result_array();
  
    foreach($rs_1 as $k1 => $v_1){
  
    $grup_id  = $v_1['grup_id'];
        
    $sql_2 = "SELECT a.id,a.indikator,a.nilai,
	(SELECT nilai FROM frm_trn_resikojatuh_dewasa WHERE a.id=id_mst_news AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='$jam_post') AS nilai_from_trn_1
	FROM frm_mst_resikojatuh_dewasa a 
	WHERE a.grup_id='$grup_id' 
	ORDER BY a.grup_id,a.nilai + 0 ASC";
    //echo "<pre>".$sql_2;
    $query_2 	= $this->db->query($sql_2);
    $rs2 	= $query_2->result_array();
    $rs_1[$k1]['rs_1'] = $rs2;
  
    }//end lvl 1
  
    echo json_encode($rs_1);
  
  }

  public function save_news(){
	$id_doc  = @$this->session->userdata['sp']->id_dokter;
	$creator = @$this->session->userdata['sp']->login_name;
	$date	 = date('Y-m-d H:i:s');
	$id_reg 		 = $this->input->post('idreg_set');
	$tanggal_post 	 = $this->input->post('tanggal_set');
	$jam_post 	     = $this->input->post('jam_set');
	$tanggal_set	 = date_create($tanggal_post);
	$tanggal 		 = date_format($tanggal_set,"Y-m-d");
	$jam12_1 		 = $this->input->post('jam12_1_set'); 
	$jam12_1_id_mst  = $this->input->post('jam12_1_idmst_set'); 


	foreach($jam12_1 as $x => $jam121){ 
		$checklog_1     	= $this->mdl->tbchecklogjam_1($id_reg,$jam12_1_id_mst[$x],$tanggal,$jam_post);
		$fnddata_1    		= $checklog_1->fnddata_1;
		if($jam121==""){
			//nothing
		}else{
			//echo $jam121."-".$jam12_1_id_mst[$x]."<br>";
			if($fnddata_1 > 0){
				$data = array(
					'nilai'				=> $jam121,
					'updated' 			=> $date,
					'updator' 			=> $creator
				);
				$where = array(
					'id_mst_news'	=> $jam12_1_id_mst[$x],
					'id_reg'		=> $id_reg,
					'tanggal'		=> $tanggal,
					'jam12'			=> $jam_post
				);
				$table = "frm_trn_resikojatuh_dewasa";
				$this->mdl->update_data($where,$data,$table);
			}else{
				$data = array(
				  'id_mst_news'	=> $jam12_1_id_mst[$x],
				  'id_reg'		=> $id_reg,
				  'tanggal'		=> $tanggal,
				  'nilai'		=> $jam121,
				  'jam12'		=> $jam_post,
				  'created'		=> $date,
				  'creator'		=> $creator
		  		);
		  		$this->mdl->add_data_jam121($data);
		  }
		}
	}

	///////////////////////////

	echo json_encode(array("status" => true));
  }

  public function mst_rep(){
	$id_reg 		 = $this->input->post('idreg_set');
    $sql_1="SELECT id,tanggal,creator FROM frm_trn_resikojatuh_dewasa WHERE id_reg='$id_reg' GROUP BY tanggal ORDER BY tanggal DESC";
    $query_1 = $this->db->query($sql_1);
    $rs_1 = $query_1->result_array();

    foreach($rs_1 as $k1 => $v_1){
	$tanggal  = $v_1['tanggal'];
        
    $sql_2 = "SELECT grup_id,
	(CASE 
	WHEN grup_id='1' THEN '1'
	WHEN grup_id='2' THEN '2'
	WHEN grup_id='3' THEN '3 (Alat bantu jalan)'
	WHEN grup_id='4' THEN '4'
	WHEN grup_id='5' THEN '5 (Cara berjalan / berpindah)'
	WHEN grup_id='6' THEN '6 (Status Mental)'
	ELSE '-'
	END
	) AS nama_grup
	,COUNT(id)+1 AS total FROM frm_mst_resikojatuh_dewasa GROUP BY grup_id ORDER BY grup_id ASC";
    $query_2 	= $this->db->query($sql_2);
    $rs2 	= $query_2->result_array();
    $rs_1[$k1]['rs_1'] = $rs2;

    foreach($rs2 as $k2 => $v_2){
	$grup_id  = $v_2['grup_id'];
  
    //lvl 2
    $sql_3 = "SELECT a.id,a.indikator,a.nilai
	FROM frm_mst_resikojatuh_dewasa a 
	WHERE a.grup_id='$grup_id' 
	ORDER BY a.grup_id,a.nilai ASC";
    $query_3 	= $this->db->query($sql_3);
    $rs3 	= $query_3->result_array();     
    $rs_1[$k1]['rs_2'] = $rs3;
    $rs_1[$k1]['rs_1'][$k2]['rs_2'] = $rs3;

	//lvl 3
	foreach($rs3 as $k3 => $v_3){
	$id_mst_news   = $v_3['id'];
		
	$sql_4 = "SELECT
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='1' GROUP BY id_mst_news) AS nilai_1,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='2' GROUP BY id_mst_news) AS nilai_2,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='3' GROUP BY id_mst_news) AS nilai_3,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='4' GROUP BY id_mst_news) AS nilai_4,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='5' GROUP BY id_mst_news) AS nilai_5,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='6' GROUP BY id_mst_news) AS nilai_6,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='7' GROUP BY id_mst_news) AS nilai_7,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='8' GROUP BY id_mst_news) AS nilai_8,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='9' GROUP BY id_mst_news) AS nilai_9,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='10' GROUP BY id_mst_news) AS nilai_10,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='11' GROUP BY id_mst_news) AS nilai_11,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='12' GROUP BY id_mst_news) AS nilai_12,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='13' GROUP BY id_mst_news) AS nilai_13,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='14' GROUP BY id_mst_news) AS nilai_14,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='15' GROUP BY id_mst_news) AS nilai_15,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='16' GROUP BY id_mst_news) AS nilai_16,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='17' GROUP BY id_mst_news) AS nilai_17,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='18' GROUP BY id_mst_news) AS nilai_18,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='19' GROUP BY id_mst_news) AS nilai_19,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='20' GROUP BY id_mst_news) AS nilai_20,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='21' GROUP BY id_mst_news) AS nilai_21,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='22' GROUP BY id_mst_news) AS nilai_22,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='23' GROUP BY id_mst_news) AS nilai_23,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='24' GROUP BY id_mst_news) AS nilai_24,
	(SELECT SUM(nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_reg='$id_reg' AND tanggal='$tanggal') AS sum_nilai_from_trn_1
	FROM frm_trn_resikojatuh_dewasa
	WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal'
	GROUP BY id_mst_news LIMIT 1";
	$query_4 	= $this->db->query($sql_4);
	$rs4 	= $query_4->result_array();     
	$rs_1[$k1]['rs_3'] = $rs4;
	$rs_1[$k1]['rs_1'][$k2]['rs_2'][$k3]['rs_3'] = $rs4;

	}//end lvl 3

    }//end lvl 2

    }//end lvl 1
  
    echo json_encode($rs_1);
  
  }

  public function mst_rep_periode(){
	$id_reg 		  	   = $this->input->post('idreg_set');
	$tanggal_period_1_post = $this->input->post('tanggal_period_1_set');
	$tanggal_period_2_post = $this->input->post('tanggal_period_2_set');
	$tanggal_period_1_post_set=date_create($tanggal_period_1_post);
	$tanggal_period_1 = date_format($tanggal_period_1_post_set,"Y-m-d");
	$tanggal_period_2_post_set=date_create($tanggal_period_2_post);
	$tanggal_period_2 = date_format($tanggal_period_2_post_set,"Y-m-d");
	
    $sql_1="SELECT id,tanggal,creator FROM frm_trn_resikojatuh_dewasa WHERE id_reg='$id_reg' AND tanggal BETWEEN '$tanggal_period_1' AND '$tanggal_period_2' GROUP BY tanggal ORDER BY tanggal DESC";
    $query_1 = $this->db->query($sql_1);
    $rs_1 = $query_1->result_array();

    foreach($rs_1 as $k1 => $v_1){
	$tanggal  = $v_1['tanggal'];
    $sql_2 = "SELECT grup_id,
	(CASE 
	WHEN grup_id='1' THEN '1'
	WHEN grup_id='2' THEN '2'
	WHEN grup_id='3' THEN '3 (Alat bantu jalan)'
	WHEN grup_id='4' THEN '4'
	WHEN grup_id='5' THEN '5 (Cara berjalan / berpindah)'
	WHEN grup_id='6' THEN '6 (Status Mental)'
	ELSE '-'
	END
	) AS nama_grup
	,COUNT(id)+1 AS total FROM frm_mst_resikojatuh_dewasa GROUP BY grup_id ORDER BY grup_id ASC";
    $query_2 	= $this->db->query($sql_2);
    $rs2 	= $query_2->result_array();
    $rs_1[$k1]['rs_1'] = $rs2;

    foreach($rs2 as $k2 => $v_2){
	$grup_id  = $v_2['grup_id'];
  
    //lvl 2
    $sql_3 = "SELECT a.id,a.indikator,a.nilai
	FROM frm_mst_resikojatuh_dewasa a 
	WHERE a.grup_id='$grup_id' 
	ORDER BY a.grup_id,a.nilai ASC";
    $query_3 	= $this->db->query($sql_3);
    $rs3 	= $query_3->result_array();
    $rs_1[$k1]['rs_2'] = $rs3;
    $rs_1[$k1]['rs_1'][$k2]['rs_2'] = $rs3;

	//lvl 3
	foreach($rs3 as $k3 => $v_3){
	$id_mst_news   = $v_3['id'];
		
	$sql_4 = "SELECT
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='1' GROUP BY id_mst_news) AS nilai_1,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='2' GROUP BY id_mst_news) AS nilai_2,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='3' GROUP BY id_mst_news) AS nilai_3,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='4' GROUP BY id_mst_news) AS nilai_4,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='5' GROUP BY id_mst_news) AS nilai_5,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='6' GROUP BY id_mst_news) AS nilai_6,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='7' GROUP BY id_mst_news) AS nilai_7,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='8' GROUP BY id_mst_news) AS nilai_8,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='9' GROUP BY id_mst_news) AS nilai_9,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='10' GROUP BY id_mst_news) AS nilai_10,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='11' GROUP BY id_mst_news) AS nilai_11,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='12' GROUP BY id_mst_news) AS nilai_12,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='13' GROUP BY id_mst_news) AS nilai_13,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='14' GROUP BY id_mst_news) AS nilai_14,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='15' GROUP BY id_mst_news) AS nilai_15,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='16' GROUP BY id_mst_news) AS nilai_16,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='17' GROUP BY id_mst_news) AS nilai_17,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='18' GROUP BY id_mst_news) AS nilai_18,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='19' GROUP BY id_mst_news) AS nilai_19,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='20' GROUP BY id_mst_news) AS nilai_20,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='21' GROUP BY id_mst_news) AS nilai_21,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='22' GROUP BY id_mst_news) AS nilai_22,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='23' GROUP BY id_mst_news) AS nilai_23,
	(SELECT (nilai) FROM frm_trn_resikojatuh_dewasa WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' AND jam12='24' GROUP BY id_mst_news) AS nilai_24
	FROM frm_trn_resikojatuh_dewasa
	WHERE id_mst_news='$id_mst_news' AND id_reg='$id_reg' AND tanggal='$tanggal' 
	GROUP BY id_mst_news LIMIT 1";
	$query_4 	= $this->db->query($sql_4);
	$rs4 	= $query_4->result_array();     
	$rs_1[$k1]['rs_3'] = $rs4;
	$rs_1[$k1]['rs_1'][$k2]['rs_2'][$k3]['rs_3'] = $rs4;

	}//end lvl 3

    }//end lvl 2

    }//end lvl 1
  
    echo json_encode($rs_1);
  
  }
//End NEWS

}
