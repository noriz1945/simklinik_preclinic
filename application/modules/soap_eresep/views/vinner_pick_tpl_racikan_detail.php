	<div class="table-responsive" style=" border:#CCC thin solid; max-width:900px">
  	<form id="frm_draft_pick">
      <h6>Obat Racikan</h6>
      <table class="table table-bordered table-hover table-striped table-responsive">
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
            <th scope="col">Fungsi</th>
          </tr>
        	
          <tr id="row_racikan_n">
          	<td colspan="2"><strong><?php echo $rs_head['nama_racikan']; ?></strong><input type="hidden" id="nama_racikan_n" 				value="<?php echo $rs_head['nama_racikan']; ?>"></td> 
            <!--
            <td><?php echo $rs_head['jumlah']; ?>				<input type="hidden" id="jumlah_racikan_n" 	value="<?php echo $rs_head['jumlah']; ?>"></td>
            <td><?php echo $rs_head['dosis']; ?>				<input type="hidden" id="dosis_racikan_n" 	value="<?php echo $rs_head['dosis']; ?>"></td>
          	<td><?php echo $rs_head['frekwensi']; ?>		<input type="hidden" id="frekwensi_racikan_n" 	value="<?php echo $rs_head['frekwensi']; ?>"></td> 
           	<td><?php echo $rs_head['tme']; ?>					<input type="hidden" id="tme_racikan_n" 				value="<?php echo $rs_head['tme']; ?>"></td> 
           	<td><?php echo $rs_head['kemasan']; ?>			<input type="hidden" id="kemasan_racikan_n" 		value="<?php echo $rs_head['kemasan']; ?>"></td> 
           	<td><?php echo $rs_head['note']; ?>					<input type="hidden" id="note_racikan_n" 				value="<?php echo $rs_head['note']; ?>"></td> 
            -->
            <td><?php echo $rs_head['jumlah']; ?>				<input type="hidden" id="jumlah_racikan_n" 	value="<?php echo $rs_head['jumlah']; ?>"></td>
            <td><?php echo $rs_head['dosis']; ?>				<input type="hidden" id="dosis_racikan_n" 	value="<?php echo $rs_head['dosis']; ?>"></td>
          	<td><?php echo $rs_head['frekwensi']; ?>		<input type="hidden" id="frekwensi_racikan_n" 	value="<?php echo $rs_head['frekwensi']; ?>"></td> 
           	<td><?php echo $rs_head['tme']; ?>					<input type="hidden" id="tme_racikan_n" 				value="<?php echo $rs_head['tme']; ?>"></td> 
           	<td><?php echo $rs_head['kemasan']; ?>			<input type="hidden" id="kemasan_racikan_n" 		value="<?php echo $rs_head['kemasan']; ?>"></td> 
           	<td><?php echo $rs_head['note']; ?>					<input type="hidden" id="note_racikan_n" 				value="<?php echo $rs_head['note']; ?>"></td> 
           	<td>&nbsp;</td> 
          </tr>
          <?php 
					$id_num = 0;
					foreach($rs as $k => $v){ 
					?>
          <tr class="row_racikan_det_n"> 
            <td style="padding-left:20px;">&bull; <?php echo $v['name']; ?>						<input type="hidden" id="det_racikan_obat_n_<?php echo $k; ?>" 	value="<?php echo $v['name']; ?>"></td> 
            <td style="padding-left:20px;"><?php echo $v['jenis_obat']; ?>			<input type="hidden" id="det_jenis_obat_n_<?php echo $k; ?>" 		value="<?php echo $v['jenis_obat']; ?>"> 
                                										<input type="hidden" id="det_id_fa_n_<?php echo $k; ?>" 					value="<?php echo $v['id_fa']; ?>"></td> 
            <td style="padding-left:20px;"><?php echo $v['qty']; ?>						<input type="hidden" id="det_racikan_qty_n_<?php echo $k; ?>" 		value="<?php echo $v['qty']; ?>"></td> 
            <!--<td><?php #echo $v['dosis']; ?>					<input type="hidden" id="det_racikan_dosis_n_<?php #echo $k; ?>" 	value="<?php #echo $v['dosis']; ?>"></td>-->
            <td colspan="5">&nbsp;</td> 
          </tr>
          <?php 
						$id_num++;
					} 
					?>
        </tbody>
      </table>
    </form>
  </div>
  <script>
		$( "#id_num" ).val('<?php echo $id_num; ?>');
  </script>
  
  