<?php
class D_Gdf_daftar_barang_gudang extends ci_model
{
  ////////////////////////////
  function dlistrpo($idwrh_set_get){
    $query=$this->db->query("SELECT b.name AS nama_obat,SUM(a.qty) AS jumlah ,c.name AS nama_satuan,d.name AS nama_grup,e.no_rak,e.min
    FROM mst_soh a
    LEFT JOIN mst_farmalkes b ON a.id_soh=b.id_fa
    LEFT JOIN mst_farmalkes_unit c ON b.id_satuan=c.id_satuan
    LEFT JOIN mst_farmalkes_grup d ON b.id_group=d.id_group
    LEFT JOIN mst_wrh_mm e ON a.id_soh=e.id_fa
    WHERE a.id_wrh='$idwrh_set_get'
    GROUP BY a.id_soh
    ORDER BY b.name ASC
    ");
    return $query->result();
  }
} 
?>