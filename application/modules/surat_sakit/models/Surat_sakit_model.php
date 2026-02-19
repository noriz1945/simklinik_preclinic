<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Surat_sakit_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function add_data_sukit($data)
  {
    $this->dbhis->insert('soap_sukit',$data);
    //return $this->dbhis->insert_id();
  }

  public function edit_data_sukit($where, $data)
  {
    $this->dbhis->update('soap_sukit', $data, $where);
    return $this->dbhis->affected_rows();
  }

  public function delete_sukit_byid($id_sukit)
  {
    $this->dbhis->where('id_sukit', $id_sukit);
    $this->dbhis->delete('soap_sukit');
  }

  function get_sukit_all($id_pasien)
  {
    $sql = "SELECT  a.*, b.`name` AS dokter, c.`name` AS poli, b.`acc_branch`
              FROM  soap_sukit a
              LEFT JOIN dbhis.mst_dokter b ON a.`id_dokter` = b.`id_dokter`
              LEFT JOIN dbhis.mst_unit c ON b.`id_unit` = c.`id_unit`
              WHERE   a.id_pasien = '".$id_pasien."'
              ORDER BY a.id_sukit ASC
              ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result_array();
    return $result;
  }

  function get_sukit_byid($id_sukit)
  {
    $sql = "SELECT a.* FROM `soap_sukit` a WHERE a.`id_sukit` = '" . $id_sukit . "'
            ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result();
    $result = $result[0];
    return $result;
  }

  function get_sukit_byidreg($id_reg, $id_dokter)
  {
    $sql = "SELECT a.*
            FROM `soap_sukit` a
            WHERE a.`id_reg` = '" . $id_reg . "'
            AND a.`id_dokter` = '" . $id_dokter . "'
            ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result();
    $result = $result[0];
    return $result;
  }
}
