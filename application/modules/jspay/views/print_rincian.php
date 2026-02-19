<?php
//////////////setup
// create new PDF document
$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
// set document information
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetAuthor('Username');
$obj_pdf->SetTitle('PDF Print Gaji Dokter');
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

<table style="width: 100%; border-collapse: collapse" cellpadding="0" cellspacing="0" border="0" bgcolor="white">
<tr>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 32px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 48px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 14px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 17px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 95px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 49px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 88px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 82px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 65px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 170px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 64px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 61px; height: 1px;"/></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 30px; height: 1px;"/></td>
</tr>
<tr valign="top">
  <td colspan="14"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 51px;"/></td>
</tr>
<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 36px;"/></td>
  <td colspan="12" valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 10px;">SLIP GAJI DOKTER</span></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 30px; height: 36px;"/></td>
</tr>
<br>
<tr valign="top">
  <td colspan="14"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 1px;"/></td>
</tr>
<tr valign="top">
<td>&nbsp;</td><td>Nama</td><td>:</td><td colspan="3"><?php echo $name; ?></td>
<td colspan="2">&nbsp;</td><td colspan="2">Periode Pembayaran</td><td>:</td><td colspan="3"><?php echo $datenows; ?></td>
</tr>
<br>
<tr valign="top">
<td>&nbsp;</td><td>Spesialist</td><td>:</td><td colspan="3"><?php echo $name_spes; ?></td>
</tr>
<tr valign="top">
  <td colspan="14"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 2px;"/></td>
</tr>

<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 25px;"/></td>
  <td colspan="12" valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 8px;font-weight: bold;"><br>PENGHASILAN<br></span></td>
</tr>
<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 22px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp;1. Jasa / Tindakan Medis&nbsp;<br></span></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp; <?php echo number_format($penghasilan_set,0); ?>&nbsp;<br></span></td>
</tr>
<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 25px;"/></td>
  <td colspan="12" valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 8px;font-weight: bold;"><br>PENGHASILAN TAMBAHAN<br></span></td>
</tr>
<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 22px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp;1. Upah Pokok&nbsp;<br></span></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp; <?php echo number_format($penghasilan_add_1_set,0); ?>&nbsp;<br></span></td>
</tr>

<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 22px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp;2. Tunjangan Fungsional&nbsp;<br></span></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp; <?php echo number_format($penghasilan_add_2_set,0); ?>&nbsp;<br></span></td>
</tr>

<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 22px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp;3. Tunjangan Transport&nbsp;<br></span></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp; <?php echo number_format($penghasilan_add_3_set,0); ?>&nbsp;<br></span></td>
</tr>

<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 22px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp;4. Jasa Medik Rawat Jalan&nbsp;<br></span></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp; <?php echo number_format($penghasilan_add_4_set,0); ?>&nbsp;<br></span></td>
</tr>

<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 25px;"/></td>
  <td colspan="12" valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 8px;font-weight: bold;"><br>POTONGAN TAMBAHAN<br></span></td>
</tr>
<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 22px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp;1. Bon Biaya berobat&nbsp;<br></span></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp; <?php echo number_format($penghasilan_min_1_set,0); ?>&nbsp;<br></span></td>
</tr>

<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 25px;"/></td>
  <td colspan="12" valign="middle" style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 8px;font-weight: bold;"><br>TOTAL<br></span></td>
</tr>
<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 22px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;font-weight: bold;"><br>&nbsp;TOTAL PENGHASILAN &nbsp;<br></span></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp; <?php echo number_format($penghasilan_total_set,0); ?>&nbsp;<br></span></td>
</tr>

<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 22px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;font-weight: bold;"><br>&nbsp;TOTAL POTONGAN&nbsp;<br></span></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp; <?php echo number_format($penghasilan_min_set,0); ?>&nbsp;<br></span></td>
</tr>

<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 22px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;font-weight: bold;"><br>&nbsp;GRAND TOTAL&nbsp;<br></span></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 8px;"><br>&nbsp; <?php echo number_format($penghasilan_grand_set,0); ?>&nbsp;<br></span></td>
</tr>


