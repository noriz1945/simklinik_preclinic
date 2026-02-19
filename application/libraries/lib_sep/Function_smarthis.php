<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Function_smarthis {

var $db;
var $dbsupp;
var $db2;
var $dbhis;
var $today;
var $today_timestamp;
var $config;
var $id_ppk;

public function __construct()
{
		$CI =& get_instance();
		$CI->fs = $this;
		$CI->function_smarthis = $this;
		$this->config = $CI->config;
		
		$this->db = $CI->dbsupp;
		$this->dbsupp = $CI->dbsupp;
		
		$this->db2 = $CI->dbhis;
		$this->dbhis = $CI->dbhis;
		
		date_default_timezone_set('Asia/Jakarta'); 
		$this->today = date("Y-m-d");
		$this->today_timestamp = date("Y-m-d H:i:s"); 
		$this->id_ppk = $this->config->item('apem_id_ppk');
}

function get_noka_db($variable)
{
	$sql   = "SELECT a.`asm_id` FROM mst_pasien a WHERE  a.`id_pasien` =".$variable;
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0)
	{
		$rs = $result[0];
		return $rs['asm_id'];
	  }
	else{
		return "";
	}
} 

function get_id_comp_bpjs ()
{
	
	$sql= " SELECT MMS.id_comp_bpjs FROM mst_main_setting MMS";
	
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0){
		$rs = $result[0];
		return $rs['id_comp_bpjs'];
	  }
	 else{
		return "";
	  }
	
} 

 
 
function get_booking_info_db ($my_id_pasien,$my_bookdate,$id_unit='',$alternatif_info=false)
{	
	if($id_unit!='')
		$sql ="					
						SELECT 	trb.id_trx,trb.id_dokter,trb.id_unit,trb.bookdate,trb.id_num,trb.id_pasien , trb.`bookdate`,trb.`hr_start`,trb.`id_reg`
						FROM 		`trx_reg_book` trb WHERE
										trb.`bookdate` = '".$my_bookdate."'
										AND trb.`id_pasien`= ".$my_id_pasien."
										AND trb.id_unit='".$id_unit."'
						LIMIT 0,1";
	else
		$sql ="					
					SELECT 	trb.id_trx,trb.id_dokter,trb.id_unit,trb.bookdate,trb.id_num,trb.id_pasien , trb.`bookdate`,trb.`hr_start`,trb.`id_reg`
					FROM 		`trx_reg_book` trb WHERE
									trb.`bookdate` = '".$my_bookdate."'
									AND trb.`id_pasien`= ".$my_id_pasien."
					LIMIT 0,1";
		
	if($alternatif_info)
	{
		$sql ="
					SELECT 	trb.id_trx,trb.id_dokter,trb.id_unit,trb.bookdate,trb.id_num,trb.id_pasien , trb.`bookdate`,trb.`hr_start`,trb.`id_reg`
					FROM 		`trx_reg_book` trb 
					WHERE		trb.`bookdate` = '".$my_bookdate."'
									AND trb.`id_pasien`= ".$my_id_pasien."
					LIMIT 1,1 		";
	}	
	
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	if($query->num_rows() > 0)
	{
		$rs 				= $result[0];
		$id_trx			= $rs['id_trx'];
		$id_dokter	= $rs['id_dokter'];
		$iddokter 	= $this->get_id_doctor_smarthis2bpjs($id_dokter);
		$id_unit		= $rs['id_unit'];
		$bookdate		= $rs['bookdate'];
		$id_num			= $rs['id_num'];
		$id_pasien	= $rs['id_pasien'];
		$bookdate 	= $rs['bookdate'];
		$hr_start 	= $rs['hr_start'];
		$id_reg 		= $rs['id_reg'];
		$msg 				='OK';
	}
	else
	{
		$id_trx			= "";
		$id_dokter	= "";
		$iddokter		= "";
		$id_unit		= "";
		$bookdate		= "";
		$id_num			= "";
		$id_pasien	= "";
		$bookdate		= "";
		$hr_start		= "";
		$id_reg			= "";
		$msg 				= "";	
	}
		
	return array(
		'id_trx' 		=>$id_trx,
		'id_dokter' =>$id_dokter,
		'iddokter' 	=>$iddokter,
		'id_unit' 	=>$id_unit,
		'bookdate' 	=>$bookdate,
		'id_num' 		=>$id_num,
		'id_pasien' =>$id_pasien,
		'bookdate' 	=>$bookdate,
		'hr_start' 	=>$hr_start,
		'id_reg' 		=>$id_reg,
		'msg' 			=>$msg	
	);
} 
 
 

function get_id_poly_smarthis2bpjs ($variable)
{
	
	$sql   = "SELECT a.`kode_poli` FROM mapping_poli_bpjs a WHERE  a.`id_unit` ='".$variable."'";	
	
	$query = $this->db->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0)
	{
		$rs = $result[0];
		return $rs['kode_poli'];
	}
	else
	{
		return "";
	}
	
} 


function get_id_poly_bpjs2smarthis ($variable)
{
	
	$sql   = "SELECT a.`id_unit` FROM mapping_poli_bpjs a WHERE  a.`kode_poli` ='".$variable."'";
	
	$query = $this->db->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0){
		$rs = $result[0];
		return $rs['id_unit'];
	  }
	 else{
		return "";
	  }
	
} 


function get_addtional_id_act ($variable)
{
	
	$sql   = "SELECT a.`addtional_id_act` FROM mapping_poli_bpjs a WHERE  a.`id_unit` ='".$variable."'";
	
	$query = $this->db->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0){
		$rs = $result[0];
		return $rs['addtional_id_act'];
	  }
	 else{
		return "";
	  }
	
} 



function get_id_doctor_smarthis2bpjs ($variable)
{
	
	$sql   = "SELECT a.`iddokter` FROM mapping_dokter_bpjs a WHERE  a.`id_dokter` ='".$variable."'";
	
	$query = $this->db->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0){
		$rs = $result[0];
		return $rs['iddokter'];
	  }
	 else{
		return "";
	  }
	
} 


