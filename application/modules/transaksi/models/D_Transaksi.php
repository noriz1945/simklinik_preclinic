<?php
class D_Transaksi extends ci_model
{

  function mtindakan(){
    $query=$this->db->query("SELECT a.id_act,a.name as nama_tindakan,a.price,b.name as nama_grup,c.name as nama_subgrup,b.id_group as idgrup 
    FROM mst_tindakan a 
    LEFT JOIN mst_tindakan_grup b ON a.id_group=b.id_group
    LEFT JOIN mst_tindakan_subgrup c ON a.id_subgroup=c.id_subgroup 
    ORDER BY a.name ASC");
    return $query->result();
  }

  function fnddatadokter($id_reg){
    $query=$this->db->query("SELECT id_dokter_prt1 FROM trx_reg WHERE id_reg='$id_reg'");
    return $query->row();
  }

  

  function createregact($data_trx_reg_act,$table){
    $this->db->insert($table,$data_trx_reg_act);
  }

  function mpasien($nama_pasien, $id_pasien, $tgl_lahir, $id_reg){
    if(!empty($nama_pasien)){
        $que_nama_pasien = " AND b.name LIKE '%$nama_pasien%'";
    }else{
        $que_nama_pasien = "";
    }

    if(!empty($id_pasien)){
        $que_id_pasien = " AND a.id_pasien LIKE '%$id_pasien%'";
    }else{
        $que_id_pasien = "";
    }

    if(!empty($tgl_lahir)){
        $que_tgl_lahir = " AND b.birthdate LIKE '%$tgl_lahir%'";
    }else{
        $que_tgl_lahir = "";
    }

    if(!empty($id_reg)){
      $que_id_reg = " AND a.id_reg='$id_reg'";
  }else{
      $que_id_reg = "";
  }


    $query=$this->db->query("SELECT *,(SELECT COUNT(id_trx) FROM trx_reg_act WHERE id_reg=a.id_reg AND id_inv IS NULL) AS counttindakanunproses FROM trx_reg a LEFT JOIN mst_pasien b ON a.id_pasien=b.id_pasien WHERE b.aktif IN ('0','1') $que_nama_pasien $que_id_pasien $que_tgl_lahir $que_id_reg ORDER BY b.name ASC LIMIT 100");
    return $query->result();
  }

  function trxregr($id_reg){
    $query=$this->db->query("SELECT *,a.name AS nameset, c.name AS name_group, d.name AS name_subgroup
    FROM trx_reg_act a 
    LEFT JOIN mst_tindakan b ON a.id_reg_act=b.id_act 
    LEFT JOIN mst_tindakan_grup c ON b.id_group=c.id_group 
    LEFT JOIN mst_tindakan_subgrup d ON b.id_subgroup=d.id_subgroup 
    WHERE a.id_reg='$id_reg'");
    return $query->result();
  }

  function trxregrdraft($id_reg){
    $query=$this->db->query("SELECT *, c.name AS name_group, d.name AS name_subgroup
    FROM temp_item_tindakan a
    LEFT JOIN mst_tindakan b ON a.idset=b.id_act 
    LEFT JOIN mst_tindakan_grup c ON b.id_group=c.id_group 
    LEFT JOIN mst_tindakan_subgrup d ON b.id_subgroup=d.id_subgroup 
    WHERE a.id_reg_set='$id_reg'");
    return $query->result();
  }

} 


?>