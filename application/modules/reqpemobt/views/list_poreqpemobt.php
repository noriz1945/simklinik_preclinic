<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/reqpemobtfnc/mnu-cmp-css.php');?>
<title>PENERIMAAN BARANG TANPA PO</title>
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
<h5>Buat PO</h5>

<span>PO</span>
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
<a href="<?php echo base_url('po/'); ?>">Form PO</a>
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
<h5>List PO</h5>
</div>
<div class="card-block">
<button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i>PO</button>
<div class="dt-responsive table-responsive">
<table id="order-table" class="table table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>No PO</th>
<th>Tgl PO</th>
<th>Supplier</th>
<th><i class="fa fa-edit"></i></th>
<th><i class="fa fa-trash" style="color:red;"></i></th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($datalist as $dt){ ?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $dt->no_po; ?></td>
<td><?php echo $dt->tanggal; ?></td>
<td><?php echo $dt->pbf; ?></td>
<td><button type="button" class="btn btn-warning waves-effect editset" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-nopo="<?php echo $dt->no_po; ?>"><i class="fa fa-edit"></i></button></td>
<td><button type="button" class="btn btn-danger waves-effect delset" data-set-nopo="<?php echo $dt->no_po; ?>"><i class="fa fa-trash"></i></button></td>
</tr>
<?php } ?>
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
<h4 class="modal-title">INPUT PENERIMAAN BARANG TANPA PO</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('wioutpo/po/save/'); ?>" method="POST" id="form">
<div class="modal-body">
<div class="form-group row">
<div class="col-sm-4">
<label>Nama Supplier</label>
<input type="text" class="form-control" id="suppliersearch" name="suppliersearch" placeholder="Nama Supplier">
<input type="text" class="form-control" id="id_supplier" name="id_supplier" readonly hidden>
</div>
<div class="col-sm-4">
<label>Nomor Telp</label>
<input type="text" class="form-control" id="no_telp" placeholder="Nomor Telp" readonly>
</div>
<div class="col-sm-4">
<label>Tanggal Order</label>
<input type="text" class="form-control" id="tgl_order" name="tgl_order" placeholder="Tanggal Order">
</div>
</div>

<div class="form-group row">
<div class="col-sm-4">
<label>Tgl. Faktur</label>
<input type="text" class="form-control" id="tgl_faktur" name="tgl_faktur" placeholder="Tanggal Faktur">
</div>
<div class="col-sm-4">
<label>Nomor Faktur</label>
<input type="text" class="form-control" id="no_fak" name="no_fak" placeholder="Nomor Faktur" >
</div>
<div class="col-sm-4">
<label>Nomor Surat Jalan</label>
<input type="text" class="form-control" id="no_sujan" name="no_sujan" placeholder="Nomor Surat Jalan" >
</div>
</div>

  <div class="form-group row">
    <div class="col-sm-12">
    <label>Keterangan</label>
      <textarea id="keterangan" name="keterangan" class="form-control" placeholder="keterangan"></textarea>
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

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Qty</label>
    <div class="col-sm-8">
      <input id="jumlah_order" name="jumlah_order" class="form-control autonumber fill" data-reverse>
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
  <th scope="col">Qty</th>
  <th scope="col">Kemasan</th>
  <th scope="col">Qty Sat</th>
  <th scope="col">Satuan</th>
  <th scope="col">Fungsi</th>
  </tr>
  </thead>
  <tbody id="contdata"></tbody>
</table>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del">Close</button>
<button type="button" class="btn btn-danger waves-effect waves-light" id="sub">Simpan</button>
</div>
</div>
</form>
</div>
</div>
</div>

<!--edit-->
<div class="modal fade" id="large-Modal_edt_1" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="txtedt">EDIT PO</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('po/editthis/'); ?>" method="POST" id="formedit">
<div class="modal-body">
<div class="form-group row">
<div class="col-sm-4">
<label>Nama Supplier</label>
<input type="hidden" class="form-control row_0" id="no_po2" name="no_po" placeholder="No po" readonly>
<input type="text" class="form-control row_1 suppliersearch_edt" id="suppliersearch" name="suppliersearch" placeholder="Nama Supplier">
<input type="hidden" class="form-control row_2" id="id_supplier2" name="id_supplier" readonly>
</div>
<div class="col-sm-4">
<label>Nomor Telp</label>
<input type="text" class="form-control row_3 no_telp_edt" id="no_telp2" placeholder="No Telp" readonly>
</div>
<div class="col-sm-4">
<label>Tanggal Order</label>
<input type="text" class="form-control row_4 tgl_order_edt" id="tgl_order2" name="tgl_order" placeholder="Tanggal Order">
</div>
</div>

<div class="form-group row">
<div class="col-sm-4">
<label>Tgl. Faktur</label>
<input type="text" class="form-control row_5" id="tgl_faktur_edt" name="tgl_faktur_edt" placeholder="Tanggal Faktur">
</div>
<div class="col-sm-4">
<label>Nomor Faktur</label>
<input type="text" class="form-control row_6" id="no_fak_edt" name="no_fak_edt" placeholder="Nomor Faktur" >
</div>
<div class="col-sm-4">
<label>Nomor Surat Jalan</label>
<input type="text" class="form-control row_7" id="no_sujan_edt" name="no_sujan_edt" placeholder="Nomor Surat Jalan" >
</div>
</div>

  <div class="form-group row">
    <div class="col-sm-12">
    <label>Keterangan</label>
      <textarea id="keterangan2" name="keterangan" class="form-control row_8" placeholder="keterangan"></textarea>
    </div>
  </div>


<div class="form-group row">
<div class="col-sm-6">
<div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">


  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Nama Bahan</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="nama_obat2" class="form-control">
        <input type="hidden" id="id_obat2" name="id_obat" class="hidden" readonly>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Jumlah di olah(Kg)</label>
    <div class="col-sm-8">
      <input id="jumlah_order2" name="jumlah_order" class="form-control jumlah_order2 autonumber fill">
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
  <th scope="col">Qty</th>
  <th scope="col">Kemasan</th>
  <th scope="col">Qty Sat</th>
  <th scope="col">Satuan</th>
  <th scope="col">Fungsi</th>
  </tr>
  </thead>
  <tbody id="condatabef2"></tbody>
  <tbody id="contdatabefset"></tbody>
</table>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit">Close</button>
<button type="button" class="btn btn-danger waves-effect waves-light" id="edit">Edit</button>
</div>
</div>
</form>
</div>
</div>
</div>
<!--end edit-->

</body>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/reqpemobtfnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/reqpemobtfnc/fncpo.js'); ?>></script>