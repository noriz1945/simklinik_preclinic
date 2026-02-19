<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Eresep_bypass extends MX_Controller

{

	var $session_name='sp';

    function __construct()

    {

        parent::__construct();

				#modules::run('auth/check_session');

        $this->load->model('Eresep_model_bypass','Eresep_model');



				date_default_timezone_set('Asia/Jakarta');

    }

//////////////////////////////////////

public function add_additional()

{

		$id_reg	                      = $this->input->post('id_eresep');

		$id_eresep	                  = $this->input->post('id_eresep');

		$data_pasien				  = $this->Eresep_model->data_pasien($id_reg);

		$id_pasien 					  = $data_pasien->id_pasien;

		$name 					  	  = $data_pasien->name;

		$id_reg 					  = $data_pasien->id_reg;

		$regdate 					  = $data_pasien->regdate;

		$nama_asuransi 				  = $data_pasien->nama_asuransi;

		$nama_dokter 				  = $data_pasien->nama_dokter;

		$id_ktp						  = $data_pasien->pid_num;

		
	$checksoap      = $this->Eresep_model->getdatasoap($id_reg);
	$subjective    	= $checksoap->subjective;
	$objective    	= $checksoap->objective;
	$assesment    	= $checksoap->diag_medis_banding;
	$planning    	= $checksoap->planning;


		$data = array(

			'id_reg'			=> $id_reg,

			'id_pasien'			=> $id_pasien,

			'name'				=> $name,

			'id_eresep'			=> $id_eresep,

			'regdate'			=> $regdate,

			'nama_asuransi'		=> $nama_asuransi,

			'nama_dokter'		=> $nama_dokter,

			'id_ktp'			=> $id_ktp,
			'subjective'        => $subjective,
			'objective'         => $objective,
			'assesment'         => $assesment,
			'planning'          => $planning
			

		);

		$this->load->view('eresep_additional_bypass', $data);

}

public function save_eresep_nonracikan()

{

	$username 		= $this->session->userdata['sp']->login_name;
	$checkfrm       = $this->Eresep_model->getdatafarmasi($username);
	$set_depo    	= $checkfrm->set_depo;

    

    ## --- data header ---

    $id_eresep = $this->input->post('ideresep');

    $id_reg =  $id_eresep;//$this->input->post('id_reg');

    $id_pasien = $this->input->post('id_pasien');

    $now = date('Y-m-d H:i:s');



    ## --- data detail ---

    $obat 			        = $this->input->post('obat');

    $id_fa 			        = $this->input->post('id_fa');

    $jenis_obat             = $this->input->post('jenis_obat');

    $qty 			        = $this->input->post('qty');

    $dosis 			        = $this->input->post('dosis');

    $frekwensi 	            = $this->input->post('frekwensi');

    $tme 			        = $this->input->post('tme');

    $harga 			        = $this->input->post('harga');

    $total_harga_obat 	    = $this->input->post('total_harga_obat');

    $note 			        = $this->input->post('note');



    ### --- INSERT eresep detail ----------------------------------

    if(isset($obat))

    {
// Insert header
$sql_insert_header = "
    INSERT INTO `soap_eresep`
        (`eresepdate`, `id_reg`, `is_eresep_pulang`, `id_dokter`)
    VALUES
        ('".$now."', '".$id_reg."', '0', '0')
";
$ok = $this->dbhis->query($sql_insert_header);

if ($ok) {
    // ambil ID auto increment terakhir
    $id_eresep = $this->dbhis->insert_id();

    // Insert detail, gunakan id_eresep hasil insert pertama
    $sql_insert_det = "
        INSERT INTO `soap_eresep_det`
            (`id_eresep`, `id_trx_det`, `name`, `jenis_obat`, `qty`, `dosis`, `tme`, `frekwensi`,
             `harga_satuan`, `subtotal`, `note`, `created`, `created_by`, `set_depo`)
        VALUES
            ('".$id_eresep."', '".$id_fa."', '".$obat."', '".$jenis_obat."', '".$qty."', '".$dosis."', '".$tme."', '".$frekwensi."',
             '".$harga."', '".$total_harga_obat."', '".$note."', '".$now."', '".$username."', '".$set_depo."')
    ";
    $ok_inv = $this->dbhis->query($sql_insert_det);

    if ($ok_inv) {
        // sukses insert header & detail
    } else {
        // gagal insert detail
    }
} else {
    // gagal insert header
}




    }
    
        ///////////////////LOG SYSTEM
	$infoset     = "Insert ".$this->session->userdata['sp']->login_name.' -> '.date('Y-m-d H:i:s');
	$data_log = array(
		'type' 	        =>	"5",
		'attempt_1'     =>	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
		'attempt_2'	    => 	$sql_insert_det,
		'info' 	        =>	$infoset,
		'created'		=>  date('Y-m-d H:i:s'),
		'created_by'	=>  $this->session->userdata['sp']->login_name
	);
	$this->Eresep_model->add_to_log($data_log);
	///////////////////LOG SYSTEM

   $fbck = "ok";

   $dataset = json_encode($fbck);

   echo $dataset;

}



public function save_eresep_racikan()

{
	$username 		= $this->session->userdata['sp']->login_name;
	$checkfrm       = $this->Eresep_model->getdatafarmasi($username);
	$set_depo    	= $checkfrm->set_depo;
	$id_eresep = $this->input->post('ideresep_rck');

	## --- data header ---

	$id_reg = $this->input->post('id_reg_rck',true);

	$id_pasien = $this->input->post('id_pasien',true);

	$now = date('Y-m-d H:i:s');







	## ---  data racikan ; headernya ------------------

	$nama_racikan 			= $this->input->post('nama_racikan',true);

	$harga 			= $this->input->post('harga',true);

	$subtotal 			= $this->input->post('subtotal',true);

	$jumlah_racikan 	= $this->input->post('jumlah_racikan',true);

	$dosis_racikan 	= $this->input->post('dosis_racikan',true);

	$frekwensi_racikan 	= $this->input->post('frekwensi_racikan',true);

	$tme_racikan 				= $this->input->post('tme_racikan',true);

	$kemasan_racikan 		= $this->input->post('kemasan_racikan',true);

	$note_racikan 			= $this->input->post('note_racikan',true);

	## contoh format : nama_racikan[0]



	## ---  data racikan detail ; detailnya ------------------

	$det_racikan_obat 	= $this->input->post('det_racikan_obat',true);

	$det_id_fa 		= $this->input->post('det_id_fa',true);

	$det_jenis_obat 		= $this->input->post('det_jenis_obat',true);

	$det_racikan_qty 		= $this->input->post('det_racikan_qty',true); 

	$det_racikan_harga 		= $this->input->post('det_racikan_harga',true);

	$det_racikan_subtotal 		= $this->input->post('det_racikan_subtotal',true);

	#$det_racikan_dosis 	= $this->input->post('det_racikan_dosis',true);





	$id_dokter_penginput = $this->session->userdata['sp']->id_dokter;

	### --- INSERT eresep ---------------------------------

	$sql_insert_header = "	INSERT INTO `soap_eresep`

																(`eresepdate`, `id_reg`, `is_eresep_pulang`,`id_dokter`)

													VALUES

																('".$now."', '".$id_reg."', '".$is_eresep_pulang."','".$id_dokter_penginput."')";

	$ok = $this->dbhis->query($sql_insert_header);





	if(isset($nama_racikan))

	{

		foreach($nama_racikan as $k => $v)

		{

			#### dibawah ini masukin header racikan di detail resep ---------

			$sql_insert_det = "INSERT INTO `soap_eresep_det`

															(`id_eresep`			, `id_trx_det`	, `name`		, `jenis_obat`								, `qty`													, `dosis`										, `tme`										, `frekwensi`										, `note`									, `is_racikan`, `set_depo`)

											VALUES 	('".$id_eresep."'	, 0							, '".$v."'	, '".$kemasan_racikan[$k]."'	, '".$jumlah_racikan[$k]."'			, '".$dosis_racikan[$k]."'	, '".$tme_racikan[$k]."'	, '".$frekwensi_racikan[$k]."'	, '".$note_racikan[$k]."'	, 1,'".$set_depo."')";

			$ok = $this->dbhis->query($sql_insert_det);



			### --- GET id_eresep ---------------------------------

			$sql 						= "SELECT LAST_INSERT_ID() as id_eresep_det";

			$query 					= $this->dbhis->query($sql);

			$rs 						= $query->row_array();

			$id_eresep_det 	= $rs['id_eresep_det'];

			foreach($det_racikan_obat[$k] as $kk => $vv)

			{



				$sql_insert_det_racikan = "INSERT INTO `soap_eresep_det_racikan` (

																		`id_eresep_det`			,`id_eresep`			,`id_trx_det`							,`name`			,`jenis_obat`										,`qty`,`harga_satuan`,`subtotal`)

													VALUES 	(	'".$id_eresep_det."','".$id_eresep."'	,'".$det_id_fa[$k][$kk]."','".$vv."'	,'".$det_jenis_obat[$k][$kk]."'	,'".$det_racikan_qty[$k][$kk]."','".$det_racikan_harga[$k][$kk]."','".$det_racikan_subtotal[$k][$kk]."')

				";

				$ok = $this->dbhis->query($sql_insert_det_racikan);

			}

		}

	}

	///////////////////LOG SYSTEM
	$infoset     = "Insert ".$this->session->userdata['sp']->login_name.' -> '.date('Y-m-d H:i:s');
	$data_log = array(
		'type' 	        =>	"5",
		'attempt_1'     =>	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
		'attempt_2'	    => 	$sql_insert_header."/".$sql_insert_det."/".$sql_insert_det_racikan,
		'info' 	        =>	$infoset,
		'created'		=>  date('Y-m-d H:i:s'),
		'created_by'	=>  $this->session->userdata['sp']->login_name
	);
	$this->Eresep_model->add_to_log($data_log);
	///////////////////LOG SYSTEM

	$fcbk = "ok";

	$dataset = json_encode($fcbk);

	echo $dataset;

}



