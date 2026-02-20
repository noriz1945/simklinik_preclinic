<!doctype html>
<html>
    <head> <?php #$this->theme->head('theme_default'); ?><title>FastMedik - LYND</title>
		<style>
				html * {
						font-size: 13px !important;
						font-family: Lucida Console !important;
				}
		</style>
    </head>
    <body>
    <br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tbody>
				<tr>
		      <td align="center"><strong><span lang="EN-US">KLINIK UTAMA</span></strong></td>
	      </tr>
		    <tr>
		      <td align="center"><strong><span lang="EN-US">LYND</span></strong></td>
	      </tr>
		    <tr>
		      <td align="center"><span lang="EN-US">JL. DR. Cipto Mangunkusumo</span><strong><span lang="EN-US"> </span></strong></td>
	      </tr>
		    <tr>
		      <td align="center"><span lang="EN-US">CILEDUG, KOTA TANGERANG</span></td>
	      </tr>
				<tr>
					<td align="center"></td>
				</tr>
				<tr>
					<td align="center"><span lang="EN-US">BUKTI <?php echo $data_dp->txt_refund_dp ?> DEPOSIT</span></td>
				</tr>
			</tbody>
		</table>
    <br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="1" nowrap="nowrap"><span lang="EN-US"> No.Deposit </span></td>
      <td width="20" align="center">:</td>
      <td><?php echo $data_dp->id_trx ?></td>
      <td width="1" align="center">Waktu Reg.</td>
    </tr>
    <tr>
      <td><span lang="EN-US"> No.Reg </span></td>
      <td align="center">:</td>
      <td><?php echo $data_dp->id_reg ?></td>
      <td width="1" rowspan="2" align="center"><?php echo $data_dp->regdate ?></td>
    </tr>
    <tr>
      <td><span lang="EN-US"> No.RM </span></td>
      <td align="center">:</td>
      <td><?php echo $data_dp->id_pasien ?></td>
    </tr>
    <tr>
      <td><span lang="EN-US"> Nama  </span></td>
      <td align="center">:</td>
      <td><?php echo $data_dp->name ?></td>
      <td width="1" align="center" nowrap="nowrap">TUNAI</td>
    </tr>
  </tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
	<tr>
      <td colspan="7">--------------------------------------------</td>
    </tr>
    <tr>
      <td colspan="7"><?php echo $data_dp->note_dp ?></td>
    </tr>
    <tr>
      <td colspan="7">--------------------------------------------</td>
    </tr>
    <tr>
      <td colspan="4" align="right">Dibayar Kartu</td>
      <td align="center">=</td>
      <td width="1" align="center">Rp.</td>
      <td width="90" align="right" nowrap="nowrap"><?php echo number_format($data_dp->total_cc1,2,",",".") ?></td>
    </tr>
	<tr>
      <td colspan="4" align="right">Tunai</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_dp->total_cash,2,",",".") ?></td>
    </tr>
	<tr>
      <td colspan="7">--------------------------------------------</td>
    </tr>
	<tr>
      <td colspan="4" align="right">Total</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_dp->total,2,",",".")  ?></td>
    </tr>
	
  </tbody>
</table>
			<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td>Waktu Cetak :</td>
      <td>Waktu DP :</td>
    </tr>
    <tr>
      <td><?php echo date('Y-m-d H:i:s');?></td>
      <td><?php echo $data_dp->trxdate ?></td>
    </tr>
    <tr>
      <td width="56%">&nbsp;</td>
      <td width="44%">Petugas,</td>
    </tr>
    <tr>
      <td height="50">&nbsp;</td>
      <td height="50">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>( <?php echo $data_dp->creator ?> )</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" align="center"><span lang="EN-US"> *** Struk ini berlaku sebagai kwitansi ***</span></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><span lang="EN-US"> *** Terimakasih atas kunjungan anda ***</span></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><span lang="EN-US"> *** Semoga lekas sembuh ***</span></td>
    </tr>
  </tbody>
</table>

<script>
			window.print();
		  </script>
    </body>
</html>
<!-- end tpl_print.html -->