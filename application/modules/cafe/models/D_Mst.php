<?php
class D_Mst extends ci_model
{

//////////////////////////////////////////////////////////////////////////////////////MST HEADER
function list_header(){
  $query=$this->db->query("SELECT * FROM cafe_headermenu ORDER BY name ASC");
  return $query->result();
}
function edit_header($id){
  $query=$this->db->query("SELECT * FROM cafe_headermenu WHERE id='$id'");
  return $query->row();
}
//////////////////////////////////////////////////////////////////////////////////////END MST HEADER

//////////////////////////////////////////////////////////////////////////////////////MST ITEM
function list_item(){
  $query=$this->db->query("SELECT * FROM cafe_itemmenu ORDER BY nama_produk ASC");
  return $query->result();
}
function mst_header(){
  $query=$this->db->query("SELECT * FROM cafe_headermenu ORDER BY name ASC");
  return $query->result();
}
function edit_item($id){
  $query=$this->db->query("SELECT * FROM cafe_itemmenu WHERE id='$id'");
  return $query->row();
}
//////////////////////////////////////////////////////////////////////////////////////END MST ITEM
  function ins1($datains,$table){
    $this->db->insert($table,$datains);
  }
  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }
} 
?>