function data_totaltagihan(){

	$id_eresep    	= $this->input->post('id_eresep');

    $datasett   	= $this->Eresep_model->data_total_tagihan($id_eresep);

    $dataset 		= json_encode($datasett);

    echo $dataset;

}



function mst_setting_harga(){

    $datasett   	= $this->Eresep_model->mst_setting_harga();

    $dataset 		= json_encode($datasett);

    echo $dataset;

}



function prosesdetailobat(){

    $id_obat    = $this->input->post('id_obat');

    $datasett   = $this->Eresep_model->detail_obatnya($id_obat);

    $row_1      = $datasett->harga_margin;



    $data = array(

        'row_1'     => $row_1

    );



    $dataset = json_encode($data);

    echo $dataset; 

}    



function detailobatnonracikan(){

    $id_eresep    	= $this->input->post('id_eresep');

    $datasett   	= $this->Eresep_model->detail_obat_eresep_nonracik($id_eresep);

    $dataset 		= json_encode($datasett);

    echo $dataset;

}



function list_detailobatnonracikan(){

    $id_eresep    	= $this->input->post('id_eresep');

    $datasett   	= $this->Eresep_model->list_detail_obat_eresep_nonracik($id_eresep);

    $dataset 		= json_encode($datasett);

    echo $dataset;

}







