
<!doctype html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?>
</head>

<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="container-fluid">

    <!-- Main content -->
		
		
		
		
		
		
		
		<div class="container" style="margin-top:20px;">
<div class="col-md-6 col-md-offset-3 box-shadow--16dp">
<h2 class="bg-primary text-center" style="border-radius:5px;">Soap_menu</h2>
<form class="form-horizontal">

	<!-- RADIO -->
	<fieldset disabled>
  <div class="form-group">
  	<label class="col-sm-4 control-label">Aktif</label>
    <div class="col-sm-8">
      {radio-aktif}
    </div>
  </div>
	</fieldset>
		
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Icon</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $icon; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Menu</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $menu; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Urutan</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $urutan; ?></p>
    </div>
  </div>
  
  <!-- BUTTON -->
  <!-- Standard button -->
  <div class="form-group">
  	<div class="col-sm-2 col-sm-offset-5">

      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <!--<button type="button" class="btn btn-primary">Simpan</button>-->

			<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('soap_menu'); ?>';">Kembali</button>
      
  	</div>
 	</div>
</form>
</div>

</div>






    <!-- /.content -->
</div>


	
<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
</body>
</html>

