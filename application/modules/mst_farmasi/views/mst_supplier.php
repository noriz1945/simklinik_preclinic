<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<title>Mastering Supplier</title>
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
<h5>Mastering Supplier</h5>
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
<a href="<?php echo base_url('mst_farmasi/mst_supplieralkes/'); ?>">Form Supplier</a>
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
<h5>List Supplier</h5>
</div>
<div class="card-block">
<button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="ti ti-plus"></i>Supplier</button>
<div class="dt-responsive table-responsive">
<table w-100 id="order-table" class="table w-100 table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>Nama Supplier</th>
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
<td><button type="button" class="btn btn-warning waves-effect editset_supplieralkes" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-id="<?php echo $dt->id_sup; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="ti ti-edit"></i></button></td>
<?php if($dt->aktif==1){ ?>
<td><button type="button" class="btn btn-danger waves-effect delset_supplieralkes" data-set-id="<?php echo $dt->id_sup; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="ti ti-trash"></i></button></td>
<?php }else{ ?>
<td><button type="button" class="btn btn-success waves-effect atvset_supplieralkes" data-set-id="<?php echo $dt->id_sup; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="fa fa-check"></i></button></td>
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
<h4 class="modal-title">INPUT SUPPLER</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('mst_farmasi/save_supplieralkes/'); ?>" method="POST" id="form">
<div class="modal-body">


<div class="form-group row">
<label class="col-sm-2 col-form-label">Nama Supplier</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="nama_supplieralkes" name="nama_supplieralkes" placeholder="Nama supplier">
</div>

<label class="col-sm-2 col-form-label">NPWP</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="npwp_supplieralkes" name="npwp_supplieralkes" placeholder="NPWP supplier">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Alamat</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="address_supplieralkes" name="address_supplieralkes" placeholder="Alamat supplier">
</div>

<label class="col-sm-2 col-form-label">Nama Rekening</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="acc_name_supplieralkes" name="acc_name_supplieralkes" placeholder="No Rekening supplier">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Telp</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="telp_supplieralkes" name="telp_supplieralkes" placeholder="Telp">
</div>

<label class="col-sm-2 col-form-label">Bank</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="acc_bank_supplieralkes" name="acc_bank_supplieralkes" placeholder="Bank">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Hp</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="hp_supplieralkes" name="hp_supplieralkes" placeholder="HP">
</div>

<label class="col-sm-2 col-form-label">Cabang Bank</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="acc_branch_supplieralkes" name="acc_branch_supplieralkes" placeholder="Cabang Bank">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Fax</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="fax_supplieralkes" name="fax_supplieralkes" placeholder="Fax">
</div>

<label class="col-sm-2 col-form-label">No Rekening</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="acc_no_supplieralkes" name="acc_no_supplieralkes" placeholder="No Rekening">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Sosial Media</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="contact_supplieralkes" name="contact_supplieralkes" placeholder="Sosial Media">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Email</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="email_supplieralkes" name="email_supplieralkes" placeholder="Email">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Kota</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="city_supplieralkes" name="city_supplieralkes" placeholder="Kota">
</div>
</div>


</div>


<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_supplieralkes">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="sub_supplieralkes">Simpan</button>
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
<h4 class="modal-title" id="txtedt">EDIT SUPPLIER</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('mst_farmasi/editthis_supplieralkes/'); ?>" method="POST" id="formedit">
<div class="modal-body">
<div class="form-group row">
<input type="text" class="form-control row_0" id="id" name="id" placeholder="ID" readonly hidden>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Nama Supplier</label>
<div class="col-sm-4">
<input type="text" class="form-control row_1 nama_supplieralkes_edt" id="nama_supplieralkes_edt" name="nama_supplieralkes_edt" placeholder="Nama supplier">
</div>

<label class="col-sm-2 col-form-label">NPWP</label>
<div class="col-sm-4">
<input type="text" class="form-control row_9" id="npwp_supplieralkes_edt" name="npwp_supplieralkes_edt" placeholder="NPWP supplier">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Alamat</label>
<div class="col-sm-4">
<input type="text" class="form-control row_2" id="address_supplieralkes_edt" name="address_supplieralkes_edt" placeholder="Alamat supplier">
</div>

<label class="col-sm-2 col-form-label">Nama Rekening</label>
<div class="col-sm-4">
<input type="text" class="form-control row_10" id="acc_name_supplieralkes_edt" name="acc_name_supplieralkes_edt" placeholder="No Rekening supplier">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Telp</label>
<div class="col-sm-4">
<input type="text" class="form-control row_3" id="telp_supplieralkes_edt" name="telp_supplieralkes_edt" placeholder="Telp">
</div>

<label class="col-sm-2 col-form-label">Bank</label>
<div class="col-sm-4">
<input type="text" class="form-control row_11" id="acc_bank_supplieralkes_edt" name="acc_bank_supplieralkes_edt" placeholder="Bank">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Hp</label>
<div class="col-sm-4">
<input type="text" class="form-control row_4" id="hp_supplieralkes_edt" name="hp_supplieralkes_edt" placeholder="HP">
</div>

<label class="col-sm-2 col-form-label">Cabang Bank</label>
<div class="col-sm-4">
<input type="text" class="form-control row_12" id="acc_branch_supplieralkes_edt" name="acc_branch_supplieralkes_edt" placeholder="Cabang Bank">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Fax</label>
<div class="col-sm-4">
<input type="text" class="form-control row_5" id="fax_supplieralkes_edt" name="fax_supplieralkes_edt" placeholder="Fax">
</div>

<label class="col-sm-2 col-form-label">No Rekening</label>
<div class="col-sm-4">
<input type="text" class="form-control row_13" id="acc_no_supplieralkes_edt" name="acc_no_supplieralkes_edt" placeholder="No Rekening">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Sosial Media</label>
<div class="col-sm-4">
<input type="text" class="form-control row_6" id="contact_supplieralkes_edt" name="contact_supplieralkes_edt" placeholder="Sosial Media">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Email</label>
<div class="col-sm-4">
<input type="text" class="form-control row_7" id="email_supplieralkes_edt" name="email_supplieralkes_edt" placeholder="Email">
</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label">Kota</label>
<div class="col-sm-4">
<input type="text" class="form-control row_8" id="city_supplieralkes_edt" name="city_supplieralkes_edt" placeholder="Kota">
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit_supplieralkes">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit_supplieralkes">Edit</button>
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
