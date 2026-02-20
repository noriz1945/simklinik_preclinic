<?php

class D_Farmasi extends ci_model

{



  function mpasien(){
    $query=$this->db->query("SELECT a.id_eresep,a.eresepdate,c.birthdate, c.name AS nama_pasien,b.*,d.name AS nama_dokter,e.name AS asuransi FROM soap_eresep a 
    LEFT JOIN trx_reg b ON a.id_reg=b.id_reg  
    LEFT JOIN mst_pasien c ON b.id_pasien=c.id_pasien
    LEFT JOIN mst_dokter d ON b.id_dokter_prt1=d.id_dokter
    LEFT JOIN mst_company e ON b.id_asuransi=e.id_company
    WHERE b.iostatus='0' AND a.is_bayar='0' ORDER BY a.id_eresep DESC");
    return $query->result();
  }



  function data_list_farmasi(){

    $query=$this->db->query("SELECT * FROM mst_supplier");

    return $query->result(); 

  } 



  function data_list_farmasi_header(){

    $query=$this->db->query("SELECT id AS draw , COUNT(id) AS recordsTotal, COUNT(ID) AS recordsFiltered  FROM mst_markup_harga");

    return $query->row(); 

  } 







  function fndidreg($id_eresep){

    $query=$this->db->query("SELECT a.id_reg FROM soap_eresep a WHERE a.id_eresep='$id_eresep'");

    return $query->row();

  }







} 





?>