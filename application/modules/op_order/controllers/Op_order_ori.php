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

  public function content_op($id_reg,$id_pasien)
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
		
    $sql="SELECT a.*,b.* FROM `emolen_transaksi_pendaftaran` a LEFT JOIN `mst_dokter` b ON a.dpjp=b.id_dokter WHERE a.`id_pasien` = '".$id_pasien."'";
		//echo "<pre>".$sql."</pre>";
		$query=$this->dbsupp->query($sql);
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
		$no_telp_pasien = "";
	
		if (!empty($hp)) {
			$no_telp_pasien = $hp; //$datas['no_telp_pasien'];
		} else if (!empty($telp)) {
			$no_telp_pasien = $telp;
		}
		
		$data_pendaftaran = array(
			'id_pasien'				=> $id_pasien,
			'no_rekam_medis'		=> $id_reg,
			'nama_pasien'			=> $row['nama_pasien'],
			'usia_pasien'			=> $row['tgl_lahir'],
			'asal_pasien'			=> 'RAJAL',
			'no_telp_pasien'		=> $no_telp_pasien,
			'alamat_pasien'			=> $row['alamat'],
			'asuransi_pasien'		=> $row['asuransi'],
			'diagnosa'				=> $this->input->post('diagnosa'),
			'tindakan'				=> $this->input->post('id_act'),
			'jenis_anastesi'		=> '',
			'sewa_alat'				=> $this->input->post('sewa_alat'),
			'dokter_anastesi'		=> '',
      		'dokter_resus' 			=> '',
      		'dokter_operator_scnd' 	=> '',
			'rencana_operasi' 		=> $this->input->post('awal'),
			'dpjp' 					=> $row['id_dokter'], 
			'kamar_rawat'			=> '', 
			'cdd'					=> date('Y-m-d H:i:s'),
			'cdb'					=> $cdb,
			);
			$this->mdl->insert_reg_op($data_pendaftaran,'emolen_transaksi_pendaftaran');

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
				
			$this->mdl->insert_konsul_op($data_konsultasi,'emolen_transaksi_konsultasi');
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
}