function get_name_doctor_smarthis ($variable)
{
	
	$sql   = "SELECT a.`name` FROM mst_dokter a WHERE  a.`id_dokter` ='".$variable."'";
	
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0){
		$rs = $result[0];
		return $rs['name'];
	  }
	 else{
		return "";
	  }
	
} 

function get_name_unit_smarthis ($variable)
{
	
	$sql   = "SELECT a.`name` FROM mst_unit a WHERE  a.`id_unit` ='".$variable."'";
	
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0){
		$rs = $result[0];
		return $rs['name'];
	  }
	 else{
		return "";
	  }
	
} 


function mapping_data ($my_id_pasien,$my_bookdate) {
		
	    $info_booking = $this->get_booking_info_db($my_id_pasien,$my_bookdate);
	    $id_dokter = $info_booking['id_dokter'];
		$id_unit   = $info_booking['id_unit'];
		 
		 //mapping bpjs
		 $iddokter  = $this->get_id_doctor_smarthis2bpjs($id_dokter);
		 $kode_poli = $this->get_id_poly_smarthis2bpjs ($id_unit);
		 
		 
		  return array(
		    'iddokter' =>$iddokter,
			'kode_poli' =>$kode_poli
			);
	}

function get_noreg()
{
	$strID="";
	$intCtr = 0;
	$intRowCount = 0;
	
	$intCurrMonth = date('n');
	$intCurrYear = date('Y'); 	
	$pmonth = $intCurrMonth;
	$pyear = $intCurrYear;
	
	// $sql   = "SELECT a.`ctr` FROM ctr_reg a WHERE  a.`pyear` ='".$pyear."'  AND  a.`pmonth` ='".$pmonth."'";
	$sql   = "SELECT T.ctr FROM ctr_fo T WHERE T.id_ctr='REG' AND T.pyear='".$pyear."' AND T.pmonth='".$pmonth."'";
	#echo "<pre>".$sql."</pre>";
	$query = $this->db2->query($sql);
	#$result = $query->result_array();
	$objTB = $query->result();
	$objTB = $objTB[0];
	
	$intRowCount = $query->num_rows();
	if($intRowCount>0){	
		$intCtr =  intval ($objTB->ctr);
	}
	$intCtr++;
	
	$res_abbr = $this->db2->query("SELECT abbr FROM mst_main_setting")->result();
	$abbr = $res_abbr[0]->abbr;
	$strID = str_pad($intCurrMonth, 2, "0",STR_PAD_LEFT).substr($intCurrYear,2). $abbr .str_pad($intCtr, 5, "0",STR_PAD_LEFT);
	#$this->db2->autocommit(false);
	$this->db2->trans_begin();
	if($intRowCount>0){	 
		// $sql   = "UPDATE ctr_reg SET ctr=".$intCtr." WHERE  pyear ='".$pyear."'  AND  pmonth ='".$pmonth."'";	
		$sql   = "UPDATE ctr_fo SET ctr=".$intCtr." WHERE id_ctr='REG' AND pyear ='".$pyear."'  AND  pmonth ='".$pmonth."' ";	
	}else{
		// $sql   = "INSERT INTO ctr_reg (pmonth,pyear,ctr) VALUES ('".$intCurrMonth."','".$intCurrYear."',".$intCtr.")";
		$sql   = "INSERT INTO ctr_fo (id_ctr,pmonth,pyear,ctr) VALUES ('REG','".$intCurrMonth."','".$intCurrYear."',".$intCtr.")";
	}
	
	$query = $this->db2->query($sql);
	#$result = $query->result();
	
	#if($result === false){
	if($this->db2->trans_status() === false){
		$this->db2->trans_rollback();
	}
	else
	{
		$this->db2->trans_commit();
	}
	
	return $strID;
}
 
 
function add_trx_reg($noka,$namapeserta,$my_id_pasien,$my_id_trx,$my_id_unit,$my_id_dokter,$my_id_num)
{
	$today_timestamp = $this->today_timestamp;
	
	$sql		= " SELECT tr.`id_reg` 
							FROM trx_reg tr, `trx_reg_unit` tru 
							WHERE 
										 tr.`id_reg` = tru.`id_reg`
										 AND tru.`id_unit`='".$my_id_unit."' 
										 AND tr.`id_pasien`='".$my_id_pasien."' 
										 AND DATE(tr.`regdate`)=DATE(now())";
	#echo "<pre>".$sql."</pre>";
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	$rs 		= @$result[0];
	$id_reg_cek = @$rs['id_reg'];
	if ($id_reg_cek!='') {
		$ret_id_reg = $id_reg_cek;
	}
	else 
	{
		$sql	= " SELECT MMS.id_comp_bpjs FROM mst_main_setting MMS";
		
		$query = $this->db2->query($sql);
		$result = $query->result_array();
		$rs 	= $result[0];
		
		$id_reg 		= $this->get_noreg();
		$regdate		= $today_timestamp;
		$id_pasien	= $my_id_pasien;
		
		//$id_asuransi= get_id_comp_bpjs ();
		$id_asuransi= $rs['id_comp_bpjs'];
		$mrstat			= 1;
		$rwjn				= 1;
		$penanggung = $namapeserta;
		$card_id		= $noka;
		$card_name	= $namapeserta;
		$created 		= $today_timestamp;
		$creator		= 'EDP';
		$updated		= $today_timestamp;
		$updater		= 'EDP';	 
		
		//trx_reg_book
		$id_trx			= $my_id_trx;
		$id_num			= $my_id_num;
		$id_unit		= $my_id_unit;
		$id_dokter  = $my_id_dokter;			 
		
		#$this->db2->autocommit(false);
		$this->db2->trans_begin();
		
		$sql       =  "INSERT  INTO trx_reg 
						(id_reg,regdate,id_pasien,id_asuransi,mrstat,rwjn,penanggung,card_id,card_name,created,creator,updated,updater)
						VALUES
						('".$id_reg."','".$regdate."','".$id_pasien."','".$id_asuransi."','".$mrstat."','".$rwjn."','".$penanggung."','".$card_id."','".$card_name."','".$created."','".$creator."','".$updated."','".$updater."')
						";	  
		
		$query 	= $this->db2->query($sql);
		#$result = $query->result_array();
		
		#if($result === false){
		if($this->db2->trans_status() === false){
			$this->db2->trans_rollback();
			$ret_id_reg ='';
		}
		else
		{
			$this->db2->trans_commit();
			$ret_id_reg = $id_reg;
		}
	}
	return $ret_id_reg;
}
 
