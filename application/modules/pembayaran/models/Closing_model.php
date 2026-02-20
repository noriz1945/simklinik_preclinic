<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Closing_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_list_bank_aktif()
	{
		$sql = "SELECT id_bank, nama_bank FROM mst_bank WHERE is_aktif=1 ORDER BY nama_bank";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_data_inv($id_opening)
	{
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
						,e.*
						,f.`nama_bank` AS nama_bank1
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
						JOIN trx_reg_inv e ON (e.`id_reg`=a.`id_reg`)
						LEFT JOIN mst_bank f ON (f.`id_bank`=e.`id_bank1`)
				WHERE e.id_opening='" . $id_opening . "'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function get_data_inv_refund($id_opening)
	{
		$sql = "SELECT 	f.*,f.asuransi as refund_asuransi,f.creator as creator_refund,a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
						,e.id_inv
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
						JOIN trx_reg_inv e ON (e.`id_reg`=a.`id_reg`)
						JOIN trx_reg_inv_refund f ON (f.id_inv=e.id_inv)
				WHERE f.id_opening='" . $id_opening . "'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function get_data_dp($id_opening)
	{
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
						,e.*
						,f.`nama_bank` AS nama_bank1
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
						JOIN trx_reg_dp e ON (e.`id_reg`=a.`id_reg`)
						LEFT JOIN mst_bank f ON (f.`id_bank`=e.`id_bank1`)
				WHERE e.id_opening='" . $id_opening . "'
						AND e.id_inv IS NULL
						AND e.ret=0";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function get_data_dp_refund($id_opening)
	{
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
						,e.*
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
						JOIN trx_reg_dp e ON (e.`id_reg`=a.`id_reg`)
				WHERE e.id_opening='" . $id_opening . "'
						AND e.id_inv IS NULL
						AND e.ret=1";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	// insert data
	function insert($table, $data)
	{
		$this->db->insert($table, $data);
	}

	function update($table, $where_id, $id, $data)
	{
		$this->db->where($where_id, $id);
		$this->db->update($table, $data);
	}

	function data_list_closing_kasir($periode_start, $periode_end, $login_kasir = "")
	{
		$login_name = $this->session->userdata['sp']->username;
		$sql = "SELECT 	a.* 
				FROM 	trx_opening_kasir a 
				WHERE	DATE(a.`opening_time`) BETWEEN '" . $periode_start . "' AND '" . $periode_end . "'
						-- AND a.closing_time IS NOT NULL 
				ORDER BY a.opening_time DESC
				LIMIT 60";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$jumdata = $query->num_rows();
		if ($jumdata >= 1)
			$row = $query->result();
		else
			$row = array();

		return $row;
	}

	function data_closing_kasir($id_opening)
	{
		$login_name = $this->session->userdata['sp']->username;
		$sql = "SELECT 	a.* 
				FROM 	trx_opening_kasir a 
				WHERE	a.id_opening='" . $id_opening . "'
				";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$row = $query->row_array();

		return $row;
	}

}
?>