<?php
defined('BASEPATH') or exit('No direct script access allowed');
class prosesor {

	var $db;
	var $dbsupp;
	var $db2;
	var $dbhis;
	var $wsv;
	var $today;
	var $today_timestamp;
	var $config;
	var $id_ppk;
	var $bill_generator;
	
	public function __construct()
	{
		$CI =& get_instance();
		$CI->load->library('lib_sep/WsVclaim');
		$CI->load->library('lib_sep/Bill_generator');
		
		$this->config = $CI->config;
		
		$this->db = $CI->dbsupp;
		$this->dbsupp = $CI->dbsupp;
		
		$this->db2 = $CI->dbhis;
		$this->dbhis = $CI->dbhis;
	
		$this->wsv = $CI->wsv;
		$this->bill_generator = $CI->bill_generator;
		
		date_default_timezone_set('Asia/Jakarta'); 
		$this->today = date("Y-m-d");
		$this->today_timestamp = date("Y-m-d H:i:s"); 
		$this->id_ppk = $this->config->item('apem_id_ppk');
		
		if($this->config->item('apem_debug'))
		{
			$this->db->db_verbose = true;
			$this->db2->db_verbose = true;
			$this->dbsupp->db_verbose = true;
			$this->dbhis->db_verbose = true;
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		}
	}

	public function xxxxxxxxxx()
	{
		
	}
	
	public function get_mst_pasien_by_id_pasien($id_pasien)
	{
		$sql = "SELECT * FROM mst_pasien a WHERE a.id_pasien=".$id_pasien."";
		
		$query = $this->dbhis->query($sql);
		$jum_data = $query->num_rows();
		$rs = $query->row_array();
		if($jum_data==0)
			$rs = array();
			
		return $rs;
	}
	
	public function get_mst_pasien_by_noka($noka)
	{
		$sql = "SELECT * FROM mst_pasien a WHERE a.asm_id=".$noka."";
		
		$query = $this->dbhis->query($sql);
		$jum_data = $query->num_rows();
		
		if($jum_data==0)
		{
			$rs = array();
		}
		else
		{
			$rs = $query->row_array();
		}
			
		return $rs;
	}
	
	function get_id_comp_bpjs()
	{
		$sql= " SELECT MMS.id_comp_bpjs FROM mst_main_setting MMS";
		$query = $this->db2->query($sql);
		$result = $query->result_array();
		if($query->num_rows() > 0)
		{
			$rs = $result[0];
			return $rs['id_comp_bpjs'];
		}
		else
		{
			return "";
		}
	} 
	
	function get_cabang_profile()
	{
		$sql= " SELECT a.* FROM mst_main a";
		$query = $this->db2->query($sql);
		$result = $query->result_array();
		if($query->num_rows() > 0)
		{
			$rs = $result[0];
			return $rs;
		}
		else
		{
			return array();
		}
	} 
	
	public function get_jumlah_perjanjian($id_pasien)
	{
		$sql = "SELECT * FROM trx_reg_book a WHERE a.id_pasien=".$id_pasien." AND a.bookdate='".$this->today."' AND a.id_reg IS NULL";
		$query = $this->dbhis->query($sql);
		$jum_data = $query->num_rows();
		return $jum_data;
	}
	
	public function get_perjanjian($id_pasien,$dr_alt='')
	{
		
		$sql = "SELECT * FROM trx_reg_book a WHERE a.id_pasien=".$id_pasien." AND a.bookdate='".$this->today."' AND a.id_reg IS NULL ";
		$sql .= ($dr_alt!='') ? " AND a.id_dokter=".$dr_alt."" : "";
		$sql .= " ORDER BY a.hr_start";
		#echo "<pre>".$sql."</pre>";
		$query = $this->dbhis->query($sql);
		$jum_data = $query->num_rows();
		$rs = $query->result_array();
		if($jum_data==0)
			$rs = array();
			
		return $rs;
	}
	
	function get_nosep_by_id_reg($id_reg)
	{
		$sql = "SELECT no_sep FROM kiosk_apm_log a WHERE a.id_reg='".$id_reg."'";
		$query = $this->dbsupp->query($sql);
		$row = $query->row_array();
		$nosep = $row['no_sep'];
		return $nosep;
	}
	
	function get_id_reg_by_nosep($nosep)
	{
		$sql = "SELECT id_reg FROM kiosk_apm_log a WHERE a.no_sep='".$nosep."'";
		$query = $this->dbsupp->query($sql);
		$row = $query->row_array();
		$id_reg = $row['id_reg'];
		return $id_reg;
	}
	
	function get_nosep_terbit_hari_ini($noka)
	{
		$nosep_today = ''; ## >> init
		$today = $this->today;
		$data = $this->wsv->monitoring_data_histori_pelayanan_peserta($noka,$today,$today);
		if(isset($data->response->histori[0]->noSep))
		{
			$nosep_today = $data->response->histori[0]->noSep;
		}
		return $nosep_today;
	}
	
	function get_nosep_terbit_hari_ini_OLD($noka)
	{
		$nosep_today = ''; ### >> INIT VALUE
		$tgl_1 		= $this->today;
		$tgl_2 		= $this->today;
		$apem_id_ppk_nama = $this->config->item('apem_id_ppk_nama');
		$data = $this->wsv->monitoring_data_histori_pelayanan_peserta($noka,$tgl_1,$tgl_2);
		if(isset($data->response->histori[0]))
		{
			foreach($data->response->histori as $k => $v)
			{
				if($v->ppkPelayanan != $apem_id_ppk_nama) continue;
				
				if(isset($v->noSep))
					$nosep_today = $v->noSep;
			}
		}
		return $nosep_today;
	}
	
