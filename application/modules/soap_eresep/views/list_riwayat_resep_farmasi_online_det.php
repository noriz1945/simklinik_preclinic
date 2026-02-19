<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">
<h5>Obat Non-Racikan</h5>
</div>
<div class="card-block tab-icon">
<div class="table-responsive">
<table class="table table-bordered table-responsive styled-table">
      <thead>
        <tr>
          <th scope="col">Obat</th>
          <th scope="col">Jenis</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Dosis</th>
          <th scope="col">Frekwensi</th>
          <th scope="col">Waktu</th>
          <th scope="col">Jumlah Stok</th>
          <th scope="col">Harga Satuan</th>
          <th scope="col">Sub Total</th>
          <th scope="col">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($rs_eresep_det as $k => $v){
          $subtotal_nonracikan = ($v['qty'] * $v['sale_price']);
          $subtotalnya += $subtotal_nonracikan;
        ?>
        <tr>
          <td><?php echo $v['name'] ?></td>
          <td><?php echo $v['jenis_obat'] ?></td>
          <td><?php echo $v['qty'] ?></td>
          <td><?php echo $v['dosis'] ?></td>
          <td><?php echo $v['frekwensi'] ?></td>
          <td><?php echo $v['tme']; ?></td>
          <td><?php echo $v['qty_end'] ?></td>
          <td><?php echo number_format($v['sale_price'],0); ?></td>
          <td><?php echo number_format($subtotal_nonracikan,0); ?></td>
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


<div class="card">
<div class="card-header">
<h5>Obat Racikan</h5>
</div>
<div class="card-block tab-icon">
<div class="table-responsive">
<form id="frm_draft_pick">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
      <thead>
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
          <th scope="col">Jumlah Stok</th>
          <th scope="col">Harga Satuan</th>
          <th scope="col">Sub Total</th>
          <th scope="col">Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach($rs_head as $k_racikan => $v_racikan)
				{
  
          $isedit=$v_racikan['is_edited'];
				?>
        <tr id="row_racikan_n" style="background-color:aqua;">
          <td colspan="2"><strong><?php echo $v_racikan['name']; ?></strong><input type="hidden" id="nama_racikan_n2" 				value="<?php echo $v_racikan['name']; ?>"></td> 
          <td><?php echo $v_racikan['qty']; ?>															<input type="hidden" id="jumlah_racikan_n2" 			value="<?php echo $v_racikan['qty']; ?>"></td>
          <td><?php echo $v_racikan['dosis']; ?>														<input type="hidden" id="dosis_racikan_n2" 			value="<?php echo $v_racikan['dosis']; ?>"></td>
          <td><?php echo $v_racikan['frekwensi']; ?>												<input type="hidden" id="frekwensi_racikan_n2" 	value="<?php echo $v_racikan['frekwensi']; ?>"></td> 
          <td><?php echo $v_racikan['tme']; ?>															<input type="hidden" id="tme_racikan_n2" 				value="<?php echo $v_racikan['tme']; ?>"></td> 
          <td><?php echo $v_racikan['jenis_obat']; ?>												<input type="hidden" id="kemasan_racikan_n2" 		value="<?php echo $v_racikan['jenis_obat']; ?>"></td> 
          <td colspan="3">&nbsp;</td>
          <td><?php echo $v_racikan['note']; ?>															<input type="hidden" id="note_racikan_n2" 				value="<?php echo $v_racikan['note']; ?>"></td> 
          
        </tr>
        <?php 
        $id_num = 0;
        foreach($v_racikan['det_racikan'] as $k => $v)
				{
          $subtotal_racikan = ($v['qty'] * $v['sale_price']);
          $subtotalnya_racik += $subtotal_racikan;
        ?>
        <tr class="row_racikan_det_n"> 
          <td style="padding-left:20px;">&bull; <?php echo $v['name']; ?>		<input type="hidden" id="det_racikan_obat_n2_<?php echo $k; ?>" 	value="<?php echo $v['name']; ?>"></td> 
          <td style="padding-left:20px;"><?php echo $v['jenis_obat']; ?>		<input type="hidden" id="det_jenis_obat_n2_<?php echo $k; ?>" 		value="<?php echo $v['jenis_obat']; ?>"> 
                                                  													<input type="hidden" id="det_id_fa_n2_<?php echo $k; ?>" 				value="<?php echo $v['id_trx_det']; ?>"></td> 
          <td style="padding-left:20px;"><?php echo $v['qty']; ?>						<input type="hidden" id="det_racikan_qty_n2_<?php echo $k; ?>" 	value="<?php echo $v['qty']; ?>"></td> 
          <td colspan="4">&nbsp;</td> 
          <td><?php echo $v['qty_end'] ?></td>
          <td><?php echo number_format($v['sale_price'],0); ?></td>
          <td><?php echo number_format($subtotal_racikan,0); ?></td>
          <td>&nbsp;</td> 
        </tr>
        <?php 
          $id_num++;
        } 
				}
        ?>
      </tbody>
    </table>

    <div class="card-block tab-icon">
<div class="table-responsive">
<table class="table table-hover m-b-0">
<thead>
<tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
</tr>
</thead>
<tbody>
<tr>
<td>Subtotal</td>
<td><?php $totalall= ($subtotalnya + $subtotalnya_racik); echo number_format($totalall,0); ?></td>
</tr>
</tbody>
</table>
</div>

</div>
      </form>
</div>

</div>
</div>


</div>
</div>

<input type="hidden" id="det_subtotal" name="det_subtotal" value="<?php echo $totalall; ?>">
<br>
&nbsp;&nbsp;
<button type="button" class="btn btn-primary" id="copy_resep_from_riwayat"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Edit Resep</button>
<p>&nbsp;</p>
<script>
$('#copy_resep_from_riwayat').click(function(e){
 /////
 Swal.fire({
    title: 'Salin Resep',
    text: 'Salin Resep ?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Salin Resep!','Salin Resep berhasil!', 'success').then(function(){
            <?php echo $tr_obat_biasa; ?>
	          <?php echo $tr_header_racikan; ?>
            <?php echo $setidresep; ?>
          }
        );
        document.getElementById("butt_simpan_resep").hidden = false;
        document.getElementById("batal_new_eresep").hidden = false;
      } else if (result.isDenied) {
        Swal.fire('Batal Salin Resep!', 'Batal Salin Resep!', 'info')
      }
 })
 ////
});








</script>

