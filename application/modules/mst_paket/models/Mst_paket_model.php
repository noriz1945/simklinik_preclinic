<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_paket_model extends CI_Model
{

    public $table = 'mst_paket';
		
    public $id = 'id_paket';    
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
    function get_mst_paket_by_id($id)
    {
		$sql = "SELECT 	* 
				FROM 	".$this->table." 
				WHERE	".$this->id."='".$id."'
				ORDER BY ".$this->id."";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }
	
	function get_mst_paket_det_by_id($id)
    {
		$sql = "SELECT 	a.*
						,IF(a.`id_group`=1,b.`name`,c.`name`) AS id_trx_det_txt
				FROM 	mst_paket_det a
						LEFT JOIN mst_tindakan b ON (b.`id_act`=a.`id_trx_det`)
						LEFT JOIN mst_farmalkes c ON (c.`id_fa`=a.`id_trx_det`)
				WHERE	a.id_paket='".$id."'
				ORDER BY a.id_group,a.no_kunj,b.id_group,b.id_subgroup";
		$query = $this->db->query($sql);
		$result = $query->result();
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
					$sql .= "OR LOWER(name) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_type) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(duration) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(price) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(aktif) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(created) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(creator) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(updated) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(updater) LIKE LOWER('%".$q."%') ";
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
					$sql .= "OR LOWER(name) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(id_type) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(duration) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(price) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(aktif) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(created) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(creator) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(updated) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(updater) LIKE LOWER('%".$q."%') ";
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
	
	 function get_main_setting_value($field)
    {
		$sql = "SELECT 	a.".$field."
				FROM 	mst_main_setting a
				";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$return = $row[$field];
		return $return;
    }
	
	function data_paket_reg($id_reg)
    {
		$sql = "SELECT 	a.*
				FROM 	trx_reg_paket a
				WHERE	a.id_reg='".$id_reg."'
				";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
	
	function check_id_paket_reg($id_reg,$id_paket)
    {
		$sql = "SELECT 	a.id_reg,a.id_paket
				FROM 	trx_reg_paket a
				WHERE	a.id_reg='".$id_reg."' AND a.id_paket='".$id_paket."'
				";
		$query = $this->db->query($sql);
		$row = $query->row();
		$id_paket = @$row->id_paket;
		return $id_paket;
    }
	
}

