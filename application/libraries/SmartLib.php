<?php
defined('BASEPATH') or exit('No direct script access allowed');
/* Author : Sarkodan 2018-12-10 */
class SmartLib {
	var $dbhis;
	//var $dbhis;

	var $db;
	var $db2;
	var $CI;
	public function __construct()
	{
		$CI =& get_instance();
		$this->CI = $CI;

		$this->db = $CI->db;
		$this->dbhis = $CI->db;
	}
	
	function get_data_pasien_by_id_pasien($id_pasien)
	{
		$sql = "SELECT * FROM mst_pasien a WHERE a.id_pasien=".$id_pasien."";
		$query = $this->dbhis->query($sql);
		$rs = $query->row_array();
		return $rs;
	}

	### NEW by sarkodan
	function get_data_pasien_by_id_reg($id_reg)
	{
		$sql = "SELECT 	a.*,b.*
						FROM 		mst_pasien a, trx_reg b
						WHERE 	a.id_pasien=b.id_pasien
										AND b.id_reg='".$id_reg."'
										";
		$query = $this->dbhis->query($sql);
		$rs = $query->row_array();
		return $rs;
	}

	### NEW by sarkodan
	function get_id_pasien_by_id_reg($id_reg)
	{
		$sql = "SELECT 	b.id_pasien
						FROM 		trx_reg b
						WHERE 	b.id_reg='".$id_reg."'
										";
		$query = $this->dbhis->query($sql);
		$row = $query->row_array();
		return $row['id_pasien'];
	}

