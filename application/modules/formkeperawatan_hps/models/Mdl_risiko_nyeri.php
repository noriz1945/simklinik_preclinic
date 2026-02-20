<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_risiko_nyeri extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  ////////////////////

  public function tbmst(){
    $sql    = "SELECT * FROM frm_trn_risikonyeri WHERE hapus='0'";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }

  public function add_derner($data){
    $this->dbsupp->insert('frm_trn_risikonyeri', $data);
  } 

  function tbcheck($idreg){
    $sql    = "SELECT COUNT(*) AS fnddata_1 FROM frm_trn_risikonyeri WHERE id_reg='$idreg'";
    $query  = $this->dbsupp->query($sql);
    $result = $query->row();
    return $result;
  }

  public function getdetailformrisiko($id_reg){
    $sql ="SELECT * FROM frm_trn_risikonyeri WHERE id_reg='$id_reg' AND hapus='0'";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }

  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }


}
