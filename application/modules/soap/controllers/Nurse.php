<?php
class Nurse extends MX_controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Nurse');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }
    function index(){
        $this->load->view('list_pasien_nurse');
    }

    ///////////////////////////////LIST PASIEN
    function listpasien(){
        $id_role    = @$this->session->userdata['sp']->id_role;
        $id_dokter  = @$this->session->userdata['sp']->id_dokter;
        //$nmpasien   = $this->input->post('nmpasien');

        $data       = $this->D_Nurse->mpasien();
        $datasend = json_encode($data);
        echo $datasend;
    }
    ///////////////////////////////END LIST PASIEN

    function searchlastttv(){
        $id_reg    = $this->input->post('set_reg');
        $id_pasien = $this->input->post('set_pasien');

        $data       = $this->D_Nurse->lastttv($id_reg,$id_pasien);
        $datasend = json_encode($data);
        echo $datasend; 
    }

    function searchlastsoap(){
        $id_reg    = $this->input->post('set_reg');
        $id_pasien = $this->input->post('set_pasien');

        $data       = $this->D_Nurse->lastsoap($id_reg,$id_pasien);
        $datasend = json_encode($data);
        echo $datasend; 
    }

    function savettv(){
        $username              = @$this->session->userdata['sp']->username;
        $datenow                 = DATE('Y-m-d H:i:s');
        $id_reg                  = $this->input->post('id_reg');
        $nama_pasien_set         = $this->input->post('nama_pasien');
        $id_pasien               = $this->input->post('id_pasien');
        $kesadaran               = $this->input->post('kesadaran');
        $td                      = $this->input->post('td');
        $nadi                    = $this->input->post('nadi');
        $berat                   = $this->input->post('berat');
        $tinggi                  = $this->input->post('tinggi');
        $keadaan_umum            = $this->input->post('keadaan_umum');
        $gcs                     = $this->input->post('gcs');
        $suhu                    = $this->input->post('suhu');
        $reaksi_cahaya           = $this->input->post('reaksi_cahaya');
        $nafas                   = $this->input->post('nafas');
        $sbar_1                  = $this->input->post('sbar_1');
        $sbar_2                  = $this->input->post('sbar_2');
        $sbar_3                  = $this->input->post('sbar_3');
        $sbar_4                  = $this->input->post('sbar_4');
        $id_operator             = $this->input->post('id_operator');
        $send                    = $this->input->post('id_act');
        $qty                     = $this->input->post('qty');
        $name                    = $this->input->post('nama_tindakan');
        $price                   = $this->input->post('price');
        $id_grup                 = $this->input->post('group');
        $chk_status_psikologi    = $this->input->post('status_psikologi');
        $chk_status_ekonomi      = $this->input->post('status_ekonomi');
        $chk_status_spiritual    = $this->input->post('status_spiritual');
        $chk_resiko_jatuh        = $this->input->post('resiko_jatuh');
        $chk_status_nyeri        = $this->input->post('status_nyeri');
        $chk_skrining_gizi       = $this->input->post('skrining_gizi');

        $chk_status_psikologi	 = $this->input->post('status_psikologi');
        $status_psikologi	     = implode(',',(array) $chk_status_psikologi);

        $chk_status_spiritual	 = $this->input->post('status_spiritual');
        $status_spiritual		 = implode(',',(array) $chk_status_spiritual);

        $chk_resiko_jatuh	     = $this->input->post('resiko_jatuh');
        $resiko_jatuh			 = implode(',',(array) $chk_resiko_jatuh);

        $chk_status_nyeri	     = $this->input->post('status_nyeri');
        $status_nyeri			 = implode(',',(array) $chk_status_nyeri);

        $chk_skrining_gizi	     = $this->input->post('skrining_gizi');
        $skrining_gizi			 = implode(',',(array) $chk_skrining_gizi);

        $chk_status_ekonomi	     = $this->input->post('status_ekonomi');
        $status_ekonomi			 = implode(',',(array) $chk_status_ekonomi);
            
        $datetime                = date('Y-m-d H:i:s');

        //checkdata reg soap
        $datasoapasmri         = $this->D_Nurse->checkregsoap($id_reg);
        $checkdatafnd          = $datasoapasmri->fnddata;
        //end checkdata reg soap


        $data = array(
            'id_reg'        => $id_reg,
            'id_pasien'     => $id_pasien,
            'kesadaran'     => $kesadaran,
            'tekanan_darah' => $td,
            'nadi'          => $nadi,
            'berat_badan'   => $berat,
            'tinggi_badan'  => $tinggi,
            'keadaan_umum'  => $keadaan_umum,
            'gcs'           => $gcs,
            'suhu'          => $suhu,
            'reaksi_pupil'  => $reaksi_cahaya,
            'pernafasan'    => $nafas,
            'created'       => $datenow,
            'created_by'    => $username
        );


        $this->D_Nurse->insdata($data,'soap_ttv'); 

        $datasbar = array(
            'id_reg'                  => $id_reg,
            'id_pasien'               => $id_pasien,
            'sbar_1'                  => $sbar_1,
            'sbar_2'                  => $sbar_2,
            'sbar_3'                  => $sbar_3,
            'sbar_4'                  => $sbar_4,
            'status_psikologi'        => $status_psikologi,
            'status_ekonomi'          => $status_ekonomi,
            'status_spiritual'        => $status_spiritual,
            'resiko_jatuh'            => $resiko_jatuh,
            'status_nyeri'            => $status_nyeri,
            'skrining_gizi'           => $skrining_gizi,
            'created'                 => $datenow,
            'created_by'              => $username
        );


        $this->D_Nurse->insdata_sbar($datasbar,'soap_sbar'); 
        
        $datattvsoap = array(
            'kesadaran'         => $kesadaran,
            'td'                => $td,
            'nadi'              => $nadi,
            'berat'             => $berat,
            'tinggi'            => $tinggi,
            'keadaan_umum'      => $keadaan_umum,
            'gcs'               => $gcs,
            'suhu'              => $suhu,
            'reaksi_cahaya'     => $reaksi_cahaya,
            'nafas'             => $nafas
        );
    
        $wherettvsoap = array(
                'id_reg' => $id_reg, 
        );
        $this->D_Nurse->update_data($wherettvsoap, $datattvsoap,'soap_asm_ri');
                
        //segment untuk soap perawat
        if($checkdatafnd > 0){

            $dataperawat = array(
                'subjective'              => $sbar_1,
                'objective'               => $sbar_2,
                'assesment'               => $sbar_3,
                'planning'			      => $sbar_4,
                'planning_text'	          => $sbar_4,
                'status_psikologi'        => $status_psikologi,
                'status_ekonomi'          => $status_ekonomi,
                'status_spiritual'        => $status_spiritual,
                'resiko_jatuh'            => $resiko_jatuh,
                'status_nyeri'            => $status_nyeri,
                'skrining_gizi'           => $skrining_gizi,
                'updated'	              => date('Y-m-d H:i:s'),
                'updator'                 => $username
            );

            $wheredataperawat = array(
                'id_reg'                => $id_reg,
                'id_type'               => '3',
                'jenis_asm'             => 'PERAWAT',
                'kategori'	            => 'CPPT'
            );
            $this->D_Nurse->update_data_perawat($wheredataperawat, $dataperawat,'soap_asm_ri');

        }else{
            $getdatasoapnyah         = $this->D_Nurse->getdatasoap($id_reg);

            $dataperawat = array(
                'asmri_date'			  => date('Y-m-d H:i:s'),
                'regdate'                 => $getdatasoapnyah->regdate,
                'tgl_pengkajian'          => date('Y-m-d H:i:s'),
                'asal_masuk'              => $getdatasoapnyah->asal_masuk,
                'cara_masuk'              => $getdatasoapnyah->cara_masuk,
                'id_reg'                  => $id_reg,
                'id_pasien'               => $id_pasien,
                'nama_pasien'             => $nama_pasien_set,
                'id_type'                 => '3',
                'jenis_asm'               => 'PERAWAT',
                'kategori'	              => 'CPPT',
                'subjective'              => $sbar_1,
                'objective'               => $sbar_2,
                'assesment'               => $sbar_3,
                'planning'			      => $sbar_4,
                'planning_text'	          => $sbar_4,
                'status_psikologi'        => $status_psikologi,
                'status_ekonomi'          => $status_ekonomi,
                'status_spiritual'        => $status_spiritual,
                'resiko_jatuh'            => $resiko_jatuh,
                'status_nyeri'            => $status_nyeri,
                'skrining_gizi'           => $skrining_gizi,
                'created'	              => date('Y-m-d H:i:s'),
                'creator'                 => $username
            );
            $this->D_Nurse->insdata_soap_perawat($dataperawat,'soap_asm_ri'); 
        }
        //end segment untuk soap perawat

            //tindakan

                if(empty($send)){
                    //nothing
                }else{
                foreach($send as $k => $v){
                    $qtyset    = $qty[$k];
                    $nameset   = $name[$k];
                    $priceset  = $price[$k];
                    $totalset  = ($priceset * $qtyset);
                    $idgrupset = $id_grup[$k];
                    $idoperset = $id_operator[$k];
                    $data_trx_reg_act = array(  
                        'id_reg'             =>   $id_reg,
                        'id_dokter'          =>   $idoperset,
                        'id_reg_act'         =>   $v,
                        'trxdate'            =>   $datetime,
                        'operator'           =>   $idoperset,
                        'qty'                =>   $qtyset,
                        'name'               =>   $nameset,
                        'price'              =>   $priceset,
                        'id_group_act'       =>   $idgrupset,
                        'total'              =>   $totalset,
                        'created'            =>   $datetime,
                        'creator'            =>   $username
                    );
                    $this->D_Nurse->createregact($data_trx_reg_act,'trx_reg_act'); 
                }
                }
              
            //end tindakan

        $setres   = "ok";
        $datasend = json_encode($setres);
        echo $datasend;

    }

    function riwayatmedis(){
        $id_pasien    = $this->input->post('set_id_pasien');
        $data         = $this->D_Nurse->mdlriwayatmedis($id_pasien);
        $datasend     = json_encode($data);
        echo $datasend;
    }
    

}
?>