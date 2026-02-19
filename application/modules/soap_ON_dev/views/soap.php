<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/soapfnc/mnu-cmp-css.php');?>
<title>SOAP <?php echo $id_reg_set; ?></title>
</head>


<body>
<?php $this->theme->wrapper_open('theme_default'); ?>
<div class="loader-bg">
<div class="loader-bar"></div>
</div>

<div id="pcoded" class="pcoded">
<div class="pcoded-overlay-box"></div>
<div class="pcoded-container navbar-wrapper">

<div class="pcoded-main-container">
<div class="pcoded-wrapper">

<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<i class="feather icon-feather bg-c-blue"></i>
<div class="d-inline">
<h5>SOAP</h5>

<span>klik row nomor registrasi untuk melihat soap pasien</span>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item">
<a href="<?php echo base_url('soap/'); ?>">SOAP</a>
</li>
</ul>
</div>
</div>
</div>
</div>
<a href="#!" onclick="javascript:toggleFullScreen()"></a>
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">

<div class="page-body">
<!--tab-->
<div class="row">
<div class="col-sm-6">

<div class="card">
<div class="card-header">
<h5>IDENTITAS PASIEN</h5>
<span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
</div>
<div class="card-block">
  <table>
    <tbody>
    <tr>
        <td>ID Reg</td>
        <td>&nbsp;&nbsp;:&nbsp;</td>
        <td><?php echo $idreg; ?></td>
      </tr>
      <tr>
        <td>ID Pasien</td>
        <td>&nbsp;&nbsp;:&nbsp;</td>
        <td><?php echo $idpasien; ?></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>&nbsp;&nbsp;:&nbsp;</td>
        <td><?php echo $namapasien; ?></td>
      </tr>
      <tr>
        <td>Umur</td>
        <td>&nbsp;&nbsp;:&nbsp;</td>
        <td><?php echo $umur; ?></td>
      </tr>
      <tr>
        <td>Tanggal Lahir</td>
        <td>&nbsp;&nbsp;:&nbsp;</td>
        <td><?php echo $tgl_lahir; ?></td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>&nbsp;&nbsp;:&nbsp;</td>
        <td><?php echo $gender; ?></td>
      </tr>
    </tbody>
  </table>
</div>
</div>

</div>

