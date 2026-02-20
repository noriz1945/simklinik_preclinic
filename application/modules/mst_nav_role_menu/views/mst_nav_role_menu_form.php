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
<a href="<?php echo base_url('mst_nav_menu/'); ?>">List Menu</a>
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



<h2 class="bg-primary text-center" style="border-radius:5px;">Buat / Edit - Mapping Role Terhadap Menu</h2>
<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">  

	<!-- DROPDOWN -->
  <div class="form-group">
    <label for="id_role" class="col-sm-4 control-label">Role</label>
    <div class="col-sm-8">
      {dropdown-id_role}
    </div>
  </div>
	
	<!-- DROPDOWN -->
  <div class="form-group">
    <label for="id_menu" class="col-sm-4 control-label">Akses Menu Yang Diberikan</label>
    <div class="col-sm-8">
      {dropdown-id_menu}
    </div>
  </div>
		
	
		
  <!-- BUTTON -->
  <!-- Standard button -->
  <div class="form-group">
  	<div class="col-sm-4 col-sm-offset-4">
		
			<input type="hidden" name="id_usermenu" value="<?php echo $id_usermenu; ?>" />
			
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <button type="submit" class="btn btn-primary">Simpan</button>

      <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_nav_role_menu'); ?>';">Kembali</button>
			
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