	function get_last_rujukan($noka)
	{
		$data = array();
		if($this->config->item('tipe_rs')=='c')
			$data = $this->wsv->rujukan_search_pcare_single_by_noka($noka);
			#$data = $this->wsv->rujukan_search_rs_single_by_noka($noka);
		
		if(!isset($data->response->rujukan->noKunjungan))
		{
			$data = $this->wsv->rujukan_search_rs_single_by_noka($noka);
			if(!isset($data->response->rujukan->noKunjungan))
				$data = array();
		}
			
		return $data;
	}
	
	function get_all_rujukan($noka)
	{
		### PHASE 1 >>> cari rujukan dari RS (dari IGD/POLI) ------------
		#if($this->config->item('tipe_rs')=='c')
			#$data = $this->wsv->rujukan_search_pcare_multi_by_noka($noka);
			$data = $this->wsv->rujukan_search_rs_multi_by_noka($noka);
			
		#$rujukan = @$data->response->rujukan;
		#if(isset($rujukan[0]->diagnosa))
		if(isset($data->response->rujukan))
			$multi_rujukan = $data;
		else
			$multi_rujukan = "";
		
		### PHASE 2 >>> cari rujukan dari RS (dari IGD/POLI) ------------
		if($multi_rujukan=="")
			$data = $this->wsv->rujukan_search_pcare_multi_by_noka($noka);
		
		if(isset($data->response->rujukan))
			$multi_rujukan = $data;
		else
			$multi_rujukan = "";
		
		return $multi_rujukan;
	}
	
	function get_all_rujukan_rs_only($noka)
	{
		$data = $this->wsv->rujukan_search_rs_multi_by_noka($noka);			
		if(isset($data->response->rujukan))
			$multi_rujukan = $data;
		else
			$multi_rujukan = "";
		
		return $multi_rujukan;
	}
	
	function get_rujukan_yg_cocok($noka,$poli)
	{
		$return = array();
		$data = $this->get_all_rujukan($noka);
		if(isset($data->response->rujukan))
		{
			foreach($data->response->rujukan as $rujukan)
			{
				#echo "<br>testcheck : ".$rujukan->noKunjungan."<br>";
				if($poli==$rujukan->poliRujukan->kode)
				{
					$is_rujukan_expired = $this->is_rujukan_expired($rujukan->tglKunjungan);
					if(!$is_rujukan_expired)
					{
						$return = $rujukan;
						break;
					}
				}
			}
		}
		else
		{
			$return = array();
		}
		return $return;
	}
	
	function get_rujukan_yg_cocok_rs_only($noka)
	{
		$return = array();
		## $data = $this->get_all_rujukan_rs_only($noka);
		$data = $this->get_all_rujukan($noka);
		if(isset($data->response->rujukan))
		{
			foreach($data->response->rujukan as $rujukan)
			{
				#echo "<br>testcheck : ".$rujukan->noKunjungan."<br>";
				$ninety_days_ago = date('Y-m-d',mktime(0,0,0,date('m'),(date('d')-90),date('Y') ));
				$jumkunj = $this->hitung_jumlah_pemakaian_rujukan_by_noka($noka,$ninety_days_ago,$this->today,$rujukan->noKunjungan);
				$is_rujukan_expired = $this->is_rujukan_expired($rujukan->tglKunjungan);
				if($this->config->item('apem_debug'))
				{
					echo "<br>ninety_days_ago : ".$ninety_days_ago;
					echo "<br>jumkunj : ".$jumkunj."<br>";
					$vdump = var_dump($is_rujukan_expired);
					echo "<br>is_rujukan_expired : ".$vdump;
					echo "<br>";
					echo "<br>".$rujukan->provPerujuk->kode ."==". $this->config->item('apem_id_ppk')."<br>";
				}
				#if($rujukan->provPerujuk->kode==$this->config->item('apem_id_ppk') && $jumkunj>0 && !$is_rujukan_expired)
				if($jumkunj>0 && !$is_rujukan_expired)
				{
					$return = $rujukan;
				}
			}
		}
		return $return;
	}
	
	function is_rujukan_expired($tgl)
	{
		$tanggal 	= $tgl;
		$tgl     	= explode ('-',$tanggal);
		$tahun 		= $tgl[0];
		$bulan 		= $tgl[1];
		$hari 		= $tgl[2];
		
		$waktu 	= '00:00:00';
		$wkt 		= explode (':',$waktu);
		$jam 		= $wkt[0];
		$menit 	= $wkt[1];
		$detik 	= $wkt[2];
	
		// tentukan waktu tujuan
		$waktu_tujuan = mktime($jam, $menit, $detik, $bulan, $hari,$tahun);
		
		// tentukan waktu saat ini
		$waktu_sekarang = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
		
		// hitung selisih kedua waktu
		//$selisih_waktu = $waktu_tujuan - $waktu_sekarang;
		$selisih_waktu = $waktu_sekarang - $waktu_tujuan;
		
		// Untuk menghitung jumlah dalam satuan hari:
		$jumlah_hari = floor($selisih_waktu/86400);
	
		if ($jumlah_hari>90) 
			$is_expired = true;
		else 
			$is_expired = false;
			
		return $is_expired;
	}
	
	function hitung_jumlah_pemakaian_rujukan_by_noka($noka,$tgl_1,$tgl_2,$no_rjk)
	{
		$result = $this->wsv->monitoring_data_histori_pelayanan_peserta($noka,$tgl_1,$tgl_2);
		$jumlah_kunjungan = 0;
		$response = $result->response->histori;
		foreach ($response as $k => $resp) 
		{
			if ($no_rjk == $resp->noRujukan)
			{
				$jumlah_kunjungan++;
			}
		}
		return $jumlah_kunjungan;
	}	
	
