<?php
defined('BASEPATH') or exit('No direct script access allowed');
class DataHis {
	var $db;
	var $dbsupp;
	var $db2;
	var $dbhis;
	public function __construct()
  {
		$CI =& get_instance();
		$CI->dh = $this;
		$CI->DataHis = $this;
		
		$this->db = $CI->dbsupp;
		$this->dbsupp = $CI->dbsupp;
		
		$this->db2 = $CI->dbhis;
		$this->dbhis = $CI->dbhis;
	}
// fungsi-fungsi dengan database simrum


public function get_icu_db ($myreg)
{

$sql ="
SELECT 
IF(trk.`duration`=0,  datediff(current_date(), DATE(trk.`indate`)), trk.`duration`)  AS qty
FROM trx_reg_kmr trk, mst_kamar mk   
WHERE trk.id_reg='".$myreg."' 
AND trk.cancel=0 
AND mk.`id_type`=4
AND trk.`id_reg_kmr`=mk.`id_kamar`
ORDER BY trk.trxdate DESC
		";
//echo $sql."<br>";
$result = $this->dbhis->query($sql);
 if($result ->num_rows() > 0){
	$rs = $result->result_array();
	$rs = $rs[0];
	$icu_indikator="1";
	$icu_los=$rs['qty'];
  }
 else{
	$icu_indikator="";
	$icu_los="";
  }

 return array(
            'icu_indikator' => $icu_indikator,
            'icu_los' => $icu_los
        );
} 


public function get_ventilator_hour_db ($myreg)
{
	global $db2;
	$sql ="
		SELECT SUM(tra.`qty`)AS jumlah FROM `trx_reg_act` tra 
		WHERE tra.`id_reg`='".$myreg."' 
		AND UPPER(tra.name) LIKE '%VENTILATOR%'	";
	//echo $sql."<br>";
	$result = $this->dbhis->query($sql);
	 if($result->num_rows() > 0){
		$rs = $result->result_array();
		$rs = $rs[0];
		return $rs['jumlah']*24;
	  }
	 else{
		return "";
	  }
	
} 

public function get_nik_db ($mypid)
{
	global $db;
	$sql ="
		SELECT e.nomor_dokter AS nik
        FROM  emp e  WHERE e.pid=".$mypid;
	//echo $sql."<br>";
	$result = $this->dbsupp->query($sql);
	 if($result->num_rows() > 0){
		$rs = $result->result_array();
		$rs = $rs[0];
		return $rs['nik'];
	  }
	 else{
		return "123123123123";
	  }
	
} 

public function get_not_in ($dates_start,$dates_end,$tipe_reg) {
 	#global $db;
  $all_id_reg="";
  $sql_reg = "
  SELECT id_reg 
  FROM bridging_log 
  WHERE (DATE(tgl_masuk) BETWEEN '{$dates_start}' AND '{$dates_end}')
  AND tipe_reg ='{$tipe_reg}'
  ";
	#echo "<pre>".$sql_reg."</pre>";
  $result_reg = $this->dbsupp->query($sql_reg);
  if($result_reg->num_rows() > 0)
	{
		foreach($result_reg->result_array() as $rs_reg)
		{
			$all_id_reg .=" "."'".$rs_reg["id_reg"]."'";
		}
		$all_id_reg = str_replace(" ",",",trim($all_id_reg));
		$reg_cond = "  AND TR.id_reg NOT IN (".$all_id_reg.") ";
  }
  else
  {
  $reg_cond = " ";
  }
  return $reg_cond;
}

public function get_not_in_2 ($dates_start,$dates_end,$tipe_reg) {
 	#global $db;
  $all_id_reg="";
  $sql_reg = "
  SELECT id_reg 
  FROM bridging_log 
  WHERE (DATE(tgl_masuk) BETWEEN '{$dates_start}' AND '{$dates_end}')
  AND tipe_reg ='{$tipe_reg}'
  ";
  $result_reg = $this->dbsupp->query($sql_reg);
  if($result_reg->num_rows() > 0){
  #while($rs_reg = $result_reg->fetch_array(MYSQLI_ASSOC))
	foreach($result_reg->result_array() as $rs_reg)
	{
   $all_id_reg .=" "."'".$rs_reg["id_reg"]."'";
  }
   $all_id_reg = str_replace(" ",",",trim($all_id_reg));
  
  $reg_cond = "  AND bl.id_reg NOT IN (".$all_id_reg.") ";
  }
  else
  {
  $reg_cond = " ";
  }
  return $reg_cond;
}

public function get_id_var ($variable)
{
	global $db;
	$sql   = "SELECT idvar FROM setting_tarif_rs_bpjs WHERE variable='".$variable."'";
	//echo $sql."<br>";
	$result = $this->dbsupp->query($sql);
	 if($result->num_rows() > 0){
		$rs = $result->result_array();
		$rs = $rs[0];
		return $rs['idvar'];
	  }
	 else{
		return "";
	  }
	
} 






function get_breakdown_tarif_rs($myreg)
{		
		
$id_var_prosedur_non_bedah = get_id_var('prosedur_non_bedah');
$id_var_prosedur_bedah = get_id_var('prosedur_bedah');
$id_var_konsultasi = get_id_var('konsultasi');
$id_var_tenaga_ahli = get_id_var('tenaga_ahli');
$id_var_keperawatan = get_id_var('keperawatan');
$id_var_penunjang = get_id_var('penunjang');
$id_var_radiologi = get_id_var('radiologi');
$id_var_pelayanan_darah = get_id_var('pelayanan_darah');
$id_var_rehabilitasi = get_id_var('rehabilitasi');
$id_var_komponen_kamar = get_id_var('komponen_kamar');
$id_var_bmhp = get_id_var('bmhp');
$id_var_sewa_alat = get_id_var('sewa_alat');
$id_var_alkes = get_id_var('alkes');

/*echo $id_var_prosedur_non_bedah."<br>";
echo $id_var_prosedur_bedah."<br>";
echo $id_var_konsultasi."<br>";
echo $id_var_tenaga_ahli."<br>";
echo $id_var_keperawatan."<br>";
echo $id_var_penunjang."<br>";
echo $id_var_radiologi."<br>";
echo $id_var_pelayanan_darah."<br>";
echo $id_var_rehabilitasi."<br>";
echo $id_var_registrasi."<br>";
echo $id_var_bmhp."<br>";
echo $id_var_sewa_alat."<br>";*/



$param_idact_prosedur_non_bedah = get_param_idact($id_var_prosedur_non_bedah);
$param_idact_prosedur_bedah = get_param_idact($id_var_prosedur_bedah);
$param_idact_konsultasi = get_param_idact($id_var_konsultasi);
$param_idact_tenaga_ahli = get_param_idact($id_var_tenaga_ahli);
$param_idact_keperawatan = get_param_idact($id_var_keperawatan);
$param_idact_penunjang = get_param_idact($id_var_penunjang);
$param_idact_radiologi = get_param_idact($id_var_radiologi);
$param_idact_pelayanan_darah = get_param_idact($id_var_pelayanan_darah);
$param_idact_rehabilitasi = get_param_idact($id_var_rehabilitasi);
$param_idact_komponen_kamar = get_param_idact($id_var_komponen_kamar);
$param_idact_bmhp = get_param_idact($id_var_bmhp);
$param_idact_sewa_alat = get_param_idact($id_var_sewa_alat);
$param_idact_alkes = get_param_idact($id_var_alkes);
/*var_dump ( $param_idact_prosedur_non_bedah )."<br>";
var_dump ( $param_idact_prosedur_bedah )."<br>";
var_dump ( $param_idact_konsultasi )."<br>";
var_dump ( $param_idact_tenaga_ahli )."<br>";
var_dump ( $param_idact_keperawatan )."<br>";
var_dump ( $param_idact_penunjang )."<br>";
var_dump ( $param_idact_radiologi )."<br>";
var_dump ( $param_idact_pelayanan_darah )."<br>";
var_dump ( $param_idact_rehabilitasi )."<br>";
var_dump ( $param_idact_registrasi )."<br>";
var_dump ( $param_idact_bmhp )."<br>";
var_dump ( $param_idact_sewa_alat )."<br>";*/



$param_idsubgroup_prosedur_non_bedah = get_param_idsubgroup($id_var_prosedur_non_bedah);
$param_idsubgroup_prosedur_bedah = get_param_idsubgroup($id_var_prosedur_bedah);
$param_idsubgroup_konsultasi = get_param_idsubgroup($id_var_konsultasi);
$param_idsubgroup_tenaga_ahli = get_param_idsubgroup($id_var_tenaga_ahli);
$param_idsubgroup_keperawatan = get_param_idsubgroup($id_var_keperawatan);
$param_idsubgroup_penunjang = get_param_idsubgroup($id_var_penunjang);
$param_idsubgroup_radiologi = get_param_idsubgroup($id_var_radiologi);
$param_idsubgroup_pelayanan_darah = get_param_idsubgroup($id_var_pelayanan_darah);
$param_idsubgroup_rehabilitasi = get_param_idsubgroup($id_var_rehabilitasi);
$param_idsubgroup_komponen_kamar = get_param_idsubgroup($id_var_komponen_kamar);
$param_idsubgroup_bmhp = get_param_idsubgroup($id_var_bmhp);
$param_idsubgroup_sewa_alat = get_param_idsubgroup($id_var_sewa_alat);
$param_idsubgroup_alkes = get_param_idsubgroup($id_var_alkes);

/*var_dump ($param_idsubgroup_prosedur_non_bedah)."<br>";
var_dump ($param_idsubgroup_prosedur_bedah)."<br>";
var_dump ($param_idsubgroup_konsultasi)."<br>";
var_dump ($param_idsubgroup_tenaga_ahli)."<br>";
var_dump ($param_idsubgroup_keperawatan)."<br>";
var_dump ($param_idsubgroup_penunjang)."<br>";
var_dump ($param_idsubgroup_radiologi)."<br>";
var_dump ($param_idsubgroup_pelayanan_darah)."<br>";
var_dump ($param_idsubgroup_rehabilitasi)."<br>";
var_dump ($param_idsubgroup_registrasi)."<br>";
var_dump ($param_idsubgroup_bmhp)."<br>";
var_dump ($param_idsubgroup_sewa_alat)."<br>";	*/
	
	
	$prosedur_non_bedah = get_result('f',$param_idact_prosedur_non_bedah,$myreg)+get_result('t',$param_idsubgroup_prosedur_non_bedah,$myreg);
	$prosedur_bedah=get_result('f',$param_idact_prosedur_bedah,$myreg)+get_result('t',$param_idsubgroup_prosedur_bedah,$myreg);
	$konsultasi=get_result('f',$param_idact_konsultasi,$myreg)+get_result('t',$param_idsubgroup_konsultasi,$myreg);
	$tenaga_ahli=get_result('f',$param_idact_tenaga_ahli,$myreg)+get_result('t',$param_idsubgroup_tenaga_ahli,$myreg);
	$keperawatan=get_result('f',$param_idact_keperawatan,$myreg)+get_result('t',$param_idsubgroup_keperawatan,$myreg);
	$penunjang=get_result('f',$param_idact_penunjang,$myreg)+get_result('t',$param_idsubgroup_penunjang,$myreg);
	$radiologi=get_result('f',$param_idact_radiologi,$myreg)+get_result('t',$param_idsubgroup_radiologi,$myreg);
	$laboratorium=get_result_lab($myreg);
	$pelayanan_darah=get_result('f',$param_idact_pelayanan_darah,$myreg)+get_result('t',$param_idsubgroup_pelayanan_darah,$myreg);
	$rehabilitasi=get_result('f',$param_idact_rehabilitasi,$myreg)+get_result('t',$param_idsubgroup_rehabilitasi,$myreg);
	
	$kamar= get_result('f',$param_idact_komponen_kamar,$myreg)+get_result('t',$param_idsubgroup_komponen_kamar,$myreg); //+ get_kamar + get_adm_kamar
	
	$rawat_intensif=0;
	
	$obat=$this->get_result_farmasi_obat($myreg);
	#$alkes=$this->get_result_farmasi_alkes($myreg);
	$alkes=get_result('f',$param_idact_alkes,$myreg)+get_result('t',$param_idsubgroup_alkes,$myreg);
	
	$bmhp=get_result('f',$param_idact_bmhp,$myreg)+get_result('t',$param_idsubgroup_bmhp,$myreg);
	$sewa_alat=get_result('f',$param_idact_sewa_alat,$myreg)+get_result('t',$param_idsubgroup_sewa_alat,$myreg);
	$lain_lain=$this->get_result_lain_lain($myreg);	
	#echo ' tarif break : '.$prosedur_non_bedah;
     return array(
	'prosedur_non_bedah' =>$prosedur_non_bedah,
	'prosedur_bedah' =>$prosedur_bedah,
	'konsultasi' =>$konsultasi,
	'tenaga_ahli' =>$tenaga_ahli,
	'keperawatan' =>$keperawatan,
	'penunjang' =>$penunjang,
	'radiologi' =>$radiologi,
	'laboratorium' =>$laboratorium,
	'pelayanan_darah' =>$pelayanan_darah,
	'rehabilitasi' =>$rehabilitasi,
	'kamar' =>$kamar,
	'rawat_intensif' =>$rawat_intensif,
	'obat' =>$obat,
	'alkes' =>$alkes,
	'bmhp' =>$bmhp,
	'sewa_alat' =>$sewa_alat,
	'lain_lain' =>$lain_lain,
        );
}



function get_param_idact($idvar)
{
	$sql   = "SELECT id_act FROM setting_tarif_rs_bpjs WHERE idvar='".$idvar."'";
	//echo $sql."<br>";
	$result = $this->dbsupp->query($sql);
    if($result->num_rows() > 0){
		$rs = $result->result_array();
		$rs = $rs[0];
		$idact = $rs['id_act'];
	  }
	 else{
		 return "";
	  }
	
	
	$id = explode(",", $idact);
	$param = array();
	for ($i = 0; $i < count($id); $i++)
	{
	   $param[$i] = $id[$i];
	}
	return $param;
}

function get_param_idsubgroup($idvar)
{
	global $db;
	$sql        = "SELECT id_subgroup FROM setting_tarif_rs_bpjs WHERE idvar='".$idvar."'";
	  $result = $this->dbsupp->query($sql);    
	 if($result->num_rows() > 0){
		$rs = $result->result_array();
		$rs = $rs[0];
		$idsubgroup = $rs['id_subgroup'];
	  }
	 else{
		 return "";
	  }	
	
	$id = explode(",", $idsubgroup);
	$param = array();
	for ($i = 0; $i < count($id); $i++)
	{
	   $param[$i] = $id[$i];
	}
	return $param;
}


function get_result($is_subgroup,$inp_param_arr,$myreg)
{
	global $db2;
	$text="";
		 	//  $base->db2->debug=true;
			if(empty($inp_param_arr)) return 0;

			if ($is_subgroup=='t'){
				foreach($inp_param_arr as $k => $v)
				{
					$text .= " "."'".$v."'";
				}
				$text = str_replace(" ",",",trim($text));
				$inquery1 = "  AND c.id_subgroup IN (".$text.")";
				}
				else{
				foreach($inp_param_arr as $k => $v)
				{
					$text .= " "."'".$v."'";
				}
				$text = str_replace(" ",",",trim($text));
				$inquery1 = "  AND a.id_reg_act IN (".$text.")";
			}
			
			
			$sql1="
				SELECT 
				COALESCE (SUM(ax.total),0) AS total
				FROM
				(
				SELECT 
				a.`id_reg`,c.`name`,a.`total`,a.`id_type`
				,c.`id_subgroup`,a.`id_reg_act`
				FROM `trx_reg_act`  a, `mst_tindakan` c
				WHERE 
				a.`id_reg_act`=c.`id_act`
				".$inquery1."
				AND c.id_subgroup>0
				AND a.`cancel` = 0 
				AND a.is_paket <> 1
				AND a.`id_reg`='".$myreg."'            
				) ax
				";
			#echo "<pre>".$sql1."</pre>";
			$query1 = $this->dbhis->query($sql1);
			$rs1 = $query1->result_array();
			$rs1 = $rs1[0];
			$result1 = round($rs1['total'],0);
			
			$sql2="
				SELECT 
				COALESCE (SUM(ax.total),0) AS total
				FROM
				(
				SELECT 
				a.`id_reg`,c.`name`,a.`total`,a.`id_type`
				,c.`id_subgroup`,a.`id_reg_act`
				FROM `trx_reg_act_rev`  a, `mst_tindakan` c
				WHERE 
				a.`id_reg_act`=c.`id_act`
				".$inquery1."
				AND c.id_subgroup>0
				AND a.is_paket <> 1
				AND a.`id_reg`='".$myreg."'  
				) ax
				";
			#echo "<pre>".$sql2."</pre>";
			$query2 = $this->dbhis->query($sql2);
			$rs2 = $query2->result_array();
			$rs2 = $rs2[0];
			$result2 = round($rs2['total'],0);
			
			$result = $result1 + $result2;
			#echo "<br> hasil : ".$result1." + ".$result2."<br>";
			return $result;
}


function get_result_lain_lain($myreg)
{
 	       
	global $db2;
			$idact = $this->get_param_all_idact();
			$idsubgroup = $this->get_param_all_idsubgroup();
		
			$text1 = texttoarraytomerge($idact);
			$text2 = texttoarraytomerge($idsubgroup);
			if($text2=='' || $text2=="''")
				$query_subgrup = '';
			else
				$query_subgrup = "AND c.id_subgroup NOT IN (".$text2.") ";
##
		$sql1="

				SELECT 
				a.`id_reg`,c.`name`,COALESCE (SUM(a.total),0) AS total,a.`id_type`
				,c.`id_subgroup`,a.`id_reg_act`
				FROM `trx_reg_act`  a,`mst_tindakan` c
				WHERE 
				a.`id_reg_act`=c.`id_act`
				AND a.`cancel` = 0  
				
				AND a.is_paket <> 1  AND true
				AND a.id_reg_act NOT IN (".$text1.")   
				-- AND c.id_subgroup NOT IN (".$text2.") 
				".$query_subgrup."
				AND a.`id_reg`='".$myreg."'      
	
				";
			#echo "<pre>".$sql1."</pre>";
		    $query1 = $this->dbhis->query($sql1);
			$rs1 = $query1->result_array();
			$rs1 = $rs1[0];
			$result1 = round($rs1['total'],0);
			
			$sql2="
				
				SELECT 
				a.`id_reg`,c.`name`,COALESCE (SUM(a.total),0) AS total,a.`id_type`
				,c.`id_subgroup`,a.`id_reg_act`
				FROM `trx_reg_act_rev`  a, `mst_tindakan` c
				WHERE 
				a.`id_reg_act`=c.`id_act`
				
				AND a.is_paket <> 1
				AND a.id_reg_act NOT IN (".$text1.")
				-- AND c.id_subgroup NOT IN (".$text2.") 
				".$query_subgrup."
				AND a.`id_reg`='".$myreg."'          
				
	          ";
		#echo "<pre>".$sql2."</pre>";
			$query2 = $this->dbhis->query($sql2);
			$rs2 = $query2->result_array();
			$rs2 = $rs2[0];
			$result2 = round($rs2['total'],0);
			
			$result = $result1 + $result2;
			return $result;
}

function get_result_lain_lain_detail($myreg)
{       
	$idact = $this->get_param_all_idact();
	$idsubgroup = $this->get_param_all_idsubgroup();

	$text1 = texttoarraytomerge($idact);
	$text2 = texttoarraytomerge($idsubgroup);
	if($text2=='' || $text2=="''")
		$query_subgrup = '';
	else
		$query_subgrup = "AND c.id_subgroup NOT IN (".$text2.") ";
	
	$sql1="

			SELECT 
			a.`id_reg`,c.`name`,COALESCE(a.total,0) AS total,a.`id_type`
			,c.`id_subgroup`,a.`id_reg_act`
			,a.`id_reg_act` as id_trx_det
			FROM `trx_reg_act`  a,`mst_tindakan` c
			WHERE 
			a.`id_reg_act`=c.`id_act`
			AND a.`cancel` = 0  
			
			AND a.is_paket <> 1  
			AND a.id_reg_act NOT IN (".$text1.")   
			-- AND c.id_subgroup NOT IN (".$text2.") 
			".$query_subgrup."
			AND a.`id_reg`='".$myreg."'      

			";
			#echo "<pre>".$sql1."</pre>";
	$query1 = $this->dbhis->query($sql1);
	$rows = array();
	foreach($query1->result_array() as $row)
	{
		$rows[] = $row;
	}
		
	$sql2="
		
		SELECT 
		a.`id_reg`,c.`name`,COALESCE (a.total,0) AS total,a.`id_type`
		,c.`id_subgroup`,a.`id_reg_act`
		,a.`id_reg_act` as id_trx_det
		FROM `trx_reg_act_rev` a, `mst_tindakan` c
		WHERE 
		a.`id_reg_act`=c.`id_act`
		
		AND a.is_paket <> 1
		AND a.id_reg_act NOT IN (".$text1.")
		-- AND c.id_subgroup NOT IN (".$text2.") 
		".$query_subgrup."
		AND a.`id_reg`='".$myreg."'          
		
				";
	#echo "<pre>".$sql2."</pre>";
	$query2 = $this->dbhis->query($sql2);
	foreach($query2->result_array() as $row)
	{
		$rows[] = $row;
	}
		
	$result = $rows;
	return $result;
}

public function get_result_lain_lain_detail_text($myreg)
	{
		$data = $this->get_result_lain_lain_detail($myreg);
		$txt_arr = array();
		$txt_arr2 = array();
		foreach($data as $k => $v)
		{
			$txt_arr[] = $v['name']." (".$v['id_trx_det'].")";
		}
		$txt_arr = array_unique($txt_arr);
		
		$no = 1;
		foreach($txt_arr as $k => $v)
		{
			$txt_arr2[] = ($no) . ". " . $v;
			$no++;
		}
		
		$txt = implode("<br>\n",$txt_arr2);
		return $txt;
	}
	