function get_batch_list(){
    // return list batch untuk dropdown vaksin (group id=3)
    $id_obat = $this->input->post('id_obat', true);
    if(!$id_obat){
        echo json_encode([]);
        return;
    }
    $rows = $this->Eresep_model->get_batch_list_by_obat($id_obat);
    echo json_encode($rows);
}

function deleteobatnya(){

    $id_eresep    	= $this->input->post('id_eresep_det');

    $datasett   	= $this->Eresep_model->delete_obatnya($id_eresep);

    $dataset 		= json_encode($datasett);

    echo $dataset;

}



function validasiobatnya(){
	$username 		= $this->session->userdata['sp']->login_name;
	$checkfrm       = $this->Eresep_model->getdatafarmasi($username);
	$set_depo    	= $checkfrm->set_depo;
    $id_eresep    	= $this->input->post('id_eresep_det');
    $id_batch    	= $this->input->post('id_batch');

	//setting nya

	$setting_harga = $this->Eresep_model->mst_setting_harga();

	$tuslah        = $setting_harga->tuslah;

	$jasa_racik    = $setting_harga->jasa_racik;

	//end setting nya



	//search data harga obat

	$dataobatset = $this->Eresep_model->data_obat_search($id_eresep);

	$subtotal        = $dataobatset->subtotal;

	//end search data harga obat



	$subtotal_new = ($subtotal + $tuslah);

	

	$datasett   	= $this->Eresep_model->validasi_obatnya($id_eresep,$subtotal_new,$tuslah,$jasa_racik,$set_depo,$id_batch);

    $dataset 		= json_encode($datasett);

    echo $dataset;
    
        ///////////////////LOG SYSTEM
	$infoset     = "Validasi ".$this->session->userdata['sp']->login_name.' -> '.date('Y-m-d H:i:s');
	$data_log = array(
		'type' 	        =>	"6",
		'attempt_1'     =>	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
		'attempt_2'	    => 	$id_eresep."/".$set_depo,
		'info' 	        =>	$infoset,
		'created'		=>  date('Y-m-d H:i:s'),
		'created_by'	=>  $this->session->userdata['sp']->login_name
	);
	$this->Eresep_model->add_to_log($data_log);
	///////////////////LOG SYSTEM

}



