<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V_inv_model extends CI_Model
{

    public $table = 'v_inv';
		
    public $id = 'id_inv';    
	public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_limit_data($periode_start,$periode_end, $id_dokter='', $limit='10000') 
	{
        $sql = "SELECT 	a.*,DATE(a.regdate) AS tgl_reg
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

}
?>