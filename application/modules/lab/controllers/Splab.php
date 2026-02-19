<?php
class Splab extends MX_controller
{
    var $jum_col = 5;
    function __construct()
    {
        parent::__construct();
        $this->load->model('Models_splab');
        $this->load->helper('url');
        $this->load->module('soap/epoli');
        //$this->load->model('Epoli_model');
        // adalah sebagai konstruktor… berbagai perintah yang ada di
        // dalam fungsi ini akan selalu dipanggil di saat objek trx_lab_order_digital_header dibuat
    }

    function indexlab($id_reg,$optional_page=''){

        # $this->output->enable_profiler(true);
         $datPasien = $this->Models_splab->data_pasien($id_reg);
         $data_head_01 = $this->Models_splab->dataHead_01();
         $data_head_02 = $this->Models_splab->dataHead_02();
         $data_head_03 = $this->Models_splab->dataHead_03();
         $data_head_04 = $this->Models_splab->dataHead_04();
         $data_head_05 = $this->Models_splab->dataHead_05();

         $data_head_06 = $this->Models_splab->dataHead_06();
         $data_head_07 = $this->Models_splab->dataHead_07();
         $data_head_08 = $this->Models_splab->dataHead_08();
         $data_head_09 = $this->Models_splab->dataHead_09();
         $data_head_10 = $this->Models_splab->dataHead_10();
         $data_head_11 = $this->Models_splab->dataHead_11();
         $data_head_12 = $this->Models_splab->dataHead_12();
         $data_head_13 = $this->Models_splab->dataHead_13();
         $data_head_14 = $this->Models_splab->dataHead_14();

         $data_head_15 = $this->Models_splab->dataHead_15();
         $data_head_16 = $this->Models_splab->dataHead_16();
         $data_head_17 = $this->Models_splab->dataHead_17();
         $data_head_18 = $this->Models_splab->dataHead_18();
         $data_head_19 = $this->Models_splab->dataHead_19();
         $data_head_20 = $this->Models_splab->dataHead_20();
         $data_head_21 = $this->Models_splab->dataHead_21();
         $data_head_22 = $this->Models_splab->dataHead_22();
         $data_head_23 = $this->Models_splab->dataHead_23();

         $data_head_24 = $this->Models_splab->dataHead_24();
         $data_head_25 = $this->Models_splab->dataHead_25();
         $data_head_26 = $this->Models_splab->dataHead_26();
         $data_head_27 = $this->Models_splab->dataHead_27();
         $data_head_28 = $this->Models_splab->dataHead_28();

         $data_head_29 = $this->Models_splab->dataHead_29();
         $data_head_30 = $this->Models_splab->dataHead_30();
         $data_head_31 = $this->Models_splab->dataHead_31();
         $data_head_32 = $this->Models_splab->dataHead_32();
         $data_head_33 = $this->Models_splab->dataHead_33();

         $mst_dokter_dta = $this->Models_splab->mstDokter($id_reg);

         //untuk kondisi dokter IGD
         $mst_dokter_dta_igd = $this->Models_splab->mstDokter_igd($id_reg);


         
 
         #print_r($data_items);
         $data = array(
             'datPasien'       => $datPasien,
             'data_head_01'       => $data_head_01,
             'data_head_02'       => $data_head_02,
             'data_head_03'       => $data_head_03,
             'data_head_04'       => $data_head_04,
             'data_head_05'       => $data_head_05,

             'data_head_06'       => $data_head_06,
             'data_head_07'       => $data_head_07,
             'data_head_08'       => $data_head_08,
             'data_head_09'       => $data_head_09,
             'data_head_10'       => $data_head_10,
             'data_head_11'       => $data_head_11,
             'data_head_12'       => $data_head_12,
             'data_head_13'       => $data_head_13,
             'data_head_14'       => $data_head_14,

             'data_head_15'       => $data_head_15,
             'data_head_16'       => $data_head_16,
             'data_head_17'       => $data_head_17,
             'data_head_18'       => $data_head_18,
             'data_head_19'       => $data_head_19,
             'data_head_20'       => $data_head_20,
             'data_head_21'       => $data_head_21,
             'data_head_22'       => $data_head_22,
             'data_head_23'       => $data_head_23,

             'data_head_24'       => $data_head_24,
             'data_head_25'       => $data_head_25,
             'data_head_26'       => $data_head_26,
             'data_head_27'       => $data_head_27,
             'data_head_28'       => $data_head_28,

             'data_head_29'       => $data_head_29,
             'data_head_30'       => $data_head_30,
             'data_head_31'       => $data_head_31,
             'data_head_32'       => $data_head_32,
             'data_head_33'       => $data_head_33,

             'mst_dokter_dta'       => $mst_dokter_dta,
             //untuk kondisi dokter IGD
             'mst_dokter_dta_igd'       => $mst_dokter_dta_igd,
          		'optional_page'		=> $optional_page,
							'id_reg'				=> $id_reg,
        );


//for($x=1;$x<=8;$x++){
//	echo "<br>"."iditem".$x;
	//membuat perulangan yang menampilkan angka satu sampai sepuluh sesuai dengan aturan yang sudah di buat pada kondisi di atas.
//}
    //exit;

         $this->load->view('vsoap_modal_labm',$data);
     }

