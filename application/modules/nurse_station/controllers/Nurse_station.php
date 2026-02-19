<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nurse_station extends MX_Controller {
	var $session_name='sp';

	function __construct() {
		parent::__construct();
		modules::run('auth/check_session');
		date_default_timezone_set('Asia/Jakarta');
		#if($session_name !='') $this->check_session($session_name);
		$this->load->library('session');
		$this->load->library('SmartLib');
		$this->load->library('FormGenerator');
		$this->load->model('Nurse_station_model','mdl');
	}

	public function cari_pasien_poli()
	{
		$id_pasien	= $this->input->post('id_pasien');
		$nama_pasien= $this->input->post('nama_pasien');

		$this->make_bread->add('Keperawatan', '', 1);
    $this->make_bread->add('Cari Pasien', '', 0);
    $breadcrumb = $this->make_bread->output();

		if(empty($id_pasien) && empty($nama_pasien))
		{
			$data = array(
			'rs'					=> array(),
			'id_pasien'		=> $id_pasien,
			'nama_pasien' => $nama_pasien,
			'id_fisik'			=> '',
			'jml_stat_fisik'=> '',
			'breadcrumb' 	=> $breadcrumb,
		);

			$this->load->view('vcari_pasien_poli',$data);
		}
		else
		{
			$sql = "SELECT TR.id_reg, DATE(TR.regdate) AS regdate, TR.id_pasien,
							(CASE WHEN TR.rwip THEN 'RWI' WHEN TR.rwjn THEN 'RWJ' WHEN TR.ugd THEN 'UGD' END) AS tipe,
							MU.name AS unit, TRU.id_unit, MP.name AS pasien,
							(CASE
							WHEN TR.rwip THEN TR.id_dokter_prt1
							WHEN TR.rwip=0 AND TR.ugd=1 THEN TR.id_dokter_jaga
							ELSE MD.id_dokter
							END) AS id_dokter,
							(CASE
							WHEN TR.rwip THEN MDR.name
							WHEN TR.rwip=0 AND TR.ugd=1 THEN MDJ.name
							ELSE MD.name
							END) AS dokter,
							TRK.id_reg_kmr, MK.name AS kelas, TRK.duration, TRK.indate, TRK.outdate,
							(SELECT invdate FROM trx_reg_inv TRI WHERE id_reg=TR.id_reg AND cancel=0 ORDER BY invdate DESC LIMIT 1) AS invdate,
							MC.name AS asuransi

							FROM trx_reg TR
							LEFT JOIN trx_reg_unit TRU ON TR.id_reg = TRU.id_reg
							LEFT JOIN trx_reg_kmr TRK ON TR.id_reg = TRK.id_reg AND TR.rwip=1
							LEFT JOIN  mst_unit MU ON TRU.id_unit = MU.id_unit
							LEFT JOIN  mst_kelas MK ON TRK.id_kelas = MK.id_kelas
							LEFT JOIN  mst_dokter MD ON TRU.id_dokter = MD.id_dokter
							LEFT JOIN  mst_dokter MDR ON TR.id_dokter_prt1 = MDR.id_dokter
							LEFT JOIN  mst_dokter MDJ ON TR.id_dokter_jaga = MDJ.id_dokter
							LEFT JOIN  mst_company MC ON MC.id_company = TR.id_asuransi
							LEFT JOIN mst_pasien MP ON TR.id_pasien = MP.id_pasien

							WHERE TR.status<2
							AND (TRU.id_reg IS NULL OR TRU.cancel = 0)
							AND (TRK.id_reg IS NULL OR TRK.cancel = 0)
					";

			if($id_pasien != '')
			$sql.=" AND TR.id_pasien LIKE '%".$id_pasien."%' ";
			if ($nama_pasien != '')
			$sql.=" AND LOWER(MP.name) LIKE LOWER('%".$nama_pasien."%')";
			$sql.="ORDER BY TR.regdate DESC";
			//echo "<pre>".$sql."</pre>";
			$query= $this->dbhis->query($sql);
			$rs 	= $query->result_array();

			foreach($rs as $k => $v)
			{
				$id_reg		= $v['id_reg'];
				$id_dokter		= $v['id_dokter'];
				$cek_fisik= $this->mdl->cek_jml_stat_fisik($id_reg);
				$cek_sukit= $this->mdl->cek_jml_sukit($id_reg, $id_dokter);
				$cek_sehat= $this->mdl->cek_jml_sehat($id_reg, $id_dokter);
				$rs[$k]['cek_fisik'] = $cek_fisik;
				$rs[$k]['cek_sukit'] = $cek_sukit;
				$rs[$k]['cek_sehat'] = $cek_sehat;
			}

			$data = array(
				'rs'					=> $rs,
				'id_pasien'		=> $id_pasien,
				'nama_pasien' => $nama_pasien,
				// 'cek_fisik'		=> $cek_fisik,
				'breadcrumb' 	=> $breadcrumb,
			);
			$this->load->view('vcari_pasien_poli',$data);
		}

	}

	public function add_stat_fisik($id_reg)
	{
			$creator		= @$this->session->userdata['sp']->login_name;

			$data = array(
				'action'		=> site_url('nurse_station/add_stat_fisik_act'),
				'id_reg'		=> set_value('id_reg', $id_reg),

				'kesadaran'	=> set_value('kesadaran', ''),
				'darah'			=> set_value('darah', ''),
				'nadi'			=> set_value('nadi', ''),
				'berat'			=> set_value('berat', ''),
				'tinggi'		=> set_value('tinggi', ''),
				'suhu'			=> set_value('suhu', ''),
				'td'				=> set_value('td', ''),
				'gula'			=> set_value('gula', ''),
				'alergi'		=> set_value('alergi', ''),
				'nafas'			=> set_value('nafas', ''),

				'keluhan'			=> set_value('keluhan', ''),
				'lingkar_kepala'			=> set_value('lingkar_kepala', ''),

				'created'		=> set_value('created',	''),
				'creator'		=> set_value('creator', $creator),
				'updated'		=> set_value('updated', ''),
				'updator'		=> set_value('updator', ''),
			);

			echo $this->load->view('vmodal_fisik', $data, true);
	}

	public function add_stat_fisik_act()
	{
		$creator= @$this->session->userdata['sp']->login_name;
		$data 	= array(
				'id_reg'			=> $this->input->post('id_reg'),

				'kesadaran'		=> $this->input->post('kesadaran'),
				'darah'				=> $this->input->post('td'),
				'nadi'				=> $this->input->post('nadi'),
				'berat'				=> $this->input->post('berat'),
				'tinggi'			=> $this->input->post('tinggi'),
				'suhu'				=> $this->input->post('suhu'),
				'td'					=> $this->input->post('td'),
				'gula'				=> $this->input->post('gula'),
				'alergi'			=> $this->input->post('alergi'),
				'nafas'				=> $this->input->post('nafas'),

				'keluhan'				=> $this->input->post('keluhan'),
				'lingkar_kepala'=> $this->input->post('lingkar_kepala'),

				'created'			=> date('Y-m-d H:i:s'),
				'creator'			=> $creator,
				'updated'			=> 'null',
				'updator'			=> 'null',
			);

			$this->dbsupp->insert('soap_stat_fisik',$data);
			redirect('nurse_station/cari_pasien_poli');
	}

	public function edit_stat_fisik($id_reg)
	{
		$row	= $this->mdl->get_id_fisik($id_reg);
			$data = array(
				'action'		=> site_url('nurse_station/edit_stat_fisik_act/'.$row->id_fisik),
				'id_fisik'	=> $row->id_fisik,
				'id_reg'		=> set_value('id_reg', $row->id_reg),

				'kesadaran'	=> set_value('kesadaran', $row->kesadaran),
				'darah'			=> set_value('darah', $row->darah),
				'nadi'			=> set_value('nadi', $row->nadi),
				'berat'			=> set_value('berat', $row->berat),
				'tinggi'		=> set_value('tinggi', $row->tinggi),
				'suhu'			=> set_value('suhu', $row->suhu),
				'td'				=> set_value('td', $row->td),
				'gula'			=> set_value('gula', $row->gula),
				'alergi'		=> set_value('alergi', $row->alergi),
				'nafas'			=> set_value('nafas', $row->nafas),

				'lingkar_kepala'=> set_value('lingkar_kepala', $row->lingkar_kepala),
				'keluhan' => set_value('keluhan', $row->keluhan),

				'created'		=> set_value('created', $row->created),
				'creator'		=> set_value('creator', $row->creator),
				'updated'		=> set_value('updated', $row->updated),
				'updator'		=> set_value('updator', $row->updator),
			);

			//$objective	= $this->input->post('objective');
			echo $this->load->view('vmodal_fisik', $data, true);
	}

	public function edit_stat_fisik_act($id_fisik)
	{
		$data = array(
			"id_fisik"		=> $id_fisik,
			'id_reg'			=> $this->input->post('id_reg'),

			'kesadaran'		=> $this->input->post('kesadaran'),
			'darah'				=> $this->input->post('td'),
			'nadi'				=> $this->input->post('nadi'),
			'berat'				=> $this->input->post('berat'),
			'tinggi'			=> $this->input->post('tinggi'),
			'suhu'				=> $this->input->post('suhu'),
			'td'					=> $this->input->post('td'),
			'gula'				=> $this->input->post('gula'),
			'alergi'			=> $this->input->post('alergi'),
			'nafas'				=> $this->input->post('nafas'),

			'keluhan'				=> $this->input->post('keluhan'),
			'lingkar_kepala'=> $this->input->post('lingkar_kepala'),

			'created'			=> $this->input->post('created'),
			'creator'			=> $this->input->post('creator'),
			'updated'			=> date('Y-m-d H:i:s'),
			'updator'			=> @$this->session->userdata['sp']->login_name,
			);
			$this->mdl->update_stat_fisik($id_fisik, $data);
			redirect('nurse_station/cari_pasien_poli');
	}

	public function delete_stat_fisik($id_reg)
	{
		$row	= $this->mdl->get_id_fisik($id_reg);
		$id_fisik = $row->id_fisik;
		$this->mdl->delete_stat_fisik($id_fisik);
		echo json_encode(array("status" => true));
	}

}
