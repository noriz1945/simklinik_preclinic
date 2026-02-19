<?php
defined('BASEPATH') or exit('No direct script access allowed');
class WsInacbg {
	
	var $config;
	
	public function __construct()
  {
		$CI =& get_instance();
		$CI->wsi = $this;
		$this->config = $CI->config;
		$this->ed = $CI->ed;
	}
	
	#require 'base.php';
	#require $base_dir.'lib/enc.dec.php';
	#require $base_dir.'lib/param.php';
	
	
	public function luthbro_to_inacbg_ws ($myitem)	
	{	
		#global $key;
		#global $url_inacbg;
		$key = $this->config->item('br_key');
		$url_inacbg = $this->config->item('br_url_inacbg');
		
		$session = curl_init ($url_inacbg); 
		if($this->config->item('debug_ws'))
		{
			$file_txt = FCPATH . "curl_log.txt";
			$curl_log = fopen($file_txt, 'wr'); // open file for READ and write
			#echo FCPATH . "curl_log.txt" . "<br>";
			curl_setopt($session, CURLOPT_VERBOSE, true);
			curl_setopt($session, CURLOPT_STDERR, $curl_log);
		}
		$arrheader = array (
			'Accept: application/json',
					'Content-Type: application/json'
			);
		//$myvars = json_encode($myitem);
		$myvars = $myitem;
		$myencrypted = $this->ed->mc_encrypt($myvars,$key);
		//$mydecrypted = mc_decrypt($myencrypted,$key);
		//die ($myencrypted."<br>".$mydecrypted);
		curl_setopt ( $session, CURLOPT_URL, $url_inacbg );
		curl_setopt ( $session, CURLOPT_HTTPHEADER, $arrheader );
		curl_setopt ( $session, CURLOPT_VERBOSE, true );
		curl_setopt ( $session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ( $session, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt ( $session, CURLOPT_POST, true );
		curl_setopt ( $session, CURLOPT_POSTFIELDS, $myencrypted );
		curl_setopt ( $session, CURLOPT_RETURNTRANSFER, TRUE );
		$result     = curl_exec ( $session );
		$myresponse   = str_replace("----BEGIN ENCRYPTED DATA----","",str_replace("----END ENCRYPTED DATA----","",$result));
		$response = $this->ed->mc_decrypt($myresponse,$key);
		if($this->config->item('debug_ws'))
		{
			fclose($curl_log);
			$filename = $file_txt;
			$handle = fopen($filename, "r");
			$contents = fread($handle, filesize($filename));
			fclose($handle);
			
			echo nl2br($contents);
			echo "<br>Request : <br>";
			echo $url_inacbg . "<br>";
			echo "<br>Data : <br>";
			echo $myvars."<br><br>";
			print_r(json_decode($myvars));
			echo "<br><br>Response : <br>";
			print_r(json_decode($response));
			#die();
		}
		return $response;
	} 
	
	
	function f_new_claim ($nomor_kartu,$nomor_sep,$nomor_rm,$nama_pasien,$tgl_lahir,$gender)
	{
		$item ='{
			"metadata": {
				"method": "new_claim"
			},
			"data": {
				"nomor_kartu": "'.$nomor_kartu.'",
				"nomor_sep": "'.$nomor_sep.'",
				"nomor_rm": "'.$nomor_rm.'",
				"nama_pasien": "'.$nama_pasien.'",
				"tgl_lahir": "'.$tgl_lahir.'",
				"gender": "'.$gender.'"
			 }
			}'; 
			$myresult = $this->luthbro_to_inacbg_ws ($item);
			#print_r($myresult);
			#echo $item;
			
			$arr_result = json_decode($myresult);
			$code = $arr_result->metadata->code;
			$message = $arr_result->metadata->message;
			$error_no = set_value(@$arr_result->metadata->error_no,'');
			
			//echo $code.":".$message."::".$error_no;
			$return = array(
					'code'	=> $code,
					'message'	=> $message,
					'error_no'	=> $error_no,
			);
			
			return $return;
			
	} 	 
	
	function f_update_patient($nomor_kartu,$nomor_rm,$nama_pasien,$tgl_lahir,$gender)
	{
		$item ='
		{
			"metadata": {
				"method": "update_patient",
				"nomor_rm": "'.$nomor_rm.'"
			},
			"data": {
				"nomor_kartu": "'.$nomor_kartu.'",
				"nomor_rm": "'.$nomor_rm.'",
				"nama_pasien": "'.$nama_pasien.'",
				"tgl_lahir": "'.$tgl_lahir.'",
				"gender": "'.$gender.'"
			}
		}
		';
		$myresult = $this->luthbro_to_inacbg_ws ($item);
		#echo $myresult;
		#echo $item;
			
			$arr_result = json_decode($myresult);
				
			$code = $arr_result->metadata->code;
			$message = $arr_result->metadata->message;
			$error_no = set_value(@$arr_result->metadata->error_no,'');
			//echo $code.":".$message."::".$error_no;
			$return = array(
					'code'	=> $code,
					'message'	=> $message,
					'error_no'	=> $error_no,
			);
			
			return $return;
	}
	
	function f_set_claim_data 
			(	$nomor_sep,$tgl_masuk,$tgl_pulang,$jenis_rawat,
				$kelas_rawat, $birth_weight,$discharge_status,$diagnosa,
				$procedure,$adl_sub_acute,$adl_chronic,$tarif_rs,
				$tarif_poli_eks,$nama_dokter,$icu_indikator,$icu_los,
				$ventilator_hour,$kode_tarif,$payor_id,$payor_cd,
				$coder_nik,$nomor_kartu,$upgrade_class_ind,$upgrade_class_class, 
				$upgrade_class_los, $add_payment_pct,$prosedur_non_bedah,$prosedur_bedah,
				$konsultasi,$tenaga_ahli,$keperawatan,$penunjang, 
				$radiologi,$laboratorium, $pelayanan_darah,$rehabilitasi,
				$kamar, $rawat_intensif,$obat,$alkes, 
				$bmhp, $sewa_alat,$cob_cd
			)
	{
			$item ='
			{
				"metadata": {
					"method": "set_claim_data",
					"nomor_sep": "'.$nomor_sep.'"
				},
				"data": {
					"nomor_sep": "'.$nomor_sep.'",
					
								"nomor_kartu": "'.$nomor_kartu.'",
					
					"tgl_masuk": "'.$tgl_masuk.'",
					"tgl_pulang": "'.$tgl_pulang.'",
					"jenis_rawat": "'.$jenis_rawat.'",
					"kelas_rawat": "'.$kelas_rawat.'",
					"adl_sub_acute": "'.$adl_sub_acute.'",
					"adl_chronic": "'.$adl_chronic.'",
					"icu_indikator": "'.$icu_indikator.'",
					"icu_los": "'.$icu_los.'",
					"ventilator_hour": "'.$ventilator_hour.'",
					
					"upgrade_class_ind": "'.$upgrade_class_ind.'", 
					"upgrade_class_class": "'.$upgrade_class_class.'",
					"upgrade_class_los": "'.$upgrade_class_los.'",
					
					"add_payment_pct": "'.$add_payment_pct.'",
									
					"birth_weight": "'.$birth_weight.'",
					"discharge_status": "'.$discharge_status.'",
					"diagnosa": "'.$diagnosa.'",
					"procedure": "'.$procedure.'",
					
					"tarif_rs": 
					{
						"prosedur_non_bedah": "'.$prosedur_non_bedah.'", 
						"prosedur_bedah": "'.$prosedur_bedah.'",
						"konsultasi": "'.$konsultasi.'",
						"tenaga_ahli": "'.$tenaga_ahli.'",
						"keperawatan": "'.$keperawatan.'",
						"penunjang": "'.$penunjang.'", 
						"radiologi": "'.$radiologi.'",
						"laboratorium": "'.$laboratorium.'",
						"pelayanan_darah": "'.$pelayanan_darah.'",
						"rehabilitasi": "'.$rehabilitasi.'",
						"kamar": "'.$kamar.'",
						"rawat_intensif": "'.$rawat_intensif.'", 
						"obat": "'.$obat.'",
						"alkes": "'.$alkes.'",
						"bmhp": "'.$bmhp.'",
						"sewa_alat": "'.$sewa_alat.'"
					},
					"tarif_poli_eks": "'.$tarif_poli_eks.'",
					"nama_dokter": "'.$nama_dokter.'",
					"kode_tarif": "'.$kode_tarif.'",
					"payor_id": "'.$payor_id.'",
					"payor_cd": "'.$payor_cd.'",
					
					"cob_cd": "'.$cob_cd.'",
					
					"coder_nik": "'.$coder_nik.'"
				}
			}
			';
			$myresult = $this->luthbro_to_inacbg_ws ($item);
			#echo $item;
			#die();
			$arr_result = json_decode($myresult);
			$code = $arr_result->metadata->code;
			$message = $arr_result->metadata->message;
			$error_no = set_value(@$arr_result->metadata->error_no,'');
			//echo $code.":".$message."::".$error_no;
			$return = array(
					'code'	=> $code,
					'message'	=> $message,
					'error_no'	=> $error_no,
			);
			
			return $return;
			
	}
	
	function f_grouper_stage1 ($nomor_sep)
	{
	$item ='{
		 "metadata": {
				"method":"grouper",
				"stage":"1"
		 },
		 "data": {
				"nomor_sep":"'.$nomor_sep.'"
		 }
	}'; 
	
					$myresult = $this->luthbro_to_inacbg_ws ($item);
				$arr_result = json_decode($myresult);
			$code = $arr_result->metadata->code;
			$message = $arr_result->metadata->message;
			$error_no = set_value(@$arr_result->metadata->error_no,'');
			//echo $code.":".$message."::".$error_no;
			$return = array(
					'code'	=> $code,
					'message'	=> $message,
					'error_no'	=> $error_no,
			);
			
			return $return;
	
	} 	 
	
	function f_get_claim_data ($nomor_sep)
	{
	$item ='{
		 "metadata": {
				"method":"get_claim_data"
		 },
		 "data": {
				"nomor_sep":"'.$nomor_sep.'"
		 }
	}'; 
	
			$myresult = $this->luthbro_to_inacbg_ws ($item);
		//echo $myresult;
		return $myresult;
	
	} 	 
	
	
	function f_pull_claim ($start_dt,$stop_dt,$jenis_rawat)
	{
		$item ='{
			 "metadata": {
					"method":"pull_claim"
			 },
			 "data": {
					"start_dt":"'.$start_dt.'",
				"stop_dt":"'.$stop_dt.'",
				"jenis_rawat":"'.$jenis_rawat.'"
			 }
		}'; 
			#echo $item ."<br><br>";
			$myresult = $this->luthbro_to_inacbg_ws ($item);
			#echo $myresult  ."<br><br>";
			return $myresult;
	}
	
	
	
}
?>