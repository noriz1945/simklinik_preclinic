<!doctype html>
<html>
    <head> <?php #$this->theme->head('theme_default'); ?><title>Fast Clinic - Zia Aesthetic</title>
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
		      <td align="center"><strong><span lang="EN-US">KLINIK KECANTIKAN</span></strong></td>
	      </tr>
		    <tr>
		      <td align="center"><strong><span lang="EN-US">ZIA AESTHETIC</span></strong></td>
	      </tr>
		    <tr>
		      <td align="center"><span lang="EN-US">JL.  Bhayangkara NO. 1B</span><strong><span lang="EN-US"> </span></strong></td>
	      </tr>
		    <tr>
		      <td align="center"><span lang="EN-US">CIPOCOK JAYA, KOTA SERANG BANTEN</span></td>
	      </tr>
	    </tbody>
	  </table>
    <br>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="1" nowrap="nowrap"><span lang="EN-US"> No.Inv </span></td>
      <td width="20" align="center">:</td>
      <td><?php echo $data_inv_header->id_inv ?></td>
      <td width="1" rowspan="2" align="center"><?php echo $data_inv_header->regdate ?></td>
    </tr>
    <tr>
      <td><span lang="EN-US"> No.Reg </span></td>
      <td align="center">:</td>
      <td><?php echo $data_inv_header->id_reg ?></td>
    </tr>
    <tr>
      <td><span lang="EN-US"> No.RM </span></td>
      <td align="center">:</td>
      <td><?php echo $data_inv_header->id_pasien ?></td>
      <td width="1" align="center" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td><span lang="EN-US"> Nama  </span></td>
      <td align="center">:</td>
      <td><?php echo $data_inv_header->name ?></td>
      <td width="1" align="center" nowrap="nowrap"><?php echo ($data_inv_header->asuransi=='TUNAI')?'UMUM':$data_inv_header->asuransi ?></td>
    </tr>
  </tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td colspan="7">--------------------------------------------</td>
    </tr>
		<?php
		foreach($data_inv_detail as $k => $v)
		{
		?>
    <tr>
      <td colspan="7"><?php echo $v->name ?></td>
    </tr>
    <tr>
      <td width="50">Qty</td>
      <td align="right"><?php echo $v->qty ?></td>
      <td width="50" align="right">X</td>
      <td align="right"><?php echo number_format($v->price,2,",",".") ?></td>
      <td width="20" align="center">=</td>
      <td colspan="2" align="right"><?php echo number_format($v->total,2,",",".") ?></td>
    </tr>
		<?php if(intval($v->disc_m)>0){ ?>
		
	<tr>
      <td width="50" align="right"><i>Disc</i></td>
      <td align="right" nowrap><i><?php echo round($v->disc_p) ?>(%)</i></td>
      <td width="50" align="right"><i></i></td>
      <td align="right"><i><?php echo number_format(($v->disc_m * (-1)),2,",",".") ?></i></td>
      <td width="20" align="center"></td>
      <td colspan="2" align="right"></td>
    </tr>
	
		<?php
		}
		?>
		<?php
		}
		?>
    <tr>
      <td colspan="7">--------------------------------------------</td>
    </tr>
    <tr>
      <td colspan="4" align="right">Total</td>
      <td align="center">=</td>
      <td width="1" align="center">Rp.</td>
      <td width="90" align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->subtotal,2,",",".") ?></td>
    </tr>
	<tr>
      <td colspan="4" align="right">Diskon (-)</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->vcdisc_m,2,",",".") ?></td>
    </tr>
	<tr>
      <td colspan="4" align="right">PPN (11%) (+)</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->ppn,2,",",".")  ?></td>
    </tr>
    <tr>
      <td colspan="4" align="right">Deposit (-)</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->total_dp,2,",",".") ?></td>
    </tr>
	<tr>
      <td colspan="4" align="right">Grand Total</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->total,2,",",".")  ?></td>
    </tr>
	<tr>
      <td colspan="4" align="right">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="right">Jaminan Asuransi</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->total_noncash,2,",",".") ?></td>
    </tr>
	
	<tr>
      <td colspan="4" align="right">Debit/Kredit</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->total_cc1,2,",",".") ?></td>
    </tr>
    <tr>
      <td colspan="4" align="right">Tunai</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format(($data_inv_header->total_cash + $data_inv_header->kembalian),2,",",".") ?></td>
    </tr>
    
    
    <tr>
      <td colspan="7">--------------------------------------------</td>
    </tr>
    <tr>
      <td colspan="4" align="right">Kembali</td>
      <td align="center">=</td>
      <td align="right">Rp.</td>
      <td align="right"><?php echo number_format($data_inv_header->kembalian,2,",",".") ?></td>
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
      <td>( <?php echo $data_inv_header->creator ?> )</td>
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