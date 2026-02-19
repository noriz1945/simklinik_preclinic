<?php
/*--------------------------------------------------*/
// Created by sarkodan@gmail.com 					[24-06-2020]
/*--------------------------------------------------*/
defined('BASEPATH') or exit('No direct script access allowed');
class WsKasirOnline {
	
	var $config;
	
	public function __construct()
  {
		$CI =& get_instance();
		$CI->wsko = $this;
		$this->config = $CI->config;
	}
	
	public function is_connected()
	{
		$url 	= 'https://sariasihgroup.com/kasir_online';
		$port = 80;
		$fP 	= fSockOpen($url, $port, $errno, $errstr, 10);
		if (!$fP) { return false; } else { return true;}
  }
	
	/*
  function get_signature($cons_id,$secretKey)
	{	
		// Computes the timestamp
		date_default_timezone_set('UTC');	
		#date_default_timezone_set('Asia/Jakarta');
		$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		$data 	= $cons_id."&".$tStamp;
		// Computes the signature by hashing the salt with the secret key as the key
		$signature = hash_hmac('sha256', $data, $secretKey, true);
		// base64 encode…
		$encodedSignature = base64_encode($signature);
		// urlencode…
		// $encodedSignature = urlencode($encodedSignature);
		return array(
			'tStamp' 						=>$tStamp,
			'encodedSignature' 	=>$encodedSignature,
		);
	}
	*/

