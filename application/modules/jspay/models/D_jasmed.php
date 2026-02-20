<?php
class D_jasmed extends ci_model
{

  /*function mjasmed($date_range_1, $date_range_2, $iddokter_set){

      $query=$this->db2->query("SELECT a.id_trx,b.name AS dokter, c.name AS spesialis, d.name AS tindakan,f.name AS penjamin, a.price AS tarif_tindakan,d.share_dokter,d.share_rs,e.id_reg AS no_daftar,g.name AS nm_pasien, g.id_pasien AS rm FROM trx_reg_act a
      LEFT JOIN mst_dokter b ON a.id_dokter=b.id_dokter
      LEFT JOIN mst_dokter_spec c ON b.id_spes=c.id_spes
      LEFT JOIN mst_tindakan d ON a.id_reg_act=d.id_act
      LEFT JOIN trx_reg e ON a.id_reg=e.id_reg
      LEFT JOIN mst_company f ON e.id_asuransi=f.id_company
      LEFT JOIN mst_pasien g ON e.id_pasien=g.id_pasien
      WHERE a.id_inv IS NOT NULL AND d.adm_type IN ('0','2') AND DATE_FORMAT(a.created, '%Y-%m-%d') BETWEEN '$date_range_1' AND '$date_range_2' $iddokter_set $spesialisdokter $tindakandokter $penjaminnya");


    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }*/

