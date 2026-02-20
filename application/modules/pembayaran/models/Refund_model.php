<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Refund_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function get_data_inv_header($id_inv)
    {				
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
						,e.*
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
						JOIN trx_reg_inv e ON (e.`id_reg`=a.`id_reg`)
				WHERE e.id_inv='".$id_inv."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }
	
	function get_data_inv_detail($id_inv)
    {	$sql = "SELECT ax.* FROM (
					SELECT 	a.id_trx,a.`trxdate`,a.`id_reg` ,a.`id_reg_act`,a.`id_dokter`,a.`price`,a.`qty`,a.`total`
							,(CASE WHEN a.is_paket=1 THEN CONCAT('<strong>','[P] ','</strong>',b.`name`)
							ELSE b.name END) AS name
							,b.`id_group`,c.`name` AS grup,b.`id_subgroup`,d.`name` AS subgrup
							,c.`inv_num`,0 as is_farmasi
					FROM	trx_reg_act a
						JOIN `mst_tindakan` b ON (b.`id_act`=a.`id_reg_act`)
						LEFT JOIN `mst_tindakan_grup` c ON (c.`id_group`=b.`id_group`)
						LEFT JOIN `mst_tindakan_subgrup` d ON (d.`id_subgroup`=b.`id_subgroup`)
					WHERE 	a.id_inv='".$id_inv."'
                            AND a.id_inv_refund IS NULL 
							-- AND a.id_paket IS NULL
					UNION ALL
					SELECT 	b.`id_eresep_det` , a.`eresepdate`,a.`id_reg` ,b.`id_trx_det`,a.`id_dokter`,b.`harga_satuan`,b.`qty`,b.`subtotal`
							,(CASE WHEN b.is_paket=1 THEN 
								(CASE WHEN b.is_validasi=0 THEN
										CONCAT('<strong>','[P] ','</strong>',b.`name`,'<strong class=\"text-danger\">[BELUM DIVALIDASI APOTIK]</strong>')
									ELSE
										CONCAT('<strong>','[P] ','</strong>',b.`name`)
								END)
							ELSE b.name END) AS name
							,99,'FARMASI' AS grup,NULL AS `id_subgroup`,NULL AS subgrup	
							,99 AS inv_num,1 as is_farmasi
					FROM 	soap_eresep a
							JOIN soap_eresep_det b ON (b.`id_eresep`=a.id_eresep)
							LEFT JOIN `mst_farmalkes` c ON (c.`id_fa`=b.`id_trx_det`)
					WHERE	b.id_inv='".$id_inv."'
							AND b.is_retur=1
							AND b.id_inv_refund IS NULL 
							-- AND b.id_paket IS NULL
				) ax
				ORDER BY ax.`inv_num`";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
	
	// insert data
    function insert($table,$data)
    {
        $this->db->insert($table, $data);
    }
	
	function update($table,$where_id,$id, $data)
    {
        $this->db->where($where_id, $id);
        $this->db->update($table, $data);
    }
	
	function get_data_inv_refund_header($id_refund)
    {				
		$sql = "SELECT 	f.*,f.asuransi as refund_asuransi,f.creator as creator_refund,a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
						,e.id_inv
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
						JOIN trx_reg_inv e ON (e.`id_reg`=a.`id_reg`)
						JOIN trx_reg_inv_refund f ON (f.id_inv=e.id_inv)
				WHERE f.id_refund='".$id_refund."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }
	
	function get_data_inv_refund_detail($id_refund)
    {	$sql = "SELECT ax.* FROM (
					SELECT 	y.*,a.`trxdate`,a.`id_reg` ,a.`id_reg_act`,a.`id_dokter`,a.`total`
							,b.`name`,b.`id_group`,c.`name` AS grup,b.`id_subgroup`,d.`name` AS subgrup
							,c.`inv_num`
					FROM	trx_reg_inv_refund x
							JOIN trx_reg_inv_refund_det y ON (y.id_refund=x.id_refund AND y.is_farmasi=0) 
							JOIN trx_reg_act a ON (a.id_trx=y.id_trx)
							JOIN `mst_tindakan` b ON (b.`id_act`=a.`id_reg_act`)
							LEFT JOIN `mst_tindakan_grup` c ON (c.`id_group`=b.`id_group`)
							LEFT JOIN `mst_tindakan_subgrup` d ON (d.`id_subgroup`=b.`id_subgroup`)
					WHERE 	x.id_refund='".$id_refund."'
					UNION ALL
					SELECT 	y.* , a.`eresepdate`,a.`id_reg` ,b.`id_trx_det`,a.`id_dokter`,b.`subtotal`
							,b.`name`,99,'FARMASI' AS grup,NULL AS `id_subgroup`,NULL AS subgrup	
							,99 AS inv_num
					FROM 	trx_reg_inv_refund x
							JOIN trx_reg_inv_refund_det y ON (y.id_refund=x.id_refund AND y.is_farmasi=1) 
							JOIN soap_eresep_det b ON (b.`id_eresep_det`=y.id_trx)
							JOIN soap_eresep a ON (a.id_eresep=b.id_eresep)
							LEFT JOIN `mst_farmalkes` c ON (c.`id_fa`=b.`id_trx_det`)
					WHERE	x.id_refund='".$id_refund."'
				) ax
				ORDER BY ax.`id_refund_det`";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
}
?>