function add_admin_reg ($my_id_reg)
{
	$today_timestamp = $this->today_timestamp; 
	
	$id_reg  	= $my_id_reg;
	$created 	= $today_timestamp;
	$creator	= 'EDP';
	$updated	= $today_timestamp;
	$updater	= 'EDP';	
	
	$sql= " SELECT MT.id_act,MT.name,MMS.id_comp_bpjs,
	        MT.id_group,MT.id_subgroup,MT.markup,MT.price
					FROM mst_main_setting MMS
					INNER JOIN mst_tindakan MT ON MMS.id_act_rwj=MT.id_act";
	
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	$rs = $result[0];
	
	$trxdate     	= $today_timestamp;
	$id_reg_act  	= $rs['id_act'];
	$id_type     	= 1;
	$name 		 		= $rs['name'];
	$qty		 			= 1;
	$price 		 		= $rs['price'];
	$total		 		= $rs['price'];
	$id_group_act	= $rs['id_group'];
	$id_asuransi	= $rs['id_comp_bpjs'];
	
	$this->db2->trans_begin();
	#$this->db2->autocommit(false);
	
	$sql =  "INSERT  INTO trx_reg_act 
				 (id_reg,trxdate,id_reg_act,id_type,id_group_act,name,qty,price,total,created,creator,updated,updater)
				  VALUES
				 (
				 '".$id_reg."',
				 '".$trxdate."',
				 '".$id_reg_act."',
				 '".$id_type."',
				 '".$id_group_act."',
				 '".$name."',
				 '".$qty."',
				 '".$price."',
				 '".$total."',
				 '".$created."',
				 '".$creator."',
				 '".$updated."',
				 '".$updater."'
				 )
				  ";
	
	$query = $this->db2->query($sql);
	#$result = $query->result_array();		
	
	#if($result === false){
	if($this->db2->trans_status() === false){
		$this->db2->trans_rollback();
		$msg ='';
	}
	else
	{
		$this->db2->trans_commit();
		$msg =$id_asuransi;
	}	
	return $msg;
} 

function add_dokter_act ($my_id_reg,$my_id_unit,$my_id_dokter,$my_id_asuransi)
{
	$today_timestamp = $this->today_timestamp; 
	
	$id_reg		= $my_id_reg;
	$id_unit 	= $my_id_unit;
	$id_dokter 	= $my_id_dokter;
	$id_asuransi= $my_id_asuransi;
	
	$trxdate    = $today_timestamp;
	$created 	= $today_timestamp;
	$creator	= 'EDP';
	$updated	= $today_timestamp;
	$updater	= 'EDP';	 
	
	$sql = " 
	SELECT 
	IFNULL(
	(SELECT MV.id_act FROM mst_dokter_srv AS MV 
	WHERE MV.id_daytype = IF(DAYOFWEEK(DATE(now())) = 1,2,1) 
	AND MV.id_dokter=MD.`id_dokter`)
	,
	(SELECT MV.id_act FROM mst_dokter_srv AS MV 
	WHERE MV.id_daytype = IF(DAYOFWEEK(DATE(now())) = 1,2,1) 
	AND  MV.id_jenis=MD.`id_jenis`
	AND (MV.`id_dokter`=MD.`id_dokter` OR MV.`id_dokter` IS NULL))
	) AS id_act
	FROM mst_dokter MD WHERE MD.`id_dokter`='".$id_dokter."'
	LIMIT 0,1	
	";
	
	$query = $this->db2->query($sql);
	$result = $query->result_array();	
	$rs 		= $result[0];
	$id_reg_act = $rs['id_act'];	
	
	$sql_dokter_act = " SELECT a.`id_act`,b.`name`,a.`price`,b.`id_group` 
						FROM `mst_tindakan_prc` a,`mst_tindakan` b
						WHERE 
						a.`id_act`=b.`id_act`
						AND a.`id_act`='".$id_reg_act."' 
						AND a.`id_comp`='".$id_asuransi."' 
						AND a.`id_kelas`=-1 ";
	#echo "<pre>".$sql_dokter_act."</pre>";
	$query = $this->db2->query($sql_dokter_act);
	#$rs_dokter_act = $result_dokter_act->fetch_array(MYSQLI_ASSOC);
	$result = $query->result_array();
	$rs_dokter_act = $result[0];
	
	$id_group_act = $rs_dokter_act['id_group'];
	$name					= $rs_dokter_act['name'];
	$price  			= $rs_dokter_act['price'];
  $total 				= $rs_dokter_act['price'];
	$id_type     	= 1;
	$qty		 			= 1;	
	
	#$this->db2->autocommit(false);
	$this->db2->trans_begin();
	
	$sql =  "    INSERT  INTO trx_reg_act 
				 (id_reg,trxdate,id_reg_act,id_type,id_dokter,id_group_act,id_unit,name,qty,price,total,created,creator,updated,updater)
				  VALUES
				 (
				 '".$id_reg."',
				 '".$trxdate."',
				 '".$id_reg_act."',
				 '".$id_type."',
				 '".$id_dokter."',
				 '".$id_group_act."',
				 '".$id_unit."',
				 '".$name."',
				 '".$qty."',
				 '".$price."',
				 '".$total."',
				 '".$created."',
				 '".$creator."',
				 '".$updated."',
				 '".$updater."')
				  ";
					  
	$query = $this->db2->query($sql);
	#$result = $query->result_array();		
	
	#if($result === false){
	if($this->db2->trans_status() === false){
		$this->db2->trans_rollback();
		$id_trx_act ='';
	}
	else
	{
		$this->db2->trans_commit();
				
		$sql = "SELECT * FROM trx_reg_act a WHERE a.`id_reg_act`='".$id_reg_act."' AND a.`id_reg`='".$id_reg."'";
		$query = $this->db2->query($sql);
		$result = $query->result_array();	
		$rs 		= $result[0];
		$id_trx_act = $rs['id_trx'];
	}
	return $id_trx_act;
} 

