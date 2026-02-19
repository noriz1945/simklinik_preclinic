<hr>

<h5 class="bg-success" style="margin:15px 0 0 0; padding:5px;"> Detail Riwayat eResep : </h5>
  <div class="table-responsive" style=" max-width:800px; border:#CCC thin solid;">
    <table class="table table-bordered table-hover table-striped table-responsive" style="min-width:600px;">
      <tbody>
        <tr>
          <th scope="col">Obat</th>
          <th scope="col">Jenis</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Dosis</th>
          <th scope="col">Frekwensi</th>
          <th scope="col">Waktu</th>
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


<div class="table-responsive" style=" border:#CCC thin solid; max-width:900px">
  <form id="frm_draft_pick">
  	<h5 class="bg-success" style="margin:15px 0 0 0; padding:5px;">Obat Racikan</h5>
    <table class="table table-bordered table-hover table-striped table-responsive" style="min-width:700px;">
      <tbody id="tbody_draft_resep_racikan">
        <tr>
        </tr>
        <tr>
          <th scope="col">Obat</th>
          <th scope="col">Jenis</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Dosis</th>
          <th scope="col">Frekwensi</th>
          <th scope="col">Waktu</th>
          <th scope="col">Kemasan</th>
          <th scope="col">Keterangan</th>
        </tr>
        <?php
        foreach($rs_head as $k_racikan => $v_racikan)
				{
				?>
        <tr id="row_racikan_n">
          <td colspan="2"><strong><?php echo $v_racikan['name']; ?></strong><input type="hidden" id="nama_racikan_n2" 				value="<?php echo $v_racikan['name']; ?>"></td> 
          <td><?php echo $v_racikan['qty']; ?>															<input type="hidden" id="jumlah_racikan_n2" 			value="<?php echo $v_racikan['qty']; ?>"></td>
          <td><?php echo $v_racikan['dosis']; ?>														<input type="hidden" id="dosis_racikan_n2" 			value="<?php echo $v_racikan['dosis']; ?>"></td>
          <td><?php echo $v_racikan['frekwensi']; ?>												<input type="hidden" id="frekwensi_racikan_n2" 	value="<?php echo $v_racikan['frekwensi']; ?>"></td> 
          <td><?php echo $v_racikan['tme']; ?>															<input type="hidden" id="tme_racikan_n2" 				value="<?php echo $v_racikan['tme']; ?>"></td> 
          <td><?php echo $v_racikan['jenis_obat']; ?>												<input type="hidden" id="kemasan_racikan_n2" 		value="<?php echo $v_racikan['jenis_obat']; ?>"></td> 
          <td><?php echo $v_racikan['note']; ?>															<input type="hidden" id="note_racikan_n2" 				value="<?php echo $v_racikan['note']; ?>"></td> 
        </tr>
        <?php 
        $id_num = 0;
        foreach($v_racikan['det_racikan'] as $k => $v)
				{
        ?>
        <tr class="row_racikan_det_n"> 
          <td style="padding-left:20px;">&bull; <?php echo $v['name']; ?>		<input type="hidden" id="det_racikan_obat_n2_<?php echo $k; ?>" 	value="<?php echo $v['name']; ?>"></td> 
          <td style="padding-left:20px;"><?php echo $v['jenis_obat']; ?>		<input type="hidden" id="det_jenis_obat_n2_<?php echo $k; ?>" 		value="<?php echo $v['jenis_obat']; ?>"> 
                                                  													<input type="hidden" id="det_id_fa_n2_<?php echo $k; ?>" 				value="<?php echo $v['id_trx_det']; ?>"></td> 
          <td style="padding-left:20px;"><?php echo $v['qty']; ?>						<input type="hidden" id="det_racikan_qty_n2_<?php echo $k; ?>" 	value="<?php echo $v['qty']; ?>"></td> 
          <td colspan="5">&nbsp;</td> 
        </tr>
        <?php 
          $id_num++;
        } 
				}
        ?>
      </tbody>
    </table>
  </form>
</div>
<br>
<!--&nbsp;&nbsp;<button type="button" class="btn btn-primary" id="copy_resep_from_riwayat"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Salin resep ini ke resep baru</button>-->

<p>&nbsp;</p>
<script>
$('#copy_resep_from_riwayat').click(function(e) 
{
	if(!window.confirm('Salin resep ?'))
	{
		return;
	}
	<?php echo $tr_obat_biasa; ?>
	<?php echo $tr_header_racikan; ?>
});
</script>

