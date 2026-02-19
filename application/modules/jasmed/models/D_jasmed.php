<?php
class D_jasmed extends ci_model
{

  function mjasmed($date_range_1, $date_range_2, $iddokter_set, $spesialisdokter, $tindakandokter, $penjaminnya){

      $query=$this->db2->query("SELECT b.name AS dokter, c.name AS spesialis, d.name AS tindakan,f.name AS penjamin, a.price AS tarif_tindakan,d.share_dokter,d.share_rs,e.id_reg AS no_daftar,g.name AS nm_pasien, g.id_pasien AS rm FROM trx_reg_act a
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

  function datafnddata($dt_idtindakan, $dt_idcarabayar, $idjnswkt, $dt_jbnid, $dt_insid){
    $hasil=$this->db2->query("SELECT COUNT(*) AS fnddata FROM z_jasmed_m WHERE daftartindakan_id='$dt_idtindakan' AND jenistarif_id='$dt_idcarabayar' AND jeniswaktukerja='$idjnswkt' AND idjabatan='$dt_jbnid' AND idlayanan='$dt_insid'");
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