function add_trx_reg_unit($my_id_reg,$my_id_unit,$my_id_dokter,$my_id_num,$my_id_trx_act,$my_id_slot)
{
	
	$today_timestamp = $this->today_timestamp;
	
	$trxdate    = $today_timestamp;
	$created 	= $today_timestamp;
	$creator	= 'EDP';
	$updated	= $today_timestamp;
	$updater	= 'EDP';	
	
	$id_reg 	= $my_id_reg;
	$id_unit 	= $my_id_unit;
	$id_dokter	= $my_id_dokter;
	$id_num 	= $my_id_num;
	$id_trx_act = $my_id_trx_act;
	$id_slot 	= $my_id_slot;
	 
	#$this->db2->autocommit(false);
	$this->db2->trans_begin();
	
	$sql    =  "INSERT  INTO trx_reg_unit 
				 (id_reg,trxdate,id_unit,id_dokter,ctr_num,id_trx_act,id_slot,created,creator,updated,updater)
				  VALUES
				 (
				 '".$id_reg."',
				 '".$trxdate."',
				 '".$id_unit."',
				 '".$id_dokter."',
				 '".$id_num."',
				 '".$id_trx_act."',
				 '".$id_slot."',
				 '".$created."',
				 '".$creator."',
				 '".$updated."',
				 '".$updater."')
				  ";
	
	$query = $this->db2->query($sql);
	#$result = $query->result_array();
	 
	#if($result === false){
	if($this->db2->trans_status() === false){
		$this->db2->trans_rollback();
		$msg='';
	}
	else
	{
		$this->db2->trans_commit();
		$msg='OK';
	}
	
	return $msg;
} 	
	

function update_status_booking ($my_id_reg,$my_id_trx)
{
	#$this->db2->autocommit(false);
	$this->db2->trans_begin();
	$sql    =  "UPDATE trx_reg_book SET status=1,id_reg ='".$my_id_reg."' WHERE id_trx ='".$my_id_trx."' ";
	
	$query = $this->db2->query($sql);
	#$result = $query->result_array();
	 
	#if($result === false){
	if($this->db2->trans_status() === false){
		$this->db2->trans_rollback();
		$msg='';
	}
	else
	{
		$this->db2->trans_commit();
		$msg='OK';
	}
	
	return $msg;
	
} 


function add_log_kiosk 	(
            $id_reg,$id_pasien,$id_dokter,$no_sep,$tgl_sep,$jenis_rawat,$kelas_rawat,$penjamin,$catatan,
			$poli_tujuan,$poli_eksekutif,$nama_ppk1,$diag_awal,$no_kartu,$nama,$tgl_lahir,
			$jkelamin,$jenis_peserta,$cob,$tgl_print,$id_trx,$id_num)
{
	#$this->db->autocommit(false);
	$this->db->trans_begin();
	
	$sql =	"INSERT INTO kiosk_apm_log
			(id_reg,id_pasien,id_dokter,no_sep,tgl_sep,jenis_rawat,kelas_rawat,penjamin,catatan,
			poli_tujuan,poli_eksekutif,nama_ppk1,diag_awal,no_kartu,nama,tgl_lahir,
			jkelamin,jenis_peserta,cob,tgl_print,id_trx,id_num)
			VALUES
			('".$id_reg."','".$id_pasien."','".$id_dokter."','".$no_sep."','".$tgl_sep."','".$jenis_rawat."','".$kelas_rawat."','".$penjamin."','".$catatan."',
			'".$poli_tujuan."','".$poli_eksekutif."','".$nama_ppk1."','".$diag_awal."','".$no_kartu."','".$nama."','".$tgl_lahir."',
			'".$jkelamin."','".$jenis_peserta."','".$cob."','".$tgl_print."','".$id_trx."','".$id_num."')";
	
	$query = $this->db->query($sql);
	#$result = $query->result_array();
	 
	#if($result === false){
	if($this->db->trans_status() === false){
		$this->db->trans_rollback();
		$msg='';
	}
	else
	{
		$this->db->trans_commit();
		$msg='OK';
	}
	return $msg;
} 

function get_nosep_from_log ($variable,$by,$today)
{
	$sql   = "SELECT a.`no_sep` FROM kiosk_apm_log a WHERE tgl_sep='".$today."'  ";
	
	if($by=='rm') $sql .="  AND a.`id_pasien` =".$variable."";
	else if ($by=='noka')  $sql .="AND a.`no_kartu` ='".$variable."' ";
	
	$sql   .= " LIMIT 0,1";	
	
	$query = $this->db->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0)
	{
		$rs = $result[0];
		$id_reg=$rs['id_reg'];
		$id_pasien=$rs['id_pasien'];
		$id_dokter=$rs['id_dokter'];
		$no_sep=$rs['no_sep'];
		$no_kartu=$rs['no_kartu'];
		$nama=$rs['nama'];
		$msg ='OK';
	}
	else
	{
		$id_reg='';
		$id_pasien='';
		$id_dokter='';
		$no_sep='';
		$no_kartu='';
		$nama='';
		$msg ='';
	}
	
	return array(
		'id_reg' 		=> $id_reg,
		'id_pasien' => $id_pasien,
		'id_dokter' => $id_dokter,
		'no_sep' 		=> $no_sep,
		'no_kartu' 	=> $no_kartu,
		'nama' 			=> $nama,
		'msg' 			=> $msg
	);
	
}

function get_data_log_by_sep($nosep)
{
	$sql = "SELECT a.* FROM kiosk_apm_log a WHERE no_sep='".$nosep."' 
					LIMIT 1
	";	
	$query = $this->db->query($sql);
	$rs = $query->row_array();
	if (isset($rs))
		return $rs;
	else
	{
		$rs = $this->get_data_bridging_by_sep($nosep);
		if (isset($rs))
			return $rs;
		else
			return array();
	}
} 

