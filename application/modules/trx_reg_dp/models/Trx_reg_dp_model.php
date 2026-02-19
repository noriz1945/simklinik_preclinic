<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_reg_dp_model extends CI_Model
{

    public $table = 'trx_reg_dp';
		
    public $id = 'id_trx';    
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
	
	function get_by_id_reg($id_reg)
    {				
		$sql = "SELECT 	a.*,b.nama_bank 
				FROM 	trx_reg_dp a
						LEFT JOIN mst_bank b ON (b.id_bank=a.id_bank1)
				WHERE	a.id_reg='".$id_reg."'
				ORDER BY a.id_trx ";
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
					$sql .= "OR LOWER(id_pasien) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_reg) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(trxdate) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_cctype1) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_bank1) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(nocc1) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(total_cc1) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_cctype2) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_bank2) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(nocc2) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(total_cc2) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(total_cash) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(total) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(ret) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_reg_csr) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_cfb) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(jnl_post) LIKE LOWER('%".$q."%') ";
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
        $sql = "SELECT 	a.id_pasien,b.name AS nama_pasien,a.id_reg,a.regdate,c.`name` AS dokter,d.`name` AS asuransi
						,SUM(e.total) AS total
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
						LEFT JOIN trx_reg_dp e ON (e.id_reg=a.id_reg)
				WHERE	a.is_reg_aps=0
						";
		if($q!=NULL)
		{
			$sql .= "AND (";
			$sql .= "LOWER(a.id_pasien) LIKE LOWER('%".$q."%') ";
			$sql .= "OR LOWER(a.id_reg) LIKE LOWER('%".$q."%') ";
			$sql .= "OR LOWER(b.name) LIKE LOWER('%".$q."%') ";
			$sql .= ")";
		}
		$sql .= " 	GROUP BY a.id_pasien,b.name,a.id_reg,a.regdate,c.`name`,d.`name`
					ORDER BY a.regdate DESC LIMIT 100";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
    // insert data
    function insert($table,$data)
    {
        $this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
	
	function get_data_reg($id_reg)
    {				
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
						,(SELECT 1 FROM trx_reg_inv x WHERE x.id_reg='".$id_reg."' LIMIT 1) AS ada_inv
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
				WHERE a.id_reg='".$id_reg."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }
	
	function get_data_dp($id_trx)
    {				
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
						,e.*
				FROM	trx_reg a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
						JOIN trx_reg_dp e ON (e.`id_reg`=a.`id_reg`)
				WHERE e.id_trx='".$id_trx."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }
		
	function get_data_dp_all($periode_start,$periode_end)
	{				
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
										,e.*,f.nama_bank
										,(SELECT 1 FROM trx_reg_inv x WHERE x.id_reg=a.id_reg LIMIT 1) AS ada_inv
						FROM	trx_reg a
									LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
									LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
									LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
									JOIN trx_reg_dp e ON (e.`id_reg`=a.`id_reg`)
									LEFT JOIN mst_bank f ON (f.id_bank=e.id_bank1)
						WHERE DATE(e.trxdate) BETWEEN '".$periode_start."' AND '".$periode_end."'
						ORDER BY e.trxdate DESC
						LIMIT 10000
						";
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
}
