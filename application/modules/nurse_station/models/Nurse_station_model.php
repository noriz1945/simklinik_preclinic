<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nurse_station_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function cek_shift($id_dokter)
  {
    $sql =" SELECT  id_shift
            FROM    soap_shift_dokter
            WHERE   id_dokter = '".$id_dokter."'
          ";
    $query  = $this->dbsupp->query($sql);
    $result = $query->row_array();
    return $result;
  }

  function cek_jml_stat_fisik($id_reg)
  {
    $sql = "SELECT  *
            FROM  soap_stat_fisik
            WHERE id_reg = '".$id_reg."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbsupp->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function cek_stat_fisik($id_reg)
  {
    $sql = "SELECT  *
            FROM    soap_stat_fisik
            WHERE   id_reg = '".$id_reg."'
          ";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result();
    return $result;
    }

  function get_id_fisik($id_reg)
  {
    $sql = "SELECT  *
            FROM    soap_stat_fisik
            WHERE   id_reg = '".$id_reg."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbsupp->query($sql);
    $result = $query->row();
    return $result;
  }

  public function add_data_fisik($data)
  {
    $this->dbsupp->insert('soap_stat_fisik',$data);
  }

  function update_stat_fisik($id_fisik, $data)
  {
    $this->db->where('id_fisik', $id_fisik);
    $this->db->update('soap_stat_fisik', $data);
  }

  public function delete_stat_fisik($id_fisik)
  {
    $this->dbsupp->where('id_fisik', $id_fisik);
    $this->dbsupp->delete('soap_stat_fisik');
  }


  public function get_fisik_byid($id_fisik)
  {
    $this->dbsupp->from('soap_stat_fisik');
    $this->dbsupp->where('id_fisik', $id_fisik);
    $query  = $this->dbsupp->get();
    return $query->row();
  }

  function cek_jml_sukit($id_reg, $id_dokter)
  {
      $sql = "SELECT  *
              FROM    soap_sukit
              WHERE   id_reg = '".$id_reg."'
              AND id_dokter ='".$id_dokter."'
              ";
      //echo "<pre>".$sql."</pre>";
      $query  = $this->dbsupp->query($sql);
      $result = $query->num_rows();
      return $result;
  }

  function cek_jml_sehat($id_reg, $id_dokter)
  {
      $sql = "SELECT  *
              FROM    soap_sehat
              WHERE   id_reg = '".$id_reg."'
              AND id_dokter ='".$id_dokter."'
              ";
      //echo "<pre>".$sql."</pre>";
      $query  = $this->dbsupp->query($sql);
      $result = $query->num_rows();
      return $result;
  }
}
