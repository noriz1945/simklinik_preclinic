
<!doctype html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?>

<link href="<?php echo base_url(''); ?>assets/css/eresep.css" rel="stylesheet" type="text/css">
</head>

<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="container-fluid">

    <!-- Main content -->

<div class="" style="">
  <div class="col-md-12 box-shadow--16dp" style="margin-top:30px;">
    <h2 class="bg-primary text-center" style="border-radius:5px;">Soap_eresep</h2>
    <div class="row">
    
      <div class="col-sm-4">
      	<div style="min-height:50px;">
        	<h5>Riwayat Resep : </h5>
          <em style="font-size:12px;">Klik pada tanggal untuk melihat detail obat</em>
        </div>
        <div class="table-responsive" style="max-height:150px;height:150px;border:#CCC thin solid;">
        <table class="table table-bordered table-hover table-striped table-responsive">
          <tbody>
            <tr>
              <th scope="col">Tanggal & Waktu</th>
              <th scope="col">Tipe Kunjungan</th>
              <th scope="col">Dokter</th>
            </tr>
            <?php
              $no = 1;
              foreach ($rs as $resep)
              {
            ?>
            <tr>
              <td><a href="#" onClick="javascript : load_resep_detail('<?php echo $resep->id_resep ?>');"><?php echo $resep->resepdate ?></a></td>
              <td><?php echo $resep->id_type ?> <?php echo $resep->id_resep ?></td>
              <td><?php echo $resep->id_dokter ?></td>
            </tr>
            <?php
              $no++;
              }
            ?>
          </tbody>
        </table>
      </div>
      </div>
      
      <div class="col-sm-8">
        <div class="row" style="min-height:50px;">
          <div class="col-sm-8">
            <h5>Resep baru :</h5>
          </div>
          <div class="col-sm-4 text right">
            <?php echo anchor(site_url('soap_eresep/add_new/'.$id_reg),'Buat resep baru', 'class="btn btn-primary"'); ?>
          </div>
        </div>
        
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
    <div id="div_riw_res_det" style=" margin-top:10px;">
    </div>
    
  </div>
</div>

    <!-- /.content -->
		
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<script>
function load_resep_detail(id_resep)
{
	/*
	$.get( "test.cgi", { id_resep: id_resep } )
  .done(function( data ) {
    alert( "Data Loaded: " + data );
  });
	*/
	$( "#div_riw_res_det" ).load( "<?php echo base_url('soap_eresep/inner_resep_detail/'); ?>" + id_resep );
}
	
</script>
</body>
</html>