function get_data_bridging_by_sep($nosep)
{
	$sql = "SELECT a.* FROM `bridging_log` a WHERE a.nomor_sep='".$nosep."' 
					LIMIT 1
	";	
	$query = $this->db->query($sql);
	$rs = $query->row_array();
	if (isset($rs))
		return $rs;
	else
		return array();
} 
  
function convert2tgl_db ($tgl) 
{
	$time = strtotime($tgl);
	$newformat = date('Y-m-d',$time);
	 
	return $newformat;
}

function convert2tgl_id ($tgl) 
{
	$time = strtotime($tgl);
	$newformat = date('d-m-Y',$time);
	 
	return $newformat;
} 
 
function get_info_past_reg ($my_id_pasien,$my_regdate,$my_id_unit)
{
	$id_asuransi= $this->get_id_comp_bpjs ();

	$sql   = "	
	SELECT 

	a.`id_reg`
	FROM trx_reg a, `trx_reg_unit` b 
	WHERE a.id_pasien=".$my_id_pasien." 
	AND a.`id_asuransi`='".$id_asuransi."'
	AND a.`id_reg`=b.`id_reg`
	AND DATE(a.`regdate`) >= '".$my_regdate."' 
	AND b.id_unit='".$my_id_unit."' LIMIT 0,1
	";
	
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	 
	if($query->num_rows() > 0)
	{
		$rs = $result[0];
		return $rs['id_reg'];
	}
	else
	{
		return "";
	}
}

function get_info_past_reg_by_id_reg($id_reg)
{
	$sql   = "	
	SELECT 	a.*,b.*
	FROM 		trx_reg a, `trx_reg_unit` b 
	WHERE 	a.id_reg=b.id_reg
					AND a.id_reg='".$id_reg."'
	";
	
	$query = $this->db2->query($sql);
	$rs = $query->row_array();
	 
	if($query->num_rows() > 0)
	{
		return $rs;
	}
	else
	{
		return array();
	}
}
 
function cek_open_kue_apem ($bookdate,$hr_start) 
{
	date_default_timezone_set('Asia/Jakarta'); 

	$rentang_waktu_checkin_ke_periksa = 120; ## dalam menit
	$tanggal 	= $bookdate;
	$tgl     	= explode ('-',$tanggal);
	$tahun		= $tgl[0];
	$bulan 		= $tgl[1];
	$hari 		= $tgl[2];
	
	$waktu 	= $hr_start;
	$wkt 		= explode (':',$waktu);
	$jam 		= $wkt[0];
	$menit 	= $wkt[1];
	$detik 	= $wkt[2];

	// tentukan waktu tujuan
	// $waktu_tujuan = mktime($jam, $menit-$default_open_time, $detik, $bulan, $hari,$tahun);
	$waktu_tujuan = mktime($jam, $menit, $detik, $bulan, $hari,$tahun);
	
	// tentukan waktu saat ini
	$waktu_sekarang = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	
	// hitung selisih kedua waktu
	$selisih_waktu = $waktu_tujuan - $waktu_sekarang;
	
	// Untuk menghitung jumlah dalam satuan hari:
	$jumlah_hari = floor($selisih_waktu/86400);
	
	// Untuk menghitung jumlah dalam satuan jam:
	$sisa = $selisih_waktu % 86400;
	$jumlah_jam = floor($sisa/3600);

	// Untuk menghitung jumlah dalam satuan menit:
	$sisa = $sisa % 3600;
	$jumlah_menit = floor($sisa/60);
	
	// Untuk menghitung jumlah dalam satuan detik:
	$sisa = $sisa % 60;
	$jumlah_detik = floor($sisa/1);
	
	if ($jumlah_hari>0) {
		$msg = "belum boleh daftar";
	}
	else 
	{
		if ($jumlah_jam>0)
		{
			$msg = "belum boleh daftar";
		}
		else
		{
			if ($jumlah_menit>$rentang_waktu_checkin_ke_periksa)
			$msg = "belum boleh daftar";
			else
			$msg = "boleh daftar";
		}	
	}
	return $msg;
} 

function cek_expired_rujukan ($tgl) 
{
	$tanggal 	= $tgl;
	$tgl     	= explode ('-',$tanggal);
	$tahun 		= $tgl[0];
	$bulan 		= $tgl[1];
	$hari 		= $tgl[2];
	
	$waktu 	= '00:00:00';
	$wkt 		= explode (':',$waktu);
	$jam 		= $wkt[0];
	$menit 	= $wkt[1];
	$detik 	= $wkt[2];

	// tentukan waktu tujuan
	$waktu_tujuan = mktime($jam, $menit, $detik, $bulan, $hari,$tahun);
	
	// tentukan waktu saat ini
	$waktu_sekarang = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	
	// hitung selisih kedua waktu
	//$selisih_waktu = $waktu_tujuan - $waktu_sekarang;
	$selisih_waktu = $waktu_sekarang - $waktu_tujuan;
	
	// Untuk menghitung jumlah dalam satuan hari:
	$jumlah_hari = floor($selisih_waktu/86400);

	if ($jumlah_hari>90) 
	{
		$msg = "expired";
	}
	else 
	{
		$msg = "OK";		
	}	
	return $msg;
}

