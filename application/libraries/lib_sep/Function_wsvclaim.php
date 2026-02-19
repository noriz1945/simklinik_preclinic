<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Function_wsvclaim {

var $id_ppk;
var $config;
var $today;
var $wsv;
var $fs;

public function __construct()
{
	$CI =& get_instance();
	$CI->fw = $this;
	$CI->function_wsvlclaim = $this;
	$this->config = $CI->config;
	$this->wsv = $CI->wsv;
	$this->fs = $CI->fs;
	
	date_default_timezone_set('Asia/Jakarta'); 
	$this->today = date("Y-m-d");
	$this->id_ppk = $this->config->item('apem_id_ppk');
} 
 
function get_function($act_func,$parameter1,$parameter2='',$parameter3='') 
{		

switch ($act_func) {
	case "act_search_rujukan_pcare" : 
		$data = search_rujukan($parameter1,'Pcare');
		break;
	case "act_search_rujukan_rs" : 
		$data = search_rujukan($parameter1,'RS'); 
		break;
	case "act_search_rujukan_pcare_peserta" : 
		$data = search_rujukan($parameter1,'Pcare','Peserta');
		break;
	case "act_search_rujukan_rs_peserta" : 
		$data = search_rujukan($parameter1,'RS','Peserta');
		break;
	case "act_search_referensi_diagnosa" : 
		$data = search_referensi ('diagnosa',$parameter1); 
		break;
	case "act_search_referensi_poli" : 
		$data = search_referensi ('poli',$parameter1); 
		break;
	case "act_search_referensi_faskes1" : 
	   	$data = search_referensi ('faskes',$parameter1,'1'); 
		break;
	case "act_search_referensi_faskes2" : 
	   	$data = search_referensi ('faskes',$parameter1,'2'); 
		break;	
	case "act_search_referensi_procedure" : 
		$data = search_referensi ('procedure',$parameter1); 
		break;
	case "act_search_referensi_kelasrawat" : 
		$data = search_referensi ('kelasrawat'); 
		break;
	case "act_search_referensi_dokter" : 
		$data = search_referensi ('dokter',$parameter1); 
		break;
	case "act_search_referensi_spesialistik" : 
		$data = search_referensi ('spesialistik'); 
		break;
	case "act_search_referensi_ruangrawat" : 
		$data = search_referensi ('ruangrawat'); 
		break;
	case "act_search_referensi_carakeluar" : 
		$data = search_referensi ('carakeluar'); 
		break;
	case "act_search_referensi_pascapulang" : 
		$data = search_referensi ('pascapulang'); 
		break;
	case "act_search_peserta_nokartu" : 	
	   	$data = search_peserta ('nokartu',$parameter1,$parameter2); 
		break;
	case "act_search_peserta_nik" : 
	    $data = search_peserta ('nik',$parameter1,$parameter2); 
		break;
	case "act_search_monitoring_kunjungan" : 
	    $data = search_monitoring('Kunjungan',$parameter1, $parameter2);
		break;	
	case "act_search_monitoring_klaim" : 
	    $data = search_monitoring('Klaim',$parameter1,$parameter2, $parameter3);
		break;		
	case "act_search_sep" : 
		$noSep=$parameter1;
	   	$data = search_sep($noSep);
		break;		
	case "act_insert_sep" :	
	    //$data = $parameter1;
	    $assist_sep = explode('|',$parameter1);
		$noKartu = $assist_sep[0];
		$tglSep = $assist_sep[1];
		$ppkPelayanan = $assist_sep[2];
		$jnsPelayanan = $assist_sep[3];
		$klsRawat = $assist_sep[4];
		$noMR = $assist_sep[5];
		$asalRujukan = $assist_sep[6];
		$tglRujukan = $assist_sep[7];
		$noRujukan = $assist_sep[8];
		$ppkRujukan = $assist_sep[9];
		$catatan = $assist_sep[10];
		$diagAwal = $assist_sep[11];
		$tujuan =  $assist_sep[12];
		$eksekutif =$assist_sep[13];
		$cob = $assist_sep[14];
		$lakaLantas = $assist_sep[15];
		$penjamin = $assist_sep[16];
		$lokasiLaka = $assist_sep[17];
		$noTelp =  $assist_sep[18];
		$user =$assist_sep[19];
				
		$data = insert_sep
		($noKartu,$tglSep,$ppkPelayanan,$jnsPelayanan,$klsRawat,
		$noMR,$asalRujukan,$tglRujukan,$noRujukan,$ppkRujukan,
		$catatan,$diagAwal,$tujuan,$eksekutif,$cob,
		$lakaLantas,$penjamin,$lokasiLaka,$noTelp,$user);
		break;
	
    default:
	    $data = '{"metaData":{"code":"201","message":"Function Tidak Ada"},"response":null}';
		break;
   
 } //end switch
 /*
	## --- DEBUGGER BY sarkodan
	global $ws_debug;
	if($ws_debug)
	{
		print_r($data);
		echo "<br> -------------------------- WS DEBUG IS ON --------------------------------- ";
	}
	*/
  return ($data);
} //end function
	
	
function get_data ($act_func,$parameter1,$parameter2='',$parameter3='') {	
            $result =  get_function ($act_func,$parameter1,$parameter2,$parameter3);
			$arr_result = json_decode($result);
			return $arr_result;
}
	
	
function cari_peserta_by_noka ($parameter1) {
$today = date("Y-m-d");
$parameter2 = $today;
$mydata = get_data ("act_search_peserta_nokartu",$parameter1,$parameter2);
return $mydata;
}

function cari_rjk_pcare_by_noka ($parameter1) {
$mydata = get_data ("act_search_rujukan_pcare_peserta",$parameter1);
return $mydata;
}

function cari_rjk_pcare_by_norjk ($parameter1) {
$mydata = get_data ("act_search_rujukan_pcare",$parameter1);
return $mydata;
}

function cari_rjk_rs_by_noka ($parameter1) {
$mydata = get_data ("act_search_rujukan_rs_peserta",$parameter1);
return $mydata;
}

function cari_rjk_rs_by_norjk ($parameter1) {
$mydata = get_data ("act_search_rujukan_rs",$parameter1);
return $mydata;
}	
	
	
function cari_sep_by_nosep ($parameter1) {
$mydata = get_data ("act_search_sep",$parameter1);
return $mydata;
}		
	
	
function buat_sep ($data_input_sep) 
{
	$noKartu				= $data_input_sep['noKartu'];
	$tglSep					= $data_input_sep['tglSep']; 				
	$ppkPelayanan		= $data_input_sep['ppkPelayanan'];
	$jnsPelayanan		= $data_input_sep['jnsPelayanan']; 	
	$klsRawat				= $data_input_sep['klsRawat']; 			
	$noMR						= $data_input_sep['noMR']; 					
	$asalRujukan		= $data_input_sep['asalRujukan']; 		
	$tglRujukan			= $data_input_sep['tglRujukan']; 		
	$noRujukan			= $data_input_sep['noRujukan']; 			
	$ppkRujukan			= $data_input_sep['ppkRujukan']; 		
	$catatan				= $data_input_sep['catatan']; 				
	$diagAwal				= $data_input_sep['diagAwal']; 			
	$tujuan					= $data_input_sep['tujuan']; 				
	$eksekutif			= $data_input_sep['eksekutif']; 			
	$cob						= $data_input_sep['cob']; 						
	$katarak				= $data_input_sep['katarak']; 				
	$lakaLantas			= $data_input_sep['lakaLantas']; 		
	$penjamin				= $data_input_sep['penjamin']; 			
	$tgl_kejadian		= $data_input_sep['tgl_kejadian']; 	
	$ket_kll				= $data_input_sep['ket_kll']; 				
	$suplesi				= $data_input_sep['suplesi']; 				
	$no_sep_suplesi	= $data_input_sep['no_sep_suplesi']; 
	$kd_propinsi		= $data_input_sep['kd_propinsi']; 		
	$kd_kabupaten		= $data_input_sep['kd_kabupaten']; 	
	$kd_kecamatan		= $data_input_sep['kd_kecamatan']; 	
	$no_skdp				= $data_input_sep['no_skdp']; 				
	$kd_dpjp				= $data_input_sep['kd_dpjp']; 				
	$noTelp					= $data_input_sep['noTelp']; 				
	$user						= $data_input_sep['user'];
	
	$mydata = $this->wsv->sep_insert($noKartu,$tglSep,$ppkPelayanan,$jnsPelayanan,
												$klsRawat,$noMR,$asalRujukan,$tglRujukan,
												$noRujukan,$ppkRujukan,$catatan,$diagAwal,
												$tujuan,$eksekutif,$cob,$katarak,
												$lakaLantas,$penjamin,$tgl_kejadian,$ket_kll,
												$suplesi,$no_sep_suplesi,$kd_propinsi,$kd_kabupaten,
												$kd_kecamatan,$no_skdp,$kd_dpjp,$noTelp,$user);
	return $mydata;
}

function cari_ppk1($parameter1) {
	#$mydata = get_data ("act_search_referensi_faskes1",$parameter1);
	$mydata = $this->wsv->referensi_faskes($parameter1,1);
	return $mydata;
}	


function cari_nosep_ws_by_noka ($search_kartu,$tgl_cari) 
{
	/*
	$act_func	='act_search_monitoring_kunjungan';
	$search_kartu 	= $noka;
	$parameter1 	= $tgl_cari;
	$parameter2 	= $parameter1;
	$parameter3 	='';
	$noSep ='';
	*/
	#$data = get_function ($act_func,$parameter1,$parameter2,$parameter3);
	$parameter_1 	= $tgl_cari;
	$parameter_2 	= 2;	// # Parameter 2 : Jenis Pelayanan (1. Inap 2. Jalan)
	$result = $this->wsv->monitoring_data_kunjungan($parameter_1,$parameter_2);
	#$result = json_decode($data); 
	
	$noSep = "";
	$response = $result->response->sep;
	foreach ($response as $response) 
	{
		$noKartu = $response->noKartu;
		if ($noKartu == $search_kartu)
		{
			$noSep = $response->noSep;
			//echo 'stop here:'.$noKartu.'->'.$noSep.'<br>';
			break;
		}
	}
	
	return $noSep;
}	


function get_data_assist_from_kepesertaan_by_noka ($noka) {
 
  $today = $this->today;
  $id_ppk = $this->id_ppk;
  
	#$mydata = cari_peserta_by_noka ($noka);
	$mydata = $this->wsv->peserta_cari($noka);
	$status = $mydata->metaData->code;
	$msg = $mydata->metaData->message;
	if($status == '200'){
		//print_r($mydata);
		//die();
		$faskes = "1";
		
		$my_noKartu	= $mydata->response->peserta->noKartu;
		$my_tglSep		= $today;
		$my_ppkPelayanan= $id_ppk;
		$my_jnsPelayanan="2"; //jenis pelayanan = 1. r.inap 2. r.jalan
		$my_klsRawat	="3";
		$my_noMR	    = $mydata->response->peserta->mr->noMR;
		$my_asalRujukan = $faskes; //1 =klinik 2=RS
		$my_tglRujukan	= $today;
		$my_noRujukan	= "0000";
		$my_ppkRujukan	= $mydata->response->peserta->provUmum->kdProvider;
		$my_catatan	= "-";
		$my_diagAwal	= "Z08.9";
		$my_tujuan		= "";
		$my_eksekutif	="0"; //0. Tidak 1.Ya
		$nmAsuransi = isset($mydata->response->peserta->cob->nnmAsuransi);
		$my_cob	=(($nmAsuransi=='')? '0' : '1');
		$my_lakaLantas	="0";
		$my_penjamin	="-";
		$my_lokasiLaka	="-";
		$my_noTelp 	=$mydata->response->peserta->mr->noTelepon;
		#$my_user	    ="1025R001_kiosksa";
		#$my_user	    ="0223R045_kiosksa";
		$my_user	    ="0223R045_ade";
		$my_msg = $msg;
	}
	else {
		
		$my_noKartu	=" ";
		$my_tglSep	=" ";
		$my_ppkPelayanan	=" ";
		$my_jnsPelayanan	=" ";
		$my_klsRawat	=" ";
		$my_noMR	=" ";
		$my_asalRujukan 	=" ";
		$my_tglRujukan	=" ";
		$my_noRujukan	=" ";
		$my_ppkRujukan	=" ";
		$my_catatan	=" ";
		$my_diagAwal	=" ";
		$my_tujuan	=" ";
		$my_eksekutif	=" ";
		$nmAsuransi 	=" ";
		$my_cob	=" ";
		$my_lakaLantas	=" ";
		$my_penjamin	=" ";
		$my_lokasiLaka	=" ";
		$my_noTelp 	=" ";
		$my_user	=" ";
		$my_msg = $msg;
	
	}
	
    return array(
		
		'my_noKartu' =>$my_noKartu,
		'my_tglSep' =>$my_tglSep,
		'my_ppkPelayanan' =>$my_ppkPelayanan,
		'my_jnsPelayanan' =>$my_jnsPelayanan,
		'my_klsRawat' =>$my_klsRawat,
		'my_noMR' =>$my_noMR,
		'my_asalRujukan' =>$my_asalRujukan ,
		'my_tglRujukan' =>$my_tglRujukan,
		'my_noRujukan' =>$my_noRujukan,
		'my_ppkRujukan' =>$my_ppkRujukan,
		'my_catatan' =>$my_catatan,
		'my_diagAwal' =>$my_diagAwal,
		'my_tujuan' =>$my_tujuan,
		'my_eksekutif' =>$my_eksekutif,
		'nmAsuransi' =>$nmAsuransi ,
		'my_cob' =>$my_cob,
		'my_lakaLantas' =>$my_lakaLantas,
		'my_penjamin' =>$my_penjamin,
		'my_lokasiLaka' =>$my_lokasiLaka,
		'my_noTelp' =>$my_noTelp ,
		'my_user' =>$my_user,
		'msg' =>$my_msg
	);

}

function get_data_assist_from_pcare_by_noka ($noka) {

  $today = date('Y-m-d');
  $id_ppk = $this->config->item('apem_id_ppk');
		
		#$data 	= cari_rjk_pcare_by_noka ($noka);
		$data = $this->wsv->rujukan_search_pcare_single_by_noka($noka);	// >>> ambil data rujukan dari puskesmas/klinik
		#$data = $this->wsv->rujukan_search_rs_single_by_noka($noka);	// >>> ambil data rujukan dari RS (kemungkinan tipe C)
		
		$status			= $data->metaData->code;
		$msg 			= $data->metaData->message;
		if ($status != '200')
		{
	                $my_noKartu	=" ";
					$my_tglSep	=" ";
					$my_ppkPelayanan	=" ";
					$my_jnsPelayanan	=" ";
					$my_klsRawat	=" ";
					$my_noMR	=" ";
					$my_asalRujukan 	=" ";
					$my_tglRujukan	=" ";
					$my_noRujukan	=" ";
					$my_ppkRujukan	=" ";
					$my_catatan	=" ";
					$my_diagAwal	=" ";
					$my_tujuan	=" ";
					$my_eksekutif	=" ";
					$nmAsuransi 	=" ";
					$my_cob	=" ";
					$my_lakaLantas	=" ";
					$my_penjamin	=" ";
					$my_lokasiLaka	=" ";
					$my_noTelp 	=" ";
					$my_user	=" ";
					$my_msg = $msg;
					
					 return array(
		
					'my_noKartu' =>$my_noKartu,
					'my_tglSep' =>$my_tglSep,
					'my_ppkPelayanan' =>$my_ppkPelayanan,
					'my_jnsPelayanan' =>$my_jnsPelayanan,
					'my_klsRawat' =>$my_klsRawat,
					'my_noMR' =>$my_noMR,
					'my_asalRujukan' =>$my_asalRujukan ,
					'my_tglRujukan' =>$my_tglRujukan,
					'my_noRujukan' =>$my_noRujukan,
					'my_ppkRujukan' =>$my_ppkRujukan,
					'my_catatan' =>$my_catatan,
					'my_diagAwal' =>$my_diagAwal,
					'my_tujuan' =>$my_tujuan,
					'my_eksekutif' =>$my_eksekutif,
					'nmAsuransi' =>$nmAsuransi ,
					'my_cob' =>$my_cob,
					'my_lakaLantas' =>$my_lakaLantas,
					'my_penjamin' =>$my_penjamin,
					'my_lokasiLaka' =>$my_lokasiLaka,
					'my_noTelp' =>$my_noTelp ,
					'my_user' =>$my_user,
					'msg' =>$my_msg
				);
   
	   }
		
		$tgl_kunjungan	= $data->response->rujukan->tglKunjungan;
    $kode_p 				= $data->response->rujukan->poliRujukan->kode;
		$no_rm 		  		= $data->response->rujukan->peserta->mr->noMR;
		
		#print_r($data);
		$id_poly 	  = $this->fs->get_id_poly_bpjs2smarthis($kode_p);
		#$id_reg_pas = $this->fs->get_info_past_reg ($no_rm,$tgl_kunjungan,$id_poly);
		
		$cek_rjk 	   = $this->fs->cek_expired_rujukan ($tgl_kunjungan);
		
		if ($cek_rjk!='expired')
		{
				 #$mydata = cari_peserta_by_noka ($noka);
				 $mydata = $this->wsv->peserta_cari($noka,$today);
				 $status = $mydata->metaData->code;	
				 $msg = $mydata->metaData->message;	
				if($status == '200'){
					//print_r($mydata);
					//die();
					$faskes = "1";
					
					$my_noKartu	= $mydata->response->peserta->noKartu;
					$my_tglSep		= $today;
					$my_ppkPelayanan= $id_ppk;
					$my_jnsPelayanan="2"; //jenis pelayanan = 1. r.inap 2. r.jalan
					$my_klsRawat	="3";
					$my_noMR	    = $mydata->response->peserta->mr->noMR;
					$my_asalRujukan = $faskes; //1 =klinik 2=RS
					#$my_tglRujukan	= $today;
					$my_tglRujukan	= $tgl_kunjungan;
					#$my_noRujukan	= "0000";
					$my_noRujukan	= $data->response->rujukan->noKunjungan;
					$my_ppkRujukan	= $mydata->response->peserta->provUmum->kdProvider;
					$my_catatan	= "-";
					$my_diagAwal	= $data->response->rujukan->diagnosa->kode;
					#$my_tujuan		= "";
					$my_tujuan		= $data->response->rujukan->poliRujukan->kode;
					$my_eksekutif	="0"; //0. Tidak 1.Ya
					$nmAsuransi = isset($mydata->response->peserta->cob->nnmAsuransi);
					$my_cob	=(($nmAsuransi=='')? '0' : '1');
					$my_lakaLantas	="0";
					$my_penjamin	="-";
					$my_lokasiLaka	="-";
					$my_noTelp 	=$mydata->response->peserta->mr->noTelepon;
					#$my_user = "1025R001_kiosksa";
					#$my_user	= "0223R045_kiosksa";
					$my_user	= "0223R045_ade";
					$my_msg = $msg;
				}
				else {
					$my_noKartu	=" ";
					$my_tglSep	=" ";
					$my_ppkPelayanan	=" ";
					$my_jnsPelayanan	=" ";
					$my_klsRawat	=" ";
					$my_noMR	=" ";
					$my_asalRujukan 	=" ";
					$my_tglRujukan	=" ";
					$my_noRujukan	=" ";
					$my_ppkRujukan	=" ";
					$my_catatan	=" ";
					$my_diagAwal	=" ";
					$my_tujuan	=" ";
					$my_eksekutif	=" ";
					$nmAsuransi 	=" ";
					$my_cob	=" ";
					$my_lakaLantas	=" ";
					$my_penjamin	=" ";
					$my_lokasiLaka	=" ";
					$my_noTelp 	=" ";
					$my_user	=" ";
					$my_msg = $msg;
				
				}
	  } 
		else 
		{
			/*
		  #$mydata = cari_rjk_pcare_by_noka ($noka);
			$mydata = $this->wsv->rujukan_search_pcare_single_by_noka($noka);
			if($status == '200' && $id_reg_pas=='' ){
			//print_r($mydata);
			//die();
			$faskes = "1";
			$my_noKartu	= $mydata->response->rujukan->peserta->noKartu;
			$my_tglSep		= $today;
			$my_ppkPelayanan= $id_ppk;
			$my_jnsPelayanan="2"; //jenis pelayanan = 1. r.inap 2. r.jalan
			$my_klsRawat	="3";
			$my_noMR	    = $mydata->response->rujukan->peserta->mr->noMR;
			$my_asalRujukan = $faskes; //1 =klinik 2=RS
			$my_tglRujukan	= $mydata->response->rujukan->tglKunjungan;
			$my_noRujukan	= $mydata->response->rujukan->noKunjungan;
			$my_ppkRujukan	= $mydata->response->rujukan->provPerujuk->kode;
			$my_catatan	= $mydata->response->rujukan->keluhan;
			$my_diagAwal	= $mydata->response->rujukan->diagnosa->kode;
			$my_tujuan		= $mydata->response->rujukan->poliRujukan->kode;
			$my_eksekutif	="0"; //0. Tidak 1.Ya
			$nmAsuransi = isset($mydata->response->rujukan->peserta->cob->nnmAsuransi);
			$my_cob	= (($nmAsuransi=='')? '0' : '1');
			$my_lakaLantas	="0";
			$my_penjamin	="-";
			$my_lokasiLaka	="-";
			$my_noTelp 	=$mydata->response->rujukan->peserta->mr->noTelepon;
			#$my_user	    ="1025R001_kiosksa";	
			$my_user	    ="0223R045_ade";
			$my_msg = $msg;
			}
			else {
			*/
			$my_noKartu	=" ";
			$my_tglSep	=" ";
			$my_ppkPelayanan	=" ";
			$my_jnsPelayanan	=" ";
			$my_klsRawat	=" ";
			$my_noMR	=" ";
			$my_asalRujukan 	=" ";
			$my_tglRujukan	=" ";
			$my_noRujukan	=" ";
			$my_ppkRujukan	=" ";
			$my_catatan	=" ";
			$my_diagAwal	=" ";
			$my_tujuan	=" ";
			$my_eksekutif	=" ";
			$nmAsuransi 	=" ";
			$my_cob	=" ";
			$my_lakaLantas	=" ";
			$my_penjamin	=" ";
			$my_lokasiLaka	=" ";
			$my_noTelp 	=" ";
			$my_user	=" ";
			$my_msg = $msg." BUT NO OKAY";
			#}
		
		}
		
    return array(
		
		'my_noKartu' =>$my_noKartu,
		'my_tglSep' =>$my_tglSep,
		'my_ppkPelayanan' =>$my_ppkPelayanan,
		'my_jnsPelayanan' =>$my_jnsPelayanan,
		'my_klsRawat' =>$my_klsRawat,
		'my_noMR' =>$my_noMR,
		'my_asalRujukan' =>$my_asalRujukan ,
		'my_tglRujukan' =>$my_tglRujukan,
		'my_noRujukan' =>$my_noRujukan,
		'my_ppkRujukan' =>$my_ppkRujukan,
		'my_catatan' =>$my_catatan,
		'my_diagAwal' =>$my_diagAwal,
		'my_tujuan' =>$my_tujuan,
		'my_eksekutif' =>$my_eksekutif,
		'nmAsuransi' =>$nmAsuransi ,
		'my_cob' =>$my_cob,
		'my_lakaLantas' =>$my_lakaLantas,
		'my_penjamin' =>$my_penjamin,
		'my_lokasiLaka' =>$my_lokasiLaka,
		'my_noTelp' =>$my_noTelp ,
		'my_user' =>$my_user,
		'msg' =>$my_msg
	);
}

function get_data_assist_from_pcare_by_norjk ($norjk)
{
	$today = $this->today;
	$id_ppk = $this->id_ppk;
	
	#$mydata = cari_rjk_pcare_by_norjk ($norjk);
	$mydata = $this->wsv->rujukan_search_pcare($norjk);
	#$mydata = $this->wsv->rujukan_search_rs($norjk);
	
	#print_r($mydata);
	$status = $mydata->metaData->code;	
	$msg = $mydata->metaData->message;	
	$tgl_kunjungan	= $mydata->response->rujukan->tglKunjungan;
	$cek_rjk 	= $this->fs->cek_expired_rujukan($tgl_kunjungan);
	if ($cek_rjk=='expired')
	{
		#$msg ='Surat Rujukan sudah melebihi 90 hari';
		$msg = $msg;
		$my_noKartu	=" ";
		$my_tglSep	=" ";
		$my_ppkPelayanan	=" ";
		$my_jnsPelayanan	=" ";
		$my_klsRawat	=" ";
		$my_noMR	=" ";
		$my_asalRujukan 	=" ";
		$my_tglRujukan	=" ";
		$my_noRujukan	=" ";
		$my_ppkRujukan	=" ";
		$my_catatan	=" ";
		$my_diagAwal	=" ";
		$my_tujuan	=" ";
		$my_eksekutif	=" ";
		$nmAsuransi 	=" ";
		$my_cob	=" ";
		$my_lakaLantas	=" ";
		$my_penjamin	=" ";
		$my_lokasiLaka	=" ";
		$my_noTelp 	=" ";
		$my_user	=" ";
		$my_msg =  $msg ;
	}
	else 
	{
		if($status == '200'){
			$faskes = "1";
			$my_noKartu	= $mydata->response->rujukan->peserta->noKartu;
			$my_tglSep		= $today;
			$my_ppkPelayanan= $id_ppk;
			$my_jnsPelayanan="2"; //jenis pelayanan = 1. r.inap 2. r.jalan
			$my_klsRawat	="3";
			$my_noMR	    = $mydata->response->rujukan->peserta->mr->noMR;
			$my_asalRujukan=  $faskes; //1 =klinik 2=RS
			$my_tglRujukan	= $mydata->response->rujukan->tglKunjungan;
			$my_noRujukan	= $mydata->response->rujukan->noKunjungan;
			$my_ppkRujukan	= $mydata->response->rujukan->provPerujuk->kode;
			$my_catatan	= $mydata->response->rujukan->keluhan;
			$my_diagAwal	= $mydata->response->rujukan->diagnosa->kode;
			$my_tujuan		= $mydata->response->rujukan->poliRujukan->kode;
			$my_eksekutif	="0"; //0. Tidak 1.Ya
			$nmAsuransi = isset($mydata->response->rujukan->peserta->cob->nnmAsuransi);
			$my_cob	=(($nmAsuransi=='')? '0' : '1');
			$my_lakaLantas	="0";
			$my_penjamin	="-";
			$my_lokasiLaka	="-";
			$my_noTelp 	=$mydata->response->rujukan->peserta->mr->noTelepon;
			#$my_user	    ="1025R001_kiosksa";
			#$my_user	    ="0223R045_kiosksa";
			$my_user	    ="0223R045_ade";
			
			$my_msg = $msg;
		}
		else
		{
			$my_noKartu	=" ";
			$my_tglSep	=" ";
			$my_ppkPelayanan	=" ";
			$my_jnsPelayanan	=" ";
			$my_klsRawat	=" ";
			$my_noMR	=" ";
			$my_asalRujukan 	=" ";
			$my_tglRujukan	=" ";
			$my_noRujukan	=" ";
			$my_ppkRujukan	=" ";
			$my_catatan	=" ";
			$my_diagAwal	=" ";
			$my_tujuan	=" ";
			$my_eksekutif	=" ";
			$nmAsuransi 	=" ";
			$my_cob	=" ";
			$my_lakaLantas	=" ";
			$my_penjamin	=" ";
			$my_lokasiLaka	=" ";
			$my_noTelp 	=" ";
			$my_user	=" ";
			
			$my_msg = $msg;
		}
	}
	
	return array(
		'my_noKartu' 			=> $my_noKartu,
		'my_tglSep' 			=> $my_tglSep,
		'my_ppkPelayanan' => $my_ppkPelayanan,
		'my_jnsPelayanan' => $my_jnsPelayanan,
		'my_klsRawat' 		=> $my_klsRawat,
		'my_noMR' 				=> $my_noMR,
		'my_asalRujukan' 	=> $my_asalRujukan ,
		'my_tglRujukan' 	=> $my_tglRujukan,
		'my_noRujukan' 		=> $my_noRujukan,
		'my_ppkRujukan' 	=> $my_ppkRujukan,
		'my_catatan' 			=> $my_catatan,
		'my_diagAwal' 		=> $my_diagAwal,
		'my_tujuan' 			=> $my_tujuan,
		'my_eksekutif' 		=> $my_eksekutif,
		'nmAsuransi' 			=> $nmAsuransi ,
		'my_cob' 					=> $my_cob,
		'my_lakaLantas' 	=> $my_lakaLantas,
		'my_penjamin' 		=> $my_penjamin,
		'my_lokasiLaka' 	=> $my_lokasiLaka,
		'my_noTelp' 			=> $my_noTelp ,
		'my_user' 				=> $my_user,
		'msg' 						=> $my_msg
	);
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

function hitung_jumlah_pemakaian_rujukan_by_noka_method_2($noka,$jenPel=2)
{
	$result = $this->wsv->monitoring_data_kunjungan($noka,$jenPel);
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

function get_nosep_kunjungan_pertama_by_no_rujukan($noka,$tgl_1,$tgl_2,$no_rjk)
{
	$return = ""; // << just for init
	$result = $this->wsv->monitoring_data_histori_pelayanan_peserta($noka,$tgl_1,$tgl_2);
	$jumlah_kunjungan = 0;
	$response = $result->response->histori;
	foreach ($response as $k => $resp) 
	{
		if ($no_rjk == $resp->noRujukan)
		{
			$return = $resp->noSep;
			break;
		}
	}
	
	return $return;
}	




}
?>