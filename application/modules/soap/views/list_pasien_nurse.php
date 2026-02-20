<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/soapfnc/mnu-cmp-css.php');?>
<title>TTV</title>
</head>
<body>
<?php $this->theme->wrapper_open('theme_default'); ?>
<div id="ttvformnyah"></div>
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

</div>

<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">

<div id="headersetnyah">
<div class="card is-loading">
<div id="imageload" class="">
<div class="card-block table-border-style">
<div class="container">
<div class="row">
<div class="col-md-12" id="ttvformnyah">
<h5 id="data_pasien_ttvriwayat"></h5>
<div class="content">
<span class="setforlookviewer">Klik row untuk input TTV</span>
<button class="btn btn-info setcol setdatacolcon" onClick="collapseGrid(this)" attr-data-id="0" hidden>Klik disini untuk lihat riwayat</button>
<div class="contentriwayat" style="display: none;overflow-y: scroll; height:400px;" >
  <div class="setcon"></div>
</div>
</div>
</div>
</div>
</div>




</div>          
</div>            
</div>      
</div>  

<!--search pasien 520.1-->
<div class="row" id="set_front" style="padding-top:10px;">
<!--list pasien-->
<div class="col-sm-6">
<div class="card">
<div class="card-header">
<h5><button class="btn btn-warning" id="cari_data"><i class="fa fa-refresh"></i> Refresh Pencarian Pasien</button></h5>
</div>
<div class="card-block tab-icon">
<div id="datalistrpo"></div>
</div>
</div>
</div>
<!--end list pasien-->
<!--input ttv-->
<div class="col-sm-6">
<div class="card">
<div class="card-header">
<h5 id="data_pasien_ttv">Input TTV : </h5>
</div>
<div class="card-block tab-icon">
 <div class="row pnl">
    <div class="col-md-2">
      <div class="form-group">
      <input type="text" class="form-control input-sm" id="id_reg" name="id_reg" hidden>
      <input type="text" class="form-control input-sm" id="id_pasien" name="id_pasien" hidden>
      <input type="text" class="form-control input-sm" id="nama_pasien" name="nama_pasien" hidden>
        <label class="control-label">Kesadaran</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="kesadaran" name="kesadaran" placeholder="Kesadaran">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Keadaan Umum</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="keadaan_umum" name="keadaan_umum" placeholder="Keadaan Umum">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tekanan Darah.</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="td" name="td" placeholder="Tekanan Darah">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">GCS</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="gcs" name="gcs" placeholder="GCS">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Nadi</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="nadi" name="nadi" placeholder="Nadi">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">SUHU.</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="suhu" name="suhu" placeholder="SUHU">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Berat Badan</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="berat" name="berat" placeholder="Berat Badan">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Reaksi Pupil</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="reaksi_cahaya" name="reaksi_cahaya" placeholder="Reaksi Cahaya">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tinggi Badan</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="tinggi" name="tinggi" placeholder="Tinggi Badan">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Pernafasan</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="nafas" name="nafas" placeholder="Pernafasan">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label" id="tag_last_input"></label>
      </div>
    </div>
 </div>
 </div>
 <!--KONDISI STATUS-->
 <div class="card-header" >
 <h5>STATUS </h5>
 </div>
 <div class="card-block tab-icon" style="display: block;overflow-y: scroll; height:400px;box-shadow: 0 0 11px rgba(33,33,33,.2); " id="status2">
 <div class="col-md-12">
  <label class="control-label"><b>STATUS PSIKOLOGI :</b></label>
  <hr>
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <input type="checkbox" name="status_psikologi[]" value="1"> Marah
        <div class="input-group-addon"> </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="checkbox" name="status_psikologi[]" value="2"> Cemas
        <div class="input-group-addon"> </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <input type="checkbox" name="status_psikologi[]" value="3"> Depresi
        <div class="input-group-addon"> </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <input type="checkbox" name="status_psikologi[]" value="4"> Gelisah
        <div class="input-group-addon"> </div>
      </div>
    </div>
  </div>
  </div>
  <div class="col-md-12">
  <div class="row">
    <div class="col-md-2">
      <div class="form-group">
        <input type="checkbox" name="status_psikologi[]" value="5"> Takut
        <div class="input-group-addon"> </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="checkbox" name="status_psikologi[]" value="6"> Kecenderungan Bunuh Diri
        <div class="input-group-addon"> </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <input type="checkbox" name="status_psikologi[]" value="7"> Tidak Ada Masalah
        <div class="input-group-addon"> </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <input type="checkbox" name="status_psikologi[]" value="8"> Lain-Lain
        <div class="input-group-addon"> </div>
      </div>
    </div>
  </div>

  </div>
  <hr>
 <!--END KONDISI STATUS-->
 <div class="col-md-12">
    <div class="row">
      
    <div class="col-md-12">
        <div class="form-group">
          <label class="control-label"><b>STATUS EKONOMI : </b></label>
          <hr>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_ekonomi[]" value="1"> Asuransi
          <div class="input-group-addon"> </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_ekonomi[]" value="2"> Jaminan
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_ekonomi[]" value="3"> Biaya Sendiri
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <!--status spritiual-->
  <div class="col-md-12">
    <div class="row">
      
    <div class="col-md-12">
        <div class="form-group">
          <label class="control-label"><b>STATUS SPIRITUAL : </b></label>
          <hr>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label"> Bimbingan Spiritual Muslim :</label>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_spiritual[]" value="1"> Bimbingan ibadah 
          <div class="input-group-addon"> </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_spiritual[]" value="2"> motivasi kesembuhan
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label"> Bimbingan Spiritual Non Muslim :</label>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_spiritual[]" value="3"> motivasi kesembuhan
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>
  <!--end status spiritual-->

  <!--Resiko Jatuh-->
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label class="control-label"> Resiko Jatuh :</label>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
        Kategori Nilai : <br>
        0 – 20 Dependen Total <br>
        21 – 60 Dependen Berat <br>
        61 – 90 Dependen sedang <br>
        91 – 99 Dependen Ringan <br>
        100 Independen Mandiri <br>
        <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-label"> RISIKO JATUH :</label>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="resiko_jatuh[]" value="1">  Tidak Ada Resiko 0 – 24 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="resiko_jatuh[]" value="2">  Resiko Rendah 25- 44 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="resiko_jatuh[]" value="3">  Resiko Tinggi >= 45 
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-label"> STATUS NYERI :</label>
          <hr>
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label"> Kualitas Nyeri : </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="1">  Tertusuk
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="2">  Terbakar
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="3">  Tertekan
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label">  Timbul nyeri saat :  </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="4">  Beraktifitas
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="5">  Beristirahat
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label">  Intensitas nyeri :  </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="6">  Tidak ada nyeri : (0) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="7">  Nyeri ringan (1-3) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="8">  Nyeri sedang (4-6) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="9">  Nyeri berat (7-9) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="10">  Nyeri sangat berat (10) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label">   Nyeri / tidak nyaman :  </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="11">  YA
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="12">  TIDAK
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label">   Aktivitas :  </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="13"> Mandiri
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="14"> Bantuan total 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="15"> Bantu sebagian 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="16"> Resiko tinggi 
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label"> Perlu Restrain :   </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="17">  YA
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="status_nyeri[]" value="18">  TIDAK
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label"> STATUS KRITERIA RISIKO NUTRISIONAL (MALNUTRISION SCREENING TOOL / MST) : </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label"> Apakah pasien mengalami penurunan BB dalam 6 bulan terakhir ? </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="1"> Tidak (skor 0) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="2"> Tidak yakin I tidak tahu I baju terasa lebih longgar (skor 2) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label"> Jika ya berapa penurunan BB tersebut :  </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="3">  1-5 kg (skor1) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="4">  6-10 kg (skor2) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="5">   11-15kg(skor3) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="6">   15kg(skor4) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label"> Apakah asupan makan kurang karena tidak nafsu makan :  </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="7"> Tidak (skor 0 ) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="8"> Ya (skor 1) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label">  Apakah pasien mempunyai diagnos khusus : </label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="9"> Tidak
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="10"> Ya (DM/CKD/HD/Kanker/Hipertensi/Penurunan imunitas) 
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
        <label class="control-label">Keluhan Saat ini :</label>
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="11"> Mual
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="12"> Muntah
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="13"> Sulit menelan 
          <div class="input-group-addon"> </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <input type="checkbox" name="skrining_gizi[]" value="14">  Tidak ada masalah 
          <div class="input-group-addon"> </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!--end resiko jatuh-->
 <div class="card-header">
 <h5>SBAR </h5>
 </div>
 <div class="card-block tab-icon">
 <div class="row pnl">
 <div class="col-md-12">
      <div class="form-group">
        <textarea type="text" class="form-control input-sm" id="sbar_1" name="sbar_1" placeholder="Situation"></textarea>
      </div>
 </div>
 <div class="col-md-12">
      <div class="form-group">
        <textarea type="text" class="form-control input-sm" id="sbar_2" name="sbar_2" placeholder="Background"></textarea>
      </div>
 </div>
 <div class="col-md-12">
      <div class="form-group">
        <textarea type="text" class="form-control input-sm" id="sbar_3" name="sbar_3" placeholder="Assesment"></textarea>
      </div>
 </div>
 <div class="col-md-12">
      <div class="form-group">
        <textarea type="text" class="form-control input-sm" id="sbar_4" name="sbar_4" placeholder="Recomendation"></textarea>
      </div>
 </div>
 </div>
 </div>

 <div class="card-header">
 <h5>Tindakan </h5>
 </div>
 <div class="card-block tab-icon">
    <!--tindakan-->
    <div class="col-md-12">
    <div class="form-group row">
    <table class="table table-bordered table-hover table-striped table-responsive styled-table">
    <thead>
    <tr>
    <th scope="col">Tindakan</th>
    <th scope="col">Harga</th>
    <th scope="col">Qty</th>
    <th scope="col">Grup</th>
    <th scope="col">Sub Grup</th>
    <th scope="col" style="color:red;"><i class="fa fa-trash"></i></th>
    </tr>
    </thead>
    <tbody id="contdata_assesment"></tbody>
    <tbody id="box_tindakan"></tbody>
    </table>
    </div>
    </div>
    <!--end tindakan-->
 </div>