function cancelobatnya(){
	$username 		= $this->session->userdata['sp']->login_name;
	$checkfrm       = $this->Eresep_model->getdatafarmasi($username);
	$set_depo    	= $checkfrm->set_depo;
    $id_eresep    	= $this->input->post('id_eresep_det');



	//setting nya

	$setting_harga = $this->Eresep_model->mst_setting_harga();

	$tuslah        = $setting_harga->tuslah;

	//end setting nya



	//search data harga obat

	$dataobatset = $this->Eresep_model->data_obat_search($id_eresep);

	$subtotal        = $dataobatset->subtotal;

	//end search data harga obat



	$subtotal_new = ($subtotal - $tuslah);



    $datasett   	= $this->Eresep_model->cancel_obatnya($id_eresep,$subtotal_new);

    $dataset 		= json_encode($datasett);

    echo $dataset;
    
        	///////////////////LOG SYSTEM
		$infoset     = "Cancel ".$this->session->userdata['sp']->login_name.' -> '.date('Y-m-d H:i:s');
		$data_log = array(
			'type' 	        =>	"7",
			'attempt_1'     =>	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
			'attempt_2'	    => 	$id_eresep."/".$set_depo,
			'info' 	        =>	$infoset,
			'created'		=>  date('Y-m-d H:i:s'),
			'created_by'	=>  $this->session->userdata['sp']->login_name
		);
		$this->Eresep_model->add_to_log($data_log);
		///////////////////LOG SYSTEM

}





public function detailobatracikan(){

    $id_eresep    	= $this->input->post('id_eresep');

    $sql_1="SELECT 	a.*,b.*

	FROM 		soap_eresep a, soap_eresep_det b

	WHERE 	a.id_eresep=b.id_eresep

					AND a.id_eresep='".$id_eresep."'

					AND b.is_racikan=1

					AND b.status=0

					AND b.is_validasi=0

	ORDER BY a.id_eresep DESC";

    $query_1 = $this->db->query($sql_1);

    $rs_1 = $query_1->result_array();

  

    foreach($rs_1 as $k1 => $v_1){

  

    $id_eresep_det  = $v_1['id_eresep_det'];

        

    $sql_2 = "SELECT 	b.*

	FROM 		soap_eresep_det a, soap_eresep_det_racikan b

	WHERE 	a.id_eresep_det=b.id_eresep_det

					AND a.id_eresep_det='".$id_eresep_det."'";

    //echo "<pre>".$sql_2;

    $query_2 	= $this->db->query($sql_2);

    $rs2 	= $query_2->result_array();

    $rs_1[$k1]['rs_1'] = $rs2;

  

  

    }//end lvl 1

  

    echo json_encode($rs_1);

  

}



public function validasidetailobatracikan(){

    $id_eresep    	= $this->input->post('id_eresep');

    $sql_1="SELECT 	a.*,b.*

	FROM 		soap_eresep a, soap_eresep_det b

	WHERE 	a.id_eresep=b.id_eresep

					AND a.id_eresep='".$id_eresep."'

					AND b.is_racikan=1 AND b.status=0 AND b.is_validasi=1

	ORDER BY a.id_eresep DESC";

    $query_1 = $this->db->query($sql_1);

    $rs_1 = $query_1->result_array();

  

    foreach($rs_1 as $k1 => $v_1){

  

    $id_eresep_det  = $v_1['id_eresep_det'];

        

    $sql_2 = "SELECT 	b.*

	FROM 		soap_eresep_det a, soap_eresep_det_racikan b

	WHERE 	a.id_eresep_det=b.id_eresep_det

					AND a.id_eresep_det='".$id_eresep_det."'";

    //echo "<pre>".$sql_2;

    $query_2 	= $this->db->query($sql_2);

    $rs2 	= $query_2->result_array();

    $rs_1[$k1]['rs_1'] = $rs2;

  

  

    }//end lvl 1

  

    echo json_encode($rs_1);

  

}



