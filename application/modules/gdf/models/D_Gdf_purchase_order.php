<?php
class D_Gdf_purchase_order extends ci_model
{
  ////////////////////////////
  function dlistrpo($tglmulai_set,$tglakhir_set){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang FROM gdf_rpo a 
    LEFT JOIN mst_warehouse b ON a.from=b.id_wrh
    WHERE DATE_FORMAT(a.request_date,'%Y-%m-%d') BETWEEN '$tglmulai_set' AND '$tglakhir_set' -- AND a.status='2'
    ORDER BY a.created DESC");
    return $query->result();
  }
  function cdk(){
    $query=$this->db->query("SELECT id_purchase_order FROM gdf_purchase_order ORDER BY created DESC limit 1");
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




  ///////////////////////

  function list_obat_per_norpo($no_rpo_p, $id_wrh_set){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,a.qty_last AS qty_soh,c.qty AS qty_depo,d.closedate,b.konversi,e.name AS satuan
    FROM gdf_rpo_det a
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa
    LEFT JOIN mst_soh c ON (a.id_obat=c.id_soh AND c.id_wrh='$id_wrh_set')
    LEFT JOIN gdf_rpo d ON a.id_rpo=d.id_rpo
    LEFT JOIN mst_farmalkes_unit e ON b.id_satuan=e.id_satuan
    WHERE a.id_rpo='$no_rpo_p' AND a.hapus='0' AND b.name IS NOT NULL ORDER BY b.name ASC");
    return $query->result();
  }

  function list_obat_per_norpo_depo($no_rpo_p, $id_wrh_set){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,a.qty_last AS qty_soh,a.qty_depo AS qty_depo,d.closedate
    FROM gdf_rpo_det a
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa
    LEFT JOIN mst_soh c ON (a.id_obat=c.id_soh AND c.id_wrh='$id_wrh_set')
    LEFT JOIN gdf_rpo d ON a.id_rpo=d.id_rpo
    WHERE a.id_rpo='$no_rpo_p' AND a.hapus='0' AND b.name IS NOT NULL ORDER BY b.name ASC");
    return $query->result();
  }
  function list_obat_per_norpo_edt($no_rpo_p){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,a.qty_last AS qty_soh,b.sale_price,b.konversi,c.name AS satuan FROM gdf_rpo_det a 
    LEFT JOIN mst_farmalkes b ON a.id_obat=b.id_fa 
    LEFT JOIN mst_farmalkes_unit c ON b.id_satuan=c.id_satuan
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

  function ppn_set(){
    $query=$this->db->query("SELECT a.ppn FROM mst_markup_harga a");
    return $query->row();
  }



  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }


  

} 
?>