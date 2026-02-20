<?php
class D_Regis extends ci_model
{

  function mdokter(){
    //$query=$this->db->query("SELECT a.name,a.id_dokter,a.id_unit,b.name AS name_spec FROM mst_dokter a LEFT JOIN mst_dokter_spec b ON b.id_spes=a.id_spes WHERE a.aktif='0' ORDER BY a.name ASC");
    $query=$this->db->query("SELECT * FROM mst_dokter WHERE aktif='1' ORDER BY name ASC");
    return $query->result();
  }

  function munit(){
    $query=$this->db->query("SELECT * FROM mst_unit ORDER BY name ASC");
    return $query->result();
  }

  function mgender(){
    $query=$this->db->query("SELECT * FROM mst_gender ORDER BY name ASC");
    return $query->result();
  }

  function magama(){
    $query=$this->db->query("SELECT * FROM mst_agama ORDER BY name ASC");
    return $query->result();
  }

  function mpendidikan(){
    $query=$this->db->query("SELECT * FROM mst_pendidikan ORDER BY name ASC");
    return $query->result();
  }

  function msuku(){
    $query=$this->db->query("SELECT * FROM mst_suku ORDER BY name ASC");
    return $query->result();
  }

  function mkelurahan(){
    $query=$this->db->query("SELECT * FROM mst_kelurahan ORDER BY name ASC");
    return $query->result();
  }

  function mkecamatan(){
    $query=$this->db->query("SELECT * FROM mst_kecamatan ORDER BY name ASC");
    return $query->result();
  }

  function mkota(){
    $query=$this->db->query("SELECT * FROM mst_kota ORDER BY name ASC");
    return $query->result();
  }

  function mpropinsi(){
    $query=$this->db->query("SELECT * FROM mst_propinsi ORDER BY name ASC");
    return $query->result();
  }

  function mpaket(){
    $query=$this->db->query("SELECT * FROM mst_paket ORDER BY name ASC");
    return $query->result();
  }

  function mrujukan(){
    $query=$this->db->query("SELECT * FROM mst_rujukan ORDER BY name ASC");
    return $query->result();
  }

  function mcomp1(){
    $query=$this->db->query("SELECT * FROM mst_company WHERE aktif='1' ORDER BY name ASC");
    return $query->result();
  }

  function mcomp2(){
    $query=$this->db->query("SELECT * FROM mst_company WHERE id_type='3' ORDER BY name ASC");
    return $query->result();
  }

  function mcomp3(){
    $query=$this->db->query("SELECT * FROM mst_company WHERE id_type='2' ORDER BY name ASC");
    return $query->result();
  }

  function mgoldar(){
    $query=$this->db->query("SELECT * FROM mst_goldar ORDER BY name ASC");
    return $query->result();
  }

  function mrh(){
    $query=$this->db->query("SELECT * FROM mst_rh ORDER BY name ASC");
    return $query->result();
  }

  function mtandapengenal(){
    $query=$this->db->query("SELECT * FROM mst_tandapengenal ORDER BY name ASC");
    return $query->result();
  }

  function mstatus(){
    $query=$this->db->query("SELECT * FROM mst_status ORDER BY name ASC");
    return $query->result();
  }

  function mpekerjaan(){
    $query=$this->db->query("SELECT * FROM mst_pekerjaan ORDER BY name ASC");
    return $query->result();
  }

  function mhubkel(){
    $query=$this->db->query("SELECT * FROM mst_hubkel ORDER BY name ASC");
    return $query->result();
  }

  function mpasien($nama_pasien, $id_pasien, $tgl_lahir){
    if(!empty($nama_pasien)){
        $que_nama_pasien = " AND name LIKE '%$nama_pasien%'";
    }else{
        $que_nama_pasien = "";
    }

    if(!empty($id_pasien)){
        $que_id_pasien = " AND id_pasien LIKE '%$id_pasien%'";
    }else{
        $que_id_pasien = "";
    }

    if(!empty($tgl_lahir)){
        $que_tgl_lahir = " AND birthdate LIKE '%$tgl_lahir%'";
    }else{
        $que_tgl_lahir = "";
    }


    $query=$this->db->query("SELECT * FROM mst_pasien WHERE aktif IN ('0','1') $que_nama_pasien $que_id_pasien $que_tgl_lahir ORDER BY id_pasien + 0, name ASC LIMIT 2000");
    return $query->result();
  }

  function setpasien($id_pasien){
    $query=$this->db->query("SELECT * FROM mst_pasien WHERE id_pasien='$id_pasien'");
    return $query->row();
  }

  function createpasienbaru($data_mst_pasien,$table){
    $this->db->insert($table,$data_mst_pasien);
  }

  function createregpasienbaru($data_trx_reg,$table){
    $this->db->insert($table,$data_trx_reg);
  }

  function createregpasienlama($data_trx_reg,$table){
    $this->db->insert($table,$data_trx_reg);
  }

  function createregpaket($data_trx_reg_paket,$table){
    $this->db->insert($table,$data_trx_reg_paket);
  }

  function checklastidpasien(){
    $query=$this->db->query("SELECT id_pasien FROM mst_pasien ORDER BY id_pasien DESC limit 1");
    return $query->row();
  }

  function checklastidregpasien(){
    $query=$this->db->query("SELECT id_reg FROM trx_reg ORDER BY id_reg DESC limit 1");
    return $query->row();
  }

  function checkmstpaket($selmstpaket_pasien_baru){
    $query=$this->db->query("SELECT * FROM mst_paket WHERE id_paket='$selmstpaket_pasien_baru'");
    return $query->row();
  }

  function checktrxregpaket($id_reg){
    $query=$this->db->query("SELECT id_trx FROM trx_reg_paket WHERE id_reg='$id_reg'");
    return $query->row();
  }

  function trxpasienpaketaktif(){
    $query=$this->db->query("SELECT b.id_trx_paket,b.id_pasien,c.name AS nama_pasien,c.birthdate,c.hp,a.*,b.paket_aktif,(SELECT COUNT(id_trx) FROM trx_paket_aktif WHERE id_trx_paket=b.id_trx_paket AND status='1') AS checkin FROM trx_reg_paket a LEFT JOIN trx_reg b ON a.id_reg=b.id_reg LEFT JOIN mst_pasien c ON b.id_pasien=c.id_pasien WHERE b.paket_aktif='1' AND b.paket_selesai='0' ORDER BY a.created ASC");
    return $query->result();
  }

  function slotpasienpaketaktif($idtrxpaket){
    $query=$this->db->query("SELECT a.*,b.name AS namaDokter FROM trx_paket_aktif a LEFT JOIN mst_dokter b ON a.id_dokter=b.id_dokter WHERE a.id_trx_paket='$idtrxpaket' ORDER BY a.daycheck ASC");
    return $query->result();
  }

  function checkdatatrxregpaket($id_trx_reg){
    $query=$this->db->query("SELECT * FROM trx_reg WHERE id_trx_paket='$id_trx_reg'");
    return $query->row();
  }

  function checktrxregpaket_dayone($id_trx_reg){
    $query=$this->db->query("SELECT daycheck FROM trx_paket_aktif WHERE id_trx_paket='$id_trx_reg' AND status IS NULL ORDER BY daycheck ASC LIMIT 1");
    return $query->row();
  }

  function checktrxregpaket_dayone_upd($id_trx_reg){
    $query=$this->db->query("SELECT * FROM trx_reg WHERE id_trx_paket='$id_trx_reg'");
    return $query->row();
  }
  

} 


?>