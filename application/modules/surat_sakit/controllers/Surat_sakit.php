<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Surat_sakit extends MX_Controller
{
  function __construct()
  {
    parent::__construct();
    modules::run('auth/check_session');
    date_default_timezone_set('Asia/Jakarta');
    $this->load->library('session');
    $this->load->library('SmartLib');
    $this->load->library('FormGenerator');
    $this->load->library('ciqrcode');
    $this->load->model('Surat_sakit_model', 'mdl');
    $this->load->library('form_validation');
  }

  public function content_sukit($id_reg)
  {
    $pasien     = $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
    $id_pasien  = $pasien['id_pasien'];
    $sukit 	    = $this->mdl->get_sukit_all($id_pasien);

    $data = array(
      'sukit'   => $sukit,
      'id_reg'  => $id_reg,
      'pasien'  => $pasien,
    );
    $this->load->view('vcontent_surat_sakit', $data);
  }

  public function surat_sakit_add($id_reg)
	{
			$creator= @$this->session->userdata['sp']->login_name;
			$pasien = $this->smartlib->get_data_registrasi_by_id_reg($id_reg);
      $id_pasien = $pasien['id_pasien'];

			$chk_alasan	= $this->input->post('alasan');
			$alasan		= implode(',',(array) $chk_alasan);

      $this->form_validation->set_rules('tgl_cuti_start','Tanggal Awal Cuti', 'required');
      $this->form_validation->set_rules('tgl_cuti_end','Tanggal Akhir Cuti', 'required');

      if ($this->form_validation->run() == FALSE) {
          $errors =  validation_errors();
          echo json_encode(['error'=>$errors]);
      }
      else {
        $data = array(
            'id_pasien'	      => $id_pasien,
    				'id_reg'	        => $id_reg,
    				'id_dokter'			  => $pasien['id_dokter'],

    				'pekerjaan'			  => $this->input->post('pekerjaan'),
            'lama_cuti'				=> $this->input->post('lama_cuti'),
            'alasan'					=> $alasan,
            'tgl_cuti_start'	=> $this->input->post('tgl_cuti_start'),
            'tgl_cuti_end'		=> $this->input->post('tgl_cuti_end'),

    				'created'					=> date('Y-m-d H:i:s'),
    				'creater'					=> $creator,
    				'updated'					=> 'null',
    				'updater'					=> 'null',
    			);
      }
      $insert = $this->mdl->add_data_sukit($data);
      echo json_encode(array("status" => true));
	}

  public function surat_sakit_edit($id_sukit)
	{
		$data = $this->mdl->get_sukit_byid($id_sukit);
		echo json_encode($data);
	}

  public function surat_sakit_edit_act($id_sukit)
	{
		$updator = @$this->session->userdata['sp']->login_name;

    $chk_alasan	= $this->input->post('alasan');
    $alasan		= implode(',',(array) $chk_alasan);

  $data = array(
      'pekerjaan'			  => $this->input->post('pekerjaan'),
      'lama_cuti'				=> $this->input->post('lama_cuti'),
      'alasan'					=> $alasan,
      'tgl_cuti_start'	=> $this->input->post('tgl_cuti_start'),
      'tgl_cuti_end'		=> $this->input->post('tgl_cuti_end'),

      //'created'					=> date('Y-m-d H:i:s'),
      //'creater'					=> $creator,
      'updated'					=> date('Y-m-d H:i:s'),
      'updater'					=> $updator,
    );

    $update = $this->mdl->edit_data_sukit(array('id_sukit' => $this->input->post('id_sukit')), $data);
    echo json_encode(array("status" => true));
	}

  public function surat_sakit_delete($id_sukit)
  {
    $this->mdl->delete_sukit_byid($id_sukit);
    echo json_encode(array("status" => true));
  }

  public function surat_sakit_print($id_sukit)
	{
    $rs_info   = $this->smartlib->rs_info();
    $nama_rs   = $rs_info['nama_rs'];
    $alamat_rs = $rs_info['alamat_rs'];
    $telp_rs   = $rs_info['telp_rs'];
    $fax_rs    = $rs_info['fax_rs'];

    $sukit     = $this->mdl->get_sukit_byid($id_sukit);
    $id_reg    = $sukit->id_reg;
    $pasien    = $this->smartlib->get_data_registrasi_by_id_reg($id_reg);

    $data = array(
      'sukit'     => $sukit,
      'nama_rs'   => $nama_rs,
      'alamat_rs' => $alamat_rs,
      'telp_rs'   => $telp_rs,
      'fax_rs'    => $fax_rs,
      'pasien'    => $pasien,
    );
    //return $data;
    $this->load->view('vsurat_sakit_print', $data);
	}

  public function surat_sakit_print_byidreg($id_reg, $id_dokter)
	{
    $rs_info   = $this->smartlib->rs_info();
    $nama_rs   = $rs_info['nama_rs'];
    $alamat_rs = $rs_info['alamat_rs'];
    $telp_rs   = $rs_info['telp_rs'];
    $fax_rs    = $rs_info['fax_rs'];

    $sukit     = $this->mdl->get_sukit_byidreg($id_reg, $id_dokter);
    $id_sukit    = $sukit->id_sukit;
    $pasien    = $this->smartlib->get_data_registrasi_by_id_reg($id_reg);

    $code   = $id_sukit.'-'.$id_reg.'-'.$pasien['nama_pasien'].'['.$pasien['id_pasien'].']'.$id_dokter;
    $qrcode = $this->_code($code);

    $data = array(
      'sukit'     => $sukit,
      'nama_rs'   => $nama_rs,
      'alamat_rs' => $alamat_rs,
      'telp_rs'   => $telp_rs,
      'fax_rs'    => $fax_rs,
      'pasien'    => $pasien,
    );
    //return $data;
    $this->load->view('vsurat_sakit_print', $data);
	}

  function _code($nim)
    {
      $this->load->library('ciqrcode');
      $config['cacheable']    = true; //boolean, the default is true
      $config['cachedir']     = './qrcode/'; //string, the default is application/cache/
      $config['errorlog']     = './qrcode/'; //string, the default is application/logs/
      $config['imagedir']     = './qrcode/'; //direktori penyimpanan qr code
      $config['quality']      = true; //boolean, the default is true
      $config['size']         = '1024'; //interger, the default is 1024
      $config['black']        = array(224,255,255); // array, default is array(255,255,255)
      $config['white']        = array(70,130,180); // array, default is array(0,0,0)
      $this->ciqrcode->initialize($config);

      $image_name='qrcode_sukit.png'; //buat name dari qr code sesuai dengan nim

      $params['data'] = $nim; //data yang akan di jadikan QR CODE
      $params['level'] = 'H'; //H=High
      $params['size'] = 10;
      $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
      $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
	}

}
