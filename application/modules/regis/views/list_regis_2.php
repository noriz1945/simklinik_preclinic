<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
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
<h5>Form Select</h5>
<span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item">
<a href="#!">Form Select</a>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">

<div class="page-body">
<!--tab-->
<div class="row">
<div class="col-sm-12">

<!--REGISTRASI PASIEN LAMA-->
<div class="row">
<div class="col-sm-12">

<!--set contain-->
<input type="text" class="form-control" id="gender_pasien_set" name="gender_pasien_set" value="<?php echo $gender_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="gd_pasien_set" name="gd_pasien_set" value="<?php echo $gd_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="rh_pasien_set" name="rh_pasien_set" value="<?php echo $rh_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="tgllhr_pasien_set" name="tgllhr_pasien_set" value="<?php echo $tgllhr_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="tandapengenal_pasien_set" name="tandapengenal_pasien_set" value="<?php echo $tandapengenal_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="agama_pasien_set" name="agama_pasien_set" value="<?php echo $agama_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="tempatlahir_pasien_set" name="tempatlahir_pasien_set" value="<?php echo $tempatlahir_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="nomorpengenal_pasien_set" name="nomorpengenal_pasien_set" value="<?php echo $nomorpengenal_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="alamat_pasien_set" name="alamat_pasien_set" value="<?php echo $alamat_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="kelurahan_pasien_set" name="kelurahan_pasien_set" value="<?php echo $kelurahan_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="kecamatan_pasien_set" name="kecamatan_pasien_set" value="<?php echo $kecamatan_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="kota_pasien_set" name="kota_pasien_set" value="<?php echo $kota_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="propinsi_pasien_set" name="propinsi_pasien_set" value="<?php echo $propinsi_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="kodepos_pasien_set" name="kodepos_pasien_set" value="<?php echo $kodepos_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="telp_pasien_set" name="telp_pasien_set" value="<?php echo $telp_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="hp_pasien_set" name="hp_pasien_set" value="<?php echo $hp_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="status_pasien_set" name="status_pasien_set" value="<?php echo $status_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="pendidikan_pasien_set" name="pendidikan_pasien_set" value="<?php echo $pendidikan_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="pekerjaan_pasien_set" name="pekerjaan_pasien_set" value="<?php echo $pekerjaan_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="jabatan_pasien_set" name="jabatan_pasien_set" value="<?php echo $jabatan_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="departemen_pasien_set" name="departemen_pasien_set" value="<?php echo $departemen_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="kebangsaan_pasien_set" name="kebangsaan_pasien_set" value="<?php echo $kebangsaan_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="nik_pasien_set" name="nik_pasien_set" value="<?php echo $nik_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="namakeluarga_pasien_set" name="namakeluarga_pasien_set" value="<?php echo $namakeluarga_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="alamatkeluarga_pasien_set" name="alamatkeluarga_pasien_set" value="<?php echo $alamatkeluarga_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="telpkeluarga_pasien_set" name="telpkeluarga_pasien_set" value="<?php echo $telpkeluarga_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="hpkeluarga_pasien_set" name="hpkeluarga_pasien_set" value="<?php echo $hpkeluarga_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="gender_pasien_set" name="gender_pasien_set" value="<?php echo $gender_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="penanggung_pasien_set" name="penanggung_pasien_set" value="<?php echo $penanggung_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="nomorkartu_pasien_set" name="nomorkartu_pasien_set" value="<?php echo $nomorkartu_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="namakartu_pasien_set" name="namakartu_pasien_set" value="<?php echo $namakartu_pasien_set; ?>" readonly disabled hidden>
<input type="text" class="form-control" id="asalperusahaan_pasien_set" name="asalperusahaan_pasien_set" value="<?php echo $asalperusahaan_pasien_set; ?>" readonly disabled hidden>
<!--end set contain-->

<!--Poliklinik-->
<div class="card">
<div class="card-header">
<h5>Poliklinik</h5>
 <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
</div>
<div class="card-block">

<!--Poliklinik 1-->
<div class="row">
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">Dokter 1</h4>
<select class="js-example-basic-single col-sm-12 selmstdokter" id="iddokter1" name="iddokter1"></select>
</div>
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">Poli 1</h4>
<select class="js-example-basic-single col-sm-12 selmstunit" id="idpoli1" name="idpoli1"></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Book</h4>
<input type="text" class="form-control" disabled>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Nomor</h4>
<input type="text" class="form-control" disabled>
</div>
</div>
<!--End Poliklinik 1-->
<!--Poliklinik 2
<div class="row">
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">Dokter 2</h4>
<select class="js-example-basic-single col-sm-12 selmstdokter2" id="selmstdokter2" id="iddokter2" name="iddokter2"></select>
</div>
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">Poli 2</h4>
<select class="js-example-basic-single col-sm-12 selmstunit2" id="idpoli2" name="idpoli2"></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Book</h4>
<input type="text" class="form-control" disabled>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Nomor</h4>
<input type="text" class="form-control" disabled>
</div>
</div>-->
<!--End Poliklinik 2-->
<!--Poliklinik 3
<div class="row">
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">Dokter 3</h4>
<select class="js-example-basic-single col-sm-12 selmstdokter3" id="selmstdokter3" id="iddokter3" name="iddokter3"></select>
</div>
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">Poli 3</h4>
<select class="js-example-basic-single col-sm-12 selmstunit3" id="idpoli3" name="idpoli3"></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Book</h4>
<input type="text" class="form-control" disabled>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Nomor</h4>
<input type="text" class="form-control" disabled>
</div>
</div>-->
<!--End Poliklinik 3-->

