<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<title>Mastering Jumlah / Satuan</title>
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
<h5>Mastering jumlah satuan</h5>
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
<a href="<?php echo base_url('mst_farmasi/mst_jumlahsatuan/'); ?>">Form jumlah satuan</a>
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
<h5>List jumlah satuan</h5>
</div>
<div class="card-block">
<button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="ti ti-plus"></i>jumlah satuan</button>
<div class="dt-responsive table-responsive">
<table w-100 id="order-table" class="table w-100 table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>Jumlah</th>
<th>Satuan</th>
<th>Status</th>
<th><i class="ti ti-edit"></i></th>
<th><i class="ti ti-trash" style="color:red;"></i></th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($datalist as $dt){ if($dt->status==1){ $stat="Aktif"; $statcolor="color:green"; }elseif($dt->status==0){ $stat="Tidak Aktif"; $statcolor="color:red"; }else{ $stat="-"; $statcolor=""; }?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $dt->amount; ?></td>
<td><?php echo $dt->satuan; ?></td>
<td style="<?php echo $statcolor; ?>"><?php echo $stat; ?></td>
<td><button type="button" class="btn btn-warning waves-effect editset_jumlahsatuan" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-id="<?php echo $dt->id_amt; ?>" data-set-name="<?php echo $dt->amount." ".$dt->satuan; ?>"><i class="ti ti-edit"></i></button></td>
<?php if($dt->status==1){ ?>
<td><button type="button" class="btn btn-danger waves-effect delset_jumlahsatuan" data-set-id="<?php echo $dt->id_amt; ?>" data-set-name="<?php echo $dt->amount." ".$dt->satuan; ?>"><i class="ti ti-trash"></i></button></td>
<?php }else{ ?>
<td><button type="button" class="btn btn-success waves-effect atvset_jumlahsatuan" data-set-id="<?php echo $dt->id_amt; ?>" data-set-name="<?php echo $dt->amount." ".$dt->satuan; ?>"><i class="fa fa-check"></i></button></td>
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
<h4 class="modal-title">INPUT jumlah satuan</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('mst_farmasi/save_jumlahsatuan/'); ?>" method="POST" id="form">
<div class="modal-body">
<div class="form-jumlahsatuan row">
<div class="col-sm-4">
<label>Jumlah</label>
<input type="text" class="form-control" id="nama_jumlahsatuan" name="nama_jumlahsatuan" placeholder="Nama jumlahsatuan">
</div>
<div class="col-sm-4">
<label>Satuan</label>
<select class="form-control" id="satuan_set" name="satuan_set" required>
<option value="" default>Pilih Satuan</option>
<?php foreach($datalistgroup as $datasatuan){ ?>
<option value="<?php echo $datasatuan->name; ?>"><?php echo $datasatuan->name; ?></option>
<?php } ?>
</select>
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_jumlahsatuan">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="sub_jumlahsatuan">Simpan</button>
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
<h4 class="modal-title" id="txtedt">EDIT jumlah satuan</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('mst_farmasi/editthis_jumlahsatuan/'); ?>" method="POST" id="formedit">
<div class="modal-body">
<div class="form-jumlahsatuan row">
<input type="text" class="form-control row_0" id="id" name="id" placeholder="ID" readonly hidden>
<div class="col-sm-4">
<label>Jumlah</label>
<input type="text" class="form-control row_1 nama_jumlahsatuan_edt" id="nama_jumlahsatuan_edt" name="nama_jumlahsatuan_edt" placeholder="Nama jumlahsatuan">
</div>
<div class="col-sm-4">
<label>Satuan</label>
<select id="set_satuan" name="set_satuan" class="form-control row_2 selmst_group"></select>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit_jumlahsatuan">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit_jumlahsatuan">Edit</button>
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
