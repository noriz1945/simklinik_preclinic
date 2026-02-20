<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/pcrvfnc/mnu-cmp-css.php');?>
</head>


<body>
<?php $this->theme->wrapper_open('theme_default'); ?>
<div class="pcoded-content">

<div class="pcoded-inner-content">

<div class="main-body">
<div class="page-wrapper">

<div class="page-body">
<div class="row">

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h5>Surat Perintah Bayar</h5>
</div>
<div class="card-block">
<div class="row">
<div class="col-lg-2">
<button class="btn waves-effect waves-light btn-primary checkdata"><i class="fa fa-list"></i>Proses Biaya</button>
</div>
<div class="col-lg-2">
<button class="btn waves-effect waves-light btn-primary checkdata_pkt"><i class="fa fa-list"></i>Paket</button>
</div>
</div>
</div>
<form method="POST" action="<?php echo base_url('spb/datasendspb'); ?>">
<div class="col-sm-12 col-xl-12 m-b-30">
<div class="selvocher"></div>
<br>
<div class="btnaktif"></div>
</div>
</form>
</div>
</div>

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h5>Pencarian SP</h5>
</div>
<div class="card-block">
<div class="detailrincian"></div>
</div>
</div>
</div>

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h5 class="detailnosp">Detail Surat Perintah Bayar</h5>
</div>
<div class="card-block detailsp">
</div>
</div>
</div>

</div>



</div>
</div>

</div>

</div>

</body>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/pcrvfnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/pcrvfnc/fncpcrv.js'); ?>></script>