</div>
</div>
<!--End Poliklinik-->

<!--Pasien-->
<div class="card">
<div class="card-header">
<h5>Pasien</h5>
 <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
</div>
<div class="card-block">

<!--Row 1-->
<div class="row">
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">Nama</h4>
<input type="text" class="form-control nama_pasien" id="nama_pasien" name="nama_pasien" value="<?php echo $name_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">JK</h4>
<?php if($gender_pasien_set==0){ $sel_0 = ""; $sel_1 = "selected"; $sel_2 = ""; }elseif($gender_pasien_set==1){ $sel_0 = ""; $sel_1 = ""; $sel_2 = "selected"; }else{ $sel_0="selected"; $sel_1=""; $sel_2=""; } ?>
<select class="js-example-basic-single col-sm-12" disabled>
<option value="" <?php echo $sel_0; ?> disabled>-</option>
<option value="0" <?php echo $sel_1; ?>>Laki-Laki</option>
<option value="1" <?php echo $sel_2; ?>>Perempuan</option>
</select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">GD</h4>
<select class="js-example-basic-single col-sm-12 selmstgoldar" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">RH</h4>
<select class="js-example-basic-single col-sm-12 selmstrh" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">No. MR</h4>
<input type="text" class="form-control" id="search_id_pasien" name="search_id_pasien" value="<?php echo $id_pasien_set; ?>" readonly>
</div>
</div>
<!--End Row 1-->
<!--Row 2-->
<div class="row">
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">Tgl. Lahir</h4>
<input class="form-control fill" value="<?php echo $tgllhr_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Tanda Pengenal</h4>
<select class="js-example-basic-single col-sm-12 selmsttandapengenal" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Agama</h4>
<select class="js-example-basic-single col-sm-12 selmstagama" id="idagama" name="idagama" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Tempat Lahir</h4>
<input type="text" class="form-control" value="<?php echo $tempatlahir_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Nomor Pengenal</h4>
<input type="text" class="form-control" value="<?php echo $nomorpengenal_pasien_set; ?>" readonly>
</div>
</div>
<!--End Row 2-->
<!--Row 3-->
<div class="row">
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Alamat</h4>
<input type="text" class="form-control setalamat" id="setalamat" name="setalamat" value="<?php echo $alamat_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Kelurahan</h4>
<select class="js-example-basic-single col-sm-12 selmstkelurahan" id="idkelurahan" name="idkelurahan" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Kecamatan</h4>
<select class="js-example-basic-single col-sm-12 selmstkecamatan" id="idkecamatan" name="idkecamatan" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Kota/Kabupaten</h4>
<select class="js-example-basic-single col-sm-12 selmstkota" id="idkota" name="idkota" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Propinsi</h4>
<select class="js-example-basic-single col-sm-12 selmstpropinsi" id="idpropinsi" name="idpropinsi" disabled></select>
</div>
<div class="col-sm-1 col-xl-1 m-b-30">
<h4 class="sub-title">Kode Pos</h4>
<input type="text" class="form-control selmstkodepos" value="<?php echo $kodepos_pasien_set; ?>" readonly>
</div>
</div>
<!--End Row 3-->
<!--Row 4-->
<div class="row">
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">No. Telp</h4>
<input type="text" class="form-control" value="<?php echo $telp_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">No. HP</h4>
<input type="text" class="form-control" value="<?php echo $hp_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Status</h4>
<select class="js-example-basic-single col-sm-12 selmststatus" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Pendidikan</h4>
<select class="js-example-basic-single col-sm-12 selmstpendidikan" id="idpendidikan" name="idpendidikan" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Pekerjaan</h4>
<select class="js-example-basic-single col-sm-12 selmstpekerjaan" id="idpekerjaan" name="idpekerjaan" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Jabatan</h4>
<input type="text" class="form-control" value="<?php echo $jabatan_pasien_set; ?>" readonly>
</div>
</div>
<!--End Row 4-->
<!--Row 5-->
<div class="row">
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Departemen</h4>
<input type="text" class="form-control" value="<?php echo $departemen_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Kebangsaan</h4>
<select class="js-example-basic-single col-sm-12 selmstsuku" id="idsuku" name="idsuku" disabled></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">NIK</h4>
<input type="text" class="form-control" value="<?php echo $nomorpengenal_pasien_set; ?>" readonly>
</div>
</div>
<!--End Row 5-->
<!--Row 6-->
<div class="row">
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Nama Keluarga</h4>
<input type="text" class="form-control" value="<?php echo $namakeluarga_pasien_set; ?>" readonly>
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Alamat</h4>
<input type="text" class="form-control setalamatkeluarga" id="setalamatkeluarga" name="setalamatkeluarga" value="<?php echo $alamatkeluarga_pasien_set; ?>" readonly>
</div>
<div class="col-sm-1 col-xl-1 m-b-30">
<h4 class="sub-title">&nbsp;</h4>
<button class="btn btn-primary setcopy" disabled>Copy</button>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Telp</h4>
<input type="text" class="form-control" value="<?php echo $telpkeluarga_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">HP</h4>
<input type="text" class="form-control" value="<?php echo $hpkeluarga_pasien_set; ?>" readonly>
</div>
</div>
<!--End Row 6-->

