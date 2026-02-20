<?php
class Models_usergp extends ci_model
{

  function user_data($username)
  {

    $query=$this->db->query("SELECT `username`,`password` FROM `sg_mst_user` WHERE `username`='$username'");
    if($query->num_rows()>0){
      return $query->result();
    }
    else{
      return array();
    }
  }

  function update_data($whereu,$data,$table){
    $this->db->where($whereu);
    $this->db->update($table,$data);
}	

} 
?>