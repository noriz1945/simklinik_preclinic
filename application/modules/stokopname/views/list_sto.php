<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-css.php');?>
<title>MASTERING STO</title>
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
<h5>Buat STO</h5>
<span>STO</span>
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
<a href="<?php echo base_url('stokopname/sto/'); ?>">Form STO</a>
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
<h5>List STO</h5>
</div>
<div class="card-block">

<div class="col-sm-12">
<div class="form-group row">
<div class="col-sm-2">
<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal" id="createsto"><i class="fa fa-plus"></i>STOK OPNAME</button>
</div>
<div class="col-sm-2">
<!--<button type="button" class="btn btn-warning waves-effect" id="refreshlist"><i class="fa fa-refresh"></i>Refresh</button>-->
<label><sup>*</sup><i>Tanggal berdasarkankan STODATE</i></label>
</div>
<div class="col-sm-3">

<input type="text" id="startdate_set" name="startdate_set" class="form-control" placeholder="Pilih Tanggal Mulai" value="<?php echo date('01-m-Y'); ?>">
</div>
<div class="col-sm-3">
<input type="text" id="enddate_set" name="enddate_set" class="form-control" placeholder="Pilih Tanggal Akhir" value="<?php echo date('t-m-Y'); ?>">
</div>
<div class="col-sm-2">
<button type="button" class="btn btn-success waves-effect" id="cari_data">Cari</button>
</div>
</div>
<div id="dataliststo"></div>
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
<h4 class="modal-title">BUAT STOKOPNAME</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="form">
<div class="form-group row">
<div class="col-sm-4">
<label>Gudang</label>
<select class="col-sm-12 form-control selmstgudangset" id="gudangsearch" name="gudangsearch"></select>
<input type="text" class="form-control" id="id_wrh" name="id_wrh" readonly hidden>
</div>
<div class="col-sm-4">
<label>ID STO</label>
<input type="text" class="form-control" id="no_sto_p_set" name="no_sto_p_set" readonly>
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
    <label class="col-sm-4 col-form-label">No Rak</label>
    <div class="col-sm-8">
      <div class="ui-widget">
      <select class="col-sm-12 form-control selmstrakset" id="raksearch" name="raksearch"></select>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Minimum</label>
    <div class="col-sm-8">
      <div class="ui-widget">
      <input type="text" id="min" name="min" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row" hidden>
    <label class="col-sm-4 col-form-label">Expired</label>
    <div class="col-sm-8">
      <div class="ui-widget">
      <input type="text" id="expired" name="expired" class="form-control">
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
  <th scope="col">Qty Last</th>
  <th scope="col">No Rak</th>
  <th scope="col">Min</th>
  <!--<th scope="col">Expired</th>-->
  <th scope="col">Hapus</th>
  </tr>
  </thead>
  <tbody class="contdata"></tbody>
</table>
</div>
</div>
<div class="form-group row">
<div class="col-sm-12" id="contdataobat">

</div>
</div>
<textarea id="set_catatan" name="set_catatan" class="form-control" placeholder="Catatan"></textarea>
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
<label>Gudang</label>
<input type="text" class="form-control row_2" id="edt_gudangsearch" name="edt_gudangsearch" placeholder="Nama Gudang" readonly>
<input type="text" class="form-control row_1" id="edt_id_wrh" name="edt_id_wrh" readonly hidden>
</div>
<div class="col-sm-4" hidden>
<label>Rak</label>
<input type="text" class="form-control row_5" readonly>
</div>
<div class="col-sm-4">
<label>ID STO</label>
<input type="text" class="form-control row_0" id="edt_no_sto_p_set" name="edt_no_sto_p_set" readonly>
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
    <label class="col-sm-4 col-form-label">No Rak</label>
    <div class="col-sm-8">
      <div class="ui-widget">
      <select class="col-sm-12 form-control selmstraksetedt" id="edt_raksearch" name="edt_raksearch"></select>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Minimum</label>
    <div class="col-sm-8">
      <div class="ui-widget">
      <input type="text" id="edt_min" name="edt_min" class="form-control">
      </div>
    </div>
  </div>
  <div class="form-group row" hidden>
    <label class="col-sm-4 col-form-label">Expired</label>
    <div class="col-sm-8">
      <div class="ui-widget">
      <input type="text" id="edt_expired" name="edt_expired" class="form-control">
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
  <th scope="col">Qty Last</th>
  <th scope="col">No Rak</th>
  <th scope="col">Min</th>
  <!--<th scope="col">Expired</th>-->
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
  <th scope="col">Qty Last</th>
  <th scope="col">No Rak</th>
  <th scope="col">Min</th>
  <!--<th scope="col">Expired</th>-->
  <th scope="col">Hapus</th>
  </tr>
  </thead>
  <tbody id="contdataobat2"></tbody>
