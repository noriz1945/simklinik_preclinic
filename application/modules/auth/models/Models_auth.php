<?php
class Models_auth extends ci_model
{
  function input_data($data,$table){
    $this->db->insert($table,$data);
  }
}

  


