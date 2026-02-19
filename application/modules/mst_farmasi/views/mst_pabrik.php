<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<title>Mastering Pabrik</title>
</head>
<body>
<?php $this->theme->wrapper_open('theme_default'); ?>
</div>
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<i class="feather icon-book bg-c-red"></i>
<div class="d-inline">
<h5>Mastering Pabrik</h5>
<span>Deskripsi</span>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="<?php echo base_url('./'); ?>"><i class="ti ti-home"></i></a>
</li>
<li class="breadcrumb-item">
<a href="<?php echo base_url('mst_farmasi/mst_pabrikalkes/'); ?>">Form Pabrik</a>
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="page-wrapper">
<div class="page-body">
<div class="card">
<div class="card-header">
<h5>List Pabrik</h5>
</div>
<div class="card-block">
<button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="ti ti-plus"></i>Pabrik</button>
<div class="dt-responsive table-responsive">
<table w-100 id="order-table" class="table w-100 table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>Nama Pabrik</th>
<th>Status</th>
<th><i class="ti ti-edit"></i></th>
<th><i class="ti ti-trash" style="color:red;"></i></th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($datalist as $dt){ if($dt->aktif==1){ $stat="Aktif"; $statcolor="color:green"; }elseif($dt->aktif==0){ $stat="Tidak Aktif"; $statcolor="color:red"; }else{ $stat="-"; $statcolor=""; }?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $dt->name; ?></td>
<td style="<?php echo $statcolor; ?>"><?php echo $stat; ?></td>
<td><button type="button" class="btn btn-warning waves-effect editset_pabrikalkes" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-id="<?php echo $dt->id_pabrik; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="ti ti-edit"></i></button></td>
<?php if($dt->aktif==1){ ?>
<td><button type="button" class="btn btn-danger waves-effect delset_pabrikalkes" data-set-id="<?php echo $dt->id_pabrik; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="ti ti-trash"></i></button></td>
<?php }else{ ?>
<td><button type="button" class="btn btn-success waves-effect atvset_pabrikalkes" data-set-id="<?php echo $dt->id_pabrik; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="fa fa-check"></i></button></td>
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
</div>
<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">INPUT PABRIK</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('mst_farmasi/save_pabrikalkes/'); ?>" method="POST" id="form">
<div class="modal-body">


<div class="form-group row">
<label class="col-sm-2 col-form-label">Nama Pabrik</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="nama_pabrikalkes" name="nama_pabrikalkes" placeholder="Nama Pabrik">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Alamat</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="address_pabrikalkes" name="address_pabrikalkes" placeholder="Alamat Pabrik">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Telp</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="telp_pabrikalkes" name="telp_pabrikalkes" placeholder="Telp">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Hp</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="hp_pabrikalkes" name="hp_pabrikalkes" placeholder="HP">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Fax</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="fax_pabrikalkes" name="fax_pabrikalkes" placeholder="Fax">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Sosial Media</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="contact_pabrikalkes" name="contact_pabrikalkes" placeholder="Sosial Media">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Email</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="email_pabrikalkes" name="email_pabrikalkes" placeholder="Email">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Kota</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="city_pabrikalkes" name="city_pabrikalkes" placeholder="Kota">
</div>
</div>


</div>


<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_pabrikalkes">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="sub_pabrikalkes">Simpan</button>
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
<h4 class="modal-title" id="txtedt">EDIT PABRIK</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('mst_farmasi/editthis_pabrikalkes/'); ?>" method="POST" id="formedit">
<div class="modal-body">
<div class="form-group row">
<input type="text" class="form-control row_0" id="id" name="id" placeholder="ID" readonly hidden>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Nama Pabrik</label>
<div class="col-sm-10">
<input type="text" class="form-control row_1 nama_pabrikalkes_edt" id="nama_pabrikalkes_edt" name="nama_pabrikalkes_edt" placeholder="Nama Pabrik">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Alamat</label>
<div class="col-sm-10">
<input type="text" class="form-control row_2" id="address_pabrikalkes_edt" name="address_pabrikalkes_edt" placeholder="Alamat Pabrik">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Telp</label>
<div class="col-sm-10">
<input type="text" class="form-control row_3" id="telp_pabrikalkes_edt" name="telp_pabrikalkes_edt" placeholder="Telp">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Hp</label>
<div class="col-sm-10">
<input type="text" class="form-control row_4" id="hp_pabrikalkes_edt" name="hp_pabrikalkes_edt" placeholder="HP">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Fax</label>
<div class="col-sm-10">
<input type="text" class="form-control row_5" id="fax_pabrikalkes_edt" name="fax_pabrikalkes_edt" placeholder="Fax">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Sosial Media</label>
<div class="col-sm-10">
<input type="text" class="form-control row_6" id="contact_pabrikalkes_edt" name="contact_pabrikalkes_edt" placeholder="Sosial Media">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Email</label>
<div class="col-sm-10">
<input type="text" class="form-control row_7" id="email_pabrikalkes_edt" name="email_pabrikalkes_edt" placeholder="Email">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Kota</label>
<div class="col-sm-10">
<input type="text" class="form-control row_8" id="city_pabrikalkes_edt" name="city_pabrikalkes_edt" placeholder="Kota">
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit_pabrikalkes">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit_pabrikalkes">Edit</button>
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
