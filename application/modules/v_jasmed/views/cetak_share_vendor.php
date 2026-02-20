<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Fast Clinic - Cetak Share Nakes</title>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3" align="right"><strong>KLINIK BINA MEDIKA<br>
        Jl. Raya Bina Medika - Serang<br>
      Telp : 021-12345678, Hp/Wa : 081-1234567890</strong></td>
    </tr>
    <tr>
      <td width="20%">&nbsp;</td>
      <td width="1%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td>&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td width="1%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7" align="center">PEMBAGIAN VENDOR</td>
    </tr>
    <tr>
      <td colspan="7" align="center"><?php echo $share_vendor_header->no_jasdor ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>ID. VENDOR</td>
      <td align="center">:</td>
      <td><?php echo $share_vendor_header->id_vendor ?></td>
      <td>&nbsp;</td>
      <td>TANGGAL&amp; WAKTU</td>
      <td align="center">:</td>
      <td><?php echo $share_vendor_header->waktu_jasdor ?></td>
    </tr>
    <tr>
      <td>NAMA</td>
      <td align="center">:</td>
      <td><?php echo $share_vendor_header->vendor ?></td>
      <td>&nbsp;</td>
      <td>PERIODE (DARI)</td>
      <td align="center">:</td>
      <td><?php echo date('Y-m-d',strtotime($share_vendor_header->periode_start)) ?></td>
    </tr>
    <tr>
      <td>TOTAL (Rp)</td>
      <td align="center">:</td>
      <td><?php echo number_format($share_vendor_header->total,0,",",".") ?></td>
      <td>&nbsp;</td>
      <td>PERIODE (SAMPAI)</td>
      <td align="center">:</td>
      <td><?php echo date('Y-m-d',strtotime($share_vendor_header->periode_end)) ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tbody>
    <tr>
      <th scope="col">NO.</th>
      <th scope="col">TGL &amp; WAKTU</th>
      <th scope="col">NAMA PASIEN/NO.RM/NO.REG</th>
      <th scope="col">TINDAKAN</th>
      <th scope="col">TARIF (Rp)</th>
      <th scope="col">SHARE VENDOR (%)</th>
      <th scope="col">SHARE VENDOR (Rp)</th>
    </tr>
	<?php 
	$no = 1;
	$total = 0;
	foreach($share_vendor_detail as $k => $v) 
	{	
	?>
    <tr>
      <th align="center" scope="row"><?php echo $no ?></th>
      <td align="center"><?php echo $v->trxdate ?></td>
      <td><?php echo $v->pasien ?> / <?php echo $v->id_pasien ?> / <?php echo $v->id_reg ?></td>
      <td><?php echo $v->tindakan ?></td>
	  <td align="right"><?php echo number_format($v->tarif,0,",",".") ?></td>
      <td align="center"><?php echo $v->persen_vendor ?></td>
      <td align="right"><?php echo number_format($v->share_vendor,0,",",".") ?></td>
    </tr>
	<?php
		$total += $v->share_vendor;
	}
	?>
    <tr>
      <th colspan="6" align="right" scope="row"><strong>TOTAL (Rp) : </strong></th>
      <td align="right"><strong><?php echo number_format($total,0,",",".") ?></strong></td>
    </tr>
  </tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="1%" nowrap="nowrap"><em>Waktu print</em></td>
      <td width="1%">:</td>
      <td nowrap="nowrap"><em><?php echo date('Y-m-d H:i:s') ?></em></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<script>
window.print();
</script>
</body>
</html>