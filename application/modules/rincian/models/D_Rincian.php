<?php
class D_Rincian extends ci_model
{

  function mtindakan(){
    $query=$this->db->query("SELECT a.id_act,a.name as nama_tindakan,a.price,b.name as nama_grup,c.name as nama_subgrup 
    FROM mst_tindakan a 
    LEFT JOIN mst_tindakan_grup b ON a.id_group=b.id_group
    LEFT JOIN mst_tindakan_subgrup c ON a.id_subgroup=c.id_subgroup 
    ORDER BY a.name ASC limit 10");
    return $query->result();
  }

  function createregact($data_trx_reg_act,$table){
    $this->db->insert($table,$data_trx_reg_act);
  }

  function mpasien($nama_pasien, $id_pasien, $tgl_lahir, $id_reg){
    if(!empty($nama_pasien)){
        $que_nama_pasien = " AND b.name LIKE '%$nama_pasien%'";
    }else{
        $que_nama_pasien = "";
    }

    if(!empty($id_pasien)){
        $que_id_pasien = " AND a.id_pasien LIKE '%$id_pasien%'";
    }else{
        $que_id_pasien = "";
    }

    if(!empty($tgl_lahir)){
        $que_tgl_lahir = " AND b.birthdate LIKE '%$tgl_lahir%'";
    }else{
        $que_tgl_lahir = "";
    }

    if(!empty($id_reg)){
      $que_id_reg = " AND a.id_reg='$id_reg'";
  }else{
      $que_id_reg = "";
  }


    $query=$this->db->query("SELECT * FROM trx_reg a LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien WHERE b.aktif IN ('0','1') $que_nama_pasien $que_id_pasien $que_tgl_lahir $que_id_reg ORDER BY b.name ASC LIMIT 100");
    return $query->result();
  }


  function array1($id_reg){
    $query=$this->db->query("SELECT b.name FROM trx_reg_act a LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group WHERE a.id_reg='$id_reg'");
    return $query->result();
  }

  function array2($id_reg, $id_group_act){
    $query=$this->db->query("SELECT a.name FROM trx_reg_act a LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group WHERE a.id_reg='$id_reg' AND a.id_group_act='$id_group_act'");
    return $query->result();
  }

  function mspb($id_reg){
    $query=$this->db->query("SELECT 
    b.name AS nama_group,a.id_trx,a.name,(CASE a.id_reg IS NULL WHEN 'tnd' THEN 'tnd' END) AS jns
    FROM trx_reg_act a 
    LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group 
    WHERE a.id_reg='$id_reg' AND a.id_group_act=b.id_group AND a.is_select='0'
    UNION ALL
    SELECT (CASE a.id_reg IS NULL WHEN 'FARMASI' THEN 'FARMASI' END) AS
    nama_group,b.id_trx,b.name,(CASE a.id_reg IS NULL WHEN 'nrc' THEN 'nrc' END) AS jns
    FROM trx_frm_resep a
    LEFT JOIN  trx_frm_resep_det b ON a.id_resep=b.id_resep 
    WHERE a.id_reg='$id_reg' AND b.is_select='0'
    UNION ALL
    SELECT (CASE a.id_reg IS NULL WHEN 'FARMASI' THEN 'FARMASI' END) AS
    nama_group,a.id_trx,b.name,(CASE a.id_reg IS NULL WHEN 'rac' THEN 'rac' END) AS jns
    FROM trx_frm_resep_rck a
    LEFT JOIN soap_eresep_det b ON a.id_trx_from_soap=b.id_eresep_det 
    WHERE a.id_reg='$id_reg' AND a.is_select='0'
    ");
    return $query->result();
  }

  function detaildatapasien($id_reg){
    $query=$this->db->query("SELECT b.id_reg,b.regdate,a.*, c.name AS nama_comp
    FROM mst_pasien a 
    LEFT JOIN trx_reg b ON a.id_pasien=b.id_pasien 
    LEFT JOIN mst_company c ON b.id_company=c.id_company 
    WHERE b.id_reg='$id_reg' LIMIT 1");
    return $query->row();
  }

  function dcheckpaket($id_reg){
    $query=$this->db->query("SELECT id_paket FROM trx_reg WHERE id_reg='$id_reg'");
    return $query->row();
  }

  function dinv(){
    $query=$this->db->query("SELECT id_inv FROM trx_reg_inv ORDER BY id_inv DESC LIMIT 1");
    return $query->row();
  }

  function checkdatatrxreg($id_reg){
    $query=$this->db->query("SELECT * FROM trx_reg WHERE id_reg='$id_reg'");
    return $query->row();
  } 

  function checkdatatindpaket($id_paket_set){
    $query=$this->db->query("SELECT * FROM mst_paket_det WHERE id_paket='$id_paket_set' AND id_group='1'");
    return $query->result();
  }

  function checkdatatrxrecatpaket($id_reg, $id_reg_act){
    $query=$this->db->query("SELECT * FROM trx_reg_act WHERE id_reg_act='$id_reg_act' AND id_reg='$id_reg'");
    return $query->row();
  }

  function dhandlertombolrincian($id_reg){
    $query=$this->db->query("SELECT * FROM trx_reg WHERE id_reg='$id_reg'");
    return $query->row();
  }

  function mtrxinvidpasien($id_reg){
    $query=$this->db->query("SELECT * FROM trx_reg WHERE id_reg='$id_reg'");
    return $query->row();
  }

  function mtrxinvpasien($id_pasien){
    $query=$this->db->query("SELECT * FROM trx_reg_inv a LEFT JOIN trx_reg b ON a.id_reg=b.id_reg WHERE b.id_pasien='$id_pasien'");
    return $query->result();
  }

  function mcctype(){
    $query=$this->db->query("SELECT * FROM mst_cctype ORDER BY name ASC");
    return $query->result();
  }

  function mbank(){
    $query=$this->db->query("SELECT * FROM mst_bank WHERE aktif='1' ORDER BY name ASC");
    return $query->result();
  }

  


} 


?>