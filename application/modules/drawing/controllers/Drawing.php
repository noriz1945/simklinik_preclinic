<?php defined('BASEPATH') or exit('No direct script access allowed');

class Drawing extends MX_Controller
{
	var $session_name = 'sp';

	function __construct()
	{
		parent::__construct();
		#if($session_name !='') $this->check_session($session_name);
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');

		$this->load->model('Drawing_model', 'mdl');
	}

	public function index()
	{
		$this->load->view('vdraw');
	}

	public function soap_draw()
	{
		$this->load->view('vsoap_draw');
	}

	public function canvas_drawing()
	{
		$id_reg	                      = $this->input->post('id_reg');
		$id_pasien                    = $this->input->post('id_pasien');
		$is_ri					      = $this->input->post('type_rwt');
		$data = array(
			'id_pasien'	=> $id_pasien,
			'id_reg'		=> $id_reg,
		);
		
		if($is_ri=='ri')
			echo $this->load->view('vcanvas_drawing_ri', $data, true);
		else
			echo $this->load->view('vcanvas_drawing', $data, true);
	}

	public function save_drawing_ori()
	{

		$img	= $this->input->post('blob', true);
		$img 	= str_replace('[removed]', '', $img);

		$data = 'data:image/png;base64,' . $img;

		list($type, $data) = explode(';', $data);
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);

		file_put_contents(FCPATH . '/uploaded/gambar_dokter/cobaaa.png', $data);
		/*
		$data = array(
				'img'			=> $file,
				'base64'	=> $img,
				'status'	=> 0,
			);

			$insert = $this->mdl->save_drawing($data);
			echo json_encode(array("status" => true));
*/
	}

	public function save_drawing($id_reg,$id_pasien)
	{
		$img	= $this->input->post('blob', true);
		$img 	= str_replace('[removed]', '', $img);

		$data = 'data:image/png;base64,' . $img;

		list($type, $data) = explode(';', $data);
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);

		#$dir_id_pasien = $this->config->item('upload_path') . "/penunjang/" . $id_pasien;
		$dir_id_pasien = FCPATH . 'uploaded/gambar_dokter/' . $id_pasien;
		if (!file_exists($dir_id_pasien))
			mkdir($dir_id_pasien, 0777, true);

		#$dir_id_reg = $this->config->item('upload_path') . "/penunjang/" . $id_pasien . "/" . $id_reg;
		$dir_id_reg = FCPATH . 'uploaded/gambar_dokter/' . $id_pasien .'/'. $id_reg;
		if (!file_exists($dir_id_reg))
			mkdir($dir_id_reg, 0777, true);

		$nama_gambar = rand(10000,99999);
		$file_ext = '.png';

		$creat_file =  file_put_contents( $dir_id_reg .'/'. $nama_gambar.$file_ext, $data);

		$sukses_counter = 0;
		if ($creat_file) {
			$id_suk = 1;

			$sql_insert = "	INSERT INTO soap_upload_file (id_suk,id_reg,file,ext)
											VALUES ('" . $id_suk . "','" . $id_reg . "','" . $nama_gambar .$file_ext. "','" . $file_ext . "')
										";
			$ok = $this->db->query($sql_insert);

			if ($ok) {
				$sukses_counter++;
			}

		}

		if ($sukses_counter > 0)
			$return = 'Upload Sukses';
		else
			$return = 'Upload Gagal / Batal : '.$error;

		echo '<div><h1>' . $return . '</h1></div>';
	}
}