function print_stiker ($id_reg) 
{
	$printer_name_stiker = $this->config->item('printer_name_stiker');
	
	$sql = " 
		SELECT 
		TR.`id_reg` , 
		TR.`regdate`,
		MP.`id_pasien`, 
		MD.`name` AS dokter, 
		MU.`name` AS unit, TRB.`bookdate`,
		TRB.`hr_start` AS jam_periksa, 
		MP.`name` AS nama_pasien,
		TRB.id_num,
		MP.`birthdate`,
		TR.`penanggung`,
		TIMESTAMPDIFF( YEAR, birthdate, now() ) as year, 
							 TIMESTAMPDIFF( MONTH, birthdate, now() ) % 12 as month,
							 FLOOR( TIMESTAMPDIFF( DAY, birthdate, now() ) % 30.4375 ) as day ,
		MP.gender AS sex,TRB.id_trx AS id_book,
		IFNULL((SELECT c.`name` FROM mst_company c 
			WHERE c.id_company=IFNULL(TR.id_company,TR.id_ASURANSI) ),'TUNAI') AS perusahaan
		FROM trx_reg TR
		LEFT JOIN `trx_reg_book` TRB ON TR.`id_reg` = TRB.`id_reg`
		LEFT JOIN `mst_dokter` MD ON TRB.`id_dokter` = MD.`id_dokter`
		LEFT JOIN `mst_pasien` MP ON TRB.`id_pasien` = MP.`id_pasien`
		LEFT JOIN `mst_unit` MU ON TRB.`id_unit` = MU.`id_unit`
		WHERE TR.id_reg='".$id_reg."'
		";
					 
	$query 	= $this->db2->query($sql);
	$result = $query->result_array();
	$rs 		= $result[0];
	
	$id_reg					= $rs['id_reg'];
	$regdate				= $this->convert2tgl_id ($rs['regdate']);
	$id_pasien			= $rs['id_pasien'];
	$dokter					= $rs['dokter'];
	$unit						= $rs['unit'];
	$bookdate				= $this->convert2tgl_id ($rs['bookdate']);
	$jam_periksa		= $rs['jam_periksa'];
	$nama_pasien		= $rs['nama_pasien'];
	$id_num					= $rs['id_num'];
	$birthdate			= $this->convert2tgl_id ($rs['birthdate']);
	$umurp					= $rs['year'].' Thn'.' '.$rs['month'].' Bln';
	$sex						= $rs['sex'];
	$perusahaan			= $rs['perusahaan'];
	$penanggung			= $rs['penanggung'];
	$jenis_kelamin 	= ($sex==1)?'P':'L';
	
	$data = '
DIRECTION 1
SHIFT 0
OFFSET 0
CLS
TEXT 50,40, "3",0,1,1, "'.$id_pasien.' - '.$id_reg.'"
TEXT 50,70, "3",0,1,1, "'.$nama_pasien.'"
TEXT 50,100, "2",0,1,1, "'.$birthdate.' '.$umurp.' ('.$jenis_kelamin.')"
TEXT 50,120, "2",0,1,1, "'.$dokter.'"
TEXT 50,150, "2",0,1,1, "'.$unit.'"
BARCODE 80,180, "128",50,0,0,2,2,"'.$id_pasien.'"
PRINT 3,1
';
	
	$handle = printer_open($printer_name_stiker);  
	printer_set_option($handle, PRINTER_MODE, 'RAW');
	printer_write($handle, $data);
	printer_close($handle);

}

function print_struk_paperless($id_reg)
{	
	$sql = " 
		SELECT 
		TR.`id_reg` , 
		TR.`regdate`,
		TR.`id_pasien`, 
		MD.`name` AS dokter, 
		MU.`name` AS unit, TRB.`bookdate`,
		TRB.`hr_start` AS jam_periksa, 
		MP.`name` AS nama_pasien,
		TRB.id_num,
		MP.`birthdate`,
		TR.`penanggung`,
		TIMESTAMPDIFF( YEAR, birthdate, now() ) as year, 
							 TIMESTAMPDIFF( MONTH, birthdate, now() ) % 12 as month,
							 FLOOR( TIMESTAMPDIFF( DAY, birthdate, now() ) % 30.4375 ) as day ,
		MP.gender AS sex,TRB.id_trx AS id_book,
		IFNULL((SELECT c.`name` FROM mst_company c 
			WHERE c.id_company=IFNULL(TR.id_company,TR.id_ASURANSI) ),'TUNAI') AS perusahaan
		FROM trx_reg TR
		LEFT JOIN `trx_reg_book` TRB ON TR.`id_reg` = TRB.`id_reg`
		LEFT JOIN `mst_dokter` MD ON TRB.`id_dokter` = MD.`id_dokter`
		LEFT JOIN `mst_pasien` MP ON TR.`id_pasien` = MP.`id_pasien`
		LEFT JOIN `mst_unit` MU ON TRB.`id_unit` = MU.`id_unit`
		WHERE TR.id_reg='".$id_reg."'
		";
					 
	$query 	= $this->db2->query($sql);
	$result = $query->result_array();
	$rs 		= $result[0];

	$sql = "SELECT a.name AS nama_rs, a.address
            FROM mst_main a 
            ";
    $query  = $this->dbhis->query($sql); 
    $result = $query->result();
    $data_rs = $result[0];
	
	$id_book				= $rs['id_book'];
	$id_reg					= $rs['id_reg'];
	$regdate				= $this->convert2tgl_id ($rs['regdate']);
	$id_pasien			= $rs['id_pasien'];
	$dokter					= $rs['dokter'];
	$unit						= $rs['unit'];
	$bookdate				= $this->convert2tgl_id ($rs['bookdate']);
	$jam_periksa		= $rs['jam_periksa'];
	$nama_pasien		= $rs['nama_pasien'];
	$id_num					= $rs['id_num'];
	$birthdate			= $this->convert2tgl_id ($rs['birthdate']);
	$umurp					= $rs['year'].' Thn'.' '.$rs['month'].' Bln';
	$sex						= $rs['sex'];
	$perusahaan			= $rs['perusahaan'];
	$penanggung			= $rs['penanggung'];
	$jenis_kelamin 	= ($sex==1)?'P':'L';
	#print_r($data_rs);
	$nama_rs			= $data_rs->nama_rs;
	$alamat_rs			= $data_rs->address;
	$tanggal 	= date("d-m-Y");
	$vtgl		= date("Y-m-d");
	$jam 		= date("H:i:s");
	$now		= '@kiossak '.$tanggal.', '.$jam;




	$myPrinter=printer_open("POS-80");
	printer_set_option($myPrinter, PRINTER_MODE, "RAW");
	printer_start_doc($myPrinter);
	printer_start_page($myPrinter);
	$hrf=printer_create_font("Arial", 26, 10, 70, 0, 0, 0, 0); 
	printer_select_font($myPrinter, $hrf);
	
	printer_draw_text($myPrinter, $nama_rs,8,1);
	printer_draw_text($myPrinter, $alamat_rs,8,27);
	printer_draw_text($myPrinter, '------------------------------------------------------------------',20,50);
	printer_draw_text($myPrinter, 'Kode Booking : '.$id_book,50,80);
	printer_draw_text($myPrinter, 'No RM 		: '.$id_pasien,50,110);
	printer_draw_text($myPrinter, 'Nama  		: '.$nama_pasien,50,140);
	printer_draw_text($myPrinter, 'Penjamin		: '.$perusahaan,50,170);
	printer_draw_text($myPrinter, 'Poliklinik 	: '.$unit,50,210);
	printer_draw_text($myPrinter, 'Dokter 		: '.$dokter,50,240);	
	printer_draw_text($myPrinter, 'No Antrian Dokter : '.$id_num,50,270);
	
	printer_draw_text($myPrinter, 'Anda telah berhasil checkin.',20,300);
	printer_draw_text($myPrinter, 'Silahkan langsung menuju ke poli tujuan.',20,330);	
	$hrf=printer_create_font("Arial", 25, 9, 100, 0, 0, 0, 0); 
	printer_select_font($myPrinter, $hrf);
	printer_draw_text($myPrinter, 'Printed '.$now,90,360);
	printer_end_page($myPrinter);
	printer_end_doc($myPrinter); 
	printer_close($myPrinter);
}