	function get_dokter_poli_kunjungan_pertama_rujukan_by_noka($noka,$tgl_1,$tgl_2,$no_rjk)
	{
		$result = $this->wsv->monitoring_data_histori_pelayanan_peserta($noka,$tgl_1,$tgl_2);
		$jumlah_kunjungan = 0;
		$response = $result->response->histori;
		foreach ($response as $k => $resp) 
		{
			if ($no_rjk == $resp->noRujukan)
			{
				$resp->noSep;
			}
		}
		return $id_dokter;
	}	
	
	function get_id_poly_smarthis2bpjs($variable)
	{		
		$sql   = "SELECT a.`kode_poli` FROM mapping_poli_bpjs a WHERE  a.`id_unit` ='".$variable."'";	
		$query = $this->dbsupp->query($sql);
		$result = $query->result_array();
		if($query->num_rows() > 0)
		{
			$rs = $result[0];
			return $rs['kode_poli'];
		}
		else
		{
			return "";
		}
	} 
	function get_id_doctor_smarthis2bpjs($variable)
	{
		$sql   = "SELECT a.`iddokter` FROM mapping_dokter_bpjs a WHERE  a.`id_dokter` ='".$variable."'";
		$query = $this->dbsupp->query($sql);
		$result = $query->result_array(); 
		if($query->num_rows() > 0)
		{
			$rs = $result[0];
			return $rs['iddokter'];
		}
		else
		{
			return "";
		}
	}
	
	function get_dokter_alt($id_pasien)
	{
		$return = '';
		$sql = "SELECT 	b.`id_dokter`
						FROM 		trx_reg a, trx_reg_unit b, mst_dokter c
						WHERE 	a.id_reg=b.`id_reg` AND b.`id_dokter`=c.`id_dokter` 
										AND a.id_pasien=".$id_pasien."
										AND b.id_unit='".$this->config->item('apem_id_unit_rehabmedik')."' 
										AND c.`id_jenis`='".$this->config->item('apem_id_jenis_dokter_rehabmedik')."'
						ORDER BY a.regdate DESC
						LIMIT 1
						";
		$query = $this->dbhis->query($sql);
		$rs = $query->row_array(); 
		if($rs['id_dokter']!='')
			$return = $rs['id_dokter'];
		
		return $return;
	}
	
	function insert_sep($rujukan,$perjanjian,$other=array())
	{
		$noKartu 				= $rujukan->peserta->noKartu;
		$tglSep 				= $this->today;
		$ppkPelayanan 	= $this->config->item('apem_id_ppk');
		$jnsPelayanan 	= "2";
		
		$klsRawat 			= "3";
		$noMR 					= $rujukan->peserta->mr->noMR;
		$asalRujukan 		= $other['faskes'];
		$tglRujukan 		= $rujukan->tglKunjungan;
		
		$noRujukan 			= $rujukan->noKunjungan;
		$ppkRujukan 		= $rujukan->provPerujuk->kode;
		$catatan 				= $rujukan->keluhan;
		$diagAwal 			= $rujukan->diagnosa->kode;
		
		$tujuan 				= ($other['kode_poli_tujuan']!='')?$other['kode_poli_tujuan']:$rujukan->poliRujukan->kode;
		$eksekutif 			= "0";
		
		$nmAsuransi 	= isset($rujukan->peserta->cob->nnmAsuransi);
		$cob 						= (($nmAsuransi=='')? '0' : '1');
		$katarak 				= '0';
		
		$lakaLantas 		= '0';
		$penjamin 			= '';
		$tgl_kejadian 	= '';
		$ket_kll 				= '';
		
		$suplesi 				= '0';
		$no_sep_suplesi = '';
		$kd_propinsi 		= '';
		$kd_kabupaten 	= '';
		
		$kd_kecamatan 	= '';
		#$no_skdp 				= $perjanjian['id_trx'];
		$no_skdp 				= $this->get_skdp_from_last_reg($perjanjian['id_pasien']);
		$kd_dpjp 				= $other['iddokter'];
		$noTelp 				= $rujukan->peserta->mr->noTelepon;
		$user						= $this->config->item('apem_user_app');
			
		$response = $this->wsv->sep_insert($noKartu,$tglSep,$ppkPelayanan,$jnsPelayanan,
												$klsRawat,$noMR,$asalRujukan,$tglRujukan,
												$noRujukan,$ppkRujukan,$catatan,$diagAwal,
												$tujuan,$eksekutif,$cob,$katarak,
												$lakaLantas,$penjamin,$tgl_kejadian,$ket_kll,
												$suplesi,$no_sep_suplesi,$kd_propinsi,$kd_kabupaten,
												$kd_kecamatan,$no_skdp,$kd_dpjp,$noTelp,$user);
		return $response;
	}
	
	#function add_trx_reg($noka,$namapeserta,$my_id_pasien,$my_id_trx,$my_id_unit,$my_id_dokter,$my_id_num)
	function is_registered_to_smarthis($id_unit,$id_pasien)
	{
		$ret_id_reg = "";
		$sql		= " SELECT 	tr.`id_reg` 
								FROM 		trx_reg tr, `trx_reg_unit` tru 
								WHERE 	tr.`id_reg` = tru.`id_reg`
											 	AND tru.`id_unit`='".$id_unit."' 
											 	AND tr.`id_pasien`='".$id_pasien."' 
											 	AND DATE(tr.`regdate`)=DATE(now())";
		#echo "<pre>".$sql."</pre>";
		$query = $this->dbhis->query($sql);
		$rs = $query->row_array();
		$id_reg_cek = @$rs['id_reg'];
		if ($id_reg_cek!='') 
		{
			$ret_id_reg = $id_reg_cek;
		}
		return $ret_id_reg;
	}
	