<!--assesment & cppt-->
<div class="col-lg-6">
<div class="card">
<div class="card-header">
<h5 class="card-header-text">CPPT VIEWER</h5>
</div>
<div class="card-block accordion-block color-accordion-block">
<div class="color-accordion ui-accordion ui-widget ui-helper-reset" id="color-accordion" role="tablist">
<?php 
//assesment
$icon_update = base_url('assets/img/tulis.png');
foreach($data_asm as $val){
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
    $sse_nikah ='<div class="col-md-3"> <strong>* Status Pernikahan : :</strong>  '. nl2br($val['sse_nikah']).'</div>';
  }
    
  if (empty($val['sse_study'])) {
    $sse_study = '';
  }else {
    $sse_study ='<div class="col-md-3"> <strong>* Pendidikan Terakhir :</strong>  '. nl2br($val['sse_study']).'</div>';
  }
  
  if (empty($val['sse_job'])) {
    $sse_job = '';
  }else {
    $sse_job ='<div class="col-md-2"> <strong>* Pekerjaan  :</strong>  '. nl2br($val['sse_job']).'</div>';
  }
    
  if (empty($val['sse_live'])) {
    $sse_live = '';
  }else {
    $sse_live ='<div class="col-md-2"> <strong>* Tinggal Bersama :</strong>  '. nl2br($val['sse_live']).'</div>';
  }
    
  if (empty($val['sse_agama'])) {
    $sse_agama = '';
  }else {
    $sse_agama ='<div class="col-md-2"> <strong>* Agama :</strong>  '. nl2br($val['sse_agama']).'</div>';
  }
  
  if (empty($val['status_kultural'])) {
    $status_kultural = '';
  }else {
    $status_kultural ='<div class="col-md-12"> <strong>STATUS KULTURAL :</strong>  '. nl2br($val['status_kultural']).'</div>';
  }
    
  if (empty($val['ibadah'])) {
    $ibadah = '';
  }else {
    $ibadah ='<div class="col-md-3"> * WAJIB IBADAH : '. nl2br($val['ibadah']). '</div>';
  }
    
  if (empty($val['thaharoh'])) {
    $thaharoh = '';
  }else {
    $thaharoh ='<div class="col-md-3"> * THOHARAH : '. nl2br($val['thaharoh']). '</div>';
  }
  
  if (empty($val['sholat'])) {
    $sholat = '';
  }else {
    $sholat ='<div class="col-md-3"> * SHOLAT : '. nl2br($val['sholat']). '</div>';
  }
    
  if (empty($val['bim_spiritual_muslim'])) {
    $bim_spiritual_muslim = '';
  }else {
    $bim_spiritual_muslim ='<div class="col-md-3"> * Bimbingan Spiritual Muslim : '. nl2br($val['bim_spiritual_muslim']). '</div>';
  }
    
  if (empty($val['bim_spiritual_nonmuslim'])) {
    $bim_spiritual_nonmuslim = '';
  }else {
    $bim_spiritual_nonmuslim ='<div class="col-md-3"> * Bimbingan Spiritual Non Muslim : '. nl2br($val['bim_spiritual_nonmuslim']). '</div>';
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
    $kesadaran ='<div class="col-md-3"> * Kesadaran : '. nl2br($val['kesadaran']). '</div>';
  }
    
  if (empty($val['td'])) {
    $td = '';
  }else {
    $td ='<div class="col-md-3"> * Tekanan Darah : '. nl2br($val['td']).'</div>';
  }
  
  if (empty($val['nadi'])) {
    $nadi = '';
  }else {
    $nadi ='<div class="col-md-3"> * Nadi : '. nl2br($val['nadi']).'</div>';
  }
    
  if (empty($val['nafas'])) {
    $nafas = '';
  }else {
    $nafas ='<div class="col-md-3"> * Pernafasan : '. nl2br($val['nafas']).'</div>';
  }
    
  if (empty($val['keadaan_umum'])) {
    $keadaan_umum = '';
  }else {
    $keadaan_umum ='<div class="col-md-3"> * keadaan umum : '. nl2br($val['keadaan_umum']).'</div>';
  }
    
  if (empty($val['gcs'])) {
    $gcs = '';
  }else {
    $gcs ='<div class="col-md-3"> * GCS : '. nl2br($val['gcs']).'</div>';
  }
  
  if (empty($val['suhu'])) {
    $suhu = '';
  }else {
    $suhu ='<div class="col-md-3"> * suhu : '. nl2br($val['suhu']).'</div>';
  }
    
  if (empty($val['reaksi_cahaya'])) {
    $reaksi_cahaya = '';
  }else {
    $reaksi_cahaya ='<div class="col-md-3"> * reaksi cahaya : '. nl2br($val['reaksi_cahaya']).'</div>';
  }
    
  if (empty($val['tinggi'])) {
    $tinggi = '';
  }else {
    $tinggi ='<div class="col-md-3"> * tinggi : '. nl2br($val['tinggi']).'</div>';
  }
    
  if (empty($val['berat'])) {
    $berat = '';
  }else {
    $berat ='<div class="col-md-3"> * Berat : '. nl2br($val['berat']).'</div>';
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
    $kepala ='<div class="col-md-3"> * Kepala : '. nl2br($val['pu_kepala']).'</div>';
  }
    
  if (empty($val['pu_rambut'])) {
    $rambut = '';
  }else {
    $rambut ='<div class="col-md-3"> * rambut : '. nl2br($val['pu_rambut']).'</div>';
  }
    
  if (empty($val['pu_wajah'])) {
    $wajah = '';
  }else {
    $wajah ='<div class="col-md-3"> * wajah : '. nl2br($val['pu_wajah']).'</div>';
  }
  
  if (empty($val['pu_mata'])) {
    $mata = '';
  }else {
    $mata ='<div class="col-md-3"> * mata : '. nl2br($val['pu_mata']).'</div>';
  }
    
  if (empty($val['pu_gigi'])) {
    $gigi = '';
  }else {
    $gigi ='<div class="col-md-3"> * gigi : '. nl2br($val['pu_gigi']).'</div>';
  }
    
  if (empty($val['pu_tenggorokan'])) {
    $tenggorokan = '';
  }else {
    $tenggorokan ='<div class="col-md-3"> * tenggorokan : '. nl2br($val['pu_tenggorokan']).'</div>';
  }
    
  if (empty($val['pu_lidah'])) {
    $lidah = '';
  }else {
    $lidah ='<div class="col-md-3"> * lidah : '. nl2br($val['pu_lidah']).'</div>';
  }
  
  if (empty($val['pu_leher'])) {
    $leher = '';
  }else {
    $leher ='<div class="col-md-3"> * leher : '. nl2br($val['pu_leher']).'</div>';
  }
    
  if (empty($val['pu_abdomen'])) {
    $abdomen = '';
  }else {
    $abdomen ='<div class="col-md-3"> * abdomen : '. nl2br($val['pu_abdomen']).'</div>';
  }
    
  if (empty($val['pu_dada'])) {
    $dada= '';
  }else {
    $dada ='<div class="col-md-3"> * dada : '. nl2br($val['pu_dada']).'</div>';
  }
    
  if (empty($val['pu_respirasi'])) {
    $respirasi = '';
  }else {
    $respirasi ='<div class="col-md-3"> * respirasi : '. nl2br($val['pu_respirasi']).'</div>';
  }
    
    
  if (empty($val['pu_jantung'])) {
    $jantung = '';
  }else {
    $jantung ='<div class="col-md-3"> * jantung : '. nl2br($val['pu_jantung']).'</div>';
  }
    
  if (empty($val['pu_integumen'])) {
    $integumen = '';
  }else {
    $integumen ='<div class="col-md-3"> * integumen : '. nl2br($val['pu_integumen']).'</div>';
  }
  
  if (empty($val['pu_ekstremitas'])) {
    $ekstremitas = '';
  }else {
    $ekstremitas ='<div class="col-md-3"> * ekstremitas : '. nl2br($val['pu_ekstremitas']).'</div>';
  }
    
  if (empty($val['pu_genetalia'])) {
    $genetalia = '';
  }else {
    $genetalia ='<div class="col-md-3"> * genetalia : '. nl2br($val['pu_genetalia']).'</div>';
  }
    
  if (empty($val['pu_elimitas'])) {
    $elimitas = '';
  }else {
    $elimitas ='<div class="col-md-3"> * elimitas : '. nl2br($val['pu_elimitas']).'</div>';
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
    $kualitas_nyeri ='<div class="col-md-12"> * Kualitas nyeri : '. nl2br($val['kualitas_nyeri']).'</div>';
  }
  
  if (empty($val['frekuensi_nyeri'])) {
    $frekuensi_nyeri = '';
  }else {
    $frekuensi_nyeri ='<div class="col-md-12"> * Frekuensi nyeri : '. nl2br($val['frekuensi_nyeri']).'</div>';
  }
    
  if (empty($val['waktu_nyeri'])) {
    $waktu_nyeri = '';
  }else {
    $waktu_nyeri ='<div class="col-md-12"> * Timbulnya nyeri pada saat : '. nl2br($val['waktu_nyeri']).'</div>';
  }
    
  if (empty($val['intesnsitas_nyeri'])) {
    $intesnsitas_nyeri = '';
  }else {
    $intesnsitas_nyeri ='<div class="col-md-12"> * Intensitas nyeri : '. nl2br($val['intesnsitas_nyeri']).'</div>';
  }
    
  if (empty($val['nyeri'])) {
    $nyeri = '';
  }else {
    $nyeri ='<div class="col-md-12"> * Nyeri / tidak nyaman: '. nl2br($val['nyeri']).'</div>';
  }
    
  if (empty($val['pengaruh_nyeri'])) {
    $pengaruh_nyeri = '';
  }else {
    $pengaruh_nyeri ='<div class="col-md-12"> * Nyeri mempengaruhi : '. nl2br($val['pengaruh_nyeri']).'</div>';
  }
    
  if (empty($val['aktivitas'])) {
    $aktivitas = '';
  }else {
    $aktivitas ='<div class="col-md-12"> * Aktivitas : '. nl2br($val['aktivitas']).'</div>';
  }
  
  if (empty($val['restrain'])) {
    $restrain = '';
  }else {
    $restrain ='<div class="col-md-12"> * Perlu Restrain : '. nl2br($val['restrain']).'</div>';
  }
    
    
  if (empty($val['anak_nyeri_total'])) {
    $anak_nyeri_total = '';
  }else {
    $anak_nyeri_total ='<div class="col-md-12">SKOR TOTAL NYERI ANAK : '. nl2br($val['anak_nyeri_total']).'</div>';
  }
    
  if (empty($val['anak_riwayat_imunisasi'])) {
    $riwayat_imunisasi = '';
  }else {
    $riwayat_imunisasi ='<div class="col-md-3">* RIWAYAT IMUNISASI : '. nl2br($val['anak_riwayat_imunisasi']).'</div>';
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
    $bb_turun ='<div class="col-md-4">* penurunan BB dalam 6 bulan terakhir ? : '. nl2br($val['bb_turun']).'</div>';
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
    
  if ($val['kategori'] == 'ASM') {
    $kategori_val = 'ASM AWAL';
  }else {
    $kategori_val = 'CPPT';
  }
  
?>
<a class="accordion-msg b-none waves-effect waves-light scale_active ui-accordion-header ui-corner-top ui-state-default ui-accordion-icons ui-accordion-header-active ui-state-active" role="tab" id="ui-id-7" aria-controls="ui-id-8" aria-selected="true" aria-expanded="true" tabindex="0"><span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-up"></span><?php echo $kategori_val; ?> - <?php echo date('d F Y H:i:s', strtotime($val['asmri_date'])) ; ?></a>
<div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content ui-accordion-content-active" style="" id="ui-id-8" aria-labelledby="ui-id-7" role="tabpanel" aria-hidden="false">
<!--content ass awal-->
<tbody>
    <tr>
      <td>
        <h4 class="pnl-head-3" style="text-align:left;"><?php echo $sub; ?></h4>
        <div class="row pnl">
            <div class="col-md-12">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo nl2br($val['subjective']) ?><?php //</pre> ?>
            </div>
          <div class="col-md-3">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_keluhan_utama ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $keluhan_utama ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_riwayat_sakit ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_sakit)  ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?> <?php echo $text_riwayat_sakit_dulu ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_sakit_dulu)  ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_riwayat_pengobatan?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_pengobatan)  ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_riwayat_sakit_keluarga ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_sakit_keluarga)  ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_riwayat_alergi ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_alergi)  ?><?php //</pre> ?>
          </div>

        </div>

        <h4 class="pnl-head-3" style="text-align:left;"><?php echo $obj; ?></h4>
        <div class="row pnl">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $objective ?><?php //</pre> ?>
          <?php echo $status_psikologi ?>

          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_sse ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_nikah ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_study ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_job ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_live ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_agama ?><?php //</pre> ?>

          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $status_kultural ?><?php //</pre> ?>

          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $ibadah ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $thaharoh ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sholat ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $bim_spiritual_muslim ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $bim_spiritual_nonmuslim ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_kondisi_umum ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $kesadaran ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $td ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $nadi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $nafas ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $keadaan_umum ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $suhu ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $gcs ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $reaksi_cahaya ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $tinggi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $berat ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_pemeriksaan_umum ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $kepala ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $rambut ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $wajah ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $mata ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $gigi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $tenggorokan ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $lidah ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $leher ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $abdomen ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $dada ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $respirasi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $jantung ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $integumen ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $ekstremitas ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $genetalia ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $elimitas ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_skala_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $kualitas_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $frekuensi_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $waktu_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $intesnsitas_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $pengaruh_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $aktivitas ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $restrain ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_nyeri_total ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $riwayat_imunisasi ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_tumbuh_anak ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_senyum ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_tengkurap ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_duduk ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_merangkak ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_berdiri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_berjalan ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_bicara ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_sekolah ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_gizi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $bb_turun ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $bb_turun_qty ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $nafsu_makan ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $total_skor ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $diagnosa_khusus ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $pola_makan ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $keluhan_saat_ini ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sf_total ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $pemeriksaan_penunjang ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $masalah_kesehatan ?><?php //</pre> ?>

        </div>

        <h4 class="pnl-head-3" style="text-align:left;"><?php echo $ases; ?></h4>
        <div class="row pnl">
            <div class="col-md-12">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo nl2br($val['assesment']) ?><?php //</pre> ?>
            </div>
          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_diag_medis_banding ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $diag_medis_banding ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_masalah_keperawatan ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $masalah_keperawatan ?><?php //</pre> ?>
          </div>
        </div>

        <h4 class="pnl-head-3" style="text-align:left;"><?php echo $plan; ?></h4>
        <div class="row pnl">
            <div class="col-md-12">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo nl2br($val['planning']) ?><?php //</pre> ?>
            </div>
          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_icd9cm ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $icd9cm ?><?php //</pre> ?>
          </div>

          <!-- <div class="col-md-3">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_instruksi ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php //echo $instruksi ?><?php //</pre> ?>
          </div> -->

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_rencana_keperawatan ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $rencana_keperawatan ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_edukasi ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $edukasi ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_pasien_pulang ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $pasien_pulang ?><?php //</pre> ?>
          </div>
        </div>

      </td>
      <td style="word-wrap: break-word; text-align: justify;"><?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $instruksi; ?><?php //</pre> ?></td>
      <td>
        <?php echo $link; ?>
        </a>
        <br>
        <?php echo nl2br($is_review); ?> <br>
        <?php echo nl2br($is_verif); ?> <br> <br>
        <?php echo nl2br($val['review']); ?>
      </td>
    </tr>
  </tbody>