function hapusobatnya_rck(){

    $id_eresep    	= $this->input->post('id_eresep_det');

    $datasett   	= $this->Eresep_model->hapus_obatnya_rck($id_eresep);

    $dataset 		= json_encode($datasett);

    echo $dataset;

}



function validasiobatnya_rck(){
	$username 		= $this->session->userdata['sp']->login_name;
	$checkfrm       = $this->Eresep_model->getdatafarmasi($username);
	$set_depo    	= $checkfrm->set_depo;
    $id_eresep    	= $this->input->post('id_eresep_det');

	//setting nya

	$setting_harga = $this->Eresep_model->mst_setting_harga();

	$tuslah        = $setting_harga->tuslah;

	$jasa_racik	   = $setting_harga->jasa_racik;

	//end setting nya



	//search data harga obat

	$dataobatset = $this->Eresep_model->data_obat_search_rck($id_eresep);

	foreach($dataobatset as $dataracik){

		$id_item_racikan    = $dataracik['id_eresep_det_racikan'];

		$subtotal        	= $dataracik['subtotal'];

		$subtotal_new 		= ($subtotal + $tuslah);

		$datasett2   		= $this->Eresep_model->validasi_obatnya_hrg_rck($id_item_racikan,$subtotal_new);

	}

	$qtytotal   			= $this->Eresep_model->qty_obatnya_hrg_rck($id_eresep);

	$qty_set				= $qtytotal->qty;

	$sumtotal   			= $this->Eresep_model->sum_obatnya_hrg_rck($id_eresep);

	$grandtotal_sat_set		= $sumtotal->grandtotal;

	$cal_sub_racikan		= ($qty_set * $grandtotal_sat_set)+$jasa_racik;

	$update_to_subtotal     = $this->Eresep_model->update_obatnya_hrg_rck($id_eresep,$grandtotal_sat_set,$cal_sub_racikan,$tuslah,$jasa_racik);

	//end search data harga obat



	$data_view = array(

		'id_item_racikan'	=> $id_item_racikan,

		'subtotal'			=> $subtotal,

		'subtotal_new'		=> $subtotal_new

	);





    $datasett   	= $this->Eresep_model->validasi_obatnya_rck($id_eresep,$set_depo);

    $dataset 		= json_encode($data_view);

    echo $dataset;
    
        		///////////////////LOG SYSTEM
			$infoset     = "Validasi ".$this->session->userdata['sp']->login_name.' -> '.date('Y-m-d H:i:s');
			$data_log = array(
				'type' 	        =>	"6",
				'attempt_1'     =>	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
				'attempt_2'	    => 	$id_eresep."/".$set_depo,
				'info' 	        =>	$infoset,
				'created'		=>  date('Y-m-d H:i:s'),
				'created_by'	=>  $this->session->userdata['sp']->login_name
			);
			$this->Eresep_model->add_to_log($data_log);
			///////////////////LOG SYSTEM

}



function cancelobatnya_rck(){
	$username 		= $this->session->userdata['sp']->login_name;
	$checkfrm       = $this->Eresep_model->getdatafarmasi($username);
	$set_depo    	= $checkfrm->set_depo;
    $id_eresep    	= $this->input->post('id_eresep_det');

	//setting nya

	$setting_harga = $this->Eresep_model->mst_setting_harga();

	$tuslah        = $setting_harga->tuslah;

	$racik		   = $setting_harga->jasa_racik;

	//end setting nya



	//search data harga obat

	$dataobatset = $this->Eresep_model->data_obat_search_rck($id_eresep);

	foreach($dataobatset as $dataracik){

		$id_item_racikan    = $dataracik['id_eresep_det_racikan'];

		$subtotal        	= $dataracik['subtotal'];

		$subtotal_new 		= ($subtotal - $tuslah);

		$datasett2   		= $this->Eresep_model->cancel_obatnya_hrg_rck($id_item_racikan,$subtotal_new);

	}

	$grandtotal_sat_set		= 0;

	$cal_sub_racikan		= 0;

	$tuslah_cancel          = 0;

    $jasa_racik_cancel      = 0;

	$update_to_subtotal     = $this->Eresep_model->update_obatnya_hrg_rck($id_eresep,$grandtotal_sat_set,$cal_sub_racikan,$tuslah_cancel,$jasa_racik_cancel);

	//end search data harga obat



	$data_view = array(

		'id_item_racikan'	=> $id_item_racikan,

		'subtotal'			=> $subtotal,

		'subtotal_new'		=> $subtotal_new

	);



    $datasett   	= $this->Eresep_model->cancel_obatnya_rck($id_eresep);

    $dataset 		= json_encode($data_view);

    echo $dataset;
    
        			///////////////////LOG SYSTEM
				$infoset     = "Cancel ".$this->session->userdata['sp']->login_name.' -> '.date('Y-m-d H:i:s');
				$data_log = array(
					'type' 	        =>	"7",
					'attempt_1'     =>	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
					'attempt_2'	    => 	$id_eresep."/".$set_depo,
					'info' 	        =>	$infoset,
					'created'		=>  date('Y-m-d H:i:s'),
					'created_by'	=>  $this->session->userdata['sp']->login_name
				);
				$this->Eresep_model->add_to_log($data_log);
				///////////////////LOG SYSTEM

}



