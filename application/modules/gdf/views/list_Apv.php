<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-css.php');?>
<title>APPROVAL TRANSFER OBAT </title>
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
<h5>Approval Transfer Obat</h5>
<span>Approval Transfer</span>
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
<a href="<?php echo base_url('gdf/gdf_apv/'); ?>">Form Approval Transfer</a>
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
<h5>List Approval Transfer Obat</h5>
</div>
<div class="card-block">

<div class="col-sm-12">
<div class="form-group row">
<div class="col-sm-3">

<input type="text" id="startdate_set" name="startdate_set" class="form-control" placeholder="Pilih Tanggal Mulai" value="<?php echo DATE('01-m-Y'); ?>">
</div>
<div class="col-sm-3">
<input type="text" id="enddate_set" name="enddate_set" class="form-control" placeholder="Pilih Tanggal Akhir" value="<?php echo DATE('t-m-Y'); ?>">
</div>
<div class="col-sm-1">
<button type="button" class="btn btn-success waves-effect" id="cari_data">Cari</button>
</div>
<div class="col-sm-2">
<button type="button" class="btn btn-warning waves-effect" id="refreshlist"><i class="fa fa-refresh"></i>Refresh</button>
</div>
</div>
<div id="datalisttfo"></div>
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
<!--edit-->
<div class="modal fade" id="large-Modal_edt_1" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="txtedt"></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="formedit">
<div class="form-group row">
<div class="col-sm-4">
<label>Transfer ke gudang</label>
<input type="text" class="form-control row_2" id="edt_gudangsearch" name="edt_gudangsearch" placeholder="Nama Gudang" readonly>
<input type="text" class="form-control row_1" id="edt_id_wrh" name="edt_id_wrh" readonly hidden>
</div>
<div class="col-sm-4">
<label>ID TFO</label>
<input type="text" class="form-control row_0" id="edt_no_tfo_p_set" name="edt_no_tfo_p_set" readonly>
</div>
</div>

<div class="form-group row">
<div class="col-sm-6">
</div>
</div>
<div class="form-group row">
<div class="col-sm-12">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
  <thead>
  <tr>
  <th scope="col">#</th>
  <th scope="col">Obat</th>
  <th scope="col">Stok Gudang</th>
  <th scope="col">Stok Depo</th>
  <th scope="col">Qty</th>
  <th scope="col">Qty Approve</th>
  <th scope="col">Hapus</th>
  </tr>
  </thead>
  <tbody id="contdataobat2"></tbody>
</table>
</div>
</div>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-success waves-effect waves-light" id="edit">Close Transfer Obat</button>
<button type="button" class="btn btn-default waves-effect" id="del_edit">Close</button>
</div>
</div>
</div>
</div>
</div>
<!--end edit-->


<!--end sto-->
<div class="modal fade" id="large-Modal_edt_2" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="txtedt2"></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="formedit">
<div class="form-group row">
<div class="col-sm-4">
<label>Transfer ke gudang</label>
<input type="text" class="form-control row_2" readonly>
<input type="text" class="form-control row_1" hidden>
</div>
<div class="col-sm-4">
<label>ID TFO</label>
<input type="text" class="form-control row_0" readonly>
</div>
</div>

<div class="form-group row">
<div class="col-sm-6">
</div>
</div>
<div class="form-group row">
<div class="col-sm-12">
<code><h5 id="txt_btf"></h5></code>
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
  <thead>
  <tr>
  <th scope="col">#</th>
  <th scope="col">Obat</th>
  <th scope="col">Stok Gudang</th>
  <th scope="col">Stok Depo</th>
  <th scope="col">Qty Approve</th>
  <th scope="col">Qty Batas Pengembalian</th>
  <th scope="col" id="set_field_btf" style='display: none;'>Jumlah Batal Transfer</th>
  </tr>
  </thead>
  <tbody id="contdataobat4"></tbody>
</table>
</div>
</div>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit2">Close</button>
</div>
</div>
</div>
</div>
</div>
<!--end sto-->
</body>
<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/stopopfnc/fncsto_apv.js'); ?>></script>