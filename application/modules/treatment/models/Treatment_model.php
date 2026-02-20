<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Treatment_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	function data_treatment($id_reg) 
	{
        #$this->db->order_by($this->id, $this->order);
		$sql = "SELECT ax.* FROM (
					SELECT 	a.id_trx,a.`trxdate`,a.`id_reg` ,a.`id_reg_act`,a.`id_dokter`,a.id_dokter2,a.id_dokter3
							,a.`price`,a.`qty`,a.`total`
							,b.`name`,b.`id_group`,c.`name` AS grup,b.`id_subgroup`,d.`name` AS subgrup
							,c.`inv_num`,a.`treatment`,IF(a.treatment=1,'checked','') as checked_treatment
							,a.kunj_ke,a.id_inv
					FROM	trx_reg_act a
						JOIN `mst_tindakan` b ON (b.`id_act`=a.`id_reg_act`)
						LEFT JOIN `mst_tindakan_grup` c ON (c.`id_group`=b.`id_group`)
						LEFT JOIN `mst_tindakan_subgrup` d ON (d.`id_subgroup`=b.`id_subgroup`)
					WHERE 	a.id_reg='".$id_reg."'
					UNION ALL
					SELECT 	b.`id_eresep_det` , a.`eresepdate`,a.`id_reg` ,b.`id_trx_det`,a.id_dokter,NULL as id_dokter2,NULL as id_dokter3
							,b.`harga_satuan`,b.`qty`,b.`subtotal`
							,b.`name`,99,'FARMASI' AS grup,NULL AS `id_subgroup`,NULL AS subgrup	
							,99 AS id_num,b.`treatment`,IF(b.treatment=1,'checked','') as checked_treatment
							,b.kunj_ke,b.id_inv
					FROM 	soap_eresep a
							JOIN soap_eresep_det b ON (b.`id_eresep`=a.id_eresep)
							LEFT JOIN `mst_farmalkes` c ON (c.`id_fa`=b.`id_trx_det`)
					WHERE	a.id_reg='".$id_reg."' AND b.is_validasi=1 AND b.status=0
				) ax
				ORDER BY ax.`inv_num`,ax.id_reg_act";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	// insert data
    function insert($table,$data)
    {
        $this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();

		return  $insert_id;
    }

    // update data
    function update($table,$column,$id,$data)
    {
        $this->db->where($column,$id);
        $this->db->update($table,$data);
    }
	
}