	function get_noreg()
	{
		$strID				= "";
		$intCtr 			= 0;
		$intRowCount 	= 0;
		
		$intCurrMonth = date('n');
		$intCurrYear 	= date('Y'); 	
		$pmonth = $intCurrMonth;
		$pyear 	= $intCurrYear;
		
		$sql   = "SELECT a.`ctr` FROM ctr_fo a WHERE  a.`pyear` ='".$pyear."'  AND  a.`pmonth` ='".$pmonth."' AND a.id_ctr='REG'";
		$query = $this->db2->query($sql);
		$objTB = $query->row();
		
		$intRowCount = $query->num_rows();
		if($intRowCount>0){	
			$intCtr =  intval ($objTB->ctr);
		}
		$intCtr++;
		
		$res_abbr = $this->db2->query("SELECT abbr FROM mst_main_setting")->row();
		$abbr 		= $res_abbr->abbr;
		$strID 		= str_pad($intCurrMonth, 2, "0",STR_PAD_LEFT).substr($intCurrYear,2). $abbr .str_pad($intCtr, 5, "0",STR_PAD_LEFT);

		$this->db2->trans_begin();
		if($intRowCount>0){	 
			$sql   = "UPDATE ctr_fo SET ctr=".$intCtr." WHERE  pyear ='".$pyear."'  AND  pmonth ='".$pmonth."' AND id_ctr='REG'";	
		}else{
			$sql   = "INSERT INTO ctr_fo (pmonth,pyear,ctr,id_ctr) VALUES ('".$intCurrMonth."','".$intCurrYear."',".$intCtr.",'REG')";
		}
		$query = $this->db2->query($sql);
		
		if($this->db2->trans_status() === false){
			$this->db2->trans_rollback();
		}
		else
		{
			$this->db2->trans_commit();
		}
		return $strID;
	}

	function add_trx_reg($sep,$perjanjian,$id_pasien)
	{
		$sql					= "SELECT MMS.id_comp_bpjs FROM mst_main_setting MMS";
		$query 				= $this->dbhis->query($sql);
		$rs_asuransi 	= $query->row_array();
		
		$id_reg 		= $this->get_noreg();
		$regdate		= $this->today_timestamp;
		$id_pasien	= str_pad($id_pasien,8,"0",STR_PAD_LEFT);
		
		//$id_asuransi= get_id_comp_bpjs ();
		$id_asuransi= $rs_asuransi['id_comp_bpjs'];
		$mrstat			= 1;
		$rwjn				= 1;
		$penanggung = $sep->response->sep->peserta->nama;
		$card_id		= $sep->response->sep->peserta->noKartu;
		$card_name	= $sep->response->sep->peserta->nama;
		$created 		= $this->today_timestamp;
		$creator		= 'KIOSK_APEM';
		$updated		= $this->today_timestamp;
		$updater		= 'KIOSK_APEM';
		
		//trx_reg_book
		$id_trx			= $perjanjian['id_trx'];
		$id_num			= $perjanjian['id_num'];
		$id_unit		= $perjanjian['id_unit'];
		$id_dokter  = $perjanjian['id_dokter'];
		
		$this->db2->trans_begin();
		
		$sql	= "INSERT  INTO trx_reg 
						(id_reg,regdate,id_pasien,id_asuransi,mrstat,rwjn,penanggung,card_id,card_name,created,creator,updated,updater)
						VALUES
						('".$id_reg."','".$regdate."','".$id_pasien."','".$id_asuransi."','".$mrstat."','".$rwjn."','".$penanggung."','".$card_id."','".$card_name."','".$created."','".$creator."','".$updated."','".$updater."')
						";
		$query 	= $this->db2->query($sql);
		if($this->db2->trans_status() === false)
		{
			$this->db2->trans_rollback();
			$ret_id_reg ='';
		}
		else
		{
			$this->db2->trans_commit();
			$ret_id_reg = $id_reg;
		}
		return $ret_id_reg;
	}
	
	function add_trx_reg_tunai($perjanjian,$id_pasien)
	{		
		$id_reg 		= $this->get_noreg();
		$regdate		= $this->today_timestamp;
		$id_pasien	= str_pad($id_pasien,8,"0",STR_PAD_LEFT);
		
		$mrstat			= 1;
		$rwjn				= 1;
		$penanggung = $perjanjian['name'];
		$created 		= $this->today_timestamp;
		$creator		= 'KIOSK_APEM';
		$updated		= $this->today_timestamp;
		$updater		= 'KIOSK_APEM';
		
		//trx_reg_book
		$id_trx			= $perjanjian['id_trx'];
		$id_num			= $perjanjian['id_num'];
		$id_unit		= $perjanjian['id_unit'];
		$id_dokter  = $perjanjian['id_dokter'];
		
		$this->db2->trans_begin();
		
		$sql	= "INSERT  INTO trx_reg 
						(id_reg,regdate,id_pasien,mrstat,rwjn,penanggung,created,creator,updated,updater)
						VALUES
						('".$id_reg."','".$regdate."','".$id_pasien."','".$mrstat."','".$rwjn."','".$penanggung."','".$created."','".$creator."','".$updated."','".$updater."')
						";
		$query 	= $this->db2->query($sql);
		if($this->db2->trans_status() === false)
		{
			$this->db2->trans_rollback();
			$ret_id_reg ='';
		}
		else
		{
			$this->db2->trans_commit();
			$ret_id_reg = $id_reg;
		}
		return $ret_id_reg;
	}
	
