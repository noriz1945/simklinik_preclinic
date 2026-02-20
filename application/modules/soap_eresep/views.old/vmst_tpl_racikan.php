<!doctype html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?>

<link href="<?php echo base_url(''); ?>assets/css/eresep.css" rel="stylesheet" type="text/css">
</head>

<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="container-fluid">
    <!-- Main content -->
    <div class="row">
    <div class="col-sm-12">
      <h5>List Template Racikan</h5>
    </div>
    </div>
    <div class="table-responsive" style="max-height:150px;height:150px;border:#CCC thin solid;">
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
            <tr>
              <td><a href="#" onClick="javascript : load_tpl_racikan_detail('<?php echo $racikan->id_tpl_racikan ?>');"><?php echo $racikan->nama_racikan ?></a></td>
              <td><?php echo $racikan->nama_dokter ?></td>
              <td><?php echo $racikan->note ?></td>
            </tr>
            <?php
              $no++;
              }
            ?>
          </tbody>
        </table>
      </div>
    <div class="col-sm-12 text-right">
    	<a href="<?php echo base_url('soap_eresep/mst_tpl_racikan_add'); ?>"><button type="button" class="btn btn-secondary" id="butt_simpan_resep">Buat Template Racikan Baru</button></a>
    </div>
    
    <div id="div_tpl_rck_det"></div>
    <!-- /.content -->
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<script>
function load_tpl_racikan_detail(id_tpl_racikan)
{
	$( "#div_tpl_rck_det" ).load( "<?php echo base_url('soap_eresep/inner_tpl_racikan_detail/'); ?>" + id_tpl_racikan );
}
	
</script>
</body>
</html>
