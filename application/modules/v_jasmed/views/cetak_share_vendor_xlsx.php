<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Fast Clinic - Cetak Share Nakes</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tbody>
    <tr>
      <th scope="col">NO.</th>
      <th scope="col">TGL &amp; WAKTU</th>
      <th scope="col">NAMA PASIEN/NO.RM/NO.REG</th>
      <th scope="col">TINDAKAN</th>
      <th scope="col">TARIF (Rp)</th>
      <th scope="col">SHARE NAKES (%)</th>
      <th scope="col">SHARE NAKES (Rp)</th>
    </tr>
	<?php 
	$no = 1;
	$total = 0;
	foreach($share_nakes_detail as $k => $v) 
	{	
	?>
    <tr>
      <th align="center" scope="row"><?php echo $no ?></th>
      <td align="center"><?php echo $v->trxdate ?></td>
      <td><?php echo $v->pasien ?> / <?php echo $v->id_reg ?> / <?php echo $v->id_pasien ?></td>
      <td><?php echo $v->tindakan ?></td>
	  <td align="right"><?php echo $v->tarif ?></td>
      <td align="center"><?php echo $v->persen_nakes ?></td>
      <td align="right"><?php echo $v->share_nakes ?></td>
    </tr>
	<?php
		$total += $v->share_nakes;
	}
	?>
    <tr>
      <th colspan="6" align="right" scope="row"><strong>TOTAL (Rp) : </strong></th>
      <td align="right"><strong><?php echo $total ?></strong></td>
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
	
</body>
</html>