<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/farmasifnc/mnu-cmp-css.php');?>
<title>FARMASI <?php echo $id_reg; ?></title>
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
<h5>FARMASI</h5>

<span>klik row nomor registrasi untuk melihat detail</span>
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
<a href="<?php echo base_url('farmasi/'); ?>">Farmasi</a>
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
<!--tab-->
<div class="row">
<div class="col-lg-12 col-xl-12">

    <input type="text" id="ideresepset" name="ideresepset" value="<?php echo $id_eresep; ?>" readonly hidden> 
    <input type="text" id="idregset" name="idregset" value="<?php echo $id_reg; ?>" readonly hidden> 
    <input type="text" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>" readonly hidden>


   <!-- <form method="post" action="<?php echo base_url('penjualan_obat/eresep/setpembyaranobat/'.$id_reg.'/'.$id_pasien); ?>">-->
  <input type="hidden" id="id_asmri" name="id_asmri" value="<?php echo $row['id_asmri']; ?>">
  <input type="hidden" id="sql_command" name="sql_command" value="<?php echo $sql_command; ?>">
  <input type="hidden" id="kategori" name="kategori" value="ASM">

    <div class="col-md-12">
      <div class="form-group" id="cont_penjualan_obat">
        <div class="col-sm-12 text-center">
          <h5>Loading page content, please wait...</h5>
          <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
        </div>
      </div>
    </div>
  </div>

  <!--<div class="col-md-12 text-center" style="margin-top:30px;">
    	<button type="submit" class="btn btn-success" style="font-size:22px"> <i class="fa fa-check"></i> S I M P A N </button>
    </div>
	</form>-->


</div>
</div>
<!--end tab-->



</div>
</div>
</div>


<div id="styleSelector">
</div>
</div>
</div>
</div>
</div>

</div>
</div>

</body>
<?php  ?>


<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/farmasifnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/farmasifnc/fncfarmasi.js'); ?>></script>