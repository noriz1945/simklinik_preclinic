<!DOCTYPE html>

<html lang="en">



<head>
<?php $this->theme->head('theme_default'); ?>
<title>Mastering Markup</title>
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
<h5>Mastering Markup</h5>
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
<a href="<?php echo base_url('mst_umum/mst_setting_param_harga/'); ?>">Form Markup</a>
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
<h5>Parameter Harga</h5>
</div>
<div class="card-block">
<div class="dt-responsive table-responsive">
<table w-100 id="order-table" class="table w-100 table-striped table-bordered nowrap">
<thead>
 <tr>
<th>PPN</th>
<th>MARGIN</th>
<th>TUSLAH</th>
<th>JASA RACIK</th>
<th><i class="ti ti-edit"></i></th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($datalist as $dt){ ?>
<tr>
<td><?php echo $dt->ppn; ?></td>
<td><?php echo $dt->margin; ?></td>
<td><?php echo $dt->tuslah; ?></td>
<td><?php echo $dt->jasa_racik; ?></td>
<td><button type="button" class="btn btn-warning waves-effect editset_markup" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-id="<?php echo $dt->id; ?>"><i class="ti ti-edit"></i></button></td>
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

<!--edit-->
<div class="modal fade" id="large-Modal_edt_1" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="txtedt">EDIT MARKUP</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>

<form action="<?php echo base_url('mst_umum/editthis_markup/'); ?>" method="POST" id="formedit">
<div class="modal-body">
<div class="form-group row">
<input type="text" class="form-control row_0" id="id" name="id" placeholder="ID" readonly hidden>
<div class="col-sm-2">
<label>PPN</label>
<input type="text" class="form-control row_1 ppn_edt" id="ppn_edt" name="ppn_edt" placeholder="PPN %">
</div>
<div class="col-sm-2">
<label>MARGIN</label>
<input type="text" class="form-control row_2 margin_edt" id="margin_edt" name="margin_edt" placeholder="MARGIN">
</div>
<div class="col-sm-2">
<label>TUSLAH</label>
<input type="text" class="form-control row_3 tuslah_edt" id="tuslah_edt" name="tuslah_edt" placeholder="TUSLAH">
</div>
<div class="col-sm-2">
<label>JASA RACIK</label>
<input type="text" class="form-control row_4 jasa_racik_edt" id="jasa_racik_edt" name="jasa_racik_edt" placeholder="JASA RACIK">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit_markup">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit_markup">Edit</button>
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
