<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-css.php');?>
<title>TRANSFER OBAT </title>
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
<h5>Transfer Obat</h5>
<span>Transfer</span>
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
<a href="<?php echo base_url('gdf/gdf/'); ?>">Form Transfer</a>
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
<h5>List Transfer Obat</h5>
</div>
<div class="card-block">

<div class="col-sm-12">
<div class="form-group row">
<div class="col-sm-1">
<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal" id="createtfo"><i class="fa fa-plus"></i>Transfer</button>
</div>
<div class="col-sm-2">
<button type="button" class="btn btn-warning waves-effect" id="refreshlist"><i class="fa fa-refresh"></i>Refresh</button>
</div>
<div class="col-sm-3">

<input type="text" id="startdate_set" name="startdate_set" class="form-control" placeholder="Pilih Tanggal Mulai" value="<?php echo DATE('01-m-Y'); ?>">
</div>
<div class="col-sm-3">
<input type="text" id="enddate_set" name="enddate_set" class="form-control" placeholder="Pilih Tanggal Akhir" value="<?php echo DATE('t-m-Y'); ?>">
</div>
<div class="col-sm-2">
<button type="button" class="btn btn-success waves-effect" id="cari_data">Cari</button>
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
<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">FORM TRANSFER OBAT</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="form">
<div class="form-group row">
<div class="col-sm-4">
<label>Tranfer ke gudang</label>
<input type="text" class="form-control" id="gudangsearch" name="gudangsearch" placeholder="Nama Gudang">
<input type="text" class="form-control" id="id_wrh" name="id_wrh" readonly hidden>
</div>
<div class="col-sm-4">
<label>ID TFO</label>
<input type="text" class="form-control" id="no_tfo_p_set" name="no_tfo_p_set" readonly>
</div>
</div>

<div class="form-group row">
<div class="col-sm-6">
<div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Obat</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="nama_obat" class="form-control">
        <input type="hidden" id="id_obat" name="id_obat" class="hidden" readonly>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Stok Gudang</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input type="text" id="qty_last" name="qty_last" class="form-control" readonly>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Stok Depo</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input type="text" id="qty_depo" name="qty_depo" class="form-control" readonly>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Qty</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input type="text" id="qty" name="qty" class="form-control">
      </div>
    </div>
  </div>
<div class="form-group row" style="margin-top:10px;">
    <div class="col-sm-6 text-left">
  </div>
  <div class="col-sm-6 text-right">
    <button type="button" class="btn btn-danger" id="addrow"><i class="fa fa-plus"></i></button>
  </div>
</div>
</div>
</div>
<div class="col-sm-6">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
  <thead>
  <tr>
  <th scope="col">Obat</th>
  <th scope="col">Stok Gudang</th>
  <th scope="col">Stok Depo</th>
  <th scope="col">Qty</th>
  <th scope="col">Hapus</th>
  </tr>
  </thead>
  <tbody id="contdata"></tbody>
</table>
</div>
</div>
<div class="form-group row">
<div class="col-sm-12" id="contdataobat">

</div>
</div>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del">Close</button>
<button type="button" class="btn btn-danger waves-effect waves-light" id="sub">Simpan</button>
</div>
</div>
</div>
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
<label>Tranfer ke gudang</label>
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
<div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Obat</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="edt_nama_obat" class="form-control">
        <input type="hidden" id="edt_id_obat" name="edt_id_obat" class="hidden" readonly>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Stok Gudang</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input type="text" id="edt_qty_last" name="edt_qty_last" class="form-control" readonly>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Stok Depo</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input type="text" id="edt_qty_depo" name="qty_depo" class="form-control" readonly>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Qty</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input type="text" id="edt_qty" name="edt_qty" class="form-control">
      </div>
    </div>
  </div>
<div class="form-group row" style="margin-top:10px;">
    <div class="col-sm-6 text-left">
  </div>
  <div class="col-sm-6 text-right">
    <button type="button" class="btn btn-danger" id="addrow2"><i class="fa fa-plus"></i></button>
  </div>
</div>
</div>
</div>
<div class="col-sm-6">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
<thead>
  <tr>
  <th scope="col">Obat</th>
  <th scope="col">Stok Gudang</th>
  <th scope="col">Stok Depo</th>
  <th scope="col">Qty</th>
  <th scope="col">Hapus</th>
  </tr>
  </thead>
  <tbody id="contdata2"></tbody>
</table>
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
  <th scope="col">Hapus</th>
  </tr>
  </thead>
  <tbody id="contdataobat2"></tbody>
</table>
</div>
</div>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-danger waves-effect waves-light" id="cancel_sto">Cancel Transfer Obat</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit">Edit</button>
<button type="button" class="btn btn-default waves-effect" id="del_edit">Close</button>
</div>
</div>
</div>
</div>
</div>
<!--end edit-->


<!--end sto-->
<div class="modal fade" id="large-Modal_edt_3" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="txtedt_endsto"></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="formedit_endsto">
<div class="form-group row">
<div class="col-sm-4">
<label>Gudang</label>
<input type="text" class="form-control row_2" id="endsto_gudangsearch" name="endsto_gudangsearch" placeholder="Nama Gudang" readonly>
<input type="text" class="form-control row_1" id="endsto_id_wrh" name="endsto_id_wrh" readonly hidden>
</div>
<div class="col-sm-4">
<label>ID STO</label>
<input type="text" class="form-control row_0" id="endsto_no_tfo_p_set" name="endsto_no_tfo_p_set" readonly>
</div>
<div class="col-sm-2">
<label>STO STARTDATE</label>
<input type="text" class="form-control row_3" id="endsto_sto_startdate" name="endsto_sto_startdate" readonly>
</div>
<div class="col-sm-2">
<label>STO ENDDATE</label>
<input type="text" class="form-control row_4" id="endsto_sto_enddate" name="endsto_sto_enddate" readonly>
</div>
</div>
<div class="form-group row">
<div class="col-sm-12">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
  <thead>
  <tr>
  <th scope="col">#</th>
  <th scope="col">Obat</th>
  <th scope="col">No Rak</th>
  <th scope="col">Qty Last</th>
  <th scope="col">Stok Depo</th>
  <th scope="col">Qty </th>
  <th scope="col">Update</th>
  <th scope="col">Updater</th>
  </tr>
  </thead>
  <tbody id="contdataobat4_end"></tbody>
</table>
</div>
</div>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit_endsto">Close</button>
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
<script src=<?php echo base_url('assets/app_hn/stopopfnc/fncsto_tf.js'); ?>></script>