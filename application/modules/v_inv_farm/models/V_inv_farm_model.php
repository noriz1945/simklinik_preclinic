<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V_inv_farm_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_limit_data($periode_start,$periode_end, $limit='10000') 
	{
        $sql = "SELECT 	NULL AS nomor,a.*
				FROM 	v_inv_farm a
				WHERE	a.tgl_inv BETWEEN '".$periode_start."' AND '".$periode_end."'
				LIMIT 10000
				";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

}
?>