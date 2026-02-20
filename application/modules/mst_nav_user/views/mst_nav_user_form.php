<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<title>SIMKLINIK</title>
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
<i class="feather icon-book bg-c-blue"></i>
<div class="d-inline">
<h5>Master Data</h5>

<span>Menu</span>
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
<a href="<?php echo base_url('soap_menu/'); ?>">List Menu</a>
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
<div class="row">
<div class="col-sm-12">

<div class="card">

<div class="container-fluid">

    <!-- Main content -->



<h2 class="bg-primary text-center" style="border-radius:5px;">Buat / Edit User</h2>
<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">  

	<!-- RADIO -->
  <div class="form-group">
  	<label class="col-sm-4 control-label">Aktif</label>
    <div class="col-sm-8">
      {radio-aktif}
    </div>
  </div>
	
  <!-- TEXT -->
  <div class="form-group">
    <label for="login_name" class="col-sm-4 control-label">Username</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="login_name" id="login_name" placeholder="Login Name" value="<?php echo $login_name; ?>" />
    </div>
  </div>
  	
	<!-- TEXT -->
  <div class="form-group">
    <label for="login_pass" class="col-sm-4 control-label">Password</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="login_pass" id="login_pass" placeholder="Masukan password baru atau Khusus untuk edit kosongkan jika password tidak berubah" value="<?php echo $login_pass; ?>" />
    </div>
  </div>
  		
  <!-- TEXT -->
  <div class="form-group">
    <label for="name" class="col-sm-4 control-label">Nama Lengkap</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group">
    <label for="name" class="col-sm-4 control-label">SIP</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="sip_str" id="sip_str" placeholder="SIP" value="<?php echo $sip_str; ?>" />
    </div>
  </div>
	
  
	<!-- DROPDOWN -->
  <div class="form-group">
    <label for="id_dokter" class="col-sm-4 control-label">Id Dokter</label>
    <div class="col-sm-8">
      {dropdown-id_dokter}
    </div>
  </div>
		
	<!-- DROPDOWN -->
  <div class="form-group">
    <label for="id_role" class="col-sm-4 control-label">Id Role</label>
    <div class="col-sm-8">
      {dropdown-id_role}
    </div>
  </div>
	
		
  <!-- BUTTON -->
  <!-- Standard button -->
  <div class="form-group">
  	<div class="col-sm-4 col-sm-offset-4">
		
			<!--<input type="hidden" name="login_name" value="<?php echo $login_name; ?>" />-->
			
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <button type="submit" class="btn btn-primary">Simpan</button>

      <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_nav_user'); ?>';">Kembali</button>
			
  	</div>
 	</div>
</form>






    <!-- /.content -->
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
</body>
</html>
