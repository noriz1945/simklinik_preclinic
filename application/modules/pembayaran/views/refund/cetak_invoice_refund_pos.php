<!doctype html>
<html>
    <head> <?php #$this->theme->head('theme_default'); ?><title>Fast Clinic - Bina Medika</title>
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
	    </tbody>
	  </table>
    <br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td nowrap="nowrap">No.Inv Refund</td>
      <td align="center">:</td>
      <td><?php echo $data_inv_refund_header->id_refund ?></td>
      <td width="1" align="center">REFUND</td>
    </tr>
    <tr>
      <td width="1" nowrap="nowrap"><span lang="EN-US"> No.Inv </span></td>
      <td width="20" align="center">:</td>
      <td><?php echo $data_inv_refund_header->id_inv ?></td>
      <td width="1" rowspan="2" align="center"><?php echo $data_inv_refund_header->refund_date ?></td>
    </tr>
    <tr>
      <td><span lang="EN-US"> No.Reg </span></td>
      <td align="center">:</td>
      <td><?php echo $data_inv_refund_header->id_reg ?></td>
    </tr>
    <tr>
      <td><span lang="EN-US"> No.RM </span></td>
      <td align="center">:</td>
      <td><?php echo $data_inv_refund_header->id_pasien ?></td>
      <td width="1" align="center" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td><span lang="EN-US"> Nama  </span></td>
      <td align="center">:</td>
      <td><?php echo $data_inv_refund_header->name ?></td>
      <td width="1" align="center" nowrap="nowrap">TUNAI</td>
    </tr>
  </tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td colspan="6">--------------------------------------------</td>
    </tr>
		<tr>
      <td align="right">Tariff</td>
      <td align="right">- DIsc Item</td>
      <td align="right">- Disc All</td>
      <td align="right">=</td>
      <td align="right">&nbsp;</td>
      <td align="right">Refund</td>
    </tr>
		<?php
		foreach($data_inv_refund_detail as $k => $v)
		{
		?>
    
    <tr>
      <td colspan="6"><?php echo $v->name ?></td>
    </tr>
    <tr>
      <td width="50" align="right"><?php echo number_format($v->price_total,2,",",".") ?></td>
      <td align="right"><?php echo number_format($v->min_disc_item,2,",",".") ?></td>
      <td align="right"><?php echo number_format($v->min_disc_inv,2,",",".") ?></td>
      <td width="20" align="right">=</td>
      <td colspan="2" align="right"><?php echo number_format($v->price_refund,2,",",".") ?></td>
    </tr>
		<?php
			
		}
		?>
    <tr>
      <td colspan="6">--------------------------------------------</td>
    </tr>
    <tr>
      <td colspan="3" align="right">Total Refund</td>
      <td align="center">=</td>
      <td width="1" align="center">Rp.</td>
      <td width="90" align="right" nowrap="nowrap"><?php echo number_format($data_inv_refund_header->refund_total,2,",",".") ?></td>
    </tr>
	<tr>
      <td colspan="3" align="right">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="right">Jaminan Asuransi</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_refund_header->refund_asuransi,2,",",".") ?></td>
    </tr>
    <tr>
      <td colspan="3" align="right">Tunai</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format(($data_inv_refund_header->tunai),2,",",".") ?></td>
    </tr>
    
    
    <tr>
      <td colspan="6">--------------------------------------------</td>
    </tr>
  </tbody>
</table>
			<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php echo date('Y-m-d H:i:s');?></td>
    </tr>
    <tr>
      <td>Petugas,</td>
    </tr>
    <tr>
      <td height="50">&nbsp;</td>
    </tr>
    <tr>
      <td>( <?php echo $data_inv_refund_header->creator_refund ?> )</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><span lang="EN-US"> *** Struk ini berlaku sebagai kwitansi ***</span></td>
    </tr>
    <tr>
      <td align="center"><span lang="EN-US"> *** Terimakasih atas kunjungan anda ***</span></td>
    </tr>
    <tr>
      <td align="center"><span lang="EN-US"> *** Semoga lekas sembuh ***</span></td>
    </tr>
  </tbody>
</table>

<script>
			window.print();
		  </script>
    </body>
</html>
<!-- end tpl_print.html -->