<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Op_order extends MX_Controller {
	var $session_name='sp';
	var $start = 0;

	function __construct() {
		parent::__construct();
		#if($session_name !='') $this->check_session($session_name);
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');

		$this->load->model('Op_order_model','mdl');
  }

   function edit_op_order($id_reg,$id_pasien){
     	$this->make_bread->add('List Pasien', '', 1);
        $this->make_bread->add('Kamar Operasi', '', 0);
        $mstTrx_edit = $this->mdl->mst_trx_edit_tpp($id_reg);
        $id_role	= $this->session->userdata['sp']->id_role;
        $sql_dokter   = " SELECT MD.`id_dokter`, MD.`name` FROM mst_dokter MD WHERE MD.`aktif` = 1 ORDER BY MD.`name`";
    	$dokter_list = $this->formgenerator->get_dropdown('id_dokter', $sql_dokter, $readmode = false, $onChange = '');
        $breadcrumb = $this->make_bread->output();
       	$row 	   = $this->mdl->get_data_registrasi_by_id_reg($id_reg);
		$date 		= $this->input->post('awal',date('Y-m-d'));
		$sql_tindakan ="SELECT MT.id_act, MT.name
		FROM mst_tindakan MT
		LEFT JOIN mst_tindakan_grup MTG ON MTG.id_group=MT.id_group
		LEFT JOIN mst_tindakan_subgrup MTS ON MTS.id_subgroup=MT.id_subgroup
		WHERE MT.`aktif` = 1 AND UPPER(MTG.`name`) LIKE '%OPERASI%'
		ORDER BY  MTG.`name`, MT.name";

    $list_tindakan=$this->formgenerator->get_dropdown('id_act', $sql_tindakan, $selected_id='', $readmode=false, $onChange='',$selected_db='dbhis');

    $sql_poliklinik = " SELECT MU.`id_unit`, MU.`name` FROM mst_unit MU WHERE MU.`aktif` = 1 ORDER BY MU.`name`";
    $list_poliklinik= $this->formgenerator->get_dropdown('id_unit[]', $sql_poliklinik, $selected_id='', $readmode=false, $onChange='');

    $sql="SELECT a.*,b.* FROM `transaksi_pendaftaran` a LEFT JOIN `mst_dokter` b ON a.dpjp=b.id_dokter WHERE a.`id_pasien` = '".$id_pasien."'";
		//echo "<pre>".$sql."</pre>";
		$query=$this->dbhis->query($sql);
		$data_row=array();

		foreach($query->result_array() as $rs) {
		$data_row[]	=$rs;
	}

	//$list_order_op 	   = $this->mdl->list_order_operasi($id_pasien);

    $data=array(
    	 'mstTrx_edit'           => $mstTrx_edit,
    	'id_role' => $id_role,
    	'dokter_list' => $dokter_list,
      'data_row'		=> $data_row,
      'id_reg'			=> $id_reg,
	  'date'			=> $date,
	  'list_tindakan'	=> $list_tindakan,
	  'list_poliklinik'	=> $list_poliklinik,
	  'breadcrumb'    => $breadcrumb,
	  //'list_order_op'	=> $list_order_op,
		);
  
           $this->load->view('v_edit_op_order',$data);
       }
     //ranap

       public function content_op_tpp($id_reg,$id_pasien)
	{
		$date 		= $this->input->post('awal',date('Y-m-d'));
		$sql_tindakan ="SELECT MT.id_act, MT.name
		FROM mst_tindakan MT
		LEFT JOIN mst_tindakan_grup MTG ON MTG.id_group=MT.id_group
		LEFT JOIN mst_tindakan_subgrup MTS ON MTS.id_subgroup=MT.id_subgroup
		WHERE MT.`aktif` = 1 AND UPPER(MTG.`name`) LIKE '%OPERASI%'
		ORDER BY  MTG.`name`, MT.name";

    $list_tindakan=$this->formgenerator->get_dropdown('id_act', $sql_tindakan, $selected_id='', $readmode=false, $onChange='',$selected_db='dbhis');

    $sql_poliklinik = " SELECT MU.`id_unit`, MU.`name` FROM mst_unit MU WHERE MU.`aktif` = 1 ORDER BY MU.`name`";
    $list_poliklinik= $this->formgenerator->get_dropdown('id_unit[]', $sql_poliklinik, $selected_id='', $readmode=false, $onChange='');

  //  $sql="SELECT a.*,b.* FROM `emolen_transaksi_pendaftaran` a LEFT JOIN `mst_dokter` b ON a.dpjp=b.id_dokter WHERE a.`id_pasien` = '".$id_pasien."'";
  $sql="SELECT a.*,b.* FROM `transaksi_pendaftaran` a LEFT JOIN `mst_dokter` b ON a.dpjp=b.id_dokter WHERE a.`id_pasien` = '".$id_pasien."'";
		//echo "<pre>".$sql."</pre>";
		$query=$this->dbhis->query($sql);
		$data_row=array();

		foreach($query->result_array() as $rs) {
		$data_row[]	=$rs;
	}

	//$list_order_op 	   = $this->mdl->list_order_operasi($id_pasien);

    $data=array(
      'data_row'		=> $data_row,
      'id_reg'			=> $id_reg,
	  'date'			=> $date,
	  'list_tindakan'	=> $list_tindakan,
	  'list_poliklinik'	=> $list_poliklinik,
	  //'list_order_op'	=> $list_order_op,
		);

    $this->load->view('vop_order_tpp',$data);
	}

	public function content_op($id_reg,$id_pasien)
	{
		$row 	   = $this->mdl->get_data_registrasi_by_id_reg($id_reg);
		$date 		= $this->input->post('awal',date('Y-m-d'));
		$sql_tindakan ="SELECT MT.id_act, MT.name
		FROM mst_tindakan MT
		LEFT JOIN mst_tindakan_grup MTG ON MTG.id_group=MT.id_group
		LEFT JOIN mst_tindakan_subgrup MTS ON MTS.id_subgroup=MT.id_subgroup
		WHERE MT.`aktif` = 1 AND UPPER(MTG.`name`) LIKE '%OPERASI%'
		ORDER BY  MTG.`name`, MT.name";

    $list_tindakan=$this->formgenerator->get_dropdown('id_act', $sql_tindakan, $selected_id='', $readmode=false, $onChange='',$selected_db='dbhis');

    $sql_poliklinik = " SELECT MU.`id_unit`, MU.`name` FROM mst_unit MU WHERE MU.`aktif` = 1 ORDER BY MU.`name`";
    $list_poliklinik= $this->formgenerator->get_dropdown('id_unit[]', $sql_poliklinik, $selected_id='', $readmode=false, $onChange='');

    $sql="SELECT a.*,b.* FROM `transaksi_pendaftaran` a LEFT JOIN `mst_dokter` b ON a.dpjp=b.id_dokter WHERE a.`id_pasien` = '".$id_pasien."'";
		//echo "<pre>".$sql."</pre>";
		$query=$this->dbhis->query($sql);
		$data_row=array();

		foreach($query->result_array() as $rs) {
		$data_row[]	=$rs;
	}

	//$list_order_op 	   = $this->mdl->list_order_operasi($id_pasien);

    $data=array(
      'data_row'		=> $data_row,
      'id_reg'			=> $id_reg,
	  'date'			=> $date,
	  'list_tindakan'	=> $list_tindakan,
	  'list_poliklinik'	=> $list_poliklinik,
	  //'list_order_op'	=> $list_order_op,
		);

    $this->load->view('vop_order',$data);
	}




	public function seve_order_op($id_reg)
	{
		$cdb	   = @$this->session->userdata['sp']->login_name;
		$row 	   = $this->mdl->get_data_registrasi_by_id_reg($id_reg);

		$telp      = $row['hp'];
		$hp        = $row['telp'];
		$id_pasien = $row['id_pasien'];
		$id_units = $row['id_unit'];
		$no_telp_pasien = "";
		$ulangtaun=$row['tgl_lahir'];
		$date=date_create("$ulangtaun");
		$tgllhr=date_format($date,"Y-m-d");	

		$row_check_unit 	   = $this->mdl->get_mst_unit($id_units);
		$nama_unit=$row_check_unit->name;

		$id_act_post=$this->input->post('id_act');

		$row_check_nama_tindakan 	   = $this->mdl->get_mst_tindakan($id_act_post);
		$nama_tindakan=$row_check_nama_tindakan->name;

		if (!empty($hp)) {
			$no_telp_pasien = $hp; //$datas['no_telp_pasien'];
		} else if (!empty($telp)) {
			$no_telp_pasien = $telp;
		}

		//kondisi dpjp jika kosong
		if(empty($row['dokter'])){
			$dpjp_var="1";
		}else{
			$dpjp_var=$row['dokter'];

		}
		//end kondisi dpjp kosong

		$data_pendaftaran = array(
			'id_pasien'				=> $id_pasien,
			'no_rekam_medis'		=> $id_reg,
			'nama_pasien'			=> $row['nama_pasien'],
			'usia_pasien'			=> $tgllhr,
			'asal_pasien'			=> 'RAJAL-'.$nama_unit,
			'no_telp_pasien'		=> $no_telp_pasien,
			'alamat_pasien'			=> $row['alamat'],
			'asuransi_pasien'		=> $row['asuransi'],
			'diagnosa'				=> $this->input->post('diagnosa'),
			'tindakan'				=> $this->input->post('tindakan_op'),
			'jenis_anastesi'		=> '',
			'sewa_alat'				=> $this->input->post('sewa_alat'),
			'dokter_anastesi'		=> '',
      		'dokter_resus' 			=> '',
      		'dokter_operator_scnd' 	=> '',
			'rencana_operasi' 		=> $this->input->post('awal'),
			'dpjp' 					=> $dpjp_var,
			'kamar_rawat'			=> '',
			'cdd'					=> date('Y-m-d H:i:s'),
			'cdb'					=> 'Dokter',
			);
			$this->mdl->insert_reg_op($data_pendaftaran,'transaksi_pendaftaran');

			$row_1 	   = $this->mdl->id_pendaftaran_id($id_reg);

			$id_pend      = $row_1['id_pendaftaran'];

			$id_pendaftaran		= $id_reg;
			$list_polikliniks 	= $this->input->post('id_unit');
			$dokter_poliklinik  = $this->input->post('dokter_poliklinik');
			$tgl_konsultasi 	= $this->input->post('tgl_konsultasi');
			/*
				//$count=0;
				if($rows<>0){
					$count++;
				}
				//echo 'Total:' .  $count;exit;
				*/
			foreach($list_polikliniks as $rows){


				$sql_unit ="SELECT MU.`id_unit`, MU.`name` as name_poli_emolen FROM mst_unit MU  WHERE MU.`aktif` = 1 AND MU.`id_unit`='$rows' ORDER BY MU.`name`";
				//echo "<pre>".$sql_unit."</pre>"."<br>";//exit;
				$query_unit = $this->dbhis->query($sql_unit);
				$data_row_unit = $query_unit->result_array();

foreach($data_row_unit as $rowso){
				$data_konsultasi = array(
					'id_pendaftaran'		=> $id_pend,
					'nama_poliklinik'		=> $rowso['name_poli_emolen'],
					'dokter_poliklinik'	    => '',
					'tgl_konsultasi'		=> date('Y-m-d'),
					'cdd'				    => date('Y-m-d H:i:s'),
					'cdb'					=> $cdb,
					);

			$this->mdl->insert_konsul_op($data_konsultasi,'transaksi_konsultasi');
			}
		}
		//}//end rowso
			$this->mdl->delete_konsultasi_id_kosong();

			redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$id_pasien);
			//echo json_encode(array("status" => true));
	}

	public function seve_edit_order_op($id_reg)
	{
		$cdb	   = @$this->session->userdata['sp']->login_name;
		$row 	   = $this->mdl->get_data_registrasi_by_id_reg($id_reg);

		$telp      = $row['hp'];
		$hp        = $row['telp'];
		$id_pasien = $row['id_pasien'];
		$id_units = $row['id_unit'];
		$no_telp_pasien = "";
		$ulangtaun=$row['tgl_lahir'];
		$date=date_create("$ulangtaun");
		$tgllhr=date_format($date,"Y-m-d");	

		$row_check_unit 	   = $this->mdl->get_mst_unit($id_units);
		$nama_unit=$row_check_unit->name;

		$id_act_post=$this->input->post('id_act');

		$row_check_nama_tindakan 	   = $this->mdl->get_mst_tindakan($id_act_post);
		$nama_tindakan=$row_check_nama_tindakan->name;

		if (!empty($hp)) {
			$no_telp_pasien = $hp; //$datas['no_telp_pasien'];
		} else if (!empty($telp)) {
			$no_telp_pasien = $telp;
		}

		//kondisi dpjp jika kosong
		if(empty($row['dokter'])){
			$dpjp_var="1";
		}else{
			$dpjp_var=$row['dokter'];

		}
		//end kondisi dpjp kosong

		$data_pendaftaran = array(
			'id_pasien'				=> $id_pasien,
			'no_rekam_medis'		=> $id_reg,
			'nama_pasien'			=> $row['nama_pasien'],
			'usia_pasien'			=> $tgllhr,
			'asal_pasien'			=> 'RAJAL-'.$nama_unit,
			'no_telp_pasien'		=> $no_telp_pasien,
			'alamat_pasien'			=> $row['alamat'],
			'asuransi_pasien'		=> $row['asuransi'],
			'diagnosa'				=> $this->input->post('diagnosa'),			
			'tindakan'				=> $this->input->post('tindakan_op'),
			'jenis_anastesi'		=> '',
			'sewa_alat'				=> $this->input->post('sewa_alat'),
			'dokter_anastesi'		=> '',
      		'dokter_resus' 			=> '',
      		'dokter_operator_scnd' 	=> '',
			'rencana_operasi' 		=> $this->input->post('awal'),
			'dpjp' 					=> $dpjp_var,
			'kamar_rawat'			=> '',
			'cdd'					=> date('Y-m-d H:i:s'),
			'cdb'					=> 'Dokter',
			);

			$where = array(
        			'no_rekam_medis' => $id_reg,
    		);
    			$this->mdl->update_data($where,$data_pendaftaran,'transaksi_pendaftaran');

			$row_1 	   = $this->mdl->id_pendaftaran_id($id_reg);

			$id_pend      = $row_1['id_pendaftaran'];

			$id_pendaftaran		= $id_reg;
			$list_polikliniks 	= $this->input->post('id_unit');
			$dokter_poliklinik  = $this->input->post('dokter_poliklinik');
			$tgl_konsultasi 	= $this->input->post('tgl_konsultasi');
			/*
				//$count=0;
				if($rows<>0){
					$count++;
				}
				//echo 'Total:' .  $count;exit;
				*/
			foreach($list_polikliniks as $rows){


				$sql_unit ="SELECT MU.`id_unit`, MU.`name` as name_poli_emolen FROM mst_unit MU  WHERE MU.`aktif` = 1 AND MU.`id_unit`='$rows' ORDER BY MU.`name`";
				//echo "<pre>".$sql_unit."</pre>"."<br>";//exit;
				$query_unit = $this->dbhis->query($sql_unit);
				$data_row_unit = $query_unit->result_array();

foreach($data_row_unit as $rowso){
				$data_konsultasi = array(
					'id_pendaftaran'		=> $id_pend,
					'nama_poliklinik'		=> $rowso['name_poli_emolen'],
					'dokter_poliklinik'	    => '',
					'tgl_konsultasi'		=> date('Y-m-d'),
					'cdd'				    => date('Y-m-d H:i:s'),
					'cdb'					=> $cdb,
					);

				$where = array(
        			'no_rekam_medis' => $id_reg,
    			);
    			$this->mdl->update_data($where,$data_konsultasi,'transaksi_konsultasi');

			$this->mdl->insert_konsul_op($data_konsultasi,'transaksi_konsultasi');
			}
		}
		//}//end rowso
			$this->mdl->delete_konsultasi_id_kosong();

			redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$id_pasien);
			//echo json_encode(array("status" => true));
	}

	function delete_asm($id_pend) {
		$this->mdl->delete_op_id($id_pend);
		$this->mdl->delete_konsultasi_id_kosong($id_pend);
		redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
	}
	
	function view_formorderop($id_pend){
		$row_konsultasi          = $this->mdl->views_formorderop_konsul($id_pend);
		$row_view 	   = $this->mdl->views_formorderop($id_pend);
		$data_konsultasi_view = array(
			'row_view'				=> $row_view,
			'row_konsultasi'		=> $row_konsultasi,

		);


		$this->load->view('vop_order_2',$data_konsultasi_view);
	}

	public function inner_get_data_autocomplet_tindakan()
	{
		$term = $this->input->get('term',true);

		$sql = "SELECT MT.id_act, MT.name
                          FROM mst_tindakan MT
                          LEFT JOIN mst_tindakan_grup MTG ON MTG.id_group=MT.id_group
                          LEFT JOIN mst_tindakan_subgrup MTS ON MTS.id_subgroup=MT.id_subgroup
                          WHERE MT.`aktif` = 1 AND MTG.`id_group` IN ('9','10','12','13','15','16','18','19','20','21')  
                          AND UPPER(MT.`name`) LIKE '%".strtoupper($term)."%'                    
						";
		$query = $this->dbhis->query($sql);
		$rs = $query->result_array();		
		foreach($rs as $k => $v)
		{		

			$rs[$k]['label'] = $v['name'];
			$rs[$k]['id'] = $v['id_act'];
		}
		$tindakan = json_encode($rs);
		echo $tindakan;
	}
						/*SELECT MT.id_act, MT.name
                          FROM mst_tindakan MT
                          LEFT JOIN mst_tindakan_grup MTG ON MTG.id_group=MT.id_group
                          LEFT JOIN mst_tindakan_subgrup MTS ON MTS.id_subgroup=MT.id_subgroup
                          WHERE MT.`aktif` = 1 AND UPPER(MTG.`name`) LIKE '%OPERASI%'
                          ORDER BY  MTG.`name`, MT.name
						*/
    public function seve_order_op_tpp($id_reg)
	{
		$cdb	   = @$this->session->userdata['sp']->login_name;
		$row 	   = $this->mdl->get_data_registrasi_by_id_reg($id_reg);

		$telp      = $row['hp'];
		$hp        = $row['telp'];
		$id_pasien = $row['id_pasien'];
		$id_units = $row['id_unit'];
		$no_telp_pasien = "";
		$ulangtaun=$row['tgl_lahir'];
		$date=date_create("$ulangtaun");
		$tgllhr=date_format($date,"Y-m-d");	

		$row_check_unit 	   = $this->mdl->get_mst_unit($id_units);
		$nama_unit=$row_check_unit->name;

		$id_act_post=$this->input->post('id_act');

		$row_check_nama_tindakan 	   = $this->mdl->get_mst_tindakan($id_act_post);
		$nama_tindakan=$row_check_nama_tindakan->name;

		if (!empty($hp)) {
			$no_telp_pasien = $hp; //$datas['no_telp_pasien'];
		} else if (!empty($telp)) {
			$no_telp_pasien = $telp;
		}

		$data_pendaftaran = array(
			'id_pasien'				=> $id_pasien,
			'no_rekam_medis'		=> $id_reg,
			'nama_pasien'			=> $row['nama_pasien'],
			'usia_pasien'			=> $tgllhr,
			'asal_pasien'			=> 'RAJAL-'.$nama_unit,
			'no_telp_pasien'		=> $no_telp_pasien,
			'alamat_pasien'			=> $row['alamat'],
			'asuransi_pasien'		=> $row['asuransi'],
			'diagnosa'				=> $this->input->post('diagnosa'),
			'tindakan'				=> $nama_tindakan,
			'jenis_anastesi'		=> '',
			'sewa_alat'				=> $this->input->post('sewa_alat'),
			'dokter_anastesi'		=> '',
      		'dokter_resus' 			=> '',
      		'dokter_operator_scnd' 	=> '',
			'rencana_operasi' 		=> $this->input->post('awal'),
			'dpjp' 					=> $row['dokter'],
			'kamar_rawat'			=> '',
			'cdd'					=> date('Y-m-d H:i:s'),
			'cdb'					=> 'Dokter',
			);
		//	$this->mdl->insert_reg_op($data_pendaftaran,'emolen_transaksi_pendaftaran');
			$this->mdl->insert_reg_op($data_pendaftaran,'transaksi_pendaftaran');

			$row_1 	   = $this->mdl->id_pendaftaran_id($id_reg);

			$id_pend      = $row_1['id_pendaftaran'];

			$id_pendaftaran		= $id_reg;
			$list_polikliniks 	= $this->input->post('id_unit');
			$dokter_poliklinik  = $this->input->post('dokter_poliklinik');
			$tgl_konsultasi 	= $this->input->post('tgl_konsultasi');
			/*
				//$count=0;
				if($rows<>0){
					$count++;
				}
				//echo 'Total:' .  $count;exit;
				*/
			foreach($list_polikliniks as $rows){


				$sql_unit ="SELECT MU.`id_unit`, MU.`name` as name_poli_emolen FROM mst_unit MU  WHERE MU.`aktif` = 1 AND MU.`id_unit`='$rows' ORDER BY MU.`name`";
				//echo "<pre>".$sql_unit."</pre>"."<br>";//exit;
				$query_unit = $this->dbhis->query($sql_unit);
				$data_row_unit = $query_unit->result_array();

foreach($data_row_unit as $rowso){
				$data_konsultasi = array(
					'id_pendaftaran'		=> $id_pend,
					'nama_poliklinik'		=> $rowso['name_poli_emolen'],
					'dokter_poliklinik'	    => '',
					'tgl_konsultasi'		=> date('Y-m-d'),
					'cdd'				    => date('Y-m-d H:i:s'),
					'cdb'					=> $cdb,
					);

	//		$this->mdl->insert_konsul_op($data_konsultasi,'emolen_transaksi_konsultasi');
			$this->mdl->insert_konsul_op($data_konsultasi,'transaksi_konsultasi');
			}
		}
		//}//end rowso
			$this->mdl->delete_konsultasi_id_kosong();

			redirect('soap/epoli/pasien_list_operasi/'.$id_reg.'/'.$id_pasien);
			//echo json_encode(array("status" => true));
	}
}