	function add_log_kiosk($sep,$perjanjian,$id_reg,$id_pasien,$rujukan)
	{
		$id_reg 				= $id_reg;
		$id_pasien			= str_pad($id_pasien,8,"0",STR_PAD_LEFT);
		$id_dokter 			= $perjanjian['id_dokter'];
		$no_sep 				= $sep->response->sep->noSep;
		$tgl_sep 				= $sep->response->sep->tglSep;
		$jenis_rawat 		= $sep->response->sep->jnsPelayanan;
		$kelas_rawat 		= $sep->response->sep->kelasRawat;
		$penjamin 			= $sep->response->sep->penjamin;
		$catatan 				= $sep->response->sep->catatan;
		
		$poli_tujuan 		= $sep->response->sep->poli;
		$poli_eksekutif = $sep->response->sep->poliEksekutif;
		$nama_ppk1 			= $rujukan->provPerujuk->nama;
		$diag_awal 			= $sep->response->sep->diagnosa;
		$no_kartu 			= $sep->response->sep->peserta->noKartu;
		$nama 					= $sep->response->sep->peserta->nama;
		$tgl_lahir 			= $sep->response->sep->peserta->tglLahir;
		
		$jkelamin 			= $sep->response->sep->peserta->kelamin;
		$jenis_peserta 	= $sep->response->sep->peserta->jnsPeserta;
		$cob 						= $sep->response->sep->peserta->asuransi;
		$tgl_print 			= $this->today_timestamp;
		$id_trx 				= $perjanjian['id_trx'];
		$id_num 				= $perjanjian['id_num'];
		
		$sql ="	INSERT INTO kiosk_apm_log
						(id_reg,id_pasien,id_dokter,no_sep,tgl_sep,jenis_rawat,kelas_rawat,penjamin,catatan,
						poli_tujuan,poli_eksekutif,nama_ppk1,diag_awal,no_kartu,nama,tgl_lahir,
						jkelamin,jenis_peserta,cob,tgl_print,id_trx,id_num)
						VALUES
						('".$id_reg."','".$id_pasien."','".$id_dokter."','".$no_sep."','".$tgl_sep."','".$jenis_rawat."','".$kelas_rawat."','".$penjamin."','".$catatan."',
						'".$poli_tujuan."','".$poli_eksekutif."','".$nama_ppk1."','".$diag_awal."','".$no_kartu."','".$nama."','".$tgl_lahir."',
						'".$jkelamin."','".$jenis_peserta."','".$cob."','".$tgl_print."','".$id_trx."','".$id_num."')
					";
				
		$query = $this->db->query($sql);
	} 
	
	function add_log_kiosk_non_bpjs($id_reg,$comp_type)
	{
		$id_reg 				= $id_reg;
		$penjamin 			= $comp_type;
		
		$sql = 	"INSERT INTO kiosk_apm_log_non_bpjs
							(id_reg,penjamin)
						VALUES
							('".$id_reg."','".$penjamin."')
						";
		$query = $this->db->query($sql);
	} 
	
	function add_admin_reg($id_reg,$id_comp='')
	{
		$bill_generator = $this->bill_generator;
		#if($id_comp=='') $id_comp = $this->get_id_comp_bpjs();	
		
		$today_timestamp = $this->today_timestamp; 
		
		$id_reg  	= $id_reg;
		$created 	= $today_timestamp;
		$creator	= 'KIOSK_APEM';
		$updated	= $today_timestamp;
		$updater	= 'KIOSK_APEM';	
		
		/*
		$sql= " SELECT MT.id_act,MT.name,MMS.id_comp_bpjs,
						MT.id_group,MT.id_subgroup,MT.markup,MT.price
						FROM mst_main_setting MMS
						INNER JOIN mst_tindakan MT ON MMS.id_act_rwj=MT.id_act";
		*/
		/*
		$sql = "SELECT 	MT.id_act,MT.name,MMS.id_comp_bpjs,
										MT.id_group,MT.id_subgroup,MT.markup,MT.price
										,MTP.`price` AS price_prc
						FROM 		mst_main_setting MMS
										,mst_tindakan MT
										LEFT JOIN mst_tindakan_prc MTP ON (MTP.`id_act`=MT.`id_act` AND MTP.`id_kelas`=-1 AND MTP.`id_comp`='".$id_comp."')
						WHERE	MMS.id_act_rwj=MT.id_act";
						
		$query = $this->db2->query($sql);
		$result = $query->result_array();
		$rs = $result[0];
		*/
		
		$rs = $bill_generator->get_item_admin_reg($id_comp);
		
		$trxdate     	= $today_timestamp;
		$id_reg_act  	= $rs['id_act'];
		$id_type     	= 1;
		$name 		 		= $rs['name'];
		$qty		 			= 1;
		$price 		 		= $rs['price'];
		$total		 		= $rs['price'];
		$id_group_act	= $rs['id_group'];
		#$id_asuransi	= $rs['id_comp_bpjs'];
		$id_asuransi	= $id_comp;
		
		$this->db2->trans_begin();
		#$this->db2->autocommit(false);
		
		$sql =  "INSERT  INTO trx_reg_act 
					 (id_reg,trxdate,id_reg_act,id_type,id_group_act,name,qty,price,total,created,creator,updated,updater)
						VALUES
					 (
					 '".$id_reg."',
					 '".$trxdate."',
					 '".$id_reg_act."',
					 '".$id_type."',
					 '".$id_group_act."',
					 '".$name."',
					 '".$qty."',
					 '".$price."',
					 '".$total."',
					 '".$created."',
					 '".$creator."',
					 '".$updated."',
					 '".$updater."'
					 )
						";
		
		$query = $this->db2->query($sql);
		#$result = $query->result_array();		
		
		#if($result === false){
		if($this->db2->trans_status() === false){
			$this->db2->trans_rollback();
			$msg = false;
		}
		else
		{
			$this->db2->trans_commit();
			$msg = true;
		}	
		return $msg;
	} 
	
