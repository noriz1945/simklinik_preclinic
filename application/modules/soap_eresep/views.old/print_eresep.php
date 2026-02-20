<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
body{
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
	padding:10px;
}
table{
	padding:0;
	margin:0;
	border: none;
}
.border-it{
	border:black thin solid;
}
.border-top{
border-top:black thin solid;
}
.border-left border-right{
border-right:black thin solid;
}
.border-bottom{
border-bottom:black thin solid;
}
.border-left{
border-left:black thin solid;
}
.border-left-right{
border-left:black thin solid;
border-right:black thin solid;
}
.boxcheck{
	border:black thin solid;
	width:10px;
	height:10px;
}

</style>
</head>

<body>
<table width="700" border="0" cellpadding="0" cellspacing="0">
  <tbody>
  	<tr>
      <td colspan="5" align="right"><strong>FR01R.19</strong></td>
    </tr>
    <tr>
      <td colspan="2" class="border-it">
      	<table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tbody>
          	<tr valign="middle">
              <td width="16%" height="70" align="right"><img src="<?php echo base_url('assets/img/logo_sariasih.png'); ?>" alt="" width="53" height="57"></td>
              <td width="84%" align="center"><strong>RUMAH SAKIT SARI ASIH<br>
                  KARAWACI<br></strong>
                 	<font size="1">Jl. Imam Bonjol No.38 Karawaci-Kota Tangerang 15113<br>
              		Telp. (021) 552 2794 (Hunting) Fax. (021) 552 5214</font></td>
            </tr> 
          </tbody>
        </table>
      </td>
      <td colspan="3" align="right" class="border-it">
      <table width="100%" style="border:none;">
        <tbody>
          <tr>
            <td width="31%">Nama Pasien</td>
            <td width="69%">: <?php echo $rs['nama_pasien']; ?></td>
          </tr>
          <tr>
            <td>Tgl.Lahir/Umur</td>
            <td>: <?php echo $rs['birthdate']; ?></td>
          </tr>
          <tr>
            <td>No.RM</td>
            <td>: <?php echo $rs['id_pasien']; ?></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td colspan="3" rowspan="7" align="center" class="border-it">
        
        <table width="90%">
        	<tr>
          	<td align="center"><strong>Bismillahirrahmanirrahiim</strong></td>
          </tr>
          <tr>
          	<td height="470">asdasdasdasda asd asd asasdasda asd asd asdadasdas</td>
          </tr>
          <tr>
          	<td align="center"><em><strong>&quot;Dan apabila aku sakit, Dia-lah yang menyembuhkan ku&quot;</strong><br>
        (QS. As-Syu'ara',26:80)</em></td>
          </tr>
        </table>
      </td>
      <td colspan="2" class="border-it">Berat Badan : <br>
      	Ruangan :</td>
    </tr>
    <tr>
      <td colspan="2" class="border-it" valign="middle" align="center"><br>dr :<?php echo $rs['dokter']; ?><br>&nbsp;</td>
    </tr>	
    <tr>
      <td colspan="2" class="border-it">Tgl : <?php echo $rs['eresepdate']; ?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="border-it">Riwayat Alergi Obat<br>&nbsp;<br>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="border-it">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td colspan="2" align="center" class="border-it"><strong>PENELAAHAN RESEP</strong></td>
            <td width="12%" align="center" class="border-it"><strong>YA</strong></td>
            <td width="24%" align="center" class="border-it"><strong>TIDAK</strong></td>
          </tr>
          <tr>
            <td width="8%" align="center">1.</td>
            <td width="56%">Tulisan dokter jelas</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">2.</td>
            <td>Identitas pasien benar</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">3.</td>
            <td>Obat benar</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">4.</td>
            <td>Dosis benar</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">5.</td>
            <td>Jumlah obat benar</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">6.</td>
            <td>Waktu dan frekwensi pemberian obat benar</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">7.</td>
            <td>Cara pemberian obat benar</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">8.</td>
            <td>Polifarmasi ada</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">9.</td>
            <td>Duplikat terapi ada</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">10</td>
            <td>ESO yang mungkin terjadi ada</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">11</td>
            <td>Interaksi obat ada</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td colspan="2" align="center" class="border-it"><strong>PENELAAHAN OBAT</strong></td>
            <td align="center" class="border-it"><strong>YA</strong></td>
            <td align="center" class="border-it"><strong>TIDAK</strong></td>
          </tr>
          <tr>
            <td align="center">1.</td>
            <td>Tepat identitas</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">2.</td>
            <td>Tepat obat</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">3.</td>
            <td>Tepat dosis</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">4.</td>
            <td>Tepat rule</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
          <tr>
            <td align="center">5.</td>
            <td>Tepat Waktu</td>
            <td align="center" class="border-left-right"><div class="boxcheck"></div></td>
            <td align="center"><div class="boxcheck"></div></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td colspan="2">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <td width="25%" align="center" class="border-it"><strong>H</strong><br>(Harga)</td>
            <td width="25%" align="center" class="border-it"><strong>T</strong><br>(Teknik)</td>
            <td width="25%" align="center" class="border-it"><strong>K</strong><br>(Kemas)</td>
            <td width="25%" align="center" class="border-it"><strong>P</strong><br>(Penyerahan)</td>
            </tr>
          <tr>
            <td align="center" class="border-it">&nbsp;<br>&nbsp;</td>
            <td align="center" class="border-it">&nbsp;</td>
            <td align="center" class="border-it">&nbsp;</td>
            <td align="center" class="border-it">&nbsp;</td>
            </tr>
          </tbody>
      </table></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="border-it">Menerima Obat Beserta Informasi<br>
      <br>
      <br>
      ( Pasien . Keluarga )</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="border-it">Perubahan Resep</td>
      <td width="20%" rowspan="2" align="center" class="border-it">Petugas Farmasi</td>
      <td width="26%" rowspan="2" align="center" class="border-it">Disetujui</td>
    </tr>
    <tr align="center">
      <td width="33%" class="border-it">Tertulis</td>
      <td colspan="2" class="border-it">Menjadi</td>
    </tr>
    <tr>
      <td align="center" class="border-it">&nbsp;<br>&nbsp;</td>
      <td colspan="2" align="center" class="border-it">&nbsp;</td>
      <td align="center" class="border-it">&nbsp;</td>
      <td align="center" class="border-it">&nbsp;</td>
    </tr>
  </tbody>
</table>
</body>
</html>