	public function get_result_lain_lain_detail_text_modal($myreg)
	{
		echo get_result_lain_lain_detail_text($myreg);
	}

function get_param_all_idact()
{
	
	global $db;
	$all_idact="";
	$sql   = "SELECT id_act FROM setting_tarif_rs_bpjs WHERE aktif='t' AND id_act<>'' ";
	$result = $this->dbsupp->query($sql);
	#$rs = $result->result_array();
	 
	 foreach($result->result_array() as $rs)
	 #while ($rs = $result->fetch_array(MYSQLI_ASSOC))
   {
	  $all_idact .= " "."'".$rs['id_act']."'";
	 }
	 
	 $all_idact = str_replace(" ",",",trim($all_idact));
	 return $all_idact;
	 
}

function get_param_all_idsubgroup()
{
 global $db;
 $all_idsubgroup="";
	$sql   = "SELECT id_subgroup FROM setting_tarif_rs_bpjs WHERE aktif='t' AND id_subgroup<>'' ";
	$result = $this->dbsupp->query($sql);
	  
	foreach($result->result_array() as $rs) 
	 #while ($rs = $result->fetch_array(MYSQLI_ASSOC))
   {
	  $all_idsubgroup .= " "."'".$rs['id_subgroup']."'";
	 }
    
	 $all_idsubgroup = str_replace(" ",",",trim($all_idsubgroup));
	 return $all_idsubgroup;
	 
}


