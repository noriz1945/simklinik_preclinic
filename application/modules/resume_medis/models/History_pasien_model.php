<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class History_pasien_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

	public function get_data_resume_medis_by_id_reg($id_reg)
  {
    $sql ="SELECT 	c.*,a.*,b.*,d.sip_str,d.name AS dokter_login,e.riwayat_sakit,c.updated AS tgl_cetak
						FROM 		trx_reg a
										LEFT JOIN soap_resume_medis c ON (c.`id_reg`=a.id_reg)
										LEFT JOIN smart_login d ON (d.`login_name`=c.updator)
                    LEFT JOIN soap_asm_ri e ON (c.`id_reg`=e.id_reg)
										,mst_pasien b
						WHERE 	a.id_pasien=b.`id_pasien`
										AND a.`id_reg`='".$id_reg."'
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->row_array();
    return $result;
  }

  public function get_history_pasien($id_pasien)
  {
    $sql ="SELECT TR.id_reg, DATE_FORMAT(TR.regdate, '%d-%m-%Y') AS regdate,
          (CASE WHEN TR.rwip THEN 'RAWAT INAP'
          	WHEN TR.rwjn THEN 'RAWAT JALAN'
          	WHEN TR.ugd THEN 'UGD'
          END) AS tipe,
          MU.name AS unit,
          (CASE WHEN TR.rwip THEN MDR.name WHEN TR.rwip=0 AND TR.ugd=1 THEN MDJ.name ELSE MD.name END) AS dokter,
          (CASE WHEN TR.rwip THEN MDR.id_dokter WHEN TR.rwip=0 AND TR.ugd=1 THEN MDJ.id_dokter ELSE MD.id_dokter END) AS id_dokter,
          TRK.id_reg_kmr, MK.name AS kelas, TRK.duration, TRK.indate, TRK.outdate,
          (SELECT invdate FROM trx_reg_inv TRI WHERE id_reg=TR.id_reg AND cancel=0 ORDER BY invdate DESC LIMIT 1) AS invdate,
          MC.name AS asuransi

          FROM trx_reg TR
          LEFT JOIN trx_reg_unit TRU ON TR.id_reg = TRU.id_reg
          LEFT JOIN trx_reg_kmr TRK ON TR.id_reg = TRK.id_reg AND TR.rwip=1
          LEFT JOIN  mst_unit MU ON TRU.id_unit = MU.id_unit
          LEFT JOIN  mst_kelas MK ON TRK.id_kelas = MK.id_kelas
          LEFT JOIN  mst_dokter MD ON TRU.id_dokter = MD.id_dokter
          LEFT JOIN  mst_dokter MDR ON TR.id_dokter_prt1 = MDR.id_dokter
          LEFT JOIN  mst_dokter MDJ ON TR.id_dokter_jaga = MDJ.id_dokter
          LEFT JOIN  mst_company MC ON MC.id_company = TR.id_asuransi

          WHERE TR.status<2
          AND (TRU.id_reg IS NULL OR TRU.cancel = 0)
          AND (TRK.id_reg IS NULL OR TRK.cancel = 0)
          AND TR.id_pasien = '".$id_pasien."'
          ORDER BY TR.regdate DESC
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result_array();
    return $result;

  }

  public function get_data_pasien_byred($id_reg)
  {
    $sql = "SELECT TR.id_reg
						-- , DATE_FORMAT(TR.regdate, '%d-%m-%Y') AS regdate
						,TR.regdate,
            (CASE WHEN TR.rwip THEN 'RAWAT INAP'
            	WHEN TR.rwjn THEN 'RAWAT JALAN'
            	WHEN TR.ugd THEN 'UGD'
            END) AS tipe,
            MU.name AS unit,
            (CASE WHEN TR.rwip THEN MDR.name WHEN TR.rwip=0 AND TR.ugd=1 THEN MDJ.name ELSE MD.name END) AS dokter,
            (CASE WHEN TR.rwip THEN MDR.id_dokter WHEN TR.rwip=0 AND TR.ugd=1 THEN MDJ.id_dokter ELSE MD.id_dokter END) AS id_dokter,
            TRK.id_reg_kmr, MK.name AS kelas, TRK.duration, TRK.indate, TRK.outdate,
            (SELECT invdate FROM trx_reg_inv TRI WHERE id_reg=TR.id_reg AND cancel=0 ORDER BY invdate DESC LIMIT 1) AS invdate,
            MC.name AS asuransi,
            MP.`id_pasien`, CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS nama_pasien,
            MP.`birthplace`, DATE_FORMAT(MP.`birthdate`, '%d-%m-%Y') AS tgl_lahir,
            YEAR(curdate()) - YEAR(MP.birthdate) AS umur1,
            CONCAT(TIMESTAMPDIFF( YEAR, MP.birthdate, now() ),' thn ',
            TIMESTAMPDIFF( MONTH, MP.birthdate, now() ) % 12 ,' bln ',
            FLOOR( TIMESTAMPDIFF( DAY, MP.birthdate, now() ) % 30.4375 ),' hr ') AS umur2,
            CASE WHEN MP.`gender` = 0 THEN 'Laki-Laki' ELSE 'Perempuan' END AS gender1,
            CASE WHEN MP.`gender` = 0 THEN 'L' ELSE 'P' END AS gender2,
            MP.`address` AS alamat, MPJ.`name` AS job, MPM.`name` AS status, MPD.`name` AS pendidikan,
            MA.`name` AS agama, MP.`id_nation`, MN.`name` AS kebangsaan

            FROM trx_reg TR
            LEFT JOIN trx_reg_unit TRU ON TR.id_reg = TRU.id_reg
            LEFT JOIN trx_reg_kmr TRK ON TR.id_reg = TRK.id_reg AND TR.rwip=1
            LEFT JOIN mst_unit MU ON TRU.id_unit = MU.id_unit
            LEFT JOIN mst_kelas MK ON TRK.id_kelas = MK.id_kelas
            LEFT JOIN mst_dokter MD ON TRU.id_dokter = MD.id_dokter
            LEFT JOIN mst_dokter MDR ON TR.id_dokter_prt1 = MDR.id_dokter
            LEFT JOIN mst_dokter MDJ ON TR.id_dokter_jaga = MDJ.id_dokter
            LEFT JOIN mst_company MC ON MC.id_company = TR.id_asuransi
            LEFT JOIN mst_pasien MP ON TR.id_pasien = MP.id_pasien
            LEFT JOIN mst_pasien_title MPT ON MP.id_social = MPT.id_social
            LEFT JOIN mst_pasien_job MPJ ON MP.`id_job` = MPJ.`id_job`
            LEFT JOIN mst_pasien_mar MPM ON MP.`id_mar` = MPM.`id_mar`
            LEFT JOIN mst_pendidikan MPD ON MP.`id_pend` = MPD.`id_pend`
            LEFT JOIN mst_agama MA ON MP.`id_agama` = MA.`id_agama`
            LEFT JOIN mst_nation MN ON MP.`id_nation` = MN.`id_nation`

            WHERE TR.status<2
            AND (TRU.id_reg IS NULL OR TRU.cancel = 0)
            AND (TRK.id_reg IS NULL OR TRK.cancel = 0)
            AND TR.id_reg = '".$id_reg."'
            ORDER BY TR.regdate DESC
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->row_array();
    return $result;
  }

  function jml_asm_rajal($id_reg,$id_dokter)
  {
    $sql = "SELECT  *
            FROM    soap_awal
            WHERE   id_reg = '".$id_reg."'
            AND id_dokter = '".$id_dokter."'
            ";
    // echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function jml_soap_rajal($id_reg,$id_dokter)
  {
    $sql = "SELECT  *
            FROM    soap_cppt_trans
            WHERE   id_reg = '".$id_reg."'
            AND id_dokter = '".$id_dokter."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function jml_asm_gadar($id_reg)
  {
    $sql = "SELECT  *
            FROM    soap_gadar
            WHERE   id_reg = '".$id_reg."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function jml_cppt_gadar($id_reg)
  {
    $sql = "SELECT  *
            FROM    soap_cppt
            WHERE   id_reg = '".$id_reg."'
            AND id_type = 3
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function jml_asm_ranap($id_reg)
  {
    $sql = "SELECT  *
            FROM    soap_asm_ri
            WHERE   id_reg = '".$id_reg."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function jml_lab($id_reg)
  {
    $sql = "SELECT  *
            FROM    soap_trx_lab_order_digital_request
            WHERE   registrasi = '".$id_reg."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function jml_rad($id_reg)
  {
    $sql = "SELECT  *
            FROM    soap_trx_rad_order_digital_request
            WHERE   registrasi = '".$id_reg."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function jml_penunjang($id_reg)
  {
    $sql = "SELECT  *
            FROM    soap_upload_file
            WHERE   id_reg = '".$id_reg."'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->num_rows();
    return $result;
  }

  function get_soap_byreg($id_reg,$id_dokter)
  {
      $sql = "SELECT  *
              FROM    soap_cppt_trans
              WHERE   id_reg = '".$id_reg."'
              AND id_dokter =  '".$id_dokter."'
              ";
      $query  = $this->dbhis->query($sql);
      $result = $query->result();
      $result = $result[0];
      return $result;
  }

  function get_soap_rev_byid($id_cppt)
  {
    $sql = "SELECT  a.*
            FROM    soap_cppt_trans_rev a
            WHERE   id_cppt = '".$id_cppt."'
          ";

    $query 	= $this->dbhis->query($sql);
    $rs 		= $query->result_array();
    return $rs;
  }

  function get_subjective_rev_byid($id_cppt)
  {
    $sql = "SELECT  a.subjective, b.*, c.name AS dokter, c.acc_branch, a.created AS tgl_ubah
            FROM    soap_cppt_trans_rev a
            LEFT JOIN smart_login b ON a.creator = b.login_name
            LEFT JOIN mst_dokter c ON b.id_dokter = c.id_dokter
            WHERE   id_cppt = '".$id_cppt."'
          ";

    $query 	= $this->dbhis->query($sql);
    $rs 		= $query->result_array();
    return $rs;
  }

  function get_objective_rev_byid($id_cppt)
  {
    $sql = "SELECT  IFNULL(a.obj_keadaan, a.objective) AS objective, b.*,
            c.name AS dokter, c.acc_branch, a.created AS tgl_ubah

            FROM    soap_cppt_trans_rev a
            LEFT JOIN smart_login b ON a.creator = b.login_name
            LEFT JOIN mst_dokter c ON b.id_dokter = c.id_dokter
            WHERE   id_cppt = '".$id_cppt."'
          ";

    $query 	= $this->dbhis->query($sql);
    $rs 		= $query->result_array();
    return $rs;
  }

  function get_assesment_rev_byid($id_cppt)
  {
    $sql = "SELECT  a.assesment, b.*, c.name AS dokter, c.acc_branch, a.created AS tgl_ubah
            FROM    soap_cppt_trans_rev a
            LEFT JOIN smart_login b ON a.creator = b.login_name
            LEFT JOIN mst_dokter c ON b.id_dokter = c.id_dokter
            WHERE   id_cppt = '".$id_cppt."'
          ";

    $query 	= $this->dbhis->query($sql);
    $rs 		= $query->result_array();
    return $rs;
  }

  function get_planning_rev_byid($id_cppt)
  {
    $sql = "SELECT  a.planning, b.*, c.name AS dokter, c.acc_branch, a.created AS tgl_ubah
            FROM    soap_cppt_trans_rev a
            LEFT JOIN smart_login b ON a.creator = b.login_name
            LEFT JOIN mst_dokter c ON b.id_dokter = c.id_dokter
            WHERE   id_cppt = '".$id_cppt."'
          ";

    $query 	= $this->dbhis->query($sql);
    $rs 		= $query->result_array();
    return $rs;
  }

  function get_dokter($id_dokter)
  {
    $sql = "SELECT  a.*, b.id_unit, b.name AS poli
            FROM    mst_dokter a
            LEFT JOIN mst_unit b ON a.id_unit = b.id_unit
            WHERE a.aktif = 1
            AND a.id_dokter = '".$id_dokter."'
            ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result();
    $result = $result[0];
    return $result;
  }

  function get_data_cppt($id_reg)
  {
    $sql = "SELECT  a.*, b.name AS ppa
            FROM    soap_asm_ri a
            LEFT JOIN smart_login b ON a.creator = b.login_name
            WHERE   a.id_reg = '".$id_reg."'
            ORDER BY a.tgl_pengkajian DESC
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $result = $query->result_array();
    return $result;
  }

  function get_cppt_igd($id_reg)
  {
    $sql =" SELECT SC.*
            FROM soap_cppt SC
            WHERE SC.id_reg = '".$id_reg."'
            AND SC.id_type = 3
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result_array();
    return $result;
  }

	public function add_data_resmed($data)
  {
    $this->dbhis->insert('soap_resume_medis',$data);
  }

  function update_resmed($id_resmed, $data)
  {
    $this->db->where('id_resmed', $id_resmed);
    $this->db->update('soap_resume_medis', $data);
  }

  public function delete_resmed($id_resmed)
  {
    $this->dbhis->where('id_resmed', $id_resmed);
    $this->dbhis->delete('soap_resume_medis');
  }

	function get_data_asm_ri_dokter($id_reg)
  {
    $sql = "SELECT  a.*
            FROM    soap_asm_ri a
            WHERE   a.id_reg = '".$id_reg."'
										AND a.kategori='ASM' AND jenis_asm='DOKTER'
            ";
    //echo "<pre>".$sql."</pre>";
    $query  = $this->dbhis->query($sql);
    $row = $query->row_array();
    return $row;
  }

  function list_monitoring_resmed()
  {
    $sql ="SELECT TRK.id_reg, TR.id_pasien,
            CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS name,
            (CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
            MIN(DATE(TRK.`indate`)) AS tgl_masuk, MAX(DATE(TRK.`outdate`)) AS tgl_keluar,
            TRK.id_reg_kmr, TRK.id_bed, MD.name AS dokter, MC. name AS asuransi, 
            MAX(MK.`description`) AS kamar, MAX(ML.name) AS kelas, SRM.resmed_date

            FROM trx_reg_kmr AS TRK
            LEFT JOIN trx_reg AS TR ON TRK.id_reg = TR.id_reg
            LEFT JOIN mst_pasien MP ON TR.id_pasien  = MP.id_pasien
            LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
            LEFT JOIN mst_kelas AS ML ON TRK.id_kelas = ML.id_kelas
            LEFT JOIN mst_kamar AS MK ON TRK.id_reg_kmr = MK.id_kamar
            LEFT JOIN mst_kamar_grup MKG ON MK.id_group  = MKG.id_group
            LEFT JOIN mst_dokter MD ON TR.id_dokter_prt1=MD.id_dokter
            LEFT JOIN mst_company MC ON TR.id_asuransi = MC.id_company
            LEFT JOIN soap_resume_medis SRM ON TR.id_reg = SRM.id_reg

            WHERE TRK.cancel =  0
            AND TRK.indate >= '2019-11-28'
            AND SRM.id_resmed IS NULL
            GROUP BY TR.id_reg
            ORDER BY TRK.indate
          ";
    $query  = $this->dbhis->query($sql);
    $result = $query->result_array();
    return $result;

  }

}