<!--end ass awal-->
</div>
<?php } ?>
<?php
foreach($data_cppt as $val){
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
    $sse_nikah ='<div class="col-md-3"> <strong>* Status Pernikahan : :</strong>  '. nl2br($val['sse_nikah']).'</div>';
  }
    
  if (empty($val['sse_study'])) {
    $sse_study = '';
  }else {
    $sse_study ='<div class="col-md-3"> <strong>* Pendidikan Terakhir :</strong>  '. nl2br($val['sse_study']).'</div>';
  }
  
  if (empty($val['sse_job'])) {
    $sse_job = '';
  }else {
    $sse_job ='<div class="col-md-2"> <strong>* Pekerjaan  :</strong>  '. nl2br($val['sse_job']).'</div>';
  }
    
  if (empty($val['sse_live'])) {
    $sse_live = '';
  }else {
    $sse_live ='<div class="col-md-2"> <strong>* Tinggal Bersama :</strong>  '. nl2br($val['sse_live']).'</div>';
  }
    
  if (empty($val['sse_agama'])) {
    $sse_agama = '';
  }else {
    $sse_agama ='<div class="col-md-2"> <strong>* Agama :</strong>  '. nl2br($val['sse_agama']).'</div>';
  }
  
  if (empty($val['status_kultural'])) {
    $status_kultural = '';
  }else {
    $status_kultural ='<div class="col-md-12"> <strong>STATUS KULTURAL :</strong>  '. nl2br($val['status_kultural']).'</div>';
  }
    
  if (empty($val['ibadah'])) {
    $ibadah = '';
  }else {
    $ibadah ='<div class="col-md-3"> * WAJIB IBADAH : '. nl2br($val['ibadah']). '</div>';
  }
    
  if (empty($val['thaharoh'])) {
    $thaharoh = '';
  }else {
    $thaharoh ='<div class="col-md-3"> * THOHARAH : '. nl2br($val['thaharoh']). '</div>';
  }
  
  if (empty($val['sholat'])) {
    $sholat = '';
  }else {
    $sholat ='<div class="col-md-3"> * SHOLAT : '. nl2br($val['sholat']). '</div>';
  }
    
  if (empty($val['bim_spiritual_muslim'])) {
    $bim_spiritual_muslim = '';
  }else {
    $bim_spiritual_muslim ='<div class="col-md-3"> * Bimbingan Spiritual Muslim : '. nl2br($val['bim_spiritual_muslim']). '</div>';
  }
    
  if (empty($val['bim_spiritual_nonmuslim'])) {
    $bim_spiritual_nonmuslim = '';
  }else {
    $bim_spiritual_nonmuslim ='<div class="col-md-3"> * Bimbingan Spiritual Non Muslim : '. nl2br($val['bim_spiritual_nonmuslim']). '</div>';
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
    $kesadaran ='<div class="col-md-3"> * Kesadaran : '. nl2br($val['kesadaran']). '</div>';
  }
    
  if (empty($val['td'])) {
    $td = '';
  }else {
    $td ='<div class="col-md-3"> * Tekanan Darah : '. nl2br($val['td']).'</div>';
  }
  
  if (empty($val['nadi'])) {
    $nadi = '';
  }else {
    $nadi ='<div class="col-md-3"> * Nadi : '. nl2br($val['nadi']).'</div>';
  }
    
  if (empty($val['nafas'])) {
    $nafas = '';
  }else {
    $nafas ='<div class="col-md-3"> * Pernafasan : '. nl2br($val['nafas']).'</div>';
  }
    
  if (empty($val['keadaan_umum'])) {
    $keadaan_umum = '';
  }else {
    $keadaan_umum ='<div class="col-md-3"> * keadaan umum : '. nl2br($val['keadaan_umum']).'</div>';
  }
    
  if (empty($val['gcs'])) {
    $gcs = '';
  }else {
    $gcs ='<div class="col-md-3"> * GCS : '. nl2br($val['gcs']).'</div>';
  }
  
  if (empty($val['suhu'])) {
    $suhu = '';
  }else {
    $suhu ='<div class="col-md-3"> * suhu : '. nl2br($val['suhu']).'</div>';
  }
    
  if (empty($val['reaksi_cahaya'])) {
    $reaksi_cahaya = '';
  }else {
    $reaksi_cahaya ='<div class="col-md-3"> * reaksi cahaya : '. nl2br($val['reaksi_cahaya']).'</div>';
  }
    
  if (empty($val['tinggi'])) {
    $tinggi = '';
  }else {
    $tinggi ='<div class="col-md-3"> * tinggi : '. nl2br($val['tinggi']).'</div>';
  }
    
  if (empty($val['berat'])) {
    $berat = '';
  }else {
    $berat ='<div class="col-md-3"> * Berat : '. nl2br($val['berat']).'</div>';
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
    $kepala ='<div class="col-md-3"> * Kepala : '. nl2br($val['pu_kepala']).'</div>';
  }
    
  if (empty($val['pu_rambut'])) {
    $rambut = '';
  }else {
    $rambut ='<div class="col-md-3"> * rambut : '. nl2br($val['pu_rambut']).'</div>';
  }
    
  if (empty($val['pu_wajah'])) {
    $wajah = '';
  }else {
    $wajah ='<div class="col-md-3"> * wajah : '. nl2br($val['pu_wajah']).'</div>';
  }
  
  if (empty($val['pu_mata'])) {
    $mata = '';
  }else {
    $mata ='<div class="col-md-3"> * mata : '. nl2br($val['pu_mata']).'</div>';
  }
    
  if (empty($val['pu_gigi'])) {
    $gigi = '';
  }else {
    $gigi ='<div class="col-md-3"> * gigi : '. nl2br($val['pu_gigi']).'</div>';
  }
    
  if (empty($val['pu_tenggorokan'])) {
    $tenggorokan = '';
  }else {
    $tenggorokan ='<div class="col-md-3"> * tenggorokan : '. nl2br($val['pu_tenggorokan']).'</div>';
  }
    
  if (empty($val['pu_lidah'])) {
    $lidah = '';
  }else {
    $lidah ='<div class="col-md-3"> * lidah : '. nl2br($val['pu_lidah']).'</div>';
  }
  
  if (empty($val['pu_leher'])) {
    $leher = '';
  }else {
    $leher ='<div class="col-md-3"> * leher : '. nl2br($val['pu_leher']).'</div>';
  }
    
  if (empty($val['pu_abdomen'])) {
    $abdomen = '';
  }else {
    $abdomen ='<div class="col-md-3"> * abdomen : '. nl2br($val['pu_abdomen']).'</div>';
  }
    
  if (empty($val['pu_dada'])) {
    $dada= '';
  }else {
    $dada ='<div class="col-md-3"> * dada : '. nl2br($val['pu_dada']).'</div>';
  }
    
  if (empty($val['pu_respirasi'])) {
    $respirasi = '';
  }else {
    $respirasi ='<div class="col-md-3"> * respirasi : '. nl2br($val['pu_respirasi']).'</div>';
  }
    
    
  if (empty($val['pu_jantung'])) {
    $jantung = '';
  }else {
    $jantung ='<div class="col-md-3"> * jantung : '. nl2br($val['pu_jantung']).'</div>';
  }
    
  if (empty($val['pu_integumen'])) {
    $integumen = '';
  }else {
    $integumen ='<div class="col-md-3"> * integumen : '. nl2br($val['pu_integumen']).'</div>';
  }
  
  if (empty($val['pu_ekstremitas'])) {
    $ekstremitas = '';
  }else {
    $ekstremitas ='<div class="col-md-3"> * ekstremitas : '. nl2br($val['pu_ekstremitas']).'</div>';
  }
    
  if (empty($val['pu_genetalia'])) {
    $genetalia = '';
  }else {
    $genetalia ='<div class="col-md-3"> * genetalia : '. nl2br($val['pu_genetalia']).'</div>';
  }
    
  if (empty($val['pu_elimitas'])) {
    $elimitas = '';
  }else {
    $elimitas ='<div class="col-md-3"> * elimitas : '. nl2br($val['pu_elimitas']).'</div>';
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
    $kualitas_nyeri ='<div class="col-md-12"> * Kualitas nyeri : '. nl2br($val['kualitas_nyeri']).'</div>';
  }
  
  if (empty($val['frekuensi_nyeri'])) {
    $frekuensi_nyeri = '';
  }else {
    $frekuensi_nyeri ='<div class="col-md-12"> * Frekuensi nyeri : '. nl2br($val['frekuensi_nyeri']).'</div>';
  }
    
  if (empty($val['waktu_nyeri'])) {
    $waktu_nyeri = '';
  }else {
    $waktu_nyeri ='<div class="col-md-12"> * Timbulnya nyeri pada saat : '. nl2br($val['waktu_nyeri']).'</div>';
  }
    
  if (empty($val['intesnsitas_nyeri'])) {
    $intesnsitas_nyeri = '';
  }else {
    $intesnsitas_nyeri ='<div class="col-md-12"> * Intensitas nyeri : '. nl2br($val['intesnsitas_nyeri']).'</div>';
  }
    
  if (empty($val['nyeri'])) {
    $nyeri = '';
  }else {
    $nyeri ='<div class="col-md-12"> * Nyeri / tidak nyaman: '. nl2br($val['nyeri']).'</div>';
  }
    
  if (empty($val['pengaruh_nyeri'])) {
    $pengaruh_nyeri = '';
  }else {
    $pengaruh_nyeri ='<div class="col-md-12"> * Nyeri mempengaruhi : '. nl2br($val['pengaruh_nyeri']).'</div>';
  }
    
  if (empty($val['aktivitas'])) {
    $aktivitas = '';
  }else {
    $aktivitas ='<div class="col-md-12"> * Aktivitas : '. nl2br($val['aktivitas']).'</div>';
  }
  
  if (empty($val['restrain'])) {
    $restrain = '';
  }else {
    $restrain ='<div class="col-md-12"> * Perlu Restrain : '. nl2br($val['restrain']).'</div>';
  }
    
    
  if (empty($val['anak_nyeri_total'])) {
    $anak_nyeri_total = '';
  }else {
    $anak_nyeri_total ='<div class="col-md-12">SKOR TOTAL NYERI ANAK : '. nl2br($val['anak_nyeri_total']).'</div>';
  }
    
  if (empty($val['anak_riwayat_imunisasi'])) {
    $riwayat_imunisasi = '';
  }else {
    $riwayat_imunisasi ='<div class="col-md-3">* RIWAYAT IMUNISASI : '. nl2br($val['anak_riwayat_imunisasi']).'</div>';
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
    $bb_turun ='<div class="col-md-4">* penurunan BB dalam 6 bulan terakhir ? : '. nl2br($val['bb_turun']).'</div>';
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
    
  if ($val['kategori'] == 'ASM') {
    $kategori_val = 'ASM AWAL';
  }else {
    $kategori_val = 'CPPT';
  }
  
?>
<a class="accordion-msg bg-dark-primary b-none waves-effect waves-light scale_active ui-accordion-header ui-corner-top ui-state-default ui-accordion-icons ui-accordion-header-collapsed ui-corner-all" role="tab" id="ui-id-9" aria-controls="ui-id-10" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon zmdi zmdi-chevron-down"></span><?php echo $kategori_val; ?> - <?php echo date('d F Y H:i:s', strtotime($val['asmri_date'])) ; ?></a>
<div class="accordion-desc ui-accordion-content ui-corner-bottom ui-helper-reset ui-widget-content" style="display: none;" id="ui-id-10" aria-labelledby="ui-id-9" role="tabpanel" aria-hidden="true">
<p>
<!--content ass awal-->
<tbody>
    <tr>
      <td>
        <h4 class="pnl-head-3" style="text-align:left;"><?php echo $sub; ?></h4>
        <div class="row pnl">
            <div class="col-md-12">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo nl2br($val['subjective']) ?><?php //</pre> ?>
            </div>
          <div class="col-md-3">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_keluhan_utama ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $keluhan_utama ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_riwayat_sakit ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_sakit)  ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?> <?php echo $text_riwayat_sakit_dulu ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_sakit_dulu)  ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_riwayat_pengobatan?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_pengobatan)  ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_riwayat_sakit_keluarga ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_sakit_keluarga)  ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_riwayat_alergi ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo str_replace("<br />", "", $riwayat_alergi)  ?><?php //</pre> ?>
          </div>

        </div>

        <h4 class="pnl-head-3" style="text-align:left;"><?php echo $obj; ?></h4>
        <div class="row pnl">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $objective ?><?php //</pre> ?>
          <?php echo $status_psikologi ?>

          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_sse ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_nikah ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_study ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_job ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_live ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sse_agama ?><?php //</pre> ?>

          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $status_kultural ?><?php //</pre> ?>

          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $ibadah ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $thaharoh ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sholat ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $bim_spiritual_muslim ?><?php //</pre> ?>
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $bim_spiritual_nonmuslim ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_kondisi_umum ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $kesadaran ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $td ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $nadi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $nafas ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $keadaan_umum ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $suhu ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $gcs ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $reaksi_cahaya ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $tinggi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $berat ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_pemeriksaan_umum ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $kepala ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $rambut ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $wajah ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $mata ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $gigi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $tenggorokan ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $lidah ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $leher ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $abdomen ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $dada ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $respirasi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $jantung ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $integumen ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $ekstremitas ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $genetalia ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $elimitas ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_skala_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $kualitas_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $frekuensi_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $waktu_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $intesnsitas_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $pengaruh_nyeri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $aktivitas ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $restrain ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_nyeri_total ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $riwayat_imunisasi ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_tumbuh_anak ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_senyum ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_tengkurap ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_duduk ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_merangkak ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_berdiri ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_berjalan ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_bicara ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $anak_tk_sekolah ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $head_gizi ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $bb_turun ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $bb_turun_qty ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $nafsu_makan ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $total_skor ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $diagnosa_khusus ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $pola_makan ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $keluhan_saat_ini ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $sf_total ?><?php //</pre> ?>

            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $pemeriksaan_penunjang ?><?php //</pre> ?>
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $masalah_kesehatan ?><?php //</pre> ?>

        </div>

        <h4 class="pnl-head-3" style="text-align:left;"><?php echo $ases; ?></h4>
        <div class="row pnl">
            <div class="col-md-12">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo nl2br($val['assesment']) ?><?php //</pre> ?>
            </div>
          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_diag_medis_banding ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $diag_medis_banding ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_masalah_keperawatan ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $masalah_keperawatan ?><?php //</pre> ?>
          </div>
        </div>

        <h4 class="pnl-head-3" style="text-align:left;"><?php echo $plan; ?></h4>
        <div class="row pnl">
            <div class="col-md-12">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo nl2br($val['planning']) ?><?php //</pre> ?>
            </div>
          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_icd9cm ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $icd9cm ?><?php //</pre> ?>
          </div>

          <!-- <div class="col-md-3">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_instruksi ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
            <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php //echo $instruksi ?><?php //</pre> ?>
          </div> -->

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_rencana_keperawatan ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $rencana_keperawatan ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_edukasi ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $edukasi ?><?php //</pre> ?>
          </div>

          <div class="col-md-3">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $text_pasien_pulang ?><?php //</pre> ?>
          </div>
          <div class="col-md-9">
          <?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $pasien_pulang ?><?php //</pre> ?>
          </div>
        </div>

      </td>
      <td style="word-wrap: break-word; text-align: justify;"><?php //<pre style="font-weight: normal;color:#000000;white-space: normal;font-size:9pt;"> ?><?php echo $instruksi; ?><?php //</pre> ?></td>
      <td>
        <?php echo $link; ?>
        </a>
        <br>
        <?php echo nl2br($is_review); ?> <br>
        <?php echo nl2br($is_verif); ?> <br> <br>
        <?php echo nl2br($val['review']); ?>
      </td>
    </tr>
  </tbody>
<!--end ass awal-->
</p>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
<!--end assesment & cppt-->

</div>

<div class="tab-content">

              <div class="tab-pane p-20" id="contmnu_1" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>

              <div class="tab-pane p-20" id="contmnu_2" role="tabpanel">
                <div class="col-sm-12 text-center">
                  <h5>Loading page content, please wait...</h5>
                  <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
                </div>
              </div>
</div>

</div>
</div>

</div>
</div>
</div>
</div>


<div id="styleSelector"></div>
</div>
</div>
</div>








<div id="styleSelector"></div>
</body>
<?php  ?>


<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/soapfnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/soapfnc/fncsoap.js'); ?>></script>

<script>
$('#mnu_1').click(function(e) {
  inner_loader('<?php echo base_url('dokter/soap/asm/'.$id_reg) ?>', '#contmnu_1', true, '');
});
$('#mnu_2').click(function(e) {
  inner_loader('<?php echo base_url('dokter/soap/cppt/'.$id_reg) ?>', '#contmnu_2', true, '');
});
</script>