</table>
</div>
</div>
<textarea id="edt_set_catatan" name="edt_set_catatan" class="form-control row_3" placeholder="Catatan"></textarea>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-danger waves-effect waves-light" id="cancel_sto_baru">Cancel Stok Opname</button>
<input type="text" id="startdate" name="startdate" class="" style="display: block;width: 30%;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: .25rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;" placeholder="Pilih Tanggal & Waktu">
<button type="button" class="btn btn-info waves-effect waves-light" id="start_sto">Start Stok Opname</button>
<button type="button" class="btn btn-danger waves-effect waves-light" id="edit">Edit</button>
<button type="button" class="btn btn-default waves-effect" id="del_edit">Close</button>
</div>
</div>
</div>
</div>
</div>
<!--end edit-->

<!--start-->
<div class="modal fade" id="large-Modal_edt_2" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="txtedt_startsto"></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="formedit_ststo">
<div class="form-group row">
<div class="col-sm-4">
<label>Gudang</label>
<input type="text" class="form-control row_2" id="ststo_gudangsearch" name="ststo_gudangsearch" placeholder="Nama Gudang" readonly>
<input type="text" class="form-control row_1" id="ststo_id_wrh" name="ststo_id_wrh" readonly hidden>
</div>
<div class="col-sm-4">
<label>ID STO</label>
<input type="text" class="form-control row_0" id="ststo_no_sto_p_set" name="ststo_no_sto_p_set" readonly>
</div>
<div class="col-sm-4">
<label>STO STARTDATE</label>
<input type="text" class="form-control row_3" id="ststo_sto_startdate" name="ststo_sto_startdate" readonly>
</div>
</div>
<div class="form-group row">
<div class="col-sm-12">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
  <thead>
  <tr>
  <th scope="col">#</th>
  <th scope="col">Obat</th>
  <!--<th scope="col">No Rak <code>Edit</code></th>-->
  <th scope="col">Qty Last</th>
  <th scope="col">Qty </th>
  <th scope="col">Update</th>
  <th scope="col">Updater</th>
  <th scope="col">Input Qty</th>
  </tr>
  </thead>
  <tbody id="contdataobat3_start"></tbody>
</table>
</div>
</div>
<textarea id="ststo_set_catatan" name="ststo_set_catatan" class="form-control row_4 edit_catatan_ststo" placeholder="Catatan"></textarea>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-danger waves-effect waves-light" id="cancel_sto">Cancel Stok Opname</button>
<input type="text" id="enddate" name="enddate" class="" style="display: block;width: 30%;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: .25rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;" placeholder="Pilih Tanggal & Waktu">
<button type="button" class="btn btn-success waves-effect waves-light" id="finish_sto">End Stok Opname</button>
<button type="button" class="btn btn-default waves-effect" id="del_edit_ststo">Close</button>
</div>
</div>
</div>
</div>
</div>
<!--end start-->

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
<input type="text" class="form-control row_0" id="endsto_no_sto_p_set" name="endsto_no_sto_p_set" readonly>
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
  <th scope="col">Qty </th>
  <th scope="col">Update</th>
  <th scope="col">Updater</th>
  </tr>
  </thead>
  <tbody id="contdataobat4_end"></tbody>
</table>
</div>
</div>

<textarea class="form-control row_5" placeholder="Catatan" readonly></textarea>
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
<script src=<?php echo base_url('assets/app_hn/stopopfnc/fncsto.js'); ?>></script>