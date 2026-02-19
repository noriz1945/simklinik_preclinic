<?php
class D_Sto extends ci_model
{
  ////////////////////////////
  function dliststo($tglmulai_set,$tglakhir_set){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang FROM trx_lgs_sto a LEFT JOIN mst_warehouse b ON a.id_wrh=b.id_wrh 
    WHERE DATE_FORMAT(a.stodate,'%Y-%m-%d') BETWEEN '$tglmulai_set' AND '$tglakhir_set'
    ORDER BY a.created DESC");
    return $query->result();
  }
  function cdk(){
    $query=$this->db->query("SELECT id_sto FROM trx_lgs_sto ORDER BY created DESC limit 1");
    return $query->row();
  }
  function ins1($datains,$table){
    $this->db->insert($table,$datains);
  }

  function ins2($datains2,$table){
    $this->db->insert($table,$datains2);
  }

  function ins3($datains3,$table){
    $this->db->insert($table,$datains3);
  }


  function data_soh_obat($id_obat_set,$id_wrh_set){
    $query=$this->db->query("SELECT a.id_soh,a.id_wrh,a.qty,b.no_rak FROM mst_soh a LEFT JOIN mst_wrh_mm b ON (a.id_wrh=b.id_wrh AND a.id_soh=b.id_fa)  WHERE a.id_wrh='$id_wrh_set' AND a.id_soh='$id_obat_set' ");
    return $query->row();
  }

  
  function data_tersedia_obat_gudang($id_obat_set,$id_wrh_set,$no_rak_set){
    $query=$this->db->query("SELECT COUNT(*) AS totalnyah FROM mst_wrh_mm WHERE id_wrh='$id_wrh_set' AND id_fa='$id_obat_set' AND no_rak='$no_rak_set' AND aktif='0'");
    return $query->row();
  }

