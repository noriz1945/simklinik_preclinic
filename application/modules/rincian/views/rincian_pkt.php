<div class="card-block p-b-0">
<div class="table-responsive">
<table class="table table-hover m-b-0">
<thead>
<tr>
    <th>Tanggal</th>
    <th>Deskripsi</th>
    <th>Qty</th>
    <th>Harga</th>
    <th>Jumlah</th>
</tr>
</thead>
<tbody>
<?php $no_1 =0; 
foreach($rs_2 as $k2 => $v_2){  ?> 
<tr>
<td>&nbsp;</td>
<td style="color:black;font-weight: 900;"><?php echo $v_2['name_group']; ?></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<?php 
foreach($v_2['rs_3'] as $k3 => $v_3){ 
  if($v_3['id_paket']==NULL){
    $trxdate = date_create($v_3['trxdate']); 
    $datenyah = date_format($trxdate,"d/m/y");
  }else{
    $trxdate = ""; 
    $datenyah = "";
  }
  $totalwithqty = ($v_3['pricenya'] * $v_3['qtynya']);
$subtotal +=$totalwithqty;
?>
<tr>
<td><?php echo $datenyah; ?></td>
<td><?php echo $v_3['name_tind']; ?></td>
<td><?php echo $v_3['qtynya']; ?></td>
<td><?php echo number_format($v_3['pricenya'],0); ?></td>
<td><?php echo number_format($totalwithqty,0); ?></td>
</tr>

                
<?php }  }?>
    <tr>
    <td colspan="3">&nbsp;</td>
<td style="color:black;font-weight: 900;">Subtotal</td>
<td style="color:black;font-weight: 900;"><?php echo number_format($subtotal,0); ?></td>
</tr>
    </tbody>
</table>
</div>
</div>

<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h5>Pembayaran</h5>
</div>
<div class="card-block">
<div class="row">

<div class="col-lg-2">
<div class="checkbox-fade fade-in-primary">
<label>
<input type="checkbox" value="1" id="kartukredit" name="kartukredit">
<span class="cr">
<i class="cr-icon icofont icofont-ui-check txt-primary"></i>
</span>
<span>Kartu Kredit</span>
</label>
</div>
</div>

<div class="col-lg-1">
<select class="form-control selmstcctype" id="type_kartu" name="type_kartu"></select>
</div>

<div class="col-lg-1">
<select class="form-control selmstbank" id="id_bank" name="id_bank"></select>
</div>

<div class="col-lg-2">
<input type="text" class="form-control" id="nomor_kartu" name="nomor_kartu" placeholder="Nomor">
</div>

<div class="col-lg-2">
<input type="text" class="form-control" id="jumlah_tagihan" name="jumlah_tagihan" placeholder="Jumlah">
</div>

</div>
<br>
<div class="row">
<div class="col-lg-2">
<span>Tunai</span>
<input type="text" class="form-control" id="tunai_set_js" name="tunai_set_js" value="<?php echo $subtotal; ?>" disabled readonly hidden>
<input type="text" class="form-control" id="tunai_set" name="tunai_set" readonly>
</div>
<div class="col-lg-2">
<span>Disc</span>
<input type="text" class="form-control" id="disc_set" name="disc_set">
</div>
<div class="col-lg-2">
<span>Terima</span>
<input type="text" class="form-control" id="terima_set_js" name="terima_set_js" value="<?php echo $subtotal; ?>" disabled readonly hidden>
<input type="text" class="form-control" id="terima_set" name="terima_set">
</div>
<div class="col-lg-2">
<span>Kembali</span>
<input type="text" class="form-control" id="kembali_set" name="kembali_set" readonly>
</div>
<div class="col-lg-2">
<span>Grand Total</span>
<input type="text" class="form-control" id="grandtotal_set" name="grandtotal_set" value="<?php echo $subtotal; ?>" readonly>
</div>
<div class="col-lg-1">
<span>&nbsp;</span>
<div class="buttontypenyah"></div>
</div>

<div class="col-lg-1">
<span>&nbsp;</span>
<div class="buttontypebatalnyah"></div>
</div>
</div>

</div>
</div>
</div>