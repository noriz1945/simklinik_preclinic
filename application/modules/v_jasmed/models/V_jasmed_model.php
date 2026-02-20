<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V_jasmed_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function data_jasmed($periode_start,$periode_end,$id_nakes)
	{
		$sql = "SELECT 	tj.*, DATE(tj.`waktu_jasmed`) AS tgl_jasmed
						,md.`name` AS nakes,mdt.`name` AS jenis_nakes
				FROM 	trx_jasmed tj
						JOIN mst_dokter md ON (md.`id_dokter`=tj.`id_nakes`)
						LEFT JOIN `mst_dokter_type` mdt ON (mdt.id_jenis=md.`id_jenis`)
				WHERE	DATE(tj.`waktu_jasmed`) BETWEEN '".$periode_start."' AND '".$periode_end."'
				";
		if($id_nakes!='')
			$sql .= " 	AND tj.id_nakes='".$id_nakes."'
					";
		
		$sql .= "ORDER BY tj.id_jasmed 
		";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	public function share_nakes_header($id_jasmed)
	{
		$sql = "SELECT 	DATE_FORMAT(tj.waktu_jasmed, '%y') tahun
						,DATE_FORMAT(tj.waktu_jasmed, '%m') bulan
						,CONCAT(DATE_FORMAT(tj.waktu_jasmed, '%m'),DATE_FORMAT(tj.waktu_jasmed, '%y'),'JM',tj.`id_nakes`,LPAD(tj.`id_jasmed`,5,0)) AS no_jasmed
						,tj.*
						,DATE(tj.`waktu_jasmed`) AS tgl_jasmed
						,md.`name` AS nakes,mdt.`name` AS jenis_nakes
						,YEAR(tj.waktu_jasmed) AS y
				FROM 	trx_jasmed tj
						JOIN mst_dokter md ON (md.`id_dokter`=tj.`id_nakes`)
						LEFT JOIN `mst_dokter_type` mdt ON (mdt.id_jenis=md.`id_jenis`)
				WHERE	tj.id_jasmed='".$id_jasmed."'
				";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row;
	}
	
	public function share_nakes_detail($id_jasmed)
	{
		$sql = "SELECT	tjd.*,tra.trxdate,mp.`name` AS pasien,tr.`id_pasien`,tra.id_reg,mtg.`name` AS grup,mts.`name` AS subgrup
				FROM 	trx_jasmed_det tjd
						JOIN trx_reg_act tra ON (tra.`id_trx`=tjd.`id_trx`)
						JOIN trx_reg tr ON (tr.`id_reg`=tra.`id_reg`)
						JOIN mst_pasien mp ON (mp.`id_pasien`=tr.`id_pasien`)
						JOIN mst_tindakan mt ON (mt.`id_act`=tra.`id_reg_act`)
						LEFT JOIN `mst_tindakan_grup` mtg ON (mtg.`id_group`=mt.`id_group`)
						LEFT JOIN `mst_tindakan_subgrup` mts ON (mts.`id_subgroup`=mt.`id_subgroup`)
				WHERE	tjd.`id_jasmed`='".$id_jasmed."'
				LIMIT 10000";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function data_jasmed_bahan($periode_start,$periode_end, $limit='10000') 
	{
		$sql = "SELECT 	vjf.id_jasmed,vjf.`id_jenis`,vjf.jenis_nakes,vjf.id_nakes,vjf.nakes
						,vjf.`id_pasien`,vjf.id_reg,vjf.regdate,vjf.tgl_reg,vjf.pasien,vjf.`id_asuransi`,vjf.asuransi
						,vjf.`id_inv`,vjf.`invdate`,DATE(vjf.`invdate`) AS tgl_inv
						,vjf.tgl_tindakan
						,vjf.id_trx,vjf.`id_group`,vjf.grup_tindakn,vjf.`id_subgroup` ,vjf.sub_grup_tindakan
						,vjf.`name`,vjf.tarif_satuan,vjf.`qty`,vjf.tarif
						,vjf.`share_vendor`,vjf.`share_nakes`,vjf.`share_rs`
				FROM 	`v_jasmed_full` vjf
				WHERE	vjf.tgl_inv BETWEEN '".$periode_start."' AND '".$periode_end."'
						AND vjf.`id_jasmed` IS NULL
				LIMIT 10000";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function data_jasmed_show_all($periode_start,$periode_end, $limit='10000') 
	{
		$sql = "SELECT 	vjf.id_jasmed,vjf.`id_jenis`,vjf.jenis_nakes,vjf.id_nakes,vjf.nakes
						,vjf.`id_pasien`,vjf.id_reg,vjf.regdate,vjf.tgl_reg,vjf.pasien,vjf.`id_asuransi`,vjf.asuransi
						,vjf.`id_inv`,vjf.`invdate`,DATE(vjf.`invdate`) AS tgl_inv
						,vjf.tgl_tindakan
						,vjf.id_trx,vjf.`id_group`,vjf.grup_tindakn,vjf.`id_subgroup` ,vjf.sub_grup_tindakan
						,vjf.`name`,vjf.tarif_satuan,vjf.`qty`,vjf.tarif
						,vjf.`share_vendor`,vjf.`share_nakes`,vjf.`share_rs`
				FROM 	`v_jasmed_full` vjf
				WHERE	vjf.tgl_inv BETWEEN '".$periode_start."' AND '".$periode_end."'
				LIMIT 10000";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function data_jasmed_detail($periode_start,$periode_end, $limit='10000') 
	{
		$sql = "SELECT 	vjf.id_jasmed,vjf.`id_jenis`,vjf.jenis_nakes,vjf.id_nakes,vjf.nakes
						,vjf.`id_pasien`,vjf.id_reg,vjf.regdate,vjf.tgl_reg,vjf.pasien,vjf.`id_asuransi`,vjf.asuransi
						,vjf.`id_inv`,vjf.`invdate`,DATE(vjf.`invdate`) AS tgl_inv
						,vjf.tgl_tindakan
						,vjf.id_trx,vjf.`id_group`,vjf.grup_tindakn,vjf.`id_subgroup` ,vjf.sub_grup_tindakan
						,vjf.`name`,vjf.tarif_satuan,vjf.`qty`,vjf.tarif
						,vjf.`share_vendor`,vjf.`share_nakes`,vjf.`share_rs`
						,vjf.`persen_vendor`,vjf.`persen_nakes`,vjf.`persen_rs`
				FROM 	`v_jasmed_full` vjf
				WHERE	vjf.tgl_inv BETWEEN '".$periode_start."' AND '".$periode_end."'
						AND vjf.`id_jasmed` IS NOT NULL
				LIMIT 10000";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function data_add_detail($id_nakes,$periode_start,$periode_end, $limit='10000') 
	{
		/*
		$sql = "SELECT 	vjf.id_jasmed,vjf.`id_jenis`,vjf.jenis_nakes,vjf.id_nakes,vjf.nakes
						,vjf.`id_pasien`,vjf.id_reg,vjf.regdate,vjf.tgl_reg,vjf.pasien,vjf.`id_asuransi`,vjf.asuransi
						,vjf.`id_inv`,vjf.`invdate`,DATE(vjf.`invdate`) AS tgl_inv
						,vjf.tgl_tindakan
						,vjf.id_trx,vjf.`id_group`,vjf.grup_tindakn,vjf.`id_subgroup` ,vjf.sub_grup_tindakan
						,vjf.`name`,vjf.tarif_satuan,vjf.`qty`,vjf.tarif
						,vjf.`share_vendor`,vjf.`share_nakes`,vjf.`share_rs`
						,vjf.`persen_vendor`,vjf.`persen_nakes`,vjf.`persen_rs`
				FROM 	`v_jasmed_full` vjf
				WHERE	vjf.tgl_inv BETWEEN '".$periode_start."' AND '".$periode_end."'
						AND vjf.`id_jasmed` IS NULL 
						AND COALESCE(vjf.`share_nakes`,0)>0
						AND vjf.id_nakes='".$id_nakes."'
				LIMIT ".$limit."";
		*/
		$sql = "SELECT 	ax.* FROM (
					(SELECT 	NULL as id_refund
							,vjf.id_jasmed,vjf.`id_jenis`,vjf.jenis_nakes,vjf.id_nakes,vjf.nakes
							,vjf.`id_pasien`,vjf.id_reg,vjf.regdate,vjf.tgl_reg,vjf.pasien,vjf.`id_asuransi`,vjf.asuransi
							,vjf.`id_inv`,vjf.`invdate`,DATE(vjf.`invdate`) AS tgl_inv
							,vjf.tgl_tindakan
							,vjf.id_trx,vjf.`id_group`,vjf.grup_tindakn,vjf.`id_subgroup` ,vjf.sub_grup_tindakan
							,vjf.`name`,vjf.tarif_satuan,vjf.`qty`,vjf.tarif
							,vjf.`share_vendor`,vjf.`share_nakes`,vjf.`share_rs`
							,vjf.`persen_vendor`,vjf.`persen_nakes`,vjf.`persen_rs`
					FROM 	`v_jasmed_full` vjf
					WHERE	vjf.tgl_inv BETWEEN '".$periode_start."' AND '".$periode_end."'
							AND vjf.`id_jasmed` IS NULL 
							AND COALESCE(vjf.`share_nakes`,0)>0
							AND vjf.id_nakes='".$id_nakes."'
					LIMIT ".$limit.")
					UNION ALL 
					(SELECT 	b.`id_refund`
							,vjf.id_jasmed,vjf.`id_jenis`,vjf.jenis_nakes,vjf.id_nakes,vjf.nakes
							,vjf.`id_pasien`,vjf.id_reg,vjf.regdate,vjf.tgl_reg,vjf.pasien,vjf.`id_asuransi`,vjf.asuransi
							,vjf.`id_inv`,vjf.`invdate`,DATE(vjf.`invdate`) AS tgl_inv
							,vjf.tgl_tindakan
							,vjf.id_trx,vjf.`id_group`,vjf.grup_tindakn,vjf.`id_subgroup` ,vjf.sub_grup_tindakan
							,vjf.`name`
							,vjf.tarif_satuan,vjf.`qty`
							,vjf.tarif*(-1) as tarif,vjf.`share_vendor`*(-1) as share_vendor,vjf.`share_nakes`*(-1) AS share_nakes,vjf.`share_rs`*(-1) AS share_rs
							,vjf.`persen_vendor`,vjf.`persen_nakes`,vjf.`persen_rs`
					FROM 	`v_jasmed_full` vjf
							JOIN `trx_reg_inv_refund_det` b ON (b.`id_trx`=vjf.`id_trx`)
					WHERE	vjf.tgl_inv BETWEEN '".$periode_start."' AND '".$periode_end."'
							AND vjf.`id_jasmed` IS NULL 
							AND COALESCE(vjf.`share_nakes`,0)>0
							AND vjf.id_nakes='".$id_nakes."'
					LIMIT ".$limit.")
					) ax
					ORDER BY ax.`id_jenis`,ax.`id_nakes`,ax.`invdate`,ax.`id_trx`,ax.`name`,ax.`name`,ax.id_refund";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	##### END  OF JASMED #### -----------------------------------------------------------------------------------
	
	##### START JASDOR #### -----------------------------------------------------------------------------------
	public function data_jasdor($periode_start,$periode_end,$id_vendor)
	{
		$sql = "SELECT 	tj.*, DATE(tj.`waktu_jasdor`) AS tgl_jasdor
						,mv.`vendor` AS vendor
				FROM 	trx_jasdor tj
						JOIN mst_vendor mv ON (mv.`id_vendor`=tj.`id_vendor`)
				WHERE	DATE(tj.`waktu_jasdor`) BETWEEN '".$periode_start."' AND '".$periode_end."'
				";
		if($id_vendor!='')
			$sql .= " 	AND tj.id_vendor='".$id_vendor."'
					";
		
		$sql .= "ORDER BY tj.id_jasdor DESC
		";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function vendor_data_add_detail($id_vendor,$periode_start,$periode_end, $limit='10000') 
	{
		$sql = "SELECT 	vjf.id_jasdor,vjf.id_vendor,vjf.vendor
						,vjf.`id_pasien`,vjf.id_reg,vjf.regdate,vjf.tgl_reg,vjf.pasien,vjf.`id_asuransi`,vjf.asuransi
						,vjf.`id_inv`,vjf.`invdate`,DATE(vjf.`invdate`) AS tgl_inv
						,vjf.tgl_tindakan
						,vjf.id_trx,vjf.`id_group`,vjf.grup_tindakn,vjf.`id_subgroup` ,vjf.sub_grup_tindakan
						,vjf.`name`,vjf.tarif_satuan,vjf.`qty`,vjf.tarif
						,vjf.`share_vendor`,vjf.`share_nakes`,vjf.`share_rs`
						,vjf.`persen_vendor`,vjf.`persen_nakes`,vjf.`persen_rs`
				FROM 	`v_jasmed_full` vjf
				WHERE	vjf.tgl_inv BETWEEN '".$periode_start."' AND '".$periode_end."'
						AND vjf.`id_jasdor` IS NULL 
						AND COALESCE(vjf.`share_vendor`,0)>0
						AND vjf.id_vendor='".$id_vendor."'
				LIMIT ".$limit."";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	public function share_vendor_header($id_jasdor)
	{
		$sql = "SELECT 	DATE_FORMAT(tj.waktu_jasdor, '%y') tahun
						,DATE_FORMAT(tj.waktu_jasdor, '%m') bulan
						,CONCAT(DATE_FORMAT(tj.waktu_jasdor, '%m'),DATE_FORMAT(tj.waktu_jasdor, '%y'),'JM',tj.`id_vendor`,LPAD(tj.`id_jasdor`,5,0)) AS no_jasdor
						,tj.*
						,DATE(tj.`waktu_jasdor`) AS tgl_jasdor
						,md.`vendor` AS vendor
						,YEAR(tj.waktu_jasdor) AS y
				FROM 	trx_jasdor tj
						JOIN mst_vendor md ON (md.`id_vendor`=tj.`id_vendor`)
				WHERE	tj.id_jasdor='".$id_jasdor."'
				";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row;
	}
	
	public function share_vendor_detail($id_jasdor)
	{
		$sql = "SELECT	tjd.*,tra.trxdate,mp.`name` AS pasien,tr.`id_pasien`,tra.id_reg,mtg.`name` AS grup,mts.`name` AS subgrup
				FROM 	trx_jasdor_det tjd
						JOIN trx_reg_act tra ON (tra.`id_trx`=tjd.`id_trx`)
						JOIN trx_reg tr ON (tr.`id_reg`=tra.`id_reg`)
						JOIN mst_pasien mp ON (mp.`id_pasien`=tr.`id_pasien`)
						JOIN mst_tindakan mt ON (mt.`id_act`=tra.`id_reg_act`)
						LEFT JOIN `mst_tindakan_grup` mtg ON (mtg.`id_group`=mt.`id_group`)
						LEFT JOIN `mst_tindakan_subgrup` mts ON (mts.`id_subgroup`=mt.`id_subgroup`)
				WHERE	tjd.`id_jasdor`='".$id_jasdor."'
				LIMIT 10000";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

}
?>