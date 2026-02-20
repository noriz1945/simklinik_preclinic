<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/soapfnc/mnu-cmp-css.php');?>
<title>SOAP</title>
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
<i class="feather icon-feather bg-c-blue"></i>
<div class="d-inline">
<h5>SOAP</h5>

<span>klik row nomor registrasi untuk melihat soap pasien</span>
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
<a href="<?php echo base_url('soap/'); ?>">SOAP</a>
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
<!--search pasien-->
<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">
<h5>Pencarian Pasien</h5>
</div>
<div class="card-block tab-icon">
<div class="row">
<div class="table-responsive">
<table class="table table-hover m-b-0">
<thead>
<tr>
    <th>#</th>
    <th>ID Reg</th>
    <th>NO. Rm</th>
    <th>Nama</th>
    <th>Tanggal Reg</th>
</tr>
</thead>
<tbody>
<?php $no_1 =1; 
foreach($datapasien as $v_2){  ?> 
<tr>
<td><?php echo $no_1++; ?></td>
<td style="color:black;font-weight: 900;"><a href="<?php echo base_url('soap/rm/'.$v_2->id_reg); ?>" target="_BLANK"><?php echo $v_2->id_reg; ?></a></td>
<td><?php echo $v_2->id_pasien; ?></td>
<td><?php echo $v_2->nama_pasien; ?></td>
<td><?php echo $v_2->regdate; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>

</div>
</div>
</div>
</div>
<!--end search pasien-->
</div>

</div>
</div>
</div>
</div>


<div id="styleSelector">
</div>
</div>
</div>
</div>
</div>


</body>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/soapfnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/soapfnc/fncsoap_list.js'); ?>></script>