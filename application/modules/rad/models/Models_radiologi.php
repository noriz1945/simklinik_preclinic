<?php
class Models_radiologi extends ci_model
{
  function dataPasien($id_reg)
  {
    $query=$this->dbhis->query("select a.id_reg, a.id_asuransi, a.id_company, a.rwjn, a.rwip, a.ugd, a.card_id, a.card_name
    ,a.id_kamar, a.id_kelas, a.id_pasien
    ,b.name, b.birthdate, b.address, b.gender, c.name as namaasuransi
    
    from trx_reg a
    left join  mst_pasien b on a.id_pasien = b.id_pasien
    left join  mst_company c on a.id_asuransi = c.id_company
    where a.id_reg='$id_reg'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function data_pasien_na($id_reg)
  {
    $query=$this->dbhis->query("select a.id_reg, a.id_asuransi, a.id_company, a.rwjn, a.rwip, a.ugd, a.card_id, a.card_name
    ,a.id_kamar, a.id_kelas, a.id_pasien
    ,b.name, b.birthdate, b.address, b.gender, c.name as namaasuransi
    
    from trx_reg a
    left join  mst_pasien b on a.id_pasien = b.id_pasien
    left join  mst_company c on a.id_asuransi = c.id_company
    where a.id_reg='$id_reg'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

    /*========================================= 001 ===========================================================*/

  function dataHead_01()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='1' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_01_r()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='1' AND `aktif`='1' AND `r_check`='1' AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_01_l()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='1' AND `aktif`='1' AND `r_check` IS NULL AND `l_check`='1' AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_01_b()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='1' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_02()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='6' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_02_r()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='6' AND `aktif`='1' AND `r_check`='1' AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_02_l()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='6' AND `aktif`='1' AND `r_check` IS NULL AND `l_check`='1' AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_02_b()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='6' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  /*========================================= 002 ===========================================================*/

  /*LINE 2*/
  function dataHead_03()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='2' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_04()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='7' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_04_r()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='7' AND `aktif`='1' AND `r_check`='1' AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_04_l()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='7' AND `aktif`='1' AND `r_check` IS NULL AND `l_check`='1' AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_04_b()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='7' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  /*LINE 3*/
  function dataHead_05()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='3' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_06()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='8' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  /*LINE 4*/
  function dataHead_07()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='4' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }
  function dataHead_07_r()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='4' AND `aktif`='1' AND `r_check`='1' AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_07_l()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='4' AND `aktif`='1' AND `r_check` IS NULL AND `l_check`='1' AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }
  


  function dataHead_08()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='9' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  /*LINE 5*/
  function dataHead_09()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='5' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_10()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='10' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  /*LINE 6*/
  function dataHead_11()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='11' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }
  function dataHead_11_r()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='11' AND `aktif`='1' AND `r_check`='1' AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_12()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='12' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_13()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_rad_order_digital_2` WHERE `id_sub`='13' AND `aktif`='1' AND `r_check` IS NULL AND `l_check` IS NULL AND `b_check` IS NULL");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }


  function mstDokter($id_reg)
  {
    $query=$this->dbhis->query("SELECT `trx_reg_unit`.`id_reg`,`trx_reg_unit`.`id_dokter`,`mst_dokter`.`id_dokter`,`mst_dokter`.`name` FROM `trx_reg_unit` LEFT JOIN `mst_dokter` ON `trx_reg_unit`.`id_dokter`=`mst_dokter`.`id_dokter` WHERE `trx_reg_unit`.`id_reg`='$id_reg'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function mstDokter_na($id_reg)
  {
    $query=$this->dbhis->query("SELECT `trx_reg_unit`.`id_reg`,`trx_reg_unit`.`id_dokter`,`mst_dokter`.`id_dokter`,`mst_dokter`.`name` FROM `trx_reg_unit` LEFT JOIN `mst_dokter` ON `trx_reg_unit`.`id_dokter`=`mst_dokter`.`id_dokter` WHERE `trx_reg_unit`.`id_reg`='$id_reg'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  //untuk kondisi dokter IGD
  function mstDokter_igd($id_reg)
  {
    $query=$this->dbhis->query("SELECT `trx_reg`.`id_reg`,`trx_reg`.`id_dokter_jaga`,`mst_dokter`.`id_dokter`,`mst_dokter`.`name` FROM `trx_reg` LEFT JOIN `mst_dokter` ON `trx_reg`.`id_dokter_jaga`=`mst_dokter`.`id_dokter` WHERE `trx_reg`.`id_reg`='$id_reg'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function input_data($data,$table){
		$this->dbhis->insert($table,$data);
	}

  function dataPasienlist_rad()
  {
    $segment5=$this->uri->segment('5');
    $query=$this->dbhis->query("SELECT * FROM soap_trx_rad_order_digital_request WHERE `rm`='$segment5'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataListsedit($id_digit)
  {
    $segment4=$this->uri->segment('4');
    $segment6=$this->uri->segment('6');
    $query=$this->dbhis->query("SELECT * FROM soap_trx_rad_order_digital_request WHERE id_digital_request='$id_digit'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function update_data($where,$data,$table){
		$this->dbhis->where($where);
		$this->dbhis->update($table,$data);
  }	

  function delete_rad_id($id_digit){
    $this->dbhis->where('id_digital_request', $id_digit);
    $this->dbhis->delete('soap_trx_rad_order_digital_request');   
  }

  function dataListsedit_reg($id_digit)
  {
    $sql = "SELECT `registrasi` FROM soap_trx_rad_order_digital_request WHERE id_digital_request='$id_digit'";
    $query  = $this->dbhis->query($sql);
    $result = $query->result();
    $result = $result[0];
    return $result;
  }
}

  


