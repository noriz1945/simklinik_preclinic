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
		      <td align="center"><strong><span lang="EN-US">CAFE</span></strong></td>
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
      <td><span lang="EN-US"> No.Reg </span></td>
      <td align="center">:</td>
      <td><?php echo $data_inv_header->id_reg ?></td>
    </tr>
    <tr>
      <td><span lang="EN-US"> Nama  </span></td>
      <td align="center">:</td>
      <td><?php echo $data_inv_header->nama ?></td>
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
      <td colspan="7"><?php echo $v->nama_produk ?></td>
    </tr>
    <tr>
      <td width="50">Qty</td>
      <td align="right"><?php echo $v->jumlah ?></td>
      <td width="50" align="right">X</td>
      <td align="right"><?php echo number_format($v->harga,0,",",".") ?></td>
      <td width="20" align="center">=</td>
      <td colspan="2" align="right"><?php echo number_format($v->total,0,",",".") ?></td>
    </tr>
	
	
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
      <td width="90" align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->subtotal,0,",",".") ?></td>
    </tr>
    <tr>
      <td colspan="4" align="right">Diskon (<?php echo number_format($data_inv_header->diskon_persen,0,",",".") ?>%)</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <?php if($data_inv_header->diskon_persen==0){ $diskonpersen=0;}else{ $diskonpersen=($data_inv_header->subtotal/$data_inv_header->diskon_persen)/100;} ?>
      <?php $diskon_persen = $diskonpersen; ?>
      <td align="right" nowrap="nowrap"><?php echo number_format($diskon_persen,0); ?></td>
    </tr>
    <tr>
      <td colspan="4" align="right">Diskon (Rp)</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->diskon_rp,0,",",".") ?></td>
    </tr>
    	<tr>
      <td colspan="4" align="right">Diskon (-)</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <?php 
      $diskon_persen = $diskonpersen;
      $diskon_rp     = $data_inv_header->diskon_rp;
      $total_diskon = ($diskon_persen+$diskon_rp);
      //$total_diskon = ($data_inv_header->subtotal - ($diskon_persen+$diskon_rp));

      ?>
      <td align="right" nowrap="nowrap"><?php echo number_format($total_diskon,0,",",".") ?></td>
    </tr>
	<!--<tr>
      <td colspan="4" align="right">PPN (11%) (+)</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
            <?php $setrumusppn = ($data_inv_header->subtotal * 11)/100; ?>
      <td align="right" nowrap="nowrap"><?php echo number_format($setrumusppn,0,",",".")  ?></td>
    </tr>-->
    <tr>
      <td colspan="4" align="right">Grand Total</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <?php $resall = ($data_inv_header->subtotal - ($diskon_persen+$diskon_rp)); // ($data_inv_header->subtotal + $setrumusppn); ?>
      <td align="right" nowrap="nowrap"><?php echo number_format($resall,0,",",".")  ?></td>
    </tr>
    
	<tr>
      <td colspan="4" align="right">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td align="right" nowrap="nowrap">&nbsp;</td>
    </tr>
	
	<tr>
      <td colspan="4" align="right">Debit/Kredit</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->debit,0,",",".") ?></td>
    </tr>
    <tr>
      <td colspan="4" align="right">Tunai</td>
      <td align="center">=</td>
      <td align="center">Rp.</td>
      <td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->tunai,0,",",".") ?></td>
    </tr>
    
    
    <tr>
      <td colspan="7">--------------------------------------------</td>
    </tr>
    <tr>
      <td colspan="4" align="right">Kembali</td>
      <td align="center">=</td>
      <td align="right">Rp.</td>
      <td align="right"><?php echo number_format($data_inv_header->kembalian,0,",",".") ?></td>
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
      <td>( <?php echo $data_inv_header->created_by ?> )</td>
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
  </tbody>
</table>

<script>
			window.print();
		  </script>
    </body>
</html>
<!-- end tpl_print.html -->