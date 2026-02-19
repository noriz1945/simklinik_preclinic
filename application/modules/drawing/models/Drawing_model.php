<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Drawing_model extends CI_Model
{
  function __construct(){
    parent::__construct();
  }

  public function save_drawing($data)
  {
    $this->dbsupp->insert('soap_drawing',$data);
    //return $this->dbsupp->insert_id();
  }

}