function edit_nonracikan(){
	$username 		= $this->session->userdata['sp']->login_name;
	$checkfrm       = $this->Eresep_model->getdatafarmasi($username);
	$set_depo    	= $checkfrm->set_depo;
    $id_eresep    	= $this->input->post('id');

	$qty	    	= $this->input->post('qty_edit_set');

	$dat_obat   	= $this->Eresep_model->data_search_obat($id_eresep);

	$harga_satuan_set   = $dat_obat->harga_satuan;

	$harga_subtotal_set = ($harga_satuan_set * $qty);

    $datasett   	= $this->Eresep_model->edit_nonracikan($id_eresep,$qty,$harga_subtotal_set);

	$fbck			= "ok";

    $dataset 		= json_encode($fbck);

    echo $dataset;
    
        ///////////////////LOG SYSTEM
	$infoset     = "Edit ".$this->session->userdata['sp']->login_name.' -> '.date('Y-m-d H:i:s');
	$data_log = array(
		'type' 	        =>	"8",
		'attempt_1'     =>	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
		'attempt_2'	    => 	"Non Racikan /".$id_eresep."/".$set_depo,
		'info' 	        =>	$infoset,
		'created'		=>  date('Y-m-d H:i:s'),
		'created_by'	=>  $this->session->userdata['sp']->login_name
	);
	$this->Eresep_model->add_to_log($data_log);
	///////////////////LOG SYSTEM

}



function edit_racikan(){
	$username 		= $this->session->userdata['sp']->login_name;
	$checkfrm       = $this->Eresep_model->getdatafarmasi($username);
	$set_depo    	= $checkfrm->set_depo;
    $id_eresep    	= $this->input->post('id');

	$qty	    	= $this->input->post('qty_edit_set');

	$dat_obat   	= $this->Eresep_model->data_search_obat_racikan($id_eresep);

	$harga_satuan_set   = $dat_obat->harga_satuan;

	$harga_subtotal_set = ($harga_satuan_set * $qty);

    $datasett   	= $this->Eresep_model->edit_racikan($id_eresep,$qty,$harga_subtotal_set);

	$fbck			= "ok";

    $dataset 		= json_encode($fbck);

    echo $dataset;
    
        ///////////////////LOG SYSTEM
	$infoset     = "Edit ".$this->session->userdata['sp']->login_name.' -> '.date('Y-m-d H:i:s');
	$data_log = array(
		'type' 	        =>	"8",
		'attempt_1'     =>	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
		'attempt_2'	    => 	"Racikan / ".$id_eresep."/".$set_depo,
		'info' 	        =>	$infoset,
		'created'		=>  date('Y-m-d H:i:s'),
		'created_by'	=>  $this->session->userdata['sp']->login_name
	);
	$this->Eresep_model->add_to_log($data_log);
	///////////////////LOG SYSTEM

}



public function inner_get_data_autocomplet_obat()

{

		$term = $this->input->get('term',true);



		$sql = "SELECT 	a.id_fa,a.`name`,a.id_src

						FROM 		mst_farmalkes a

						WHERE 	UPPER(a.name) LIKE '%".strtoupper($term)."%'

										AND a.aktif = 1

						";

		$query = $this->dbhis->query($sql);

		$rs = $query->result_array();

		$jenis_obat[0] = 'Oral';

		$jenis_obat[1] = 'Obat Luar';

		foreach($rs as $k => $v)

		{

			$rs[$k]['jenis_obat'] = $jenis_obat[$v['id_src']];

			$rs[$k]['label'] = $v['name'];

			$rs[$k]['id'] = $v['id_fa'];

		}

		$obat = json_encode($rs);

		echo $obat;

}

