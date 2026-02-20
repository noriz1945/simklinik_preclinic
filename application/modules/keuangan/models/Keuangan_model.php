<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Keuangan_model extends CI_Model
{
	function __construct()
	{
			parent::__construct();
	}

  function get_limit_data($periode_start,$periode_end, $id_dokter='', $limit='10000') 
	{
		$sql = "	SELECT 	a.*,DATE(a.regdate) AS tgl_reg
							FROM 	v_inv a
							WHERE	DATE(a.invdate) BETWEEN '".$periode_start."' AND '".$periode_end."'
						";
		$sql .= ($id_dokter!='') ? " AND a.id_dokter_prt1='".$id_dokter."'" : '';
		$sql .= "
							ORDER BY a.invdate
							LIMIT 10000
							";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function get_data_tindakan($periode_start,$periode_end, $id_dokter='', $id_act='', $limit='10000') 
	{
		$sql = "	SELECT 	a.*
							FROM 	v_tindakan a
							WHERE	DATE(a.tgl_tindakan) BETWEEN '".$periode_start."' AND '".$periode_end."'
										AND a.id_group NOT IN (1,2)
						";
		$sql .= ($id_dokter!='') ? " AND a.id_nakes='".$id_dokter."'" : '';
		$sql .= ($id_act!='') ? " AND a.id_act='".$id_act."'" : '';
		$sql .= "
							ORDER BY a.tgl_tindakan DESC
							LIMIT 10000
							";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
}
?>