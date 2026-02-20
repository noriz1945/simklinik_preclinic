<?php
class D_spb extends ci_model
{

  function mspb(){
    $query=$this->db2->query("SELECT b.name AS nama_group,a.* FROM trx_reg_act a LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group WHERE a.id_reg='01230100003' AND a.id_group_act=b.id_group ORDER BY b.name ASC");
    return $query->result();
  }

  function mspb_pkt(){
    $query=$this->db2->query("SELECT a.*,(CASE WHEN b.id_paket IS NULL THEN 'TINDAKAN LUAR PAKET' ELSE c.name END) AS name_group_is_paket
    FROM trx_reg_act a 
    -- LEFT JOIN mst_tindakan_grup b ON (a.id_reg_act=b.id_trx_det )
    -- LEFT JOIN mst_tindakan c ON a.id_reg_act=c.id_act
    LEFT JOIN mst_paket_det b ON (a.id_reg_act=b.id_trx_det AND b.id_paket='P210203')
    LEFT JOIN mst_paket c ON b.id_paket=c.id_paket
    WHERE a.id_reg='01230100003' 
    -- AND a.id_group_act=c.id_group 
    -- AND b.id_group=1
    -- GROUP BY a.id_reg_act
    -- ORDER BY b.name ASC;
    -- AND c.id_paket='P130401'
    ");
    return $query->result();
  }
  //SELECT a.name FROM trx_reg_act a LEFT JOIN mst_tindakan_grup b ON a.id_group_act=b.id_group WHERE a.id_reg='$id_reg' AND a.id_group_act='$id_group_act'

  function dnu()
  {
    $query=$this->db2->query("SELECT max(nosp) as nourut FROM z_set_spb ");
    return $query->row();
  }

  function listspb()
  {
    $query=$this->db2->query("SELECT * FROM trx_reg_act a
    -- LEFT JOIN fakturpembelian_t b ON a.idspb=b.fakturpembelian_id
    -- GROUP BY a.nosp,a.tgltf,a.tgljtm,a.tgltkt ORDER BY a.nosp ASC
    ");
    return $query->result();
  }

  function detailspb($nosp){
    $query=$this->db2->query("SELECT 
    a.permintaanpembelian_id, a.nopermintaan
    , b.supplier_nama
    , b.supplier_norekening
    , b.supplier_namabank
    , d.nofaktur , d.tglfaktur , d.totharganetto, d.pegawaimenyetujuikeuangan_id, d.keteranganfaktur, d.fakturpembelian_id, d.tgljatuhtempo,e.tgltf,e.tgljtm,e.tgltkt
    FROM 
    permintaanpembelian_t a
    LEFT JOIN supplier_m b ON b.supplier_id = a.supplier_id
    LEFT JOIN penerimaanbarang_t c ON a.permintaanpembelian_id = c.permintaanpembelian_id
    LEFT JOIN fakturpembelian_t d ON d.penerimaanbarang_id = c.penerimaanbarang_id
    LEFT JOIN z_set_spb e ON d.fakturpembelian_id=e.idspb
    WHERE e.nosp='$nosp'
    ORDER BY  b.supplier_nama ASC, c.permintaanpembelian_id ASC
    ");
    return $query->result();
  }

  function detailprintspb($nosp)
  {
    $query=$this->db2->query("SELECT 
    a.nosp, SUM(b.totharganetto) as total,a.tgltf,a.tgljtm,a.tgltkt
    FROM z_set_spb a
    LEFT JOIN fakturpembelian_t b ON a.idspb=b.fakturpembelian_id
    WHERE a.nosp='$nosp'
    GROUP BY a.nosp,a.tgltf,a.tgljtm,a.tgltkt ORDER BY a.nosp ASC");
    return $query->row();
  }

  function countspplrdetailprintspb($nosp)
  {
    $query=$this->db2->query("SELECT 
    DISTINCT(b.supplier_id)
    FROM z_set_spb a
    LEFT JOIN fakturpembelian_t b ON a.idspb=b.fakturpembelian_id
    LEFT JOIN supplier_m c ON b.supplier_id=c.supplier_id
    WHERE a.nosp='$nosp'
    GROUP BY b.supplier_id");
    return $query->num_rows();
  }

  function detailrincianspb($nosp){
    $query=$this->db2->query("SELECT 
    a.nopermintaan
  , b.supplier_nama
  , b.supplier_norekening
  , b.supplier_namabank
  , SUM(d.totharganetto) as totharganetto
  FROM 
  permintaanpembelian_t a
  LEFT JOIN supplier_m b ON b.supplier_id = a.supplier_id
  LEFT JOIN penerimaanbarang_t c ON a.permintaanpembelian_id = c.permintaanpembelian_id
  LEFT JOIN fakturpembelian_t d ON d.penerimaanbarang_id = c.penerimaanbarang_id
  LEFT JOIN z_set_spb e ON d.fakturpembelian_id=e.idspb
  WHERE e.nosp='$nosp'
  GROUP BY a.nopermintaan,b.supplier_nama,b.supplier_norekening,b.supplier_namabank");
    return $query->result();
  }
  

} 



/* 
a.permintaanpembelian_id, a.nopermintaan
    , b.supplier_nama
    , b.supplier_norekening
    , b.supplier_namabank
    , d.nofaktur , d.tglfaktur , d.totharganetto, d.pegawaimenyetujuikeuangan_id, d.keteranganfaktur, d.fakturpembelian_id, d.tgljatuhtempo
    FROM 
    permintaanpembelian_t a
    LEFT JOIN supplier_m b ON b.supplier_id = a.supplier_id
    LEFT JOIN penerimaanbarang_t c ON a.permintaanpembelian_id = c.permintaanpembelian_id
    LEFT JOIN fakturpembelian_t d ON d.penerimaanbarang_id = c.penerimaanbarang_id
    ORDER BY  b.supplier_nama ASC, c.permintaanpembelian_id ASC
*/
?>