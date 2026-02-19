
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
<h2 class="bg-primary text-center" style="border-radius:5px;">Soap_eresep</h2>
<form class="form-horizontal">

	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Eresepdate</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $eresepdate; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Id Reg</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $id_reg; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Id Dokter</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $id_dokter; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Id Type</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $id_type; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Id Kelas</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $id_kelas; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Total</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $total; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Id Ord</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $id_ord; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Racikan</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $racikan; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Cancel</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $cancel; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Canceldate</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $canceldate; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Created</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $created; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Creator</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $creator; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Updated</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $updated; ?></p>
    </div>
  </div>
	<!-- STATIC CONTROL -->
  <div class="form-group">
    <label class="col-sm-4 control-label">Updater</label>
    <div class="col-sm-8">
      <p class="form-control-static"><?php echo $updater; ?></p>
    </div>
  </div>
  
  <!-- BUTTON -->
  <!-- Standard button -->
  <div class="form-group">
  	<div class="col-sm-2 col-sm-offset-5">

      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <!--<button type="button" class="btn btn-primary">Simpan</button>-->

			<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('soap_eresep'); ?>';">Kembali</button>
      
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