 function get_result_lab($myreg)
{
 	global $db2;
			
					
		$sql="  SELECT
				c.id_reg, SUM(a.`total`) AS total   
				FROM `trx_lab_sample_req`  a, `trx_lab_sample` c
				WHERE 				
				a.`cancel` = 0        
				AND a.is_paket <> 1       
				AND a.id_sample = c.id_sample		
				AND c.id_reg ='".$myreg."'
			";
		
			//echo "<pre>".$sql."</pre>";
			
			$query = $this->dbhis->query($sql);
			#$rs = $query->fetch_array(MYSQLI_ASSOC);
			$rs = $query->result_array();
			$rs = $rs[0];
			$result = round($rs['total'],0);
			
			return $result;
}



  public function get_result_farmasi_obat($myreg)
{
	global $db2;		
			
			//non racikan
		   $sql1="
					SELECT 
					c.`id_reg`,  COALESCE(SUM(a.`total`),0) AS total
					FROM `trx_frm_resep_det`  a, `trx_frm_resep` c, mst_farmalkes d
					WHERE 
					 a.`cancel` = 0               
					AND a.id_resep = c.id_resep		
					AND    a.`no_rck` IS  NULL
					AND a.id_trx_det = d.id_fa
					AND d.id_group = 1
					AND a.is_paket <> 1
					AND  c.id_reg ='".$myreg."'
					";

			//echo "<pre>".$sql1."</pre>";
			$query1 = $this->dbhis->query($sql1);
			#$rs1 = $query->fetch_array(MYSQLI_ASSOC);
			$rs1 = $query1->result_array();
			$rs1 = $rs1[0];
			$result1 = round($rs1['total'],0);
			
			//racikan
			$sql0="   
                    SELECT  
                    c.`id_reg`,  COALESCE(SUM(a.`total`),0) AS total
                    FROM `trx_frm_resep_rck`  a, `trx_frm_resep` c
					WHERE 
					 a.`cancel` = 0               
				    AND a.id_resep = c.id_resep		
					AND  c.id_reg ='".$myreg."'
					";
			//echo "<pre>".$sql0."</pre>";
			 $query0 = $this->dbhis->query($sql0);
			$rs0 = $query0->result_array();
			$rs0 = $rs0[0];
			$result0 = round($rs0['total'],0);
			
			
			//refund
			$sql2="
					SELECT 
					c.`id_reg`,  COALESCE(SUM(a.`total`),0) AS total
					FROM `trx_frm_resep_rev`  a,`trx_frm_resep` c, mst_farmalkes d
					WHERE 
					 a.is_paket <> 1         
					AND a.id_resep = c.id_resep		
					AND a.id_trx_det = d.id_fa
					-- AND d.id_group = 1
					AND  c.id_reg ='".$myreg."'
					";

			//echo "<pre>".$sql2."</pre>";
			$query2 = $this->dbhis->query($sql2);
			$rs2 = $query2->result_array();
			$rs2 = $rs2[0];
			$result2 = round($rs2['total'],0);
			
			$result = $result0+$result1 + $result2;
			return $result;
}
/*
 public function get_result_farmasi_alkes($myreg)
{
			
	global $db2;		
			//non racikan
		   $sql1="
					SELECT 
					c.`id_reg`,  COALESCE(SUM(a.`total`),0) AS total
					FROM `trx_frm_resep_det`  a, `trx_frm_resep` c, mst_farmalkes d
					WHERE 
					 a.`cancel` = 0               
					AND a.id_resep = c.id_resep		
					AND    a.`no_rck` IS  NULL
					AND a.id_trx_det = d.id_fa
					AND d.id_group = 2
					AND a.is_paket <> 1
					AND  c.id_reg ='".$myreg."'
					";

			//echo "<pre>".$sql1."</pre>";
			$query1 = $this->dbhis->query($sql1);
			$rs1 = $query1->result_array();
			$rs1 = $rs1[0];
			$result1 = round($rs1['total'],0);
			
			
			//refund
			$sql2="
					SELECT 
					c.`id_reg`,  COALESCE(SUM(a.`total`),0) AS total
					FROM `trx_frm_resep_rev`  a,`trx_frm_resep` c, mst_farmalkes d
					WHERE 
					 a.is_paket <> 1         
					AND a.id_resep = c.id_resep		
					AND a.id_trx_det = d.id_fa
					AND d.id_group = 2
					AND  c.id_reg ='".$myreg."'
					";

			//echo "<pre>".$sql2."</pre>";
			$query2 = $this->dbhis->query($sql2);
			$rs2 = $query2->result_array();
			$rs2 = $rs2[0];
			$result2 = round($rs2['total'],0);
			
			$result = $result1 + $result2;
			return $result;
}
*/


