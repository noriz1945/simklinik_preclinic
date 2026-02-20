<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mst_pasien_model extends CI_Model
{

    public $table = 'mst_pasien';
		
    public $id = 'id_pasien';    
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
				
				$sql = "SELECT * FROM ".$this->table."
        ORDER BY CAST(".$this->id." AS UNSIGNED) DESC
        LIMIT 50"; 
				$query = $this->db->query($sql);
				$result = $query->result();
				return $result;
    }

    // get data by id
    function get_by_id($id)
    {
        #$this->db->where($this->id, $id);
        #return $this->db->get($this->table)->row();
				
				$sql = "SELECT 	a.* 
								,e.`name` AS kelurahan,f.name AS kecamatan,g.name AS kota,h.name AS propinsi
						FROM 	".$this->table." a
								LEFT JOIN `mst_kelurahan` e ON (e.`id_kelurahan`=a.`id_kelurahan`)
								LEFT JOIN `mst_kecamatan` f ON (f.`id_kecamatan`=a.`id_kecamatan`)
								LEFT JOIN `mst_kota` g ON (g.`id_kota`=a.`id_kota`)
								LEFT JOIN `mst_propinsi` h ON (h.`id_propinsi` =a.`id_propinsi`)
						WHERE	a.".$this->id."='".$id."'
						";
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
					WHERE is_rm_aps=0 
					";
				if($q!=NULL)
				{
					$sql .= "AND ( ";
					$sql .= "LOWER(id_pasien) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(name) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(birthdate) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(address) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(address_em) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(telp) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(hp) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(email) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(nik) LIKE LOWER('%".$q."%') ";
					$sql .= " )";
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
        $sql = "SELECT 	a.*,b.`name` AS status_pernikahan,c.`name` AS pekerjaan,d.`name` AS asuransi
						,e.`name` AS kelurahan,f.name AS kecamatan,g.name AS kota,h.name AS propinsi
				FROM 	mst_pasien a
						LEFT JOIN `mst_pasien_mar` b ON (b.`id_mar`=a.`id_mar`)
						LEFT JOIN `mst_pasien_job` c ON (c.`id_job`=a.`id_job`)
						LEFT JOIN `mst_company` d ON (d.`id_company`=a.`asm_comp`)
						LEFT JOIN `mst_kelurahan` e ON (e.`id_kelurahan`=a.`id_kelurahan`)
						LEFT JOIN `mst_kecamatan` f ON (f.`id_kecamatan`=a.`id_kecamatan`)
						LEFT JOIN `mst_kota` g ON (g.`id_kota`=a.`id_kota`)
						LEFT JOIN `mst_propinsi` h ON (h.`id_propinsi` =a.`id_propinsi`)
						WHERE is_rm_aps=0
								";
				if($q!=NULL)
				{
					$sql .= "AND ( ";
					$sql .= "LOWER(a.id_pasien) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(a.name) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(a.birthdate) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(a.address) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(a.telp) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(a.hp) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(a.email) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(a.nik) LIKE LOWER('%".$q."%') ";
					$sql .= " )";
				}
				// Urutkan dari yang terbaru dibuat; fallback ke ID jika created null
				$sql .= " ORDER BY (a.created IS NULL) ASC, a.created DESC, CAST(a.id_pasien AS UNSIGNED) DESC LIMIT ".$start.",".$limit."";
				$query = $this->db->query($sql);
				$result = $query->result();
				return $result;
	}			

    // Optimized: fetch base IDs ordered/limited, then join to enrich
    function get_limit_data_fast($limit=NULL, $start = 0, $q = NULL) {
        if ($limit === NULL) { $limit = 100; }
        if ($start < 0) { $start = 0; }

        $where = "a.is_rm_aps=0";
        if ($q != NULL) {
            $q = trim($q);
            $where .= " AND (".
                "LOWER(a.id_pasien) LIKE LOWER('%".$q."%') OR ".
                "LOWER(a.name) LIKE LOWER('%".$q."%') OR ".
                "LOWER(a.birthdate) LIKE LOWER('%".$q."%') OR ".
                "LOWER(a.address) LIKE LOWER('%".$q."%') OR ".
                "LOWER(a.telp) LIKE LOWER('%".$q."%') OR ".
                "LOWER(a.hp) LIKE LOWER('%".$q."%') OR ".
                "LOWER(a.email) LIKE LOWER('%".$q."%') OR ".
                "LOWER(a.nik) LIKE LOWER('%".$q."%')".
            ")";
        }

        $inner = "SELECT a.* FROM ".$this->table." a ".
                 "WHERE $where ".
                 "ORDER BY (a.id_pasien IS NULL) ASC, a.id_pasien DESC, CAST(a.id_pasien AS UNSIGNED) DESC ".
                 "LIMIT ".$start.",".$limit;

        $sql = "SELECT 
                    a.*, 
                    b.name AS status_pernikahan,
                    c.name AS pekerjaan,
                    d.name AS asuransi,
                    e.name AS kelurahan,
                    f.name AS kecamatan,
                    g.name AS kota,
                    h.name AS propinsi
                FROM ($inner) a
                LEFT JOIN mst_pasien_mar b ON b.id_mar = a.id_mar
                LEFT JOIN mst_pasien_job c ON c.id_job = a.id_job
                LEFT JOIN mst_company d ON d.id_company = a.asm_comp
                LEFT JOIN mst_kelurahan e ON e.id_kelurahan = a.id_kelurahan
                LEFT JOIN mst_kecamatan f ON f.id_kecamatan = a.id_kecamatan
                LEFT JOIN mst_kota g ON g.id_kota = a.id_kota
                LEFT JOIN mst_propinsi h ON h.id_propinsi = a.id_propinsi";

        $query = $this->db->query($sql);
        return $query->result();
    }
	
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
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

}

/* End of file Mst_pasien_model.php */
/* Location: ./application/models/Mst_pasien_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-11-22 21:22:29 */
/* http://harviacode.com */