  function mjasmed($date_range_1, $date_range_2, $iddokter_set){

    $query=$this->db2->query("SELECT a.id_trx,b.name AS dokter, c.name AS spesialis, d.name AS tindakan,f.name AS penjamin, a.price AS tarif_tindakan,d.share_dokter,d.share_rs,e.id_reg AS no_daftar,g.name AS nm_pasien, g.id_pasien AS rm, h.id_trx_from_reg_act AS idfrom,h.is_final FROM trx_reg_act a
    LEFT JOIN mst_dokter b ON a.id_dokter=b.id_dokter
    LEFT JOIN mst_dokter_spec c ON b.id_spes=c.id_spes
    LEFT JOIN mst_tindakan d ON a.id_reg_act=d.id_act
    LEFT JOIN trx_reg e ON a.id_reg=e.id_reg
    LEFT JOIN mst_company f ON e.id_asuransi=f.id_company
    LEFT JOIN mst_pasien g ON e.id_pasien=g.id_pasien
    LEFT JOIN trx_reg_jspay h ON a.id_trx=h.id_trx_from_reg_act
    WHERE a.id_inv IS NOT NULL AND d.adm_type IN ('0','2') AND DATE_FORMAT(a.created, '%Y-%m-%d') BETWEEN '$date_range_1' AND '$date_range_2' $iddokter_set $spesialisdokter $tindakandokter $penjaminnya");


  if($query->num_rows()>0){
    return $query->result();
  }
  else{
    return array();
  }
}

function mjasmed_doneset($date_range_1, $date_range_2, $iddokter_set){

  $query=$this->db2->query("SELECT a.id_trx,b.name AS dokter, c.name AS spesialis, d.name AS tindakan,f.name AS penjamin, a.price AS tarif_tindakan,d.share_dokter,d.share_rs,e.id_reg AS no_daftar,g.name AS nm_pasien, g.id_pasien AS rm, h.id_trx_from_reg_act AS idfrom FROM trx_reg_act a
  LEFT JOIN mst_dokter b ON a.id_dokter=b.id_dokter
  LEFT JOIN mst_dokter_spec c ON b.id_spes=c.id_spes
  LEFT JOIN mst_tindakan d ON a.id_reg_act=d.id_act
  LEFT JOIN trx_reg e ON a.id_reg=e.id_reg
  LEFT JOIN mst_company f ON e.id_asuransi=f.id_company
  LEFT JOIN mst_pasien g ON e.id_pasien=g.id_pasien
  LEFT JOIN trx_reg_jspay h ON a.id_trx=h.id_trx_from_reg_act
  WHERE a.id_inv IS NOT NULL AND d.adm_type IN ('0','2') AND DATE_FORMAT(a.created, '%Y-%m-%d') BETWEEN '$date_range_1' AND '$date_range_2' AND h.is_final='0' AND h.id_trx_from_reg_act IS NOT NULL $iddokter_set $spesialisdokter $tindakandokter $penjaminnya");


  if($query->num_rows()>0){
    return $query->result();
  }
  else{
    return array();
  }
}

function draft_jasmed($date_range_1, $iddokter){

  $query=$this->db2->query("SELECT a.*,b.name FROM trx_jspay_dokter a
  LEFT JOIN mst_dokter b ON a.id_dokter=b.id_dokter
  WHERE DATE_FORMAT(a.date_1, '%Y-%m')='$date_range_1' AND a.id_dokter='$iddokter'");


  if($query->num_rows()>0){
    return $query->result();
  }
  else{
    return array();
  }
}

function mjasmed_finset($date_range_1, $date_range_2, $iddokter_set){
  $query=$this->db2->query("SELECT * FROM trx_reg_jspay a
  WHERE DATE_FORMAT(a.date_p1, '%Y-%m-%d')='$date_range_1' AND DATE_FORMAT(a.date_p2, '%Y-%m-%d')='$date_range_2' AND a.id_dokter='$iddokter_set'");
  return $query->result();
}

function notifrincianunproses($date_range_1, $iddokter){ //rubah query
  $query=$this->db2->query("SELECT COUNT(*) AS countnotif FROM trx_jspay_dokter a
  WHERE DATE_FORMAT(a.date_1, '%Y-%m')='$date_range_1' AND a.id_dokter='$iddokter'");
  return $query->row();
}





  ////selected Spesialis
  function mspesialis(){ 
    $query=$this->db2->query("SELECT * FROM mst_dokter_spec WHERE aktif='1' ORDER BY name ASC");     
    if($query->num_rows()>0){ return $query->result(); }else{ return array(); }
  }
  ////end selected Spesialis

  ////selected tindakan
  function mtindakan(){
    $query=$this->db2->query("SELECT * FROM `mst_tindakan` WHERE aktif='1' AND adm_type IN ('0','2') ORDER BY name");     
    if($query->num_rows()>0){ return $query->result(); }else{ return array(); }
  }
  ////end selected tindakan


  ////selected penjamin
  function mpenjamin(){
    $query=$this->db2->query("SELECT * FROM mst_company WHERE aktif='1' ORDER BY name ASC");     
    if($query->num_rows()>0){ return $query->result(); }else{ return array(); }
  }
  ////end selected penjamin

  ////dokter
  function mdokter(){
    $query=$this->db2->query("SELECT * FROM mst_dokter WHERE aktif='0' ORDER BY name ASC");     
    if($query->num_rows()>0){ return $query->result(); }else{ return array(); }
  }
  ////dokter

  function datafnddata($dt_idtrx_from_list){
    $hasil=$this->db2->query("SELECT COUNT(*) AS fnddata FROM trx_reg_jspay WHERE id_trx_from_reg_act='$dt_idtrx_from_list'");
    return $hasil->row();
  }

  function dataretregact($dt_idtrx_from_list){
    $hasil=$this->db2->query("SELECT * FROM trx_reg_act WHERE id_trx='$dt_idtrx_from_list'");
    return $hasil->row();
  }

  function setdataslipgaji($idtrx){
    $hasil=$this->db2->query("SELECT a.*,b.name,c.name as name_spes FROM trx_jspay_dokter a 
    LEFT JOIN mst_dokter b ON a.id_dokter=b.id_dokter 
    LEFT JOIN mst_dokter_spec c ON b.id_spes=c.id_spes 
    WHERE a.id_trx='$idtrx'");
    return $hasil->row();
  }

  
  

  
  function insert($data,$table){
    $this->db->insert($table,$data);
  }

  function update_data($whereu,$data,$table){
    $this->db->where($whereu);
    $this->db->update($table,$data);
  }

} 

?>