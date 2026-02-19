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
		      <td align="center"><strong><span lang="EN-US">E-Tiket</span></strong></td>
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
      <td colspan="7">--------------------------------------------</td>
    </tr>

    <tr>
      <td>No RM</td>
      <td><?php echo $id_pasien; ?></td>
      <td>Tgl Resep</td>
      <td><?php echo $eresep_date; ?></td>
    </tr>
    <tr>
      <td>Tgl Lahir</td>
      <td><?php echo $tgllahir; ?></td>
      <td>Umur</td>
      <td><?php echo $umur; ?></td>
    </tr>
    <tr>
      <td><?php echo $nama_pasien; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><?php echo $data_etiket_detail->name; ?></td>
      <td>Qty : <?php echo $data_etiket_detail->qty; ?></td>
    </tr>
    <tr>
      <td><?php echo $data_etiket_detail->frekwensi." ".$data_etiket_detail->dosis; ?></td>
    </tr>
    <tr>
      <td><?php echo $data_etiket_detail->tme; ?></td>
    </tr>


  </tbody>
</table>

<script>
			window.print();
		  </script>
    </body>
</html>
<!-- end tpl_print.html -->