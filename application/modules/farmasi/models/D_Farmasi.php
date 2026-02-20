<?php

class D_Farmasi extends ci_model

{



  function mpasien(){
    /*
    $query=$this->db->query("
    SELECT  a.id_eresep,a.eresepdate,c.birthdate, c.name AS nama_pasien,b.*,d.name AS nama_dokter,e.name AS asuransi,a.is_bayar 
    FROM    soap_eresep a 
          LEFT JOIN trx_reg b ON a.id_reg=b.id_reg  
          LEFT JOIN mst_pasien c ON b.id_pasien=c.id_pasien
          LEFT JOIN mst_dokter d ON b.id_dokter_prt1=d.id_dokter
          LEFT JOIN mst_company e ON b.id_asuransi=e.id_company
    WHERE b.iostatus='0' AND a.is_bayar='0' 
    ORDER BY a.id_eresep DESC");
    */
    /*$query=$this->db->query("
    SELECT  a.id_eresep,a.eresepdate,c.birthdate, c.name AS nama_pasien,b.*,d.name AS nama_dokter,e.name AS asuransi,a.is_bayar 
    FROM    trx_reg b 
            LEFT JOIN soap_eresep a ON a.id_reg=b.id_reg AND a.is_bayar='0'
            LEFT JOIN mst_pasien c ON b.id_pasien=c.id_pasien
            LEFT JOIN mst_dokter d ON b.id_dokter_prt1=d.id_dokter
            LEFT JOIN mst_company e ON b.id_asuransi=e.id_company
    WHERE   b.iostatus='0' AND (b.is_reg_aps=1 OR a.id_eresep IS NOT NULL)
    ORDER BY b.regdate DESC
    LIMIT 1000
    ");*/
$q = $this->db->query("
SELECT
  se.id_eresep,
  se.eresepdate,
  p.birthdate,
  p.name AS nama_pasien,
  b.*,
  d.name AS nama_dokter,
  comp.name AS asuransi,
  COALESCE(se.is_bayar,0) AS is_bayar,

  /* ambil salah satu id_inv (mis. terbesar) untuk reg tsb */
  inv.id_inv,

  /* total tagihan valid untuk reg tsb */
  tag.total_tagihan

FROM trx_reg b

/* pilih 1 eresep per id_reg (contoh: yang id_eresep terbesar) */
LEFT JOIN soap_eresep se
  ON se.id_eresep = (
    SELECT MAX(se2.id_eresep)
    FROM soap_eresep se2
    WHERE se2.id_reg = b.id_reg
  )

LEFT JOIN mst_pasien p ON p.id_pasien = b.id_pasien
LEFT JOIN mst_dokter d ON d.id_dokter = b.id_dokter_prt1
LEFT JOIN mst_company comp ON comp.id_company = b.id_asuransi

LEFT JOIN (
  SELECT se2.id_reg, MAX(sed.id_inv) AS id_inv
  FROM soap_eresep_det sed
  JOIN soap_eresep se2 ON se2.id_eresep = sed.id_eresep
  GROUP BY se2.id_reg
) inv ON inv.id_reg = b.id_reg

LEFT JOIN (
  SELECT se2.id_reg, SUM(sed.subtotal) AS total_tagihan
  FROM soap_eresep_det sed
  JOIN soap_eresep se2 ON se2.id_eresep = sed.id_eresep
  WHERE sed.is_validasi = '1'
  GROUP BY se2.id_reg
) tag ON tag.id_reg = b.id_reg
  
WHERE b.iostatus = '0'
  AND b.is_reg_aps = 0
  AND b.regdate >= CURDATE() - INTERVAL 6 DAY
  AND b.regdate < CURDATE() + INTERVAL 1 DAY


ORDER BY b.regdate DESC
LIMIT 1000;

");
return $q->result();

  }
  
    function mpasien_aps(){
    /*
    $query=$this->db->query("
    SELECT  a.id_eresep,a.eresepdate,c.birthdate, c.name AS nama_pasien,b.*,d.name AS nama_dokter,e.name AS asuransi,a.is_bayar 
    FROM    soap_eresep a 
          LEFT JOIN trx_reg b ON a.id_reg=b.id_reg  
          LEFT JOIN mst_pasien c ON b.id_pasien=c.id_pasien
          LEFT JOIN mst_dokter d ON b.id_dokter_prt1=d.id_dokter
          LEFT JOIN mst_company e ON b.id_asuransi=e.id_company
    WHERE b.iostatus='0' AND a.is_bayar='0' 
    ORDER BY a.id_eresep DESC");
    */
    /*$query=$this->db->query("
    SELECT  a.id_eresep,a.eresepdate,c.birthdate, c.name AS nama_pasien,b.*,d.name AS nama_dokter,e.name AS asuransi,a.is_bayar 
    FROM    trx_reg b 
            LEFT JOIN soap_eresep a ON a.id_reg=b.id_reg AND a.is_bayar='0'
            LEFT JOIN mst_pasien c ON b.id_pasien=c.id_pasien
            LEFT JOIN mst_dokter d ON b.id_dokter_prt1=d.id_dokter
            LEFT JOIN mst_company e ON b.id_asuransi=e.id_company
    WHERE   b.iostatus='0' AND (b.is_reg_aps=1 OR a.id_eresep IS NOT NULL)
    ORDER BY b.regdate DESC
    LIMIT 1000
    ");*/
    $query=$this->db->query("
    SELECT  a.id_eresep,a.eresepdate,c.birthdate, c.name AS nama_pasien,b.*,d.name AS nama_dokter,e.name AS asuransi,a.is_bayar,f.id_inv,(SELECT SUM(subtotal) FROM soap_eresep_det WHERE id_eresep=a.id_eresep AND is_validasi=1) AS total_tagihan
    FROM    trx_reg b 
            LEFT JOIN soap_eresep a ON a.id_reg=b.id_reg
            LEFT JOIN mst_pasien c ON b.id_pasien=c.id_pasien
            LEFT JOIN mst_dokter d ON b.id_dokter_prt1=d.id_dokter
            LEFT JOIN mst_company e ON b.id_asuransi=e.id_company
            LEFT JOIN soap_eresep_det f ON a.id_eresep=f.id_eresep
   WHERE   b.iostatus='0' AND b.is_reg_aps=1 
    GROUP BY b.id_reg
    ORDER BY b.regdate DESC
    LIMIT 1000;
    ");
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
  
  ### ADDED BY sarkonah ###
  function fnderesepbyreg($id_reg){

    $query=$this->db->query("SELECT a.id_eresep FROM soap_eresep a WHERE a.id_reg='$id_reg' ORDER BY a.id_eresep DESC LIMIT 1");

    return $query->row();

  }







} 





?>