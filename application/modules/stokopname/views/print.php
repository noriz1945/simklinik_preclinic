<?php
$tglnow = DATE('Y-m-d');
//////////////setup
// create new PDF document
$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
// set document information
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetAuthor('FastClinic');
$obj_pdf->SetTitle('STOK OPNAME '.$id_sto);
$obj_pdf->SetSubject('FastClinic');

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

$obj_pdf->SetFont("helvetica", "", 12);
$obj_pdf->setFontSubsetting(false);
// set bacground image

$logoX = 5; // 
$logoFileName = K_PATH_IMAGES.'logo-main.jpg';
$logoWidth = 30; // 15mm
$logoY = 5;
$logo = $obj_pdf->Image($logoFileName, $logoX, $logoY, $logoWidth,10);
?>
<!doctype html>
<html>
<body>
<h4>STOK OPNAME ID <?php echo $id_sto; ?></h4>
<table border="0" width="100%">
   <tr>
	<td style="text-align:left;font-size:7pt;height: 20px;" width="5%"><strong>#</strong></td>
	<td style="text-align:left;font-size:7pt;height: 20px;" width="35%"><strong>OBAT</strong></td>
	<td style="text-align:left;font-size:7pt;" width="15%"><strong>NO RAK</strong></td>
	<td style="text-align:left;font-size:7pt;" width="20%"><strong>QTY LAST</strong></td>
	<td style="text-align:left;font-size:7pt;" width="25%"><strong>JUMLAH</strong></td>
   </tr>
<?php  $no=1;
foreach($liststo as $dt1){
?>


   <tr>
	<td style="text-align:left;font-size:7pt;height: 20px;" width="5%"><strong><?php echo $no++; ?></strong></td>
	<td style="text-align:left;font-size:7pt;" width="35%"><strong><?php echo $dt1->nama_obat; ?></strong></td>
	<td style="text-align:left;font-size:7pt;" width="15%"><strong><?php echo $dt1->no_rak; ?></strong></td>
	<td style="text-align:left;font-size:7pt;" width="20%"><strong><?php echo number_format($dt1->qty_soh,0); ?></strong></td>
	<td style="text-align:left;font-size:7pt;" width="25%"><strong>[<?php for ($x = 0; $x <= 30; $x++) { echo "&nbsp;";}
 ?>]</strong></td>
   </tr>


   <?php } ?>
   <br><br>
   <tr><td style="text-align:left;font-size:7pt;height: 20px;" width="100%"><strong>Catatan</strong></td></tr>
   <tr>
	<td style="text-align:left;font-size:7pt;height: 20px;word-wrap: break-word" width="100%"><?php echo $set_catatan; ?></td>
   </tr>
 </table>




</body>
</html>
<?php 
$out3_sum1 = ob_get_contents();
$obj_pdf->writeHTML($out3_sum1, true, false, true, false, "");

ob_end_clean(); //end MCU
$obj_pdf->Output("List_stokopname".$tglnow.".pdf");
?>