     function tambah_aksi($optional_page=''){

        $nama = $this->input->post('nama');
        $id_lab_digital = $this->input->post('id_lab_digital');
        $tindakan = $this->input->post('tindakan');
        //$cabangid = $this->input->post('cabangid');
        $id_reg = $this->input->post('id_reg');
        $rm = $this->input->post('rm');
        $jam_request = $this->input->post('jam_request');
        $tgl_request = $this->input->post('tgl_request');
        $diag = $this->input->post('diag');
        $indikasi_klinis = $this->input->post('indikasi_klinis');
        $id_kelas = $this->input->post('id_kelas');
        $iddokter = $this->input->post('iddokter');
        $dokter = $this->input->post('dokter');

        $hasildd = $this->input->post('hasildd');
        $dokpeng = $this->input->post('dokpeng');
        $cito = $this->input->post('cito');
        $tgl_proses = $this->input->post('tgl_proses');
        $lainlain = $this->input->post('lainlain');
        $company = $this->input->post('company');
        $id_asuransi = $this->input->post('id_asuransi');
        $kelas = $this->input->post('kelas');


        //func retrieve data item value checkbox
        $bahan = array();
        foreach($id_lab_digital as $k => $v)
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
            'nama' => $nama,
            'tindakan_id' => $tindakan_id,
            'tindakan' => $tindakan_text,
            //'cabang_id' => $cabangid,
            'registrasi' => $id_reg,
            'rm' => $rm,
            'jam' => $jam_request,
            'tgl_request' => $tgl_request,
            'diagnosa' => $diag,
            'indikasi_klinis' => $indikasi_klinis,
            'kelas' => $id_kelas,
            'namadokter' => $dokter,
            'id_dokter' => $iddokter,

            //'hasilkirim' => $hasildd,
            'dokterpeng' => $dokpeng,
            'cito' => $cito,
            'tgl_proses' => $tgl_proses,
            'lainlain' => $lainlain,
            'company' => $company,
            'id_asuransi' => $id_asuransi,
            'kelas' => $kelas,

			);
       $this->Models_splab->input_data($data,'soap_trx_lab_order_digital_request'); 
			 if($optional_page=='asm_ri')
			 {
					#redirect('erm_ranap/main_content/'.$id_reg.'/'.$rm."#anchor_order_lab");
					echo 'Order Laboratorium Berhasil';
			 }
			 else
					redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
    }
    

    function list_splab(){
        $list_dat_pasien_lab = $this->Models_splab->dataPasienlist_lab();
         
         $data = array(
            'list_dat_pasien_lab'       => $list_dat_pasien_lab,
         );

         //$this->load->view('vsoap_content_cppt_lab',$data);
         return $data;
     }

     function edit_formsplab($id_digit,$optional_page=''){
        $list_dat_sp_edit = $this->Models_splab->dataListsedit($id_digit); 

        $list_dat_sp_edit_reg = $this->Models_splab->dataListsedit_reg($id_digit); 

		$id_reg 	= $list_dat_sp_edit_reg->registrasi;
         
        $datPasien_na = $this->Models_splab->data_pasien_na($id_reg);
         $data_head_01 = $this->Models_splab->dataHead_01();
         $data_head_02 = $this->Models_splab->dataHead_02();
         $data_head_03 = $this->Models_splab->dataHead_03();
         $data_head_04 = $this->Models_splab->dataHead_04();
         $data_head_05 = $this->Models_splab->dataHead_05();

         $data_head_06 = $this->Models_splab->dataHead_06();
         $data_head_07 = $this->Models_splab->dataHead_07();
         $data_head_08 = $this->Models_splab->dataHead_08();
         $data_head_09 = $this->Models_splab->dataHead_09();
         $data_head_10 = $this->Models_splab->dataHead_10();
         $data_head_11 = $this->Models_splab->dataHead_11();
         $data_head_12 = $this->Models_splab->dataHead_12();
         $data_head_13 = $this->Models_splab->dataHead_13();
         $data_head_14 = $this->Models_splab->dataHead_14();

         $data_head_15 = $this->Models_splab->dataHead_15();
         $data_head_16 = $this->Models_splab->dataHead_16();
         $data_head_17 = $this->Models_splab->dataHead_17();
         $data_head_18 = $this->Models_splab->dataHead_18();
         $data_head_19 = $this->Models_splab->dataHead_19();
         $data_head_20 = $this->Models_splab->dataHead_20();
         $data_head_21 = $this->Models_splab->dataHead_21();
         $data_head_22 = $this->Models_splab->dataHead_22();
         $data_head_23 = $this->Models_splab->dataHead_23();

         $data_head_24 = $this->Models_splab->dataHead_24();
         $data_head_25 = $this->Models_splab->dataHead_25();
         $data_head_26 = $this->Models_splab->dataHead_26();
         $data_head_27 = $this->Models_splab->dataHead_27();
         $data_head_28 = $this->Models_splab->dataHead_28();

         $data_head_29 = $this->Models_splab->dataHead_29();
         $data_head_30 = $this->Models_splab->dataHead_30();
         $data_head_31 = $this->Models_splab->dataHead_31();
         $data_head_32 = $this->Models_splab->dataHead_32();
         $data_head_33 = $this->Models_splab->dataHead_33();

         $mst_dokter_dta_na = $this->Models_splab->mstDokter_na($id_reg);

         
         $data = array(
            'list_dat_sp_edit'    => $list_dat_sp_edit,
             'datPasien_na'          => $datPasien_na,
             'data_head_01'       => $data_head_01,
             'data_head_02'       => $data_head_02,
             'data_head_03'       => $data_head_03,
             'data_head_04'       => $data_head_04,
             'data_head_05'       => $data_head_05,

             'data_head_06'       => $data_head_06,
             'data_head_07'       => $data_head_07,
             'data_head_08'       => $data_head_08,
             'data_head_09'       => $data_head_09,
             'data_head_10'       => $data_head_10,
             'data_head_11'       => $data_head_11,
             'data_head_12'       => $data_head_12,
             'data_head_13'       => $data_head_13,
             'data_head_14'       => $data_head_14,

             'data_head_15'       => $data_head_15,
             'data_head_16'       => $data_head_16,
             'data_head_17'       => $data_head_17,
             'data_head_18'       => $data_head_18,
             'data_head_19'       => $data_head_19,
             'data_head_20'       => $data_head_20,
             'data_head_21'       => $data_head_21,
             'data_head_22'       => $data_head_22,
             'data_head_23'       => $data_head_23,

             'data_head_24'       => $data_head_24,
             'data_head_25'       => $data_head_25,
             'data_head_26'       => $data_head_26,
             'data_head_27'       => $data_head_27,
             'data_head_28'       => $data_head_28,

             'data_head_29'       => $data_head_29,
             'data_head_30'       => $data_head_30,
             'data_head_31'       => $data_head_31,
             'data_head_32'       => $data_head_32,
             'data_head_33'       => $data_head_33,

             'mst_dokter_dta_na'       => $mst_dokter_dta_na,
							'optional_page' => $optional_page,
							'id_reg'				=> $id_reg,
         );

         $this->load->view('vsoap_modal_labm_edit',$data);
     }

     function update_aksi($optional_page=''){
        $iddigital = $this->input->post('iddigital');
        $diagnosa = $this->input->post('diag');
        $indikasi_klinis = $this->input->post('indikasi_klinis');
        $hasildd = $this->input->post('hasildd');
        $hasildd2 = $this->input->post('hasildd2');
        $cito = $this->input->post('cito');
        $tgl_proses = $this->input->post('tgl_proses');
        $id_reg = $this->input->post('id_reg');
        $rm = $this->input->post('rm');

        $id_lab_digital = $this->input->post('id_lab_digital');
        $tindakan = $this->input->post('tindakan');
        $lainlain = $this->input->post('lainlain');
        $company = $this->input->post('company');
        $id_asuransi = $this->input->post('id_asuransi');
        $kelas = $this->input->post('kelas');
        $jam_request = $this->input->post('jam_request');
         //func retrieve data item value checkbox
         $bahan = array();
         foreach($id_lab_digital as $k => $v)
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
            'hasilkirim' => $hasildd,
            'hasilkirim' => $hasildd2,
            'cito' => $cito,
            'tgl_proses' => $tgl_proses,
            'lainlain' => $lainlain,
            'registrasi' => $id_reg,
            'rm' => $rm,
            'company' => $company,
            'id_asuransi' => $id_asuransi,
            'kelas' => $kelas,
            'updated' => $jam_request
        );
    
        $where = array(
            'id_digital_request' => $iddigital
        );
    
        $this->Models_splab->update_data($where,$data,'soap_trx_lab_order_digital_request');
				if($optional_page=='asm_ri')
			 	{
					echo 'Update Order Laboratorium Berhasil';
				}
				else
				{
					redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
				}
    }
    


    //LAB MODAL

	public function lab_modal_lad($id_reg,$optional_page='') 
	{
		$sql="SELECT * FROM soap_trx_lab_order_digital_request WHERE `registrasi`='$id_reg'";
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
		echo $this->load->view('vsoap_content_labm', $data,true);
	}

	public function getmodal_splab_form($id_pasien)
	{
		$datPasien = $this->Models_splab->data_pasien();
         $data_head_01 = $this->Models_splab->dataHead_01();
         $data_head_02 = $this->Models_splab->dataHead_02();
         $data_head_03 = $this->Models_splab->dataHead_03();
         $data_head_04 = $this->Models_splab->dataHead_04();
         $data_head_05 = $this->Models_splab->dataHead_05();

         $data_head_06 = $this->Models_splab->dataHead_06();
         $data_head_07 = $this->Models_splab->dataHead_07();
         $data_head_08 = $this->Models_splab->dataHead_08();
         $data_head_09 = $this->Models_splab->dataHead_09();
         $data_head_10 = $this->Models_splab->dataHead_10();
         $data_head_11 = $this->Models_splab->dataHead_11();
         $data_head_12 = $this->Models_splab->dataHead_12();
         $data_head_13 = $this->Models_splab->dataHead_13();
         $data_head_14 = $this->Models_splab->dataHead_14();

         $data_head_15 = $this->Models_splab->dataHead_15();
         $data_head_16 = $this->Models_splab->dataHead_16();
         $data_head_17 = $this->Models_splab->dataHead_17();
         $data_head_18 = $this->Models_splab->dataHead_18();
         $data_head_19 = $this->Models_splab->dataHead_19();
         $data_head_20 = $this->Models_splab->dataHead_20();
         $data_head_21 = $this->Models_splab->dataHead_21();
         $data_head_22 = $this->Models_splab->dataHead_22();
         $data_head_23 = $this->Models_splab->dataHead_23();

         $data_head_24 = $this->Models_splab->dataHead_24();
         $data_head_25 = $this->Models_splab->dataHead_25();
         $data_head_26 = $this->Models_splab->dataHead_26();
         $data_head_27 = $this->Models_splab->dataHead_27();
         $data_head_28 = $this->Models_splab->dataHead_28();

         $data_head_29 = $this->Models_splab->dataHead_29();
         $data_head_30 = $this->Models_splab->dataHead_30();
         $data_head_31 = $this->Models_splab->dataHead_31();
         $data_head_32 = $this->Models_splab->dataHead_32();
         $data_head_33 = $this->Models_splab->dataHead_33();

         $mst_dokter_dta = $this->Models_splab->mstDokter();


         
 
         #print_r($data_items);
         $data = array(
             'datPasien'       => $datPasien,
             'data_head_01'       => $data_head_01,
             'data_head_02'       => $data_head_02,
             'data_head_03'       => $data_head_03,
             'data_head_04'       => $data_head_04,
             'data_head_05'       => $data_head_05,

             'data_head_06'       => $data_head_06,
             'data_head_07'       => $data_head_07,
             'data_head_08'       => $data_head_08,
             'data_head_09'       => $data_head_09,
             'data_head_10'       => $data_head_10,
             'data_head_11'       => $data_head_11,
             'data_head_12'       => $data_head_12,
             'data_head_13'       => $data_head_13,
             'data_head_14'       => $data_head_14,

             'data_head_15'       => $data_head_15,
             'data_head_16'       => $data_head_16,
             'data_head_17'       => $data_head_17,
             'data_head_18'       => $data_head_18,
             'data_head_19'       => $data_head_19,
             'data_head_20'       => $data_head_20,
             'data_head_21'       => $data_head_21,
             'data_head_22'       => $data_head_22,
             'data_head_23'       => $data_head_23,

             'data_head_24'       => $data_head_24,
             'data_head_25'       => $data_head_25,
             'data_head_26'       => $data_head_26,
             'data_head_27'       => $data_head_27,
             'data_head_28'       => $data_head_28,

             'data_head_29'       => $data_head_29,
             'data_head_30'       => $data_head_30,
             'data_head_31'       => $data_head_31,
             'data_head_32'       => $data_head_32,
             'data_head_33'       => $data_head_33,

             'mst_dokter_dta'       => $mst_dokter_dta,
          
        );
	

		$this->load->view('vsoap_modal_labm',$data);
	}

    //end test
    

    
    function hapus_lab($id_digit,$optional_page='') {
			$this->Models_splab->delete_lab_id($id_digit);
			if($optional_page=='asm_ri')
			{
				echo 'Hapus Order Laboratorium Berhasil';
			}
			else
			{
				redirect('soap/epoli/pasien_list/'.$id_reg.'/'.$rm);
			}
    }
}