public function inner_get_data_autocomplet_obat_dosis()

{

		$term = $this->input->get('term',true);



		$sql = "SELECT 	a.`id_amt` AS id

										,CONCAT(a.`amount`,' ',a.`satuan`) AS label

						FROM		`mst_farmalkes_etk_amt` a

						WHERE 	a.`aktif`=1 AND UPPER(CONCAT(a.`amount`,' ',a.`satuan`)) LIKE '%".strtoupper($term)."%'

						ORDER BY a.`satuan`,a.`amount`

						";

		$query = $this->dbhis->query($sql);

		$rs = $query->result_array();

		$dosis = json_encode($rs);

		echo $dosis;

}

public function inner_get_data_autocomplet_obat_frekwensi()

{

		$term = $this->input->get('term',true);



		$sql = "SELECT 	a.`id`,a.`name` AS label

						FROM		`mst_farmalkes_etk_day` a

						ORDER BY a.name

						";

		$query = $this->dbhis->query($sql);

		$rs = $query->result_array();

		$frekwensi = json_encode($rs);

		echo $frekwensi;

}

public function inner_get_data_autocomplet_obat_tme()

{

		$term = $this->input->get('term',true);



		$sql = "SELECT 	DISTINCT a.`id_time` AS id

										,a.`name` AS label

						FROM		`mst_farmalkes_etk_tme` a

						WHERE 	a.`aktif`=1 AND UPPER(a.`name`) LIKE '%".strtoupper($term)."%'

						ORDER BY a.`name`

						";

		$query = $this->dbhis->query($sql);

		$rs = $query->result_array();

		$tme = json_encode($rs);

		echo $tme;

}

public function inner_get_data_autocomplet_nama_dokter()

{

		$term = $this->input->get('term',true);



		$sql = "SELECT 	a.`id_dokter` AS id,a.`name` AS label

						FROM		`mst_dokter` a

						WHERE 	UPPER(a.`name`) LIKE '%".strtoupper($term)."%'

						ORDER BY a.`name`

						";

		$query = $this->dbhis->query($sql);

		$rs = $query->result_array();

		$dokter = json_encode($rs);

		echo $dokter;

}

public function save_eresep_additional()

