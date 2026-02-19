<?php
class D_Poreqpemobt extends ci_model
{

  function mobat(){
    $query=$this->db->query("SELECT * FROM  mst_farmalkes ORDER BY name ASC");
    return $query->result();
  }

  function detail_obatnya($id_obat){
    $query=$this->db->query("SELECT b.name AS kemasan,c.name AS satuan,a.konversi
    FROM mst_farmalkes a 
    LEFT JOIN mst_farmalkes_unit b ON b.id_satuan=a.id_kemasan
    LEFT JOIN mst_farmalkes_type c ON c.id_jenis=a.id_type
    WHERE a.id_fa='$id_obat'");
    return $query->row();
  }

  function ins1($datains,$table){
    $this->db->insert($table,$datains);
  }

  function cdk(){
    $query=$this->db->query("SELECT no_po FROM ish_wioutpo ORDER BY created DESC limit 1");
    return $query->row();
  }

  function dlistpo(){
    $query=$this->db->query("SELECT * FROM ish_wioutpo");
    return $query->result();
  }

  function dlistpo_edt($no_po){
    $query=$this->db->query("SELECT * FROM ish_wioutpo WHERE no_po='$no_po'");
    return $query->row();
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
    $query=$this->db->query("SELECT a.*,b.nama_supplier,b.alamat,b.keterangan
    FROM  trx_createmstpo a 
    LEFT JOIN mst_supplier b ON a.id_supplier=b.id_supplier   
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