<?php
//////////////setup
// create new PDF document
$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
// set document information
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetAuthor('Rihan HR');
$obj_pdf->SetTitle('PDF Print SP');
$obj_pdf->SetSubject('RSSA SUPPORT');

// remove default header/footer
$obj_pdf->setPrintHeader(false);
$obj_pdf->setPrintFooter(false);

// set default monospaced font
$obj_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$obj_pdf->SetMargins(10, PDF_MARGIN_TOP, 10);
$obj_pdf->SetMargins(2, PDF_MARGIN_LEFT, 2);
$obj_pdf->SetMargins(2, PDF_MARGIN_RIGHT, 2);

// set auto page breaks
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$obj_pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');

// set font
$obj_pdf->SetFont('times', 'B', 20);
///////////////end setup

//////////////////////////////cover MCU
//cover MCU
// add a page
ob_start();
$obj_pdf->AddPage('P', 'A4');
$obj_pdf->SetHeaderData(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, "", PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, "", PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont("helvetica");

$obj_pdf->SetFont("helvetica", "", 7);
$obj_pdf->setFontSubsetting(false);
// set bacground image
?>
<html>
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <style type="text/css">
    a {text-decoration: none}
  </style>
</head>
<body text="#000000" link="#000000" alink="#000000" vlink="#000000">

<table style="width: 595px; border-collapse: collapse" cellpadding="0" cellspacing="0" border="0" bgcolor="white">
<tr>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 71px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 1px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 1px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 23px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 1px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 16px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 10px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 125px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 1px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 13px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 1px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 20px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 2px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 9px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 19px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 1px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 61px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 115px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 2px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 10px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 16px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 1px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 1px; height: 1px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 75px; height: 1px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 94px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 71px; height: 14px;"/></td>
  <td colspan="16" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Tangerang Selatan, <?php echo $datenows; ?> </span></td>
  <td colspan="7"><img alt="" src="print sp sample.html_files/px" style="width: 220px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 20px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 71px; height: 14px;"/></td>
  <td colspan="13" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Kepada Yth,</span></td>
  <td colspan="10"><img alt="" src="print sp sample.html_files/px" style="width: 301px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 73px; height: 38px;"/></td>
  <td colspan="11" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px; font-weight: bold;">Kepala Cabang<br/>BANK SYARIAH INDONESIA (BSI)<br/>BSD City</span></td>
  <td colspan="10"><img alt="" src="print sp sample.html_files/px" style="width: 301px; height: 38px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 71px; height: 28px;"/></td>
  <td colspan="13"><span style="font-family: Arial; color: #000000; font-size: 10px;">di-<br/>Tempat</span></td>
  <td colspan="10"><img alt="" src="print sp sample.html_files/px" style="width: 301px; height: 28px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 28px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 73px; height: 14px;"/></td>
  <td colspan="3" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px; font-weight: bold;">Hal</span></td>
  <td valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 10px; font-weight: bold;">:</span></td>
  <td colspan="12" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px; font-weight: bold;">Transfer / Pemindah Bukuan Uang</span></td>
  <td colspan="5"><img alt="" src="print sp sample.html_files/px" style="width: 103px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 23px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 73px; height: 14px;"/></td>
  <td colspan="16" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Assalamu'alaikum Wr. Wb,</span></td>
  <td colspan="5"><img alt="" src="print sp sample.html_files/px" style="width: 103px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 9px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 73px; height: 14px;"/></td>
  <td colspan="18" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Dengan ini kami minta agar atas beban rekening rupiah PT. SARI ASIH MANGUN PERSADA</span></td>
  <td colspan="3"><img alt="" src="print sp sample.html_files/px" style="width: 77px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 73px; height: 14px;"/></td>
  <td colspan="18" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Rek. No. </span><span style="font-family: Arial; color: #000000; font-size: 10px; font-weight: bold; text-decoration: underline;">39393838</span><span style="font-family: Arial; color: #000000; font-size: 10px;">, saudara Transfer / Pindah Bukuan uang :</span></td>
  <td colspan="3"><img alt="" src="print sp sample.html_files/px" style="width: 77px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 22px;"/></td>
</tr>
<tr valign="top">
  <td colspan="3"><img alt="" src="print sp sample.html_files/px" style="width: 96px; height: 14px;"/></td>
  <td colspan="5" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Sejumlah</span></td>
  <td colspan="1" valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 10px;">:</span></td>
  <td colspan="2"><img alt="" src="print sp sample.html_files/px" style="width: 21px; height: 14px;"/></td>
  <td colspan="10"><span style="font-family: Arial; color: #000000; font-size: 10px; font-weight: bold;">Rp. <?php echo number_format($total,0); ?>,-</span></td>
  <td colspan="2"><img alt="" src="print sp sample.html_files/px" style="width: 76px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="11"><img alt="" src="print sp sample.html_files/px" style="width: 283px; height: 34px;"/></td>
  <td colspan="9"><span style="font-family: Arial; color: #000000; font-size: 10px;">(<?php echo $setterbilang; ?> Rupiah)</span></td>
  <td colspan="3"><img alt="" src="print sp sample.html_files/px" style="width: 77px; height: 34px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 11px;"/></td>
</tr>
<tr valign="top">
  <td colspan="3"><img alt="" src="print sp sample.html_files/px" style="width: 96px; height: 14px;"/></td>
  <td colspan="5" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Kepada</span></td>
  <td colspan="1" valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 10px;">:</span></td>
  <td colspan="2"><img alt="" src="print sp sample.html_files/px" style="width: 23px; height: 14px;"/></td>
  <td colspan="10" rowspan="2"><span style="font-family: Arial; color: #000000; font-size: 10px;">Supplier RS. Sari Asih Ciputat Sebanyak <?php echo $setttlsplr; ?> (<?php echo $setterttlsplr; ?>) suplier <br/>(Daftar terlampir)</span></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 75px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="13"><img alt="" src="print sp sample.html_files/px" style="width: 285px; height: 29px;"/></td>
  <td><img alt="" src="print sp sample.html_files/px" style="width: 75px; height: 29px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 10px;"/></td>
</tr>
<tr valign="top">
  <td colspan="3"><img alt="" src="print sp sample.html_files/px" style="width: 96px; height: 14px;"/></td>
  <td colspan="5" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Pada hari/tanggal</span></td>
  <td colspan="1" valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 10px;">:</span></td>
  <td colspan="2"><img alt="" src="print sp sample.html_files/px" style="width: 21px; height: 14px;"/></td>
  <td colspan="10"><span style="font-family: Arial; color: #000000; font-size: 10px; font-weight: bold;"><?php echo $tgltf; ?></span></td>
  <td colspan="2"><img alt="" src="print sp sample.html_files/px" style="width: 76px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 10px;"/></td>
</tr>
<tr valign="top">
  <td colspan="3"><img alt="" src="print sp sample.html_files/px" style="width: 96px; height: 14px;"/></td>
  <td colspan="5" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Keterangan Transaksi</span></td>
  <td colspan="1" valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 10px;">:</span></td>
  <td colspan="2"><img alt="" src="print sp sample.html_files/px" style="width: 21px; height: 14px;"/></td>
  <td colspan="10"><span style="font-family: Arial; color: #000000; font-size: 10px; font-weight: bold;">Obat (Sesuai Lampiran) RS. Sari Asih Ciputat Jatuh Tempo <?php echo $tgljtm; ?></span></td>
  <td colspan="2"><img alt="" src="print sp sample.html_files/px" style="width: 76px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="12"><img alt="" src="print sp sample.html_files/px" style="width: 283px; height: 20px;"/></td>
  <td colspan="4"><img alt="" src="print sp sample.html_files/px" style="width: 93px; height: 20px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 10px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 71px; height: 45px;"/></td>
  <td colspan="20"><span style="font-family: Arial; color: #000000; font-size: 10px;">Biaya transfer dapat langsung Bapak debet dari rekening kami tersebut. Kami harap tiket sudah dapat kami terima paling lambat hari Senin, <?php echo $tgltkt; ?>. Sambil menunggu pelaksanaannya dari saudara, kami ucapkan terima kasih.</span></td>
  <td colspan="3"><img alt="" src="print sp sample.html_files/px" style="width: 77px; height: 45px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 28px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 71px; height: 14px;"/></td>
  <td colspan="17" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Wassalamu'alaikum Wr. Wb,</span></td>
  <td colspan="6"><img alt="" src="print sp sample.html_files/px" style="width: 105px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 53px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="print sp sample.html_files/px" style="width: 71px; height: 14px;"/></td>
  <td colspan="14" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px; font-weight: bold; text-decoration: underline;">Hj. Ocktariana H. Safitri, SE, M.Kes</span></td>
  <td colspan="9"><img alt="" src="print sp sample.html_files/px" style="width: 282px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 1px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 1px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 1px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 1px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 1px;"/></td>
</tr>
<tr valign="top">
  <td colspan="2"><img alt="" src="print sp sample.html_files/px" style="width: 72px; height: 14px;"/></td>
  <td colspan="14" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 10px;">Direktur Keuangan</span></td>
  <td colspan="8"><img alt="" src="print sp sample.html_files/px" style="width: 281px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="24"><img alt="" src="print sp sample.html_files/px" style="width: 595px; height: 147px;"/></td>
</tr>
</table>

</body>
</html>
<?php
$out3_sum1 = ob_get_contents();
$obj_pdf->writeHTML($out3_sum1, true, false, true, false, "");

ob_end_clean(); //end MCU
?>
<?php
$obj_pdf->Output($nosp.".pdf");
?>