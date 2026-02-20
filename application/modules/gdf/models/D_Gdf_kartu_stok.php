<?php
class D_Gdf_kartu_stok extends ci_model
{
  ////////////////////////////
  function dlistrpo($tglmulai_set,$tglakhir_set,$idwarehouse_set_get,$idobat_set_get){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat FROM gdf_kartu_stok a 
    LEFT JOIN mst_farmalkes b ON b.id_fa=a.id_fa
    WHERE DATE_FORMAT(a.datetime,'%Y-%m-%d') BETWEEN '$tglmulai_set' AND '$tglakhir_set' AND a.id_wrh='$idwarehouse_set_get' AND a.id_fa='$idobat_set_get'
    ORDER BY a.datetime DESC");
    return $query->result();
  }
} 
?>