{
	$username 		= $this->session->userdata['sp']->login_name;
	$checkfrm       = $this->Eresep_model->getdatafarmasi($username);
	$set_depo    	= $checkfrm->set_depo;
		## --- data header ---

		$id_reg = $this->input->post('id_reg',true);

		$id_pasien = $this->input->post('id_pasien',true);

		$now = date('Y-m-d H:i:s');



		$is_eresep_pulang = intval($this->input->post('is_eresep_pulang',true));



		## --- data detail ---

		$ideresep 				= $this->input->post('ideresep',true);

		$obat 					= $this->input->post('obat',true);

		$id_fa 					= $this->input->post('id_fa',true);

		$jenis_obat 			= $this->input->post('jenis_obat',true);

		$qty 					= $this->input->post('qty',true);

		$dosis 					= $this->input->post('dosis',true);

		$frekwensi 				= $this->input->post('frekwensi',true);

		$tme 					= $this->input->post('tme',true);

		$note 					= $this->input->post('note',true);



		## ---  data racikan ; headernya ------------------

		$nama_racikan 			= $this->input->post('nama_racikan',true);

		$jumlah_racikan 		= $this->input->post('jumlah_racikan',true);

		$dosis_racikan 			= $this->input->post('dosis_racikan',true);

		$frekwensi_racikan 		= $this->input->post('frekwensi_racikan',true);

		$tme_racikan 			= $this->input->post('tme_racikan',true);

		$kemasan_racikan 		= $this->input->post('kemasan_racikan',true);

		$note_racikan 			= $this->input->post('note_racikan',true);

		## contoh format : nama_racikan[0]



		## ---  data racikan detail ; detailnya ------------------

		$det_racikan_obat 		= $this->input->post('det_racikan_obat',true);

		$det_id_fa 				= $this->input->post('det_id_fa',true);

		$det_jenis_obat 		= $this->input->post('det_jenis_obat',true);

		$det_racikan_qty 		= $this->input->post('det_racikan_qty',true);

		#$det_racikan_dosis 	= $this->input->post('det_racikan_dosis',true);



		$datetime=date('Y-m-d H:i:s');



		$id_dokter_penginput = $this->session->userdata['sp']->id_dokter;

		    //set increment nya

				$datanu       	= $this->Eresep_model->dnu();

				$setnourut		= $datanu->nourut;

				$urutan 		= (int) substr($setnourut, 4, 5);

				$setincrement 	= $urutan+1;

				$increset		= date('m').date('y').sprintf("%05s", $setincrement);

				//echo "011400001"."<br>";

				//echo $increset;

			//end set increment nya



			//exit;

		### --- GET id_eresep ---------------------------------

		$id_eresep 	= $ideresep[0];

		### --- UPDATE eresep ---------------------------------

		//$deleresep_1 = "DELETE FROM soap_eresep WHERE id_eresep='$ideresep[0]'";

		//$this->dbhis->query($deleresep_1);

		$deleresep_2 = "DELETE FROM soap_eresep_det WHERE id_eresep='$id_eresep'";

		$this->dbhis->query($deleresep_2);

		$deleresep_3 = "DELETE FROM soap_eresep_det_racikan WHERE id_eresep='$id_eresep'";

		$this->dbhis->query($deleresep_3);







		### --- INSERT eresep detail ---------------------------------

		if(isset($obat)){

			foreach($obat as $k => $v){

				$sql_insert_det = "INSERT INTO `soap_eresep_det` (`id_eresep`, `id_trx_det`, `name`, `jenis_obat`, `qty`, `dosis`, `tme`, `frekwensi`, `note`) VALUES('".$id_eresep."','".$id_fa[$k]."','".$obat[$k]."','".$jenis_obat[$k]."','".$qty[$k]."','".$dosis[$k]."','".$tme[$k]."','".$frekwensi[$k]."','".$note[$k]."')";

				$this->dbhis->query($sql_insert_det);

			}

		}



		if(isset($nama_racikan)){

			foreach($nama_racikan as $k => $v){

				#### dibawah ini masukin header racikan di detail resep ---------

				$sql_insert_det = "INSERT INTO `soap_eresep_det` (`id_eresep`,`id_trx_det`,`name`,`jenis_obat`,`qty`,`dosis`,`tme`,`frekwensi`,`note`,`is_racikan`) VALUES('".$id_eresep."',0,'".$v."','".$kemasan_racikan[$k]."','".$jumlah_racikan[$k]."','".$dosis_racikan[$k]."','".$tme_racikan[$k]."','".$frekwensi_racikan[$k]."','".$note_racikan[$k]."',1)";

				$this->dbhis->query($sql_insert_det);



				### --- GET id_eresep ---------------------------------

				$sql 						= "SELECT LAST_INSERT_ID() as id_eresep_det";

				$query 					= $this->dbhis->query($sql);

				$rs 						= $query->row_array();

				$id_eresep_det 	= $rs['id_eresep_det'];

				foreach($det_racikan_obat[$k] as $kk => $vv){

					$sql_insert_det_racikan = "INSERT INTO `soap_eresep_det_racikan` (`id_eresep_det`,`id_eresep`,`id_trx_det`,`name`,`jenis_obat`,`qty`) VALUES('".$id_eresep_det."','".$id_eresep."','".$det_id_fa[$k][$kk]."','".$vv."','".$det_jenis_obat[$k][$kk]."','".$det_racikan_qty[$k][$kk]."')";

					$this->dbhis->query($sql_insert_det_racikan);

				}

			}//exit;

		}

		//echo "<script language=\"javascript\">swal.fire({title: 'Good job', text: 'You clicked the button!', type: 'success'}).then(function(){ location.reload();});</script>";

		//echo "<script language=\"javascript\">location.reload();</script>";
		
					///////////////////LOG SYSTEM
			$infoset     = "INSERT ".$this->session->userdata['sp']->login_name.' -> '.date('Y-m-d H:i:s');
			$data_log = array(
				'type' 	        =>	"5",
				'attempt_1'     =>	(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
				'attempt_2'	    => 	"E-ERESEP BYPASS / ".$id_eresep."/".$set_depo,
				'info' 	        =>	$infoset,
				'created'		=>  date('Y-m-d H:i:s'),
				'created_by'	=>  $this->session->userdata['sp']->login_name
			);
			$this->Eresep_model->add_to_log($data_log);
			///////////////////LOG SYSTEM

		echo "<script language=\"javascript\">swal.fire('Berhasil!','Resep Berhasil Dibuat!', 'success')</script>";

		echo $this->add_additional($id_reg,$id_pasien);

}

//////////////////////////////////////

}

/* End of file Soap_eresep.php */

