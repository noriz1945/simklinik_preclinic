<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/ribifnc/mnu-cmp-css.php');?>
<title>Rincian</title>
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
<h5>Rincian Biaya Pasien</h5>

<span>Rincian Biaya Pasien & Paket</span>
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
<a href="<?php echo base_url('rincian/'); ?>">Rincian</a>
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
<h5>Pencarian Pasien <small>Klik 2x pada row untuk lihat rincian</small></h5>
</div>
<div class="card-block tab-icon">
<div class="row">
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">ID Reg</h4>
<input type="text" class="form-control" id="search_id_reg" name="search_id_reg">
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">No. MR</h4>
<input type="text" class="form-control" id="search_id_pasien" name="search_id_pasien">
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Nama</h4>
<input type="text" class="form-control" id="search_nama_pasien" name="search_nama_pasien">
</div>
<div class="col-sm-3 col-xl-3 m-b-30">
<h4 class="sub-title">Tgl. Lahir</h4>
<input type="text" class="form-control" id="search_tgl_lahir" name="search_tgl_lahir">
</div>
<div class="col-sm-2 col-xl-2 m-b-30">
<h4 class="sub-title">&nbsp;</h4>
<button class="btn waves-effect waves-light btn-primary checkdata"><i class="fa fa-search"></i></button>
</div>
</div>

<div class="card-block contresdatapasien"></div>

</div>
</div>
</div>
</div>
<!--end search pasien-->
<!--tab-->
<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">
<h5>Rincian</h5>
</div>
<div class="card-block tab-icon">
 
<div class="row">
<div class="col-lg-12 col-xl-12">

<ul class="nav nav-tabs md-tabs " role="tablist">
<li class="nav-item">
<a class="nav-link active" data-toggle="tab" href="#rinciantab" role="tab"><i class="icofont icofont-home"></i>Rincian</a>
<div class="slide"></div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#listinvoice" role="tab" id="listinvoiceshow"><i class="icofont icofont-ui-user "></i>List Invoice</a>
<div class="slide"></div>
</li>
</ul>
<form method="GET" action="<?php echo base_url('rincian/'); ?>" id="transaksisetform">
    <input type="text" id="id_reg" name="id_reg" value="<?php echo $id_reg_set; ?>" readonly hidden>
    <!--<input type="text" id="id_pasien" name="id_pasien" value="<?php echo $idpasien_set; ?>" readonly hidden>-->
</form>
<div class="tab-content card-block">
<div class="tab-pane active" id="rinciantab" role="tabpanel">

<div class="row">

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h5>Proses Rincian</h5>
</div>
<div class="card-block">
<div class="row">
<?php if($iostatus_set==0 && $iostatus_set!= null){ ?>
<div class="col-lg-2">
<button class="btn waves-effect waves-light btn-primary checkdata_tind"><i class="fa fa-list"></i>Proses Biaya</button>
</div>
<div class="col-lg-2">
<button class="btn waves-effect waves-light btn-primary checkdata_pkt"><i class="fa fa-list"></i>Paket</button>
</div>
<?php }elseif($iostatus_set==1 && $iostatus_set!= null){ ?>
<div class="col-lg-4">
<div class="label-main">
<label class="label label-lg label-danger"><i class="fa fa-ban"></i>Sudah di proses lihat di tab list invoice</label>
</div>
</div>
<?php }else{ ?>
<!--nothing-->
<?php } ?>
</div>
</div>
<!--<form method="POST" action="<?php echo base_url('rincian/datasendtind'); ?>" id="rinciansetadd">-->
<input type="text" id="id_reg" name="id_reg" value="<?php echo $id_reg_set; ?>" readonly hidden>
<div class="col-sm-12 col-xl-12 m-b-30">
<div class="selvocher"></div>
<br>
<?php if($iostatus_set==0){ ?>
<div class="btnaktif"></div>
<?php }else{ ?>
<!--nothing-->
<?php } ?>
</div>
<!--</form>-->
</div>
</div>

<?php if($iostatus_set==0){ ?>
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h5>Detail Rincian</h5>
</div>
<div class="card-block">
<div class="detailrincian"></div>
</div>
</div>
</div>


<?php }else{ ?>
<!--nothing-->
<?php } ?>

</div>
</div>
<div class="tab-pane" id="listinvoice" role="tabpanel">
<div class="card-block listinvoicepasien"></div>
</div>
</div>
</div>
</div>

</div>
</div>

</div>
</div>
<!--end tab-->




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
<?php require_once(APPPATH.'../assets/app_hn/ribifnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/ribifnc/fncribi.js'); ?>></script>