function print_stiker_ipprinter($id_reg)
{
	$printer_name_stiker = $this->config->item('printer_name_stiker');
	
	$sql = " 
		SELECT 
		TR.`id_reg` , 
		TR.`regdate`,
		MP.`id_pasien`, 
		MD.`name` AS dokter, 
		MU.`name` AS unit, TRB.`bookdate`,
		TRB.`hr_start` AS jam_periksa, 
		MP.`name` AS nama_pasien,
		TRB.id_num,
		MP.`birthdate`,
		TR.`penanggung`,
		TIMESTAMPDIFF( YEAR, birthdate, now() ) as year, 
							 TIMESTAMPDIFF( MONTH, birthdate, now() ) % 12 as month,
							 FLOOR( TIMESTAMPDIFF( DAY, birthdate, now() ) % 30.4375 ) as day ,
		MP.gender AS sex,TRB.id_trx AS id_book,
		IFNULL((SELECT c.`name` FROM mst_company c 
			WHERE c.id_company=IFNULL(TR.id_company,TR.id_ASURANSI) ),'TUNAI') AS perusahaan
		FROM trx_reg TR
		LEFT JOIN `trx_reg_book` TRB ON TR.`id_reg` = TRB.`id_reg`
		LEFT JOIN `mst_dokter` MD ON TRB.`id_dokter` = MD.`id_dokter`
		LEFT JOIN `mst_pasien` MP ON TRB.`id_pasien` = MP.`id_pasien`
		LEFT JOIN `mst_unit` MU ON TRB.`id_unit` = MU.`id_unit`
		WHERE TR.id_reg='".$id_reg."'
		";
					 
	$query 	= $this->db2->query($sql);
	$result = $query->result_array();
	$rs 		= $result[0];
	
	$id_reg					= $rs['id_reg'];
	$regdate				= $this->convert2tgl_id ($rs['regdate']);
	$id_pasien			= $rs['id_pasien'];
	$dokter					= $rs['dokter'];
	$unit						= $rs['unit'];
	$bookdate				= $this->convert2tgl_id ($rs['bookdate']);
	$jam_periksa		= $rs['jam_periksa'];
	$nama_pasien		= $rs['nama_pasien'];
	$id_num					= $rs['id_num'];
	$birthdate			= $this->convert2tgl_id ($rs['birthdate']);
	$umurp					= $rs['year'].' Thn'.' '.$rs['month'].' Bln';
	$sex						= $rs['sex'];
	$perusahaan			= $rs['perusahaan'];
	$penanggung			= $rs['penanggung'];
	$jenis_kelamin 	= ($sex==1)?'P':'L';
	
	$data = '
DIRECTION 1
SHIFT 0
OFFSET 0
CLS
TEXT 50,40, "3",0,1,1, "'.$id_pasien.'     '.$id_reg.'"
TEXT 50,70, "3",0,1,1, "'.$nama_pasien.'"
TEXT 50,100, "2",0,1,1, "'.$birthdate.' '.$umurp.' ('.$jenis_kelamin.')"
TEXT 50,120, "2",0,1,1, "'.$dokter.'"
TEXT 50,150, "2",0,1,1, "'.$unit.'"
BARCODE 80,180, "128",50,0,0,2,2,"'.$id_reg.'"
PRINT 5,1
';

	$handle = printer_open($printer_name_stiker);  
	printer_set_option($handle, PRINTER_MODE, 'RAW');
	printer_write($handle, $data);
	printer_close($handle);

}