	function add_dokter_act($id_reg,$perjanjian,$id_comp='')
	{
		$bill_generator = $this->bill_generator;
		#if($id_comp=='') $id_comp = $this->get_id_comp_bpjs();	

		$today_timestamp = $this->today_timestamp; 
		
		#$id_asuransi = $this->get_id_comp_bpjs();
		$id_unit 		= $perjanjian['id_unit'];
		$id_dokter 	= $perjanjian['id_dokter'];
		$trxdate   	= $today_timestamp;
		$created 		= $today_timestamp;
		$creator		= 'KIOSK_APEM';
		$updated		= $today_timestamp;
		$updater		= 'KIOSK_APEM';	 
		
		$rs = $bill_generator->get_item_konsultasi_dokter($id_comp,$id_dokter,date('Y-m-d'));
		$id_reg_act = $rs['id_act'];		

		$id_group_act = $rs['id_group'];
		$name					= $rs['name'];
		$price  			= $rs['price'];
		$total 				= $rs['price'];
		$id_type     	= 1;
		$qty		 			= 1;	
		
		#$this->db2->autocommit(false);
		$this->db2->trans_begin();
		
		$sql =  "    INSERT  INTO trx_reg_act 
					 (id_reg,trxdate,id_reg_act,id_type,id_dokter,id_group_act,id_unit,name,qty,price,total,created,creator,updated,updater)
						VALUES
					 (
					 '".$id_reg."',
					 '".$trxdate."',
					 '".$id_reg_act."',
					 '".$id_type."',
					 '".$id_dokter."',
					 '".$id_group_act."',
					 '".$id_unit."',
					 '".$name."',
					 '".$qty."',
					 '".$price."',
					 '".$total."',
					 '".$created."',
					 '".$creator."',
					 '".$updated."',
					 '".$updater."')
						";
							
		$query = $this->db2->query($sql);
		if($this->db2->trans_status() === false){
			$this->db2->trans_rollback();
			$id_trx_act ='';
		}
		else
		{
			$this->db2->trans_commit();
			$sql = "SELECT * FROM trx_reg_act a WHERE a.`id_reg_act`='".$id_reg_act."' AND a.`id_reg`='".$id_reg."'";
			$query = $this->db2->query($sql);
			$rs = $query->row_array();
			$id_trx_act = $rs['id_trx'];
		}
		return $id_trx_act;
	} 
	
	function get_addtional_id_act($id_unit)
	{
		$sql   = "SELECT a.`addtional_id_act` FROM mapping_poli_bpjs a WHERE  a.`id_unit` ='".$id_unit."'";
		$query = $this->db->query($sql);
		$rs = $query->row_array();
		if($query->num_rows() > 0)
		{
			return $rs['addtional_id_act'];
		}
		else
		{
			return "";
		}
	}
	
	function add_addtional_id_act($id_reg,$perjanjian,$id_act,$id_comp='')
	{
		## ---------------------------------------------------------------
		if($id_act=='')
		{
			$id_act = $this->get_addtional_id_act($perjanjian['id_unit']);
		}

		if($id_act=='') return;
		## ---------------------------------------------------------------
		
		$bill_generator = $this->bill_generator;
		#if($id_comp=='') $id_comp = $this->get_id_comp_bpjs();	

		$today_timestamp = $this->today_timestamp; 
		
		#$id_asuransi  = $this->get_id_comp_bpjs();
		$id_unit 			= $perjanjian['id_unit'];
		$id_dokter 		= $perjanjian['id_dokter'];
		$id_asuransi	= $id_comp;
		
		$trxdate  = $today_timestamp;
		$created 	= $today_timestamp;
		$creator	= 'KIOSK_APEM';
		$updated	= $today_timestamp;
		$updater	= 'KIOSK_APEM';	 
		
		$rs = $bill_generator->get_addtional_id_act($id_comp,$id_unit);
		if(trim(strtoupper($rs['name']))=='SARIASIH ONLINE')
		{
			$id_dokter 		= "NULL";
		}
		else
		{
			if(intval($rs['price'])==0)
			{
				$sql 					= "SELECT a.price FROM mst_tindakan a WHERE a.`id_act`='".$id_act."'";
				$query_alt 		= $this->db2->query($sql);
				$rs_alt 			= $query_alt->row_array();
				$rs['price'] 	= $rs_alt['price'];
			}
		}
		$id_group_act = $rs ['id_group'];
		$name					= $rs ['name'];
		$price  			= $rs ['price'];
		$total 				= $rs ['price'];
		$id_type     	= 1;
		$qty		 			= 1;
		
		#$this->db2->autocommit(false);
		$this->db2->trans_begin();
		$sql =  "    INSERT  INTO trx_reg_act 
					 (id_reg,trxdate,id_reg_act,id_type,id_dokter,id_group_act,id_unit,name,qty,price,total,created,creator,updated,updater)
						VALUES
					 (
					 '".$id_reg."',
					 '".$trxdate."',
					 '".$id_act."',
					 '".$id_type."',
					 ".$id_dokter.",
					 '".$id_group_act."',
					 '".$id_unit."',
					 '".$name."',
					 '".$qty."',
					 '".$price."',
					 '".$total."',
					 '".$created."',
					 '".$creator."',
					 '".$updated."',
					 '".$updater."')
						";	
					#echo "<pre>".$sql."</pre>";
					#die();
		$query = $this->db2->query($sql);
		#$result = $query->result_array();		
		
		#if($result === false){
		if($this->db2->trans_status() === false){
			$this->db2->trans_rollback();
			$msg='';
		}
		else
		{
			$this->db2->trans_commit();	
			$msg='OK';
		}
		return $msg;
	}
	
