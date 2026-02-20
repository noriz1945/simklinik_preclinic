<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>

  <link href="<?php echo base_url(''); ?>assets/css/eresep.css" rel="stylesheet" type="text/css">
</head>

<?php $this->theme->wrapper_open('theme_default', $breadcrumb); ?>

<div class="container-fluid">
  <!-- Main content -->
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-12">
          <h5>List Template Racikan</h5>
        </div>
      </div>
      <div class="table-responsive" style="max-height:65vh;border:#CCC thin solid;">
        <table class="table table-bordered table-hover table-striped table-responsive">
          <tbody>
            <tr>
              <th scope="col">Nama Template Racikan</th>
              <th scope="col">Dokter</th>
              <th scope="col">Note</th>
            </tr>
            <?php
                  $no = 1;
                  foreach ($rs as $racikan)
                  {
                ?>
            <tr id="tr_tpl_<?php echo $racikan->id_tpl_racikan ?>">
              <td><a href="#"
                  onClick="javascript : load_tpl_racikan_detail('<?php echo $racikan->id_tpl_racikan ?>');"><?php echo $racikan->nama_racikan ?></a>
              </td>
              <td><a href="#"
                  onClick="javascript : load_tpl_racikan_detail('<?php echo $racikan->id_tpl_racikan ?>');"><?php echo $racikan->nama_dokter ?></a></td>
              <td><a href="#"
                  onClick="javascript : load_tpl_racikan_detail('<?php echo $racikan->id_tpl_racikan ?>');"><?php echo $racikan->note ?></a></td>
            </tr>
            <?php
                  $no++;
                  }
                ?>
          </tbody>
        </table>
      </div>
      <div class="col-sm-12 text-right" style="padding-top:10px; padding-right:0;">
        <a href="<?php echo base_url('soap_eresep/mst_tpl_racikan_add'); ?>"><button type="button" class="btn btn-secondary"
            id="butt_simpan_resep">Buat Template Racikan Baru</button></a>
      </div>
    </div>
    <div class="col-md-6">
      <div id="div_tpl_rck_det"></div>
    </div>
  </div>
  <!-- /.content -->
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<script>

function load_tpl_racikan_detail(id_tpl_racikan) {
  $("#div_tpl_rck_det").load("<?php echo base_url('soap_eresep/inner_tpl_racikan_detail/'); ?>" + id_tpl_racikan);
}

function hapus_template_racikan_dari_master(id_tpl_racikan)
{
	if(!window.confirm('Hapus master template racikan ini ?')) return;
	
	var jqxhr = $.get("<?php echo base_url('soap_eresep/remove_mst_tpl_racikan/'); ?>" + id_tpl_racikan, function() {
		//alert( "success" );
	})
		.done(function() 
		{
			$('#tr_tpl_' + id_tpl_racikan).remove();
			$('#div_tpl_rck_det').empty();
			//alert( "second success" );
		})
}
</script>
</body>

</html>