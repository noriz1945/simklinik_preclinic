<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_kpk_icu extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  ///////////////////

  public function tbmst(){
    $sql    = "SELECT * FROM frm_mst_kpk_icu WHERE hapus='0' ORDER BY grup_id,nilai ASC";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }

  public function add_data_jam121($data){
    $this->dbsupp->insert('frm_trn_kpk_icu', $data);
  } 

  function tbchecklogjam_1($idreg,$id_mst_news){
    $sql    = "SELECT COUNT(*) AS fnddata_1 FROM frm_trn_kpk_icu WHERE id_reg='$idreg' AND id_mst_news='$id_mst_news'";
    $query  = $this->dbsupp->query($sql);
    $result = $query->row();
    return $result;
  }

  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }


}