 public function texttoarraytomerge ($idall)
{   $text=""; 
	$id = explode(",", $idall);
	$param = array();
	for ($i = 0; $i < count($id); $i++)
	{
	   $param[$i] = $id[$i];
	}
	
	foreach($param as $k => $v)
	{
		if(trim($v)=='')
			#$text .= "''";
			continue;
		else
			$text .= " "."'".$v."'";
	}
	#echo $text."<br>";
	$text = str_replace(" ",",",trim($text));
	$text = str_replace("''","'",trim($text));
	return $text;
}


	## ------------- CODE BELOW BY Sarkodan --------------------------------------------------------------------------
	public function get_breakdown_tarif_tidb($myreg)
	{		
			
	$id_var_prosedur_non_bedah 	= get_id_var('prosedur_non_bedah');
	$id_var_prosedur_bedah 			= get_id_var('prosedur_bedah');
	$id_var_konsultasi 					= get_id_var('konsultasi');
	$id_var_tenaga_ahli 				= get_id_var('tenaga_ahli');
	$id_var_keperawatan 				= get_id_var('keperawatan');
	$id_var_penunjang 					= get_id_var('penunjang');
	$id_var_radiologi 					= get_id_var('radiologi');
	$id_var_pelayanan_darah 		= get_id_var('pelayanan_darah');
	$id_var_rehabilitasi 				= get_id_var('rehabilitasi');
	$id_var_komponen_kamar 			= get_id_var('komponen_kamar');
	$id_var_bmhp 								= get_id_var('bmhp');
	$id_var_sewa_alat 					= get_id_var('sewa_alat');
	$id_var_alkes 							= get_id_var('alkes');
	
	/*echo $id_var_prosedur_non_bedah."<br>";
	echo $id_var_prosedur_bedah."<br>";
	echo $id_var_konsultasi."<br>";
	echo $id_var_tenaga_ahli."<br>";
	echo $id_var_keperawatan."<br>";
	echo $id_var_penunjang."<br>";
	echo $id_var_radiologi."<br>";
	echo $id_var_pelayanan_darah."<br>";
	echo $id_var_rehabilitasi."<br>";
	echo $id_var_registrasi."<br>";
	echo $id_var_bmhp."<br>";
	echo $id_var_sewa_alat."<br>";*/
	
	
	
	$param_idact_prosedur_non_bedah = get_param_idact($id_var_prosedur_non_bedah);
	$param_idact_prosedur_bedah = get_param_idact($id_var_prosedur_bedah);
	$param_idact_konsultasi = get_param_idact($id_var_konsultasi);
	$param_idact_tenaga_ahli = get_param_idact($id_var_tenaga_ahli);
	$param_idact_keperawatan = get_param_idact($id_var_keperawatan);
	$param_idact_penunjang = get_param_idact($id_var_penunjang);
	$param_idact_radiologi = get_param_idact($id_var_radiologi);
	$param_idact_pelayanan_darah = get_param_idact($id_var_pelayanan_darah);
	$param_idact_rehabilitasi = get_param_idact($id_var_rehabilitasi);
	$param_idact_komponen_kamar = get_param_idact($id_var_komponen_kamar);
	$param_idact_bmhp = get_param_idact($id_var_bmhp);
	$param_idact_sewa_alat = get_param_idact($id_var_sewa_alat);
	$param_idact_alkes = get_param_idact($id_var_alkes);
	
	/*var_dump ( $param_idact_prosedur_non_bedah )."<br>";
	var_dump ( $param_idact_prosedur_bedah )."<br>";
	var_dump ( $param_idact_konsultasi )."<br>";
	var_dump ( $param_idact_tenaga_ahli )."<br>";
	var_dump ( $param_idact_keperawatan )."<br>";
	var_dump ( $param_idact_penunjang )."<br>";
	var_dump ( $param_idact_radiologi )."<br>";
	var_dump ( $param_idact_pelayanan_darah )."<br>";
	var_dump ( $param_idact_rehabilitasi )."<br>";
	var_dump ( $param_idact_registrasi )."<br>";
	var_dump ( $param_idact_bmhp )."<br>";
	var_dump ( $param_idact_sewa_alat )."<br>";*/
	
	
	
	$param_idsubgroup_prosedur_non_bedah = get_param_idsubgroup($id_var_prosedur_non_bedah); #print_r($param_idact_prosedur_non_bedah);
	$param_idsubgroup_prosedur_bedah = get_param_idsubgroup($id_var_prosedur_bedah);
	$param_idsubgroup_konsultasi = get_param_idsubgroup($id_var_konsultasi);
	$param_idsubgroup_tenaga_ahli = get_param_idsubgroup($id_var_tenaga_ahli);
	$param_idsubgroup_keperawatan = get_param_idsubgroup($id_var_keperawatan);
	$param_idsubgroup_penunjang = get_param_idsubgroup($id_var_penunjang);
	$param_idsubgroup_radiologi = get_param_idsubgroup($id_var_radiologi);
	$param_idsubgroup_pelayanan_darah = get_param_idsubgroup($id_var_pelayanan_darah);
	$param_idsubgroup_rehabilitasi = get_param_idsubgroup($id_var_rehabilitasi);
	$param_idsubgroup_komponen_kamar = get_param_idsubgroup($id_var_komponen_kamar);
	$param_idsubgroup_bmhp = get_param_idsubgroup($id_var_bmhp);
	$param_idsubgroup_sewa_alat = get_param_idsubgroup($id_var_sewa_alat);
	$param_idsubgroup_alkes = get_param_idsubgroup($id_var_alkes);
	
	/*var_dump ($param_idsubgroup_prosedur_non_bedah)."<br>";
	var_dump ($param_idsubgroup_prosedur_bedah)."<br>";
	var_dump ($param_idsubgroup_konsultasi)."<br>";
	var_dump ($param_idsubgroup_tenaga_ahli)."<br>";
	var_dump ($param_idsubgroup_keperawatan)."<br>";
	var_dump ($param_idsubgroup_penunjang)."<br>";
	var_dump ($param_idsubgroup_radiologi)."<br>";
	var_dump ($param_idsubgroup_pelayanan_darah)."<br>";
	var_dump ($param_idsubgroup_rehabilitasi)."<br>";
	var_dump ($param_idsubgroup_registrasi)."<br>";
	var_dump ($param_idsubgroup_bmhp)."<br>";
	var_dump ($param_idsubgroup_sewa_alat)."<br>";	*/
		
	/*	
		$prosedur_non_bedah = get_result('f',$param_idact_prosedur_non_bedah,$myreg)+get_result('t',$param_idsubgroup_prosedur_non_bedah,$myreg);
		$prosedur_bedah=get_result('f',$param_idact_prosedur_bedah,$myreg)+get_result('t',$param_idsubgroup_prosedur_bedah,$myreg);
		$konsultasi=get_result('f',$param_idact_konsultasi,$myreg)+get_result('t',$param_idsubgroup_konsultasi,$myreg);
		$tenaga_ahli=get_result('f',$param_idact_tenaga_ahli,$myreg)+get_result('t',$param_idsubgroup_tenaga_ahli,$myreg);
		$keperawatan=get_result('f',$param_idact_keperawatan,$myreg)+get_result('t',$param_idsubgroup_keperawatan,$myreg);
		$penunjang=get_result('f',$param_idact_penunjang,$myreg)+get_result('t',$param_idsubgroup_penunjang,$myreg);
		$radiologi=get_result('f',$param_idact_radiologi,$myreg)+get_result('t',$param_idsubgroup_radiologi,$myreg);
		$laboratorium=get_result_lab($myreg);
		$pelayanan_darah=get_result('f',$param_idact_pelayanan_darah,$myreg)+get_result('t',$param_idsubgroup_pelayanan_darah,$myreg);
		$rehabilitasi=get_result('f',$param_idact_rehabilitasi,$myreg)+get_result('t',$param_idsubgroup_rehabilitasi,$myreg);
		
		$kamar=
		get_result('f',$param_idact_registrasi,$myreg)+get_result('t',$param_idsubgroup_registrasi,$myreg);
		//+ get_kamar
		
		$rawat_intensif=0;
		
		$obat=get_result_farmasi_obat($myreg);
		$alkes=get_result_farmasi_alkes($myreg);
		
		$bmhp=get_result('f',$param_idact_bmhp,$myreg)+get_result('t',$param_idsubgroup_bmhp,$myreg);
		$sewa_alat=get_result('f',$param_idact_sewa_alat,$myreg)+get_result('t',$param_idsubgroup_sewa_alat,$myreg);
		$lain_lain=get_result_lain_lain($myreg);
	*/
		$prosedur_non_bedah = get_result_tidb('f',$param_idact_prosedur_non_bedah,$myreg)+get_result_tidb('t',$param_idsubgroup_prosedur_non_bedah,$myreg);
		$prosedur_bedah			= get_result_tidb('f',$param_idact_prosedur_bedah,$myreg)+get_result_tidb('t',$param_idsubgroup_prosedur_bedah,$myreg);
		$konsultasi					= get_result_tidb('f',$param_idact_konsultasi,$myreg)+get_result_tidb('t',$param_idsubgroup_konsultasi,$myreg);
		$tenaga_ahli				= get_result_tidb('f',$param_idact_tenaga_ahli,$myreg)+get_result_tidb('t',$param_idsubgroup_tenaga_ahli,$myreg);
		$keperawatan				= get_result_tidb('f',$param_idact_keperawatan,$myreg)+get_result_tidb('t',$param_idsubgroup_keperawatan,$myreg);
		$penunjang					= get_result_tidb('f',$param_idact_penunjang,$myreg)+get_result_tidb('t',$param_idsubgroup_penunjang,$myreg);
		$radiologi					= get_result_tidb('f',$param_idact_radiologi,$myreg)+get_result_tidb('t',$param_idsubgroup_radiologi,$myreg);
		$pelayanan_darah		= get_result_tidb('f',$param_idact_pelayanan_darah,$myreg)+get_result_tidb('t',$param_idsubgroup_pelayanan_darah,$myreg);
		$rehabilitasi				= get_result_tidb('f',$param_idact_rehabilitasi,$myreg)+get_result_tidb('t',$param_idsubgroup_rehabilitasi,$myreg);
		$sewa_alat					= get_result_tidb('f',$param_idact_sewa_alat,$myreg)+get_result('t',$param_idsubgroup_sewa_alat,$myreg);
		$bmhp								= get_result_tidb('f',$param_idact_bmhp,$myreg)+get_result('t',$param_idsubgroup_bmhp,$myreg);
		
		$rawat_intensif = $this->get_result_tidb_kamar_intensif($myreg);
		
		// komponen_kamar + get_kamar + get_adm_kamar
		$kamar	= 	get_result_tidb('f',$param_idact_komponen_kamar,$myreg)+get_result_tidb('t',$param_idsubgroup_komponen_kamar,$myreg)
							+ get_result_tidb_kamar($myreg)
							+ get_result_tidb_adm($myreg)
							; 
		#$kamar	= get_result_tidb_kamar($myreg);
		
		$laboratorium	= get_result_tidb_lab($myreg);
		
		$obat					= get_result_tidb_obat($myreg);
		#$alkes				= get_result_tidb_alkes($myreg);
		$alkes				= get_result_tidb('f',$param_idact_alkes,$myreg)+get_result_tidb('t',$param_idsubgroup_alkes,$myreg);
		$lain_lain 		= get_result_tidb_lain_lain($myreg);
	
		$return = array(
			'prosedur_non_bedah' 	=> $prosedur_non_bedah,
			'prosedur_bedah' 			=> $prosedur_bedah,
			'konsultasi' 					=> $konsultasi,
			'tenaga_ahli' 				=> $tenaga_ahli,
			'keperawatan' 				=> $keperawatan,
			'penunjang' 					=> $penunjang,
			'radiologi' 					=> $radiologi,
			'pelayanan_darah' 		=> $pelayanan_darah,
			'rehabilitasi' 				=> $rehabilitasi,
			'sewa_alat' 					=> $sewa_alat,
			'bmhp' 								=> $bmhp,
			'rawat_intensif'	=> $rawat_intensif,
			
			'kamar' 				=> $kamar,
			'laboratorium' 	=> $laboratorium,
			'obat' 					=> $obat,
			'alkes' 				=> $alkes,
			'lain_lain' 		=> $lain_lain,
		);
		
		return $return;
	}
	
