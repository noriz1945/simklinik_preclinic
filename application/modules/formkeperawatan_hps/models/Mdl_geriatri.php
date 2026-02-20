<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_geriatri extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  ///////////////////

  function data_pasien_ranap($id_reg)
  {
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

  function data_pasien_ranap_ott($id_reg)
  {
    $sql ="SELECT COUNT(*) AS fnddata FROM frm_asm_geriatri WHERE id_reg='$id_reg'";
    $query  = $this->dbsupp->query($sql);
    $result = $query->row_array();
    return $result;
  }

  public function add_data_asm_ranap($data){
    $this->dbsupp->insert('soap_asm_ri', $data);
  } 
  
  public function add_data_asm_ranap_ott($data_ott){
    $this->dbsupp->insert('frm_asm_geriatri', $data_ott);
  } 

  public function edit_data_asm_ranap($where, $data){
    $this->dbsupp->update('soap_asm_ri', $data, $where);
    return $this->dbsupp->affected_rows();
  }

  public function edit_data_asm_ranap_ott($where, $data){
    $this->dbsupp->update('frm_asm_geriatri', $data, $where);
    return $this->dbsupp->affected_rows();
  }
  
  //http://192.168.90.13/smartplus_dev/nurse_station/eranap/main_content/0919SA00010
  //////////////////

  function bed_status()
  {
    $sql ="SELECT MK.id_kamar, MK.description, MKB.id_bed, IFNULL(MKLR.name, MKL.name) AS kelas,
          TRK.id_reg, CONCAT(MP.Name,IFNULL(CONCAT(', ',MPT.abbr),'')) as name, MP.id_pasien,
          TRK.indate, MP.gender, MP.birthdate, MP.birthdate AS age, MA.name AS agama,
          IFNULL(MI.name, TR.diag) AS diagnosa,
          MD.name AS dokter, MC.name AS company,
          (CASE WHEN TR.rwjn=1 THEN 'RJ' WHEN TR.ugd=1 THEN 'GD' END) AS src,
          MP.address, MK.price, MK.id_kelas, MKB.id_status

          FROM mst_kamar MK
          LEFT JOIN mst_kamar_bed MKB ON MK.id_kamar=MKB.id_kamar
          LEFT JOIN mst_kelas MKL ON MK.id_kelas=MKL.id_kelas
          LEFT JOIN trx_reg_kmr TRK ON TRK.id_trx=MKB.id_trx
          LEFT JOIN trx_reg TR ON TR.id_reg=TRK.id_reg
          LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
          LEFT JOIN mst_kelas MKLR ON TR.id_kelas=MKLR.id_kelas
          LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
          LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
          LEFT JOIN mst_dokter MD ON TR.id_dokter_prt1=MD.id_dokter
          LEFT JOIN mst_icd MI ON TR.id_icd=MI.id_icd
          LEFT JOIN mst_agama MA ON MA.id_agama=MP.id_agama

          WHERE MK.aktif=1
          ORDER BY MK.id_kamar
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result_array();
    return $result;

  }

  function list_pasien_ranap()
  {
    $sql ="SELECT MK.id_kamar, MK.description, MKB.id_bed,
          IFNULL(MKLR.name, MKL.name) AS kelas, IFNULL(MI.name, TR.diag) AS diagnosa,
          TRK.indate, (CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
          '' AS umur,
          CONCAT(MP.Name,IFNULL(CONCAT(', ',MPT.abbr),'')) as name,
          MD.name AS dokter, MC.name AS company, TRK.id_reg,
          (CASE WHEN TR.rwjn=1 THEN 'RJ' WHEN TR.ugd=1 THEN 'GD' END) AS src,
          MP.id_pasien, MP.address, MP.birthdate

          FROM mst_kamar MK
          LEFT JOIN mst_kamar_bed MKB ON MK.id_kamar=MKB.id_kamar
          LEFT JOIN mst_kelas MKL ON MK.id_kelas=MKL.id_kelas
          LEFT JOIN trx_reg_kmr TRK ON TRK.id_trx=MKB.id_trx
          LEFT JOIN trx_reg TR ON TR.id_reg=TRK.id_reg
          LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company
          LEFT JOIN mst_kelas MKLR ON TR.id_kelas=MKLR.id_kelas
          LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
          LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
          LEFT JOIN mst_dokter MD ON TR.id_dokter_prt1=MD.id_dokter
          LEFT JOIN mst_icd MI ON TR.id_icd=MI.id_icd
          WHERE MK.aktif=1
          AND (MKB.id_status=2)
          ORDER BY MK.id_kamar
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result_array();
    return $result;

  }



  function get_cppt_igd($id_reg)
  {
    $sql =" SELECT SC.*, b.name AS ppa_name
            FROM soap_cppt SC
            LEFT JOIN smart_login b ON SC.ppa = b.login_name
            WHERE SC.id_reg = '".$id_reg."'
            AND SC.id_type = 3
            ORDER BY SC.created DESC
          ";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }

  function get_umur($id_reg)
  {
    $sql ="SELECT YEAR(curdate()) - YEAR(MP.birthdate) AS umur
          FROM trx_reg TR
          LEFT JOIN mst_pasien MP ON TR.id_pasien = MP.id_pasien
          WHERE TR.id_reg= '".$id_reg."'
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->row_array();
    return $result;
  }

  function get_creator($creator)
  {
    $sql = "SELECT	SL.*
            FROM smart_login SL
            WHERE SL.aktif = 1
            AND SL.creator = '".$creator."'
          ";
    $query  = $this->dbsupp->query($sql);
    $rs     = $query->result();
    return $rs;
  }

  function get_data_cppt($id_reg)
  {
    $sql = "SELECT  a.*, b.name AS ppa
            FROM    soap_asm_ri a
            LEFT JOIN smart_login b ON a.creator = b.login_name
            WHERE   a.id_reg = '".$id_reg."'
            ORDER BY a.asmri_date DESC
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }

  function get_data_cppt_byid($id_asmri)
  {
    $sql = "SELECT  a.*
            FROM    soap_asm_ri a
            WHERE   a.id_asmri = '".$id_asmri."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbsupp->query($sql);
    $result = $query->result_array();
    return $result;
  }

  function cek_data_asm($id_reg, $jenis_asm)
  {
    $sql = "SELECT  a.id_asmri
            FROM    soap_asm_ri a
            WHERE   a.id_reg = '".$id_reg."'
            AND a.jenis_asm = '".$jenis_asm."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbsupp->query($sql);
    $result = $query->row();
    return $result;
  }



  public function add_data_asm_ranap_obstetri($data)
  {
    $this->dbsupp->insert('soap_asm_ri_obstetri_rkpn', $data);
  }



  public function delete_asm_ranap_byid($id_asmri)
  {
    $this->dbsupp->where('id_asmri', $id_asmri);
    $this->dbsupp->delete('soap_asm_ri');
  }

  public function get_asm_ranap_byid($id_asmri)
  {
    $query=$this->dbsupp->query("SELECT * FROM soap_asm_ri a LEFT JOIN frm_asm_geriatri b ON a.id_asmri=b.id_asmri_from WHERE a.id_asmri='$id_asmri'");
    return $query->row();
    //$this->dbsupp->from('soap_asm_ri');
    //$this->dbsupp->where('id_asmri', $id_asmri);
    //$this->dbsupp->order_by('created', 'desc');
    //$this->dbsupp->limit(1);
    //$query  = $this->dbsupp->get();
    //$rs = $query->row_array();
    //return $rs;
  }

  function get_asm_ranap_obstetri_rkpn_byid($id_pasien){
    $query=$this->dbsupp->query("SELECT * FROM soap_asm_ri_obstetri_rkpn WHERE id_pasien='$id_pasien' AND status='0'");
    return $query->result();
  }

  function update_review($id_asmri, $data)
  {
    $this->db->where('id_asmri', $id_asmri);
    $this->db->update('soap_asm_ri', $data);
  }

  function update_data($where,$data,$table){
    $this->db->where($where);
    $this->db->update($table,$data);
  }

}