</div>
</div>
<!--End Pasien-->


<!--Registrasi-->
<div class="card">
<div class="card-header">
<h5>Registrasi</h5>
 <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
</div>
<div class="card-block">

<!--Row 1-->
<div class="row">
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">Paket</h4>
<select class="js-example-basic-single col-sm-12 selmstpaket" id="selmstpaket" name="selmstpaket"></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">&nbsp;</h4>
<div class="border-checkbox-section">
<div class="border-checkbox-group border-checkbox-group-primary">
<input class="border-checkbox" type="checkbox" id="checkbox1">
<label class="border-checkbox-label" for="checkbox1">Kontrol Pasca Rawat Inap</label>
</div>
</div>
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">&nbsp;</h4>
<div class="border-checkbox-section">
<div class="border-checkbox-group border-checkbox-group-primary">
<input class="border-checkbox" type="checkbox" id="checkbox2">
<label class="border-checkbox-label" for="checkbox2">Pelayanan Satu Hari (One Day Care)</label>
</div>
</div>
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Keterangan</h4>
<textarea class="form-control"></textarea>
</div>
</div>
<!--End Row 1-->
<!--Row 2-->
<div class="row">
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Penanggung</h4>
<input type="text" class="form-control setpenanggung" id="setpenanggung" name="setpenanggung" value="<?php echo $namakeluarga_pasien_set; ?>">
</div>
<div class="col-sm-1 col-xl-1 m-b-30">
<h4 class="sub-title">&nbsp;</h4>
<button class="btn btn-primary setcopypenanggung" disabled>Copy</button>
</div>
<div class="col-sm-4 col-xl-4 m-b-30">
<h4 class="sub-title">RS. Rujukan</h4>
<select class="js-example-basic-single col-sm-12 selmstrujukan" id="selmstrujukan" name="selmstrujukan"></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Dr./Prwt. Perujuk</h4>
<input type="text" class="form-control">
</div>
</div>
<!--End Row 2-->
<!--Row 3-->
<div class="row">
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">&nbsp;</h4>
<div class="border-checkbox-section">
<div class="border-checkbox-group border-checkbox-group-primary">
<input class="border-checkbox" type="checkbox" id="checkbox1">
<label class="border-checkbox-label" for="checkbox1">Dibayar Tunai / Reimburse</label>
</div>
</div>
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">&nbsp;</h4>
<select class="js-example-basic-single col-sm-12 selmstcomp1" id="selmstcomp1" name="selmstcomp1"></select>
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Provider/TPA</h4>
<select class="js-example-basic-single col-sm-12 selmstcomp2" id="selmstcomp2" name="selmstcomp2"></select>
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Perusahaan</h4>
<select class="js-example-basic-single col-sm-12 selmstcomp3" id="selmstcomp3" name="selmstcomp3"></select>
</div>
</div>
<!--End Row 3-->
<!--Row 4-->
<div class="row">
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Nomor</h4>
<input type="text" class="form-control" value="<?php echo $nomorkartu_pasien_set; ?>" readonly>
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Nama</h4>
<input type="text" class="form-control" value="<?php echo $namakartu_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Asal Perusahaan</h4>
<input type="text" class="form-control" value="<?php echo $asalperusahaan_pasien_set; ?>" readonly>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Hub. Keluarga</h4>
<select class="js-example-basic-single col-sm-12 selmsthubkel" id="idhub" name="idhub"></select>
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">Rujukan</h4>
<input type="text" class="form-control">
</div>
</div>
<!--End Row 4-->
<!--Row 5-->
<div class="row">
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Dikonfirmasi Oleh</h4>
<input type="text" class="form-control">
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Tgl</h4>
<input type="date" class="form-control">
</div>
</div>
<!--End Row 5-->

</div>
</div>
<!--End Registrasi-->

</div>
</div>
<!--END REGISTRASI PASIEN LAMA-->

</div>
</div>
<!--end tab-->
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
</body>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/depofnc/fncdepo_2.js'); ?>></script>