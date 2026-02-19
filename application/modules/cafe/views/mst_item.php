<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/dshomecafe/dshome-cmp-css.php');?>
<title>Mastering item</title>
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
<i class="feather icon-book bg-c-red"></i>
<div class="d-inline">
<h5>Mastering item</h5>
<span>Deskripsi</span>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-header">
<a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-header">
<a href="<?php echo base_url('cafe/mst/mst_item/'); ?>">Form item</a>
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
<h5>List item</h5>
</div>
<div class="card-block">
<button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i>item</button>
<hr>
<div class="dt-responsive table-responsive">
<table id="order-table" class="table table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>Nama Produk</th>
<th>Grup</th>
<th>Harga</th>
<th>Keterangan</th>
<th>Status</th>
<th><i class="fa fa-edit"></i></th>
<th><i class="fa fa-trash" style="color:red;"></i></th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($datalist as $dt){ if($dt->aktif==0){ $stat="Aktif"; $statcolor="color:green"; }elseif($dt->aktif==1){ $stat="Tidak Aktif"; $statcolor="color:red"; }else{ $stat="-"; $statcolor=""; }?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $dt->nama_produk; ?></td>
<td><?php echo $dt->id_header; ?></td>
<td><?php echo number_format($dt->harga,0); ?></td>
<td><?php echo $dt->keterangan_produk; ?></td>
<td style="<?php echo $statcolor; ?>"><?php echo $stat; ?></td>
<td><button type="button" class="btn btn-warning waves-effect editset_item" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-id="<?php echo $dt->id; ?>" data-set-name="<?php echo $dt->nama_produk; ?>"><i class="fa fa-edit"></i></button></td>
<?php if($dt->aktif==0){ ?>
<td><button type="button" class="btn btn-danger waves-effect delset_item" data-set-id="<?php echo $dt->id; ?>" data-set-name="<?php echo $dt->nama_produk; ?>"><i class="fa fa-trash"></i></button></td>
<?php }else{ ?>
<td><button type="button" class="btn btn-success waves-effect atvset_item" data-set-id="<?php echo $dt->id; ?>" data-set-name="<?php echo $dt->nama_produk; ?>"><i class="fa fa-check"></i></button></td>
<?php } ?>
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
<h4 class="modal-title">INPUT item</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('cafe/mst/save_item/'); ?>" method="POST" id="form" novalidate enctype="multipart/form-data">
<div class="modal-body">
<div class="form-group row">
<div class="col-sm-4">
<label>Nama Produk</label>
<input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk">
</div>
<div class="col-sm-4">
<label>Grup</label>
<select class="form-control" id="id_header" name="id_header">
    <option value="0" selected disabled>Pilih Grup</option>
    <?php foreach($data_mst_header as $mst_header){ ?>
    <option value="<?php echo $mst_header->id; ?>"><?php echo $mst_header->name; ?></option>
    <?php } ?>
</select>
</div>
<div class="col-sm-4">
<label>Harga</label>
<input type="text" id="harga_produk" name="harga_produk" class="form-control">
</div>
<div class="col-sm-4">
<label>Keterangan</label>
<input type="text" id="keterangan_produk" name="keterangan_produk" class="form-control">
</div>
<div class="col-sm-4">
<label>Upload</label>
<input type="file" id="nama_file" name="nama_file" class="form-control">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_item">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="sub_item">Simpan</button>
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
<h4 class="modal-title" id="txtedt">EDIT item</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('cafe/mst/editthis_item'); ?>" method="POST" id="formedit" novalidate enctype="multipart/form-data">
<div class="modal-body">
<div class="form-group row">
<input type="text" class="form-control row_0" id="id" name="id" placeholder="ID" readonly hidden>
<div class="col-sm-4">
<label>Nama item</label>
<input type="text" class="form-control row_2 nama_produk_edt" id="nama_produk_edt" name="nama_produk_edt" placeholder="Nama item">
</div>
<div class="col-sm-4">
<label>Grup</label>
<select class="form-control row_1" id="id_header_edt" name="id_header_edt">
    <option value="0" selected disabled>Pilih Grup</option>
    <?php foreach($data_mst_header as $mst_header){ ?>
    <option value="<?php echo $mst_header->id; ?>"><?php echo $mst_header->name; ?></option>
    <?php } ?>
</select>
</div>
<div class="col-sm-4">
<label>Harga</label>
<input type="text" class="form-control row_4" id="harga_produk_edt" name="harga_produk_edt">
</div>
<div class="col-sm-4">
<label>Keterangan</label>
<input type="text" class="form-control row_3" id="keterangan_produk_edt" name="keterangan_produk_edt">
</div>
<div class="col-sm-4">
<label>Upload</label>
<input type="file" id="nama_file_edt" name="nama_file_edt" class="form-control">
</div>
<div class="col-sm-12">
<label>Gambar</label>
<div class="row_5"></div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit_item">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit_item">Edit</button>
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
<?php require_once(APPPATH.'../assets/app_hn/dshomecafe/dshome-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/dshomecafe/fncmst_cafe.js'); ?>></script>