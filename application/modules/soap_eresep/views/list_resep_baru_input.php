
<link href="<?php echo base_url(''); ?>assets/css/eresep.css" rel="stylesheet" type="text/css">
<div style="min-height:900px;" id="tab_eresep">
  <div class="col-md-12 box-shadow--16dp" style="margin-top:30px;">
        <h5>Resep baru :</h5>        
        <div class="table-responsive" style="max-height:150px;height:150px; border:#CCC thin solid;">
        	<table class="table table-bordered table-hover table-striped table-responsive">
        <tbody>
          <tr>
            <th scope="col">Obat</th>
            <th scope="col">Jenis</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Dosis</th>
            <th scope="col">Frekwensi</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">Keterangan</th>
          </tr>
          <?php
          foreach($rs_eresep_det as $k => $v)
          {
          ?>
          <tr>
            <td><?php echo $v['name'] ?></td>
            <td><?php echo $v['jenis_obat'] ?></td>
            <td><?php echo $v['qty'] ?></td>
            <td><?php echo $v['dosis'] ?></td>
            <td><?php echo $v['frekwensi'] ?></td>
            <td><?php echo $v['tme']; ?></td>
            <td><?php echo $v['note'] ?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
      </div>    
  </div>
</div>		
<script>
function load_add_new(id_reg)
{
	$( "#tab_eresep" ).load( "<?php echo base_url('soap_eresep/add_new/'); ?>" + id_reg );
}
</script>
