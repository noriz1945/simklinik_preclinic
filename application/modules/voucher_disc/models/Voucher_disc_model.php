<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voucher_disc_model extends CI_Model
{

    public $table = 'mst_vcr_disc';
		
    public $id = 'id_vcr';    
		public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        #$this->db->order_by($this->id, $this->order);
        #return $this->db->get($this->table)->result();
				
				$sql = "SELECT * FROM ".$this->table." ORDER BY ".$this->id." ".$this->order."";
				$query = $this->db->query($sql);
				$result = $query->result();
				return $result;
    }

    // get data by id
    function get_by_id($id)
    {
        #$this->db->where($this->id, $id);
        #return $this->db->get($this->table)->row();
				
				$sql = "SELECT 	* 
								FROM 		".$this->table." 
								WHERE		".$this->id."='".$id."'
								ORDER BY ".$this->id." ".$this->order."";
				$query = $this->db->query($sql);
				$result = $query->result();
				$result = $result[0];
				return $result;
    }
    
    // get total rows
    function total_rows($q = NULL) 
		{
			$sql = "SELECT 	* 
								FROM 		".$this->table."
								";
				if($q!=NULL)
				{
					$sql .= " WHERE FALSE ";
					$sql .= "OR LOWER(is_aktif) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(kode_vcr) LIKE LOWER('%".$q."%') ";
						}
				$sql = "SELECT COUNT(*) as total_rows FROM (".$sql.") abc";
				$query = $this->db->query($sql);
				$result = $query->result();
				$total_rows = $result[0]->total_rows;
				return $total_rows;
	}
	
    // get data with limit and search
    function get_limit_data($limit=NULL, $start = 0, $q = NULL) {
        #$this->db->order_by($this->id, $this->order);
        $sql = "SELECT 	* 
								FROM 		".$this->table."
								";
				if($q!=NULL)
				{
					$sql .= " WHERE FALSE ";
					$sql .= "OR LOWER(is_aktif) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(kode_vcr) LIKE LOWER('%".$q."%') ";
					}
				$sql .= " ORDER BY ".$this->id." ".$this->order." LIMIT ".$start.",".$limit."";
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

    // delete data
    function delete($table,$column,$id)
    {
        $this->db->where($column, $id);
        $this->db->delete($table);
    }
	
	function data_mst_vcr_disc($id_vcr)
	{
		$sql = "SELECT 	a.* 
				FROM 	mst_vcr_disc a 
				WHERE 	a.`id_vcr`='".$id_vcr."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
	
	function data_mst_vcr_disc_det($id_vcr,$is_farmasi="")
	{
		$sql = "SELECT 	b.* 
				FROM 	mst_vcr_disc_det b 
				WHERE 	b.`id_vcr`='".$id_vcr."'
						";
		if($is_farmasi!="")
		{
			$sql .= " AND b.is_farmasi='".$is_farmasi."'";
		}
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function data_trx_vcr_disc_by_id_vcr($id_vcr)
	{
		$sql = "SELECT 	a.* 
				FROM 	trx_vcr_disc a 
				WHERE 	a.`id_vcr`='".$id_vcr."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function data_trx_vcr_disc_by_kode_vcr($kode_vcr)
	{
		$sql = "SELECT 	a.* 
				FROM 	trx_vcr_disc a 
				WHERE 	a.`kode_vcr`='".$kode_vcr."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
	
	function data_trx_vcr_disc($id_tvd)
	{
		$sql = "SELECT 	a.* 
				FROM 	trx_vcr_disc a 
				WHERE 	a.`id_tvd`='".$id_tvd."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function data_trx_vcr_disc_det($id_tvd)
	{
		$sql = "SELECT 	b.* 
				FROM 	trx_vcr_disc_det b
				WHERE 	b.`id_tvd`='".$id_tvd."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	function data_trx_vcr_disc_by_kode_vcr_avail($kode_vcr)
	{
		$sql = "SELECT 	a.* 
				FROM 	trx_vcr_disc a 
				WHERE 	a.`kode_vcr`='".$kode_vcr."' AND a.is_used=0";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
	}
}

?>