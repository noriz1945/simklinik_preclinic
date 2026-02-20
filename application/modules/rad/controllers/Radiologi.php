<?php
class Radiologi extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Models_radiologi');
        $this->load->module('soap/epoli');
        $this->load->model('Epoli_model');
        // adalah sebagai konstruktor… berbagai perintah yang ada di
        // dalam fungsi ini akan selalu dipanggil di saat objek trx_lab_order_digital_header dibuat
    }

    function indexrad($id_reg,$optional_page=''){
       # $this->output->enable_profiler(true);
        $dat_pasien = $this->Models_radiologi->dataPasien($id_reg);
        $data_head_01 = $this->Models_radiologi->dataHead_01();
        $data_head_01_r = $this->Models_radiologi->dataHead_01_r();
        $data_head_01_l = $this->Models_radiologi->dataHead_01_l();
        $data_head_01_b = $this->Models_radiologi->dataHead_01_b();
        $data_head_02 = $this->Models_radiologi->dataHead_02();
        $data_head_02_r = $this->Models_radiologi->dataHead_02_r();
        $data_head_02_l = $this->Models_radiologi->dataHead_02_l();
        $data_head_02_b = $this->Models_radiologi->dataHead_02_b();
        $data_head_03 = $this->Models_radiologi->dataHead_03();
        $data_head_04 = $this->Models_radiologi->dataHead_04();
        $data_head_04_r = $this->Models_radiologi->dataHead_04_r();
        $data_head_04_l = $this->Models_radiologi->dataHead_04_l();
        $data_head_04_b = $this->Models_radiologi->dataHead_04_b();
        $data_head_05 = $this->Models_radiologi->dataHead_05();
        $data_head_06 = $this->Models_radiologi->dataHead_06();
        $data_head_07 = $this->Models_radiologi->dataHead_07();
        $data_head_07_r = $this->Models_radiologi->dataHead_07_r();
        $data_head_07_l = $this->Models_radiologi->dataHead_07_l();
        $data_head_08 = $this->Models_radiologi->dataHead_08();
        $data_head_09 = $this->Models_radiologi->dataHead_09();
        $data_head_10 = $this->Models_radiologi->dataHead_10();
        $data_head_11 = $this->Models_radiologi->dataHead_11();
        $data_head_11_r = $this->Models_radiologi->dataHead_11_r();
        $data_head_12 = $this->Models_radiologi->dataHead_12();
        $data_head_13 = $this->Models_radiologi->dataHead_13();
        $mst_dokter_dta = $this->Models_radiologi->mstDokter($id_reg);
        //untuk kondisi dokter IGD
        $mst_dokter_dta_igd = $this->Models_splab->mstDokter_igd($id_reg);

        #print_r($data_items);
        $data = array(
            'dat_pasien'       => $dat_pasien,
            'data_head_01'       => $data_head_01,
            'data_head_01_r'       => $data_head_01_r,
            'data_head_01_l'       => $data_head_01_l,
            'data_head_01_b'       => $data_head_01_b,
            'data_head_02'       => $data_head_02,
            'data_head_02_r'       => $data_head_02_r,
            'data_head_02_l'       => $data_head_02_l,
            'data_head_02_b'       => $data_head_02_b,
            'data_head_03'       => $data_head_03,
            'data_head_04'       => $data_head_04,
            'data_head_04_r'       => $data_head_04_r,
            'data_head_04_l'       => $data_head_04_l,
            'data_head_04_b'       => $data_head_04_b,
            'data_head_05'       => $data_head_05,
            'data_head_06'       => $data_head_06,
            'data_head_07'       => $data_head_07,
            'data_head_07_r'       => $data_head_07_r,
            'data_head_07_l'       => $data_head_07_l,
            'data_head_08'       => $data_head_08,
            'data_head_09'       => $data_head_09,
            'data_head_10'       => $data_head_10,
            'data_head_11'       => $data_head_11,
            'data_head_11_r'       => $data_head_11_r,
            'data_head_12'       => $data_head_12,
            'data_head_13'       => $data_head_13,
            'mst_dokter_dta'       => $mst_dokter_dta,
            //untuk kondisi dokter IGD
            'mst_dokter_dta_igd'       => $mst_dokter_dta_igd,
						'optional_page'		=> $optional_page,
						'id_reg'				=> $id_reg,
        );
        
        $this->load->view('vsoap_modal_radm',$data);
    }
    
    function tambah_aksi($optional_page=''){
        $id_reg = $this->input->post('id_reg');
        $nama = $this->input->post('nama');
        $rm = $this->input->post('rm');
        $jam_request = $this->input->post('jam_request');
        $id_rad_digital = $this->input->post('id_rad_digital');
        $tindakan = $this->input->post('tindakan');
        $kelas = $this->input->post('kelas');

        $dokter = $this->input->post('dokter');
        $iddokter = $this->input->post('iddokter');

        $company = $this->input->post('company');
        $id_asuransi = $this->input->post('id_asuransi');
        $diag = $this->input->post('diag');
        $indikasi_klinis = $this->input->post('indikasi_klinis');
        $tgl_request = $this->input->post('tgl_request');
        $tgl_proses = $this->input->post('tgl_proses');
        //$jam_proses = $this->input->post('jam_proses');
        $cito = $this->input->post('cito');
        $lainlaingigi = $this->input->post('lainlaingigi');
        $lainlainct = $this->input->post('lainlainct');
        $lainlainmri = $this->input->post('lainlainmri');
        $lainlain = $this->input->post('lainlain');

        //func retrieve data item value checkbox
        $bahan = array();
        foreach($id_rad_digital as $k => $v)
        {
            if(isset($tindakan[$v]))
            {
                $bahan_id[]     = $v;
                $bahan_text[]   = $tindakan[$v];
            }
        }
        $tindakan_id = implode(",",$bahan_id);
        $tindakan_text = implode(",",$bahan_text);
        //end func retreieve data item value checkbox

		$data = array(
            'registrasi' => $id_reg,
            'nama' => $nama,
            'rm' => $rm,
            'jam' => $jam_request,
            'tindakan_id' => $tindakan_id,
            'tindakan' => $tindakan_text,
            'kelas' => $kelas,
            'namadokter' => $dokter,
            'id_dokter' => $iddokter,
            'company' => $company,
            'id_asuransi' => $id_asuransi,
            'diagnosa' => $diag,
            'indikasi_klinis' => $indikasi_klinis,
            'tgl_request' => $tgl_request,
            'tgl_proses' => $tgl_proses,
           //'jam_proses' => $jam_proses,
           'cito' => $cito,
           'lainlaingigi' => $lainlaingigi,
           'lainlainct' => $lainlainct,
           'lainlainmri' => $lainlainmri,
           'lainlain' => $lainlain,
            
			);
		$this->Models_radiologi->input_data($data,'soap_trx_rad_order_digital_request');
		if($optional_page=='asm_ri')
		{
			#redirect('erm_ranap/main_content/'.$id_reg.'/'.$rm."#anchor_order_rad");
			echo 'Order Radiologi Berhasil';
		}
		else
			redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
	}

    function list_sprad(){
        $list_dat_pasien_rad = $this->Models_radiologi->dataPasienlist_rad();
         
         $data = array(
            'list_dat_pasien_rad'       => $list_dat_pasien_rad,

         );

         //$this->load->view('v_listsplab',$data);
         return $data;
     }

     function edit_formsprad($id_digit,$optional_page=''){
        # $this->output->enable_profiler(true);
        $list_dat_sp_edit = $this->Models_radiologi->dataListsedit($id_digit); 

        $list_dat_sp_edit_reg = $this->Models_radiologi->dataListsedit_reg($id_digit); 

		$id_reg 	= $list_dat_sp_edit_reg->registrasi;
        $datPasien_na = $this->Models_radiologi->data_pasien_na($id_reg);
        $data_head_01 = $this->Models_radiologi->dataHead_01();
        $data_head_01_r = $this->Models_radiologi->dataHead_01_r();
        $data_head_01_l = $this->Models_radiologi->dataHead_01_l();
        $data_head_01_b = $this->Models_radiologi->dataHead_01_b();
        $data_head_02 = $this->Models_radiologi->dataHead_02();
        $data_head_02_r = $this->Models_radiologi->dataHead_02_r();
        $data_head_02_l = $this->Models_radiologi->dataHead_02_l();
        $data_head_02_b = $this->Models_radiologi->dataHead_02_b();
        $data_head_03 = $this->Models_radiologi->dataHead_03();
        $data_head_04 = $this->Models_radiologi->dataHead_04();
        $data_head_04_r = $this->Models_radiologi->dataHead_04_r();
        $data_head_04_l = $this->Models_radiologi->dataHead_04_l();
        $data_head_04_b = $this->Models_radiologi->dataHead_04_b();
        $data_head_05 = $this->Models_radiologi->dataHead_05();
        $data_head_06 = $this->Models_radiologi->dataHead_06();
        $data_head_07 = $this->Models_radiologi->dataHead_07();
        $data_head_07_r = $this->Models_radiologi->dataHead_07_r();
        $data_head_07_l = $this->Models_radiologi->dataHead_07_l();
        $data_head_08 = $this->Models_radiologi->dataHead_08();
        $data_head_09 = $this->Models_radiologi->dataHead_09();
        $data_head_10 = $this->Models_radiologi->dataHead_10();
        $data_head_11 = $this->Models_radiologi->dataHead_11();
        $data_head_11_r = $this->Models_radiologi->dataHead_11_r();
        $data_head_12 = $this->Models_radiologi->dataHead_12();
        $data_head_13 = $this->Models_radiologi->dataHead_13();
        $mst_dokter_dta_na = $this->Models_radiologi->mstDokter_na($id_reg);
 
         #print_r($data_items);
         $data = array(
            'list_dat_sp_edit'    => $list_dat_sp_edit,
            'datPasien_na'          => $datPasien_na,
            'data_head_01'       => $data_head_01,
            'data_head_01_r'       => $data_head_01_r,
            'data_head_01_l'       => $data_head_01_l,
            'data_head_01_b'       => $data_head_01_b,
            'data_head_02'       => $data_head_02,
            'data_head_02_r'       => $data_head_02_r,
            'data_head_02_l'       => $data_head_02_l,
            'data_head_02_b'       => $data_head_02_b,
            'data_head_03'       => $data_head_03,
            'data_head_04'       => $data_head_04,
            'data_head_04_r'       => $data_head_04_r,
            'data_head_04_l'       => $data_head_04_l,
            'data_head_04_b'       => $data_head_04_b,
            'data_head_05'       => $data_head_05,
            'data_head_06'       => $data_head_06,
            'data_head_07'       => $data_head_07,
            'data_head_07_r'       => $data_head_07_r,
            'data_head_07_l'       => $data_head_07_l,
            'data_head_08'       => $data_head_08,
            'data_head_09'       => $data_head_09,
            'data_head_10'       => $data_head_10,
            'data_head_11'       => $data_head_11,
            'data_head_11_r'       => $data_head_11_r,
            'data_head_12'       => $data_head_12,
            'data_head_13'       => $data_head_13,
            'mst_dokter_dta_na'       => $mst_dokter_dta_na,
						'optional_page' => $optional_page,
						'id_reg'				=> $id_reg,
         );
         
         
         $this->load->view('vsoap_modal_radm_edit',$data);
     }

     function update_aksi($optional_page=''){
        $iddigital = $this->input->post('iddigital');
        $diagnosa = $this->input->post('diag');
        $indikasi_klinis = $this->input->post('indikasi_klinis');
        $id_rad_digital = $this->input->post('id_rad_digital');
        $tindakan = $this->input->post('tindakan');
        $tgl_proses = $this->input->post('tgl_proses');
        $cito = $this->input->post('cito');
        $lainlain = $this->input->post('lainlain');
        $id_reg = $this->input->post('id_reg');
        $rm = $this->input->post('rm');
        $lainlaingigi = $this->input->post('lainlaingigi');
        $lainlainct = $this->input->post('lainlainct');
        $lainlainmri = $this->input->post('lainlainmri');
        $lainlain = $this->input->post('lainlain');
        $jam_request = $this->input->post('jam_request');
        $company = $this->input->post('company');
        $id_asuransi = $this->input->post('id_asuransi');
        $kelas = $this->input->post('kelas');
         //func retrieve data item value checkbox
         $bahan = array();
         foreach($id_rad_digital as $k => $v)
         {
             if(isset($tindakan[$v]))
             {
                 $bahan_id[]     = $v;
                 $bahan_text[]   = $tindakan[$v];
             }
         }
         $tindakan_id = implode(",",$bahan_id);
         $tindakan_text = implode(",",$bahan_text);
         //end func retreieve data item value checkbox

        $data = array(
            'diagnosa' => $diagnosa,
            'indikasi_klinis' => $indikasi_klinis,
            'tindakan_id' => $tindakan_id,
            'tindakan' => $tindakan_text,
            'tgl_proses' => $tgl_proses,
            'cito' => $cito,
            'lainlain' => $lainlain,
            'registrasi' => $id_reg,
            'rm' => $rm,
            'lainlaingigi' => $lainlaingigi,
           'lainlainct' => $lainlainct,
           'lainlainmri' => $lainlainmri,
           'lainlain' => $lainlain,
           'updated' => $jam_request,
           'company' => $company,
            'id_asuransi' => $id_asuransi,
            'kelas' => $kelas,
        );
    
        $where = array(
            'id_digital_request' => $iddigital
        );
    
        $this->Models_radiologi->update_data($where,$data,'soap_trx_rad_order_digital_request');
				if($optional_page=='asm_ri')
				{
					echo 'Update Order Radiologi Berhasil';
				}
				else
 	      	redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
    }

    

    //RAD MODAL

	public function rad_modal_lad($id_reg,$optional_page='') 
	{
		$sql="SELECT * FROM soap_trx_rad_order_digital_request WHERE `registrasi`='$id_reg'";
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
		echo $this->load->view('vsoap_content_radm', $data,true);
	}

	

    //end test
    

    
    function hapus_rad($id_digit,$optional_page='') {
		$this->Models_radiologi->delete_rad_id($id_digit);
		if($optional_page=='asm_ri')
		{
			echo 'Hapus Order Radiologi Berhasil';
		}
		else
			redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
    }

}