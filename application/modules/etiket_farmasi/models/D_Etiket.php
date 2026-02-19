<?php
class D_Etiket extends ci_model
{

  //////////////////////////////////////////////////////////////////////////////////DAFTAR HARGA OBAT
  function datasetlistpasien($sql_search,$bln,$thn){
    $query=$this->db->query("SELECT DATE_FORMAT(a.eresepdate,'%d-%m-%Y') AS eresepdate,a.id_reg AS no_reg,a.id_eresep,c.name AS nama_pasien,b.id_pasien,DATE_FORMAT(c.birthdate,'%d-%m-%Y') AS tgllahir,d.name AS nama_dokter,c.birthdate FROM soap_eresep a 
            LEFT JOIN trx_reg b ON a.id_reg=b.id_reg 
            LEFT JOIN mst_pasien c ON b.id_pasien=c.id_pasien
            LEFT JOIN mst_dokter d ON b.id_dokter_prt1=d.id_dokter
            WHERE DATE_FORMAT(a.eresepdate,'%m-%Y')='$bln-$thn' AND a.id_reg is not null $sql_search
            GROUP BY a.id_reg");
    return $query->result();
  }

  function datadetaileresep($id_eresep){
    $query=$this->db->query("SELECT * FROM soap_eresep_det WHERE id_eresep='$id_eresep'");
    return $query->result();
  }

  function get_data_etiket_detail($id_eresep_det){	
    $sql = "SELECT * FROM soap_eresep_det WHERE id_eresep_det='$id_eresep_det'";
    $query = $this->db->query($sql);
    return $query->row();
  }

  function get_data_from_id_eresepdet($id_eresep_det){	
    $sql = "SELECT id_eresep FROM soap_eresep_det WHERE id_eresep_det='$id_eresep_det'";
    $query = $this->db->query($sql);
    return $query->row();
  }

  function get_data_from_id_eresep($id_eresep){	
    $sql = "SELECT id_reg,DATE_FORMAT(eresepdate,'%d-%m-%Y') AS eresepdate FROM soap_eresep WHERE id_eresep='$id_eresep'";
    $query = $this->db->query($sql);
    return $query->row();
  }

  function get_data_from_trx_reg($id_reg){	
    $sql = "SELECT id_pasien FROM trx_reg WHERE id_reg='$id_reg'";
    $query = $this->db->query($sql);
    return $query->row();
  }

  function get_data_from_mst_pasien($id_pasien){	
    $sql = "SELECT *,DATE_FORMAT(birthdate,'%d-%m-%Y') AS tgllahir FROM mst_pasien WHERE id_pasien='$id_pasien'";
    $query = $this->db->query($sql);
    return $query->row();
  }


  
  


  
  //////////////////////////////////////////////////////////////////////////////////END DAFTAR HARGA OBAT 
} 
?>