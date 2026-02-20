<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trx_reg_model extends CI_Model
{

    public $table = 'trx_reg_book';
	public $table_reg = 'trx_reg';
		
    public $id = 'id_reg';    
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

    // get data by id_reg
    function get_by_id($id_reg)
    {				
		$sql = "SELECT 	a.*,b.*,c.`name` AS dokter,d.`name` AS asuransi
				FROM	trx_reg_book a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
				WHERE a.id_reg='".$id_reg."'";
		$query = $this->db->query($sql);
		$result = $query->row();
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
					$sql .= "OR LOWER(regdate) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_pasien) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_dokter_krm) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_dokter_prt1) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_dokter_prt2) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_dokter_jaga) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_icd) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(diag) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_asuransi) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_company) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_provider) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_pod) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(status) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(mrstat) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(rwjn) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(rwip) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(ugd) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(note) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(penanggung) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_rujukan) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(person_rjk) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(confirmby) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(confirmdate) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(card_id) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(card_name) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(card_comp) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(card_fam) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(card_rjk) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(lab) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(rad) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(farm) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(fisio) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(total_dp) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_kamar) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_bed) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_kelas) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(iostatus) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(cash) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(is_odc) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(is_kpri) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_paket) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_trx_paket) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(paket_aktif) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(paket_selesai) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_kelaspkt) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(mrstatend_igd) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(mrstatend_rwip) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(mrstatdcs) LIKE LOWER('%".$q."%') ";
						$sql .= "OR LOWER(id_mod) LIKE LOWER('%".$q."%') ";
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
        $sql = "SELECT 	a.*,b.*,b.name AS nama_pasien,c.`name` AS dokter,d.`name` AS asuransi
				FROM	trx_reg_book a
						LEFT JOIN mst_pasien b ON (b.`id_pasien`=a.`id_pasien`)
						LEFT JOIN mst_dokter c ON (c.`id_dokter`=a.`id_dokter_prt1`)
						LEFT JOIN mst_company d ON (d.`id_company`=a.`id_asuransi`)
				";
				if($q!=NULL)
				{
					$sql .= " WHERE FALSE ";
					
					$sql .= "OR LOWER(a.id_pasien) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(b.`name`) LIKE LOWER('%".$q."%') ";
					$sql .= "OR LOWER(a.id_reg) LIKE LOWER('%".$q."%') ";
					}
				$sql .= " ORDER BY a.regdate DESC LIMIT ".$start.",".$limit."";
				$query = $this->db->query($sql);
				$result = $query->result();
				return $result;
	}
	
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

	function insert_checkin($data)
    {
        $this->db->insert($this->table_reg, $data);
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
	
	function get_last_pasien($limit=100,$id_dokter,$tgl_slot,$id_pasien="",$nama="",$nik="",$birthdate="") {
        #$this->db->order_by($this->id, $this->order);
        $sql = "SELECT 	mp.*
						,IF(mp.birthdate='0000-00-00 00:00:00','',DATE(mp.birthdate)) AS tgl_lahir
						,a.id_kelurahan AS idx,a.`name` AS kelurahan
						,b.`id_kecamatan`,b.`name` AS kecamatan
						,c.`id_kota`,c.`name` AS kota
						,d.`id_propinsi`,d.`name` AS propinsi,trb.sudah_checkin
				FROM 	mst_pasien mp
						LEFT JOIN mst_kelurahan a ON (a.`id_kelurahan`=mp.`id_kelurahan`)
						LEFT JOIN `mst_kecamatan` b ON (b.`id_kecamatan`=a.`id_kecamatan`)
						LEFT JOIN `mst_kota` c ON (c.`id_kota`=b.`id_kota`)
						LEFT JOIN `mst_propinsi` d ON (d.`id_propinsi` =c.`id_propinsi`)
						LEFT JOIN trx_reg_book trb ON (mp.id_pasien=trb.id_pasien AND trb.id_dokter='$id_dokter' AND trb.tanggal='$tgl_slot')
				WHERE 	mp.is_rm_aps=0 
				";
		if($id_pasien!='')
			$sql .= "AND mp.id_pasien='".$id_pasien."' 
					";
		if($nama!='')
			$sql .= "AND UPPER(mp.name) LIKE '%".strtoupper($nama)."%'
					";
		if($nik!='')
			$sql .= "AND mp.nik='".$nik."'
					";
		if($birthdate!='')
			$sql .= "AND mp.birthdate='".$birthdate."'
					";
		$sql .= " ORDER BY mp.id_pasien DESC LIMIT ".$limit;
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	
	// get data with limit and search
	
	function get_pasien_by_id($id_pasien)
    {
		$sql = "SELECT 	a.* 
				FROM 	mst_pasien a
				WHERE	a.id_pasien='".$id_pasien."'
				";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }
	
	function get_new_id_reg()
    {
		$sql = "SELECT CONCAT(a.`pmonth`,DATE_FORMAT(now(), '%y'),'BM',LPAD((a.`ctr`+1),5,'0')) AS new_id_reg
				FROM 	ctr_reg a 
				WHERE 	a.`pyear`=YEAR(CURDATE()) AND a.`pmonth`=MONTH(CURDATE())";
		$query = $this->db->query($sql);
		$result = $query->row();
		$new_id_reg = $result->new_id_reg;
		
		$sql = "UPDATE ctr_reg SET ctr=ctr+1 WHERE `pyear`=YEAR(CURDATE()) AND `pmonth`=MONTH(CURDATE()) ";
		$query = $this->db->query($sql);
		
		return $new_id_reg;
    }
	
	// insert data




	////get pasien checkin
	function get_checkin_pasien($limit=100,$id_pasien="",$nama="",$nik="",$birthdate="") {
        #$this->db->order_by($this->id, $this->order);
        $sql = "SELECT 	mp.*
						,IF(mp.birthdate='0000-00-00 00:00:00','',DATE(mp.birthdate)) AS tgl_lahir
						,a.id_kelurahan AS idx,a.`name` AS kelurahan
						,b.`id_kecamatan`,b.`name` AS kecamatan
						,c.`id_kota`,c.`name` AS kota
						,d.`id_propinsi`,d.`name` AS propinsi
				FROM 	trx_reg_book trx
						LEFT JOIN mst_pasien mp ON (mp.`id_pasien`=trx.`id_pasien`)
						LEFT JOIN mst_kelurahan a ON (a.`id_kelurahan`=mp.`id_kelurahan`)
						LEFT JOIN `mst_kecamatan` b ON (b.`id_kecamatan`=a.`id_kecamatan`)
						LEFT JOIN `mst_kota` c ON (c.`id_kota`=b.`id_kota`)
						LEFT JOIN `mst_propinsi` d ON (d.`id_propinsi` =c.`id_propinsi`)
				WHERE 	mp.is_rm_aps=0
				";
		if($id_pasien!='')
			$sql .= "AND mp.id_pasien='".$id_pasien."' 
					";
		if($nama!='')
			$sql .= "AND UPPER(mp.name) LIKE '%".strtoupper($nama)."%'
					";
		if($nik!='')
			$sql .= "AND mp.nik='".$nik."'
					";
		if($birthdate!='')
			$sql .= "AND mp.birthdate='".$birthdate."'
					";
		$sql .= " ORDER BY mp.id_pasien DESC LIMIT ".$limit;
		#echo "<pre>".$sql."</pre>";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}
	////end get pasien checkin

	function update_trx_book($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	  }
}