	public function get_result_tidb($is_subgroup,$inp_param_arr,$myreg)
	{
		$CI =& get_instance(); $CI->output->enable_profiler(true);
		global $db2;
		$text="";
		//  $base->db2->debug=true;
		if(empty($inp_param_arr)) return 0;

		if ($is_subgroup=='t'){
			foreach($inp_param_arr as $k => $v)
			{
				$text .= " "."'".$v."'";
			}
			$text = str_replace(" ",",",trim($text));
			$inquery1 = " AND c.id_subgroup IN (".$text.") AND c.id_subgroup>0";
			}
			else{
			foreach($inp_param_arr as $k => $v)
			{
				$text .= " "."'".$v."'";
			}
			$text = str_replace(" ",",",trim($text));
			$inquery1 = " AND a.id_trx_det IN (".$text.")";
		}
					
		$sql1 = "SELECT 	SUM(a.`price`*a.`qty`) AS total
							FROM 		dbsupp.`trx_inv_det_bpjs` a, `mst_tindakan` c
							WHERE		a.`id_trx_det`=c.`id_act`
											".$inquery1."
											AND a.id_group>0
											AND a.`id_reg`='".$myreg."'";
		#echo "<pre>".$sql1."</pre>";
		$query1 = $this->dbhis->query($sql1);
		$rs1 = $query1->result_array();
		$rs1 = $rs1[0];
		$result1 = round($rs1['total'],0);
					
		$result = $result1;
		#echo 'coba : '.$result."<br>";
		return $result;
	}
	
