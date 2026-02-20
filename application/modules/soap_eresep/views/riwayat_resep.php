
<link href="<?php echo base_url('assets/css/eresep.css'); ?>" rel="stylesheet" type="text/css">
<style>
tbody tr td:last-child {
	text-align: left;
}
</style>
<div id="tab_eresep">
  <div class="col-sm-12 text-left">
      <div>
        <h5>Riwayat Resep : </h5>
        <em style="font-size:12px;">Klik pada tanggal untuk melihat detail obat</em>
      </div>
      <div class="table-responsive" style="max-height:200px;border:#CCC thin solid;">
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
            <td nowrap="nowrap">
              <a href="#tab_eresep" onClick="javascript : load_resep_detail('<?php echo $resep['id_resep'] ?>');">
              <?php
              $dateresep=date_create($resep['resepdate']);
              echo date_format($dateresep,"d-m-Y H:i:s");  
              //echo $resep['resepdate'] ?></a>
              <!-- <a href="#tab_eresep" id="a_show_list_riwayat_resep"><?php echo $resep['resepdate'] ?></a> -->
            </td>
            <td nowrap="nowrap"><?php echo $resep['tipe_rawat']; ?></td>
            <td nowrap="nowrap" style=""><?php echo $resep['nama_dokter']; ?></td>
          </tr>
          <?php
            $no++;
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  
  <div class="col-sm-12" id="riw_res_det"></div>
</div>

<script>

function load_resep_detail(id_resep)
{
	$("#riw_res_det" ).load( "<?php echo base_url('soap_eresep/inner_resep_detail/'); ?>" + id_resep ,function(){
			//alert('loaded');
		});
}

function load_add_new(id_reg)
{
	$( "#tab_eresep" ).load( "<?php echo base_url('soap_eresep/add_new/'); ?>" + id_reg );
}
</script>