  ///////////////////////
  function detail_obatnya($id_obat){
    $query=$this->db->query("SELECT a.name AS nama_obat, sale_price
    FROM mst_farmalkes a 
    WHERE a.id_fa='$id_obat'");
    return $query->row();
  }
  function list_obat_per_nosto($no_sto_p,$id_wrh,$no_rak){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,c.qty AS qty_soh FROM mst_wrh_mm a 
    LEFT JOIN mst_farmalkes b ON a.id_fa=b.id_fa
    LEFT JOIN mst_soh c ON (a.id_fa=c.id_soh AND a.id_wrh=c.id_wrh) 
    WHERE a.id_wrh='$id_wrh' AND a.no_rak='$no_rak'  AND b.name IS NOT NULL ORDER BY b.name ASC"); //AND a.aktif='0'
    return $query->result();
  }
  function list_obat_per_nosto_aftersave($no_sto_p,$id_wrh,$no_rak){
    $query=$this->db->query("SELECT a.*,a.id_trx_det AS id_fa,b.name AS nama_obat,c.qty AS qty_soh ,d.name AS nama_rak
    FROM trx_lgs_sto_det a 
    LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa 
    LEFT JOIN mst_soh c ON (a.id_trx_det=c.id_soh AND c.id_wrh='$id_wrh')
    LEFT JOIN mst_rak d ON a.no_rak=d.id_rak
    WHERE a.id_sto='$no_sto_p' AND b.name IS NOT NULL AND a.aktif='1'
    ORDER BY b.name ASC"); //AND a.aktif='0' AND a.id_wrh='$id_wrh' AND a.no_rak='$no_rak'
    return $query->result();
  }

  function list_obat_per_nosto_no_rak($id_wrh,$no_rak){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,c.qty AS qty_soh,d.name AS nama_rak
    FROM mst_wrh_mm a 
    LEFT JOIN mst_farmalkes b ON a.id_fa=b.id_fa
    LEFT JOIN mst_soh c ON (a.id_fa=c.id_soh AND a.id_wrh=c.id_wrh) 
    LEFT JOIN mst_rak d ON a.no_rak=d.id_rak
    WHERE a.id_wrh='$id_wrh' AND b.name IS NOT NULL AND a.aktif='0' ORDER BY d.id_rak,b.name ASC"); //AND a.aktif='0' AND a.no_rak='$no_rak'
    return $query->result();
  }
  function list_obat_per_nosto_edt($id_wrh,$id_rak,$nosto){
    $query=$this->db->query("SELECT a.*,a.id_trx_det AS id_fa,b.name AS nama_obat,a.min,d.name AS nama_rak
    FROM trx_lgs_sto_det a 
    LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa
    LEFT JOIN mst_rak d ON a.no_rak=d.id_rak
    WHERE a.id_sto='$nosto' AND b.name IS NOT NULL AND a.aktif='1' ORDER BY a.no_rak,b.name ASC
    
    "); //AND c.id_wrh='$id_wrh' AND c.no_rak='$id_rak'
    return $query->result();
  }
  
  /* # 1
    function list_obat_per_nosto_edt($id_wrh){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,c.qty AS qty_soh FROM mst_wrh_mm a 
    LEFT JOIN mst_farmalkes b ON a.id_fa=b.id_fa
    LEFT JOIN mst_soh c ON (a.id_fa=c.id_soh AND a.id_wrh=c.id_wrh) 
    WHERE a.id_wrh='$id_wrh' AND a.aktif='0' AND b.name IS NOT NULL ORDER BY b.name ASC");
    return $query->result();
  }

  /* # 2
    function list_obat_per_nosto_edt($id_wrh,$nosto){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,c.min FROM trx_lgs_sto_det a LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa LEFT JOIN mst_wrh_mm
    c ON a.id_trx_det=c.id_fa WHERE a.id_sto='$nosto'");
    return $query->result();
  }
  */
  

  function list_obat_per_nosto_edt_ststo($no_sto){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,d.qty AS qty_last_in_depo
    FROM trx_lgs_sto_det a 
    LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa
    LEFT JOIN trx_lgs_sto c ON a.id_sto=c.id_sto
    LEFT JOIN mst_soh d ON (a.id_trx_det=d.id_soh AND d.id_wrh=c.id_wrh)
    WHERE a.id_sto='$no_sto' AND a.aktif='1' ORDER BY b.name ASC");
    return $query->result(); 
  }
  function list_obat_per_nosto_edt_endsto($nosto, $start, $finish){ 
    $query=$this->db->query("SELECT a.*,
        b.id_fa,b.name AS nama_obat,c.id_wrh,d.qty AS qty_last_in_depo,
        (SELECT SUM(bb.qty)  FROM soap_eresep_det aa 
        LEFT JOIN soap_eresep_det_racikan bb ON (aa.id_eresep=bb.id_eresep)
        LEFT JOIN trx_reg_inv cc ON (aa.id_inv=cc.id_inv)
        WHERE bb.id_trx_det=b.id_fa AND DATE_FORMAT(cc.invdate,'%Y-%m-%d %H:%i:%s') BETWEEN '$start' AND '$finish' AND aa.id_inv IS NOT NULL AND aa.is_racikan=1) AS jumlah_racikan,
        
        (SELECT SUM(bb.qty)  FROM soap_eresep_det aa 
        LEFT JOIN soap_eresep_det_racikan bb ON (aa.id_eresep=bb.id_eresep)
        LEFT JOIN trx_reg_inv cc ON (aa.id_inv=cc.id_inv)
        WHERE bb.id_trx_det=b.id_fa AND DATE_FORMAT(cc.invdate,'%Y-%m-%d %H:%i:%s') BETWEEN '$start' AND '$finish' AND aa.id_inv IS NOT NULL AND aa.is_racikan=0) AS jumlah_non_racikan,
        (a.qty-d.qty) AS total_pre_fix
        
       FROM trx_lgs_sto_det a 
       LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa
       LEFT JOIN trx_lgs_sto c ON a.id_sto=c.id_sto
       LEFT JOIN mst_soh d ON (a.id_trx_det=d.id_soh AND d.id_wrh=c.id_wrh)
       WHERE a.id_sto='$nosto' AND a.aktif='1' ORDER BY b.name ASC");
    return $query->result(); 
  }

  function proses_soh($nosto, $start, $finish){ 
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat,c.id_wrh,d.qty AS qty_last_in_depo,(a.qty) AS for_qty_update,
    (SELECT SUM(bb.qty)  FROM soap_eresep_det aa 
        LEFT JOIN soap_eresep_det_racikan bb ON (aa.id_eresep=bb.id_eresep)
        LEFT JOIN trx_reg_inv cc ON (aa.id_inv=cc.id_inv)
        WHERE bb.id_trx_det=b.id_fa AND DATE_FORMAT(cc.invdate,'%Y-%m-%d %H:%i:%s') BETWEEN '$start' AND '$finish' AND aa.id_inv IS NOT NULL AND aa.is_racikan=1) AS jumlah_racikan,
    
    (SELECT SUM(bb.qty)  FROM soap_eresep_det aa 
        LEFT JOIN soap_eresep_det_racikan bb ON (aa.id_eresep=bb.id_eresep)
        LEFT JOIN trx_reg_inv cc ON (aa.id_inv=cc.id_inv)
        WHERE bb.id_trx_det=b.id_fa AND DATE_FORMAT(cc.invdate,'%Y-%m-%d %H:%i:%s') BETWEEN '$start' AND '$finish' AND aa.id_inv IS NOT NULL AND aa.is_racikan=0) AS jumlah_non_racikan,

    ((SELECT for_qty_update) - ((SELECT 
    CASE
    WHEN jumlah_racikan IS NULL THEN 0
    ELSE jumlah_racikan END )+(SELECT 
    CASE 
    WHEN jumlah_non_racikan IS NULL THEN 0
    ELSE jumlah_non_racikan END))) AS total_fix 
    
    FROM trx_lgs_sto_det a 
    LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa
    LEFT JOIN trx_lgs_sto c ON a.id_sto=c.id_sto
    LEFT JOIN mst_soh d ON (a.id_trx_det=d.id_soh AND d.id_wrh=c.id_wrh)
    WHERE a.id_sto='$nosto' AND a.aktif='1' ORDER BY a.created DESC");
    return $query->result(); 
  }
  function dliststo_edt($no_sto){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang ,c.name AS nama_rak
    FROM trx_lgs_sto a 
    LEFT JOIN mst_warehouse b ON a.id_wrh=b.id_wrh
    LEFT JOIN mst_rak c ON a.no_rak=c.id_rak
    WHERE a.id_sto='$no_sto'");
    return $query->row();
  }

    function check_data_mst_soh($id_obat, $id_wrh){
    $query=$this->db->query("SELECT COUNT(*) AS datafnd FROM mst_soh WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'");
    return $query->row();
  }

  function list_obat_per_nosto_edt_ststo_finish($no_sto){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat
    FROM trx_lgs_sto_det a 
    LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa 
    WHERE a.id_sto='$no_sto' AND a.aktif='1' ORDER BY a.created DESC");
    return $query->result(); 
  }

  function get_data_liststo($id_sto){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat
    FROM trx_lgs_sto_det a 
    LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa 
    WHERE a.id_sto='$id_sto' AND a.aktif='1' ORDER BY a.created DESC");
    return $query->result(); 
  }

  function get_data_note($id_sto){
    $query=$this->db->query("SELECT catatan
    FROM trx_lgs_sto a 
    WHERE a.id_sto='$id_sto'");
    return $query->row(); 
  }

  function dliststo_edt_ststo($no_sto){
    $query=$this->db->query("SELECT a.*,b.name AS nama_obat
    FROM trx_lgs_sto_det a 
    LEFT JOIN mst_farmalkes b ON a.id_trx_det=b.id_fa 
    WHERE a.id_sto='$no_sto' AND a.aktif='1' ORDER BY a.created DESC");
    return $query->row();
  }

  function dliststo_edt_ststo_starttoend($no_sto){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang 
    FROM trx_lgs_sto a 
    LEFT JOIN mst_warehouse b ON a.id_wrh=b.id_wrh
    WHERE a.id_sto='$no_sto'");
    return $query->row();
  }

  function dliststo_edt_endsto($no_sto){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang 
    FROM trx_lgs_sto a 
    LEFT JOIN mst_warehouse b ON a.id_wrh=b.id_wrh
    WHERE a.id_sto='$no_sto'");
    return $query->row();
  }

  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }
  
  function cdk_gudang_sto($id_obat, $id_wrh, $id_rak_set){
    $query=$this->db->query("SELECT COUNT(*) AS countget FROM mst_wrh_mm WHERE id_fa='$id_obat' AND id_wrh='$id_wrh' AND no_rak='$id_rak_set'");
    return $query->row();
  }

  function dliststo_spv(){
    $query=$this->db->query("SELECT a.*,b.name AS nama_gudang FROM trx_lgs_sto a LEFT JOIN mst_warehouse b ON a.id_wrh=b.id_wrh WHERE a.status='2' ORDER BY a.created DESC");
    return $query->result();
  }
  ///////sto rak
  function dliststo_gudang(){
    $query=$this->db->query("SELECT * FROM  mst_warehouse WHERE aktif='1' ORDER BY name ASC");
    return $query->result();
  }

  function list_obat_per_gudang($id){ 
    $query=$this->db->query("SELECT a.id_fa,a.name,b.id_wrh,b.min,b.no_rak
    FROM mst_farmalkes a 
    LEFT JOIN mst_wrh_mm b ON (a.id_fa=b.id_fa AND b.id_wrh='$id') ORDER BY a.name");
    return $query->result(); 
  }

  function cdk_gudang($id_obat, $id_wrh){
    $query=$this->db->query("SELECT COUNT(*) AS countget FROM mst_wrh_mm WHERE id_fa='$id_obat' AND id_wrh='$id_wrh'");
    return $query->row();
  }
  ///////end sto rak




  //KARTU STOK
  function get_data_obat($id_obat, $id_wrh){
    $query=$this->db->query("SELECT qty FROM mst_soh WHERE id_soh='$id_obat' AND id_wrh='$id_wrh'");
    return $query->row();
  }

  function cdk_kartu_stok(){
    $query=$this->db->query("SELECT id_kode FROM gdf_kartu_stok WHERE kode='STO' ORDER BY created DESC limit 1");
    return $query->row();
  }
  //END KARTU STOK
} 
?>