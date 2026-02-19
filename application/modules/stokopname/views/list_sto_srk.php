<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-css.php');?>
<title>MASTERING RAK & MINIMUM</title>
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
<h5>MASTERING RAK & MINIMUM</h5>
<span>MASTERING RAK & MINIMUM</span>
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
<a href="<?php echo base_url('stokopname/sto_srk/'); ?>">Form MASTERING RAK & MINIMUM</a>
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
<h5>MASTERING RAK & MINIMUM</h5>
</div>
<div class="card-block">
<button type="button" class="btn btn-warning waves-effect" id="refreshlist"><i class="fa fa-refresh"></i>Refresh</button>
<div class="dt-responsive table-responsive">
<table id="order-table" class="table table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>GUDANG</th>
<th>Edit</th>
<!--<th><i class="fa fa-trash" style="color:red;"></i></th>-->
</tr>
</thead>
<tbody class="dataliststo_srk"></tbody>
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



<!--end sto-->
<div class="modal fade" id="large-Modal_edt_3_spv" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="txtedt_endsto_srk"></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="POST" id="formedit_endsto">
<div class="form-group row">
<div class="col-sm-4">
<button type="button" class="btn btn-default waves-effect" id="del_edit_endsto">Close</button>
<input type="text" class="form-control row_0" id="id_wrh" name="id_wrh" readonly hidden>
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
  <th scope="col">Min</th>
  <th scope="col">Input No Rak</th> 
  <th scope="col">Input MIN</th> 
  </tr>
  </thead>
  <tbody id="contdataobat4_end_srk"></tbody>
</table>
</div>
</div>
</form>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit_endsto_2">Close</button>
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
<script src=<?php echo base_url('assets/app_hn/stopopfnc/fncsto_srk.js'); ?>></script>