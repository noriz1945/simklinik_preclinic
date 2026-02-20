
<!doctype html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?>
</head>

<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="container-fluid">

    <!-- Main content -->



<h2 class="bg-primary text-center" style="border-radius:5px;"><?php echo $button ?> Soap_eresep</h2>
<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">  

	<!-- TEXT -->
  <div class="form-group row">
    <label for="eresepdate" class="col-sm-4 control-label">Eresepdate</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="eresepdate" id="eresepdate" placeholder="Eresepdate" value="<?php echo $eresepdate; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="id_reg" class="col-sm-4 control-label">Id Reg</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="id_reg" id="id_reg" placeholder="Id Reg" value="<?php echo $id_reg; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="id_dokter" class="col-sm-4 control-label">Id Dokter</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="id_dokter" id="id_dokter" placeholder="Id Dokter" value="<?php echo $id_dokter; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="id_type" class="col-sm-4 control-label">Id Type</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="id_type" id="id_type" placeholder="Id Type" value="<?php echo $id_type; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="id_kelas" class="col-sm-4 control-label">Id Kelas</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="id_kelas" id="id_kelas" placeholder="Id Kelas" value="<?php echo $id_kelas; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="total" class="col-sm-4 control-label">Total</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="id_ord" class="col-sm-4 control-label">Id Ord</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="id_ord" id="id_ord" placeholder="Id Ord" value="<?php echo $id_ord; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="racikan" class="col-sm-4 control-label">Racikan</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="racikan" id="racikan" placeholder="Racikan" value="<?php echo $racikan; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="cancel" class="col-sm-4 control-label">Cancel</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="cancel" id="cancel" placeholder="Cancel" value="<?php echo $cancel; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="canceldate" class="col-sm-4 control-label">Canceldate</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="canceldate" id="canceldate" placeholder="Canceldate" value="<?php echo $canceldate; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="created" class="col-sm-4 control-label">Created</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="created" id="created" placeholder="Created" value="<?php echo $created; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="creator" class="col-sm-4 control-label">Creator</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="creator" id="creator" placeholder="Creator" value="<?php echo $creator; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="updated" class="col-sm-4 control-label">Updated</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="updated" id="updated" placeholder="Updated" value="<?php echo $updated; ?>" />
    </div>
  </div>
	
	<!-- TEXT -->
  <div class="form-group row">
    <label for="updater" class="col-sm-4 control-label">Updater</label>
    <div class="col-sm-8">
			<input type="text" class="form-control" name="updater" id="updater" placeholder="Updater" value="<?php echo $updater; ?>" />
    </div>
  </div>
	
  <!-- BUTTON -->
  <!-- Standard button -->
  <div class="form-group row">
  	<div class="col-sm-4 col-sm-offset-4">
		
			<input type="hidden" name="id_eresep" value="<?php echo $id_eresep; ?>" />
			
      <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
      <button type="submit" class="btn btn-primary">Simpan</button>

      <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('soap_eresep'); ?>';">Kembali</button>
			
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