function print_tracer ($id_reg) 
{
	$printer_name_tracer = $this->config->item('printer_name_tracer');
	
	$sql		= " 
							SELECT 
							TR.`id_reg` , 
							TR.`regdate`,
							MP.`id_pasien`, 
							MD.`name` AS dokter, 
							MU.`name` AS unit, TRB.`bookdate`,
							TRB.`hr_start` AS jam_periksa, 
							MP.`name` AS nama_pasien,
							TRB.id_num,
							MP.`birthdate`,
							TR.`penanggung`,
							TIMESTAMPDIFF( YEAR, birthdate, now() ) as year, 
												 TIMESTAMPDIFF( MONTH, birthdate, now() ) % 12 as month,
												 FLOOR( TIMESTAMPDIFF( DAY, birthdate, now() ) % 30.4375 ) as day,
							MP.gender AS sex,TRB.id_trx AS id_book,
							IFNULL((SELECT c.`name` FROM mst_company c 
								WHERE c.id_company=IFNULL(TR.id_company,TR.id_ASURANSI) ),'TUNAI') AS perusahaan
							FROM trx_reg TR
							LEFT JOIN `trx_reg_book` TRB ON TR.`id_reg` = TRB.`id_reg`
							LEFT JOIN `mst_dokter` MD ON TRB.`id_dokter` = MD.`id_dokter`
							LEFT JOIN `mst_pasien` MP ON TRB.`id_pasien` = MP.`id_pasien`
							LEFT JOIN `mst_unit` MU ON TRB.`id_unit` = MU.`id_unit`
							WHERE TR.id_reg='".$id_reg."'
						";
	
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	$rs 		= $result[0];
	
	$id_reg					= $rs['id_reg'];
	$regdate				= $this->convert2tgl_id ($rs['regdate']);
	$id_pasien			= $rs['id_pasien'];
	$dokter					= $rs['dokter'];
	$unit						= $rs['unit'];
	$bookdate				= $this->convert2tgl_id ($rs['bookdate']);
	$jam_periksa		= $rs['jam_periksa'];
	$nama_pasien		= $rs['nama_pasien'];
	$id_num					= $rs['id_num'];
	$birthdate			= $this->convert2tgl_id ($rs['birthdate']);
	$umurp					= $rs['year'].' Thn'.' '.$rs['month'].' Bln';
	$sex						= $rs['sex'];
	$perusahaan			= $rs['perusahaan'];
	$penanggung			= $rs['penanggung'];
	$jenis_kelamin 	= ($sex==1)?'P':'L';
	
	$text_tracer =
	sprintf(
	"
	No. Registrasi : %s 
	Tgl. Reg : %s  
	No. RM : %s
	Nama : %s
	Umur : %s
	Perusahaan : %s
	Penanggung : %s
	Unit/Poli : %s
	Dokter : %s
	Tgl Perjanjian : %s
	Nomor perjanjian : %s
	Printed By APEM
	",$id_reg,$regdate,$id_pasien,$nama_pasien,$umurp." (".$jenis_kelamin.")",$perusahaan,$penanggung,$unit,$dokter,$bookdate." (".$jam_periksa.")",$id_num);

	/* open the connection */    
	$handle = printer_open($printer_name_tracer);  
	/* write the text to the print job */  
	printer_write($handle, $text_tracer);   
	/* close the connection */ 
	printer_close($handle);
}

function add_addtional_id_act ($my_id_reg,$my_id_unit,$my_id_dokter,$my_id_asuransi,$my_id_act)
{
	$today_timestamp = $this->today_timestamp; 
	
	$id_reg		= $my_id_reg;
	$id_unit 	= $my_id_unit;
	$id_dokter 	= $my_id_dokter;
	$id_asuransi= $my_id_asuransi;
	$id_act		= $my_id_act;

	$trxdate    = $today_timestamp;
	$created 	= $today_timestamp;
	$creator	= 'EDP';
	$updated	= $today_timestamp;
	$updater	= 'EDP';	 
	
	
	$sql = " SELECT a.`id_act`,b.`name`,a.`price`,b.`id_group` 
						FROM `mst_tindakan_prc` a,`mst_tindakan` b
						WHERE 
						a.`id_act`=b.`id_act`
						AND a.`id_act`='".$id_act."' 
						AND a.`id_comp`='".$id_asuransi."' 
						AND a.`id_kelas`=-1 ";
	
	$query = $this->db2->query($sql);
	$result = $query->result_array();
	$rs = $result[0];
	
	if(intval($rs['price'])==0)
	{
		$sql = "SELECT a.price FROM mst_tindakan a WHERE a.`id_act`='".$id_act."'";
		
		$result_alt = $this->db2->query($sql);
		$rs_alt = $result[0];
		$rs['price'] = $rs_alt['price'];
	}

	$id_group_act 		= $rs ['id_group'];
	$name				= $rs ['name'];
	$price  			= $rs ['price'];
    $total 				= $rs ['price'];
	$id_type     		= 1;
	$qty		 		= 1;
	
	
	#$this->db2->autocommit(false);
	$this->db2->trans_begin();
	$sql =  "    INSERT  INTO trx_reg_act 
				 (id_reg,trxdate,id_reg_act,id_type,id_dokter,id_group_act,id_unit,name,qty,price,total,created,creator,updated,updater)
				  VALUES
				 (
				 '".$id_reg."',
				 '".$trxdate."',
				 '".$id_act."',
				 '".$id_type."',
				 '".$id_dokter."',
				 '".$id_group_act."',
				 '".$id_unit."',
				 '".$name."',
				 '".$qty."',
				 '".$price."',
				 '".$total."',
				 '".$created."',
				 '".$creator."',
				 '".$updated."',
				 '".$updater."')
				  ";	
				  
	$query = $this->db2->query($sql);
	#$result = $query->result_array();		
	
	#if($result === false){
	if($this->db2->trans_status() === false){
		$this->db2->trans_rollback();
		$msg='';
	}
	else
	{
		$this->db2->trans_commit();	
		$msg='OK';
	}
	return $msg;
} 

function test_print_stiker () 
{
	$printer_name_stiker = $this->config->item('printer_name_stiker');
						 	
	$id_reg					= '0118SA012345';
	$regdate				= '2018-01-01';
	$id_pasien			= '00123456';
	$dokter					= 'dr. Muhamad Rais';
	$unit						= 'INT';
	$bookdate				= '2018-10-26';
	$jam_periksa		= '09:30:15';
	$nama_pasien		= 'EDP TEST APEM';
	$id_num					= '12';
	$birthdate			= '12 January 2018';
	$umurp					= '18 Thn'.'13 Bln';
	$sex						= 'L';
	$perusahaan			= 'PT. Tokopedia';
	$penanggung			= 'Tanggung Sendiri';
	$jenis_kelamin 	= 'Laki-laki';
	
	$data = '
DIRECTION 1
SHIFT 0
OFFSET 0
CLS
TEXT 50,40, "3",0,1,1, "'.$id_pasien.'     '.$id_reg.'"
TEXT 50,70, "3",0,1,1, "'.$nama_pasien.'"
TEXT 50,100, "2",0,1,1, "'.$birthdate.' '.$umurp.' ('.$jenis_kelamin.')"
TEXT 50,120, "2",0,1,1, "'.$dokter.'"
TEXT 50,150, "2",0,1,1, "'.$unit.'"
BARCODE 80,180, "128",50,0,0,2,2,"'.$id_reg.'"
PRINT 5,1
';

	$handle = printer_open($printer_name_stiker);  
	printer_set_option($handle, PRINTER_MODE, 'RAW');
	printer_write($handle, $data);
	printer_close($handle);

}

}
?>