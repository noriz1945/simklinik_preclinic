<?php
class Rehabmedik extends MX_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Models_Rehabmedik');
		$this->load->helper('url');
		$this->load->module('soap/epoli');
        $this->load->model('Epoli_model');

	}

	function indexrehab($id_reg,$optional_page=''){

    #$this->output->enable_profiler(true);
		$datPasien = $this->Models_Rehabmedik->data_pasien($id_reg);
		#$mst_dokter_dta = $this->Models_Rehabmedik->mstDokter($id_reg);
		
		$mst_dokter_dta[] = array(
			'id_dokter'	=> $datPasien[0]->id_dokter,
			'name'			=> $datPasien[0]->dokter_name,
		);
		
    $data = array(
			'datPasien'       => $datPasien,	 
			'mst_dokter_dta'       => $mst_dokter_dta,
			'optional_page'		=> $optional_page,
			'id_reg'				=> $id_reg,
		);
		$this->load->view('vsoap_modal_fisiom',$data);
	}
	function tambah_aksi($optional_page=''){
		$nama = $this->input->post('nama');
		$id_dokter = $this->input->post('id_dokter');
		$nama_dokter = $this->session->userdata['sp']->name;
		$tgl_periksa = $this->input->post('tgl_periksa');
        $id_reg = $this->input->post('id_reg');
        $rm = $this->input->post('rm');
        $date = date('Y-m-d');
		$diag = $this->input->post('diag');
        $rwip = $this->input->post('rwip');
        $rwjn = $this->input->post('rwjn');
		$alergi = $this->input->post('alergi');
		$miwadi = $this->input->post('miwadi');
        $masman = $this->input->post('masman');
		$ultthe = $this->input->post('ultthe');
		$infthe = $this->input->post('infthe');
        $elesti = $this->input->post('elesti');
		$infrera = $this->input->post('infrera');
		$certra = $this->input->post('certra');
        $lamtra = $this->input->post('lamtra');
		$ultneb = $this->input->post('ultneb');
		$lainlain = $this->input->post('lainlain');
		$lainlaintext = $this->input->post('lainlaintext');
        $genexe = $this->input->post('genexe');
		$pasexe = $this->input->post('pasexe');
        $actexe = $this->input->post('actexe');
		$wallbar = $this->input->post('wallbar');
		$brepos = $this->input->post('brepos');
		$prepost = $this->input->post('prepost');
		$musstr = $this->input->post('musstr');
        $joimot = $this->input->post('joimot');
		$actdai = $this->input->post('actdai');
		$sebanyak = $this->input->post('sebanyak');
        $frekuensi = $this->input->post('frekuensi');
        $catatan = $this->input->post('catatan');

		$data = array(
            'nama' => $nama,
            'registrasi' => $id_reg,
            'rm' => $rm,
			'tgl_request' => $date,
			'id_dokter' => $id_dokter,
			'nama_dokter' => $nama_dokter,
			'tgl_periksa' => $tgl_periksa,
			'created' => $date,
			'diagnosa' => $diag,
            'rwip' => $rwip,
            'rwjn' => $rwjn,
			'alergi' => $alergi,
			'miwadi' => $miwadi,
            'masman' => $masman,
			'ultthe' => $ultthe,
			'infthe' => $infthe,
            'elesti' => $elesti,
			'infrera' => $infrera,
			'certra' => $certra,
            'lamtra' => $lamtra,
			'ultneb' => $ultneb,
			'lainlain' => $lainlain,
			'lainlaintext' => $lainlaintext,
            'genexe' => $genexe,
			'pasexe' => $pasexe,
			'actexe' => $actexe,
            'wallbar' => $wallbar,
			'brepos' => $brepos,
			'prepost' => $prepost,
            'musstr' => $musstr,
			'joimot' => $joimot,
			'actdai' => $actdai,
            'sebanyak' => $sebanyak,
			'frekuensi' => $frekuensi,
			'catatan' => $catatan


			);
       $this->Models_Rehabmedik->input_data($data,'soap_trx_order_rehab_medik'); 
			 if($optional_page=='asm_ri')
			 {
	   			#redirect('erm_ranap/main_content/'.$id_reg.'/'.$rm."#anchor_order_rehab");
					echo 'Order Rehab Berhasil';
			 }
			 else
			 		redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
    }


	function rehab_data($id_reg){
		$data_list_rehab = $this->Models_Rehabmedik->rehab_list($id_reg);
        
		#print_r($data_items);
		$data = array(
			'data_list_rehab'       => $data_list_rehab,
	   );
	   return $data;
	}

	function edit_formsprehab($id_digit,$optional_page=''){
        $list_dat_sp_edit = $this->Models_Rehabmedik->dataListsedit($id_digit); 

        $list_dat_sp_edit_reg = $this->Models_Rehabmedik->dataListsedit_reg($id_digit); 

		$id_reg 	= $list_dat_sp_edit_reg->registrasi;
		$datPasien_na = $this->Models_Rehabmedik->data_pasien_na($id_reg);
		$mst_dokter_dta_na = $this->Models_Rehabmedik->mstDokter_na($id_reg);
 
         #print_r($data_items);
         $data = array(
			 'list_dat_sp_edit'    => $list_dat_sp_edit,
			 'datPasien_na'          => $datPasien_na,
			 'mst_dokter_dta_na'       => $mst_dokter_dta_na,
			 'optional_page'			=> $optional_page,
			 'id_reg'							=> $id_reg,
			 'id_pasien'					=> $datPasien_na[0]->id_pasien,
		);
		$this->load->view('vsoap_modal_fisiom_edit',$data);
	}

	function update_aksi($optional_page=''){
		$iddigital = $this->input->post('iddigital');
        $nama = $this->input->post('nama');
        $id_reg = $this->input->post('id_reg');
        $rm = $this->input->post('rm');
		$tgl_request = $this->input->post('tgl_request');
		$tgl_periksa = $this->input->post('tgl_periksa');
		$diag = $this->input->post('diag');
        $rwip = $this->input->post('rwip');
        $rwjn = $this->input->post('rwjn');
		$alergi = $this->input->post('alergi');
		$miwadi = $this->input->post('miwadi');
        $masman = $this->input->post('masman');
		$ultthe = $this->input->post('ultthe');
		$infthe = $this->input->post('infthe');
        $elesti = $this->input->post('elesti');
		$infrera = $this->input->post('infrera');
		$certra = $this->input->post('certra');
        $lamtra = $this->input->post('lamtra');
		$ultneb = $this->input->post('ultneb');
		$lainlain = $this->input->post('lainlain');
		$lainlaintext = $this->input->post('lainlaintext');
        $genexe = $this->input->post('genexe');
		$pasexe = $this->input->post('pasexe');
        $actexe = $this->input->post('actexe');
		$wallbar = $this->input->post('wallbar');
		$brepos = $this->input->post('brepos');
		$prepost = $this->input->post('prepost');
		$musstr = $this->input->post('musstr');
        $joimot = $this->input->post('joimot');
		$actdai = $this->input->post('actdai');
		$sebanyak = $this->input->post('sebanyak');
        $frekuensi = $this->input->post('frekuensi');
        $catatan = $this->input->post('catatan');
       

        $data = array(
			'nama' => $nama,
            'registrasi' => $id_reg,
            'rm' => $rm,
			'diagnosa' => $diag,
            'rwip' => $rwip,
            'rwjn' => $rwjn,
			'alergi' => $alergi,
			'miwadi' => $miwadi,
            'masman' => $masman,
			'ultthe' => $ultthe,
			'infthe' => $infthe,
            'elesti' => $elesti,
			'infrera' => $infrera,
			'certra' => $certra,
            'lamtra' => $lamtra,
			'ultneb' => $ultneb,
			'lainlain' => $lainlain,
			'lainlaintext' => $lainlaintext,
            'genexe' => $genexe,
			'pasexe' => $pasexe,
			'actexe' => $actexe,
            'wallbar' => $wallbar,
			'brepos' => $brepos,
			'prepost' => $prepost,
            'musstr' => $musstr,
			'joimot' => $joimot,
			'actdai' => $actdai,
            'sebanyak' => $sebanyak,
			'frekuensi' => $frekuensi,
			'catatan' => $catatan,
			'tgl_periksa' => $tgl_periksa
        );
    
        $where = array(
            'id_digital_request' => $iddigital
        );
    
        $this->Models_Rehabmedik->update_data($where,$data,'soap_trx_order_rehab_medik');
				if($optional_page=='asm_ri')
				{
					echo 'Update Order Rehab Medik Berhasil';
				}
				else
					redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
	}
	
	//RAD MODAL

	public function fisio_modal_lad($id_reg,$optional_page='') 
	{
		$sql="SELECT * FROM soap_trx_order_rehab_medik WHERE `registrasi`='$id_reg'";
		//echo "<pre>".$sql."</pre>";
		$rs=$this->dbhis->query($sql); 
		$data_row=array();

		foreach($rs->result_array() as $rs) {
			$data_row[]	=	$rs;
			$id_reg			= $id_reg;
		}
		//print_r($data_row);
		$data=array(
			'data_row'	=> $data_row,
			'id_reg'		=> $id_reg,
			'optional_page' => $optional_page,
		);
		//return $data;
		echo $this->load->view('vsoap_content_fisiom', $data,true);
	}

	

    //end test
    

    
    function hapus_fisio($id_digit,$optional_page='') {
		$this->Models_Rehabmedik->delete_rehab_id($id_digit);
		if($optional_page=='asm_ri')
		{
			echo 'Hapus Order Rehab Medik Berhasil';
		}
		else
			redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
    }


}