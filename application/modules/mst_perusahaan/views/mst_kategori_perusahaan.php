<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<title>kategori perusahaan</title>
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
<h5>kategori perusahaan</h5>
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
<a href="<?php echo base_url('mst_perusahaan/mst_kategori_perusahaan/'); ?>">Form kategori perusahaan</a>
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
<h5>List kategori perusahaan</h5>
</div>
<div class="card-block">
<button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="ti ti-plus"></i>kategori perusahaan</button>
<div class="dt-responsive table-responsive">
<table w-100 id="order-table" class="table w-100 table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>Nama kategori perusahaan</th>
<th>Status</th>
<th><i class="ti ti-edit"></i></th>
<th><i class="ti ti-trash" style="color:red;"></i></th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($datalist as $dt){ if($dt->aktif==0){ $stat="Aktif"; $statcolor="color:green"; }elseif($dt->aktif==1){ $stat="Tidak Aktif"; $statcolor="color:red"; }else{ $stat="-"; $statcolor=""; }?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $dt->name; ?></td>
<td style="<?php echo $statcolor; ?>"><?php echo $stat; ?></td>
<td><button type="button" class="btn btn-warning waves-effect editset_kategori_perusahaan" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-id="<?php echo $dt->id_jenis; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="ti ti-edit"></i></button></td>
<?php if($dt->aktif==0){ ?>
<td><button type="button" class="btn btn-danger waves-effect delset_kategori_perusahaan" data-set-id="<?php echo $dt->id_jenis; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="ti ti-trash"></i></button></td>
<?php }else{ ?>
<td><button type="button" class="btn btn-success waves-effect atvset_kategori_perusahaan" data-set-id="<?php echo $dt->id_jenis; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="fa fa-check"></i></button></td>
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
<h4 class="modal-title">INPUT kategori perusahaan</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('mst_perusahaan/save_kategori_perusahaan/'); ?>" method="POST" id="form">
<div class="modal-body">
<div class="form-group row">
<div class="col-sm-4">
<label>Nama kategori</label>
<input type="text" class="form-control" id="nama_kategori_perusahaan" name="nama_kategori_perusahaan" placeholder="Nama kategori perusahaan">
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_kategori_perusahaan">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="sub_kategori_perusahaan">Simpan</button>
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
<h4 class="modal-title" id="txtedt">EDIT kategori perusahaan</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('mst_perusahaan/editthis_kategori_perusahaan/'); ?>" method="POST" id="formedit">
<div class="modal-body">
<div class="form-group row">
<input type="text" class="form-control row_0" id="id" name="id" placeholder="ID" readonly hidden>
<div class="col-sm-4">
<label>Nama kategori perusahaan</label>
<input type="text" class="form-control row_1 edt_nama_kategori_perusahaan" id="edt_nama_kategori_perusahaan" name="edt_nama_kategori_perusahaan" placeholder="Nama kategori perusahaan">
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_edit_kategori_perusahaan">Close</button>
<button type="button" class="btn btn-success waves-effect waves-light" id="edit_kategori_perusahaan">Edit</button>
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
