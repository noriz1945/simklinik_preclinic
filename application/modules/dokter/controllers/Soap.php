<?php
class Soap extends MX_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('D_Soap');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('encryption');
        $this->load->library('SmartLib');
    }

    function asm($id_reg){
		$data_pasien	= $this->smartlib->get_data_pasien_by_id_reg($id_reg);
		$id_pasien = $data_pasien['id_pasien'];

		$riwayat_pasien	= $this->smartlib->riwayat_pasien($id_pasien);

		$row = $this->D_Soap->get_data_asm_ri_dokter($id_reg);
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
        $baseUrl = base_url('');

        $data = array(
            'id_reg'            => $id_reg,
            'id_pasien'         => $id_pasien,
            'baseUrl'           => $baseUrl,
            'row'               => $row,
            'sql_command'		=> $sql_command,
            'arr_ten_text'	    => $arr_ten_text,
            'arr_ten'           => $arr_ten,
            'arr_nine_text'	    => $arr_nine_text,
            'arr_nine'			=> $arr_nine,
            'riwayat_pasien'    => $riwayat_pasien
        );

        $this->load->view('asm', $data);
    }

    //MST 
    function mststatus(){
        $data       = $this->D_Soap->mstatus();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstpendidikan(){
        $data       = $this->D_Soap->mpendidikan();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstpekerjaan(){
        $data       = $this->D_Soap->mpekerjaan();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function msthubkel(){
        $data       = $this->D_Soap->mhubkel();
        $datasend = json_encode($data);
        echo $datasend;
    }

    function mstagama(){
        $data       = $this->D_Soap->magama();
        $datasend = json_encode($data);
        echo $datasend;
    }

    ///
    function mstwajibberibadah(){
        $data       = $this->D_Soap->mstwajibberibadah();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstthaharoh(){
        $data       = $this->D_Soap->mstthaharoh();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstsholat(){
        $data       = $this->D_Soap->mstsholat();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_kepala(){
        $data       = $this->D_Soap->mstpu_kepala();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_rambut(){
        $data       = $this->D_Soap->mstpu_rambut();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_wajah(){
        $data       = $this->D_Soap->mstpu_wajah();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_mata(){
        $data       = $this->D_Soap->mstpu_mata();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_gigi(){
        $data       = $this->D_Soap->mstpu_gigi();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_tenggorokan(){
        $data       = $this->D_Soap->mstpu_tenggorokan();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_lidah(){
        $data       = $this->D_Soap->mstpu_lidah();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_leher(){
        $data       = $this->D_Soap->mstpu_leher();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_abdomen(){
        $data       = $this->D_Soap->mstpu_abdomen();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_dada(){
        $data       = $this->D_Soap->mstpu_dada();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_respirasi(){
        $data       = $this->D_Soap->mstpu_respirasi();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_jantung(){
        $data       = $this->D_Soap->mstpu_jantung();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_integumen(){
        $data       = $this->D_Soap->mstpu_integumen();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_ekstremitas(){
        $data       = $this->D_Soap->mstpu_ekstremitas();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_genetalia(){
        $data       = $this->D_Soap->mstpu_genetalia();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpu_elimitas(){
        $data       = $this->D_Soap->mstpu_elimitas();
        $datasend = json_encode($data);
        echo $datasend;
    }
    function mstpengaruh_nyeri(){
        $data       = $this->D_Soap->mstpengaruh_nyeri();
        $datasend = json_encode($data);
        echo $datasend;
    }

    //END MST

    function trxregpasien(){
        $id_reg_set = $this->input->post('id_reg_set');
        $data       = $this->D_Soap->setdatatrx($id_reg_set);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function proses(){
        $id_reg      = $this->input->post('id_reg');

        //SELECT
        $sse_nikah              = $this->input->post('selmststatus_set');
        $sse_study              = $this->input->post('selmstpendidikan_set');
        $sse_agama              = $this->input->post('selmstagama_set');
        $sse_job                = $this->input->post('selmstpekerjaan_set');
        $sse_live               = $this->input->post('selmsthubkel_set');
        $ibadah                 = $this->input->post('selmstibadah_set');
        $thaharoh               = $this->input->post('selmstthaharoh_set');
        $sholat                 = $this->input->post('selmstsholat_set');
        $pu_kepala              = $this->input->post('selmstpukepala_set');
        $pu_rambut              = $this->input->post('selmstpurambut_set');
        $pu_wajah               = $this->input->post('selmstpuwajah_set');
        $pu_mata                = $this->input->post('selmstpumata_set');
        $pu_gigi                = $this->input->post('selmstpugigi_set');
        $pu_tenggorokan         = $this->input->post('selmstputenggorokan_set');
        $pu_lidah               = $this->input->post('selmstpulidah_set');
        $pu_leher               = $this->input->post('selmstpuleher_set');
        $pu_abdomen             = $this->input->post('selmstpuabdomen_set');
        $pu_dada                = $this->input->post('selmstpudada_set');
        $pu_respirasi           = $this->input->post('selmstpurespirasi_set');
        $pu_jantung             = $this->input->post('selmstpujantung_set');
        $pu_integumen           = $this->input->post('selmstpuintegumen_set');
        $pu_ekstremitas         = $this->input->post('selmstpuekstremitas_set');
        $pu_genetalia           = $this->input->post('selmstpugenetalia_set');
        $pu_elimitas            = $this->input->post('selmstpuelimitas_set');
        $pengaruh_nyeri         = $this->input->post('selmstpupengaruhnyeri_set');
        //END SELECT
        //TEXT
        $tgl_pengkajian                = $this->input->post('tgl_pengkajian');
        $keluhan_utama                 = $this->input->post('keluhan_utama');
        $riwayat_pengobatan            = $this->input->post('riwayat_pengobatan');
        $riwayat_sakit                 = $this->input->post('riwayat_sakit');
        $riwayat_sakit_keluarga        = $this->input->post('riwayat_sakit_keluarga');
        $riwayat_sakit_dulu            = $this->input->post('riwayat_sakit_dulu');
        $riwayat_alergi                = $this->input->post('riwayat_alergi');
        $objective                     = $this->input->post('objective');
        $status_kultural               = $this->input->post('status_kultural');
        $kesadaran                     = $this->input->post('kesadaran');
        $td                            = $this->input->post('td');
        $nadi                          = $this->input->post('nadi');
        $nafas                         = $this->input->post('nafas');
        $tinggi                        = $this->input->post('tinggi');
        $keadaan_umum                  = $this->input->post('keadaan_umum');
        $gcs                           = $this->input->post('gcs');
        $suhu                          = $this->input->post('suhu');
        $reaksi_cahaya                 = $this->input->post('reaksi_cahaya');
        $berat                         = $this->input->post('berat');
        $fisik_khusus                  = $this->input->post('fisik_khusus');
        $frekuensi_nyeri               = $this->input->post('frekuensi_nyeri');
        $total_skor                    = $this->input->post('total_skor');
        $pola_makan                    = $this->input->post('pola_makan');
        $sf_makan                      = $this->input->post('sf_makan');
        $sf_transfer                   = $this->input->post('sf_transfer');
        $sf_grooming                   = $this->input->post('sf_grooming');
        $sf_toilet                     = $this->input->post('sf_toilet');
        $sf_mandi                      = $this->input->post('sf_mandi');
        $sf_jalan                      = $this->input->post('sf_jalan');
        $sf_tangga                     = $this->input->post('sf_tangga');
        $sf_berpakaian                 = $this->input->post('sf_berpakaian');
        $sf_bowel                      = $this->input->post('sf_bowel');
        $sf_bladder                    = $this->input->post('sf_bladder');
        $sf_total                      = $this->input->post('sf_total');
        $pemeriksaan_penunjang         = $this->input->post('pemeriksaan_penunjang');
        $masalah_kesehatan             = $this->input->post('masalah_kesehatan');
        $masalah_keperawatan           = $this->input->post('masalah_keperawatan');
        $rencana_keperawatan           = $this->input->post('rencana_keperawatan');
        $sf_total_set                  = $sf_makan+$sf_transfer+$sf_grooming+$sf_toilet+$sf_mandi+$sf_jalan+$sf_tangga+$sf_berpakaian+$sf_bowel+$sf_bladder;
        //END TEXT
        //RADIO
        $asal_masuk                    = $this->input->post('asal_masuk');
        $cara_masuk                    = $this->input->post('cara_masuk');
        $kualitas_nyeri                = $this->input->post('kualitas_nyeri');
        $waktu_nyeri                   = $this->input->post('waktu_nyeri');
        $intesnsitas_nyeri             = $this->input->post('intesnsitas_nyeri');
        $nyeri                         = $this->input->post('nyeri');
        $aktivitas                     = $this->input->post('aktivitas');
        $restrain                      = $this->input->post('restrain');
        $bb_turun                      = $this->input->post('bb_turun');
        $bb_turun_qty                  = $this->input->post('bb_turun_qty');
        $nafsu_makan                   = $this->input->post('nafsu_makan');
        $diagnosa_khusus               = $this->input->post('diagnosa_khusus');
        $resiko_jatuh_dws              = $this->input->post('resiko_jatuh_dws');
        $resiko_jatuh_gr               = $this->input->post('resiko_jatuh_gr');
        $resiko_jatuh_anak             = $this->input->post('resiko_jatuh_anak');
        $sf_total_skor_set             = $bb_turun+$bb_turun_qty+$nafsu_makan;
        //check
        $check_asmri            = $this->D_Soap->checkasmrinya($id_reg);
        $fnddata                = $check_asmri->fnddata;
        $id_asmri               = $check_asmri->id_asmri;
        //end check
        $datereg    = date('Y-m-d H:i:s');
        if($fnddata < 1){
            $data_trx_reg_asmri = array(  
                'id_reg'                            =>     $id_reg,
                'sse_nikah'                         =>     $sse_nikah,
                'sse_study'                         =>     $sse_study,
                'sse_agama'                         =>     $sse_agama,
                'sse_job'                           =>     $sse_job,
                'sse_live'                          =>     $sse_live,
                'ibadah'                            =>     $ibadah,
                'thaharoh'                          =>     $thaharoh,
                'sholat'                            =>     $sholat,
                'pu_kepala'                         =>     $pu_kepala,
                'pu_rambut'                         =>     $pu_rambut,
                'pu_wajah'                          =>     $pu_wajah,
                'pu_mata'                           =>     $pu_mata,
                'pu_gigi'                           =>     $pu_gigi,
                'pu_tenggorokan'                    =>     $pu_tenggorokan,
                'pu_lidah'                          =>     $pu_lidah,
                'pu_leher'                          =>     $pu_leher,
                'pu_abdomen'                        =>     $pu_abdomen,
                'pu_dada'                           =>     $pu_dada,
                'pu_respirasi'                      =>     $pu_respirasi,
                'pu_jantung'                        =>     $pu_jantung,
                'pu_integumen'                      =>     $pu_integumen,
                'pu_ekstremitas'                    =>     $pu_ekstremitas,
                'pu_genetalia'                      =>     $pu_genetalia,
                'pu_elimitas'                       =>     $pu_elimitas,
                'pengaruh_nyeri'                    =>     $pengaruh_nyeri,
                'tgl_pengkajian'                    =>     $tgl_pengkajian,
                'keluhan_utama'                     =>     $keluhan_utama,
                'riwayat_pengobatan'                =>     $riwayat_pengobatan,
                'riwayat_sakit'                     =>     $riwayat_sakit,
                'riwayat_sakit_keluarga'            =>     $riwayat_sakit_keluarga,
                'riwayat_sakit_dulu'                =>     $riwayat_sakit_dulu,
                'riwayat_alergi'                    =>     $riwayat_alergi,
                'objective'                         =>     $objective,
                'status_kultural'                   =>     $status_kultural,
                'kesadaran'                         =>     $kesadaran,
                'td'                                =>     $td,
                'nadi'                              =>     $nadi,
                'nafas'                             =>     $nafas,
                'tinggi'                            =>     $tinggi,
                'keadaan_umum'                      =>     $keadaan_umum,
                'gcs'                               =>     $gcs,
                'suhu'                              =>     $suhu,
                'reaksi_cahaya'                     =>     $reaksi_cahaya,
                'berat'                             =>     $berat,
                'fisik_khusus'                      =>     $fisik_khusus,
                'frekuensi_nyeri'                   =>     $frekuensi_nyeri,
                'total_skor'                        =>     $sf_total_skor_set,
                'pola_makan'                        =>     $pola_makan,
                'sf_makan'                          =>     $sf_makan,
                'sf_transfer'                       =>     $sf_transfer,
                'sf_grooming'                       =>     $sf_grooming,
                'sf_toilet'                         =>     $sf_toilet,
                'sf_mandi'                          =>     $sf_mandi,
                'sf_jalan'                          =>     $sf_jalan,
                'sf_tangga'                         =>     $sf_tangga,
                'sf_berpakaian'                     =>     $sf_berpakaian,
                'sf_bowel'                          =>     $sf_bowel,
                'sf_bladder'                        =>     $sf_bladder,
                'sf_total'                          =>     $sf_total_set,
                'pemeriksaan_penunjang'             =>     $pemeriksaan_penunjang,
                'masalah_kesehatan'                 =>     $masalah_kesehatan,
                'masalah_keperawatan'               =>     $masalah_keperawatan,
                'rencana_keperawatan'               =>     $rencana_keperawatan,
                'asal_masuk'                        =>     $asal_masuk,
                'cara_masuk'                        =>     $cara_masuk,
                'kualitas_nyeri'                    =>     $kualitas_nyeri,
                'waktu_nyeri'                       =>     $waktu_nyeri,
                'intesnsitas_nyeri'                 =>     $intesnsitas_nyeri,
                'nyeri'                             =>     $nyeri,
                'aktivitas'                         =>     $aktivitas,
                'restrain'                          =>     $restrain,
                'bb_turun'                          =>     $bb_turun,
                'bb_turun_qty'                      =>     $bb_turun_qty,
                'nafsu_makan'                       =>     $nafsu_makan,
                'diagnosa_khusus'                   =>     $diagnosa_khusus,
                'resiko_jatuh_dws'                  =>     $resiko_jatuh_dws,
                'resiko_jatuh_gr'                   =>     $resiko_jatuh_gr,
                'resiko_jatuh_anak'                 =>     $resiko_jatuh_anak,
                'created'                           =>     $datereg
            );
            $this->D_Soap->createregasmri($data_trx_reg_asmri,'soap_asm_ri'); 
        }else{
            $date = date('Y-m-d H:i:s');
            $updateasmri="UPDATE soap_asm_ri SET 
            regdate                     ='$date',
            id_reg                      ='$id_reg',
            sse_nikah                   ='$sse_nikah',
            sse_study                   ='$sse_study',
            sse_agama                   ='$sse_agama',
            sse_job                     ='$sse_job',
            sse_live                    ='$sse_live',
            ibadah                      ='$ibadah',
            thaharoh                    ='$thaharoh',
            sholat                      ='$sholat',
            pu_kepala                   ='$pu_kepala',
            pu_rambut                   ='$pu_rambut',
            pu_wajah                    ='$pu_wajah',
            pu_mata                     ='$pu_mata',
            pu_gigi                     ='$pu_gigi',
            pu_tenggorokan              ='$pu_tenggorokan',
            pu_lidah                    ='$pu_lidah',
            pu_leher                    ='$pu_leher',
            pu_abdomen                  ='$pu_abdomen',
            pu_dada                     ='$pu_dada',
            pu_respirasi                ='$pu_respirasi',
            pu_jantung                  ='$pu_jantung',
            pu_integumen                ='$pu_integumen',
            pu_ekstremitas              ='$pu_ekstremitas',
            pu_genetalia                ='$pu_genetalia',
            pu_elimitas                 ='$pu_elimitas',
            pengaruh_nyeri              ='$pengaruh_nyeri',
            tgl_pengkajian              ='$tgl_pengkajian',
            keluhan_utama               ='$keluhan_utama',
            riwayat_pengobatan          ='$riwayat_pengobatan',
            riwayat_sakit               ='$riwayat_sakit',
            riwayat_sakit_keluarga      ='$riwayat_sakit_keluarga',
            riwayat_sakit_dulu          ='$riwayat_sakit_dulu',
            riwayat_alergi              ='$riwayat_alergi',
            objective                   ='$objective',
            status_kultural             ='$status_kultural',
            kesadaran                   ='$kesadaran',
            td                          ='$td',
            nadi                        ='$nadi',
            nafas                       ='$nafas',
            tinggi                      ='$tinggi',
            keadaan_umum                ='$keadaan_umum',
            gcs                         ='$gcs',
            suhu                        ='$suhu',
            reaksi_cahaya               ='$reaksi_cahaya',
            berat                       ='$berat',
            fisik_khusus                ='$fisik_khusus',
            frekuensi_nyeri             ='$frekuensi_nyeri',
            total_skor                  ='$total_skor',
            pola_makan                  ='$pola_makan',
            sf_makan                    ='$sf_makan',
            sf_transfer                 ='$sf_transfer',
            sf_grooming                 ='$sf_grooming',
            sf_toilet                   ='$sf_toilet',
            sf_mandi                    ='$sf_mandi',
            sf_jalan                    ='$sf_jalan',
            sf_tangga                   ='$sf_tangga',
            sf_berpakaian               ='$sf_berpakaian',
            sf_bowel                    ='$sf_bowel',
            sf_bladder                  ='$sf_bladder',
            sf_total                    ='$sf_total_set',
            pemeriksaan_penunjang       ='$pemeriksaan_penunjang',
            masalah_kesehatan           ='$masalah_kesehatan',
            masalah_keperawatan         ='$masalah_keperawatan',
            rencana_keperawatan         ='$rencana_keperawatan',
            asal_masuk                  ='$asal_masuk',
            cara_masuk                  ='$cara_masuk',
            kualitas_nyeri              ='$kualitas_nyeri',
            waktu_nyeri                 ='$waktu_nyeri',
            intesnsitas_nyeri           ='$intesnsitas_nyeri',
            nyeri                       ='$nyeri',
            aktivitas                   ='$aktivitas',
            restrain                    ='$restrain',
            bb_turun                    ='$bb_turun',
            bb_turun_qty                ='$bb_turun_qty',
            nafsu_makan                 ='$nafsu_makan',
            diagnosa_khusus             ='$diagnosa_khusus',
            resiko_jatuh_dws            ='$resiko_jatuh_dws',
            resiko_jatuh_gr             ='$resiko_jatuh_gr',
            resiko_jatuh_anak           ='$resiko_jatuh_anak',
            updated                     ='$datereg'
            WHERE id_reg='$id_reg'";
            $this->db->query($updateasmri);
        }

        redirect('soap/rm/'.$id_reg);
    }

    function proses_save(){
        $id_reg      = $this->input->post('id_reg');

        //SELECT
        $sse_nikah              = $this->input->post('selmststatus_add');
        $sse_study              = $this->input->post('selmstpendidikan_add');
        $sse_agama              = $this->input->post('selmstagama_add');
        $sse_job                = $this->input->post('selmstpekerjaan_add');
        $sse_live               = $this->input->post('selmsthubkel_add');
        $ibadah                 = $this->input->post('selmstibadah_add');
        $thaharoh               = $this->input->post('selmstthaharoh_add');
        $sholat                 = $this->input->post('selmstsholat_add');
        $pu_kepala              = $this->input->post('selmstpukepala_add');
        $pu_rambut              = $this->input->post('selmstpurambut_add');
        $pu_wajah               = $this->input->post('selmstpuwajah_add');
        $pu_mata                = $this->input->post('selmstpumata_add');
        $pu_gigi                = $this->input->post('selmstpugigi_add');
        $pu_tenggorokan         = $this->input->post('selmstputenggorokan_add');
        $pu_lidah               = $this->input->post('selmstpulidah_add');
        $pu_leher               = $this->input->post('selmstpuleher_add');
        $pu_abdomen             = $this->input->post('selmstpuabdomen_add');
        $pu_dada                = $this->input->post('selmstpudada_add');
        $pu_respirasi           = $this->input->post('selmstpurespirasi_add');
        $pu_jantung             = $this->input->post('selmstpujantung_add');
        $pu_integumen           = $this->input->post('selmstpuintegumen_add');
        $pu_ekstremitas         = $this->input->post('selmstpuekstremitas_add');
        $pu_genetalia           = $this->input->post('selmstpugenetalia_add');
        $pu_elimitas            = $this->input->post('selmstpuelimitas_add');
        $pengaruh_nyeri         = $this->input->post('selmstpupengaruhnyeri_add');
        //END SELECT
        //TEXT
        $tgl_pengkajian                = $this->input->post('tgl_pengkajian_add');
        $keluhan_utama                 = $this->input->post('keluhan_utama_add');
        $riwayat_pengobatan            = $this->input->post('riwayat_pengobatan_add');
        $riwayat_sakit                 = $this->input->post('riwayat_sakit_add');
        $riwayat_sakit_keluarga        = $this->input->post('riwayat_sakit_keluarga_add');
        $riwayat_sakit_dulu            = $this->input->post('riwayat_sakit_dulu_add');
        $riwayat_alergi                = $this->input->post('riwayat_alergi_add');
        $objective                     = $this->input->post('objective_add');
        $status_kultural               = $this->input->post('status_kultural_add');
        $kesadaran                     = $this->input->post('kesadaran_add');
        $td                            = $this->input->post('td_add');
        $nadi                          = $this->input->post('nadi_add');
        $nafas                         = $this->input->post('nafas_add');
        $tinggi                        = $this->input->post('tinggi_add');
        $keadaan_umum                  = $this->input->post('keadaan_umum_add');
        $gcs                           = $this->input->post('gcs_add');
        $suhu                          = $this->input->post('suhu_add');
        $reaksi_cahaya                 = $this->input->post('reaksi_cahaya_add');
        $berat                         = $this->input->post('berat_add');
        $fisik_khusus                  = $this->input->post('fisik_khusus_add');
        $frekuensi_nyeri               = $this->input->post('frekuensi_nyeri_add');
        $total_skor                    = $this->input->post('total_skor_add');
        $pola_makan                    = $this->input->post('pola_makan_add');
        $sf_makan                      = $this->input->post('sf_makan_add');
        $sf_transfer                   = $this->input->post('sf_transfer_add');
        $sf_grooming                   = $this->input->post('sf_grooming_add');
        $sf_toilet                     = $this->input->post('sf_toilet_add');
        $sf_mandi                      = $this->input->post('sf_mandi_add');
        $sf_jalan                      = $this->input->post('sf_jalan_add');
        $sf_tangga                     = $this->input->post('sf_tangga_add');
        $sf_berpakaian                 = $this->input->post('sf_berpakaian_add');
        $sf_bowel                      = $this->input->post('sf_bowel_add');
        $sf_bladder                    = $this->input->post('sf_bladder_add');
        $sf_total                      = $this->input->post('sf_total_add');
        $pemeriksaan_penunjang         = $this->input->post('pemeriksaan_penunjang_add');
        $masalah_kesehatan             = $this->input->post('masalah_kesehatan_add');
        $masalah_keperawatan           = $this->input->post('masalah_keperawatan_add');
        $rencana_keperawatan           = $this->input->post('rencana_keperawatan_add');
        $sf_total_set                  = $sf_makan+$sf_transfer+$sf_grooming+$sf_toilet+$sf_mandi+$sf_jalan+$sf_tangga+$sf_berpakaian+$sf_bowel+$sf_bladder;
        //END TEXT
        //RADIO
        $asal_masuk                    = $this->input->post('asal_masuk_add');
        $cara_masuk                    = $this->input->post('cara_masuk_add');
        $kualitas_nyeri                = $this->input->post('kualitas_nyeri_add');
        $waktu_nyeri                   = $this->input->post('waktu_nyeri_add');
        $intesnsitas_nyeri             = $this->input->post('intesnsitas_nyeri_add');
        $nyeri                         = $this->input->post('nyeri_add');
        $aktivitas                     = $this->input->post('aktivitas_add');
        $restrain                      = $this->input->post('restrain_add');
        $bb_turun                      = $this->input->post('bb_turun_add');
        $bb_turun_qty                  = $this->input->post('bb_turun_qty_add');
        $nafsu_makan                   = $this->input->post('nafsu_makan_add');
        $diagnosa_khusus               = $this->input->post('diagnosa_khusus_add');
        $resiko_jatuh_dws              = $this->input->post('resiko_jatuh_dws_add');
        $resiko_jatuh_gr               = $this->input->post('resiko_jatuh_gr_add');
        $resiko_jatuh_anak             = $this->input->post('resiko_jatuh_anak_add');
        $sf_total_skor_set             = $bb_turun+$bb_turun_qty+$nafsu_makan;
        //check
        $check_asmri            = $this->D_Soap->checkasmrinya($id_reg);
        $fnddata                = $check_asmri->fnddata;
        $id_asmri               = $check_asmri->id_asmri;
        //end check
        $datereg    = date('Y-m-d H:i:s');

            $data_trx_reg_asmri = array(  
                'id_reg'                            =>     $id_reg,
                'sse_nikah'                         =>     $sse_nikah,
                'sse_study'                         =>     $sse_study,
                'sse_agama'                         =>     $sse_agama,
                'sse_job'                           =>     $sse_job,
                'sse_live'                          =>     $sse_live,
                'ibadah'                            =>     $ibadah,
                'thaharoh'                          =>     $thaharoh,
                'sholat'                            =>     $sholat,
                'pu_kepala'                         =>     $pu_kepala,
                'pu_rambut'                         =>     $pu_rambut,
                'pu_wajah'                          =>     $pu_wajah,
                'pu_mata'                           =>     $pu_mata,
                'pu_gigi'                           =>     $pu_gigi,
                'pu_tenggorokan'                    =>     $pu_tenggorokan,
                'pu_lidah'                          =>     $pu_lidah,
                'pu_leher'                          =>     $pu_leher,
                'pu_abdomen'                        =>     $pu_abdomen,
                'pu_dada'                           =>     $pu_dada,
                'pu_respirasi'                      =>     $pu_respirasi,
                'pu_jantung'                        =>     $pu_jantung,
                'pu_integumen'                      =>     $pu_integumen,
                'pu_ekstremitas'                    =>     $pu_ekstremitas,
                'pu_genetalia'                      =>     $pu_genetalia,
                'pu_elimitas'                       =>     $pu_elimitas,
                'pengaruh_nyeri'                    =>     $pengaruh_nyeri,
                'tgl_pengkajian'                    =>     $tgl_pengkajian,
                'keluhan_utama'                     =>     $keluhan_utama,
                'riwayat_pengobatan'                =>     $riwayat_pengobatan,
                'riwayat_sakit'                     =>     $riwayat_sakit,
                'riwayat_sakit_keluarga'            =>     $riwayat_sakit_keluarga,
                'riwayat_sakit_dulu'                =>     $riwayat_sakit_dulu,
                'riwayat_alergi'                    =>     $riwayat_alergi,
                'objective'                         =>     $objective,
                'status_kultural'                   =>     $status_kultural,
                'kesadaran'                         =>     $kesadaran,
                'td'                                =>     $td,
                'nadi'                              =>     $nadi,
                'nafas'                             =>     $nafas,
                'tinggi'                            =>     $tinggi,
                'keadaan_umum'                      =>     $keadaan_umum,
                'gcs'                               =>     $gcs,
                'suhu'                              =>     $suhu,
                'reaksi_cahaya'                     =>     $reaksi_cahaya,
                'berat'                             =>     $berat,
                'fisik_khusus'                      =>     $fisik_khusus,
                'frekuensi_nyeri'                   =>     $frekuensi_nyeri,
                'total_skor'                        =>     $sf_total_skor_set,
                'pola_makan'                        =>     $pola_makan,
                'sf_makan'                          =>     $sf_makan,
                'sf_transfer'                       =>     $sf_transfer,
                'sf_grooming'                       =>     $sf_grooming,
                'sf_toilet'                         =>     $sf_toilet,
                'sf_mandi'                          =>     $sf_mandi,
                'sf_jalan'                          =>     $sf_jalan,
                'sf_tangga'                         =>     $sf_tangga,
                'sf_berpakaian'                     =>     $sf_berpakaian,
                'sf_bowel'                          =>     $sf_bowel,
                'sf_bladder'                        =>     $sf_bladder,
                'sf_total'                          =>     $sf_total_set,
                'pemeriksaan_penunjang'             =>     $pemeriksaan_penunjang,
                'masalah_kesehatan'                 =>     $masalah_kesehatan,
                'masalah_keperawatan'               =>     $masalah_keperawatan,
                'rencana_keperawatan'               =>     $rencana_keperawatan,
                'asal_masuk'                        =>     $asal_masuk,
                'cara_masuk'                        =>     $cara_masuk,
                'kualitas_nyeri'                    =>     $kualitas_nyeri,
                'waktu_nyeri'                       =>     $waktu_nyeri,
                'intesnsitas_nyeri'                 =>     $intesnsitas_nyeri,
                'nyeri'                             =>     $nyeri,
                'aktivitas'                         =>     $aktivitas,
                'restrain'                          =>     $restrain,
                'bb_turun'                          =>     $bb_turun,
                'bb_turun_qty'                      =>     $bb_turun_qty,
                'nafsu_makan'                       =>     $nafsu_makan,
                'diagnosa_khusus'                   =>     $diagnosa_khusus,
                'resiko_jatuh_dws'                  =>     $resiko_jatuh_dws,
                'resiko_jatuh_gr'                   =>     $resiko_jatuh_gr,
                'resiko_jatuh_anak'                 =>     $resiko_jatuh_anak,
                'created'                           =>     $datereg,
                'asmri_date'                        =>     $datereg
            );
            $this->D_Soap->createregasmri($data_trx_reg_asmri,'soap_asm_ri'); 

        redirect('soap/rm/'.$id_reg);
    }

    function proses_update(){
        $id_reg                 = $this->input->post('id_reg');
        $id_asmri_edit          = $this->input->post('id_asmri_edit');

        //SELECT
        $sse_nikah              = $this->input->post('selmststatus_edit');
        $sse_study              = $this->input->post('selmstpendidikan_edit');
        $sse_agama              = $this->input->post('selmstagama_edit');
        $sse_job                = $this->input->post('selmstpekerjaan_edit');
        $sse_live               = $this->input->post('selmsthubkel_edit');
        $ibadah                 = $this->input->post('selmstibadah_edit');
        $thaharoh               = $this->input->post('selmstthaharoh_edit');
        $sholat                 = $this->input->post('selmstsholat_edit');
        $pu_kepala              = $this->input->post('selmstpukepala_edit');
        $pu_rambut              = $this->input->post('selmstpurambut_edit');
        $pu_wajah               = $this->input->post('selmstpuwajah_edit');
        $pu_mata                = $this->input->post('selmstpumata_edit');
        $pu_gigi                = $this->input->post('selmstpugigi_edit');
        $pu_tenggorokan         = $this->input->post('selmstputenggorokan_edit');
        $pu_lidah               = $this->input->post('selmstpulidah_edit');
        $pu_leher               = $this->input->post('selmstpuleher_edit');
        $pu_abdomen             = $this->input->post('selmstpuabdomen_edit');
        $pu_dada                = $this->input->post('selmstpudada_edit');
        $pu_respirasi           = $this->input->post('selmstpurespirasi_edit');
        $pu_jantung             = $this->input->post('selmstpujantung_edit');
        $pu_integumen           = $this->input->post('selmstpuintegumen_edit');
        $pu_ekstremitas         = $this->input->post('selmstpuekstremitas_edit');
        $pu_genetalia           = $this->input->post('selmstpugenetalia_edit');
        $pu_elimitas            = $this->input->post('selmstpuelimitas_edit');
        $pengaruh_nyeri         = $this->input->post('selmstpupengaruhnyeri_edit');
        //END SELECT
        //TEXT
        $tgl_pengkajian                = $this->input->post('tgl_pengkajian_edit');
        $keluhan_utama                 = $this->input->post('keluhan_utama_edit');
        $riwayat_pengobatan            = $this->input->post('riwayat_pengobatan_edit');
        $riwayat_sakit                 = $this->input->post('riwayat_sakit_edit');
        $riwayat_sakit_keluarga        = $this->input->post('riwayat_sakit_keluarga_edit');
        $riwayat_sakit_dulu            = $this->input->post('riwayat_sakit_dulu_edit');
        $riwayat_alergi                = $this->input->post('riwayat_alergi_edit');
        $objective                     = $this->input->post('objective_edit');
        $status_kultural               = $this->input->post('status_kultural_edit');
        $kesadaran                     = $this->input->post('kesadaran_edit');
        $td                            = $this->input->post('td_edit');
        $nadi                          = $this->input->post('nadi_edit');
        $nafas                         = $this->input->post('nafas_edit');
        $tinggi                        = $this->input->post('tinggi_edit');
        $keadaan_umum                  = $this->input->post('keadaan_umum_edit');
        $gcs                           = $this->input->post('gcs_edit');
        $suhu                          = $this->input->post('suhu_edit');
        $reaksi_cahaya                 = $this->input->post('reaksi_cahaya_edit');
        $berat                         = $this->input->post('berat_edit');
        $fisik_khusus                  = $this->input->post('fisik_khusus_edit');
        $frekuensi_nyeri               = $this->input->post('frekuensi_nyeri_edit');
        $total_skor                    = $this->input->post('total_skor_edit');
        $pola_makan                    = $this->input->post('pola_makan_edit');
        $sf_makan                      = $this->input->post('sf_makan_edit');
        $sf_transfer                   = $this->input->post('sf_transfer_edit');
        $sf_grooming                   = $this->input->post('sf_grooming_edit');
        $sf_toilet                     = $this->input->post('sf_toilet_edit');
        $sf_mandi                      = $this->input->post('sf_mandi_edit');
        $sf_jalan                      = $this->input->post('sf_jalan_edit');
        $sf_tangga                     = $this->input->post('sf_tangga_edit');
        $sf_berpakaian                 = $this->input->post('sf_berpakaian_edit');
        $sf_bowel                      = $this->input->post('sf_bowel_edit');
        $sf_bladder                    = $this->input->post('sf_bladder_edit');
        $sf_total                      = $this->input->post('sf_total_edit');
        $pemeriksaan_penunjang         = $this->input->post('pemeriksaan_penunjang_edit');
        $masalah_kesehatan             = $this->input->post('masalah_kesehatan_edit');
        $masalah_keperawatan           = $this->input->post('masalah_keperawatan_edit');
        $rencana_keperawatan           = $this->input->post('rencana_keperawatan_edit');
        $sf_total_set                  = $sf_makan+$sf_transfer+$sf_grooming+$sf_toilet+$sf_mandi+$sf_jalan+$sf_tangga+$sf_berpakaian+$sf_bowel+$sf_bladder;
        //END TEXT

        $datereg    = date('Y-m-d H:i:s');

        $date = date('Y-m-d H:i:s');
        $updateasmri="UPDATE soap_asm_ri SET 
        regdate                     ='$datereg',
        asmri_date                  ='$date',
        id_reg                      ='$id_reg',
        sse_nikah                   ='$sse_nikah',
        sse_study                   ='$sse_study',
        sse_agama                   ='$sse_agama',
        sse_job                     ='$sse_job',
        sse_live                    ='$sse_live',
        ibadah                      ='$ibadah',
        thaharoh                    ='$thaharoh',
        sholat                      ='$sholat',
        pu_kepala                   ='$pu_kepala',
        pu_rambut                   ='$pu_rambut',
        pu_wajah                    ='$pu_wajah',
        pu_mata                     ='$pu_mata',
        pu_gigi                     ='$pu_gigi',
        pu_tenggorokan              ='$pu_tenggorokan',
        pu_lidah                    ='$pu_lidah',
        pu_leher                    ='$pu_leher',
        pu_abdomen                  ='$pu_abdomen',
        pu_dada                     ='$pu_dada',
        pu_respirasi                ='$pu_respirasi',
        pu_jantung                  ='$pu_jantung',
        pu_integumen                ='$pu_integumen',
        pu_ekstremitas              ='$pu_ekstremitas',
        pu_genetalia                ='$pu_genetalia',
        pu_elimitas                 ='$pu_elimitas',
        pengaruh_nyeri              ='$pengaruh_nyeri',
        tgl_pengkajian              ='$tgl_pengkajian',
        keluhan_utama               ='$keluhan_utama',
        riwayat_pengobatan          ='$riwayat_pengobatan',
        riwayat_sakit               ='$riwayat_sakit',
        riwayat_sakit_keluarga      ='$riwayat_sakit_keluarga',
        riwayat_sakit_dulu          ='$riwayat_sakit_dulu',
        riwayat_alergi              ='$riwayat_alergi',
        objective                   ='$objective',
        status_kultural             ='$status_kultural',
        kesadaran                   ='$kesadaran',
        td                          ='$td',
        nadi                        ='$nadi',
        nafas                       ='$nafas',
        tinggi                      ='$tinggi',
        keadaan_umum                ='$keadaan_umum',
        gcs                         ='$gcs',
        suhu                        ='$suhu',
        reaksi_cahaya               ='$reaksi_cahaya',
        berat                       ='$berat',
        fisik_khusus                ='$fisik_khusus',
        frekuensi_nyeri             ='$frekuensi_nyeri',
        total_skor                  ='$total_skor',
        pola_makan                  ='$pola_makan',
        sf_makan                    ='$sf_makan',
        sf_transfer                 ='$sf_transfer',
        sf_grooming                 ='$sf_grooming',
        sf_toilet                   ='$sf_toilet',
        sf_mandi                    ='$sf_mandi',
        sf_jalan                    ='$sf_jalan',
        sf_tangga                   ='$sf_tangga',
        sf_berpakaian               ='$sf_berpakaian',
        sf_bowel                    ='$sf_bowel',
        sf_bladder                  ='$sf_bladder',
        sf_total                    ='$sf_total_set',
        pemeriksaan_penunjang       ='$pemeriksaan_penunjang',
        masalah_kesehatan           ='$masalah_kesehatan',
        masalah_keperawatan         ='$masalah_keperawatan',
        rencana_keperawatan         ='$rencana_keperawatan',
        asal_masuk                  ='$asal_masuk',
        cara_masuk                  ='$cara_masuk',
        kualitas_nyeri              ='$kualitas_nyeri',
        waktu_nyeri                 ='$waktu_nyeri',
        intesnsitas_nyeri           ='$intesnsitas_nyeri',
        nyeri                       ='$nyeri',
        aktivitas                   ='$aktivitas',
        restrain                    ='$restrain',
        bb_turun                    ='$bb_turun',
        bb_turun_qty                ='$bb_turun_qty',
        nafsu_makan                 ='$nafsu_makan',
        diagnosa_khusus             ='$diagnosa_khusus',
        resiko_jatuh_dws            ='$resiko_jatuh_dws',
        resiko_jatuh_gr             ='$resiko_jatuh_gr',
        resiko_jatuh_anak           ='$resiko_jatuh_anak',
        updated                     ='$date'
        WHERE id_asmri              ='$id_asmri_edit'";
        $this->db->query($updateasmri);

        redirect('soap/rm/'.$id_reg);
    }

    function listsoappasien(){
        $id_reg_set = $this->input->post('id_reg_set');
        $data       = $this->D_Soap->setdatasoap($id_reg_set);
        $datasend = json_encode($data);
        echo $datasend;
    }

    function soappasienedit(){
        $id_reg_set = $this->input->post('id_reg_set');
        $id_asm_ri = $this->input->post('id_asm_ri');
        $data       = $this->D_Soap->setdatasoapedit($id_reg_set, $id_asm_ri);
        $datasend = json_encode($data);
        echo $datasend;
    }


    function get_list_cppt_pasien(){
        $id_reg     = $this->input->post('id_reg');
        $data       = $this->D_Soap->get_list_cppt_ri($id_reg);
        $datasend = json_encode($data);
        echo $datasend;
    }

    ////////////////////SMARTPLUS SECTION

    public function asm_ranap($id_reg)
    {
          $this->erm_header($id_reg);
          $data_pasien	= $this->smartlib->get_data_pasien_by_id_reg($id_reg);
          $id_pasien = $data_pasien['id_pasien'];
  
          $riwayat_pasien	= $this->smartlib->riwayat_pasien($id_pasien);
  
          $row = $this->D_Soap->get_data_asm_ri_dokter($id_reg);
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
      $rs = $this->D_Soap->get_list_cppt_ri($id_reg);
      $data = array(
              'id_reg'	=> $id_reg,
        'rs'      => $rs,
              'id_role'  => $id_role,
      );
      $this->load->view('vlist_cppt_ranap', $data);
      }
  
      public function cppt($id_reg,$id_asmri='')
    {
          $data_pasien	= $this->smartlib->get_data_pasien_by_id_reg($id_reg);
          $id_pasien = $data_pasien['id_pasien'];
  
          $riwayat_pasien	= $this->smartlib->riwayat_pasien($id_pasien);
  
          $row = $this->D_Soap->get_data_cppt_ri($id_reg,$id_asmri);
          if($row['id_asmri']==''){
            $sql_command = 'insert';
          }else{
            $sql_command = 'update';
          }
          
  
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
      $this->load->view('cppt',$data);
    }
  
 public function act_assesment($id_reg){
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
        'asmri_date'        => date('Y-m-d H:i:s'),
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

      //tindakan 24022023

      $id_reg         = $this->input->post('idregset');
      $send           = $this->input->post('id_act');
      $qty            = $this->input->post('qty');
      $name           = $this->input->post('nama_tindakan');
      $price          = $this->input->post('price');
      $id_grup        = $this->input->post('id_group');
      $datetime       = date('Y-m-d H:i:s');
      
      $fndiddokter    = $this->D_Soap->fnddatadokter($id_reg);
      $id_dokter      = $fndiddokter->id_dokter_prt1;
      
      foreach($send as $k => $v){
          $qtyset    = $qty[$k];
          $nameset   = $name[$k];
          $priceset  = $price[$k];
          $totalset  = ($priceset * $qtyset);
          $idgrupset = $id_grup[$k];

          $data_trx_reg_act = array(  
              'id_reg'             =>   $id_reg,
              'id_dokter'          =>   $id_dokter,
              'id_reg_act'         =>   $v,
              'qty'                =>   $qtyset,
              'name'               =>   $nameset,
              'price'              =>   $priceset,
              'id_group_act'       =>   $idgrupset,
              'total'              =>   $totalset,
              'created'            =>   $datetime,
              'creator'            =>   "Admin"
          );
          $this->D_Soap->createregact($data_trx_reg_act,'trx_reg_act'); 
      }
      //end tindakan 24022023
  
          $data_riwayat = array(
                  'id_pasien'					=> $data_pasien['id_pasien'],
                  'penyakit_sekarang'	        => $this->input->post('riwayat_sakit'),
                  'penyakit_dahulu'		=> $this->input->post('riwayat_sakit_dulu'),
                  'penyakit_keluarga'	=> $this->input->post('riwayat_sakit_keluarga'),
                  'pengobatan'				=> $this->input->post('riwayat_pengobatan'),
                  'alergi'						=> $this->input->post('riwayat_alergi'),
                  'created'						=> date('Y-m-d H:i:s'),
                  'creator'						=> $creator,
              );
  
          
          $id_asmri = $this->input->post('id_asmri');

          if($id_asmri==''){
            $sql_command = 'insert';
          }else{
            $sql_command = 'update';
          }
          //echo $sql_command;
          //exit;
          if($sql_command=='update')
          {
              $id_asmri = $this->input->post('id_asmri');
              $where = " id_asmri='".$id_asmri."' ";
              $action = $this->D_Soap->edit_data_asm_ranap($where, $data_update);
              $store_riwayat	= $this->smartlib->store_riwayat_pasien($data_pasien['id_pasien'], $data_riwayat);
          }
          else
          {
              $action = $this->D_Soap->add_data_asm_ranap($data);
              $store_riwayat	= $this->smartlib->store_riwayat_pasien($data_pasien['id_pasien'], $data_riwayat);
          }
      if($action) $this->save_drawing($id_reg);
  
    #echo json_encode(array("status" => true));
    redirect('soap/rm/'.$id_reg);
 }

public function act_cppt($id_reg){
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
  'asmri_date'        => date('Y-m-d H:i:s'),
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
        'riwayat_sakit'             => $this->input->post('riwayat_sakit'),
        'riwayat_sakit_dulu'     	=> $this->input->post('riwayat_sakit_dulu'),
        'riwayat_pengobatan'     	=> $this->input->post('riwayat_pengobatan'),
        'riwayat_sakit_keluarga' 	=> $this->input->post('riwayat_sakit_keluarga'),
        'riwayat_alergi'         	=> $this->input->post('riwayat_alergi'),
        // SUBJECTIVE END

        // OBJECTIVE START
        'objective'     => $this->input->post('objective'),

        'kesadaran'    	=> $this->input->post('kesadaran'),
        'keadaan_umum' 	=> $this->input->post('keadaan_umum'),
        'td'            => $this->input->post('td'),
        'gcs'         	=> $this->input->post('gcs'),
        'nadi'         	=> $this->input->post('nadi'),
        'suhu'         	=> $this->input->post('suhu'),
        'nafas'         => $this->input->post('nafas'),
        'reaksi_cahaya' => $this->input->post('reaksi_cahaya'),
        'tinggi'        => $this->input->post('tinggi'),
        'berat'         => $this->input->post('berat'),
        // OBJECTIVE END

        // ASSESMENT
        'diag_medis_banding'	    => $diag_medis_banding,
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
        'td'            => $this->input->post('td'),
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

    //tindakan 24022023

    $id_reg         = $this->input->post('idregset');
    $send           = $this->input->post('id_act_cppt');
    $qty            = $this->input->post('qty_cppt');
    $name           = $this->input->post('nama_tindakan_cppt');
    $price          = $this->input->post('price_cppt');
    $id_grup        = $this->input->post('id_group_cppt');
    $datetime       = date('Y-m-d H:i:s');

    $fndiddokter    = $this->D_Soap->fnddatadokter($id_reg);
    $id_dokter      = $fndiddokter->id_dokter_prt1;

    foreach($send as $k => $v){
        $qtyset    = $qty[$k];
        $nameset   = $name[$k];
        $priceset  = $price[$k];
        $totalset  = ($priceset * $qtyset);
        $idgrupset = $id_grup[$k];

        $data_trx_reg_act = array(  
            'id_reg'             =>   $id_reg,
            'id_dokter'          =>   $id_dokter,
            'id_reg_act'         =>   $v,
            'qty'                =>   $qtyset,
            'name'               =>   $nameset,
            'price'              =>   $priceset,
            'id_group_act'       =>   $idgrupset,
            'total'              =>   $totalset,
            'created'            =>   $datetime,
            'creator'            =>   "Admin"
        );
        $this->D_Soap->createregact($data_trx_reg_act,'trx_reg_act'); 
    }
    //end tindakan 24022023

    $data_riwayat = array(
            'id_pasien'					=> $data_pasien['id_pasien'],
            'penyakit_sekarang'	        => $this->input->post('riwayat_sakit'),
            'penyakit_dahulu'		=> $this->input->post('riwayat_sakit_dulu'),
            'penyakit_keluarga'	=> $this->input->post('riwayat_sakit_keluarga'),
            'pengobatan'				=> $this->input->post('riwayat_pengobatan'),
            'alergi'						=> $this->input->post('riwayat_alergi'),
            'created'						=> date('Y-m-d H:i:s'),
            'creator'						=> $creator,
        );

    
    $id_asmri = $this->input->post('id_asmri');

    if($id_asmri==''){
      $sql_command = 'insert';
    }else{
      $sql_command = 'update';
    }
    //echo $sql_command;
    //exit;
    if($sql_command=='update')
    {
        $id_asmri = $this->input->post('id_asmri');
        $where = " id_asmri='".$id_asmri."' ";
        $action = $this->D_Soap->edit_data_asm_ranap($where, $data_update);
        $store_riwayat	= $this->smartlib->store_riwayat_pasien($data_pasien['id_pasien'], $data_riwayat);
    }
    else
    {
        $action = $this->D_Soap->add_data_asm_ranap($data);
        $store_riwayat	= $this->smartlib->store_riwayat_pasien($data_pasien['id_pasien'], $data_riwayat);
    }
    if($action) $this->save_drawing($id_reg);

    #echo json_encode(array("status" => true));
    redirect('soap/rm/'.$id_reg);
}
  
 public function save_drawing($id_reg){
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
        //$wew = 'FCPATH', str_replace('\\', '/', __DIR__).'/';
        //$str = str_replace('\\', '/', $str);
          $creat_file =  file_put_contents(FCPATH. 'uploaded/penunjang/'.$id_pasien.'/'.$id_reg.'/'.$nama_gambar.$file_ext, $data);
  
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
  
          echo '<div><h1>' . $return . '</h1></div>';
          return $return;
      }
  
      public function delete_asm_ranap($id_asmri)
      {
          $this->D_Soap->delete_asm_ranap($id_asmri);
          echo json_encode(array("status" => true));
      }


      public function msttindakan(){
		$term = $this->input->get('term',true);
		
		$sql = "SELECT a.id_act,a.name,a.price AS harga,a.id_group,b.name AS namegrup,c.name AS namesubgrup 
        FROM mst_tindakan a 
        LEFT JOIN mst_tindakan_grup b ON a.id_group=b.id_group
        LEFT JOIN mst_tindakan_subgrup c ON a.id_group=c.id_subgroup 
        WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label']    = $v['name'];
			$rs[$k]['id']       = $v['id_act'];
            $rs[$k]['price']    = $v['harga'];
            $rs[$k]['id_group'] = $v['id_group'];
            $rs[$k]['group']    = $v['namegrup'];
            $rs[$k]['subgroup'] = $v['namesubgrup'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
      }

      public function msttindakan_cppt(){
		$term = $this->input->get('term',true);
		
		$sql = "SELECT a.id_act,a.name,a.price AS harga,a.id_group,b.name AS namegrup,c.name AS namesubgrup 
        FROM mst_tindakan a 
        LEFT JOIN mst_tindakan_grup b ON a.id_group=b.id_group
        LEFT JOIN mst_tindakan_subgrup c ON a.id_group=c.id_subgroup 
        WHERE UPPER(a.name) LIKE '%".strtoupper($term)."%'";
		$query  = $this->db->query($sql);
		$rs     = $query->result_array();
		foreach($rs as $k => $v)
		{
			$rs[$k]['label']         = $v['name'];
			$rs[$k]['id']            = $v['id_act'];
            $rs[$k]['price_cppt']    = $v['harga'];
            $rs[$k]['id_group_cppt'] = $v['id_group'];
            $rs[$k]['group_cppt']    = $v['namegrup'];
            $rs[$k]['subgroup_cppt'] = $v['namesubgrup'];
		}
		$dataset = json_encode($rs);
		echo $dataset;
      }

 }

 
?>