	public function get_result_tidb_adm($myreg)
	{
		global $db2;
		
		#$sql = "SELECT a.admfee_rwi FROM mst_main_setting a ORDER BY id DESC LIMIT 1";
		#$admin_ri_persen_1 = $base->dbGetOne2($sql);
		
		$sql1 = "	SELECT 	(SUM(a.`price`*a.`qty`)) * 0.05 AS total
							FROM 		dbsupp.`trx_inv_det_bpjs` a 
							WHERE 	a.`id_reg`='".$myreg."'
											";
		#echo "<pre>".$sql1."</pre>";
		$query1 = $this->dbhis->query($sql1);
		$rs1 = $query1->result_array();
		$rs1 = $rs1[0];
		$result = round($rs1['total'],0);
		return $result;
	}
	
	public function get_result_tidb_kamar($myreg)
	{
		global $db2;					
		$sql1 = "SELECT 	SUM(a.`price`*a.`qty`) AS total
							FROM 		dbsupp.`trx_inv_det_bpjs` a 
							WHERE 	UPPER(a.`trx_group`)='KAMAR PERAWATAN'
											AND (UPPER(a.`name`) NOT LIKE '%ICU%'
													AND UPPER(a.`name`) NOT LIKE '%NICU%'
													AND UPPER(a.`name`) NOT LIKE '%PERINA%')
											AND a.`id_reg`='".$myreg."'";
		#echo "<pre>".$sql1."</pre>";
		$query1 = $this->dbhis->query($sql1);
		$rs1 = $query1->result_array();
		$rs1 = $rs1[0];
		$result = round($rs1['total'],0);
		return $result;
	}
	