<button class="btn btn-success" id="simpan_ttv"><i class="fa fa-check"></i> Simpan</button>

</div>
</div>
<!--end input ttv-->
</div>
<!--end search pasien-->
</div>
</div>
</div>
</div>
</div>
<div id="styleSelector">
</div>
</div>
</div>
</div>
</div>

<!--side nav-->
<div id="mySidenav_tnd" class="sidenav_tnd">
  <a href="#" id="tindakan" class="tindakan_nav_side"><span class="icon_title_tnd"><i class="fa fa-stethoscope"></i> </span> <span class="text_title_tnd">Tindakan</span></a>
</div>
<!--end side nav-->

<div id="tindakan_nav_side_cont" class="overlay">
  <div class="overlay-content">
  <div class="col-lg-12">
  <div class="card">
  <div class="card-header">
  <h5 class="card-header-text">TINDAKAN</h5>
  <a href="#" class="closebtn tindakan_nav_side_close">&times;</a>
  </div>

      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nama Tindakan</label>
        <div class="col-sm-7">
          <div class="ui-widget">
            <input id="nama_tindakan_add" name="nama_tindakan_add" class="form-control">
            <input type="hidden" id="id_act_add" name="id_act_add" class="hidden" readonly>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Harga</label>
        <div class="col-sm-7">
          <input id="price_add" name="price_add" class="form-control autonumber fill" data-reverse>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Qty</label>
        <div class="col-sm-7">
          <input id="qty_add" name="qty_add" class="form-control autonumber fill" data-reverse>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Grup</label>
        <div class="col-sm-7">
          <input id="group_add" name="group_add" class="form-control" readonly>
          <input type="hidden" id="id_group_add" name="id_group_add" class="hidden" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Sub Grup</label>
        <div class="col-sm-7">
          <input id="subgroup_add" name="subgroup_add" class="form-control" readonly>
        </div>
      </div>
            <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nakes</label> 
        <div class="col-sm-7">
          <select class="form-control selmst_dokter" id="id_operator_add" name="id_operator_add"></select>
        </div>
      </div>

    <div class="form-group row" style="margin-top:10px;">
      <label class="col-sm-3 col-form-label">&nbsp;</label>
        <div class="col-sm-7">
          <button type="button" class="btn btn-primary" id="addrow_assesment"><i class="fa fa-plus"></i></button>
        </div>
      </div>

    </div>
    </div>

  </div>
</div>


</body>
<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/soapfnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/soapfnc/fncnurse.js'); ?>></script>