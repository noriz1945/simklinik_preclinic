<?php
class D_Gdf_purchase_order_closing extends ci_model
{
  ////////////////////////////
  function dlistrpo($tglmulai_set,$tglakhir_set){
    $query=$this->db->query("SELECT a.* FROM gdf_purchase_order a 
    WHERE DATE_FORMAT(a.tanggal,'%Y-%m-%d') BETWEEN '$tglmulai_set' AND '$tglakhir_set' AND a.status='0'
    ORDER BY a.created DESC");
    return $query->result();
  }

  function ins1($datains,$table){
    $this->db->insert($table,$datains);
  }

  function ins2($datains2,$table){
    $this->db->insert($table,$datains2);
  }

  ///////////////////////
  
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

  function detail_closing($id){
    $query=$this->db->query("SELECT *
    FROM gdf_purchase_order_det a 
    WHERE a.id_proses_penerimaan='$id'");
    return $query->result_array();
  }

  function list_detail_closing($id_por){
    $query=$this->db->query("SELECT a.id_proses_penerimaan,a.no_spb,a.tgl_spb,a.no_faktur,a.tgl_faktur,a.no_surat_jalan,a.status
    FROM gdf_purchase_order_det a 
    WHERE a.id_purchase_order='$id_por' AND a.status IN('1','3')
    GROUP BY a.id_proses_penerimaan");
    return $query->result_array();
  }


  function cdk_kartu_stok(){
    $query=$this->db->query("SELECT id_kode FROM gdf_kartu_stok WHERE kode='SPB' ORDER BY created DESC limit 1");
    return $query->row();
  }
  function proses_soh($id_proses_penerimaan){ 
    $query=$this->db->query("SELECT b.pabrik AS nama_supplier,a.*
    FROM gdf_purchase_order_det a 
    LEFT JOIN gdf_purchase_order b ON a.id_purchase_order=b.id_purchase_order
    WHERE a.id_proses_penerimaan='$id_proses_penerimaan'");
    return $query->result(); 
  }
  function get_data_obat($id_obat, $id_wrh){
    $query=$this->db->query("SELECT qty FROM mst_soh WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'");
    return $query->row();
  }
    

  function get_data_count($nosto){
    $query=$this->db->query("SELECT COUNT(DISTINCT id_proses_penerimaan) AS fnddata FROM gdf_purchase_order_det WHERE id_purchase_order='$nosto' AND status='1'");
    return $query->row();
  }

} 
?>