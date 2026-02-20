
    <!-- Main content -->
    <div class="row">
    	<div class="col-md-6">
        <div class="row">
          <div class="col-sm-12">
            <h5>List Template Racikan</h5>
          </div>
        </div>
        <div class="table-responsive" style="max-height:400px;border:#CCC thin solid;">
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
                <td><a href="#tab_eresep" onClick="javascript : load_pick_tpl_racikan_detail('<?php echo $racikan->id_tpl_racikan ?>');"><?php echo $racikan->nama_racikan ?></a></td>
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
      </div>
    
    	<div class="col-md-6">
    		<div id="div_tpl_rck_det" style="margin-top:20px;"></div>
      </div>
    </div>
    <!-- /.content -->

<script>
function load_pick_tpl_racikan_detail(id_tpl_racikan)
{
	$( "#div_tpl_rck_det" ).load( "<?php echo base_url('soap_eresep/inner_pick_tpl_racikan_detail/'); ?>" + id_tpl_racikan );
	$("#add_pick_racikan_to_resep").removeClass('hidden');
}
</script>