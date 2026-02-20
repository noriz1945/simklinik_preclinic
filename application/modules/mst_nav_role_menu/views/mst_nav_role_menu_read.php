
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
<h2 class="bg-primary text-center" style="border-radius:5px;">Soap_user_menu</h2>
<form class="form-horizontal">

	<!-- DROPDOWN -->
	<fieldset disabled>
  <div class="form-group">
    <label for="mli_id" class="col-sm-4 control-label">Id Menu</label>
    <div class="col-sm-8">
      {dropdown-id_menu}
    </div>
  </div>
	</fieldset>
		
	<!-- DROPDOWN -->
	<fieldset disabled>
  <div class="form-group">
    <label for="mli_id" class="col-sm-4 control-label">Id Role</label>
    <div class="col-sm-8">
      {dropdown-id_role}
    </div>
  </div>
	</fieldset>
		
  
  <!-- BUTTON -->
  <!-- Standard button -->
  <div class="form-group">
  	<div class="col-sm-2 col-sm-offset-5">

      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <!--<button type="button" class="btn btn-primary">Simpan</button>-->

			<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('soap_user_menu'); ?>';">Kembali</button>
      
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

