<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<title>PENERIMAAN BARANG TANPA PO</title>
</head>


<body>
<?php $this->theme->wrapper_open('theme_default'); ?>
</div>


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
<a href="<?php echo base_url('./'); ?>"><i class="ti ti-home"></i></a>
</li>
<li class="breadcrumb-item">
<a href="<?php echo base_url('po/'); ?>">Form PO</a>
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
<h5>List tindakan</h5>
</div>
<div class="card-block">
<div class="dt-responsive table-responsive">
<table w-100 id="order-table" class="table w-100 table-striped table-bordered nowrap">
<thead>
 <tr>
<th>#</th>
<th>Nama tindakan</th>
<th>Group</th>
<th>Subgroup</th>
<th>Type</th>
<th>Tarif</th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($datalist as $dt){?>
<tr>
<td><?php echo $no++; ?></td>
<td><?php echo $dt->name; ?></td>
<td><?php echo $dt->grup; ?></td>
<td><?php echo $dt->subgrup; ?></td>
<td><?php echo $dt->type; ?></td>
<td><button type="button" class="btn btn-success waves-effect editset_tarif_tindakan" data-toggle="modal" data-target="#large-Modal_edt_1" data-set-id="<?php echo $dt->id_act; ?>" data-set-name="<?php echo $dt->name; ?>"><i class="ti ti-edit"></i></button></td>
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
<h4 class="modal-title" id="txtedt">INPUT TARIF</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="<?php echo base_url('mst_tindakan/editthistariftindakan/'); ?>" method="POST" id="formedit">
<div class="modal-body">
<div class="form-group row">
<div class="col-sm-3">
<label>Tindakan</label>
<input type="hidden" class="form-control row_0" id="id" name="id" readonly>
<input type="text" class="form-control row_1 edt_nama_tindakan" id="edt_nama_tindakan" name="edt_nama_tindakan" placeholder="Nama Tindakan" readonly>
</div>
<div class="col-sm-3">
<label>Group</label>
<input type="text" class="form-control row_2 edt_group" id="edt_group" name="edt_group" placeholder="Group" readonly>
</div>
<div class="col-sm-3">
<label>Sub Group</label>
<input type="text" class="form-control row_3 edt_subgroup" id="edt_subgroup" name="edt_subgroup" placeholder="Sub Group" readonly>
</div>
<div class="col-sm-3">
<label>Type</label>
<input type="text" class="form-control row_4 edt_type" id="edt_type" name="edt_type" placeholder="Type" readonly>
</div>
</div>

<div class="form-group row">
<div class="col-sm-6">
<div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">

<div class="form-group row">
    <label class="col-sm-4 col-form-label">Kelas</label>
    <div class="col-sm-8">
    <select class="form-control" id="kelas_tindakan" name="kelas_tindakan" required>
    <option value="" default>Pilih Kelas</option>
    <?php foreach($datalistkelas as $datakelas){ ?>
    <option value="<?php echo $datakelas->id_kelas; ?>"><?php echo $datakelas->name; ?></option>
    <?php } ?>
    </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Perusahaan</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="nama_perusahaan" class="form-control">
        <input type="hidden" id="id_perusahaan" name="id_perusahaan" readonly>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Harga</label>
    <div class="col-sm-8">
      <input id="harga_tindakan" name="harga_tindakan" class="form-control harga_tindakan fill autonumber">
    </div>
  </div>

<div class="form-group row" style="margin-top:10px;">
    <div class="col-sm-6 text-left">
    
  </div>
  <div class="col-sm-6 text-right">
    <button type="button" class="btn btn-danger" id="addrow_tarif"><i class="ti ti-plus"></i></button>
  </div>
</div>
</div>
</div>
<div class="col-sm-6">
<table w-100 class="table w-100 table-bordered table-hover table-striped table-responsive styled-table">
  <thead>
  <tr>
  <th scope="col">Kelas</th>
  <th scope="col">Perusahaan</th>
  <th scope="col">Harga</th>
  <th scope="col">Fungsi</th>
  </tr>
  </thead>
  <tbody id="condatabef"></tbody>
  <tbody id="contdatabefset"></tbody>
</table>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_tarif_tindakan_edit">Close</button>
<button type="button" class="btn btn-danger waves-effect waves-light" id="tarif_tindakan_edit">Edit</button>
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