	public function get_result_tidb_kamar_intensif($myreg)
	{
		global $db2;					
		$sql1 = "SELECT 	SUM(a.`price`*a.`qty`) AS total
							FROM 		dbsupp.`trx_inv_det_bpjs` a 
							WHERE 	UPPER(a.`trx_group`)='KAMAR PERAWATAN'
											AND (UPPER(a.`name`) LIKE '%ICU%'
														OR UPPER(a.`name`) LIKE '%NICU%'
														OR UPPER(a.`name`) LIKE '%PERINA%')
											AND a.`id_reg`='".$myreg."'";
		#echo "<pre>".$sql1."</pre>";
		$query1 = $this->dbhis->query($sql1);
		$rs1 = $query1->result_array();
		$rs1 = $rs1[0];
		$result = round($rs1['total'],0);
		return $result;
	}
	
	public function get_result_tidb_lab($myreg)
	{
		global $db2;
		$sql1 = "	SELECT 	SUM(a.`price`*a.`qty`) AS total
							FROM 		dbsupp.`trx_inv_det_bpjs` a 
							WHERE 	UPPER(a.`trx_group`)='LABORATORIUM'
											AND a.`id_reg`='".$myreg."'";
		#echo "<pre>".$sql1."</pre>";
		$query1 = $this->dbhis->query($sql1);
		$rs1 = $query1->result_array();
		$rs1 = $rs1[0];
		$result = round($rs1['total'],0);
		return $result;
	}
	
