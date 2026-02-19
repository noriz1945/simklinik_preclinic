<?php
class D_Gdf_purchase_order_penerimaan extends ci_model
{
  ////////////////////////////
  function dlistrpo($tglmulai_set,$tglakhir_set){
    $query=$this->db->query("SELECT a.* FROM gdf_purchase_order a 
    WHERE DATE_FORMAT(a.tanggal,'%Y-%m-%d') BETWEEN '$tglmulai_set' AND '$tglakhir_set' AND a.status='0'
    ORDER BY a.created DESC");
    return $query->result();
  }
  function cdk(){
    $query=$this->db->query("SELECT id_purchase_order FROM gdf_purchase_order ORDER BY created DESC limit 1");
    return $query->row();
  }

  function cdk_penerimaan(){
    $query=$this->db->query("SELECT id_proses_penerimaan FROM gdf_purchase_order_det ORDER BY created DESC limit 1");
    return $query->row();
  }
  function ins1($datains,$table){
    $this->db->insert($table,$datains);
  }

  ///////////////////////
  function list_obat_per_norpo_edt($no_rpo_p){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,a.qty_last AS qty_soh,b.sale_price,b.konversi,c.name AS satuan FROM gdf_rpo_det a 
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa
    LEFT JOIN mst_farmalkes_unit c ON b.id_satuan=c.id_satuan
    WHERE a.id_rpo='$no_rpo_p' AND a.hapus='0' AND b.name IS NOT NULL ORDER BY b.name ASC");
    return $query->result();
  }

  function dlistrpo_edt($no_rpo){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang,c.*
    FROM gdf_rpo a 
    LEFT JOIN mst_warehouse b ON a.from=b.id_wrh
    LEFT JOIN gdf_purchase_order c ON a.id_rpo=c.id_request_order
    WHERE a.id_rpo='$no_rpo'");
    return $query->row();
  }

  function ppn_set(){
    $query=$this->db->query("SELECT a.ppn FROM mst_markup_harga a");
    return $query->row();
  }


  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }

  function detail_penerimaan_barang($id_rpo, $id_por){
  $query=$this->db->query("SELECT a.id,a.id_obat, b.name AS nama_obat, a.qty_aprv, c.name AS nama_kemasan,b.konversi AS jumlah_satuan, d.name AS nama_satuan, 
  ( SELECT SUM(jumlah_diterima) FROM gdf_purchase_order_det WHERE id_obat=a.id_obat AND id_purchase_order='$id_por') AS jumlah_diterima
  ,a.harga_satuan,a.total_harga
  FROM gdf_rpo_det a 
  LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa
  LEFT JOIN mst_farmalkes_unit c ON b.id_satuan=c.id_satuan
  LEFT JOIN mst_farmalkes_type d ON b.id_type=d.id_jenis
  WHERE a.id_rpo='$id_rpo' AND a.status='1' AND a.hapus='0'");
    return $query->result_array();
  }

  function detail_penerimaan_barang_cancel($id_rpo, $id_por){
    $query=$this->db->query("SELECT a.id,a.id_obat, b.name AS nama_obat, a.qty_aprv, c.name AS nama_kemasan,b.konversi AS jumlah_satuan, d.name AS nama_satuan, 
    ( SELECT SUM(jumlah_diterima) FROM gdf_purchase_order_det WHERE id_obat=a.id_obat AND id_purchase_order='$id_por') AS jumlah_diterima
    ,a.harga_satuan,a.total_harga,a.qty_diterima AS jumlahset
    FROM gdf_rpo_det a 
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa
    LEFT JOIN mst_farmalkes_unit c ON b.id_satuan=c.id_satuan
    LEFT JOIN mst_farmalkes_type d ON b.id_type=d.id_jenis
    WHERE a.id_rpo='$id_rpo' AND a.status='3' AND a.hapus='0'");
      return $query->result_array();
    }

  function cdk_check_por($id){
    $query=$this->db->query("SELECT COUNT(id_det_request) AS fnddata FROM gdf_purchase_order_det WHERE id_det_request='$id'");
    return $query->row();
  }

  function last_jumlah_diterima($id){
    $query=$this->db->query("SELECT qty_diterima FROM gdf_rpo_det WHERE id='$id'  ");
    return $query->row();
  }

} 
?>