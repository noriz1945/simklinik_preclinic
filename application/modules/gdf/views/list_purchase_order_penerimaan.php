<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/stopopfnc/sto-cmp-css.php');?>
<title>PENERIMAAN BARANG DARI PO</title>
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
<h5>Penerimaan Barang Dari PO</h5>
<span>Penerimaan Barang Dari PO</span>
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
<a href="<?php echo base_url('gdf/gdf_purchase_order_penerimaan/'); ?>">Form Penerimaan Barang Dari PO </a>
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
<h5>List penerimaan Barang Dari PO </h5>
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
<div class="col-sm-3">
<label>Gudang</label>
<input type="text" class="form-control row_2" id="edt_gudangsearch" name="edt_gudangsearch" placeholder="Nama Gudang" readonly>
<input type="text" class="form-control row_1" id="edt_id_wrh" name="edt_id_wrh" readonly hidden>
</div>
<div class="col-sm-3">
<label>ID PO</label>
<input type="text" class="form-control row_0" id="edt_no_rpo_p_set" name="edt_no_rpo_p_set" readonly hidden>
<input type="text" class="form-control row_11" readonly>
</div>
<div class="col-sm-3">
<label>Pabrik</label>
<input type="text" class="form-control row_3" id="pabriksearch" name="pabriksearch" placeholder="Nama Pabrik" readonly>
<input type="text" class="form-control row_4" id="id_pabrik" name="id_pabrik" readonly hidden>
</div>
<div class="col-sm-3">
<label>Tanggal</label>
<input type="text" class="form-control tanggalpo row_5" id="tanggal_po" name="tanggal_po" placeholder="Tanggal" readonly>
</div>
</div>

<div class="form-group row">
<div class="col-sm-3">
<label>No. SPB</label>
<input type="text" class="form-control row_6" id="no_spb" name="no_spb" placeholder="No SPB">
</div>
<div class="col-sm-3">
<label>Tgl. SPB</label>
<input type="text" class="form-control tanggalspb row_7" id="tgl_spb" name="tgl_spb" placeholder="Tanggal SPB">
</div>
<div class="col-sm-3">
<label>No. Faktur</label>
<input type="text" class="form-control row_8" id="no_faktur" name="no_faktur" placeholder="No Faktur">
</div>
<div class="col-sm-3">
<label>Tgl. Faktur</label>
<input type="text" class="form-control tanggalfaktur row_9" id="tgl_faktur" name="tgl_faktur" placeholder="Tanggal Faktur">
</div>
</div>

<div class="form-group row">
<div class="col-sm-3">
<label>PBF</label>
<input type="text" class="form-control row_12" id="pbfsearch" name="pbfsearch" placeholder="Nama PBF">
<input type="text" class="form-control row_13" id="id_supp" name="id_supp" hidden readonly>
</div>
<div class="col-sm-3">
<label>No. Surat Jalan</label>
<input type="text" class="form-control row_10" id="no_surat_jalan" name="no_surat_jalan" placeholder="No Surat Jalan">
</div>
</div>

<div class="row">
 <!--left-->
    <!--tambah / input non racikan & racikan-->
    <div class="col-sm-12">
    <form method="POST" id="formobtnrck">
    <input type="hidden" id="ideresep" name="ideresep" value="<?php echo $id_eresep; ?>" class="hidden">
    <div class="card">
    <div class="card-header">
    <h5>Penerimaan Barang</h5>
    </div>
    <div class="card-block tab-icon">
    <div class="row">
    <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped table-responsive styled-table">
      <thead>
      <tr>
      <th scope="col">Obat</th>
      <th scope="col">Jumlah Permintaan</th>
      <th scope="col">Kemasan</th>
      <th scope="col">Jumlah Satuan</th>
      <th scope="col">Satuan</th>
      <th scope="col">Jumlah Diterima</th>
      <th scope="col">Sisa</th>
      <th scope="col">Diterima</th>
      <th scope="col">Validasi</th>
      </tr>
      </thead>
      <tbody id="tbody_draft_penerimaan_barang"></tbody>
    </table>
    </div>
    </div>

    </div>
    </div>
    </form>

    </div>
 <!--END left-->
<!--validasi list-->
<div class="col-sm-12">
<!--detail obat-->
<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-header">
<h5>Barang yang diterima</h5>
</div>
<div class="card-block tab-icon">
<div class="table-responsive">
<table class="table table-bordered table-responsive styled-table">
      <thead>
        <tr>
        <th scope="col">Obat</th>
        
        <th scope="col">Kemasan</th>
        <th scope="col">Jumlah Satuan</th>
        <th scope="col">Satuan</th>
       
        <th scope="col">Jumlah Permintaan</th>
        <th scope="col">Jumlah Diterima</th>
        <th scope="col">Jumlah Input</th>
        <th scope="col">Sisa</th>
        <th scope="col">Total Harga</th>
        <th scope="col">Cancel</th>
        </tr>
        </thead>
        <tbody id="tbody_draft_penerimaan_barang_cancel"></tbody>
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
<input type="text" id="inp_jum_subtotal" hidden>
<button type="button" class="btn waves-effect waves-light" id="jum_subtotal">Detail</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit_apv">Simpan Penerimaan Barang</button>
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
<script src=<?php echo base_url('assets/app_hn/stopopfnc/fncsto_purchase_order_penerimaan.js'); ?>></script>