	function test_add_addtional_id_act($id_reg,$perjanjian='',$id_act,$id_comp='')
	{
		## ---------------------------------------------------------------
		/*
		if($id_act=='')
		{
			$id_act = $this->get_addtional_id_act($perjanjian['id_unit']);
		}
		if($id_act=='') return;
		*/
		## ---------------------------------------------------------------
		
		$bill_generator = $this->bill_generator;
		#if($id_comp=='') $id_comp = $this->get_id_comp_bpjs();	

		$today_timestamp = $this->today_timestamp; 
		
		#$id_asuransi  = $this->get_id_comp_bpjs();
		
		#$id_unit 			= '016';
		#$id_dokter 		= '505';
		$id_unit 			= $perjanjian['id_unit'];
		$id_dokter 		= $perjanjian['id_dokter'];
		
		#$id_asuransi	= $asuransi;
		
		$trxdate  = $today_timestamp;
		$created 	= $today_timestamp;
		$creator	= 'KIOSK_APEM';
		$updated	= $today_timestamp;
		$updater	= 'KIOSK_APEM';	 
		
		$rs = $bill_generator->get_addtional_id_act($id_comp,$id_unit,$id_act);
		
		if(intval($rs['price'])==0)
		{
			$sql 					= "SELECT a.price FROM mst_tindakan a WHERE a.`id_act`='".$id_act."'";
			$query_alt 		= $this->db2->query($sql);
			$rs_alt 			= $query_alt->row_array();
			$rs['price'] 	= $rs_alt['price'];
		}
		
		$id_group_act = $rs ['id_group'];
		$name					= $rs ['name'];
		$price  			= $rs ['price'];
		$total 				= $rs ['price'];
		$id_type     	= 1;
		$qty		 			= 1;
		
		$sql =  "    INSERT  INTO trx_reg_act 
					 (id_reg,trxdate,id_reg_act,id_type,id_dokter,id_group_act,id_unit,name,qty,price,total,created,creator,updated,updater)
						VALUES
					 (
					 '".$id_reg."',
					 '".$trxdate."',
					 '".$id_act."',
					 '".$id_type."',
					 '".$id_dokter."',
					 '".$id_group_act."',
					 '".$id_unit."',
					 '".$name."',
					 '".$qty."',
					 '".$price."',
					 '".$total."',
					 '".$created."',
					 '".$creator."',
					 '".$updated."',
					 '".$updater."')
						";	
						
		echo "<pre>".$sql."</pre>";
	}
	
	function add_trx_reg_unit($id_reg,$perjanjian,$id_trx_act)
	{
		
		$today_timestamp = $this->today_timestamp;
		
		$trxdate  = $today_timestamp;
		$created 	= $today_timestamp;
		$creator	= 'KIOSK_APEM';
		$updated	= $today_timestamp;
		$updater	= 'KIOSK_APEM';	
		
		$id_unit 		= $perjanjian['id_unit'];
		$id_dokter	= $perjanjian['id_dokter'];
		$id_num 		= $perjanjian['id_num'];
		$id_slot		= $id_num;
		 
		$this->db2->trans_begin();
		$sql    =  "INSERT  INTO trx_reg_unit 
					 (id_reg,trxdate,id_unit,id_dokter,ctr_num,id_trx_act,id_slot,created,creator,updated,updater)
						VALUES
					 (
					 '".$id_reg."',
					 '".$trxdate."',
					 '".$id_unit."',
					 '".$id_dokter."',
					 '".$id_num."',
					 '".$id_trx_act."',
					 '".$id_slot."',
					 '".$created."',
					 '".$creator."',
					 '".$updated."',
					 '".$updater."')
						";
		
		$query = $this->db2->query($sql);
		
		if($this->db2->trans_status() === false)
		{
			$this->db2->trans_rollback();
			$msg='';
		}
		else
		{
			$this->db2->trans_commit();
			$msg='OK';
		}
		return $msg;
	}
	
	function update_status_booking($id_reg,$id_trx)
	{
		#$this->db2->autocommit(false);
		$this->db2->trans_begin();
		$sql    =  "UPDATE trx_reg_book SET status=1,id_reg ='".$id_reg."' WHERE id_trx ='".$id_trx."' ";
		
		$query = $this->db2->query($sql);
		#$result = $query->result_array();
		 
		#if($result === false){
		if($this->db2->trans_status() === false){
			$this->db2->trans_rollback();
			$msg='';
		}
		else
		{
			$this->db2->trans_commit();
			$msg='OK';
		}
		
		return $msg;		
	}

	function cek_faskes_berapa($kode_faskes)
	{
		# cek apakah ini ppk1? dulu
		$faskes = 2;
		$data = $this->wsv->referensi_faskes($kode_faskes,1); // 1=ppk1; 2=ppk2/RS
		if(isset($data->metaData->code))
		{
			if($data->metaData->code == '200')
				$faskes = 1;
		}
		return $faskes;
	}
	
	function get_monitor_kunjungan_terakhir_peserta_by_rujukan($noka,$noRujukan)
	{
		$return = array(); ## >> init
		$today = $this->today;
		$sebulan_lalu = date('Y-m-d' , mktime(0,0,0,date('n'),(date('j')-90),date('Y')));
		$data = $this->wsv->monitoring_data_histori_pelayanan_peserta($noka,$sebulan_lalu,$today);
		if(isset($data->response->histori[0]->noRujukan))
		{
			foreach($data->response->histori as $k => $v)
			{
				if($v->jnsPelayanan == 2 && $v->noRujukan == $noRujukan)
				{
					$return = $v;
				}
			}
		}
		return $return;
	}
	
