
<!doctype html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?>
</head>

<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="container-fluid">

    <!-- Main content -->

<div class="" style="">
<div class="col-md-12 box-shadow--16dp" style="margin-top:30px;">
<h2 class="bg-primary text-center" style="border-radius:5px;">Soap_eresep</h2>

  <div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
    	<?php echo anchor(site_url('soap_eresep/create'),'Tambah Data', 'class="btn btn-primary"'); ?>            
		</div>
      <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
					<!--<?php #echo $this->session->userdata("message") <> "" ? $this->session->userdata("message") : ""; ?>-->
				</div>
      </div>
    <div class="col-md-1 text-right"></div>
    <div class="col-md-3 text-right">
      <form action="<?php echo site_url('soap_eresep/index'); ?>" class="form-inline" method="get">
        <div class="input-group">
          <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
          <span class="input-group-btn">
						<?php 
								if ($q <> "")
								{
										?>
										<a href="<?php echo site_url('soap_eresep'); ?>" class="btn btn-default">Reset</a>
										<?php
								}
						?>
          	<button class="btn btn-primary" type="submit">Cari</button>
          </span>
        </div>
      </form>
    </div>
  </div>
	
  
 	 <div class="table-responsive">      
    <table class="table table-bordered table-hover table-striped table-responsive">
      <tbody>
        <tr>
          <th scope="col">NO</th>
          <th scope="col">Resepdate</th>
          <th scope="col">Id Reg</th>
          <th scope="col">Id Dokter</th>
          <th scope="col">Id Type</th>
          <th scope="col">Id Kelas</th>
          <th scope="col">Total</th>
          <th scope="col">Id Ord</th>
          <th scope="col">Racikan</th>
        </tr>
				<?php
            foreach ($trx_frm_resep_data as $trx_frm_resep)
            {
        ?>
        <tr>
					<td width="80px"><?php echo ++$start ?></td>
							<td><?php echo $trx_frm_resep->resepdate ?></td>
							<td><?php echo $trx_frm_resep->id_reg ?></td>
							<td><?php echo $trx_frm_resep->id_dokter ?></td>
							<td><?php echo $trx_frm_resep->id_type ?></td>
							<td><?php echo $trx_frm_resep->id_kelas ?></td>
							<td><?php echo $trx_frm_resep->total ?></td>
							<td><?php echo $trx_frm_resep->id_ord ?></td>
							<td><?php echo $trx_frm_resep->racikan ?></td>        
				</tr>
				<?php
        	}
        ?>
      </tbody>
    </table>
    </div>
    
    
    <div class="row">
        <div class="col-md-6">
            <a href="#" class="btn btn-primary">Total Data : <?php echo $total_rows ?></a>
						
        </div>
        <div class="col-md-6 text-right">
            <?php echo $pagination ?>           
        </div>
    </div>
</div>
</div>

    <!-- /.content -->
		
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<script>
								
	
</script>
</body>
</html>
