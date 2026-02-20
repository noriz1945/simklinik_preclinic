<!doctype html>
<html>

<head>

  <style type="text/css">
  .table-cppt{
    border-style: solid;
    border-color: black;
  }

  </style>
</head>

<div class="container-fluid">
<div class="table-responsive">
  <table class="table table-striped">
  <thead>
    <tr class="text-center">
      <th scope="col">Tgl/Jam</th>
      <th scope="col">Profesional <br> Pemberi <br>Asuhan (PPA)</th>
      <th scope="col">Hasil Asesmen Pasien dan Pemberian <br>
        Pelayanan<br>
        (Tulis dengan SOAP disertai Sasaran, Tulis<br>
        Nama, beri paraf pada akhir catatan)
      </th>
      <th scope="col">Instruksi PPA<br>
        termasuk<br>
        Pasca bedah
      </th>
      <th scope="col">Review & verifikasi <br>
          DPJP
      </th>
    </tr>
  </thead>

  <tbody>
    <?php
      foreach($cppt_igd as $v)
      {

     ?>
    <tr>
      <td><?php echo $v['cppt_date'] ?> <br><br> UGD</td>
      <td><?php echo $v['ppa'] ?></td>
      <td>
        <h4 class="pnl-head-3">SUBJECTIVE</h4>
        <div class="row pnl">
          <?php echo nl2br($v['subjective']) ?>
        </div>

        <h4 class="pnl-head-3">OBJECTIVE</h4>
        <div class="row pnl">
          <?php echo nl2br($v['objective']) ?>
        </div>

        <h4 class="pnl-head-3">ASSESMENT</h4>
        <div class="row pnl">
          <?php echo nl2br($v['assesment']) ?>
        </div>

        <h4 class="pnl-head-3">PLANNING</h4>
        <div class="row pnl">
          <?php echo nl2br($v['planning']) ?>
        </div>

      </td>
      <td><?php echo $v['instruksi_ppa'] ?></td>
      <td></td>
    </tr>
    <?php } ?>

    <?php
    $icon_update = base_url('assets/img/tulis.png');
      foreach($data_cppt as $val)
      {
        // subjective
    		if (empty($val['keluhan_utama'])) {
          $text_keluhan_utama = '';
    			$keluhan_utama = '';
    		}else {
          $text_keluhan_utama = 'Keluhan Utama : ';
    			$keluhan_utama = nl2br($val['keluhan_utama']). '<br>';
    		}

        if (empty($val['riwayat_sakit'])) {
          $text_riwayat_sakit = '';
    			$riwayat_sakit = '';
    		}else {
          $text_riwayat_sakit = 'Riwayat Penyakit Sekarang : ';
    			$riwayat_sakit = nl2br($val['riwayat_sakit']). '<br>';
    		}

        if (empty($val['riwayat_sakit_dulu'])) {
          $text_riwayat_sakit_dulu = '';
    			$riwayat_sakit_dulu = '';
    		}else {
          $text_riwayat_sakit_dulu = 'Riwayat Penyakit Dahulu : ';
    			$riwayat_sakit_dulu = nl2br($val['riwayat_sakit_dulu']). '<br>';
    		}

        if (empty($val['riwayat_pengobatan'])) {
          $text_riwayat_pengobatan = '';
    			$riwayat_pengobatan = '';
    		}else {
          $text_riwayat_pengobatan = 'Riwayat Pengobatan/Operasi/Obstetri : ';
    			$riwayat_pengobatan = nl2br($val['riwayat_pengobatan']). '<br>';
    		}

        if (empty($val['riwayat_sakit_keluarga'])) {
          $text_riwayat_sakit_keluarga = '';
    			$riwayat_sakit_keluarga = '';
    		}else {
          $text_riwayat_sakit_keluarga = 'Riwayat Penyakit Keluarga : ';
    			$riwayat_sakit_keluarga = nl2br($val['riwayat_sakit_keluarga']). '<br>';
    		}

        if (empty($val['riwayat_alergi'])) {
          $text_riwayat_alergi = '';
    			$riwayat_alergi = '';
    		}else {
          $text_riwayat_alergi = 'Riwayat Alergi : ';
    			$riwayat_alergi = nl2br($val['riwayat_alergi']). '<br>';
    		}

    		// objective
        if (empty($val['objective'])) {
    			$objective = '';
    		}else {
    			//$objective = nl2br($val['objective']). '<br>';
          $objective ='<div class="col-md-12"> <strong></strong>  '. nl2br($val['objective']).'</div>';
    		}

        if (empty($val['status_psikologi'])) {
    			$status_psikologi = '';
    		}else {
    			$status_psikologi ='<div class="col-md-12"> <strong>STATUS PSIKOLOGI :</strong>  '. nl2br($val['status_psikologi']).'</div>';
    		}

        if((empty($val['sse_nikah'])) or (empty($val['sse_study'])) or (empty($val['sse_job']))
        or (empty($val['sse_live'])) or (empty($val['sse_agama']))
          ){
          $head_sse = '';
        }else {
          $head_sse = '<div class="col-md-12"><label><strong>STATUS SOSIAL EKONOMI</strong></label> </div>';
        }

        if (empty($val['sse_nikah'])) {
    			$sse_nikah = '';
    		}else {
    			$sse_nikah ='<div class="col-md-3"> <strong>|| Status Pernikahan : :</strong>  '. nl2br($val['sse_nikah']).'</div>';
    		}

        if (empty($val['sse_study'])) {
    			$sse_study = '';
    		}else {
    			$sse_study ='<div class="col-md-3"> <strong>|| Pendidikan Terakhir :</strong>  '. nl2br($val['sse_study']).'</div>';
    		}

        if (empty($val['sse_job'])) {
    			$sse_job = '';
    		}else {
    			$sse_job ='<div class="col-md-2"> <strong>|| Pekerjaan  :</strong>  '. nl2br($val['sse_job']).'</div>';
    		}

        if (empty($val['sse_live'])) {
    			$sse_live = '';
    		}else {
    			$sse_live ='<div class="col-md-2"> <strong>|| Tinggal Bersama :</strong>  '. nl2br($val['sse_live']).'</div>';
    		}

        if (empty($val['sse_agama'])) {
    			$sse_agama = '';
    		}else {
    			$sse_agama ='<div class="col-md-2"> <strong>|| Agama :</strong>  '. nl2br($val['sse_agama']).'</div>';
    		}

        if (empty($val['status_kultural'])) {
    			$status_kultural = '';
    		}else {
    			$status_kultural ='<div class="col-md-12"> <strong>STATUS KULTURAL :</strong>  '. nl2br($val['status_kultural']).'</div>';
    		}

        if (empty($val['ibadah'])) {
    			$ibadah = '';
    		}else {
    			$ibadah ='<div class="col-md-3"> || WAJIB IBADAH : '. nl2br($val['ibadah']). '</div>';
    		}

        if (empty($val['thaharoh'])) {
    			$thaharoh = '';
    		}else {
    			$thaharoh ='<div class="col-md-3"> || THOHARAH : '. nl2br($val['thaharoh']). '</div>';
    		}

        if (empty($val['sholat'])) {
    			$sholat = '';
    		}else {
    			$sholat ='<div class="col-md-3"> || SHOLAT : '. nl2br($val['sholat']). '</div>';
    		}

        if (empty($val['bim_spiritual_muslim'])) {
    			$bim_spiritual_muslim = '';
    		}else {
    			$bim_spiritual_muslim ='<div class="col-md-3"> || Bimbingan Spiritual Muslim : '. nl2br($val['bim_spiritual_muslim']). '</div>';
    		}

        if (empty($val['bim_spiritual_nonmuslim'])) {
    			$bim_spiritual_nonmuslim = '';
    		}else {
    			$bim_spiritual_nonmuslim ='<div class="col-md-3"> || Bimbingan Spiritual Non Muslim : '. nl2br($val['bim_spiritual_nonmuslim']). '</div>';
    		}

        if((empty($val['kesadaran'])) or (empty($val['td'])) or (empty($val['nadi'])) or (empty($val['nafas'])) or
          (empty($val['keadaan_umum'])) or (empty($val['gcs'])) or (empty($val['suhu'])) or (empty($val['reaksi_cahaya'])) or
          (empty($val['tinggi'])) or (empty($val['berat']))
        ){
          $head_kondisi_umum = '';
        }else {
          $head_kondisi_umum = '<div class="col-md-12"><label><strong>PEMERIKSAAN KONDISI UMUM DAN TANDA TANDA VITAL</strong></label> </div>';
        }

    		if (empty($val['kesadaran'])) {
    			$kesadaran = '';
    		}else {
    			$kesadaran ='<div class="col-md-3"> || Kesadaran : '. nl2br($val['kesadaran']). '</div>';
    		}

    		if (empty($val['td'])) {
    			$td = '';
    		}else {
    			$td ='<div class="col-md-3"> || Tekanan Darah : '. nl2br($val['td']).'</div>';
    		}

        if (empty($val['nadi'])) {
    			$nadi = '';
    		}else {
    			$nadi ='<div class="col-md-3"> || Nadi : '. nl2br($val['nadi']).'</div>';
    		}

        if (empty($val['nafas'])) {
    			$nafas = '';
    		}else {
    			$nafas ='<div class="col-md-3"> || Pernafasan : '. nl2br($val['nafas']).'</div>';
    		}

        if (empty($val['keadaan_umum'])) {
    			$keadaan_umum = '';
    		}else {
    			$keadaan_umum ='<div class="col-md-3"> || keadaan umum : '. nl2br($val['keadaan_umum']).'</div>';
    		}

        if (empty($val['gcs'])) {
    			$gcs = '';
    		}else {
    			$gcs ='<div class="col-md-3"> || GCS : '. nl2br($val['gcs']).'</div>';
    		}

        if (empty($val['suhu'])) {
    			$suhu = '';
    		}else {
    			$suhu ='<div class="col-md-3"> || suhu : '. nl2br($val['suhu']).'</div>';
    		}

        if (empty($val['reaksi_cahaya'])) {
    			$reaksi_cahaya = '';
    		}else {
    			$reaksi_cahaya ='<div class="col-md-3"> || reaksi cahaya : '. nl2br($val['reaksi_cahaya']).'</div>';
    		}

        if (empty($val['tinggi'])) {
    			$tinggi = '';
    		}else {
    			$tinggi ='<div class="col-md-3"> || tinggi : '. nl2br($val['tinggi']).'</div>';
    		}

        if (empty($val['berat'])) {
    			$berat = '';
    		}else {
    			$berat ='<div class="col-md-3"> || Berat : '. nl2br($val['berat']).'</div>';
    		}

        // pemeriksaan umum
        if((empty($val['pu_kepala'])) or (empty($val['pu_rambut'])) or (empty($val['pu_wajah'])) or (empty($val['pu_mata'])) or
          (empty($val['pu_gigi'])) or (empty($val['pu_tenggorokan'])) or (empty($val['pu_lidah'])) or (empty($val['pu_leher'])) or
          (empty($val['pu_abdomen'])) or (empty($val['pu_dada'])) or (empty($val['pu_respirasi'])) or (empty($val['pu_jantung'])) or
          (empty($val['pu_integumen'])) or (empty($val['pu_ekstremitas'])) or (empty($val['pu_genetalia'])) or (empty($val['pu_elimitas']))
        ){
          $head_pemeriksaan_umum = '';
        }else {
          $head_pemeriksaan_umum = '<div class="col-md-12"><label><strong>PEMERIKSAAN UMUM</strong></label> </div>';
        }

        if (empty($val['pu_kepala'])) {
    			$kepala = '';
    		}else {
    			$kepala ='<div class="col-md-3"> || Kepala : '. nl2br($val['pu_kepala']).'</div>';
    		}

        if (empty($val['pu_rambut'])) {
    			$rambut = '';
    		}else {
    			$rambut ='<div class="col-md-3"> || rambut : '. nl2br($val['pu_rambut']).'</div>';
    		}

        if (empty($val['pu_wajah'])) {
    			$wajah = '';
    		}else {
    			$wajah ='<div class="col-md-3"> || wajah : '. nl2br($val['pu_wajah']).'</div>';
    		}

        if (empty($val['pu_mata'])) {
    			$mata = '';
    		}else {
    			$mata ='<div class="col-md-3"> || mata : '. nl2br($val['pu_mata']).'</div>';
    		}

        if (empty($val['pu_gigi'])) {
    			$gigi = '';
    		}else {
    			$gigi ='<div class="col-md-3"> || gigi : '. nl2br($val['pu_gigi']).'</div>';
    		}

        if (empty($val['pu_tenggorokan'])) {
    			$tenggorokan = '';
    		}else {
    			$tenggorokan ='<div class="col-md-3"> || tenggorokan : '. nl2br($val['pu_tenggorokan']).'</div>';
    		}

        if (empty($val['pu_lidah'])) {
    			$lidah = '';
    		}else {
    			$lidah ='<div class="col-md-3"> || lidah : '. nl2br($val['pu_lidah']).'</div>';
    		}

        if (empty($val['pu_leher'])) {
    			$leher = '';
    		}else {
    			$leher ='<div class="col-md-3"> || leher : '. nl2br($val['pu_leher']).'</div>';
    		}

        if (empty($val['pu_abdomen'])) {
    			$abdomen = '';
    		}else {
    			$abdomen ='<div class="col-md-3"> || abdomen : '. nl2br($val['pu_abdomen']).'</div>';
    		}

        if (empty($val['pu_dada'])) {
    			$dada= '';
    		}else {
    			$dada ='<div class="col-md-3"> || dada : '. nl2br($val['pu_dada']).'</div>';
    		}

        if (empty($val['pu_respirasi'])) {
    			$respirasi = '';
    		}else {
    			$respirasi ='<div class="col-md-3"> || respirasi : '. nl2br($val['pu_respirasi']).'</div>';
    		}


        if (empty($val['pu_jantung'])) {
    			$jantung = '';
    		}else {
    			$jantung ='<div class="col-md-3"> || jantung : '. nl2br($val['pu_jantung']).'</div>';
    		}

        if (empty($val['pu_integumen'])) {
    			$integumen = '';
    		}else {
    			$integumen ='<div class="col-md-3"> || integumen : '. nl2br($val['pu_integumen']).'</div>';
    		}

        if (empty($val['pu_ekstremitas'])) {
    			$ekstremitas = '';
    		}else {
    			$ekstremitas ='<div class="col-md-3"> || ekstremitas : '. nl2br($val['pu_ekstremitas']).'</div>';
    		}

        if (empty($val['pu_genetalia'])) {
    			$genetalia = '';
    		}else {
    			$genetalia ='<div class="col-md-3"> || genetalia : '. nl2br($val['pu_genetalia']).'</div>';
    		}

        if (empty($val['pu_elimitas'])) {
    			$elimitas = '';
    		}else {
    			$elimitas ='<div class="col-md-3"> || elimitas : '. nl2br($val['pu_elimitas']).'</div>';
    		}

        if((empty($val['kualitas_nyeri'])) or (empty($val['frekuensi_nyeri'])) or (empty($val['waktu_nyeri']))
        or (empty($val['intesnsitas_nyeri'])) or (empty($val['nyeri'])) or (empty($val['pengaruh_nyeri']))
        or (empty($val['aktivitas'])) or (empty($val['restrain']))
        ){
          $head_skala_nyeri = '';
        }else {
          $head_skala_nyeri = '<div class="col-md-12"><label><strong>SKALA NYERI NUMERIK</strong></label> </div>';
        }

        if (empty($val['kualitas_nyeri'])) {
    			$kualitas_nyeri = '';
    		}else {
    			$kualitas_nyeri ='<div class="col-md-12"> || Kualitas nyeri : '. nl2br($val['kualitas_nyeri']).'</div>';
    		}

        if (empty($val['frekuensi_nyeri'])) {
    			$frekuensi_nyeri = '';
    		}else {
    			$frekuensi_nyeri ='<div class="col-md-12"> || Frekuensi nyeri : '. nl2br($val['frekuensi_nyeri']).'</div>';
    		}

        if (empty($val['waktu_nyeri'])) {
    			$waktu_nyeri = '';
    		}else {
    			$waktu_nyeri ='<div class="col-md-12"> || Timbulnya nyeri pada saat : '. nl2br($val['waktu_nyeri']).'</div>';
    		}

        if (empty($val['intesnsitas_nyeri'])) {
    			$intesnsitas_nyeri = '';
    		}else {
    			$intesnsitas_nyeri ='<div class="col-md-12"> || Intensitas nyeri : '. nl2br($val['intesnsitas_nyeri']).'</div>';
    		}

        if (empty($val['nyeri'])) {
    			$nyeri = '';
    		}else {
    			$nyeri ='<div class="col-md-12"> || Nyeri / tidak nyaman: '. nl2br($val['nyeri']).'</div>';
    		}

        if (empty($val['pengaruh_nyeri'])) {
    			$pengaruh_nyeri = '';
    		}else {
    			$pengaruh_nyeri ='<div class="col-md-12"> || Nyeri mempengaruhi : '. nl2br($val['pengaruh_nyeri']).'</div>';
    		}

        if (empty($val['aktivitas'])) {
    			$aktivitas = '';
    		}else {
    			$aktivitas ='<div class="col-md-12"> || Aktivitas : '. nl2br($val['aktivitas']).'</div>';
    		}

        if (empty($val['restrain'])) {
    			$restrain = '';
    		}else {
    			$restrain ='<div class="col-md-12"> || Perlu Restrain : '. nl2br($val['restrain']).'</div>';
    		}


        if (empty($val['anak_nyeri_total'])) {
    			$anak_nyeri_total = '';
    		}else {
    			$anak_nyeri_total ='<div class="col-md-12">SKOR TOTAL NYERI ANAK : '. nl2br($val['anak_nyeri_total']).'</div>';
    		}

        if (empty($val['anak_riwayat_imunisasi'])) {
    			$riwayat_imunisasi = '';
    		}else {
    			$riwayat_imunisasi ='<div class="col-md-3">|| RIWAYAT IMUNISASI : '. nl2br($val['anak_riwayat_imunisasi']).'</div>';
    		}

        if((empty($val['anak_tk_senyum'])) or (empty($val['anak_tk_berdiri'])) or (empty($val['anak_tk_tengkurap']))
        or (empty($val['anak_tk_berjalan'])) or (empty($val['anak_tk_duduk'])) or (empty($val['anak_tk_bicara']))
        or (empty($val['anak_tk_merangkak'])) or (empty($val['anak_tk_sekolah']))
        ){
          $head_tumbuh_anak = '';
        }else {
          $head_tumbuh_anak = '<div class="col-md-12"><label><strong>RIWAYAT TUMBUH KEMBANG ANAK</strong></label> </div>';
        }

        if (empty($val['anak_tk_senyum'])) {
    			$anak_tk_senyum = '';
    		}else {
    			$anak_tk_senyum ='<div class="col-md-3">Senyum : '. nl2br($val['anak_tk_senyum']).'</div>';
    		}

        if (empty($val['anak_tk_berdiri'])) {
    			$anak_tk_berdiri = '';
    		}else {
    			$anak_tk_berdiri ='<div class="col-md-3">Berdiri : '. nl2br($val['anak_tk_berdiri']).'</div>';
    		}

        if (empty($val['anak_tk_tengkurap'])) {
    			$anak_tk_tengkurap = '';
    		}else {
    			$anak_tk_tengkurap ='<div class="col-md-3">Tengkurap : '. nl2br($val['anak_tk_tengkurap']).'</div>';
    		}

        if (empty($val['anak_tk_berjalan'])) {
    			$anak_tk_berjalan = '';
    		}else {
    			$anak_tk_berjalan ='<div class="col-md-3">Berjalan : '. nl2br($val['anak_tk_berjalan']).'</div>';
    		}

        if (empty($val['anak_tk_duduk'])) {
    			$anak_tk_duduk = '';
    		}else {
    			$anak_tk_duduk ='<div class="col-md-3">Duduk : '. nl2br($val['anak_tk_duduk']).'</div>';
    		}

        if (empty($val['anak_tk_bicara'])) {
    			$anak_tk_bicara = '';
    		}else {
    			$anak_tk_bicara ='<div class="col-md-3">Bicara : '. nl2br($val['anak_tk_bicara']).'</div>';
    		}

        if (empty($val['anak_tk_merangkak'])) {
    			$anak_tk_merangkak = '';
    		}else {
    			$anak_tk_merangkak ='<div class="col-md-3">Merangkak : '. nl2br($val['anak_tk_merangkak']).'</div>';
    		}

        if (empty($val['anak_tk_sekolah'])) {
    			$anak_tk_sekolah = '';
    		}else {
    			$anak_tk_sekolah ='<div class="col-md-3">Sekolah : '. nl2br($val['anak_tk_sekolah']).'</div>';
    		}

        if((empty($val['bb_turun'])) or (empty($val['bb_turun_qty'])) or (empty($val['nafsu_makan']))
        or (empty($val['total_skor'])) or (empty($val['diagnosa_khusus'])) or (empty($val['pola_makan']))
        or (empty($val['keluhan_saat_ini']))
        ){
          $head_gizi = '';
        }else {
          $head_gizi = '<div class="col-md-12"><label><strong>STATUS KRITERIA RISIKO NUTRISIONAL (MALNUTRISION SCREENING TOOL / MST)</strong></label> </div>';
        }

        if (empty($val['bb_turun'])) {
    			$bb_turun = '';
    		}else {
    			$bb_turun ='<div class="col-md-4">|| penurunan BB dalam 6 bulan terakhir ? : '. nl2br($val['bb_turun']).'</div>';
    		}

        if (empty($val['bb_turun_qty'])) {
    			$bb_turun_qty = '';
    		}else {
    			$bb_turun_qty ='<div class="col-md-4">Jika ya berapa penurunan BB tersebut : '. nl2br($val['bb_turun_qty']).'</div>';
    		}

        if (empty($val['nafsu_makan'])) {
    			$nafsu_makan = '';
    		}else {
    			$nafsu_makan ='<div class="col-md-4">Kurang Nafsu Makan? : '. nl2br($val['nafsu_makan']).'</div>';
    		}

        if (empty($val['total_skor'])) {
    			$total_skor = '';
    		}else {
    			$total_skor ='<div class="col-md-4">Total skor : '. nl2br($val['total_skor']).'</div>';
    		}

        if (empty($val['diagnosa_khusus'])) {
    			$diagnosa_khusus = '';
    		}else {
    			$diagnosa_khusus ='<div class="col-md-4">diagnos khusus : : '. nl2br($val['diagnosa_khusus']).'</div>';
    		}

        if (empty($val['pola_makan'])) {
    			$pola_makan = '';
    		}else {
    			$pola_makan ='<div class="col-md-4">Pola makan : '. nl2br($val['pola_makan']).'</div>';
    		}

        if (empty($val['keluhan_saat_ini'])) {
    			$keluhan_saat_ini = '';
    		}else {
    			$keluhan_saat_ini ='<div class="col-md-4">Keluhan saat ini : '. nl2br($val['keluhan_saat_ini']).'</div>';
    		}


        if (empty($val['sf_total'])) {
    			$sf_total = '';
    		}else {
    			$sf_total ='<div class="col-md-12"> <strong>SKOR STATUS FUNGSIONAL</strong> : '. nl2br($val['sf_total']).'</div>';
    		}

        if (empty($val['pemeriksaan_penunjang'])) {
    			$pemeriksaan_penunjang = '';
    		}else {
    			$pemeriksaan_penunjang ='<div class="col-md-12"> <strong>PEMERIKSAAN PENUNJANG</strong> : '. nl2br($val['pemeriksaan_penunjang']).'</div>';
    		}

        if (empty($val['masalah_kesehatan'])) {
    			$masalah_kesehatan = '';
    		}else {
    			$masalah_kesehatan ='<div class="col-md-12"> <strong>MASALAH KESEHATAN :</strong>  '. nl2br($val['masalah_kesehatan']).'</div>';
    		}




        // ASSESMENT
        if (empty($val['diag_medis_banding_text'])) {
          $text_diag_medis_banding = '';
          $diag_medis_banding = '';
        }else {
          $text_diag_medis_banding = 'Diagnosa Medis dan Diagnosa Banding : ';
          $diag_medis_banding = nl2br($val['diag_medis_banding_text']). '<br>';
        }

        if (empty($val['masalah_keperawatan'])) {
          $text_masalah_keperawatan = '';
          $masalah_keperawatan = '';
        }else {
          $text_masalah_keperawatan = 'Masalah Keperawatan : ';
          $masalah_keperawatan = nl2br($val['masalah_keperawatan']). '<br>';
        }

        // PLANNING
        if (empty($val['planning_text'])) {
          $text_icd9cm = '';
          $icd9cm = '';
        }else {
          $text_icd9cm = 'Tindakan : ';
          $icd9cm = nl2br($val['planning_text']). '<br>';
        }

        if (empty($val['p_instruksi'])) {
          $text_instruksi = '';
          $instruksi = '';
        }else {
          $text_instruksi = 'Instruksi : ';
          $instruksi = nl2br($val['p_instruksi']). '<br>';
        }

        if (empty($val['rencana_keperawatan'])) {
          $text_rencana_keperawatan = '';
          $rencana_keperawatan= '';
        }else {
          $text_rencana_keperawatan = 'Rencana Keperawatan : ';
          $rencana_keperawatan = nl2br($val['rencana_keperawatan']). '<br>';
        }

        if (empty($val['edukasi'])) {
          $text_edukasi = '';
          $edukasi = '';
        }else {
          $text_edukasi = 'Kebutuhan Edukasi/Pendidikan Kesehatan : ';
          $edukasi = nl2br($val['edukasi']). '<br>';
        }

        if (empty($val['pasien_pulang'])) {
          $text_pasien_pulang = '';
          $pasien_pulang = '';
        }else {
          $text_pasien_pulang = 'Perencanaan Pasien Pulang : ';
          $pasien_pulang = nl2br($val['pasien_pulang']). '<br>';
        }

        $id_asmri = $val['id_asmri'];

        if ($id_role == 1) {
          $link = '<a href="#" onclick="javascript:update_review(' . $id_asmri . ')"><img src="' . $icon_update . '" alt="Update"></a>';

          if ($val['is_review'] == '0') {
            $is_review = 'Belum Di Review';
          }else {
            $is_review = 'Sudah Di Review';
          }

          if ($val['is_verif'] == '0') {
            $is_verif = 'Belum Di Verifikasi';
          }else {
            $is_verif = 'Sudah Di Verifikasi';
          }

        }elseif ($id_role == 2) {
          if ($data_pasien['id_dokter'] == $id_dokter_login) {
            $link = '<a href="#" onclick="javascript:update_review(' . $id_asmri . ')"><img src="' . $icon_update . '" alt="Update"></a>';

            if ($val['is_review'] == '0') {
              $is_review = 'Belum Di Review';
            }else {
              $is_review = 'Sudah Di Review';
            }

            if ($val['is_verif'] == '0') {
              $is_verif = 'Belum Di Verifikasi';
            }else {
              $is_verif = 'Sudah Di Verifikasi';
            }

          }else {
            $link = '';

            if ($val['is_review'] == '0') {
              $is_review = 'Belum Di Review';
            }else {
              $is_review = 'Sudah Di Review';
            }

            if ($val['is_verif'] == '0') {
              $is_verif = 'Belum Di Verifikasi';
            }else {
              $is_verif = 'Sudah Di Verifikasi';
            }

          }
        }else {
          $link = '';
          if ($val['is_review'] == '0') {
            $is_review = 'Belum Di Review';
          }else {
            $is_review = 'Sudah Di Review';
          }

          if ($val['is_verif'] == '0') {
            $is_verif = 'Belum Di Verifikasi';
          }else {
            $is_verif = 'Sudah Di Verifikasi';
          }
        }

        if ($val['kategori'] == 'ASM') {
          $kategori_val = 'ASM AWAL';
        }else {
          $kategori_val = 'CPPT';
        }
    ?>
    <tr>
      <td><?php echo $val['created']; ?> <br> <br> <?php echo $kategori_val; ?></td>
      <td><?php echo $val['ppa']; ?></td>
      <td>
        <div class="row">
          <div class="col-md-3">
            Tgl Masuk : <?php echo $val['regdate']; ?>
          </div>
          <div class="col-md-3">
            Tgl Pengkajian : <?php echo date('d F Y', strtotime($val['tgl_pengkajian'])) ; ?>
          </div>
          <div class="col-md-3">
            Asal Masuk : <?php echo $val['asal_masuk']; ?>
          </div>
          <div class="col-md-3">
            Cara Masuk : <?php echo $val['cara_masuk']; ?>
          </div>
        </div>
        <h4 class="pnl-head-3">SUBJECTIVE</h4>
        <div class="row pnl">
            <div class="col-md-12">
                <?php echo nl2br($val['subjective']) ?>
            </div>
          <div class="col-md-3">
            <?php echo $text_keluhan_utama ?>
          </div>
          <div class="col-md-9">
            <?php echo $keluhan_utama ?>
          </div>

          <div class="col-md-3">
            <?php echo $text_riwayat_sakit ?>
          </div>
          <div class="col-md-9">
            <?php echo str_replace("<br />", "", $riwayat_sakit)  ?>
          </div>

          <div class="col-md-3">
            <?php echo $text_riwayat_sakit_dulu ?>
          </div>
          <div class="col-md-9">
            <?php echo str_replace("<br />", "", $riwayat_sakit_dulu)  ?>
          </div>

          <div class="col-md-3">
            <?php echo $text_riwayat_pengobatan?>
          </div>
          <div class="col-md-9">
            <?php echo str_replace("<br />", "", $riwayat_pengobatan)  ?>
          </div>

          <div class="col-md-3">
            <?php echo $text_riwayat_sakit_keluarga ?>
          </div>
          <div class="col-md-9">
            <?php echo str_replace("<br />", "", $riwayat_sakit_keluarga)  ?>
          </div>

          <div class="col-md-3">
            <?php echo $text_riwayat_alergi ?>
          </div>
          <div class="col-md-9">
            <?php echo str_replace("<br />", "", $riwayat_alergi)  ?>
          </div>

        </div>

        <h4 class="pnl-head-3">OBJECTIVE</h4>
        <div class="row pnl">
          <?php echo $objective ?>
          <?php echo $status_psikologi ?>

        <?php echo $head_sse ?>
          <?php echo $sse_nikah ?>
          <?php echo $sse_study ?>
          <?php echo $sse_job ?>
          <?php echo $sse_live ?>
          <?php echo $sse_agama ?>

          <?php echo $status_kultural ?>

          <?php echo $ibadah ?>
          <?php echo $thaharoh ?>
          <?php echo $sholat ?>
          <?php echo $bim_spiritual_muslim ?>
          <?php echo $bim_spiritual_nonmuslim ?>

          <?php echo $head_kondisi_umum ?>
            <?php echo $kesadaran ?>
            <?php echo $td ?>
            <?php echo $nadi ?>
            <?php echo $nafas ?>
            <?php echo $keadaan_umum ?>
            <?php echo $suhu ?>
            <?php echo $gcs ?>
            <?php echo $reaksi_cahaya ?>
            <?php echo $tinggi ?>
            <?php echo $berat ?>

          <?php echo $head_pemeriksaan_umum ?>
            <?php echo $kepala ?>
            <?php echo $rambut ?>
            <?php echo $wajah ?>
            <?php echo $mata ?>
            <?php echo $gigi ?>
            <?php echo $tenggorokan ?>
            <?php echo $lidah ?>
            <?php echo $leher ?>
            <?php echo $abdomen ?>
            <?php echo $dada ?>
            <?php echo $respirasi ?>
            <?php echo $jantung ?>
            <?php echo $integumen ?>
            <?php echo $ekstremitas ?>
            <?php echo $genetalia ?>
            <?php echo $elimitas ?>

          <?php echo $head_skala_nyeri ?>
            <?php echo $kualitas_nyeri ?>
            <?php echo $frekuensi_nyeri ?>
            <?php echo $waktu_nyeri ?>
            <?php echo $intesnsitas_nyeri ?>
            <?php echo $nyeri ?>
            <?php echo $pengaruh_nyeri ?>
            <?php echo $aktivitas ?>
            <?php echo $restrain ?>

            <?php echo $anak_nyeri_total ?>
            <?php echo $riwayat_imunisasi ?>

          <?php echo $head_tumbuh_anak ?>
            <?php echo $anak_tk_senyum ?>
            <?php echo $anak_tk_tengkurap ?>
            <?php echo $anak_tk_duduk ?>
            <?php echo $anak_tk_merangkak ?>
            <?php echo $anak_tk_berdiri ?>
            <?php echo $anak_tk_berjalan ?>
            <?php echo $anak_tk_bicara ?>
            <?php echo $anak_tk_sekolah ?>

          <?php echo $head_gizi ?>
            <?php echo $bb_turun ?>
            <?php echo $bb_turun_qty ?>
            <?php echo $nafsu_makan ?>
            <?php echo $total_skor ?>
            <?php echo $diagnosa_khusus ?>
            <?php echo $pola_makan ?>
            <?php echo $keluhan_saat_ini ?>

            <?php echo $sf_total ?>

            <?php echo $pemeriksaan_penunjang ?>
            <?php echo $masalah_kesehatan ?>

        </div>

        <h4 class="pnl-head-3">ASSESMENT</h4>
        <div class="row pnl">
            <div class="col-md-12">
                <?php echo nl2br($val['assesment']) ?>
            </div>
          <div class="col-md-3">
            <?php echo $text_diag_medis_banding ?>
          </div>
          <div class="col-md-9">
            <p style="overflow-wrap: break-word; border: 1px solid #000000;"><?php echo $diag_medis_banding ?></p>
          </div>

          <div class="col-md-3">
            <?php echo $text_masalah_keperawatan ?>
          </div>
          <div class="col-md-9">
            <?php echo $masalah_keperawatan ?>
          </div>
        </div>

        <h4 class="pnl-head-3">PLANNING</h4>
        <div class="row pnl">
            <div class="col-md-12">
                <?php echo nl2br($val['planning']) ?>
            </div>
          <div class="col-md-3">
            <?php echo $text_icd9cm ?>
          </div>
          <div class="col-md-9">
            <?php echo $icd9cm ?>
          </div>

          <!-- <div class="col-md-3">
            <?php echo $text_instruksi ?>
          </div>
          <div class="col-md-9">
            <?php echo $instruksi ?>
          </div> -->

          <div class="col-md-3">
            <?php echo $text_rencana_keperawatan ?>
          </div>
          <div class="col-md-9">
            <?php echo $rencana_keperawatan ?>
          </div>

          <div class="col-md-3">
            <?php echo $text_edukasi ?>
          </div>
          <div class="col-md-9">
            <?php echo $edukasi ?>
          </div>

          <div class="col-md-3">
            <?php echo $text_pasien_pulang ?>
          </div>
          <div class="col-md-9">
            <?php echo $pasien_pulang ?>
          </div>
        </div>

      </td>
      <td><?php echo $instruksi; ?></td>
      <td>
        <table border="1">
          <tr><td><?php echo $link; ?></a></td></tr>
          <tr><td><?php echo nl2br($is_review); ?></td></tr>
          <tr><td><?php echo nl2br($is_verif); ?></td></tr>
          <tr><td><?php echo nl2br($val['review']); ?></td></tr>
          <?php if($kategori_val=="ASM AWAL"){ /*nothing*/ }else{ ?>
          <tr><td style="text-align:center;"><a class="btn btn-warning edit_cppt_ranap" href="#" data-set-asmri="<?php echo $id_asmri; ?>" data-toggle="modal" data-target="#myModal5"><i class="fa fa-edit"></i> Edit</a></td></tr>
          <tr><td style="text-align:center;"><a class="btn btn-danger delete_asm" href="#" data-set-asmri="<?php echo $id_asmri; ?>"><i class="fa fa-trash"></i> Hapus</a></td></tr>
          <?php } ?>
        </table>
      </td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
</div>
    </div>
<div class="modal animated bounceIn" id="modal_form_review" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">FORM REVIEW CPPT</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form_review">
        <form action="#" id="form_review">
          <div class="form-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" class="form-control input-default" id="id_asmri" name="id_asmri">
                  <input type="checkbox" name="is_review" value="1"> TELAH DIREVIEW <br>
                  <input type="checkbox" name="is_verif" value="1"> TELAH DIVERIFIKASI
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">CATATAN :</label>
                  <textarea class="form-control input-focus area-scroll" id="review" name="review"
                    rows="5" placeholder="TULIS CATATAN DISINI"></textarea>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <div class="form-actions">
                <button type="button" class="btn btn-success" onclick="javascript: save_review('<?php echo $val['id_asmri']; ?>');">
                  <i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- action here -->
<script>
function save_review(id_asmri) {
  var url;

  if (save_method == 'add') {
    url = '';
    title = 'Data Berhasil Disimpan';
  } else {
    url = '<?php echo site_url('nurse_station/eranap/update_review_act'); ?>/' + id_asmri;
    title = 'Data Berhasil Di Review';
  }
  var data_submit = $('#form_review').serialize();
  $.ajax({
    type: 'POST',
    data: data_submit,
    dataType: 'JSON',
    url: url,
    success: function(data) {
      //console.log(data_submit);
      //console.log(data);
      Swal.fire({
        type: 'success',
        title: title,
        showConfirmButton: false,
        timer: 1000
      });

      window.setTimeout(function() {
        location.reload();
      }, 1000);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      //console.log(data);
      alert('Error Add / Update Data');
    }
  });

}

function update_review(id_asmri) {
  save_method = 'update';
  $('#form_review')[0].reset();

  $.ajax({
    url: '<?php echo site_url('nurse_station/eranap/update_review'); ?>/' + id_asmri,
    type: 'GET',
    dataType: 'JSON',
    success: function(data) {
      $('[name="id_asmri"]').val(data.id_asmri);

      var is_review = data.is_review;
      if (is_review.length > 0) {
        var is_review = data.is_review.split(";"),
          $inputs = $('input[name^=is_review]');
        for (var j = 0; j < is_review.length; j++) {
          $inputs.filter("[value='" + is_review[j] + "']").attr('checked', 'checked');
        }
      }

      var is_verif = data.is_verif;
      if (is_verif.length > 0) {
        var is_verif = data.is_verif.split(";"),
          $inputs = $('input[name^=is_verif]');
        for (var j = 0; j < is_verif.length; j++) {
          $inputs.filter("[value='" + is_verif[j] + "']").attr('checked', 'checked');
        }
      }

      $('[name="review"]').val(data.review);

      $('#modal_form_review').modal('show');
    },
    error: function(jqXHR, textStatus, errorThrown) {
      //console.log(data);
      alert('Error Get Data From Ajax');
    }
  });

}


</script>

</body>

</html>