	function get_dokter_sebelumnya($id_pasien,$id_unit_smarthis,$tgl_sep)
	{
		$id_asuransi = $this->get_id_comp_bpjs();
		$sql = "SELECT 	b.`id_dokter`,b.`id_unit`,a.*
						FROM 		trx_reg a, trx_reg_unit b
						WHERE 	a.id_reg=b.id_reg
										AND a.`id_pasien`=".$id_pasien."
										-- AND b.`id_unit`=".$id_unit_smarthis."
										AND DATE(a.`regdate`)='".$tgl_sep."'
										AND a.`id_asuransi`='".$id_asuransi."'
						LIMIT 1
										";
		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->row_array();
		if($rs['id_dokter']!='')
			$id_dokter = $rs['id_dokter'];
		else
			$id_dokter = '';
			
		return $id_dokter;
	}
	
	function cek_is_post_rawat($id_pasien)
	{
		$is_post_rawat = false;
		$sql = "SELECT a.* FROM trx_reg a WHERE a.id_pasien=".$id_pasien." ORDER BY a.regdate DESC LIMIT 1";
		$query 	= $this->dbhis->query($sql);
		$jumdata = $query->num_rows();
		if($jumdata>0)
		{
			$rs = $query->row_array();
			if($rs['rwip']==1)
				$is_post_rawat = true;
		}
		return $is_post_rawat;
	}
	
	function data_kunjungan_sebelumnya_smarthis($id_pasien)
	{
		$sql 		= "	SELECT 	a.id_reg,b.id_dokter
								FROM 		trx_reg a, trx_reg_unit b
								WHERE 	a.id_reg=b.id_reg AND a.rwjn=1 AND a.id_pasien=".$id_pasien." 
								ORDER BY a.regdate DESC 
								LIMIT 10";
		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->result_array();
		$jumdata = $query->num_rows();
		if($jumdata>0)
		{
			return $rs;
		}
		else
		{
			return array();
		}	
	}
	
	function get_skdp_from_last_reg($id_pasien)
	{
		if($id_pasien=='')
			return '';
			
		$no_skdp = '';
		$sql 		= "	SELECT 	LPAD(SUBSTRING(a.id_reg,-5),6,0) AS no_skdp
								FROM 		trx_reg a
								WHERE 	a.id_pasien=".$id_pasien." 
								ORDER BY a.regdate DESC 
								LIMIT 1";
		$query 	= $this->dbhis->query($sql);
		$rs 		= $query->row_array();
		$jumdata = $query->num_rows();
		if($jumdata>0)
		{
			$no_skdp = $rs['no_skdp'];
		}
		return $no_skdp;
	}
	
	function get_data_rujukan_dari_rawat_inap($noka)
	{
		$histori = array();
		$today = $this->today;
		$tiga_bulan_lalu = date('Y-m-d' , mktime(0,0,0,date('n'),(date('j')-90),date('Y')));
		$data = $this->wsv->monitoring_data_histori_pelayanan_peserta($noka,$tiga_bulan_lalu,$today);
		if(isset($data->response->histori[0]->noSep))
		{
			foreach($data->response->histori as $k => $v)
			{
				if($v->jnsPelayanan=='1')
				{
					$histori = $v;
					break;
				}
			}
		}
		return $histori;	
	}
	
	public function get_perjanjian_today_by_id_pasien($id_pasien)
	{
		$sql = "SELECT 	a.*,d.* 
						FROM 		trx_reg_book a
										LEFT JOIN dbsupp.ko_booking_payment d ON (d.id_booking=a.id_trx)
						WHERE 	a.id_pasien='".$id_pasien."' AND a.bookdate='".$this->today."' AND a.id_reg IS NULL";
		$query = $this->dbhis->query($sql);
		$jum_data = $query->num_rows();
		$rs = $query->result_array();
		$data = array(
			'jum_data'	=> $jum_data,
			'rs'				=> $rs,
		);
		return $data;
	}
	
	public function get_perjanjian_by_id_booking($id_booking)
	{
		$sql = "SELECT 	a.*,d.* 
						FROM 		trx_reg_book a 
										LEFT JOIN dbsupp.ko_booking_payment d ON (d.id_booking=a.id_trx)
						WHERE 	a.id_trx=".$id_booking."";
		$query = $this->dbhis->query($sql);
		$jum_data = $query->num_rows();
		$rs = $query->result_array();
		$data = array(
			'jum_data'	=> $jum_data,
			'rs'				=> $rs,
		);
		return $data;
	}
		
	public function get_id_booking_by_id_pasien($id_pasien)
	{
		$data = $this->get_perjanjian_today_by_id_pasien($id_pasien);
		if($data['jum_data'] == 1)
		{
			return $data['rs'][0]['id_trx'];
		}
		elseif($data['jum_data'] > 1)
		{
			return 999999999999;
		}
	}
	
	public function get_id_booking_by_id_pasien_for_payment($id_pasien)
	{
		$data = $this->get_unpaid_perjanjian_by_id_pasien($id_pasien);
		if($data['jum_data'] == 1)
		{
			return $data['rs'][0]['id_trx'];
		}
		elseif($data['jum_data'] > 1)
		{
			return 999999999999;
		}
	}
	
	public function get_unpaid_perjanjian_by_id_pasien($id_pasien)
	{
		$sql = "SELECT 	a.*,d.* 
						FROM 		trx_reg_book a
										LEFT JOIN dbsupp.ko_booking_payment d ON (d.id_booking=a.id_trx)
						WHERE 	a.id_pasien='".$id_pasien."' AND a.bookdate>='".$this->today."' AND a.id_reg IS NULL";
		$query = $this->dbhis->query($sql);
		$jum_data = $query->num_rows();
		$rs = $query->result_array();
		$data = array(
			'jum_data'	=> $jum_data,
			'rs'				=> $rs,
		);
		return $data;
	}
	
	function remove_trx_reg($id_reg='')
	{
		if($id_reg=='') return;
		
		$sql = "DELETE FROM trx_reg WHERE id_reg='".$id_reg."'";
		$query = $this->dbhis->query($sql);	
	}
	
}