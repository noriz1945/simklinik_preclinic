<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pendapatan_model extends CI_Model
{

    public $table = 'trx_reg_dp';
		
    public $id = 'id_trx';    
		public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

		
	function get_data_dp_all($periode_start,$periode_end)
	{				
		$sql = "SELECT nama_produk,SUM(jumlah) AS qty,harga,SUM(total) AS totalharga FROM  cafe_trn_pesanan WHERE DATE(created) BETWEEN '".$periode_start."' AND '".$periode_end."' GROUP BY id_produk ORDER BY created DESC LIMIT 10000";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
}
