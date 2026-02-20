<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/rumusharga/rumus-cmp-css.php');?>
<title>MASTERING RUMUS</title>
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
<h5>Buat Rumus</h5>

<span>Rumus</span>
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
<a href="<?php echo base_url('hargarumus/rumus/'); ?>">Form Rumus</a>
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
<h5>List Rumus</h5>
</div>
<div class="card-block">
<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i>Rumus</button>
<div class="dt-responsive table-responsive">
<table id="order-table" class="table table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>ID</th>
<th>Perusahaan</th>
<th>Rumus</th>
<th><i class="fa fa-edit"></i></th>
<!--<th><i class="fa fa-trash" style="color:red;"></i></th>-->
</tr>
</thead>
<tbody class="datalisthargarumus"></tbody>
</tfoot>
</table>
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
<h4 class="modal-title">INPUT RUMUS</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">
<form method="POST" id="form">
<div class="form-group row">
<div class="col-sm-4">
<label>Nama Perusahaan</label>
<input type="text" class="form-control" id="perusahaansearch" name="perusahaansearch" placeholder="Nama Perusahaan">
<input type="text" class="form-control" id="id_perusahaan" name="id_perusahaan" readonly hidden>
</div>
<div class="col-sm-4">
<label>ID Rumus Harga</label>
<input type="text" class="form-control" id="no_rumus_set" name="no_rumus_set" readonly>
</div>
</div>

  <div class="form-group row">
    <div class="col-sm-6">
    <label>Rumus</label>
      <textarea id="rumus" name="rumus" class="form-control" placeholder="rumus" rows="5" cols="5">
      A = H + (H*0.11);
      B = A + (A*0.3);
      C = (B/50) * 50;
      </textarea>
    </div>
  </div>


<div class="form-group row">
<div class="col-sm-6">
<div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">


  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Nama</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="nama_obat" class="form-control">
        <input type="hidden" id="id_obat" name="id_obat" class="hidden" readonly>
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
  <th scope="col">Nama</th>
  <th scope="col">Harga</th>
  <th scope="col">Hasil</th>
  <th scope="col">Fungsi</th>
  </tr>
  </thead>
  <tbody id="contdata"></tbody>
</table>
</div>
</div>

<div class="form-group row">
<div class="col-sm-12">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
  <thead>
  <tr>
  <th scope="col">#</th>
  <th scope="col">Perusahaan</th>
  <th scope="col">Obat</th>
  <th scope="col">Rumus</th>
  <th scope="col">Harga Dasar</th>
  <th scope="col">Harga Margin</th>
  <th scope="col">Hapus</th>
  </tr>
  </thead>
  <tbody id="contdataobat"></tbody>
</table>
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
<h4 class="modal-title" id="txtedt">EDIT RUMUS</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="formedit">
<div class="form-group row">
<div class="col-sm-4">
<label>Nama Perusahaan</label>
<input type="text" class="form-control row_2" id="edt_perusahaansearch" name="edt_perusahaansearch" placeholder="Nama Perusahaan" readonly>
<input type="text" class="form-control row_1" id="edt_id_perusahaan" name="edt_id_perusahaan" readonly hidden>
</div>
<div class="col-sm-4">
<label>ID Rumus Harga</label>
<input type="text" class="form-control row_0" id="edt_no_rumus_set" name="edt_no_rumus_set" readonly>
</div>
</div>

  <div class="form-group row">
    <div class="col-sm-6">
    <label>Rumus</label>
      <textarea id="edt_rumus" name="edt_rumus" class="form-control" placeholder="rumus" rows="5" cols="5">
      A = H + (H*0.11);
      B = A + (A*0.3);
      C = (B/50) * 50;
      </textarea>
    </div>
  </div>


<div class="form-group row">
<div class="col-sm-6">
<div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">


  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Nama</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="edt_nama_obat" class="form-control">
        <input type="hidden" id="edt_id_obat" name="edt_id_obat" class="hidden" readonly>
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
  <th scope="col">Nama</th>
  <th scope="col">Harga</th>
  <th scope="col">Hasil</th>
  <th scope="col">Fungsi</th>
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
  <th scope="col">Perusahaan</th>
  <th scope="col">Obat</th>
  <th scope="col">Rumus</th>
  <th scope="col">Harga Dasar</th>
  <th scope="col">Harga Margin</th>
  <th scope="col">Hapus</th>
  </tr>
  </thead>
  <tbody id="contdataobat2"></tbody>
</table>
</div>
</div>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit">Close</button>
<button type="button" class="btn btn-danger waves-effect waves-light" id="edit">Edit</button>
</div>
</div>
</div>
</div>
</div>
<!--end edit-->

</body>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/rumusharga/rumus-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/rumusharga/fncrumus.js'); ?>></script>