<!--<tr valign="top">
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 27px; height: 14px;"/></td>
  <td colspan="9" valign="middle" style="border-top-style: solid; border-top-width: 1px; border-top-color: #000000; border-left-style: solid; border-left-width: 1px; border-left-color: #000000; padding-left: 2px; border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: #000000; border-right-style: solid; border-right-width: 1px; border-right-color: #000000; padding-right: 2px; text-align: right;"><span style="font-family: Arial; color: #000000; font-size: 9px; font-weight: bold;"><br>Total : &nbsp;<br></span></td>
  <td colspan="3" valign="middle" style="border-top-style: solid; border-top-width: 1px; border-top-color: #000000; border-left-style: solid; border-left-width: 1px; border-left-color: #000000; padding-left: 2px; border-bottom-style: solid; border-bottom-width: 1px; border-bottom-color: #000000; border-right-style: solid; border-right-width: 1px; border-right-color: #000000; padding-right: 2px; text-align: left;"><span style="font-family: Arial; color: #000000; font-size: 9px; font-weight: bold;"><br>&nbsp; <?php echo number_format($total,0); ?><br></span></td>
  <td><img alt="" src="rincian spb sample.html_files/px" style="width: 30px; height: 14px;"/></td>
</tr>-->
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 1px;"/></td>
</tr>
<tr valign="top">
  <td colspan="1"><img alt="" src="rincian spb sample.html_files/px" style="width: 40px; height: 14px;"/></td>
  <td colspan="1"><span style="font-family: Arial; color: #000000; font-size: 9px;">Terbilang</span></td>
  <td style="text-align: center;"><span style="font-family: Arial; color: #000000; font-size: 9px;">:</span></td>
  <td colspan="10"><span style="font-family: Arial; color: #000000; font-size: 9px;"># <?php echo $setterbilang; ?> Rupiah #</span></td>
  <td colspan="2"><img alt="" src="rincian spb sample.html_files/px" style="width: 91px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 15px;"/></td>
</tr>
<!--<tr valign="top">
  <td colspan="1"><img alt="" src="rincian spb sample.html_files/px" style="width: 107px; height: 14px;"/></td>
  <td colspan="6" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 9px;">Tangerang Selatan, <?php echo $datenows; ?></span></td>
  <td colspan="3"><img alt="" src="rincian spb sample.html_files/px" style="width: 117px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 37px;"/></td>
</tr>
<tr valign="top">
  <td colspan="1"><img alt="" src="rincian spb sample.html_files/px" style="width: 107px; height: 14px;"/></td>
  <td colspan="9"><img alt="" src="rincian spb sample.html_files/px" style="width: 519px; height: 14px;"/>Menyetujui,</td>
  <td colspan="2" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 9px;">Pembuat Laporan,</span></td>
  <td colspan="3"><img alt="" src="rincian spb sample.html_files/px" style="width: 117px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 37px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 37px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 37px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 37px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 37px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 37px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 37px;"/></td>
</tr>
<tr valign="top">
  <td colspan="17"><img alt="" src="rincian spb sample.html_files/px" style="width: 842px; height: 37px;"/></td>
</tr>
<tr valign="top">
  <td colspan="1"><img alt="" src="rincian spb sample.html_files/px" style="width: 107px; height: 14px;"/></td>
  <td colspan="3" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 9px; text-decoration: underline;">Hj. Octariana H. Safitri, SE, M.Kes</span></td>
  <td colspan="6"><img alt="" src="rincian spb sample.html_files/px" style="width: 206px; height: 14px;"/></td>
  <td colspan="2" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 9px; text-decoration: underline;">EDP</span></td>
  <td colspan="3"><img alt="" src="rincian spb sample.html_files/px" style="width: 117px; height: 14px;"/></td>
</tr>
<tr valign="top">
  <td colspan="1"><img alt="" src="rincian spb sample.html_files/px" style="width: 107px; height: 14px;"/></td>
  <td colspan="3" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 9px;">Ka. Div. Keuangan</span></td>
  <td colspan="6"><img alt="" src="rincian spb sample.html_files/px" style="width: 206px; height: 14px;"/></td>
  <td colspan="2" valign="middle"><span style="font-family: Arial; color: #000000; font-size: 9px;">Staf Admin</span></td>
  <td colspan="3"><img alt="" src="rincian spb sample.html_files/px" style="width: 117px; height: 14px;"/></td>
</tr>-->
</table>
<br/>
<br/>

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