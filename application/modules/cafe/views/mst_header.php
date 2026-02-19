<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/dshomecafe/dshome-cmp-css.php');?>
<title>Mastering Header</title>
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
<h5>Mastering Header</h5>
<span>Deskripsi</span>
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
<a href="<?php echo base_url('cafe/mst/mst_header/'); ?>">Form Header</a>
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
<h5>List Header</h5>
</div>
<div class="card-block">
<button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i>Header</button>
<hr>
<div class="dt-responsive table-responsive">
<table id="order-table" class="table table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>Nama Header</th>
<th>Data ID</th>
<th>Grup</th>
<th>Status</th>
<th><i class="fa fa-edit"></i></th>
<th><i class="fa fa-trash" style="color:red;"></i></th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($datalist as $dt){ if($dt->aktif==0){ $stat="Aktif"; $statcolor="color:green"; }elseif($dt->aktif==1){ $stat="Tidak Aktif"; $statcolor="color:red"; }else{ $stat="-"; $statcolor=""; }?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $dt->name; ?></td>
<td><?php echo $dt->data_id; ?></td>
<td><?php if($dt->grup_id==1){ echo "Minuman"; }elseif($dt->grup_id==2){ echo "Makanan"; }else{ echo "-";}; ?></td>
<td style="<?php echo $statcolor; ?>"><?php echo $stat; ?></td>
<td><button type="button" class="btn btn-warning waves-effect editset_header" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-id="<?php echo $dt->id; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="fa fa-edit"></i></button></td>
<?php if($dt->aktif==0){ ?>
<td><button type="button" class="btn btn-danger waves-effect delset_header" data-set-id="<?php echo $dt->id; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="fa fa-trash"></i></button></td>
<?php }else{ ?>
<td><button type="button" class="btn btn-success waves-effect atvset_header" data-set-id="<?php echo $dt->id; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="fa fa-check"></i></button></td>
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
<h4 class="modal-title">INPUT HEADER</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('cafe/mst/save_header/'); ?>" method="POST" id="form">
<div class="modal-body">
<div class="form-group row">
<div class="col-sm-4">
<label>Nama Header</label>
<input type="text" class="form-control" id="nama_header" name="nama_header" placeholder="Nama Header">
</div>
<div class="col-sm-4">
<label>Data ID</label>
<input type="text" class="form-control" id="data_id" name="data_id" placeholder="Data ID">
</div>
<div class="col-sm-4">
<label>Grup ID</label>
<select class="form-control" id="grup_id" name="grup_id">
<option value="0" selected disabled>Pilih Grup</option>
<option value="1">Minuman</option>
<option value="2">Makanan</option>
</select>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_header">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="sub_header">Simpan</button>
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
<h4 class="modal-title" id="txtedt">EDIT HEADER</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('cafe/mst/editthis_header'); ?>" method="POST" id="formedit">
<div class="modal-body">
<div class="form-group row">
<input type="text" class="form-control row_0" id="id" name="id" placeholder="ID" readonly hidden>
<div class="col-sm-4">
<label>Nama header</label>
<input type="text" class="form-control row_1 nama_header_edt" id="nama_header_edt" name="nama_header_edt" placeholder="Nama Header">
</div>
<div class="col-sm-4">
<label>Data ID</label>
<input type="text" class="form-control row_2 data_id_edt" id="data_id_edt" name="data_id_edt" placeholder="Data ID">
</div>
<div class="col-sm-4">
<label>Grup ID</label>
<select class="form-control row_3" id="grup_id_edt" name="grup_id_edt">
<option value="0" selected disabled>Pilih Grup</option>
<option value="1">Minuman</option>
<option value="2">Makanan</option>
</select>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit_header">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit_header">Edit</button>
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