<?php
	/*-----------------------------------------------------*/
	// wsvclaim 2.0 for CodeIgniter By Sarkodan	[2021-11-22]
	/*-----------------------------------------------------*/
	
	class WsVclaim_2_0 {
		
		var $config;
		
		public function __construct() {
			$CI =& get_instance();
			$CI->wsv = $this;
			$this->config = $CI->config;
		}
		
		public function is_connected() {
			$url = $this->config->item('apem_BaseURL_check_conn');
			$port = $this->config->item('apem_BaseURL_port');
			#$fP = fSockOpen($url, 8080, $errno, $errstr, 10);
			$fP = fSockOpen($url, $port, $errno, $errstr, 10);
			if (!$fP) {
				return false;
			} else {
				return true;
			}
		}
		
		function get_signature($cons_id, $secretKey) {
			// Computes the timestamp
			date_default_timezone_set('UTC');
			#date_default_timezone_set('Asia/Jakarta');
			$tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
			$data = $cons_id . "&" . $tStamp;
			// Computes the signature by hashing the salt with the secret key as the key
			$signature = hash_hmac('sha256', $data, $secretKey, true);
			// base64 encode…
			$encodedSignature = base64_encode($signature);
			// urlencode…
			// $encodedSignature = urlencode($encodedSignature);
			return array(
				'tStamp'           => $tStamp,
				'encodedSignature' => $encodedSignature,
			);
		}
		
		public function simple_wsvclaim($service_url_parameter, $method, $myvars = '') {
			$debug = $this->config->item('apem_debug');
			$debug_level = $this->config->item('apem_debug_level');
			
			#$debug					= true;
			$app = $this->config->item('apem_app');
			$ConsumerID = $this->config->item('apem_ConsumerID');
			$ConsumerSecret = $this->config->item('apem_ConsumerSecret');
			$user_key = $this->config->item('user_key');
			
			$Headers = $this->get_signature($ConsumerID, $ConsumerSecret);
			$tStamp = $Headers['tStamp'];
			$encodedSignature = $Headers['encodedSignature'];
			#print_r($Headers);
			if (strtoupper($method) == 'GET')
				$ctype = "application/json; charset=utf-8";
			else
				$ctype = "application/x-www-form-urlencoded";
			
			$arr_header = array(
				'Content-Type:' . $ctype,
				'X-Cons-ID:' . $ConsumerID,
				'X-Timestamp:' . $tStamp,
				'X-Signature:' . $encodedSignature,
				'user_key:' . $user_key,
			);
			
			#$url_execute = $BaseURL.$ServiceName.$service_url_parameter;
			$url_execute = $service_url_parameter;
			$session = curl_init($url_execute);
			if ($debug && $debug_level >= 2) {
				$file_txt = $_SERVER["DOCUMENT_ROOT"] . "/" . $app . "/curl_log.txt";
				#$file_txt = $_SERVER['HTTP_REFERER'] . "/" . "curl_log.txt";
				
				$curl_log = fopen($file_txt, 'wr'); // open file for READ and write
				#echo FCPATH . "curl_log.txt" . "<br>";
				curl_setopt($session, CURLOPT_VERBOSE, true);
				curl_setopt($session, CURLOPT_STDERR, $curl_log);
			}
			
			curl_setopt($session, CURLOPT_CUSTOMREQUEST, strtoupper($method));
			curl_setopt($session, CURLOPT_URL, $url_execute);
			curl_setopt($session, CURLOPT_HTTPHEADER, $arr_header);
			curl_setopt($session, CURLOPT_VERBOSE, true);
			curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($session, CURLOPT_SSL_VERIFYHOST, false);
			
			if (strtoupper($method) != 'GET') {
				
				curl_setopt($session, CURLOPT_POST, true);
				curl_setopt($session, CURLOPT_POSTFIELDS, $myvars);
			}
			curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 2); 
			curl_setopt($session, CURLOPT_TIMEOUT, 2);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
			$result = curl_exec($session);
			$result = $this->decrypt_and_repack_response($result, $tStamp);
			
			if ($debug && $debug_level >= 2) {
				fclose($curl_log);
				$filename = $file_txt;
				$handle = fopen($filename, "r");
				$contents = fread($handle, filesize($filename));
				fclose($handle);
				echo "<br><hr><br>";
				echo nl2br($contents);
				
				echo "<br>Request : <br>";
				echo $url_execute . "<br>";
				if (strtoupper($method) == 'POST') {
					echo "<br>POSTED DATA : <br>";
					print_r(json_decode($myvars));
				}
				echo "<br>Response : <br>";
				print_r(json_decode($result));
				echo "<br>";
			}
			return json_decode($result);
		}
		
		function decrypt_and_repack_response($result, $tStamp) {
			$ConsumerID = $this->config->item('apem_ConsumerID');
			$ConsumerSecret = $this->config->item('apem_ConsumerSecret');
			$key = $ConsumerID . $ConsumerSecret . $tStamp;
			
			### Sarkodan : decrypt & decompress response ###############
			$result = json_decode($result);
			if (!isset($result->response)) return json_encode($result);
			$response_data = $result->response;
			
			$response = $this->stringDecrypt($response_data, $key);
			$response = $this->decompress($response);
			$result->response = json_decode($response);
			
			#echo "<br>Responsexxx : <br>";
			#echo $response;
			### --------------------------------------------------------
			
			#return $response;
			return json_encode($result);
		}
		
		public function generate_url_ws($url_katalog, $parameter_1 = '', $parameter_2 = '', $parameter_3 = '', $parameter_4 = '') {
			$BaseURL = $this->config->item('apem_BaseURL');
			$ServiceName = $this->config->item('apem_ServiceName');
			$url_service = str_replace("{Base URL}", $BaseURL,
																 str_replace("{BASE URL}", $BaseURL,
																						 str_replace("{Service Name}", $ServiceName,
																												 str_replace("{Parameter}", $parameter_1,
																																		 str_replace("{parameter}", $parameter_1,
																																								 str_replace("{parameter 1}", $parameter_1,
																																														 str_replace("{parameter 2}", $parameter_2,
																																																				 str_replace("{parameter 3}", $parameter_3,
																																																										 str_replace("{parameter 4}", $parameter_4,
																																																																 str_replace("{Parameter 1}", $parameter_1,
																																																																						 str_replace("{Parameter 2}", $parameter_2,
																																																																												 str_replace("{Parameter 3}", $parameter_3,
																																																																																		 str_replace("{Parameter 4}", $parameter_4,
			
																																																																																								 str_replace("{parameter1}", $parameter_1,
																																																																																														 str_replace("{parameter2}", $parameter_2,
																																																																																																				 str_replace("{parameter3}", $parameter_3,
																																																																																																										 $url_katalog))))))))))))))));
			return $url_service;
		}
		
		// function decrypt
		function stringDecrypt($string, $key = '') {
			### Sarkodan : setting up key ###############
			if ($key == '') {
				$ConsumerID = $this->config->item('apem_ConsumerID');
				$ConsumerSecret = $this->config->item('apem_ConsumerSecret');
				$user_key = $this->config->item('user_key');
				$tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
				
				$key = $ConsumerID . $ConsumerSecret . $tStamp;
				#$result = $this->stringDecrypt($dec_key, $result);
			}
			### ------------------------------------------------
			
			$encrypt_method = 'AES-256-CBC';
			// hash
			$key_hash = hex2bin(hash('sha256', $key));
			// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
			$iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
			return $output;
		}
		
		// function lzstring decompress
		// download libraries lzstring : https://github.com/nullpunkt/lz-string-php
		function decompress($string) {
			#include APPPATH . 'libraries/LZCompressor/LZContext.php';
			include_once APPPATH . 'libraries/LZCompressor/LZData.php';
			include_once APPPATH . 'libraries/LZCompressor/LZReverseDictionary.php';
			include_once APPPATH . 'libraries/LZCompressor/LZString.php';
			include_once APPPATH . 'libraries/LZCompressor/LZUtil.php';
			#include APPPATH . 'libraries/LZCompressor/LZUtil16.php';
			return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
		}
		
		# Fungsi : Insert LPK
		# Method : POST
		# Format : Json
		# Content-Type: Application/x-www-form-urlencoded
		public function lpk_insert($noSep, $tglMasuk, $tglKeluar, $jaminan, $poli,
															 $ruangRawat, $kelasRawat, $spesialistik, $caraKeluar, $kondisiPulang,
															 $kode_diag_0, $level_diag_0, $kode_diag_1, $level_diag_1, $kode_proc_0,
															 $kode_proc_1, $tindakLanjut, $kodePPK, $tglKontrol, $poli_kontrolKembali,
															 $DPJP, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/LPK/insert";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
					{
           "request": {
              "t_lpk": {
                 "noSep": "' . $noSep . '",
                 "tglMasuk": "' . $tglMasuk . '",
                 "tglKeluar": "' . $tglKeluar . '",
                 "jaminan": "' . $jaminan . '",
                 "poli": {
                    "poli": "' . $poli . '"
                 },
                 "perawatan": {
                    "ruangRawat": "' . $ruangRawat . '",
                    "kelasRawat": "' . $kelasRawat . '",
                    "spesialistik": "' . $spesialistik . '",
                    "caraKeluar": "' . $caraKeluar . '",
                    "kondisiPulang": "' . $kondisiPulang . '"
                 },
                 "diagnosa": [
                    {
                       "kode": "' . $kode_diag_0 . '",
                       "level": "' . $level_diag_0 . '"
                    },
                    {
                       "kode": "' . $kode_diag_1 . '",
                       "level": "' . $level_diag_1 . '"
                    }
                 ],
                 "procedure": [
                    {
                       "kode": "' . $kode_proc_0 . '"
                    },
                    {
                       "kode": "' . $kode_proc_1 . '"
                    }
                 ],
                 "rencanaTL": {
                    "tindakLanjut": "' . $tindakLanjut . '",
                    "dirujukKe": {
                       "kodePPK": "' . $kodePPK . '"
                    },
                    "kontrolKembali": {
                       "tglKontrol": "' . $tglKontrol . '",
                       "poli": "' . $poli_kontrolKembali . '"
                    }
                 },
                 "DPJP": "' . $DPJP . '",
                 "user": "' . $user . '"
              }
           }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		#Fungsi : Update LPK
		#Method : PUT
		#Format : Json
		#Content-Type: Application/x-www-form-urlencoded
		public function lpk_update($noSep, $tglMasuk, $tglKeluar, $jaminan, $poli,
															 $ruangRawat, $kelasRawat, $spesialistik, $caraKeluar, $kondisiPulang,
															 $kode_diag_0, $level_diag_0, $kode_diag_1, $level_diag_1, $kode_proc_0,
															 $kode_proc_1, $tindakLanjut, $kodePPK, $tglKontrol, $poli_kontrolKembali,
															 $DPJP, $user) {
			$method = 'PUT';
			$url_katalog = "{BASE URL}/{Service Name}/LPK/update";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
					{
           "request": {
              "t_lpk": {
                 "noSep": "' . $noSep . '",
                 "tglMasuk": "' . $tglMasuk . '",
                 "tglKeluar": "' . $tglKeluar . '",
                 "jaminan": "' . $jaminan . '",
                 "poli": {
                    "poli": "' . $poli . '"
                 },
                 "perawatan": {
                    "ruangRawat": "' . $ruangRawat . '",
                    "kelasRawat": "' . $kelasRawat . '",
                    "spesialistik": "' . $spesialistik . '",
                    "caraKeluar": "' . $caraKeluar . '",
                    "kondisiPulang": "' . $kondisiPulang . '"
                 },
                 "diagnosa": [
                    {
                       "kode": "' . $kode_diag_0 . '",
                       "level": "' . $level_diag_0 . '"
                    },
                    {
                       "kode": "' . $kode_diag_1 . '",
                       "level": "' . $level_diag_1 . '"
                    }
                 ],
                 "procedure": [
                    {
                       "kode": "' . $kode_proc_0 . '"
                    },
                    {
                       "kode": "' . $kode_proc_1 . '"
                    }
                 ],
                 "rencanaTL": {
                    "tindakLanjut": "' . $tindakLanjut . '",
                    "dirujukKe": {
                       "kodePPK": "' . $kodePPK . '"
                    },
                    "kontrolKembali": {
                       "tglKontrol": "' . $tglKontrol . '",
                       "poli": "' . $poli_kontrolKembali . '"
                    }
                 },
                 "DPJP": "' . $DPJP . '",
                 "user": "' . $user . '"
              }
           }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Delete LPK
		# Method : DELETE
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function lpk_delete($noSep) {
			$method = 'DELETE';
			$url_katalog = "{BASE URL}/{Service Name}/LPK/delete";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
					 {
           "request": {
              "t_lpk": {
                 "noSep": "' . $noSep . '"
              }
           }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Pencarian data peserta berdasarkan NIK Kependudukan (dokumentasi bpjs ngaco)
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Tanggal Masuk - format : yyyy-MM-dd
		# Parameter 2 : Jenis Pelayanan 1. Inap 2.Jalan
		public function lpk_data($parameter_1, $parameter_2) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/LPK/TglMasuk/{Parameter 1}/JnsPelayanan/{Parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $parameter_1, $parameter_2);
			return $response;
		}
		
		# Fungsi : Data Kunjungan
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Tanggal SEP format: yyyy-mm-dd
		# Parameter 2 : Jenis Pelayanan (1. Inap 2. Jalan)
		public function monitoring_data_kunjungan($parameter_1, $parameter_2) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/Monitoring/Kunjungan/Tanggal/{Parameter 1}/JnsPelayanan/{Parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2);
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Data Klaim
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Tanggal Pulang format: yyyy-mm-dd
		# Parameter 2 : Jenis Pelayanan (1. Inap 2. Jalan)
		# Parameter 3 : Status Klaim (1. Proses Verifikasi 2. Pending Verifikasi 3. Klaim)
		public function monitoring_data_klaim($parameter_1, $parameter_2, $parameter_3) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/Monitoring/Klaim/Tanggal/{Parameter 1}/JnsPelayanan/{Parameter 2}/Status/{Parameter 3}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2, $parameter_3);
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Histori Pelayanan Per Peserta
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : No.Kartu Peserta
		# Parameter 2 : Tgl Mulai Pencarian (yyyy-mmdd)
		# Parameter 3 : Tgl Akhir Pencarian (yyyy-mmdd)
		public function monitoring_data_histori_pelayanan_peserta($parameter_1, $parameter_2, $parameter_3) {
			$parameter_3 = ($parameter_3 != '') ? $parameter_3 : date('Y-m-d');
			$method = 'GET';
			#$url_katalog = "{Base URL}/{Service Name}/monitoring/HistoriPelayanan/NoKartu/{Parameter 1}/tglMulai/{Parameter 2}/tglAkhir/{Parameter 3}";	//tglMulai diganti jadi tglAwal (2019)
			#$url_katalog = "{Base URL}/{Service Name}/monitoring/HistoriPelayanan/NoKartu/{Parameter 1}/tglAwal/{Parameter 2}/tglAkhir/{Parameter 3}";		//tglAwal diganti jadi tglMulai (2021-10-01)
			$url_katalog = "{Base URL}/{Service Name}/monitoring/HistoriPelayanan/NoKartu/{Parameter 1}/tglMulai/{Parameter 2}/tglAkhir/{Parameter 3}";    //dan looping waktu terjadi disini
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2, $parameter_3);
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Monitoring Klaim Jasa Raharja
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Tgl Mulai Pencarian (yyyy-mmdd)
		# Parameter 2 : Tgl Akhir Pencarian (yyyy-mmdd)
		public function monitoring_data_klaim_jaminan_jasa_raharja($parameter_1, $parameter_2) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/monitoring/JasaRaharja/tglMulai/{Parameter 1}/tglAkhir/{Parameter 2}";    //dan looping waktu terjadi disini
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2);
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data peserta BPJS Kesehatan
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: Nomor Kartu
		# Parameter_2: Tanggal Pelayanan/SEP - format : yyyy-MM-dd
		public function peserta_cari($parameter_1, $parameter_2 = '') {
			$parameter_2 = ($parameter_2 != '') ? $parameter_2 : date('Y-m-d');
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Peserta/nokartu/{parameter 1}/tglSEP/{parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data peserta berdasarkan NIK Kependudukan
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: NIK KTP
		# Parameter_2: Tanggal Pelayanan/SEP - format : yyyy-MM-dd
		public function peserta_cari_by_nik_ktp($parameter_1, $parameter_2 = '') {
			$parameter_2 = ($parameter_2 != '') ? $parameter_2 : date('Y-m-d');
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Peserta/nik/{parameter 1}/tglSEP/{parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Insert Rujuk balik
		# Method : POST
		# Format : Json
		# Content-Type: Application/x-www-form-urlencoded
		public function prb_insert($noSep, $noKartu, $alamat, $email, $programPRB, $kodeDPJP, $keterangan, $saran, $user, $obat) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/PRB/insert";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			### --- start : obat. preparing items obat ---
			$items_obat = '[';
			if (isset($obat) && is_array($obat)) {
				foreach ($obat as $k => $v) {
					$koma = ($k > 0) ? ',' : '';
					$items_obat .= $koma . '
												{
                            "kdObat":"' . $v['kdObat'] . '",
                            "signa1":"' . $v['signa1'] . '",
                            "signa2":"' . $v['signa2'] . '",
                            "jmlObat":"' . $v['jmlObat'] . '"
                        }
												';
				}
			}
			$items_obat .= ']';
			### --- end of obat --------------------------
			
			$myitem = '
					{
              "request":
               {
              "t_prb":
                {
                  "noSep":"' . $noSep . '",
                  "noKartu":"' . $noKartu . '",
                  "alamat":"' . $alamat . '",
                  "email":"' . $email . '",
                  "programPRB":"' . $programPRB . '",
                  "kodeDPJP":"' . $kodeDPJP . '",
                  "keterangan":"' . $keterangan . '",
                  "saran":"' . $saran . '",
                  "user":"' . $user . '",
                  "obat":
                    ' . $items_obat . '
                }
               }
            }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Update PRB
		# Method : PUT
		# Format : Json
		# Content-Type: Application/x-www-form-urlencoded
		public function prb_update($noSrb, $noSep, $alamat, $email, $kodeDPJP, $keterangan, $saran, $user, $obat) {
			$method = 'PUT';
			$url_katalog = "{BASE URL}/{Service Name}/PRB/Update";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			### --- start : obat. preparing items obat ---
			$items_obat = '[';
			if (isset($obat) && is_array($obat)) {
				foreach ($obat as $k => $v) {
					$koma = ($k > 0) ? ',' : '';
					$items_obat .= $koma . '
												{
                            "kdObat":"' . $v['kdObat'] . '",
                            "signa1":"' . $v['signa1'] . '",
                            "signa2":"' . $v['signa2'] . '",
                            "jmlObat":"' . $v['jmlObat'] . '"
                        }
												';
				}
			}
			$items_obat .= ']';
			### --- end of obat --------------------------
			
			$myitem = '
					{
           "request":{
              "t_prb":{
                 "noSrb":"' . $noSrb . '",
                 "noSep":"' . $noSep . '",
                 "alamat":"' . $alamat . '",
                 "email":"' . $email . '",
                 "kodeDPJP":"' . $kodeDPJP . '",
                 "keterangan":"' . $keterangan . '",
                 "saran":"' . $saran . '",
                 "user":"' . $user . '",
                 "obat":
								 		' . $items_obat . '
                 ]
              }
           }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Hapus Data PRB
		# Method : DELETE
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function prb_delete($noSrb, $noSep, $user) {
			$method = 'DELETE';
			$url_katalog = "{BASE URL}/{Service Name}/PRB/Delete";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
					 {
          "request":
           {
          "t_prb":
            {
              "noSrb":"' . $noSrb . '",
              "noSep":"' . $noSep . '",
              "user": "' . $user . '"
             }
           }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Pencarian data PRB (Rujuk Balik) Berdasarkan Nomor SRB
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : No. SRB Peserta
		# Parameter 2 : No. SEP
		public function prb_cari_single($parameter_1, $parameter_2) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/prb/{Parameter 1}/nosep/{Parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $parameter_1, $parameter_2);
			return $response;
		}
		
		# Fungsi : Pencarian data PRB (Rujuk Balik) Berdasarkan Tanggal SRB
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Tgl. Mulai (yyyy-mm-dd)
		# Parameter 2 : Tgl. Akhir (yyyy-mm-dd)
		public function prb_cari_multi_by_periode($parameter_1, $parameter_2) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/prb/tglMulai/{Parameter 1}/tglAkhir/{Parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $parameter_1, $parameter_2);
			return $response;
		}
		
		# Fungsi : Pencarian data diagnosa (ICD-10)
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter: Kode atau Nama Diagnosa
		public function referensi_diagnosa($parameter_1) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/diagnosa/{parameter}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data poli
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter: Kode atau Nama Poli
		public function referensi_poli($parameter_1) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/poli/{Parameter}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data fasilitas kesehatan
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: nama atau kode faskes
		# Parameter_2: Jenis Faskes (1. Faskes 1, 2. Faskes 2/RS)
		public function referensi_faskes($parameter_1, $parameter_2) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/faskes/{Parameter 1}/{Parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data dokter DPJP
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: nama atau kode faskes
		# Parameter_2: Tgl.Pelayanan/SEP (yyyy-mm-dd)
		# Parameter_3: Kode Spesialis/Subspesialis
		public function referensi_dokter_dpjp($parameter_1, $parameter_2, $parameter_3) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/dokter/pelayanan/{Parameter 1}/tglPelayanan/{Parameter 2}/Spesialis/{Parameter 3}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2, $parameter_3);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data propinsi
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function referensi_propinsi() {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/propinsi";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data kota/kabupaten
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Kode Propinsi
		public function referensi_kota_kabupaten($parameter_1) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/kabupaten/propinsi/{parameter 1}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data kecamatan
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Kode Kabupaten
		public function referensi_kecamatan($parameter_1) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/kecamatan/kabupaten/{parameter 1}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data diagnosa program PRB
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function referensi_diagnosa_prb() {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/diagnosaprb";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data obat generik PRB
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : nama obat generik
		public function referensi_obat_generik_program_prb($parameter_1) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/obatprb/{Parameter 1}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data procedure/tindakan
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : nama atau kode procedure
		public function referensi_lpk_procedure_tindakan($parameter_1) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/procedure/{Parameter}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data kelas rawat
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function referensi_lpk_kelas_rawat() {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/kelasrawat";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data dokter DPJP
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : nama dokter/DPJP
		public function referensi_lpk_dokter($parameter_1) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/dokter/{Parameter}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data spesialistik
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function referensi_lpk_spesialistik() {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/spesialistik";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data ruang rawat
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function referensi_lpk_ruang_rawat() {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/ruangrawat";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data cara keluar
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function referensi_lpk_cara_keluar() {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/carakeluar";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data pasca pulang
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function referensi_lpk_pasca_pulang() {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/referensi/pascapulang";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Insert Rencana Kontrol
		# Method : POST
		# Format : Json
		# Content-Type: Application/x-www-form-urlencoded
		public function rencana_kontrol_insert($noSEP, $kodeDokter, $poliKontrol, $tglRencanaKontrol, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/insert";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
					{
            "request": {
                "noSEP":"' . $noSEP . '",
                "kodeDokter":"' . $kodeDokter . '",
                "poliKontrol":"' . $poliKontrol . '",
                "tglRencanaKontrol":"' . $tglRencanaKontrol . '",
                "user":"' . $user . '"
            }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Update Rencana Kontrol
		# Method : PUT
		# Format : Json
		# Content-Type: Application/x-www-form-urlencoded
		public function rencana_kontrol_update($noSuratKontrol, $noSEP, $kodeDokter, $poliKontrol, $tglRencanaKontrol, $user) {
			$method = 'PUT';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/Update";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
					{
            "request": {
								"noSuratKontrol":"' . $noSuratKontrol . '",
                "noSEP":"' . $noSEP . '",
                "kodeDokter":"' . $kodeDokter . '",
                "poliKontrol":"' . $poliKontrol . '",
                "tglRencanaKontrol":"' . $tglRencanaKontrol . '",
                "user":"' . $user . '"
            }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Hapus Data REncana Kontrol
		# Method : DELETE
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function rencana_kontrol_delete($noSuratKontrol, $user) {
			$method = 'DELETE';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/Delete";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
					 {
            "request": {
                "t_suratkontrol":{
                "noSuratKontrol":"' . $noSuratKontrol . '",
                "user":"' . $user . '"
                }
            }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Insert SPRI
		# Method : POST
		# Format : Json
		# Content-Type: Application/x-www-form-urlencoded
		public function rencana_kontrol_spri_insert($noKartu, $kodeDokter, $poliKontrol, $tglRencanaKontrol, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/InsertSPRI";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
					{
            "request":
                {
                    "noKartu":"' . $noKartu . '",
                    "kodeDokter":"' . $kodeDokter . '",
                    "poliKontrol":"' . $poliKontrol . '",
                    "tglRencanaKontrol":"' . $tglRencanaKontrol . '",
                    "user":"' . $user . '"
                }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Update SPRI
		# Method : POST
		# Format : Json
		# Content-Type: Application/x-www-form-urlencoded
		public function rencana_kontrol_spri_update($noSPRI, $kodeDokter, $poliKontrol, $tglRencanaKontrol, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/UpdateSPRI";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
					{
            "request":
                {
										"noSPRI":"' . $noSPRI . '",
                    "kodeDokter":"' . $kodeDokter . '",
                    "poliKontrol":"' . $poliKontrol . '",
                    "tglRencanaKontrol":"' . $tglRencanaKontrol . '",
                    "user":"' . $user . '"
                }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Melihat data SEP untuk keperluan rencana kontrol
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: Nomor SEP Peserta
		public function rencana_kontrol_cari_sep($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/nosep/{parameter}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Melihat data SEP untuk keperluan rencana kontrol
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: Nomor Surat Kontrol Peserta
		public function rencana_kontrol_cari_nomor_surat_kontrol($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/noSuratKontrol/{parameter}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Data Rencana Kontrol
		# Method : GET
		# Format : Json
		# Content-Type: Application/x-www-form-urlencoded
		# Parameter 1: Tanggal awal format : yyyy-MM-dd
		# Parameter 2: Tanggal akhir format : yyyy-MM-dd
		# Parameter 3: Format filter --> 1: tanggal entri, 2: tanggal rencana kontrol
		public function rencana_kontrol_data_list($parameter_1, $parameter_2, $parameter_3) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/ListRencanaKontrol/tglAwal/{parameter 1}/tglAkhir/{parameter 2}/filter/{parameter 3}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2, $parameter_3);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Data Rencana Kontrol (per poli/spesialistik)
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1: Jenis kontrol --> 1: SPRI, 2: Rencana Kontrol
		# Parameter 2: Nomor --> jika jenis kontrol = 1, maka diisi nomor kartu; jika jenis kontrol = 2, maka diisi nomor SEP
		# Parameter 3: Tanggal rencana kontrol --> format yyyy-MM-dd
		public function rencana_kontrol_data_poli_spesialistik($parameter_1, $parameter_2, $parameter_3) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/ListSpesialistik/JnsKontrol/{parameter 1}/nomor/{parameter 2}/TglRencanaKontrol/{parameter 3}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2, $parameter_3);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Data Rencana Kontrol (Data Dokter)
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1: Jenis kontrol --> 1: SPRI, 2: Rencana Kontrol
		# Parameter 2: Kode poli
		# Parameter 3: Tanggal rencana kontrol --> format yyyy-MM-dd
		public function rencana_kontrol_data_dokter($parameter_1, $parameter_2, $parameter_3) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/RencanaKontrol/JadwalPraktekDokter/JnsKontrol/{parameter 1}/KdPoli/{parameter 2}/TglRencanaKontrol/{parameter 3}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2, $parameter_3);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		public function rujukan_search($parameter_1, $from = 'auto') ## $from = pcare / rs
		{
			$from = strtolower($from);
			
			if ($from == 'pcare')
				$response = $this->rujukan_search_pcare($parameter_1);
			elseif ($from == 'rs')
				$response = $this->rujukan_search_rs($parameter_1);
			else # auto #
			{
				$response = $this->rujukan_search_pcare($parameter_1);
				#if($response->response->rujukan->noKunjungan!='')
				if (isset($response->response->rujukan->noKunjungan))
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
		public function rujukan_search_pcare($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/{parameter}";
			
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, 'GET');
			return $response;
		}
		
		# Fungsi : Pencarian data rujukan dari Rumah Sakit berdasarkan nomor rujukan
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter : Nomor Rujukan
		# {BASE URL}/{Service Name}/Rujukan/RS/{parameter}
		public function rujukan_search_rs($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/RS/{parameter}";
			
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, 'GET');
			return $response;
		}
		
		# Fungsi : Pencarian data rujukan dari PCare berdasarkan nomor kartu
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter : Nomor kartu
		public function rujukan_search_pcare_single_by_noka($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/Peserta/{parameter}";
			
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data rujukan dari rumah sakit berdasarkan nomor kartu
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter : Nomor kartu
		public function rujukan_search_rs_single_by_noka($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/RS/Peserta/{parameter}";
			
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data rujukan dari PCare berdasarkan nomor kartu
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter : Nomor kartu
		public function rujukan_search_pcare_multi_by_noka($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/List/Peserta/{parameter}";
			
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data rujukan dari rumah sakit berdasarkan nomor kartu
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter : Nomor kartu
		public function rujukan_search_rs_multi_by_noka($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/RS/list/Peserta/{parameter}";
			
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Insert Rujukan
		# Method : POST
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function rujukan_insert($noSep, $tglRujukan, $ppkDirujuk, $jnsPelayanan, $catatan, $diagRujukan, $tipeRujukan, $poliRujukan, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/insert";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
		{
       "request": {
          "t_rujukan": {
             "noSep": "' . $noSep . '",
             "tglRujukan": "' . $tglRujukan . '",
             "ppkDirujuk": "' . $ppkDirujuk . '",
             "jnsPelayanan": "' . $jnsPelayanan . '",
             "catatan": "' . $catatan . '",
             "diagRujukan": "' . $diagRujukan . '",
             "tipeRujukan": "' . $tipeRujukan . '",
             "poliRujukan": "' . $poliRujukan . '",
             "user": "' . $user . '"
          }
       }
    }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Update Rujukan
		# Method : PUT
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function rujukan_update($noRujukan, $ppkDirujuk, $tipe, $jnsPelayanan, $catatan, $diagRujukan, $tipeRujukan, $poliRujukan, $user) {
			$method = 'PUT';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/update";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
		{
       "request": {
          "t_rujukan": {
             "noRujukan": "' . $noRujukan . '",
             "ppkDirujuk": "' . $ppkDirujuk . '",
             "tipe": "' . $tipe . '",
             "jnsPelayanan": "' . $jnsPelayanan . '",
             "catatan": "' . $catatan . '",
             "diagRujukan": "' . $diagRujukan . '",
             "tipeRujukan": "' . $tipeRujukan . '",
             "poliRujukan": "' . $poliRujukan . '",
             "user": "' . $user . '"
          }
       }
    }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Delete Rujukan
		# Method : DELETE
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function rujukan_hapus($noRujukan, $user) {
			$method = 'DELETE';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/delete";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
		{
        "request": {
            "t_rujukan": {
                "noRujukan": "' . $noRujukan . '",
                "user": "' . $user . '"
            }
        }
    }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Insert Rujukan Khusus
		# Method : POST
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function rujukan_insert_rujukan_khusus($noRujukan, $diag, $kode_procedure, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/Khusus/insert";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			### --- start : diag. preparing items diag ---
			$items_diag = '[';
			if (isset($diag) && is_array($diag)) {
				foreach ($diag as $k => $v) {
					$koma = ($k > 0) ? ',' : '';
					$kode_prim_sek = ($k > 0) ? 'S' : 'P';
					$items_diag .= $koma . '
												{"kode": "' . $kode_prim_sek . ';' . $v['kode_diagnosa'] . '"}
												';
				}
			}
			$items_diag .= ']';
			### --- end of diag --------------------------
			
			$myitem = '
		{
         "noRujukan": "' . $noRujukan . '",
         "diagnosa": [
                 ' . $items_diag . '
         ],
        "procedure":  [
                 {"kode": "' . $kode_procedure . '"}
         ],
         "user": "' . $user . '"
    }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Delete Rujukan Khusus
		# Method : DELETE
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function rujukan_hapus_rujukan_khusus($idRujukan, $noRujukan, $user) {
			$method = 'DELETE';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/Khusus/delete";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
		{
       "request": {
                "t_rujukan": {
                          "idRujukan": "' . $idRujukan . '",
                          "noRujukan": "' . $noRujukan . '",
                          "user": "' . $user . '"
                  }
        }
    }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Data Khusus
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Bulan (1,2,3,4,5,6,7,8,9,10,11,12)
		# Parameter 2 : Tahun (4 digit)
		public function rujukan_list_rujukan_khusus($parameter_1, $parameter_2) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/Khusus/List/Bulan/{parameter 1}/Tahun/{parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $parameter_1, $parameter_2);
			return $response;
		}
		
		# Fungsi : Insert Rujukan 2.0
		# Method : POST
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function rujukan_2_0_insert($noSep, $tglRujukan, $tglRencanaKunjungan, $ppkDirujuk, $jnsPelayanan, $catatan, $diagRujukan, $tipeRujukan, $poliRujukan, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/2.0/insert";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
		{
         "request": {
                        "t_rujukan": {
                                 "noSep": "' . $noSep . '",
                                 "tglRujukan": "' . $tglRujukan . '",
                                 "tglRencanaKunjungan": "' . $tglRencanaKunjungan . '",
                                 "ppkDirujuk": "' . $ppkDirujuk . '",
                                 "jnsPelayanan": "' . $jnsPelayanan . '",
                                 "catatan": "' . $catatan . '",
                                 "diagRujukan": "' . $diagRujukan . '",
                                 "tipeRujukan": "' . $tipeRujukan . '",
                                 "poliRujukan": "' . $poliRujukan . '",
                                 "user": "' . $user . '"
                        }
         }
    }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Update Rujukan 2.0
		# Method : POST
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function rujukan_2_0_update($noRujukan, $tglRujukan, $tglRencanaKunjungan, $ppkDirujuk, $jnsPelayanan, $catatan, $diagRujukan, $tipeRujukan, $poliRujukan, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/2.0/Update";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$myitem = '
		{
         "request": {
                        "t_rujukan": {
                                 "noRujukan": "' . $noRujukan . '",
                                 "tglRujukan": "' . $tglRujukan . '",
                                 "tglRencanaKunjungan": "' . $tglRencanaKunjungan . '",
                                 "ppkDirujuk": "' . $ppkDirujuk . '",
                                 "jnsPelayanan": "' . $jnsPelayanan . '",
                                 "catatan": "' . $catatan . '",
                                 "diagRujukan": "' . $diagRujukan . '",
                                 "tipeRujukan": "' . $tipeRujukan . '",
                                 "poliRujukan": "' . $poliRujukan . '",
                                 "user": "' . $user . '"
                        }
         }
    }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Data Spesialistik
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Kode PPK Rujukan : 8 digit
		# Parameter 2 : Tanggal rujukan format : yyyy-MM-dd
		public function rujukan_list_spesialistik_rujukan($parameter_1, $parameter_2) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/ListSpesialistik/PPKRujukan/{parameter 1}/TglRujukan/{parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $parameter_1, $parameter_2);
			return $response;
		}
		
		# Fungsi : Data Sarana
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter 1 : Kode PPK Rujukan : 8 digit
		public function rujukan_list_sarana($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/Rujukan/ListSarana/PPKRujukan/{parameter 1}";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $parameter_1);
			return $response;
		}
		
		# Fungsi : Insert SEP versi 1.1
		# Method : POST
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_insert($noKartu, $tglSep, $ppkPelayanan, $jnsPelayanan,
															 $klsRawat, $noMR, $asalRujukan, $tglRujukan,
															 $noRujukan, $ppkRujukan, $catatan, $diagAwal,
															 $tujuan, $eksekutif, $cob, $katarak,
															 $lakaLantas, $penjamin, $tgl_kejadian, $ket_kll,
															 $suplesi, $no_sep_suplesi, $kd_propinsi, $kd_kabupaten,
															 $kd_kecamatan, $no_skdp, $kd_dpjp, $noTelp, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/1.1/insert";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
					{
						 "request": {
								"t_sep": {
									 "noKartu": "' . $noKartu . '",
									 "tglSep": "' . $tglSep . '",
									 "ppkPelayanan": "' . $ppkPelayanan . '",
									 "jnsPelayanan": "' . $jnsPelayanan . '",
									 "klsRawat": "' . $klsRawat . '",
									 "noMR": "' . $noMR . '",
									 "rujukan": {
											"asalRujukan": "' . $asalRujukan . '",
											"tglRujukan": "' . $tglRujukan . '",
											"noRujukan": "' . $noRujukan . '",
											"ppkRujukan": "' . $ppkRujukan . '"
									 },
									 "catatan": "' . $catatan . '",
									 "diagAwal": "' . $diagAwal . '",
									 "poli": {
											"tujuan": "' . $tujuan . '",
											"eksekutif": "' . $eksekutif . '"
									 },
									 "cob": {
											"cob": "' . $cob . '"
									 },
									 "katarak": {
											"katarak": "' . $katarak . '"
									 },
									 "jaminan": {
											"lakaLantas": "' . $lakaLantas . '",
											"penjamin": {
													"penjamin": "' . $penjamin . '",
													"tglKejadian": "' . $tgl_kejadian . '",
													"keterangan": "' . $ket_kll . '",
													"suplesi": {
															"suplesi": "' . $suplesi . '",
															"noSepSuplesi": "' . $no_sep_suplesi . '",
															"lokasiLaka": {
																 "kdPropinsi": "' . $kd_propinsi . '",
																	"kdKabupaten": "' . $kd_kabupaten . '",
																	"kdKecamatan": "' . $kd_kecamatan . '"
																	}
													}
											}
									 },
									 "skdp": {
											"noSurat": "' . $no_skdp . '",
											"kodeDPJP": "' . $kd_dpjp . '"
									 },
									 "noTelp": "' . $noTelp . '",
									 "user": "' . $user . '"
								}
						 }
					}
		';
			#die($myitem);
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
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			
			return $response;
			
		}
		
		# Fungsi : Update SEP versi 1.1
		# Method : PUT
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_update($noSep, $noKartu, $tglSep, $ppkPelayanan, $jnsPelayanan,
															 $klsRawat, $noMR, $asalRujukan, $tglRujukan,
															 $noRujukan, $ppkRujukan, $catatan, $diagAwal,
															 $tujuan, $eksekutif, $cob, $katarak,
															 $lakaLantas, $penjamin, $tgl_kejadian, $ket_kll,
															 $suplesi, $no_sep_suplesi, $kd_propinsi, $kd_kabupaten,
															 $kd_kecamatan, $no_skdp, $kd_dpjp, $noTelp, $user) {
			$method = 'PUT';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/1.1/Update";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
					{
           "request": {
              "t_sep": {
                 "noSep": "' . $noSep . '",
                 "klsRawat": "' . $klsRawat . '",
                 "noMR": "' . $noMR . '",
                 "rujukan": {
                    "asalRujukan": "' . $asalRujukan . '",
										"tglRujukan": "' . $tglRujukan . '",
										"noRujukan": "' . $noRujukan . '",
										"ppkRujukan": "' . $ppkRujukan . '"
                 },
                 "catatan": "' . $catatan . '",
                 "diagAwal": "' . $diagAwal . '",
                 "poli": {
                    "eksekutif": "' . $eksekutif . '"
                 },
                 "cob": {
                    "cob": "' . $cob . '"
                 },
                 "katarak":{
                    "katarak":"' . $katarak . '"
                 },
                 "skdp":{
                    "noSurat":"' . $no_skdp . '",
                    "kodeDPJP":"' . $kd_dpjp . '"
                 },
                 "jaminan": {
                    "lakaLantas":"' . $lakaLantas . '",
                    "penjamin":
                    {
                        "penjamin":"' . $penjamin . '",
                        "tglKejadian":"' . $tgl_kejadian . '",
                        "keterangan":"' . $ket_kll . '",
                        "suplesi":
                            {
                                "suplesi":"' . $suplesi . '",
                                "noSepSuplesi":"' . $no_sep_suplesi . '",
                                "lokasiLaka":
                                    {
                                    "kdPropinsi":"' . $kd_propinsi . '",
                                    "kdKabupaten":"' . $kd_kabupaten . '",
                                    "kdKecamatan":"' . $kd_kecamatan . '"
                                    }
                            }
                    }
                 },
                 "noTelp": "' . $noTelp . '",
                 "user": "' . $user . '"
              }
           }
        }
		';
			#die($myitem);
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Hapus Data SEP
		# Method : DELETE
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_hapus($noSep, $user) {
			$method = 'DELETE';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/Delete";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
					 {
						 "request": {
								"t_sep": {
									 "noSep": "' . $noSep . '",
									 "user": "' . $user . '"
								}
						 }
					}
		';
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
			
		}
		
		# Fungsi : Melihat data detail SEP Peserta
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter: Nomor SEP Peserta
		public function sep_cari($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/{parameter}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Insert SEP versi 2.0
		# Method : POST
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_2_0_insert($noKartu, $tglSep, $ppkPelayanan, $jnsPelayanan, $klsRawatHak,
																	 $klsRawatNaik, $pembiayaan, $penanggungJawab, $noMR, $asalRujukan,
																	 $tglRujukan, $noRujukan, $ppkRujukan, $catatan, $diagAwal,
																	 $tujuan, $eksekutif, $cob, $katarak, $lakaLantas,
																	 $tglKejadian, $keterangan, $suplesi, $noSepSuplesi, $kdPropinsi,
																	 $kdKabupaten, $kdKecamatan, $tujuanKunj, $flagProcedure, $kdPenunjang,
																	 $assesmentPel, $noSurat, $kodeDPJP, $dpjpLayan, $noTelp,
																	 $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/2.0/insert";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
				{
           "request":{
              "t_sep":{
                 "noKartu":"' . $noKartu . '",
                 "tglSep":"' . $tglSep . '",
                 "ppkPelayanan":"' . $ppkPelayanan . '",
                 "jnsPelayanan":"' . $jnsPelayanan . '",
                 "klsRawat":{
                    "klsRawatHak":"' . $klsRawatHak . '",
                    "klsRawatNaik":"' . $klsRawatNaik . '",
                    "pembiayaan":"' . $pembiayaan . '",
                    "penanggungJawab":"' . $penanggungJawab . '"
                 },
                 "noMR":"' . $noMR . '",
                 "rujukan":{
                    "asalRujukan":"' . $asalRujukan . '",
                    "tglRujukan":"' . $tglRujukan . '",
                    "noRujukan":"' . $noRujukan . '",
                    "ppkRujukan":"' . $ppkRujukan . '"
                 },
                 "catatan":"' . $catatan . '",
                 "diagAwal":"' . $diagAwal . '",
                 "poli":{
                    "tujuan":"' . $tujuan . '",
                    "eksekutif":"' . $eksekutif . '"
                 },
                 "cob":{
                    "cob":"' . $cob . '"
                 },
                 "katarak":{
                    "katarak":"' . $katarak . '"
                 },
                 "jaminan":{
                    "lakaLantas":"' . $lakaLantas . '",
                    "penjamin":{
                       "tglKejadian":"' . $tglKejadian . '",
                       "keterangan":"' . $keterangan . '",
                       "suplesi":{
                          "suplesi":"' . $suplesi . '",
                          "noSepSuplesi":"' . $noSepSuplesi . '",
                          "lokasiLaka":{
                             "kdPropinsi":"' . $kdPropinsi . '",
                             "kdKabupaten":"' . $kdKabupaten . '",
                             "kdKecamatan":"' . $kdKecamatan . '"
                          }
                       }
                    }
                 },
                 "tujuanKunj":"' . $tujuanKunj . '",
                 "flagProcedure":"' . $flagProcedure . '",
                 "kdPenunjang":"' . $kdPenunjang . '",
                 "assesmentPel":"' . $assesmentPel . '",
                 "skdp":{
                    "noSurat":"' . $noSurat . '",
                    "kodeDPJP":"' . $kodeDPJP . '"
                 },
                 "dpjpLayan":"' . $dpjpLayan . '",
                 "noTelp":"' . $noTelp . '",
                 "user":"' . $user . '"
              }
           }
        }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Update SEP versi 2.0
		# Method : PUT
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_2_0_update($noSep, $klsRawatHak, $klsRawatNaik, $pembiayaan, $penanggungJawab,
																	 $noMR, $catatan, $diagAwal, $tujuan, $eksekutif,
																	 $cob, $katarak, $lakaLantas, $tglKejadian, $keterangan,
																	 $suplesi, $noSepSuplesi, $kdPropinsi, $kdKabupaten, $kdKecamatan,
																	 $dpjpLayan, $noTelp, $user) {
			$method = 'PUT';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/2.0/update";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
		{
     "request": {
        "t_sep": {
                "noSep":"' . $noSep . '",
                "klsRawat":{
                                "klsRawatHak":"' . $klsRawatHak . '",
                                "klsRawatNaik":"' . $klsRawatNaik . '",
                                "pembiayaan":"' . $pembiayaan . '",
                                "penanggungJawab":"' . $penanggungJawab . '"
                              },
                "noMR":"' . $noMR . '",
                "catatan":"' . $catatan . '",
                "diagAwal":"' . $diagAwal . '",
                "poli": {
                        "tujuan":"' . $tujuan . '",
                        "eksekutif":"' . $eksekutif . '"
                },
                "cob": {
                        "cob":"' . $cob . '"
                },
                "katarak": {
                        "katarak":"' . $katarak . '"
                },
                "jaminan": {
                        "lakaLantas":"' . $lakaLantas . '",
                        "penjamin": {
                                "tglKejadian":"' . $tglKejadian . '",
                                "keterangan":"' . $keterangan . '",
                                "suplesi": {
                                        "suplesi":"' . $suplesi . '",
                                        "noSepSuplesi":"' . $noSepSuplesi . '",
                                        "lokasiLaka": {
                                                "kdPropinsi":"' . $kdPropinsi . '",
                                                "kdKabupaten":"' . $kdKabupaten . '",
                                                "kdKecamatan":"' . $kdKecamatan . '"
                                        }
                                }
                        }
                },
                "dpjpLayan":"' . $dpjpLayan . '",
                "noTelp":"' . $noTelp . '",
                "user":"' . $user . '"
        }
      }
    }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Hapus SEP versi 2.0
		# Method : DELETE
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_2_0_hapus($noSep, $user) {
			$method = 'DELETE';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/Delete";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
		{
       "request": {
          "t_sep": {
             "noSep": "' . $noSep . '",
             "user": "' . $user . '"
          }
       }
    }
		';
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Pencarian data potensi SEP Sebagai Suplesi Jasa Raharja
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: No.Kartu Peserta
		# Parameter_2: Tgl.Pelayanan/SEP (yyyy-mm-dd)
		public function sep_suplesi_jasa_raharja($parameter_1, $parameter_2 = '') {
			$parameter_2 = ($parameter_2 != '') ? $parameter_2 : date('Y-m-d');
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/sep/JasaRaharja/Suplesi/{Parameter 1}/tglPelayanan/{Parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pencarian data SEP Induk Kecelakaan Lalu Lintas
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: No.Kartu Peserta
		public function sep_data_induk_kecelakaan($parameter_1) {
			$method = 'GET';
			$url_katalog = "{Base URL}/{Service Name}/sep/KllInduk/List/{Parameter 1}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Pengajuan SEP
		# Method : POST
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_pengajuan($noKartu, $tglSep, $jnsPelayanan, $jnsPengajuan, $keterangan, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/Sep/pengajuanSEP";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
					{
           "request": {
              "t_sep": {
                 "noKartu": "' . $noKartu . '",
                 "tglSep": "' . $tglSep . '",
                 "jnsPelayanan": "' . $jnsPelayanan . '",
                 "jnsPengajuan": "' . $jnsPengajuan . '",
                 "keterangan": "' . $keterangan . '",
                 "user": "' . $user . '"
              }
           }
        }
		';
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Pengajuan SEP (Approval)
		# Method : POST
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_approval_pengajuan($noKartu, $tglSep, $jnsPelayanan, $jnsPengajuan, $keterangan, $user) {
			$method = 'POST';
			$url_katalog = "{BASE URL}/{Service Name}/Sep/aprovalSEP";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
					{
           "request": {
              "t_sep": {
                 "noKartu": "' . $noKartu . '",
                 "tglSep": "' . $tglSep . '",
                 "jnsPelayanan": "' . $jnsPelayanan . '",
                 "jnsPengajuan": "' . $jnsPengajuan . '",
                 "keterangan": "' . $keterangan . '",
                 "user": "' . $user . '"
              }
           }
        }
		';
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Update tanggal pulang SEP
		# Method : PUT
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_update_tanggal_pulang($noSep, $tglPlg, $ppkPelayanan) {
			$method = 'PUT';
			$url_katalog = "{BASE URL}/{Service Name}/Sep/updtglplg";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
						{
                "request":
                    {
                    "t_sep":
                        {
                            noSep":"' . $noSep . '",
                            "tglPlg":"' . $tglPlg . '",
                            "ppkPelayanan":"' . $ppkPelayanan . '"
                        }
                    }
            }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Update tanggal pulang SEP 2.0
		# Method : PUT
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_2_0_update_tanggal_pulang($noSep, $tglPlg, $ppkPelayanan) {
			$method = 'PUT';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/2.0/updtglplg";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
						{
                "request":
                    {
                    "t_sep":
                        {
                            noSep":"' . $noSep . '",
                            "tglPlg":"' . $tglPlg . '",
                            "ppkPelayanan":"' . $ppkPelayanan . '"
                        }
                    }
            }
		';
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Pencarian No.SEP untuk Aplikasi Inacbg 4.1
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: Nomor SEP
		public function sep_integrasi_dengan_inacbg($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/sep/cbg/{parameter}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Data SEP Internal
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: Nomor SEP : 19 digit
		public function sep_data_sep_internal($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/Internal/{parameter 1}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : Hapus SEP Internal
		# Method : DELETE
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		public function sep_hapus_sep_internal($noSep, $noSurat, $tglRujukanInternal, $kdPoliTuj, $user) {
			$method = 'DELETE';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/Internal/delete";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$myitem = '
			{
           "request": {
              "t_sep": {
                 "noSep": "' . $noSep . '",
                 "noSurat": "' . $noSurat . '",
                 "tglRujukanInternal": "' . $tglRujukanInternal . '",
                 "kdPoliTuj": "' . $kdPoliTuj . '",
                 "user": "' . $user . '"
              }
           }
        }
		';
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method, $myitem);
			return $response;
		}
		
		# Fungsi : Pencarian data fingerprint
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: Nomor Kartu Peserta
		# Parameter_2: Tanggal Pelayanan
		public function sep_finger_print($parameter_1, $parameter_2) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/FingerPrint/Peserta/{parameter1}/TglPelayanan/{parameter2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : List Finger Print
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: Tanggal Pelayanan
		public function sep_get_list_finger_print($parameter_1) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/FingerPrint/List/Peserta/TglPelayanan/{parameter 1}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		# Fungsi : List Finger Print
		# Method : GET
		# Format : Json
		# Content-Type: application/json; charset=utf-8
		# Parameter_1: Tanggal Pelayanan
		public function sep_get_list_finger_print_xxxxxxxxxxxxxxxxxxxxxxxxx($parameter_1, $paramexmex) {
			$method = 'GET';
			$url_katalog = "{BASE URL}/{Service Name}/SEP/FingerPrint/List/Peserta/TglPelayanan/{parameter 1}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		
		//Mulai sini Service Antrian BPJS by Tri Waskito
		//RS Posting Data Ke BPJS

		public function simple_antrol($service_url_parameter, $method, $myvars = '') {
			$debug = $this->config->item('apem_debug');
			$debug_level = $this->config->item('apem_debug_level');
			
			#$debug					= true;
			$app = $this->config->item('apem_app');
			$ConsumerID = $this->config->item('apem_ConsumerID');
			$ConsumerSecret = $this->config->item('apem_ConsumerSecret');
			$user_key = $this->config->item('user_key_antrol');
			
			$Headers = $this->get_signature($ConsumerID, $ConsumerSecret);
			$tStamp = $Headers['tStamp'];
			$encodedSignature = $Headers['encodedSignature'];
			#print_r($Headers);
			if (strtoupper($method) == 'GET')
				$ctype = "application/json; charset=utf-8";
			else
				$ctype = "application/x-www-form-urlencoded";
			
			$arr_header = array(
				'Content-Type:' . $ctype,
				'X-Cons-ID:' . $ConsumerID,
				'X-Timestamp:' . $tStamp,
				'X-Signature:' . $encodedSignature,
				'user_key:' . $user_key,
			);
			
			#$url_execute = $BaseURL.$ServiceName.$service_url_parameter;
			$url_execute = $service_url_parameter;
			$session = curl_init($url_execute);
			if ($debug && $debug_level >= 2) {
				$file_txt = $_SERVER["DOCUMENT_ROOT"] . "/" . $app . "/curl_log.txt";
				#$file_txt = $_SERVER['HTTP_REFERER'] . "/" . "curl_log.txt";
				
				$curl_log = fopen($file_txt, 'wr'); // open file for READ and write
				#echo FCPATH . "curl_log.txt" . "<br>";
				curl_setopt($session, CURLOPT_VERBOSE, true);
				curl_setopt($session, CURLOPT_STDERR, $curl_log);
			}
			
			curl_setopt($session, CURLOPT_CUSTOMREQUEST, strtoupper($method));
			curl_setopt($session, CURLOPT_URL, $url_execute);
			curl_setopt($session, CURLOPT_HTTPHEADER, $arr_header);
			curl_setopt($session, CURLOPT_VERBOSE, true);
			curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($session, CURLOPT_SSL_VERIFYHOST, false);
			
			if (strtoupper($method) != 'GET') {
				
				curl_setopt($session, CURLOPT_POST, true);
				curl_setopt($session, CURLOPT_POSTFIELDS, $myvars);
			}
			curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 2); 
			curl_setopt($session, CURLOPT_TIMEOUT, 2);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
			
			$result = curl_exec($session);
			$result = $this->decrypt_and_repack_response($result, $tStamp);
			
			if ($debug && $debug_level >= 2) {
				fclose($curl_log);
				$filename = $file_txt;
				$handle = fopen($filename, "r");
				$contents = fread($handle, filesize($filename));
				fclose($handle);
				echo "<br><hr><br>";
				echo nl2br($contents);
				
				echo "<br>Request : <br>";
				echo $url_execute . "<br>";
				if (strtoupper($method) == 'POST') {
					echo "<br>POSTED DATA : <br>";
					print_r(json_decode($myvars));
				}
				echo "<br>Response : <br>";
				print_r(json_decode($result));
				echo "<br>";
			}
			return json_decode($result);
		}
		
		public function antrol_ref_poli() 
		{
			$method = 'GET';
			$url_katalog = "{BASE URL}/antreanrs/ref/poli";
			//$url_katalog = "https://apijkn.bpjs-kesehatan.go.id/antreanrs/ref/poli";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$response = $this->simple_wsvclaim($service_url_parameter, $method);
			return $response;
		}
		
		public function antrol_ref_dokter() 
		{
			$method = 'GET';
			$url_katalog = "{BASE URL}/antreanrs/ref/dokter";
			//$url_katalog = "https://apijkn.bpjs-kesehatan.go.id/antreanrs/ref/dokter";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$response = $this->simple_antrol($service_url_parameter, $method);
			return $response;
		}
		
		public function antrol_jadwal($parameter_1, $parameter_2) 
		{
			$method = "GET";
			$url_katalog = "{BASE URL}/antreanrs/jadwaldokter/kodepoli/{Parameter 1}/tanggal/{Parameter 2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2);
			
			$response = $this->simple_antrol($service_url_parameter, $method);
			return $response;
		}
		
		public function antrol_update_jadwal_dokter($kodepoli, $kodesubspesialis, $kodedokter, $jadwal) 
		{
			$method = 'POST';
			$url_katalog = "{BASE URL}/antreanrs/jadwaldokter/updatejadwaldokter";
			$service_url_parameter = $this->generate_url_ws($url_katalog);
			
			$item_jadwal = '[';
			
			if ($jadwal) {
				foreach ($jadwal as $key => $value) {
					$item_jadwal .= '
												{
                          "hari":"' . $value['id_dow'] . '",
													"buka":"' . date("H:i", strtotime($value['hr_start'])) . '",
													"tutup":"' . date("H:i", strtotime($value['hr_end'])) . '"
                        }
												';
				}
			}

			$item_jadwal .= ']'; 

			$myitem = '
				{
						"kodepoli": "' . $kodepoli . '",
						"kodesubspesialis": "' . $kodesubspesialis . '",
						"kodedokter": "' . $kodedokter . '",
						"jadwal": "'. $item_jadwal .'" 
				}
			';

			$response = $this->simple_antrol($service_url_parameter, $method, $myitem);
			return $response;
			
		}

		public function antrol_tambah_antrian($kodebooking, $jenispasien, $nomorkartu, $nik, $nohp, $kodepoli, $namapoli, $pasienbaru, $norm, $tanggalperiksa, $kodedokter, $namadokter, $jampraktek, $jeniskunjungan, $nomorreferensi, $nomorantrean, $angkaantrean, $estimasidilayani, $jum_slot, $kuotajkn, $kuotanonjkn)
		{
			$method = 'POST';
			$url_katalog = "{BASE URL}/antreanrs/antrean/add";
			$service_url_parameter = $this->generate_url_ws($url_katalog);

			$myitem = '
				{
					"kodebooking"     : "'.$kodebooking.'",
					"jenispasien"     : "'.$jenispasien.'",
					"nomorkartu"      : "'.$nomorkartu.'",
					"nik"             : "'.$nik.'",
					"nohp"            : "'.$nohp.'",
					"kodepoli"        : "'.$kodepoli.'",
					"namapoli"        : "'.$namapoli.'",
					"pasienbaru"      : '.$pasienbaru.',
					"norm"            : "'.$norm.'",
					"tanggalperiksa"  : "'.$tanggalperiksa.'",
					"kodedokter"      : '.$kodedokter.',
					"namadokter"      : "'.$namadokter.'",
					"jampraktek"      : "'.$jampraktek.'",
					"jeniskunjungan"  : '.$jeniskunjungan.',
					"nomorreferensi"  : "'.$nomorreferensi.'",
					"nomorantrean"    : "'.$nomorantrean.'",
					"angkaantrean"    : '.$angkaantrean.',
					"estimasidilayani": '.(int)$estimasidilayani.',
					"sisakuotajkn"    : '.(int)$jum_slot.',
					"kuotajkn"        : '.(int)$kuotajkn.',
					"sisakuotanonjkn" : '.(int)$jum_slot.',
					"kuotanonjkn"     : '.(int)$kuotanonjkn.',
					"keterangan"      : "Peserta harap 30 menit lebih awal guna pencatatan administrasi."
				}
			';

			// return $myitem;

			$response = $this->simple_antrol($service_url_parameter, $method, $myitem);
			return $response;
		}

		public function antrolUpdateWaktu($kodebooking, $taskid, $estimasidilayani)
		{
			$method = 'POST';
			$url_katalog = "{BASE URL}/antreanrs/antrean/updatewaktu";
			$service_url_parameter = $this->generate_url_ws($url_katalog);

			$myitem = '
				{
					"kodebooking": "'.$kodebooking.'",
					"taskid": '.$taskid.',
					"waktu": '.(int)$estimasidilayani.'
				}
			';

			$response = $this->simple_antrol($service_url_parameter, $method, $myitem);
			return $response;
		}

		public function antrolBatalAntrean($kodebooking, $keterangan)
		{
			$method = 'POST';
			$url_katalog = "{BASE URL}/antreanrs/antrean/batal";
			$service_url_parameter = $this->generate_url_ws($url_katalog);

			$myitem = '
				{
					"kodebooking": "'.$kodebooking.'",
					"keterangan": "'.$keterangan.'"
				}
			';

			$response = $this->simple_antrol($service_url_parameter, $method, $myitem);
			return $response;
		}

		public function antrolListWaktuTaskid($kodebooking)
		{
			$method = 'POST';
			$url_katalog = "{BASE URL}/antreanrs/antrean/getlisttask";
			$service_url_parameter = $this->generate_url_ws($url_katalog);

			$myitem = '
				{
					"kodebooking": "'.$kodebooking.'"
				}
			';

			$response = $this->simple_antrol($service_url_parameter, $method, $myitem);
			return $response;
		}

		public function antrol_dashboard_per_tanggal($parameter_1, $parameter_2) 
		{
			$method = "GET";
			$url_katalog = "{BASE URL}/antreanrs/dashboard/waktutunggu/tanggal/{Parameter1}/waktu/{Parameter2}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2);
			
			$response = $this->simple_antrol($service_url_parameter, $method);
			return $response;
		}

		public function antrol_dashboard_per_bulan($parameter_1, $parameter_2, $parameter_3) 
		{
			$method = "GET";
			$url_katalog = "{BASE URL}/antreanrs/dashboard/waktutunggu/bulan/{Parameter1}/tahun/{Parameter2}/waktu/{Parameter3}";
			$service_url_parameter = $this->generate_url_ws($url_katalog, $parameter_1, $parameter_2, $parameter_3);
			
			$response = $this->simple_antrol($service_url_parameter, $method);
			return $response;
		}
		
	}

?>