	public function simple_curl($service_url_parameter,$method,$myvars='')
	{	
	
		$debug 					= $this->config->item('apem_debug');
		$debug_level 		= $this->config->item('apem_debug_level');
		
		#$debug					= true;
		$app 						= $this->config->item('app');
		$ConsumerID 		= $this->config->item('apem_ConsumerID');
		$ConsumerSecret = $this->config->item('apem_ConsumerSecret');
		
		$Headers = $this->get_signature($ConsumerID,$ConsumerSecret);
		$tStamp=$Headers['tStamp'];
		$encodedSignature=$Headers['encodedSignature'];
		#print_r($Headers);
		if (strtoupper($method)=='GET')
		$ctype= "application/json; charset=utf-8";
		else
		$ctype= "application/x-www-form-urlencoded";
		
		$arr_header = array(
		'Content-Type:'.$ctype, 
		'X-Cons-ID:'. $ConsumerID,
		'X-Timestamp:'. $tStamp,
		'X-Signature:'. $encodedSignature,
		);
		
		#$url_execute = $BaseURL.$ServiceName.$service_url_parameter;
		$url_execute = $service_url_parameter;
		$session = curl_init($url_execute);
		if($debug && $debug_level>=2)
		{
		$file_txt = $_SERVER["DOCUMENT_ROOT"] . "/" . $app . "/curl_log.txt";
		#$file_txt = $_SERVER['HTTP_REFERER'] . "/" . "curl_log.txt";
		
		$curl_log = fopen($file_txt, 'wr'); // open file for READ and write
		#echo FCPATH . "curl_log.txt" . "<br>";
		curl_setopt($session, CURLOPT_VERBOSE, true);
		curl_setopt($session, CURLOPT_STDERR, $curl_log);
		}
		
		curl_setopt ($session, CURLOPT_CUSTOMREQUEST, strtoupper($method));
		
		curl_setopt ( $session, CURLOPT_URL, $url_execute );
		curl_setopt ( $session, CURLOPT_HTTPHEADER, $arr_header );
		curl_setopt ( $session, CURLOPT_VERBOSE, true );
		curl_setopt ( $session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ( $session, CURLOPT_SSL_VERIFYHOST, false);
		
		if (strtoupper($method)!='GET')
		{
		
		curl_setopt ( $session, CURLOPT_POST, true );
		curl_setopt ( $session, CURLOPT_POSTFIELDS, $myvars );
		}
		curl_setopt ( $session, CURLOPT_RETURNTRANSFER, TRUE );
		$result     = curl_exec ( $session );
		
		if($debug && $debug_level>=2)
		{
			fclose($curl_log);
			$filename = $file_txt;
			$handle = fopen($filename, "r");
			$contents = fread($handle, filesize($filename));
			fclose($handle);
			echo "<br><hr><br>";
			echo nl2br($contents);	
			
			echo "<br>Request : <br>";
			echo $url_execute . "<br>";
			if(strtoupper($method)=='POST')
			{
				echo "<br>POSTED DATA : <br>";
				print_r(json_decode($myvars));
			}
			echo "<br>Response : <br>";
			print_r(json_decode($result));
			echo "<br>";
		}
		return json_decode($result);
	} 
	
	public function generate_url_ws($url_katalog,$parameter_1='',$parameter_2='',$parameter_3='',$parameter_4='')
	{
		$BaseURL 			= $this->config->item('apem_BaseURL');
		$ServiceName 	= $this->config->item('apem_ServiceName');
		$url_service 	= str_replace("{Base URL}",$BaseURL,
										str_replace("{BASE URL}",$BaseURL,
										str_replace("{Service Name}",$ServiceName,
										str_replace("{Parameter}",$parameter_1,
										str_replace("{parameter}",$parameter_1,
										str_replace("{parameter 1}",$parameter_1,
										str_replace("{parameter 2}",$parameter_2,
										str_replace("{parameter 3}",$parameter_3,
										str_replace("{parameter 4}",$parameter_4,
										str_replace("{Parameter 1}",$parameter_1,
										str_replace("{Parameter 2}",$parameter_2,
										str_replace("{Parameter 3}",$parameter_3,
										str_replace("{Parameter 4}",$parameter_4,
										$url_katalog)))))))))))));
		return $url_service;
	}
		
	# Fungsi : Pencarian data diagnosa (ICD-10)
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter: Kode atau Nama Diagnosa
	public function referensi_diagnosa($parameter_1)
	{			
		$method = 'GET';
		$url_katalog="{Base URL}/{Service Name}/referensi/diagnosa/{parameter}";	
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}	
	
	# Fungsi : Pencarian data poli
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter: Kode atau Nama Poli
	public function referensi_poli($parameter_1)
	{			
		$method = 'GET';
		$url_katalog="{Base URL}/{Service Name}/referensi/poli/{Parameter}";	
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Pencarian data fasilitas kesehatan
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter_1: nama atau kode faskes
	# Parameter_2: Jenis Faskes (1. Faskes 1, 2. Faskes 2/RS)
	public function referensi_faskes($parameter_1,$parameter_2)
	{			
		$method = 'GET';
		$url_katalog="{Base URL}/{Service Name}/referensi/faskes/{Parameter 1}/{Parameter 2}";	
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1,$parameter_2);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Pencarian data dokter DPJP
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter_1: nama atau kode faskes
	# Parameter_2: Tgl.Pelayanan/SEP (yyyy-mm-dd)
	# Parameter_3: Kode Spesialis/Subspesialis
	public function referensi_dokter_dpjp($parameter_1,$parameter_2,$parameter_3)
	{			
		$method = 'GET';
		$url_katalog="{Base URL}/{Service Name}/referensi/dokter/pelayanan/{Parameter 1}/tglPelayanan/{Parameter 2}/Spesialis/{Parameter 3}";
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1,$parameter_2,$parameter_3);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Pencarian data propinsi
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	public function referensi_propinsi()
	{			
		$method = 'GET';
		$url_katalog="{Base URL}/{Service Name}/referensi/propinsi";
		$service_url_parameter = $this->generate_url_ws($url_katalog);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Pencarian data kota/kabupaten
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter 1 : Kode Propinsi
	public function referensi_kota_kabupaten($parameter_1)
	{			
		$method = 'GET';
		$url_katalog="{Base URL}/{Service Name}/referensi/kabupaten/propinsi/{paramater 1}";
		$service_url_parameter = $this->generate_url_ws($url_katalog);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Pencarian data kecamatan
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter 1 : Kode Kabupaten
	public function referensi_kecamatan($parameter_1)
	{			
		$method = 'GET';
		$url_katalog="{Base URL}/{Service Name}/referensi/kecamatan/kabupaten/{paramater 1}";
		$service_url_parameter = $this->generate_url_ws($url_katalog);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Pencarian data peserta BPJS Kesehatan
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter_1: Nomor Kartu
	# Parameter_2: Tanggal Pelayanan/SEP - format : yyyy-MM-dd
	public function peserta_cari($parameter_1,$parameter_2='')
	{			
		$parameter_2 = ($parameter_2!='')?$parameter_2:date('Y-m-d');
		$method = 'GET';
		$url_katalog="{BASE URL}/{Service Name}/Peserta/nokartu/{parameter 1}/tglSEP/{parameter 2}";	
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1,$parameter_2);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Pencarian data peserta berdasarkan NIK Kependudukan
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter_1: NIK KTP
	# Parameter_2: Tanggal Pelayanan/SEP - format : yyyy-MM-dd
	public function peserta_cari_by_nik_ktp($parameter_1)
	{			
		$method = 'GET';
		$url_katalog="{BASE URL}/{Service Name}/Peserta/nik/{parameter 1}/tglSEP/{parameter 2}";	
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Melihat data detail SEP Peserta
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter: Nomor SEP Peserta
	public function sep_cari($parameter_1)
	{			
		$method = 'GET';
		$url_katalog="{BASE URL}/{Service Name}/SEP/{parameter}";	
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}	
	
	# Fungsi : Insert SEP versi 1.1
	# Method : POST
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	public function sep_insert($noKartu,$tglSep,$ppkPelayanan,$jnsPelayanan,
												$klsRawat,$noMR,$asalRujukan,$tglRujukan,
												$noRujukan,$ppkRujukan,$catatan,$diagAwal,
												$tujuan,$eksekutif,$cob,$katarak,
												$lakaLantas,$penjamin,$tgl_kejadian,$ket_kll,
												$suplesi,$no_sep_suplesi,$kd_propinsi,$kd_kabupaten,
												$kd_kecamatan,$no_skdp,$kd_dpjp,$noTelp,$user)
	{			
		$method = 'POST';
		$url_katalog="{BASE URL}/{Service Name}/SEP/1.1/insert";	
		$service_url_parameter = $this->generate_url_ws($url_katalog);
		
		$myitem ='
					{
						 "request": {
								"t_sep": {
									 "noKartu": "'.$noKartu.'",
									 "tglSep": "'.$tglSep.'",
									 "ppkPelayanan": "'.$ppkPelayanan.'",
									 "jnsPelayanan": "'.$jnsPelayanan.'",
									 "klsRawat": "'.$klsRawat.'",
									 "noMR": "'.$noMR.'",
									 "rujukan": {
											"asalRujukan": "'.$asalRujukan.'",
											"tglRujukan": "'.$tglRujukan.'",
											"noRujukan": "'.$noRujukan.'",
											"ppkRujukan": "'.$ppkRujukan.'"
									 },
									 "catatan": "'.$catatan.'",
									 "diagAwal": "'.$diagAwal.'",
									 "poli": {
											"tujuan": "'.$tujuan.'",
											"eksekutif": "'.$eksekutif.'"
									 },
									 "cob": {
											"cob": "'.$cob.'"
									 },
									 "katarak": {
											"katarak": "'.$katarak.'"
									 },
									 "jaminan": {
											"lakaLantas": "'.$lakaLantas.'",
											"penjamin": {
													"penjamin": "'.$penjamin.'",
													"tglKejadian": "'.$tgl_kejadian.'",
													"keterangan": "'.$ket_kll.'",
													"suplesi": {
															"suplesi": "'.$suplesi.'",
															"noSepSuplesi": "'.$no_sep_suplesi.'",
															"lokasiLaka": {
																 "kdPropinsi": "'.$kd_propinsi.'",
																	"kdKabupaten": "'.$kd_kabupaten.'",
																	"kdKecamatan": "'.$kd_kecamatan.'"
																	}
													}
											}
									 },
									 "skdp": {
											"noSurat": "'.$no_skdp.'",
											"kodeDPJP": "'.$kd_dpjp.'"
									 },
									 "noTelp": "'.$noTelp.'",
									 "user": "'.$user.'"
								}
						 }
					}                    
		';
		/*
		if($this->config->item('apem_debug'))
		{
			echo "<br><br>DATA SEP YANG DIPOST DARI APEM : <br>
							<pre>".$myitem."</pre>
						<br><br>";
			$response = json_decode($myitem);
		}
		else
			$response = $this->simple_wsvclaim($service_url_parameter,$method,$myitem);
		*/
		/*
		echo "<br><br>DATA SEP YANG DIPOST DARI APEM : <br>
							<pre>".$myitem."</pre>
						<br><br>";
		*/
		$response = $this->simple_wsvclaim($service_url_parameter,$method,$myitem);
		
		return $response;

	}	
	
	# Fungsi : Update SEP versi 1.1
	# Method : PUT
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	public function sep_update($noKartu,$tglSep,$ppkPelayanan,$jnsPelayanan,
												$klsRawat,$noMR,$asalRujukan,$tglRujukan,
												$noRujukan,$ppkRujukan,$catatan,$diagAwal,
												$tujuan,$eksekutif,$cob,$katarak,
												$lakaLantas,$penjamin,$tgl_kejadian,$ket_kll,
												$suplesi,$no_sep_suplesi,$kd_propinsi,$kd_kabupaten,
												$kd_kecamatan,$no_skdp,$kd_dpjp,$noTelp,$user)
	{			
		$method = 'PUT';
		$url_katalog="{BASE URL}/{Service Name}/SEP/1.1/Update";	
		$service_url_parameter = $this->generate_url_ws($url_katalog);
		
		$myitem ='
					{
						 "request": {
								"t_sep": {
									 "noKartu": "'.$noKartu.'",
									 "tglSep": "'.$tglSep.'",
									 "ppkPelayanan": "'.$ppkPelayanan.'",
									 "jnsPelayanan": "'.$jnsPelayanan.'",
									 "klsRawat": "'.$klsRawat.'",
									 "noMR": "'.$noMR.'",
									 "rujukan": {
											"asalRujukan": "'.$asalRujukan.'",
											"tglRujukan": "'.$tglRujukan.'",
											"noRujukan": "'.$noRujukan.'",
											"ppkRujukan": "'.$ppkRujukan.'"
									 },
									 "catatan": "'.$catatan.'",
									 "diagAwal": "'.$diagAwal.'",
									 "poli": {
											"tujuan": "'.$tujuan.'",
											"eksekutif": "'.$eksekutif.'"
									 },
									 "cob": {
											"cob": "'.$cob.'"
									 },
									 "katarak": {
											"katarak": "'.$katarak.'"
									 },
									 "jaminan": {
											"lakaLantas": "'.$lakaLantas.'",
											"penjamin": {
													"penjamin": "'.$penjamin.'",
													"tglKejadian": "'.$tgl_kejadian.'",
													"keterangan": "'.$ket_kll.'",
													"suplesi": {
															"suplesi": "'.$suplesi.'",
															"noSepSuplesi": "'.$no_sep_suplesi.'",
															"lokasiLaka": {
																 "kdPropinsi": "'.$kd_propinsi.'",
																	"kdKabupaten": "'.$kd_kabupaten.'",
																	"kdKecamatan": "'.$kd_kecamatan.'"
																	}
													}
											}
									 },
									 "skdp": {
											"noSurat": "'.$no_skdp.'",
											"kodeDPJP": "'.$kd_dpjp.'"
									 },
									 "noTelp": "'.$noTelp.'",
									 "user": "'.$user.'"
								}
						 }
					}                    
		';
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method,$myitem);
		return $response;

	}	
	
	# Fungsi : Hapus Data SEP
	# Method : DELETE
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	public function sep_hapus($noSep,$user)
	{			
		$method = 'DELETE';
		$url_katalog="{BASE URL}/{Service Name}/SEP/Delete";
		$service_url_parameter = $this->generate_url_ws($url_katalog);
		
		$myitem ='
					 {
						 "request": {
								"t_sep": {
									 "noSep": "'.$noSep.'",
									 "user": "'.$user.'"
								}
						 }
					}
		';
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method,$myitem);
		return $response;

	}	
	
	public function rujukan_search($parameter_1,$from='auto') ## $from = pcare / rs
	{	
		$from = strtolower($from);
		
		if($from == 'pcare')
			$response = $this->rujukan_search_pcare($parameter_1);
		elseif($from == 'rs')
			$response = $this->rujukan_search_rs($parameter_1);
		else # auto #
		{
			$response = $this->rujukan_search_pcare($parameter_1);
			if($response->response->rujukan->noKunjungan!='')
				$response = $response;
			else
				$response = $this->rujukan_search_rs($parameter_1);
		}
		
		return $response;
	}	
	
	# Fungsi : Pencarian data rujukan dari Pcare berdasarkan nomor rujukan
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter : Nomor Rujukan
	# {BASE URL}/{Service Name}/Rujukan/{parameter}
	public function rujukan_search_pcare($parameter_1)
	{	
		$method = 'GET';
		$url_katalog="{BASE URL}/{Service Name}/Rujukan/{parameter}";
		
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,'GET');
		return $response;
	}	
	
	# Fungsi : Pencarian data rujukan dari Rumah Sakit berdasarkan nomor rujukan
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter : Nomor Rujukan
	# {BASE URL}/{Service Name}/Rujukan/RS/{parameter}
	public function rujukan_search_rs($parameter_1)
	{	
		$method = 'GET';
		$url_katalog="{BASE URL}/{Service Name}/Rujukan/RS/{parameter}";
		
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,'GET');
		return $response;
	}	
	
	# Fungsi : Pencarian data rujukan dari PCare berdasarkan nomor kartu
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter : Nomor kartu
	public function rujukan_search_pcare_single_by_noka($parameter_1)
	{	
		$method = 'GET';
		$url_katalog="{BASE URL}/{Service Name}/Rujukan/Peserta/{parameter}";
		
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Pencarian data rujukan dari rumah sakit berdasarkan nomor kartu
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter : Nomor kartu
	public function rujukan_search_rs_single_by_noka($parameter_1)
	{	
		$method = 'GET';
		$url_katalog="{BASE URL}/{Service Name}/Rujukan/RS/Peserta/{parameter}";
		
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}	

	# Fungsi : Pencarian data rujukan dari PCare berdasarkan nomor kartu
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter : Nomor kartu
	public function rujukan_search_pcare_multi_by_noka($parameter_1)
	{	
		$method = 'GET';
		$url_katalog="{BASE URL}/{Service Name}/Rujukan/List/Peserta/{parameter}";
		
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Pencarian data rujukan dari rumah sakit berdasarkan nomor kartu
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter : Nomor kartu
	public function rujukan_search_rs_multi_by_noka($parameter_1)
	{	
		$method = 'GET';
		$url_katalog="{BASE URL}/{Service Name}/Rujukan/RS/list/Peserta/{parameter}";
		
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}
	
	# Fungsi : Insert Rujukan
	# Method : POST
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	public function rujukan_insert($noSep,$tglRujukan,$ppkDirujuk,$jnsPelayanan,$catatan,$diagRujukan,$tipeRujukan,$poliRujukan,$user)
	{			
		$method = 'POST';
		$url_katalog="{BASE URL}/{Service Name}/Rujukan/insert";	
		$service_url_parameter = $this->generate_url_ws($url_katalog);
		$myitem ='
		{
       "request": {
          "t_rujukan": {
             "noSep": "'.$noSep.'",
             "tglRujukan": "'.$tglRujukan.'",
             "ppkDirujuk": "'.$ppkDirujuk.'",
             "jnsPelayanan": "'.$jnsPelayanan.'",
             "catatan": "'.$catatan.'",
             "diagRujukan": "'.$diagRujukan.'",
             "tipeRujukan": "'.$tipeRujukan.'",
             "poliRujukan": "'.$poliRujukan.'",
             "user": "'.$user.'"
          }
       }
    }                               
		';
		$response = $this->simple_wsvclaim($service_url_parameter,$method,$myitem);
		return $response;
	}
	
	# Fungsi : Update Rujukan
	# Method : PUT
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	public function rujukan_update($noRujukan,$ppkDirujuk,$tipe,$jnsPelayanan,$catatan,$diagRujukan,$tipeRujukan,$poliRujukan,$user)
	{			
		$method = 'PUT';
		$url_katalog="{BASE URL}/{Service Name}/Rujukan/update";
		$service_url_parameter = $this->generate_url_ws($url_katalog);
		$myitem ='
		{
       "request": {
          "t_rujukan": {
             "noRujukan": "'.$noRujukan.'",
             "ppkDirujuk": "'.$ppkDirujuk.'",
             "tipe": "'.$tipe.'",
             "jnsPelayanan": "'.$jnsPelayanan.'",
             "catatan": "'.$catatan.'",
             "diagRujukan": "'.$diagRujukan.'",
             "tipeRujukan": "'.$tipeRujukan.'",
             "poliRujukan": "'.$poliRujukan.'",
             "user": "'.$user.'"
          }
       }
    }                        
		';
		$response = $this->simple_wsvclaim($service_url_parameter,$method,$myitem);
		return $response;
	}	
	
	# Fungsi : Delete Rujukan
	# Method : DELETE
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	public function rujukan_hapus($noRujukan,$user)
	{			
		$method = 'DELETE';
		$url_katalog="{BASE URL}/{Service Name}/Rujukan/delete";
		$service_url_parameter = $this->generate_url_ws($url_katalog);
		$myitem ='
		{
        "request": {
            "t_rujukan": {
                "noRujukan": "'.$noRujukan.'",
                "user": "'.$user.'"
            }
        }
    } 
		';
		$response = $this->simple_wsvclaim($service_url_parameter,$method,$myitem);
		return $response;
	}	
	
	# Fungsi : Data Kunjungan
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter 1 : Tanggal SEP format: yyyy-mm-dd
	# Parameter 2 : Jenis Pelayanan (1. Inap 2. Jalan)
	public function monitoring_data_kunjungan($parameter_1,$parameter_2)
	{			
		$method = 'GET';
		$url_katalog="{Base URL}/{Service Name}/Monitoring/Kunjungan/Tanggal/{Parameter 1}/JnsPelayanan/{Parameter 2}";
		
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1,$parameter_2);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}	
	
	# Fungsi : Histori Pelayanan Per Peserta
	# Method : GET
	# Format : Json
	# Content-Type: application/json; charset=utf-8
	# Parameter 1 : No.Kartu Peserta
	# Parameter 2 : Tgl Mulai Pencarian (yyyy-mmdd)
	# Parameter 3 : Tgl Akhir Pencarian (yyyy-mmdd)
	public function monitoring_data_histori_pelayanan_peserta($parameter_1,$parameter_2,$parameter_3)
	{
		$method = 'GET';
		#$url_katalog = "{Base URL}/{Service Name}/monitoring/HistoriPelayanan/NoKartu/{Parameter 1}/tglMulai/{Parameter 2}/tglAkhir/{Parameter 3}";	// tglMulai diganti jadi tglAwal
		$url_katalog = "{Base URL}/{Service Name}/monitoring/HistoriPelayanan/NoKartu/{Parameter 1}/tglAwal/{Parameter 2}/tglAkhir/{Parameter 3}";
		
		$service_url_parameter = $this->generate_url_ws($url_katalog,$parameter_1,$parameter_2,$parameter_3);
		
		$response = $this->simple_wsvclaim($service_url_parameter,$method);
		return $response;
	}	
	
}
?>