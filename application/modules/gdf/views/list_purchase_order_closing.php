<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-css.php');?>
<title>CLOSING PO</title>
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
<h5>CLOSING PO</h5>
<span>CLOSING PO</span>
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
<a href="<?php echo base_url('gdf/Gdf_purchase_order_closing/'); ?>">Form CLOSING PO </a>
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
<h5>List CLOSING PO </h5>
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
<div class="col-sm-12">
<h5>List Penerimaan</h5>
<br>
<div class="table-responsive">
<table class="table table-bordered table-responsive styled-table">
      <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">No SPB</th>
        <th scope="col">Tanggal SPB</th>
        <th scope="col">No Faktur</th>
        <th scope="col">Tanggal Faktur</th>
        <th scope="col">No Surat Jalan</th>
        <th scope="col">Konfirmasi</th>
        </tr>
        </thead>
        <tbody id="tbody_draft_closing_list_penerimaan"></tbody>
</table>
</div>
</div>

<!--<div class="col-sm-7">
<h5>Detail</h5>
<br>
<div class="table-responsive">
<table class="table table-bordered table-responsive styled-table">
<tbody>
  <tr>
    <td>ID PO</td>
    <td> : </td>
    <td class="row_label_11"></td>

    <td>Supplier</td>
    <td> : </td>
    <td class="row_label_3"></td>

    <td>Tanggal</td>
    <td> : </td>
    <td class="row_label_5"></td>
  </tr>

  <tr>
    <td>No SPB</td>
    <td> : </td>
    <td class="row_label_6"></td>

    <td> Tgl. SPB</td>
    <td> : </td>
    <td class="row_label_7"></td>

    <td>No. Faktur</td>
    <td> : </td>
    <td class="row_label_8"></td>
  </tr>

  <tr>
    <td> Tgl. Faktur</td>
    <td> : </td>
    <td class="row_label_9"></td>

    <td>No. Surat Jalan</td>
    <td> : </td>
    <td class="row_label_10"></td>
  </tr>
</tbody>
</table>
</div>
</div>-->
</div>
<input type="text" class="form-control row_12" id="id_proses_penerimaan" name="id_proses_penerimaan" readonly hidden>
<div class="form-group row" hidden>
<div class="col-sm-3">
<label>ID PO</label>
<input type="text" class="form-control row_0" readonly hidden>
<input type="text" class="form-control row_11" id="id_por" name="id_por" readonly>
</div>
<div class="col-sm-3">
<label>Supplier</label>
<input type="text" class="form-control row_3" readonly>
<input type="text" class="form-control row_4" readonly hidden>
</div>
<div class="col-sm-3">
<label>Tanggal</label>
<input type="text" class="form-control tanggalpo row_5" readonly>
</div>
<div class="col-sm-3">
<label>No. SPB</label>
<input type="text" class="form-control row_6" readonly>
</div>
</div>

<div class="form-group row" hidden>
<div class="col-sm-3">
<label>Tgl. SPB</label>
<input type="text" class="form-control tanggalspb row_7" readonly>
</div>
<div class="col-sm-3">
<label>No. Faktur</label>
<input type="text" class="form-control row_8" readonly>
</div>
<div class="col-sm-3">
<label>Tgl. Faktur</label>
<input type="text" class="form-control tanggalfaktur row_9" readonly>
</div>
<div class="col-sm-3">
<label>No. Surat Jalan</label>
<input type="text" class="form-control row_10" readonly>
</div>
</div>


<div class="row">
<!--validasi list-->
<div class="col-sm-12">
<!--detail obat-->
<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Penerimaan Barang</h5>
</div>
<div class="card-block tab-icon">
<div class="table-responsive">
<table class="table table-bordered table-responsive styled-table">
      <thead>
        <tr>
        <th scope="col">Obat</th>
        <th scope="col">Jumlah Diterima</th>
        <th scope="col">Kemasan</th>
        <th scope="col">Jumlah Satuan</th>
        <th scope="col">Satuan</th>
        <th scope="col">Harga</th>
        <th scope="col">Jumlah</th>
        </tr>
        </thead>
        <tbody id="tbody_draft_closing"></tbody>
</table>
</div>
<div id="total"></div>
</div>
</div>
</div>
</div>
<!--end detail obat-->
</div>
<!--End validasi list-->
</div>




</form>
<div class="modal-footer">
<button type="button" class="btn waves-effect waves-light" id="jum_subtotal">Detail</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit_apv">Konfirmasi</button>
<button type="button" class="btn btn-default waves-effect" id="del_edit">Close</button>
</div>
</div>
</div>
</div>
</div>
<!--end edit-->

</body>
<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/stopopfnc/fncsto_purchase_order_closing.js'); ?>></script>