	function get_data_registrasi_by_id_reg($id_reg)
	{
		$sql = "SELECT 	TR.`id_reg`, TR.`regdate`,
										MP.`id_pasien`, CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS nama_pasien,
										MP.`birthplace`, DATE_FORMAT(MP.`birthdate`, '%d-%m-%Y') AS tgl_lahir,
										YEAR(curdate()) - YEAR(MP.birthdate) AS umur1,
										CONCAT(TIMESTAMPDIFF( YEAR, MP.birthdate, now() ),' thn ',
										TIMESTAMPDIFF( MONTH, MP.birthdate, now() ) % 12 ,' bln ',
										FLOOR( TIMESTAMPDIFF( DAY, MP.birthdate, now() ) % 30.4375 ),' hr ') AS umur2,
										CASE WHEN MP.`gender` = 0 THEN 'Laki-Laki' ELSE 'Perempuan' END AS gender1,
										CASE WHEN MP.`gender` = 0 THEN 'L' ELSE 'P' END AS gender2,
										MP.`address` AS alamat, MKEL.name AS kelurahan, MP.pid_num , MKEC.name AS kecamatan, MKTA.name AS kota, MPROP.name AS propinsi,
										MU.`name` AS poli_ruangan,
										(CASE WHEN TR.rwip THEN MDR.name WHEN TR.rwip=0 AND TR.ugd=1 THEN MDJ.name ELSE MD.name END) AS dokter,
										MC.`name` AS asuransi,
										TRU.id_unit, TR.`id_asuransi`,
										(CASE WHEN TR.rwip THEN MDR.id_dokter WHEN TR.rwip=0 AND TR.ugd=1 THEN MDJ.id_dokter ELSE MD.id_dokter END) AS id_dokter,
										MPJ.name AS job, MD.acc_branch

						FROM 		trx_reg TR
										LEFT JOIN `mst_pasien` MP ON TR.`id_pasien` = MP.`id_pasien`
										LEFT JOIN `mst_company` MC ON TR.`id_asuransi` = MC.`id_company`
										LEFT JOIN `trx_reg_unit` TRU ON TR.`id_reg` = TRU.`id_reg`
										LEFT JOIN `mst_unit` MU ON TRU.`id_unit` = MU.`id_unit`
										LEFT JOIN `mst_dokter` MD ON TRU.`id_dokter` = MD.`id_dokter`
										LEFT JOIN  mst_dokter MDR ON TR.id_dokter_prt1 = MDR.id_dokter
          					LEFT JOIN  mst_dokter MDJ ON TR.id_dokter_jaga = MDJ.id_dokter
										LEFT JOIN `mst_pasien_title` MPT ON MP.`id_social` = MPT.`id_social`
										LEFT JOIN `mst_kelurahan` MKEL ON MP.id_kelurahan = MKEL.id_kelurahan
										LEFT JOIN `mst_kecamatan` MKEC ON MP.id_kecamatan =  MKEC.id_kecamatan
										LEFT JOIN `mst_kota` MKTA ON MP.id_kota = MKTA.id_kota
										LEFT JOIN `mst_propinsi` MPROP ON MP.id_propinsi = MPROP.id_propinsi
										LEFT JOIN `mst_pasien_job` MPJ ON MP.id_job = MPJ.id_job

						WHERE 	TR.id_reg = '".$id_reg."'

										UNION ALL

						SELECT 	TRA.`id_reg`, TRA.`regdate`,
										TRA.`id_pasien`, CONCAT(TRA.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS nama_pasien,
										TRA.`birthplace`, DATE_FORMAT(TRA.`birthdate`, '%d-%m-%Y') AS tgl_lahir,
										YEAR(curdate()) - YEAR(TRA.birthdate) AS umur1,
										CONCAT(TIMESTAMPDIFF( YEAR, TRA.birthdate, now() ),' thn ',
										TIMESTAMPDIFF( MONTH, TRA.birthdate, now() ),' bln ',
										FLOOR( TIMESTAMPDIFF( DAY, TRA.birthdate, now() ) % 30.4375 ),' hr ') AS umur2,
										CASE WHEN TRA.`gender` = 0 THEN 'Laki-Laki' ELSE 'Perempuan' END AS gender1,
										CASE WHEN TRA.`gender` = 0 THEN 'L' ELSE 'P' END AS gender2,
										TRA.`address` AS alamat, MKEL.name AS kelurahan, MKEC.name AS kecamatan, MKTA.name AS kota, MPROP.name AS propinsi,MP.pid_num ,
										MU.`name` AS poli, MD.`name` AS dokter,
										CASE WHEN MC.`id_company` IS NOT NULL THEN MC.`name` ELSE 'UMUM' END AS asuransi,
										TRU.id_unit, TRA.`id_asuransi`, TRU.`id_dokter`, MPJ.name AS job, MD.acc_branch

						FROM 		trx_reg_aps TRA
										LEFT JOIN `mst_pasien` MP ON TRA.`id_pasien` = MP.`id_pasien`
										LEFT JOIN `mst_company` MC ON TRA.`id_asuransi` = MC.`id_company`
										LEFT JOIN `trx_reg_unit` TRU ON TRA.`id_reg` = TRU.`id_reg`
										LEFT JOIN `mst_unit` MU ON TRU.`id_unit` = MU.`id_unit`
										LEFT JOIN `mst_dokter` MD ON TRU.`id_dokter` = MD.`id_dokter`
										LEFT JOIN `mst_pasien_title` MPT ON TRA.`id_social` = MPT.`id_social`
										LEFT JOIN `mst_kelurahan` MKEL ON TRA.id_kelurahan = MKEL.id_kelurahan
										LEFT JOIN `mst_kecamatan` MKEC ON TRA.id_kecamatan =  MKEC.id_kecamatan
										LEFT JOIN `mst_kota` MKTA ON TRA.id_kota = MKTA.id_kota
										LEFT JOIN `mst_propinsi` MPROP ON TRA.id_propinsi = MPROP.id_propinsi
										LEFT JOIN `mst_pasien_job` MPJ ON TRA.id_job = MPJ.id_job

						WHERE 	TRA.id_reg = '".$id_reg."'";

		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->row_array();
		return $rs;
	}

	function get_view_header_by_id_reg($id_reg)
	{
		$rs = $this->get_data_registrasi_by_id_reg($id_reg);
		$data = array(
			'rs'	=> $rs
		);
		return $this->CI->load->view('SmartLib/header',$data,true);
	}

	function get_data_pasien_poli_by_id_dokter($id_dokter, $regdate)
	{
		$sql = "SELECT 	TRU.id_reg, TRU.trxdate, MP.id_pasien,
										CONCAT(MP.name,IFNULL(CONCAT(', ',MPT.abbr),'')) AS name,
										(CASE MP.gender WHEN 0 THEN 'L' WHEN 1 THEN 'P' END) AS gender,
										MP.birthdate, MU.name AS unit, MD.name AS dokter,
										IF(TR.mrstat=1, 0, 1) AS mrstat, TRU.ctr_num,
										CASE WHEN MC.`id_company` IS NOT NULL THEN MC.`name` ELSE 'UMUM' END AS asuransi
										(CASE TR.status WHEN 0 THEN 'OPEN' WHEN 1 THEN 'CLOSED' END) AS stat, TR.status

						FROM 		trx_reg_unit TRU
										LEFT JOIN trx_reg TR ON TR.id_reg=TRU.id_reg
										LEFT JOIN mst_pasien MP ON TR.id_pasien=MP.id_pasien
										LEFT JOIN mst_pasien_title MPT ON MPT.id_social=MP.id_social
										LEFT JOIN mst_unit MU ON TRU.id_unit=MU.id_unit
										LEFT JOIN mst_dokter MD ON TRU.id_dokter=MD.id_dokter
										LEFT JOIN mst_company MC ON TR.id_asuransi=MC.id_company

						WHERE 	TR.status<2
										AND TRU.cancel=0
										AND DATE(TR.`regdate`) = '".$regdate."'
										AND TRU.`id_dokter` = '".$id_dokter."'

						ORDER BY TRU.trxdate DESC
						";

		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->row_array();
		return $rs;
	}

	function get_data_dokter_all()
	{
		$sql = "SELECT MD.`id_dokter`, MD.`name`
						FROM mst_dokter MD
						WHERE MD.`aktif` = 1
						ORDER BY MD.`name`
						";
		$query = $this->dbhis->query($sql);
		$rs = $query->result();
		return $rs;
	}

	function get_data_poli_all()
	{
		$sql 		= " SELECT MU.`id_unit`, MU.`name` FROM `mst_unit` MU WHERE MU.`aktif` = 1 ORDER BY MU.`name` ";
		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->result();
		return $rs;
	}

	public function rs_info()
	{
		$sql_main = "SELECT * FROM mst_main WHERE id=1";
		$result 	= $this->dbhis->query($sql_main);

		if($result->num_rows() > 0)
		{
			$rs 			= $result->result_array();
			$nama_rs 	= $rs[0]['name'];
			$alamat_rs= $rs[0]['address'];
			$telp_rs 	= $rs[0]['telp'];
			$fax_rs 	= $rs[0]['fax'];
		}
		else
		{
			$nama_rs	='null';
			$alamat_rs='null';
			$telp_rs	='null';
			$fax_rs 	='null';
		}

		return array(
			'nama_rs' 	=> $nama_rs,
			'alamat_rs' => $alamat_rs,
			'telp_rs' 	=> $telp_rs,
			'fax_rs' 		=> $fax_rs
		);
	}

	function get_alergi_pasien_rj_igd($id_reg)
	{
		$sql="SELECT ax.alergi
					FROM
					(
						SELECT a.obj_alergi AS alergi
						FROM soap_cppt_trans a
						WHERE a.id_reg = '".$id_reg."'

						UNION ALL

						SELECT a.alergi_note AS alergi
						FROM soap_gadar a
						WHERE a.id_reg = '".$id_reg."'
					)ax
		";

		$query = $this->dbhis->query($sql);
		$rs = $query->row_array();
		return $rs['alergi'];
	}

	function get_alergi_pasien_ri($id_reg)
	{
		$sql="SELECT 	a.riwayat_alergi
					FROM 		soap_asm_ri a
					WHERE 	a.`id_reg`='".$id_reg."' AND kategori='ASM' AND a.jenis_asm='NURSE';
					";

		$query = $this->dbhis->query($sql);
		$row = $query->row_array();
		return $row['riwayat_alergi'];
	}

	function get_ruangan_pasien($id_reg)
	{
		$sql="SELECT 	CONCAT(b.`id_kamar`,' Bed ', b.id_bed,' ', c.`name` ) AS ruangan
					FROM 		`trx_reg` a, `mst_kamar_bed` b, `mst_kelas` c
					WHERE 	a.`id_bed`=b.`id_bed` AND a.`id_kelas`=c.`id_kelas` AND a.`id_kamar`=b.`id_kamar`
									AND a.`id_reg`='".$id_reg."'
					";
		#echo "<pre>".$sql."</pre>";
		$query = $this->dbhis->query($sql);
		$row = $query->row_array();
		#echo 'test : '.$row['ruangan'];
		return $row['ruangan'];
	}

	function store_riwayat_pasien($id_pasien, $data)
	{
		$sql="SELECT 	a.*
					FROM	soap_riwayat_pasien a
					WHERE	a.`id_pasien`='".$id_pasien."'
					";
		$result = $this->dbhis->query($sql);

		if ($result->num_rows() > 0)
		{
			$this->dbhis->where('id_pasien', $id_pasien);
			$this->dbhis->update('soap_riwayat_pasien',$data);
		}
		else
		{
			$this->dbhis->insert('soap_riwayat_pasien',$data);
		}

	}

	public function riwayat_pasien($id_pasien)
	{
		$sql="SELECT 	a.*
					FROM	soap_riwayat_pasien a
					WHERE	a.`id_pasien`='".$id_pasien."'
					";

		$result = $this->dbhis->query($sql);

		if($result->num_rows() > 0)
		{
			$rs	= $result->result_array();
			$penyakit_sekarang	= $rs[0]['penyakit_sekarang'];
			$penyakit_dahulu		= $rs[0]['penyakit_dahulu'];
			$penyakit_keluarga 	= $rs[0]['penyakit_keluarga'];
			$pengobatan 				= $rs[0]['pengobatan'];
			$alergi 						= $rs[0]['alergi'];
		}
		else
		{
			$penyakit_sekarang	='';
			$penyakit_dahulu		='';
			$penyakit_keluarga	='';
			$pengobatan 				='';
			$alergi 						='';
		}

		return array(
			'penyakit_sekarang' => $penyakit_sekarang,
			'penyakit_dahulu'	 	=> $penyakit_dahulu,
			'penyakit_keluarga'	=> $penyakit_keluarga,
			'pengobatan' 				=> $pengobatan,
			'alergi' 						=> $alergi,
		);
	}

	function get_data_regpasien_by_id_reg($id_reg)
	{
		$sql = "SELECT TR.id_reg, DATE_FORMAT(TR.regdate, '%d-%m-%Y') AS regdate, TR.id_pasien,
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
          AND TR.id_reg = '".$id_reg."'
		";

		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->row_array();
		return $rs;
	}

	function get_umur($id_pasien)
	{
		$sql = "SELECT MP.* FROM mst_pasien MP WHERE MP.id_pasien = '".$id_pasien."' ";

		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->row_array();

		$tgl_lahir = $rs['birthdate'];

		// tanggal lahir
		$tanggal = new DateTime($tgl_lahir);
		// tanggal hari ini
		$today = new DateTime('today');
		// tahun
		$y = $today->diff($tanggal)->y;
		// bulan
		$m = $today->diff($tanggal)->m;
		// hari
		$d = $today->diff($tanggal)->d;
		$umur =  $y . " thn " . $m . " bln " . $d . " hr";
		return $umur;
	}
	
	function get_data_opening_kasir()
	{
		$username = $this->CI->session->userdata['sp']->username;
		$sql = "SELECT a.* FROM trx_opening_kasir a WHERE a.username='".$username."' AND a.closing_time IS NULL LIMIT 1";
		$query = $this->db->query($sql);
		$jumdata = $query->num_rows();
		if($jumdata>=1)
			$row = $query->row_array();
		else
			$row = array();
		
		return $row;
	}
	
	function cek_opening_kasir()
	{
		$row = $this->get_data_opening_kasir();
		if(empty($row))
			redirect('pembayaran/opening_kasir');
		else
			return $row;
	}
	
	function get_id_opening_kasir()
	{
		$row = $this->cek_opening_kasir();
		return $row['id_opening'];
	}
	
}
?>
