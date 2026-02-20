<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MCafe extends ci_model 
{
    ///////////////////LIST PASIEN
    function mpasien($set_qry_nmpasien,$set_qry_tglreg,$set_qry_asuransi,$set_qry_dokter,$datetime){
        $query=$this->db->query("SELECT b.name AS nama_pasien,b.birthdate,a.*,c.name AS nama_dokter,d.name AS asuransi FROM trx_reg a 
        LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien  
        LEFT JOIN mst_dokter c ON a.id_dokter_prt1=c.id_dokter
        LEFT JOIN mst_company d ON a.id_asuransi=d.id_company
        WHERE a.iostatus='0' AND DATE_FORMAT(a.regdate,'%Y-%m-%d')='$datetime' $set_qry_nmpasien $set_qry_tglreg $set_qry_asuransi $set_qry_dokter ORDER BY a.regdate DESC LIMIT 100");
        return $query->result();
    }

    function mst_dokter(){
      $query=$this->db->query("SELECT a.id_dokter,CONCAT(a.name,' (',b.name,')') AS name
      FROM 	mst_dokter a
      LEFT JOIN mst_dokter_type b ON (b.id_jenis=a.id_jenis)
      ORDER BY a.name");
      return $query->result();
    }
    function mst_asuransi(){
      $query=$this->db->query("SELECT * FROM mst_company ORDER BY name ASC");
      return $query->result();
    }

    function mpasien_bayar($datetime){
      $query=$this->db->query("SELECT id_reg,SUM(total) AS hargatotal,nama,debit,tunai,kembalian,diskon_rp,diskon_persen FROM cafe_trn_pesanan WHERE DATE_FORMAT(created,'%Y-%m-%d')='$datetime' GROUP BY id_reg ORDER BY created DESC");
      return $query->result();
  }
    ///////////////////END LIST PASIEN

    function ins1($datains,$table){
      $this->db->insert($table,$datains);
    }
    
    	function get_data_inv_header($id_inv)
    {				
		$sql = "SELECT 	*,(SELECT SUM(total)
				FROM cafe_trn_pesanan
				WHERE id_reg='".$id_inv."') AS subtotal
				FROM cafe_trn_pesanan
				WHERE id_reg='".$id_inv."'";
		$query = $this->db->query($sql);
		$result = $query->row();
		return $result;
    }
	
	function get_data_inv_detail($id_inv)
    {	$sql = "SELECT 	*
				FROM cafe_trn_pesanan
				WHERE id_reg='".$id_inv."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
    }
    
    function get_data_kembalian($id){
        $query=$this->db->query("SELECT SUM(total) AS hargatotal,debit,tunai,kembalian,diskon_persen,diskon_rp FROM cafe_trn_pesanan WHERE id_reg='$id'");
        return $query->row();
    }

}