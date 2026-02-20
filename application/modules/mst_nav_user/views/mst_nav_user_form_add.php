
<!doctype html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?>
</head>

<?php $this->theme->wrapper_open('theme_default','Tambah/Edit Smart Login'); ?>

<div class="container-fluid">

    <!-- Main content -->



<h2 class="bg-primary text-center" style="border-radius:5px;"><?php echo $button ?> Smart_login</h2>
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
			<input type="text" class="form-control" name="login_pass" id="login_pass" placeholder="Login Pass" value="<?php echo $login_pass; ?>" />
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
			<input type="text" class="form-control" name="sip" id="sip" placeholder="Name" value="<?php echo $sip; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group">
    <label for="name" class="col-sm-4 control-label">STR</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="str" id="str" placeholder="STR" value="<?php echo $str; ?>" />
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
		
			<input type="hidden" name="login_name" value="<?php echo $login_name; ?>" />
			
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <button type="submit" class="btn btn-primary">Simpan</button>

      <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('smart_login'); ?>';">Kembali</button>
			
  	</div>
 	</div>
</form>






    <!-- /.content -->
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<script>
	
</script>
</body>
</html>
