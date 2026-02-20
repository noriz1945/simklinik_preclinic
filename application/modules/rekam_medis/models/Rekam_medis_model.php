<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rekam_medis_model extends CI_Model
{
  function __construct(){
    parent::__construct();
  }

  function cek_jml_soap($id_pasien, $id_dokter)
  {
    $sql = "SELECT  * 
            FROM    soap_cppt_trans
            WHERE   id_pasien = '".$id_pasien."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function cek_jml_asm($id_pasien, $id_dokter)
  {
    $sql = "SELECT  * 
            FROM    soap_awal
            WHERE   id_pasien = '".$id_pasien."'
            ";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function get_soap_byreg($id_reg, $id_dokter)
  {
    $sql = "SELECT  * 
            FROM    soap_cppt_trans
            WHERE   id_reg = '".$id_reg."'
            AND id_dokter = '".$id_dokter."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->result();
    return $result;
  }

  function get_asm_byreg($id_reg, $id_dokter)
  {
    $sql = "SELECT  * 
            FROM    soap_awal
            WHERE   id_reg = '".$id_reg."'
            AND id_dokter = '".$id_dokter."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->result();
    return $result;
  }

  function cek_jml_stat_fisik($id_reg)
  {
    $sql = "SELECT  *
            FROM  soap_stat_fisik
            WHERE id_reg = '".$id_reg."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function cek_jml_sukit($id_reg, $id_dokter)
  {
      $sql = "SELECT  *
              FROM    soap_sukit
              WHERE   id_reg = '".$id_reg."'
              AND id_dokter ='".$id_dokter."'
              ";
      //echo "<pre>".$sql."</pre>";
      $query  = $this->dbhis->query($sql);
      $result = $query->num_rows();
      return $result;
  }

}