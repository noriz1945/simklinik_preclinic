<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/farmasietiketfnc/mst-cmp-css.php');?>
<title>Etiket Farmasi</title>
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
<h5>Etiket Farmasi</h5>
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
<a href="<?php echo base_url('etiket_farmasi/etiket/'); ?>">Etiket Farmasi</a>
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
<h5>List Resep</h5>
</div>
<div class="card-block">
<div class="dt-responsive table-responsive">

<div class="row">

<div class="col-sm-2">	
<input class="form-control nama_pasien_search" type="text" id="nama_pasien_search" name="nama_pasien_search">
</div>

<div class="col-sm-2">
<select class="form-control bln" id="bln" name="bln">
<option selected="selected">Bulan</option>
<?php
$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$jlh_bln=count($bulan);
for($c=1; $c<$jlh_bln; $c++){
$strlenset = strlen($c);
if( $strlenset > 1 ){
    $val_bln = $c;
}else{
    $val_bln = "0".$c;
}
echo"<option value=$val_bln> $bulan[$c] </option>";
}
?>
</select>
</div>

<div class="col-sm-2">
<?php
$now=date('Y');
echo "<select class='form-control thn' id='thn' name='thn'";
echo "<option selected='selected'>Tahun</option>";
for ($a=2024;$a<=$now;$a++)
{
     echo "<option value='$a'>$a</option>";
}
echo "</select>";
?>
</div>

<div class="col-sm-1">
<button type="button" class="btn btn-success cariset"><i class="fa fa-search"></i></button>
</div>

</div>
<hr>
<table class="table table-striped table-bordered nowrap">
<thead>
<tr>
<th>#</th>
<th><i class="fa fa-print"></i></th>
<th>No Reg</th>
<th>No Resep</th>
<th>Nama</th>
<th>No RM</th>
<th>Tgl. Lahir</th>
<th>Dokter</th>
</tr>
</thead>
<tbody class="daftarpasien"></tbody>
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
<h4 class="modal-title">CETAK ETIKET</h4>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<table class="table table-striped table-bordered nowrap">
<thead>
<tr>
<th>#</th>
<th>Nama</th>
<th>Qty</th>
<th>Frq. Pemakaian</th>
<th>Jml. Satuan</th>
<th>Keterangan</th>
<th><i class="fa fa-print"></i> Etiket</th>
</tr>
</thead>
<tbody class="detaileresep"></tbody>
</table>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="del_supplieralkes" data-dismiss="modal" aria-label="Close" >Close</button>
</div>
</div>
</div>
</div>

</body>
<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/farmasietiketfnc/mst-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/farmasietiketfnc/fncmst_pt2.js'); ?>></script>



