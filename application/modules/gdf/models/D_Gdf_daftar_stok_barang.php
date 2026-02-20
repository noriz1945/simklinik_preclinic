<?php
class D_Gdf_daftar_stok_barang extends ci_model
{
  ////////////////////////////
  function dlistrpo($idobat_set_get){
    $query=$this->db->query("SELECT b.name AS nama_gudang,SUM(a.qty) AS jumlah 
    FROM mst_soh a
    LEFT JOIN mst_warehouse b ON a.id_wrh=b.id_wrh
    WHERE a.id_soh='$idobat_set_get'
    GROUP BY a.id_wrh
    ");
    return $query->result();
  }
} 
?>