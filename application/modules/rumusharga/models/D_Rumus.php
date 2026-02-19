<?php
class D_Rumus extends ci_model
{


  ////////////////////////////
  function dlistrumus(){
    $query=$this->db->query("SELECT * FROM ish_mstrumus WHERE status='0' ORDER BY created DESC");
    return $query->result();
  }

  function cdk(){
    $query=$this->db->query("SELECT no_rumus FROM ish_mstrumus ORDER BY created DESC limit 1");
    return $query->row();
  }

    function ins1($datains,$table){
    $this->db->insert($table,$datains);
  }

  function detail_obatnya($id_obat){
    $query=$this->db->query("SELECT a.name AS nama_obat, sale_price
    FROM mst_farmalkes a 
    WHERE a.id_fa='$id_obat'");
    return $query->row();
  }

  function list_obat_per_norumus($norumus){
    $query=$this->db->query("SELECT a.*,b.name AS nama_perusahaan,c.name AS nama_obat
    FROM ish_mstrumus_det a 
    LEFT JOIN mst_company b ON a.id_comp=b.id_company
    LEFT JOIN mst_farmalkes c ON a.id_obat=c.id_fa
    WHERE a.no_rumus='$norumus' AND a.status='0'");
    return $query->result();
  }

  function list_obat_per_norumus_edt($norumus){
    $query=$this->db->query("SELECT a.*,b.name AS nama_perusahaan,c.name AS nama_obat
    FROM ish_mstrumus_det a 
    LEFT JOIN mst_company b ON a.id_comp=b.id_company
    LEFT JOIN mst_farmalkes c ON a.id_obat=c.id_fa
    WHERE a.no_rumus='$norumus' AND a.status='0'");
    return $query->result();
  }

  function dlistrumus_edt($norumus){
    $query=$this->db->query("SELECT a.*,b.name AS nama_perusahaan
    FROM ish_mstrumus_det a 
    LEFT JOIN mst_company b ON a.id_comp=b.id_company
    WHERE a.no_rumus='$norumus' AND a.status='0'");
    return $query->row();
  }
  
  ////////////////////////////

  function mobat(){
    $query=$this->db->query("SELECT * FROM  mst_farmalkes ORDER BY name ASC");
    return $query->result();
  }



  
  function dlistpo_det_edt($no_po){
    $query=$this->db->query("SELECT * FROM ish_wioutpo_det WHERE no_po='$no_po'");
    return $query->result();
  }

  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }


  //cetak PO
  function dlistpo_set($no_po){
    $query=$this->db->query("SELECT * FROM trx_createpo WHERE no_po='$no_po' AND status='0'");
    return $query->result();
  }

  function dlistpo_nya($no_po){
    $query=$this->db->query("SELECT a.*,b.nama_perusahaan,b.alamat,b.keterangan
    FROM  trx_createmstpo a 
    LEFT JOIN mst_company b ON a.id_perusahaan=b.id_perusahaan   
    WHERE a.no_po='$no_po' AND a.status='0'
    GROUP BY a.no_po ORDER BY a.no_po DESC");
    return $query->row();
  }

  function dlistpo_pembayaran($no_po){
    $query=$this->db->query("SELECT * FROM trx_createpo WHERE no_po='$no_po'");
    return $query->result();
  }
  //END CETAK PO

} 


?>