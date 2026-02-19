<?php
class D_Nurse extends ci_model
{
  function mpasien(){
    $query=$this->db->query("SELECT b.name AS nama_pasien,b.birthdate,a.*,c.name AS nama_dokter,d.name AS asuransi,b.gender AS jenkel FROM trx_reg a 
    LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien  
    LEFT JOIN mst_dokter c ON a.id_dokter_prt1=c.id_dokter
    LEFT JOIN mst_company d ON a.id_asuransi=d.id_company
    WHERE a.iostatus='0' AND a.is_reg_aps='0' ORDER BY a.regdate DESC");
    return $query->result();
  } //

  function lastttv($id_reg,$id_pasien){
    $query=$this->db->query("SELECT * FROM soap_ttv WHERE id_pasien='$id_pasien' ORDER BY id DESC LIMIT 1");
    return $query->row();
  }

  function lastsoap($id_reg,$id_pasien){
    $query=$this->db->query("SELECT * FROM soap_sbar WHERE id_reg='$id_reg' ORDER BY created DESC LIMIT 1");
    return $query->row();
  }

  function insdata($data_trx_reg_act,$table){
    $this->db->insert($table,$data_trx_reg_act);
  }
  function insdata_sbar($data_trx_reg_act,$table){ 
    $this->db->insert($table,$data_trx_reg_act);
  }
  function insdata_soap_perawat($data_trx_reg_act,$table){
    $this->db->insert($table,$data_trx_reg_act);
  }
  function update_data($where,$data,$table){ 
    $this->db->where($where);
    $this->db->update($table,$data);
  }
  function update_data_perawat($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }
  
  function mdlriwayatmedis($id_pasien){
    $query=$this->db->query("SELECT * FROM soap_asm_ri WHERE id_pasien='$id_pasien' ORDER BY asmri_date DESC");
    return $query->result();
  }

  function checkregsoap($id_reg){
    $query=$this->db->query("SELECT COUNT(*) AS fnddata FROM soap_sbar WHERE id_reg='$id_reg'");
    return $query->row();
  }

  function getdatasoap($id_reg){
    $query=$this->db->query("SELECT * FROM soap_asm_ri WHERE id_reg='$id_reg'");
    return $query->row();
  }

  function createregact($data_trx_reg_act,$table){
    $this->db->insert($table,$data_trx_reg_act);
  }
  

} 
?>