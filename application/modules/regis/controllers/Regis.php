<?php
class Regis extends MX_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Regis');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
    }

    function index(){
        $this->load->view('list_regis');
    }    

    function mstdokter(){
        $data       = $this->D_Regis->mdokter();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstunit(){
        $data       = $this->D_Regis->munit();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstgender(){
        $data       = $this->D_Regis->mgender();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstagama(){
        $data       = $this->D_Regis->magama();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstpendidikan(){
        $data       = $this->D_Regis->mpendidikan();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstsuku(){
        $data       = $this->D_Regis->msuku();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstkelurahan(){
        $data       = $this->D_Regis->mkelurahan();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstkecamatan(){
        $data       = $this->D_Regis->mkecamatan();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstkota(){
        $data       = $this->D_Regis->mkota();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstpropinsi(){
        $data       = $this->D_Regis->mpropinsi();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstpaket(){
        $data       = $this->D_Regis->mpaket();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstrujukan(){
        $data       = $this->D_Regis->mrujukan();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstcomp1(){
        $data       = $this->D_Regis->mcomp1();
        $datasend = json_encode($data);
        echo $datasend;
    }
    
    function mstcomp2(){
        $data       = $this->D_Regis->mcomp2();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstcomp3(){
        $data       = $this->D_Regis->mcomp3();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstpasien(){
        $nama_pasien    = $this->input->post('valselnamapasien');
        $id_pasien      = $this->input->post('valselidpasien');
        $tgl_lahir      = $this->input->post('valseltgllahir');
        $data           = $this->D_Regis->mpasien($nama_pasien, $id_pasien, $tgl_lahir);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstgoldar(){
        $data       = $this->D_Regis->mgoldar();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstrh(){
        $data       = $this->D_Regis->mrh();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function msttandapengenal(){
        $data       = $this->D_Regis->mtandapengenal();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mststatus(){
        $data       = $this->D_Regis->mstatus();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstpekerjaan(){
        $data       = $this->D_Regis->mpekerjaan();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function msthubkel(){
        $data       = $this->D_Regis->mhubkel();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function pasienlama(){
        $id_pasien      = $this->input->post('id_pasien');
        $data_pasien    = $this->D_Regis->setpasien($id_pasien);

        $id_pasien_set              = $data_pasien->id_pasien;
        $name_pasien_set            = $data_pasien->name;
        $gender_pasien_set          = $data_pasien->gender;
        $gd_pasien_set              = $data_pasien->blood_type;
        $rh_pasien_set              = $data_pasien->rh_type;
        $tgllhr_pasien_set          = $data_pasien->birthdate;
        $tandapengenal_pasien_set   = $data_pasien->id_pid;
        $agama_pasien_set           = $data_pasien->id_agama;
        $tempatlahir_pasien_set     = $data_pasien->birthplace;
        $nomorpengenal_pasien_set   = $data_pasien->pid_num;
        $alamat_pasien_set          = $data_pasien->address;
        $kelurahan_pasien_set       = $data_pasien->id_kelurahan;
        $kecamatan_pasien_set       = $data_pasien->id_kecamatan;
        $kota_pasien_set            = $data_pasien->id_kota;
        $propinsi_pasien_set        = $data_pasien->id_propinsi;
        $kodepos_pasien_set         = $data_pasien->kodepos;
        $telp_pasien_set            = $data_pasien->telp;
        $hp_pasien_set              = $data_pasien->hp;
        $status_pasien_set          = $data_pasien->id_mar;
        $pendidikan_pasien_set      = $data_pasien->id_pend;
        $pekerjaan_pasien_set       = $data_pasien->id_job;
        $jabatan_pasien_set         = $data_pasien->job_position;
        $departemen_pasien_set      = $data_pasien->departemen;
        $kebangsaan_pasien_set      = $data_pasien->id_nation;
        $nik_pasien_set             = $data_pasien->nik;
        $namakeluarga_pasien_set    = $data_pasien->fam_name;
        $alamatkeluarga_pasien_set  = $data_pasien->fam_addr;
        $telpkeluarga_pasien_set    = $data_pasien->fam_telp;
        $hpkeluarga_pasien_set      = $data_pasien->fam_hp;
        $nomorkartu_pasien_set      = $data_pasien->asm_id;
        $namakartu_pasien_set       = $data_pasien->asm_name;
        $asalperusahaan_pasien_set  = $data_pasien->asm_comp;

        $data = array(
            'id_pasien_set'                 => $id_pasien_set,
            'name_pasien_set'               => $name_pasien_set,
            'gender_pasien_set'             => $gender_pasien_set,
            'gd_pasien_set'                 => $gd_pasien_set,
            'rh_pasien_set'                 => $rh_pasien_set,
            'tgllhr_pasien_set'             => $tgllhr_pasien_set,
            'tandapengenal_pasien_set'      => $tandapengenal_pasien_set,
            'agama_pasien_set'              => $agama_pasien_set,
            'tempatlahir_pasien_set'        => $tempatlahir_pasien_set,
            'nomorpengenal_pasien_set'      => $nomorpengenal_pasien_set,
            'alamat_pasien_set'             => $alamat_pasien_set,
            'kelurahan_pasien_set'          => $kelurahan_pasien_set,
            'kecamatan_pasien_set'          => $kecamatan_pasien_set,
            'kota_pasien_set'               => $kota_pasien_set,
            'propinsi_pasien_set'           => $propinsi_pasien_set,
            'kodepos_pasien_set'            => $kodepos_pasien_set,
            'telp_pasien_set'               => $telp_pasien_set,
            'hp_pasien_set'                 => $hp_pasien_set,
            'status_pasien_set'             => $status_pasien_set,
            'pendidikan_pasien_set'         => $pendidikan_pasien_set,
            'pekerjaan_pasien_set'          => $pekerjaan_pasien_set,
            'jabatan_pasien_set'            => $jabatan_pasien_set,
            'departemen_pasien_set'         => $departemen_pasien_set,
            'kebangsaan_pasien_set'         => $kebangsaan_pasien_set,
            'nik_pasien_set'                => $nik_pasien_set,
            'namakeluarga_pasien_set'       => $namakeluarga_pasien_set,
            'alamatkeluarga_pasien_set'     => $alamatkeluarga_pasien_set,
            'telpkeluarga_pasien_set'       => $telpkeluarga_pasien_set,
            'hpkeluarga_pasien_set'         => $hpkeluarga_pasien_set,
            'gender_pasien_set'             => $gender_pasien_set,
            #'penanggung_pasien_set'         => $penanggung_pasien_set,
			'penanggung_pasien_set'         => $namakeluarga_pasien_set,
            'nomorkartu_pasien_set'         => $nomorkartu_pasien_set,
            'namakartu_pasien_set'          => $namakartu_pasien_set,
            'asalperusahaan_pasien_set'     => $asalperusahaan_pasien_set
        );
        $datasend = json_encode($data);
        echo $datasend;
    }

    function setpasienlama(){
        $id_pasien   = $this->uri->segment(3);
        $data           = $this->D_Regis->setpasien($id_pasien);
        $datasend = json_encode($data);
        echo $datasend;
    }


    function prc_reg_new(){
        //mst_pasien
        //gen rm
        $check_last_id_pasien                   = $this->D_Regis->checklastidpasien();
        $setnourut=$check_last_id_pasien->id_pasien;
        $urutan = (int) substr($setnourut, 0, 8);
        $setincrement = $urutan+1;
        $id_pasien_pasien_baru=sprintf("%08s", $setincrement);
        //exit;
        //end gen rm
        //Pasien
        $nama_pasien_pasien_baru                = $this->input->post('nama_pasien_pasien_baru');
        $gender_pasien_baru                     = $this->input->post('gender_pasien_baru');
        $goldar_pasien_baru                     = $this->input->post('goldar_pasien_baru');
        $rh_pasien_baru                         = $this->input->post('rh_pasien_baru');
        $tgllhr_pasien_baru_set                 = $this->input->post('tgllhr_pasien_baru');
        $date_tgllhr_set_pasien_baru            = date_create($tgllhr_pasien_baru_set);
        $tgllhr_pasien_baru                     = date_format($date_tgllhr_set_pasien_baru,"Y-m-d");
        $tandapengenal_pasien_baru              = $this->input->post('tandapengenal_pasien_baru');
        $idagama_pasien_baru                    = $this->input->post('idagama_pasien_baru');
        $tempatlhr_pasien_baru                  = $this->input->post('tempatlhr_pasien_baru');
        $nomorpengenal_pasien_baru              = $this->input->post('nomorpengenal_pasien_baru');
        $setalamat_pasien_baru                  = $this->input->post('setalamat_pasien_baru');
        $idkelurahan_pasien_baru                = $this->input->post('idkelurahan_pasien_baru');
        $idkecamatan_pasien_baru                = $this->input->post('idkecamatan_pasien_baru');
        $idkota_pasien_baru                     = $this->input->post('idkota_pasien_baru');
        $idpropinsi_pasien_baru                 = $this->input->post('idpropinsi_pasien_baru');
        $kodepos_pasien_baru                    = $this->input->post('kodepos_pasien_baru');
        $telp_pasien_baru                       = $this->input->post('telp_pasien_baru');
        $hp_pasien_baru                         = $this->input->post('hp_pasien_baru');
        $status_pasien_baru                     = $this->input->post('status_pasien_baru');
        $idpendidikan_pasien_baru               = $this->input->post('idpendidikan_pasien_baru');
        $idpekerjaan_pasien_baru                = $this->input->post('idpekerjaan_pasien_baru');
        $jabatan_pasien_baru                    = $this->input->post('jabatan_pasien_baru');
        $departemen_pasien_baru                 = $this->input->post('departemen_pasien_baru');
        $idsuku_pasien_baru                     = $this->input->post('idsuku_pasien_baru');
        $nik_pasien_baru                        = $this->input->post('nik_pasien_baru');
        $namakeluarga_pasien_baru               = $this->input->post('namakeluarga_pasien_baru');
        $setalamatkeluarga_pasien_baru          = $this->input->post('setalamatkeluarga_pasien_baru');
        $telpkeluarga_pasien_baru               = $this->input->post('telpkeluarga_pasien_baru');
        $hpkeluarga_pasien_baru                 = $this->input->post('hpkeluarga_pasien_baru');
        //end Pasien
        //end mst_pasien

        //trx_reg
        //gen noreg
        $idcabang = "01";
        $check_last_id_reg_pasien                   = $this->D_Regis->checklastidregpasien();
        $setnoreg=$check_last_id_reg_pasien->id_reg;
        
        $datereal_bln = date('m');
        $datereal_thn = date('y');
        $setidregfnc = $setnoreg;
        $setnoreg_bln = substr($setidregfnc, 0, 2);
        $setnoreg_thn = substr($setidregfnc, 2, 2);
        $setnoreg_cbg = substr($setidregfnc, 4, 2);
        $urutan_reg = (int) substr($setidregfnc, 7, 11);

        //echo $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg)."<br>";

        if(($datereal_bln==$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){
            $setincrement_reg = $urutan_reg+1;
            $id_reg_pasien_baru = $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg);
        }elseif(($datereal_bln!=$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){ //tahun berjalan 
            $setincrement_reg = "00001";
            $id_reg_pasien_baru = $datereal_bln.$datereal_thn.$idcabang.$setincrement_reg;
        }elseif(($datereal_bln!=$setnoreg_bln && $datereal_thn!=$setnoreg_thn)){ //tahun selanjutnya (awal tahun)
            $setincrement_reg = "00001";
            $id_reg_pasien_baru = $datereal_bln.$datereal_thn.$idcabang.$setincrement_reg;
        }else{
            $setincrement_reg = "00001";
            $id_reg_pasien_baru = $datereal_bln.$datereal_thn.$idcabang.$setincrement_reg;
        }

        //echo $id_reg_pasien_baru;
        //exit;
        //end gen noreg
        //Poliklinik
        $iddokter1_pasien_baru                  = $this->input->post('iddokter1_pasien_baru');
        $idpoli1_pasien_baru                    = $this->input->post('idpoli1_pasien_baru');
        //end Poliklinik
        //Registrasi
        $selmstpaket_pasien_baru                = $this->input->post('selmstpaket_pasien_baru');
        //$kontrol_pasca_ranap_pasien_baru        = $this->input->post('kontrol_pasca_ranap_pasien_baru');
        //$odc_pasien_baru                        = $this->input->post('odc_pasien_baru');
        $keterangan_pasien_baru                 = $this->input->post('keterangan_pasien_baru');
        $setpenanggung_pasien_baru              = $this->input->post('setpenanggung_pasien_baru');
        $selmstrujukan_pasien_baru              = $this->input->post('selmstrujukan_pasien_baru');
        $drperujuk_pasien_baru                  = $this->input->post('drperujuk_pasien_baru');
        //$dibayartunai_reimburse_pasien_baru     = $this->input->post('dibayartunai_reimburse_pasien_baru');
        $selmstcomp1_pasien_baru                = $this->input->post('selmstcomp1_pasien_baru');
        $selmstcomp2_pasien_baru                = $this->input->post('selmstcomp2_pasien_baru');
        $selmstcomp3_pasien_baru                = $this->input->post('selmstcomp3_pasien_baru');
        $nomorasuransi_pasien_baru              = $this->input->post('nomorasuransi_pasien_baru');
        $namakartu_pasien_baru                  = $this->input->post('namakartu_pasien_baru');
        $asalperusahaan_pasien_baru             = $this->input->post('asalperusahaan_pasien_baru');
        $idhub_pasien_baru                      = $this->input->post('idhub_pasien_baru');
        $rujukan_pasien_baru                    = $this->input->post('rujukan_pasien_baru');
        $dikonfirmasioleh_pasien_baru           = $this->input->post('dikonfirmasioleh_pasien_baru');
        $tglkonfirmasi_pasien_baru_set          = $this->input->post('tglkonfirmasi_pasien_baru');
        $date_set_pasien_baru                   = date_create($tglkonfirmasi_pasien_baru_set);
        $tglkonfirmasi_pasien_baru              = date_format($date_set_pasien_baru,"Y-m-d");
        $regdate_pasien_baru                    = date('Y-m-d H:i:s');
        //end Registrasi
        //end trx_reg

        
        //mst_pasien
        $data_mst_pasien = array(  
            'id_pasien'         =>   $id_pasien_pasien_baru,
            'name'              =>   $nama_pasien_pasien_baru,
            'gender'            =>   $gender_pasien_baru,
            'blood_type'        =>   $goldar_pasien_baru,
            'rh_type'           =>   $rh_pasien_baru,
            'birthdate'         =>   $tgllhr_pasien_baru,
            'id_pid'            =>   $tandapengenal_pasien_baru,
            'id_agama'          =>   $idagama_pasien_baru,
            'birthplace'        =>   $tempatlhr_pasien_baru,
            'pid_num'           =>   $nomorpengenal_pasien_baru,
            'address'           =>   $setalamat_pasien_baru,
            'id_kelurahan'      =>   $idkelurahan_pasien_baru,
            'id_kecamatan'      =>   $idkecamatan_pasien_baru,
            'id_kota'           =>   $idkota_pasien_baru,
            'id_propinsi'       =>   $idpropinsi_pasien_baru,
            'kodepos'           =>   $kodepos_pasien_baru,
            'telp'              =>   $telp_pasien_baru,
            'hp'                =>   $hp_pasien_baru,
            'id_mar'            =>   $status_pasien_baru,
            'id_pend'           =>   $idpendidikan_pasien_baru,
            'id_job'            =>   $idpekerjaan_pasien_baru,
            'job_position'      =>   $jabatan_pasien_baru,
            'departemen'        =>   $departemen_pasien_baru,
            'id_nation'         =>   $idsuku_pasien_baru,
            'nik'               =>   $nik_pasien_baru,
            'fam_name'          =>   $namakeluarga_pasien_baru,
            'fam_addr'          =>   $setalamatkeluarga_pasien_baru,
            'fam_telp'          =>   $telpkeluarga_pasien_baru,
            'fam_hp'            =>   $hpkeluarga_pasien_baru
        );
        $this->D_Regis->createpasienbaru($data_mst_pasien,'mst_pasien'); 
        //end mst_pasien

        if(!empty($selmstpaket_pasien_baru)){
            $paketaktif             = 1;
            $check_mst_paket        = $this->D_Regis->checkmstpaket($selmstpaket_pasien_baru);
            $setnamapaket           = $check_mst_paket->name;
            $setdurationpaket       = $check_mst_paket->duration;

        //trx_reg_paket
        $data_trx_reg_paket = array(  
            'id_reg'            =>   $id_reg_pasien_baru,
            'id_paket'          =>   $selmstpaket_pasien_baru,   
            'name'              =>   $setnamapaket,
            'duration'          =>   $setdurationpaket,
            'created'           =>   $regdate_pasien_baru,
            'creator'           =>   "admin"
        );
        $this->D_Regis->createregpaket($data_trx_reg_paket,'trx_reg_paket'); 
        //end trx_reg_paket
        //check trx_reg_paket get id_trx untuk id_trx_paket
        $check_trx_reg_paket        = $this->D_Regis->checktrxregpaket($id_reg_pasien_baru);
        $settrxregpaket             = $check_trx_reg_paket->id_trx;
        //end check 
        //insert slot paket
        for($i = 0; $i<$setdurationpaket; $i++) {
            $crtslot="INSERT INTO trx_paket_aktif (id_pasien,id_paket,id_trx_paket,updated,updateby) VALUES ('$id_pasien_pasien_baru','$selmstpaket_pasien_baru','$settrxregpaket','$regdate_pasien_baru','admin')";
            $this->db->query($crtslot);
        }
        //end insert slot paket
        }else{
            $paketaktif             = 0;
            $settrxregpaket         = 0;
        }

        //trx_reg
        $data_trx_reg = array(  
            'id_reg'            =>   $id_reg_pasien_baru,
            'regdate'           =>   $regdate_pasien_baru,
            'id_pasien'         =>   $id_pasien_pasien_baru,
            'id_dokter_prt1'    =>   $iddokter1_pasien_baru,
            'id_asuransi'       =>   $selmstcomp1_pasien_baru,
            'id_provider'       =>   $selmstcomp2_pasien_baru,
            'id_company'        =>   $selmstcomp3_pasien_baru,
            'mrstat'            =>   0,
            'penanggung'        =>   $setpenanggung_pasien_baru,
            'id_rujukan'        =>   $selmstrujukan_pasien_baru,
            'person_rjk'        =>   $drperujuk_pasien_baru,
            'confirmby'         =>   $dikonfirmasioleh_pasien_baru,
            'confirmdate'       =>   $tglkonfirmasi_pasien_baru,
            'card_id'           =>   $nomorasuransi_pasien_baru,
            'card_name'         =>   $namakartu_pasien_baru,
            'card_comp'         =>   $asalperusahaan_pasien_baru,
            'card_fam'          =>   $idhub_pasien_baru,
            'card_rjk'          =>   $rujukan_pasien_baru,
            //'is_odc'            =>   $odc_pasien_baru,
            //'is_kpri'           =>   $kontrol_pasca_ranap_pasien_baru,
            'id_paket'          =>   $selmstpaket_pasien_baru,
            'paket_aktif'       =>   $paketaktif,
            'id_trx_paket'      =>   $settrxregpaket,
            'note'              =>   $keterangan_pasien_baru,
            //'cash'              =>   $dibayartunai_reimburse_pasien_baru,
            'created'           =>   $regdate_pasien_baru,
            'creator'           =>   "admin"

        );
        $this->D_Regis->createregpasienbaru($data_trx_reg,'trx_reg'); 
        //end trx_reg




        $done = "setcomplete";
        $datasend = json_encode($done);
        echo $datasend;
    }

    function prc_reg_old(){
        //trx_reg
        //gen noreg
        $idcabang = "01";
        $check_last_id_reg_pasien                   = $this->D_Regis->checklastidregpasien();
        $setnoreg=$check_last_id_reg_pasien->id_reg;
        
        $datereal_bln = date('m');
        $datereal_thn = date('y');
        $setidregfnc = $setnoreg;
        $setnoreg_bln = substr($setidregfnc, 0, 2);
        $setnoreg_thn = substr($setidregfnc, 2, 2);
        $setnoreg_cbg = substr($setidregfnc, 4, 2);
        $urutan_reg = (int) substr($setidregfnc, 7, 11);

        //echo $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg)."<br>";

        if(($datereal_bln==$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){
            $setincrement_reg = $urutan_reg+1;
            $id_reg_pasien_lama = $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg);
        }elseif(($datereal_bln!=$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){ //tahun berjalan 
            $setincrement_reg = "00001";
            $id_reg_pasien_lama = $datereal_bln.$datereal_thn.$idcabang.$setincrement_reg;
        }elseif(($datereal_bln!=$setnoreg_bln && $datereal_thn!=$setnoreg_thn)){ //tahun selanjutnya (awal tahun)
            $setincrement_reg = "00001";
            $id_reg_pasien_lama = $datereal_bln.$datereal_thn.$idcabang.$setincrement_reg;
        }else{
            $setincrement_reg = "00001";
            $id_reg_pasien_lama = $datereal_bln.$datereal_thn.$idcabang.$setincrement_reg;
        }

        //echo $id_reg_pasien_lama;
        //exit;
        //end gen noreg
        //Poliklinik
        $id_pasien_lama                         = $this->input->post('id_pasien_lama');
        $iddokter1_pasien_lama                  = $this->input->post('iddokter1_pasien_lama');
        //Registrasi
        $selmstpaket_pasien_lama                = $this->input->post('selmstpaket_pasien_lama');
        $keterangan_pasien_lama                 = $this->input->post('keterangan_pasien_lama');
        $setpenanggung_pasien_lama              = $this->input->post('setpenanggung_pasien_lama');
        $selmstrujukan_pasien_lama              = $this->input->post('selmstrujukan_pasien_lama');
        $drperujuk_pasien_lama                  = $this->input->post('drperujuk_pasien_lama');
        $selmstcomp1_pasien_lama                = $this->input->post('selmstcomp1_pasien_lama');
        $selmstcomp2_pasien_lama                = $this->input->post('selmstcomp2_pasien_lama');
        $selmstcomp3_pasien_lama                = $this->input->post('selmstcomp3_pasien_lama');
        $nomorasuransi_pasien_lama              = $this->input->post('nomorasuransi_pasien_lama');
        $namakartu_pasien_lama                  = $this->input->post('namakartu_pasien_lama');
        $asalperusahaan_pasien_lama             = $this->input->post('asalperusahaan_pasien_lama');
        $idhub_pasien_lama                      = $this->input->post('idhub_pasien_lama');
        $rujukan_pasien_lama                    = $this->input->post('rujukan_pasien_lama');
        $dikonfirmasioleh_pasien_lama           = $this->input->post('dikonfirmasioleh_pasien_lama');
        $tglkonfirmasi_pasien_lama_set          = $this->input->post('tglkonfirmasi_pasien_lama');
        $date_set_pasien_lama                   = date_create($tglkonfirmasi_pasien_lama_set);
        $tglkonfirmasi_pasien_lama              = date_format($date_set_pasien_lama,"Y-m-d");
        $regdate_pasien_lama                    = date('Y-m-d H:i:s');
        //end Registrasi
        //end trx_reg

        if(!empty($selmstpaket_pasien_lama)){
            $paketaktif             = 1;
            $check_mst_paket        = $this->D_Regis->checkmstpaket($selmstpaket_pasien_lama);
            $setnamapaket           = $check_mst_paket->name;
            $setdurationpaket       = $check_mst_paket->duration;

        //trx_reg_paket
        $data_trx_reg_paket = array(  
            'id_reg'            =>   $id_reg_pasien_lama,
            'id_paket'          =>   $selmstpaket_pasien_lama,   
            'name'              =>   $setnamapaket,
            'duration'          =>   $setdurationpaket,
            'created'           =>   $regdate_pasien_lama,
            'creator'           =>   "admin"
        );
        $this->D_Regis->createregpaket($data_trx_reg_paket,'trx_reg_paket'); 
        //end trx_reg_paket

        //check trx_reg_paket get id_trx untuk id_trx_paket
        $check_trx_reg_paket        = $this->D_Regis->checktrxregpaket($id_reg_pasien_lama);
        $settrxregpaket             = $check_trx_reg_paket->id_trx;
        //end check

        //insert slot paket
        $i = 0;
        for($i; $i<$setdurationpaket; $i++) {
            $crtslot="INSERT INTO trx_paket_aktif (id_pasien,id_paket,id_trx_paket,daycheck,updated,updateby) VALUES ('$id_pasien_lama','$selmstpaket_pasien_lama','$settrxregpaket','$i','$regdate_pasien_lama','admin')";
            $this->db->query($crtslot);
        }
        //end insert slot paket
        }else{
            $paketaktif             = 0;
            $settrxregpaket         = 0;
        }

        //trx_reg
        $data_trx_reg = array(
            'id_reg'            =>   $id_reg_pasien_lama,
            'regdate'           =>   $regdate_pasien_lama,
            'id_pasien'         =>   $id_pasien_lama,
            'id_dokter_prt1'    =>   $iddokter1_pasien_lama,
            'id_asuransi'       =>   $selmstcomp1_pasien_lama,
            'id_provider'       =>   $selmstcomp2_pasien_lama,
            'id_company'        =>   $selmstcomp3_pasien_lama,
            'mrstat'            =>   0,
            'penanggung'        =>   $setpenanggung_pasien_lama,
            'id_rujukan'        =>   $selmstrujukan_pasien_lama,
            'person_rjk'        =>   $drperujuk_pasien_lama,
            'confirmby'         =>   $dikonfirmasioleh_pasien_lama,
            'confirmdate'       =>   $tglkonfirmasi_pasien_lama,
            'card_id'           =>   $nomorasuransi_pasien_lama,
            'card_name'         =>   $namakartu_pasien_lama,
            'card_comp'         =>   $asalperusahaan_pasien_lama,
            'card_fam'          =>   $idhub_pasien_lama,
            'card_rjk'          =>   $rujukan_pasien_lama,
            'id_trx_paket'      =>   $settrxregpaket,      
            'id_paket'          =>   $selmstpaket_pasien_lama,
            'paket_aktif'       =>   $paketaktif,
            'note'              =>   $keterangan_pasien_lama,
            'created'           =>   $regdate_pasien_lama,
            'creator'           =>   "admin"

        );
        $this->D_Regis->createregpasienlama($data_trx_reg,'trx_reg'); 
        //end trx_reg

        $done = "setcomplete";
        $datasend = json_encode($done);
        echo $datasend;
    }


    function trxpasienpaketaktif(){
        $data           = $this->D_Regis->trxpasienpaketaktif();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function slotpasienpaketaktif(){
        $idtrxpaket             = $this->input->post('idtrxpaketset');
        $data                   = $this->D_Regis->slotpasienpaketaktif($idtrxpaket);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function checkin_paket(){
        $id_trx_row             = $this->input->post('id_trx_row');
        $id_trx_reg             = $this->input->post('id_trx_reg');
        $id_dokter              = $this->input->post('id_dokter');
        $id_daycheck            = $this->input->post('id_daycheck');
        $datecheck              = date('Y-m-d H:i:s');

        //echo $id_trx_reg;exit;

        ////////////////////////
        //check trx_reg_paket get id_trx untuk id_trx_paket
        $check_trx_reg_paket        = $this->D_Regis->checktrxregpaket_dayone($id_trx_reg);
        $setday1                    = $check_trx_reg_paket->daycheck;
        //end check

        if($setday1==0){
        //check trx_reg_paket get id_trx untuk id_trx_paket
        $check_trx_reg              = $this->D_Regis->checktrxregpaket_dayone_upd($id_trx_reg);
        $id_reg_pasien_baru         = $check_trx_reg->id_reg;
        //end check

        $setslot="UPDATE trx_paket_aktif SET id_reg='$id_reg_pasien_baru',checkin_date='$datecheck',id_dokter='$id_dokter',status='1' WHERE id_trx='$id_trx_row' AND daycheck='$id_daycheck'";
        $this->db->query($setslot);
        }else{
        //insert reg
            //gen noreg
            $idcabang = "01";
            $check_last_id_reg_pasien                   = $this->D_Regis->checklastidregpasien();
            $setnoreg=$check_last_id_reg_pasien->id_reg;
            
            $datereal_bln = date('m');
            $datereal_thn = date('y');
            $setidregfnc = $setnoreg;
            $setnoreg_bln = substr($setidregfnc, 0, 2);
            $setnoreg_thn = substr($setidregfnc, 2, 2);
            $setnoreg_cbg = substr($setidregfnc, 4, 2);
            $urutan_reg = (int) substr($setidregfnc, 7, 11);
    
            //echo $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg)."<br>";
    
            if(($datereal_bln==$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){
                $setincrement_reg = $urutan_reg+1;
                $id_reg_pasien_baru = $datereal_bln.$datereal_thn.$idcabang.sprintf("%05s", $setincrement_reg);
            }elseif(($datereal_bln!=$setnoreg_bln) && ($datereal_thn==$setnoreg_thn)){ //tahun berjalan 
                $setincrement_reg = "00001";
                $id_reg_pasien_baru = $datereal_bln.$datereal_thn.$idcabang.$setincrement_reg;
            }elseif(($datereal_bln!=$setnoreg_bln && $datereal_thn!=$setnoreg_thn)){ //tahun selanjutnya (awal tahun)
                $setincrement_reg = "00001";
                $id_reg_pasien_baru = $datereal_bln.$datereal_thn.$idcabang.$setincrement_reg;
            }else{
                $setincrement_reg = "00001";
                $id_reg_pasien_baru = $datereal_bln.$datereal_thn.$idcabang.$setincrement_reg;
            }
    
            $setdatatrx             = $this->D_Regis->checkdatatrxregpaket($id_trx_reg);
            $id_pasien              = $setdatatrx->id_pasien;
            $id_paket               = $setdatatrx->id_paket;

            $regdate_pasien_baru    = date('Y-m-d H:i:s');

            //trx_reg
            $data_trx_reg = array(  
                'id_reg'            =>   $id_reg_pasien_baru,
                'regdate'           =>   $regdate_pasien_baru,
                'id_pasien'         =>   $id_pasien,
                'id_paket'          =>   $id_paket,
                'paket_aktif'       =>   1,
                'paket_selesai'     =>   0,
                'id_trx_paket'      =>   $id_trx_reg,
                'created'           =>   $regdate_pasien_baru,
                'creator'           =>   "admin"
    
            );
            $this->D_Regis->createregpasienbaru($data_trx_reg,'trx_reg'); 
            //end trx_reg
 
        //end insert reg
        $setslot="UPDATE trx_paket_aktif SET id_reg='$id_reg_pasien_baru',checkin_date='$datecheck',id_dokter='$id_dokter',status='1' WHERE id_trx='$id_trx_row' AND daycheck='$id_daycheck'";
        $this->db->query($setslot);
        }

        $done = "setcomplete";
        $datasend = json_encode($done);
        echo $datasend;
    }

    //checkin_paket

}
?>