<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-css.php');?>
<title>DAFTAR STOK BARANG GUDANG</title>
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
<i class="feather icon-book bg-c-green"></i>
<div class="d-inline">
<h5>DAFTAR STOK BARANG GUDANG</h5>
<span>DAFTAR STOK BARANG GUDANG</span>
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
<a href="<?php echo base_url('gdf/gdf_kartu_stok/'); ?>">DAFTAR STOK BARANG GUDANG</a>
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
<div class="card">
<div class="card-header">
<h5>LIST DAFTAR STOK BARANG GUDANG </h5>
</div>
<div class="card-block">

<div class="col-sm-12">
<div class="form-group row">
<div class="col-sm-2">
<input type="text" class="form-control" id="gudangsearch" name="gudangsearch" placeholder="Nama Gudang">
<input type="text" class="form-control" id="id_wrh" name="id_wrh" readonly hidden>
</div>
<div class="col-sm-2">
<button type="button" class="btn btn-success waves-effect" id="cari_data">Cari</button>
</div>
</div>
<div id="datalistrpo"></div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="styleSelector">
</div>
</div>


</body>
<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/stopopfnc/fncsto_daftar_barang_gudang.js'); ?>></script>