	public function get_result_tidb_obat($myreg)
	{
		$id_group_mst_farmalkes = 1; // << BERDASARKAN field id_group di table mst_farmalkes; 1=obat; 2=alkes;
		global $db2;
		$sql1 = "	SELECT 	ROUND(SUM(a.`price`*a.`qty`)) AS total
							FROM 		dbsupp.`trx_inv_det_bpjs` a, mst_farmalkes b
							WHERE 	a.`id_trx_det`=b.`id_fa`
											AND UPPER(a.`trx_group`) IN ('FARMASI','FARMASI RUANGAN','ALKES')
											AND a.`id_reg`='".$myreg."'
											-- AND b.`id_group`=".$id_group_mst_farmalkes."
											";
		#echo "<pre>".$sql1."</pre>";
		$query1 = $this->dbhis->query($sql1);
		$rs1 = $query1->result_array();
		$rs1 = $rs1[0];
		$result = round($rs1['total'],0);
		return $result;
	}
	
	/*
	public function get_result_tidb_alkes($myreg)
	{
		$id_group_mst_farmalkes = 2; // << BERDASARKAN field id_group di table mst_farmalkes; 1=obat; 2=alkes;
		global $db2;
		$sql1 = "	SELECT 	ROUND(SUM(a.`price`*a.`qty`)) AS total
							FROM 		dbsupp.`trx_inv_det_bpjs` a, mst_farmalkes b
							WHERE 	a.`id_trx_det`=b.`id_fa`
											AND UPPER(a.`trx_group`) IN ('FARMASI','FARMASI RUANGAN','ALKES')
											AND a.`id_reg`='".$myreg."'
											AND b.`id_group`=".$id_group_mst_farmalkes."
											";
		#echo "<pre>".$sql1."</pre>";
		$query1 = $this->dbhis->query($sql1);
		$rs1 = $query1->result_array();
		$rs1 = $rs1[0];
		$result = round($rs1['total'],0);
		return $result;
	}
	*/
	public function get_result_tidb_lain_lain($myreg)
	{				 
		global $db2;
		$idact = get_param_all_idact();
		$idsubgroup = get_param_all_idsubgroup();
		
		$text1 = texttoarraytomerge($idact);
		$text2 = texttoarraytomerge($idsubgroup);
		if($text2=='' || $text2=="''")
			$query_subgrup = '';
		else
			$query_subgrup = "AND c.id_subgroup NOT IN (".$text2.") ";
			
		$sql1 = "SELECT 	SUM(a.`price`*a.`qty`) AS total
						FROM 		dbsupp.`trx_inv_det_bpjs` a, `mst_tindakan` c
						WHERE		a.`id_trx_det`=c.`id_act`
										AND a.id_group>0
										AND a.id_trx_det NOT IN (".$text1.")   
										-- AND c.id_subgroup NOT IN (".$text2.") 
										".$query_subgrup."
										AND a.`id_reg`='".$myreg."'
										AND a.id_group>0
										";
		//echo "<pre>".$sql1."</pre>";
		$query1 = $this->dbhis->query($sql1);
		$rs1 = $query1->result_array();
		$rs1 = $rs1[0];
		$result = round($rs1['total'],0);		
		return $result;
	}
	
	public function get_result_tidb_lain_lain_detail($myreg)
	{				 
		#global $db2;
		$idact = get_param_all_idact();
		$idsubgroup = get_param_all_idsubgroup();
		
		$text1 = texttoarraytomerge($idact);
		$text2 = texttoarraytomerge($idsubgroup);

		$sql1 = "SELECT 	a.*,c.id_subgroup
								FROM 		dbsupp.`trx_inv_det_bpjs` a, `mst_tindakan` c
								WHERE		a.`id_trx_det`=c.`id_act`
												AND a.id_group>0
												AND a.trx_group<>'ADMINISTRASI PASIEN'
												AND a.id_trx_det NOT IN (".$text1.")   
												AND c.id_subgroup NOT IN (".$text2.") 
												AND a.`id_reg`='".$myreg."'
												AND a.id_group>0";
		#echo "<pre>".$sql1."</pre>";
		$query1 = $this->dbhis->query($sql1);
		$rows = array();
		#while($row = $query1->fetch_array(MYSQLI_ASSOC))
		foreach($query1->result_array() as $row)
		{
			$rows[] = $row;
		}
		#$rs1 = $query1->fetch_array(MYSQLI_ASSOC);
		$result = $rows;
		return $result;
	}
	
	public function get_result_tidb_lain_lain_detail_text($myreg)
	{
		$data = $this->get_result_tidb_lain_lain_detail($myreg);
		$txt_arr = array();
		$txt_arr2 = array();
		foreach($data as $k => $v)
		{
			$txt_arr[] = $v['name']." (".$v['id_trx_det'].")";
		}
		$txt_arr = array_unique($txt_arr);
		
		$no = 1;
		foreach($txt_arr as $k => $v)
		{
			$txt_arr2[] = ($no) . ". " . $v;
			$no++;
		}
		
		$txt = implode("<br>\n",$txt_arr2);
		return $txt;
	}
	
	public function get_result_tidb_lain_lain_detail_text_modal($myreg)
	{
		echo get_result_tidb_lain_lain_detail_text($myreg);
	}

}
?>