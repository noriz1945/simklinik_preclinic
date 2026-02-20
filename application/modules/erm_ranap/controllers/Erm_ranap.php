<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Erm_ranap extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		#if($session_name !='') $this->check_session($session_name);
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');

		$this->load->model('Erm_ranap_model','mdl');
  }

  public function index()
  {
    $this->make_bread->add('Rawat Inap', '', 1);
    $this->make_bread->add('e-Ranap', '', 0);
    $breadcrumb = $this->make_bread->output();

    $rs = $this->mdl->list_pasien_ranap();

    //print_r($data_row);
    $data = array(
      'breadcrumb'  => $breadcrumb,
      'rs'          => $rs,
    );

    $this->load->view('vlist_pasien_ranap', $data);
  }

  function erm_header($id_reg)
  {
    $rs = $this->mdl->data_pasien_ranap($id_reg);
		$id_pasien 		= $rs->id_pasien;
		$umur = $this->smartlib->get_umur($id_pasien);
    $data   = array(
      'rs'  => $rs,
			'umur'					=> $umur,
    );
    return $this->load->view('verm_header', $data, true);
  }

  public function main_content($id_reg)
  {
    $this->make_bread->add('Rawat Inap', '', 1);
    $this->make_bread->add('e-Ranap', '', 0);
    $breadcrumb = $this->make_bread->output();

    $header = $this->erm_header($id_reg);

    //print_r($data_row);
		$row	= $this->smartlib->get_data_pasien_by_id_reg($id_reg);
		$id_pasien	= $row['id_pasien'];

    $data = array(
      'breadcrumb'  => $breadcrumb,
      'header'      => $header,
			'id_reg'			=> $id_reg,
			'id_pasien'		=> $id_pasien,
    );

    $this->load->view('verm_main_content', $data);
  }

  public function asm_ranap($id_reg)
  {
		$this->erm_header($id_reg);
		$data_pasien	= $this->smartlib->get_data_pasien_by_id_reg($id_reg);
		$id_pasien = $data_pasien['id_pasien'];

		$riwayat_pasien	= $this->smartlib->riwayat_pasien($id_pasien);

		$row = $this->mdl->get_data_asm_ri_dokter($id_reg);
		$sql_command = ($row['id_asmri']=='') ? 'insert' : 'update' ;

		#print_r($row);
		if(empty($arr_ten)) $arr_ten = array('','','','','');
		if(empty($arr_ten_text)) $arr_ten_text = array('','','','','');
		if(empty($arr_nine)) $arr_nine = array('','','','','');
		if(empty($arr_nine_text)) $arr_nine_text = array('','','','','');

		if($sql_command=='update')
		{
			if($row['diag_medis_banding_text']!='')
				$arr_ten_text = explode(';',$row['diag_medis_banding_text']);
			if($row['diag_medis_banding']!='')
				$arr_ten = explode(';',$row['diag_medis_banding']);
			if($row['planning_text']!='')
				$arr_nine_text = explode(';',$row['planning_text']);
			if($row['planning']!='')
				$arr_nine = explode(';',$row['planning']);

		}
    $data = array(
			'id_reg'				=> $id_reg,
			'id_pasien'			=> $id_pasien,
			'row'						=> $row,
			'sql_command'		=> $sql_command,
			'data_pasien'		=> $data_pasien,
			'arr_ten_text'	=> $arr_ten_text,
			'arr_ten'				=> $arr_ten,
			'arr_nine_text'	=> $arr_nine_text,
			'arr_nine'			=> $arr_nine,
			'riwayat_pasien'=> $riwayat_pasien,
    );
    $this->load->view('vmain_asm_awal',$data);
  }

	public function cppt_ranap($id_reg)
	{
		$id_role  = @$this->session->userdata['sp']->id_role;
    $rs = $this->mdl->get_list_cppt_ri($id_reg);
    $data = array(
			'id_reg'	=> $id_reg,
      'rs'      => $rs,
			'id_role'  => $id_role,
    );
    $this->load->view('vlist_cppt_ranap', $data);
	}

	public function add_cppt($id_reg,$id_asmri='')
  {
		$data_pasien	= $this->smartlib->get_data_pasien_by_id_reg($id_reg);
		$id_pasien = $data_pasien['id_pasien'];

		$riwayat_pasien	= $this->smartlib->riwayat_pasien($id_pasien);

		$row = $this->mdl->get_data_cppt_ri($id_reg,$id_asmri);
		$sql_command = ($row['id_asmri']=='') ? 'insert' : 'update' ;

		#print_r($row);
		if(empty($arr_ten)) $arr_ten = array('','','','','');
		if(empty($arr_ten_text)) $arr_ten_text = array('','','','','');
		if(empty($arr_nine)) $arr_nine = array('','','','','');
		if(empty($arr_nine_text)) $arr_nine_text = array('','','','','');

		if($sql_command=='update')
		{
			if($row['diag_medis_banding_text']!='')
				$arr_ten_text = explode(';',$row['diag_medis_banding_text']);
			if($row['diag_medis_banding']!='')
				$arr_ten = explode(';',$row['diag_medis_banding']);
			if($row['planning_text']!='')
				$arr_nine_text = explode(';',$row['planning_text']);
			if($row['planning']!='')
				$arr_nine = explode(';',$row['planning']);

			/*
			if(empty($arr_ten)) $arr_ten = array('','','','','');
			if(empty($arr_ten_text)) $arr_ten = array('','','','','');
			if(empty($arr_nine)) $arr_ten = array('','','','','');
			if(empty($arr_nine_text)) $arr_ten = array('','','','','');
			*/
		}
    $data = array(
			'id_reg'			=> $id_reg,
			'id_pasien'		=> $id_pasien,
			'row'					=> $row,
			'sql_command'	=> $sql_command,
			'data_pasien'	=> $data_pasien,
			'arr_ten_text'	=> $arr_ten_text,
			'arr_ten'				=> $arr_ten,
			'arr_nine_text'	=> $arr_nine_text,
			'arr_nine'			=> $arr_nine,
			'riwayat_pasien'=> $riwayat_pasien,
    );
    $this->load->view('vmain_cppt_ranap',$data);
  }

	public function act_asm_ranap($id_reg)
  {
		#return $this->save_drawing($id_reg);

		$id_doc  = "035";
    if ($id_doc != NULL) {
      $id_dokter = $id_doc;
    } else {
      $id_dokter = '';
    }
		$creator    = "Test";

		$data_pasien	= $this->smartlib->get_data_pasien_by_id_reg($id_reg);

		// ASSESMENT
		$name_icd_ten = $this->input->post('name_icd_ten');
		$diag_medis_banding_text = implode(';',$name_icd_ten);

		$id_icd_ten = $this->input->post('id_icd_ten');
		$diag_medis_banding = implode(';',$id_icd_ten);

		// PLANNING
		$name_icd_nine = $this->input->post('name_icd_nine');
		$planning_text = implode(';',$name_icd_nine);

		$id_icd_nine = $this->input->post('id_icd_nine');
		$planning = implode(';',$id_icd_nine);

    $data = array(
			#'id_asmri'          => $rs['id_asmri'],
      'asmri_date'				=> date('Y-m-d H:i:s'),
			'regdate'           => $data_pasien['regdate'],
			'tgl_pengkajian'    => $this->input->post('tgl_pengkajian'),
			'asal_masuk'        => $this->input->post('asal_masuk'),
			'cara_masuk'        => $this->input->post('cara_masuk'),

			'id_reg'            => $id_reg,
			'id_pasien'         => $data_pasien['id_pasien'],
      'nama_pasien'       => $data_pasien['name'],
      'id_dokter'         => $id_dokter,
      'id_type'           => '2',
			'jenis_asm'         => 'DOKTER',
			'kategori'	        => $this->input->post('kategori'),

			// SUBJECTIVE START
			'keluhan_utama'         	=> $this->input->post('keluhan_utama'),
			'riwayat_sakit'						=> $this->input->post('riwayat_sakit'),
			'riwayat_sakit_dulu'     	=> $this->input->post('riwayat_sakit_dulu'),
			'riwayat_pengobatan'     	=> $this->input->post('riwayat_pengobatan'),
			'riwayat_sakit_keluarga' 	=> $this->input->post('riwayat_sakit_keluarga'),
			'riwayat_alergi'         	=> $this->input->post('riwayat_alergi'),
			// SUBJECTIVE END

			// OBJECTIVE START
			'objective' => $this->input->post('objective'),

			'kesadaran'    	=> $this->input->post('kesadaran'),
			'keadaan_umum' 	=> $this->input->post('keadaan_umum'),
			'td'         		=> $this->input->post('td'),
			'gcs'         	=> $this->input->post('gcs'),
			'nadi'         	=> $this->input->post('nadi'),
			'suhu'         	=> $this->input->post('suhu'),
			'nafas'         => $this->input->post('nafas'),
			'reaksi_cahaya' => $this->input->post('reaksi_cahaya'),
			'tinggi'        => $this->input->post('tinggi'),
			'berat'         => $this->input->post('berat'),
			// OBJECTIVE END

			// ASSESMENT
			'diag_medis_banding'	=> $diag_medis_banding,
			'diag_medis_banding_text'	=> $diag_medis_banding_text,
			// ASSESMENT END

			// PLANNING
			'planning'			=> $planning,
			'planning_text'	=> $planning_text,
			'p_instruksi'	=> $this->input->post('p_instruksi'),
			// PLANNING END

      'created'	=> date('Y-m-d H:i:s'),
      'creator' => $creator,
      'updated' => 'null',
      'updator' => 'null',
    );

		$data_update = array(
			#'id_asmri'          => $rs['id_asmri'],
      #'asmri_date'				=> date('Y-m-d H:i:s'),
			'regdate'           => $data_pasien['regdate'],
			'tgl_pengkajian'    => $this->input->post('tgl_pengkajian'),
			'asal_masuk'        => $this->input->post('asal_masuk'),
			'cara_masuk'        => $this->input->post('cara_masuk'),

			'id_reg'            => $id_reg,
			'id_pasien'         => $data_pasien['id_pasien'],
      'nama_pasien'       => $data_pasien['name'],
      'id_dokter'         => $id_dokter,
      'id_type'           => '2',
			'jenis_asm'         => 'DOKTER',
			'kategori'	        => $this->input->post('kategori'),

			// SUBJECTIVE START
			'keluhan_utama'         	=> $this->input->post('keluhan_utama'),
			'riwayat_sakit'						=> $this->input->post('riwayat_sakit'),
			'riwayat_sakit_dulu'     	=> $this->input->post('riwayat_sakit_dulu'),
			'riwayat_pengobatan'     	=> $this->input->post('riwayat_pengobatan'),
			'riwayat_sakit_keluarga' 	=> $this->input->post('riwayat_sakit_keluarga'),
			'riwayat_alergi'         	=> $this->input->post('riwayat_alergi'),
			// SUBJECTIVE END

			// OBJECTIVE START
			'objective' => $this->input->post('objective'),

			'kesadaran'    	=> $this->input->post('kesadaran'),
			'keadaan_umum' 	=> $this->input->post('keadaan_umum'),
			'td'         		=> $this->input->post('td'),
			'gcs'         	=> $this->input->post('gcs'),
			'nadi'         	=> $this->input->post('nadi'),
			'suhu'         	=> $this->input->post('suhu'),
			'nafas'         => $this->input->post('nafas'),
			'reaksi_cahaya' => $this->input->post('reaksi_cahaya'),
			'tinggi'        => $this->input->post('tinggi'),
			'berat'         => $this->input->post('berat'),
			// OBJECTIVE END

			// ASSESMENT
			'diag_medis_banding'	=> $diag_medis_banding,
			'diag_medis_banding_text'	=> $diag_medis_banding_text,
			// ASSESMENT END

			// PLANNING
			'planning'			=> $planning,
			'planning_text'	=> $planning_text,
			'p_instruksi'	=> $this->input->post('p_instruksi'),
			// PLANNING END

      #'created'	=> date('Y-m-d H:i:s'),
      #'creator' => $creator,
      'updated' => date('Y-m-d H:i:s'),
      'updator' => $creator,
    );

		$data_riwayat = array(
				'id_pasien'					=> $data_pasien['id_pasien'],
				'penyakit_sekarang'	=> $this->input->post('riwayat_sakit'),
				'penyakit_dahulu'		=> $this->input->post('riwayat_sakit_dulu'),
				'penyakit_keluarga'	=> $this->input->post('riwayat_sakit_keluarga'),
				'pengobatan'				=> $this->input->post('riwayat_pengobatan'),
				'alergi'						=> $this->input->post('riwayat_alergi'),
				'created'						=> date('Y-m-d H:i:s'),
				'creator'						=> $creator,
			);

		$sql_command = $this->input->post('sql_command');
		if($sql_command=='update')
		{
			$id_asmri = $this->input->post('id_asmri');
			$where = " id_asmri='".$id_asmri."' ";
			$action = $this->mdl->edit_data_asm_ranap($where, $data_update);
			$store_riwayat	= $this->smartlib->store_riwayat_pasien($data_pasien['id_pasien'], $data_riwayat);
		}
		else
		{
			$action = $this->mdl->add_data_asm_ranap($data);
			$store_riwayat	= $this->smartlib->store_riwayat_pasien($data_pasien['id_pasien'], $data_riwayat);
		}
    if($action) $this->save_drawing($id_reg);

    #echo json_encode(array("status" => true));
		redirect('soap/rm/'.$id_reg);
	}

	public function save_drawing($id_reg)
	{
		$pasien = $this->smartlib->get_data_regpasien_by_id_reg($id_reg);
		$id_pasien = $pasien['id_pasien'];

		$img	= $this->input->post('urlblob', true);
		$img 	= str_replace('[removed]', '', $img);

		$data = 'data:image/png;base64,' . $img;

		list($type, $data) = explode(';', $data);
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);

		$dir_id_pasien = $this->config->item('upload_path') . "/penunjang/" . $id_pasien;
		if (!file_exists($dir_id_pasien))
			mkdir($dir_id_pasien, 0777, true);

		$dir_id_reg = $this->config->item('upload_path') . "/penunjang/" . $id_pasien . "/" . $id_reg;
		if (!file_exists($dir_id_reg))
			mkdir($dir_id_reg, 0777, true);

		$nama_gambar = rand(10000,99999);
		$file_ext = '.png';

		$creat_file =  file_put_contents(FCPATH . '/uploaded/penunjang/'.$id_pasien.'/'.$id_reg.'/'.$nama_gambar.$file_ext, $data);

		$sukses_counter = 0;
		if ($creat_file) {
			$id_suk = 7;

			$sql_insert = "	INSERT INTO soap_upload_file (id_suk,id_reg,file,ext)
											VALUES ('" . $id_suk . "','" . $id_reg . "','" . $nama_gambar .$file_ext. "','" . $file_ext . "')
										";
			$ok = $this->dbhis->query($sql_insert);

			if ($ok) {
				$sukses_counter++;
			}

		}

		if ($sukses_counter > 0)
			$return = 'Upload Sukses';
		else
			$return = 'Upload Gagal / Batal ';

		#echo '<div><h1>' . $return . '</h1></div>';
		return $return;
	}

	public function delete_asm_ranap($id_asmri)
	{
		$this->mdl->delete_asm_ranap($id_asmri);
		echo json_encode(array("status" => true));
	}

}
