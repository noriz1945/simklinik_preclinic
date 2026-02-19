<?php
class D_Gdf extends ci_model
{
  ////////////////////////////
  function dlisttfo($tglmulai_set,$tglakhir_set){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang FROM gdf_tfo a 
    LEFT JOIN mst_warehouse b ON a.to=b.id_wrh
    WHERE DATE_FORMAT(a.request_date,'%Y-%m-%d') BETWEEN '$tglmulai_set' AND '$tglakhir_set'
    ORDER BY a.created DESC");
    return $query->result();
  }
  function cdk(){
    $query=$this->db->query("SELECT id_tfo FROM gdf_tfo ORDER BY created DESC limit 1");
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
    $query=$this->db->query("SELECT a.id_soh,a.id_wrh,a.qty,b.no_rak FROM mst_soh a LEFT JOIN mst_wrh_mm b ON (a.id_wrh=b.id_wrh AND a.id_soh=b.id_fa)  WHERE a.id_wrh='001' AND a.id_soh='$id_obat_set'  ");
    return $query->row();
  }

  ///////////////////////
  function detail_obatnya($id_obat){
    $query=$this->db->query("SELECT a.name AS nama_obat, sale_price
    FROM mst_farmalkes a 
    WHERE a.id_fa='$id_obat'");
    return $query->row();
  }
  function list_obat_per_notfo($no_tfo_p){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,a.qty_last AS qty_soh,a.qty_depo FROM gdf_tfo_det a 
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa 
    WHERE a.id_tfo='$no_tfo_p' AND a.hapus='0' AND b.name IS NOT NULL ORDER BY b.name ASC");
    return $query->result();
  }
  function list_obat_per_notfo_edt($no_tfo_p){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,a.qty_last AS qty_soh,a.qty_depo FROM gdf_tfo_det a 
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa 
    WHERE a.id_tfo='$no_tfo_p' AND a.hapus='0' AND b.name IS NOT NULL ORDER BY b.name ASC");
    return $query->result();
  }

  function dlisttfo_edt($no_tfo){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang 
    FROM gdf_tfo a 
    LEFT JOIN mst_warehouse b ON a.to=b.id_wrh
    WHERE a.id_tfo='$no_tfo'");
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
    $query=$this->db->query("SELECT qty AS qty_depo FROM mst_soh WHERE id_soh='$id_obat_set' AND id_wrh='$id_wrh_set'");
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
} 
?>