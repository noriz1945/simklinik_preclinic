<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_sprit extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  ///////////////////

  public function list_dokter(){
    $sql    = "SELECT * FROM smart_login WHERE id_role='2' ORDER BY name ASC";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }

  function data_pasien_ranap($id_reg){
    $sql ="SELECT 	TL.id_reg, MP.pid_num, TR.id_pasien, CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS nama_pasien,
					'' AS umur, (CASE MP.gender WHEN 0 THEN 'Laki-Laki' WHEN 1 THEN 'Perempuan' END) AS gender,
					TL.id_kmr_from, TL.id_bed_from, MKF.name AS kelas_from, TR.regdate,
					TL.indate, TL.id_reg_kmr AS no_kamar, TL.id_bed,
					MKM.`description` AS kamar, MK.name AS kelas, TR.id_icd, MD.name AS dokter, MD.id_dokter,
					TR.penanggung, MC.name AS company, MP.birthdate,
					MIN(DATE(TL.`indate`)) AS tgl_masuk, MAX(DATE(TL.`outdate`)) AS tgl_keluar,
          MP.address, DATE_FORMAT(MP.`birthdate`, '%d-%m-%Y') AS tgl_lahir,
          YEAR(curdate()) - YEAR(MP.birthdate) AS umur1,
          CONCAT(TIMESTAMPDIFF( YEAR, MP.birthdate, now() ),' thn ',
          TIMESTAMPDIFF( MONTH, MP.birthdate, now() ) % 12 ,' bln ',
          FLOOR( TIMESTAMPDIFF( DAY, MP.birthdate, now() ) % 30.4375 ),' hr ') AS umur2
				FROM (
					SELECT 	MM.id_reg,
						IF(NULL=MM.id_reg, CAST(NULL AS char), NULL) AS id_kmr_from,
						(NULL=MM.id_reg_kmr) AS kmr_tmp,
						IF(NULL=MM.id_reg, CAST(NULL AS char), NULL) AS id_bed_from,
						(NULL=MM.id_bed) AS bed_tmp,
						IF(NULL=MM.id_reg, CAST(NULL AS unsigned), NULL) AS id_kelas_from,
						(NULL=MM.id_kelas) AS kelas_tmp,
						IF(NULL=MM.id_reg, NULL, NULL=MM.id_reg) AS reg_tmp,
						MM.indate, MM.outdate, MM.id_reg_kmr, MM.id_bed, MM.id_kelas
					FROM (
						SELECT TRK.*
						FROM (
							SELECT DISTINCT TRK.id_reg
							FROM trx_reg_kmr TRK
							WHERE TRK.cancel = 0
							) AS M
							INNER JOIN trx_reg_kmr TRK ON TRK.id_reg=M.id_reg
						ORDER BY TRK.id_reg, TRK.indate
					) AS MM
				) AS TL
					LEFT JOIN trx_reg TR ON TL.id_reg = TR.id_reg
					LEFT JOIN mst_pasien MP ON TR.id_pasien  = MP.id_pasien
					LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
					LEFT JOIN mst_kelas MK ON TL.id_kelas  = MK.id_kelas
					LEFT JOIN mst_kelas MKF ON TL.id_kelas_from  = MKF.id_kelas
					LEFT JOIN mst_dokter MD ON TR.id_dokter_prt1  = MD.id_dokter
					LEFT JOIN mst_company MC ON TR.id_asuransi  = MC.id_company
					LEFT JOIN mst_kamar MKM ON TL.id_reg_kmr = MKM.id_kamar

				WHERE
				TR.id_reg= '".$id_reg."'
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->row_array();
    return $result;
  }

  public function add_data_sprit($data){
    $this->dbsupp->insert('frm_asm_sprit', $data);
  } 

  function tblogsprit($id){
    $sql    = "SELECT a.*,b.name AS nama_dokter FROM frm_asm_sprit a LEFT JOIN smart_login b ON a.dokter_set=b.login_name WHERE a.id_reg='$id' AND a.hapus='0' ORDER BY a.created DESC";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }

  function detdata($id){
    $sql    = "SELECT * FROM frm_asm_sprit WHERE id='$id'";
    $query  = $this->dbsupp->query($sql);
    $result = $query->row();
    return $result;
  }
  
  function get_umur($id_reg){
    $sql ="SELECT YEAR(curdate()) - YEAR(MP.birthdate) AS umur
          FROM trx_reg TR
          LEFT JOIN mst_pasien MP ON TR.id_pasien = MP.id_pasien
          WHERE TR.id_reg= '".$id_reg."'
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->row_array();
    return $result;
  }

  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }

  function get_data_byid($idset)
  {
    $sql = "SELECT a.*,b.name AS nama_dokter FROM frm_asm_sprit a LEFT JOIN smart_login b ON a.dokter_set=b.login_name WHERE a.id='$idset'";
    $query  = $this->dbsupp->query($sql);
    $result = $query->row();
    //$result = $result[0];
    return $result;
  }


}
