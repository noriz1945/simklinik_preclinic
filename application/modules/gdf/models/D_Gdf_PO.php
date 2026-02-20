<?php
class D_Gdf_PO extends ci_model
{
  ////////////////////////////
  function dlistrpo($tglmulai_set,$tglakhir_set){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang FROM gdf_rpo a 
    LEFT JOIN mst_warehouse b ON a.from=b.id_wrh
    WHERE DATE_FORMAT(a.request_date,'%Y-%m-%d') BETWEEN '$tglmulai_set' AND '$tglakhir_set'
    ORDER BY a.created DESC");
    return $query->result();
  }
  function cdk(){
    $query=$this->db->query("SELECT id_rpo FROM gdf_rpo ORDER BY created DESC limit 1");
    return $query->row();
  }
  function ins1($datains,$table){
    $this->db->insert($table,$datains);
  }

  function ins2($datains2,$table){
    $this->db->insert($table,$datains2);
  }

  function ins3($datains3,$table){
    $this->db->insert($table,$datains3);
  }


  function data_soh_obat($id_obat_set){
    $query=$this->db->query("SELECT a.id_soh,a.id_wrh,a.qty,b.no_rak 
    FROM mst_soh a 
    LEFT JOIN mst_wrh_mm b ON (a.id_wrh=b.id_wrh AND a.id_soh=b.id_fa)  
    WHERE a.id_wrh='001' AND a.id_soh='$id_obat_set'  ");
    return $query->row();
  }

  ///////////////////////
  function detail_obatnya($id_obat){
    $query=$this->db->query("SELECT a.name AS nama_obat, sale_price
    FROM mst_farmalkes a 
    WHERE a.id_fa='$id_obat'");
    return $query->row();
  }
  function list_obat_per_norpo($no_rpo_p){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,a.qty_depo
    FROM gdf_rpo_det a 
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa 
    WHERE a.id_rpo='$no_rpo_p' AND a.hapus='0' AND b.name IS NOT NULL ORDER BY b.name ASC");
    return $query->result();
  }
  function list_obat_per_norpo_edt($no_rpo_p){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,a.qty_last AS qty_soh,a.qty_depo,b.sale_price
    FROM gdf_rpo_det a 
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa 
    WHERE a.id_rpo='$no_rpo_p' AND a.hapus='0' AND b.name IS NOT NULL ORDER BY b.name ASC");
    return $query->result();
  }

  function dlistrpo_edt($no_rpo){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang 
    FROM gdf_rpo a 
    LEFT JOIN mst_warehouse b ON a.from=b.id_wrh
    WHERE a.id_rpo='$no_rpo'");
    return $query->row();
  }

    function check_data_mst_soh($id_obat, $id_wrh){
    $query=$this->db->query("SELECT COUNT(*) AS datafnd FROM mst_soh WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'");
    return $query->row();
  }


  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }

  function data_check_mst_obat($id_obat_set, $id_wrh_set){
    $query=$this->db->query("SELECT a.qty AS qty_depo, b.sale_price,
    (SELECT SUM(anr.qty) AS jumlah_obat_terjual
    FROM soap_eresep_det anr 
    LEFT JOIN trx_reg_inv bnr ON anr.id_inv=bnr.id_inv
    WHERE anr.id_inv IS NOT NULL AND anr.is_racikan='0' AND DATE_FORMAT(bnr.invdate, '%Y-%m-%d') > SUBDATE(CURDATE(),7) AND DATE_FORMAT(bnr.invdate, '%Y-%m-%d') <= CURDATE() AND anr.id_trx_det='$id_obat_set'
    GROUP BY anr.id_trx_det) AS qty_fts,
    (SELECT SUM(arck.qty) AS jumlah_terjual FROM soap_eresep_det_racikan arck
    LEFT JOIN soap_eresep_det brck ON arck.id_eresep_det=brck.id_eresep_det
    LEFT JOIN trx_reg_inv crck ON brck.id_inv=crck.id_inv
    WHERE brck.id_inv IS NOT NULL AND DATE_FORMAT(crck.invdate, '%Y-%m-%d') > SUBDATE(CURDATE(),7) AND DATE_FORMAT(crck.invdate, '%Y-%m-%d') <= CURDATE() AND arck.id_trx_det='$id_obat_set'
    GROUP BY arck.id_trx_det) AS qty_fts_rck
    FROM mst_soh a 
    LEFT JOIN mst_farmalkes b ON b.id_fa=$id_obat_set
    WHERE a.id_soh='$id_obat_set' AND a.id_wrh='$id_wrh_set'");
    return $query->row();
  }

  
  
  //KARTU STOK
  function get_data_obat($id_obat, $id_wrh){
    $query=$this->db->query("SELECT qty FROM mst_soh WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'");
    return $query->row();
  }

  function cdk_kartu_stok(){
    $query=$this->db->query("SELECT id_kode FROM gdf_kartu_stok WHERE kode='STO' ORDER BY created DESC limit 1");
    return $query->row();
  }
  //END KARTU STOK

  //KARTU STOK

  function get_data_pabrik($id_rpo){
    $query=$this->db->query("SELECT a.*,b.name AS nama_pabrik,b.address AS alamat_pabrik 
    FROM gdf_rpo a
    LEFT JOIN mst_pabrik b ON a.id_pabrik=b.id_pabrik 
    WHERE a.id_rpo='$id_rpo'");
    return $query->row();
  }

  function get_data_sp($id_rpo){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,a.qty_last AS qty_soh,a.qty_depo,b.sale_price,c.name AS nama_satuan,a.qty AS qty_req
    FROM gdf_rpo_det a 
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa 
    LEFT JOIN mst_farmalkes_unit c ON b.id_satuan=c.id_satuan
    WHERE a.id_rpo='$id_rpo' AND a.hapus='0' AND b.name IS NOT NULL ORDER BY b.name ASC");
    return $query->result();
  }
} 
?>