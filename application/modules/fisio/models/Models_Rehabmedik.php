<?php
class Models_Rehabmedik extends CI_Model{
//LIST DATA 
	function rehab_list($id_reg){
		$hasil=$this->db->query("SELECT * FROM `soap_trx_order_rehab_medik` WHERE `registrasi`='$id_reg'");
		return $hasil->result();
  }
  
  function get_data_registrasi_by_id_reg($id_reg)
    {
        $sql = "SELECT  TR.`id_reg`, TR.`regdate`,
                MP.`id_pasien`, CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS nama_pasien,
                MP.`birthplace`, DATE_FORMAT(MP.`birthdate`, '%d-%m-%Y') AS tgl_lahir,
                YEAR(curdate()) - YEAR(MP.birthdate) AS umur1,
                CONCAT(TIMESTAMPDIFF( YEAR, MP.birthdate, now() ),' thn ',
                TIMESTAMPDIFF( MONTH, MP.birthdate, now() ) % 12 ,' bln ',
                FLOOR( TIMESTAMPDIFF( DAY, MP.birthdate, now() ) % 30.4375 ),' hr ') AS umur2,
                CASE WHEN MP.`gender` = 0 THEN 'Laki-Laki' ELSE 'Perempuan' END AS gender1,
                CASE WHEN MP.`gender` = 0 THEN 'L' ELSE 'P' END AS gender2,
                MP.`address` AS alamat, MC.`name` AS asuransi,
                TRU.id_unit, TR.`id_asuransi`,
                MPJ.`name` AS job, MPM.`name` AS status, MPD.`name` AS pendidikan, 
                MA.`name` AS agama, MP.`id_nation`, MN.`name` AS kebangsaan,
                IFNULL(TRU.`id_dokter`, TR.id_dokter_jaga) AS id_dokter,
                IFNULL(MU.`name`, 'IGD') AS poli_ruangan,
                IFNULL(MD.`name`, MD1.`name`) AS dokter,
                CASE WHEN TR.`rwjn` = 1 THEN '1' ELSE '3' END AS id_type
                                                        
                FROM    trx_reg TR
                LEFT JOIN `mst_pasien` MP ON TR.`id_pasien` = MP.`id_pasien`
                LEFT JOIN `mst_company` MC ON TR.`id_asuransi` = MC.`id_company`
                LEFT JOIN `trx_reg_unit` TRU ON TR.`id_reg` = TRU.`id_reg`
                LEFT JOIN `mst_unit` MU ON TRU.`id_unit` = MU.`id_unit`
                LEFT JOIN `mst_dokter` MD ON TRU.`id_dokter` = MD.`id_dokter`
                LEFT JOIN `mst_dokter` MD1 ON TR.id_dokter_jaga = MD1.`id_dokter`
                LEFT JOIN `mst_pasien_title` MPT ON MP.`id_social` = MPT.`id_social`
                LEFT JOIN `mst_pasien_job` MPJ ON MP.`id_job` = MPJ.`id_job` 
                LEFT JOIN `mst_pasien_mar` MPM ON MP.`id_mar` = MPM.`id_mar` 
                LEFT JOIN `mst_pendidikan` MPD ON MP.`id_pend` = MPD.`id_pend` 
                LEFT JOIN `mst_agama` MA ON MP.`id_agama` = MA.`id_agama` 
                LEFT JOIN `mst_nation` MN ON MP.`id_nation` = MN.`id_nation`
                                        
                WHERE   TR.id_reg = '".$id_reg."'
                ";
                        
        $query  = $this->dbhis->query($sql);
        $rs     = $query->row_array();
        return $rs;
    }
    
//DATA PASIEN
	function data_pasien($id_reg)
  {
    $query=$this->dbhis->query("SELECT a.id_reg, a.id_asuransi, a.id_company, a.rwjn, a.rwip, a.ugd, a.card_id, a.card_name
																			,a.id_kamar, a.id_kelas, a.id_pasien
																			,b.name, b.birthdate, b.address, b.gender,c.`id_dokter`,c.`name` as dokter_name
    FROM trx_reg a
									LEFT JOIN  mst_pasien b ON a.id_pasien = b.id_pasien
									LEFT JOIN  mst_dokter c ON a.id_dokter_prt1 = c.id_dokter
    WHERE a.id_reg='$id_reg'");
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
    ,b.name, b.birthdate, b.address, b.gender
    
    from trx_reg a
    left join  mst_pasien b on a.id_pasien = b.id_pasien
    where a.id_reg='$id_reg'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }
	function mstDokter($id_reg)
  {
    $query=$this->dbhis->query("SELECT `trx_reg_unit`.`id_reg`,`trx_reg_unit`.`id_dokter`,`mst_dokter`.`id_dokter`,`mst_dokter`.`name` 
          FROM `trx_reg_unit` 
          LEFT JOIN `mst_dokter` ON `trx_reg_unit`.`id_dokter`=`mst_dokter`.`id_dokter` 
          WHERE `trx_reg_unit`.`id_reg`='$id_reg'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function mstDokter_na($id_reg)
  {
    $query=$this->dbhis->query("SELECT `trx_reg_unit`.`id_reg`,`trx_reg_unit`.`id_dokter`,`mst_dokter`.`id_dokter`,`mst_dokter`.`name` 
              FROM `trx_reg_unit` 
              LEFT JOIN `mst_dokter` ON `trx_reg_unit`.`id_dokter`=`mst_dokter`.`id_dokter` 
              WHERE `trx_reg_unit`.`id_reg`='$id_reg'");
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

		function dataListsedit($id_digit)
  {

    $query=$this->dbhis->query("SELECT * FROM soap_trx_order_rehab_medik WHERE id_digital_request='$id_digit'");
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
	
	function delete_rehab_id($id_digit){
    $this->dbhis->where('id_digital_request', $id_digit);
    $this->dbhis->delete('soap_trx_order_rehab_medik');   
  }

  function dataListsedit_reg($id_digit)
  {
    $sql = "SELECT `registrasi` FROM soap_trx_order_rehab_medik WHERE id_digital_request='$id_digit'";
    $query  = $this->dbhis->query($sql);
    $result = $query->result();
    $result = $result[0];
    return $result;
  }
	
}