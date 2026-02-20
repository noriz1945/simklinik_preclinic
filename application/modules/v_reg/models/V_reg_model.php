<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V_reg_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_limit_data($periode_start, $periode_end, $id_dokter = '', $limit = 10000)
    {
        // normalisasi input dokter
        $id_dokter = trim((string)$id_dokter);
    
        $sql = "
            SELECT  a.*, DATE(a.regdate) AS tgl_reg
            FROM    v_reg a
            WHERE   DATE(a.regdate) BETWEEN '".$periode_start."' AND '".$periode_end."'
        ";
    
        // filter dokter hanya jika benar-benar dipilih
        if ($id_dokter !== '' && $id_dokter !== '0') {
            $sql .= " AND a.id_dokter_prt1 = '".$this->db->escape_str($id_dokter)."'";
        }
    
        $sql .= "
            ORDER BY a.regdate
            LIMIT ".(int)$limit."
        ";
    
        return $this->db->query($sql)->result();
    }



}
?>