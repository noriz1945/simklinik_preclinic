<?php
class Models_splab extends ci_model
{
 // public function getsegment(){		
		
		//die();
//	}

 /* function edit_data($where,$table){		
    return $this->dbhis->get_where($table,$where);
  }

  function tampil_data(){
    return $this->dbhis->get('trx_lab_order_digital_request');
    }*/


  function data_pasien($id_reg)
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
  

  function dataHead_01()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='1' AND `id_row`='1' AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_02()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='1' AND `id_row`='2'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_03()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='1' AND `id_row`='3'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_04()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='1' AND `id_row`='4'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_05()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='1' AND `id_row`='5'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_06()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='2' AND `id_row`='1'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_07()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='2' AND `id_row`='2'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_08()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='2' AND `id_row`='3'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_09()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='2' AND `id_row`='4'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_10()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='2' AND `id_row`='5'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_11()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='2' AND `id_row`='6'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_12()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='2' AND `id_row`='7'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_13()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='2' AND `id_row`='8'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_14()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='2' AND `id_row`='9'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_15()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='3' AND `id_row`='1'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_16()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='3' AND `id_row`='2'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_17()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='3' AND `id_row`='3'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_18()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='3' AND `id_row`='4'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_19()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='3' AND `id_row`='5'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_20()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='3' AND `id_row`='6'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_21()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='3' AND `id_row`='7'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_22()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='3' AND `id_row`='8'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_23()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='3' AND `id_row`='9'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_24()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='4' AND `id_row`='1'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_25()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='4' AND `id_row`='2'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_26()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='4' AND `id_row`='3'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_27()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='4' AND `id_row`='4'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_28()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='4' AND `id_row`='5'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_29()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='5' AND `id_row`='1'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_30()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='5' AND `id_row`='2'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_31()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='5' AND `id_row`='3'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_32()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='5' AND `id_row`='4'  AND `aktif`='1'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataHead_33()
  {
    $query=$this->dbhis->query("SELECT * FROM `soap_trx_lab_order_digital_item` WHERE `id_header`='5' AND `id_row`='5'  AND `aktif`='1'");
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
  
  function dataPasienlist_lab()
  {
    $segment5=$this->uri->segment('5');
    $query=$this->dbhis->query("SELECT * FROM soap_trx_lab_order_digital_request WHERE `rm`='$segment5'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function dataListsedit($id_digit)
  {

    $query=$this->dbhis->query("SELECT * FROM soap_trx_lab_order_digital_request WHERE id_digital_request='$id_digit'");
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
  
  function delete_lab_id($id_digit){
    $this->dbhis->where('id_digital_request', $id_digit);
    $this->dbhis->delete('soap_trx_lab_order_digital_request');   
  }

  function dataListsedit_reg($id_digit)
  {
    $sql = "SELECT `registrasi` FROM soap_trx_lab_order_digital_request WHERE id_digital_request='$id_digit'";
    $query  = $this->dbhis->query($sql);
    $result = $query->result();
    $result = $result[0];
    return $result;
  }

}

  


