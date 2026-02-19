<?php
$tglnow = DATE('Y-m-d');
//////////////setup
// create new PDF document
$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
// set document information
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetAuthor('FastClinic');
$obj_pdf->SetTitle('STOK OPNAME '.$id_rpo);
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
<h4>SURAT PESANAN <?php echo $id_rpo; ?></h4>
<table border="0" width="100%">
	<tr>
		<td style="text-align:left;font-size:7pt;height: 20px;" width="100%">Mengajukan permohonan pemesanan obat kepada,</td>
	</tr>
	<tr>
		<td style="text-align:left;font-size:7pt;height: 20px;" width="15%">PBF </td>
		<td style="text-align:left;font-size:7pt;" width="5%">:</td>
		<td style="text-align:left;font-size:7pt;word-wrap: break-word" width="80%"><?php echo $nama_pabrik; ?></td>
	</tr>
	<tr>
		<td style="text-align:left;font-size:7pt;height: 20px;" width="15%">Alamat </td>
		<td style="text-align:left;font-size:7pt;" width="5%">:</td>
		<td style="text-align:left;font-size:7pt;word-wrap: break-word" width="80%"><?php echo $alamat_pabrik; ?></td>
	</tr>
	<tr>
		<td style="text-align:left;font-size:7pt;height: 20px;" width="100%">Jenis Obat sebagai berikut : </td>
	</tr>
</table>
<br><br>
<table border="0" width="100%">
   <tr>
	<td style="text-align:left;font-size:7pt;height: 20px;" width="5%"><strong>#</strong></td>
	<td style="text-align:left;font-size:7pt;height: 20px;" width="35%"><strong>NAMA OBAT</strong></td>
	<td style="text-align:left;font-size:7pt;" width="15%"><strong>SATUAN</strong></td>
	<td style="text-align:left;font-size:7pt;" width="45%"><strong>JUMLAH</strong></td>
   </tr>
<?php  $no=1;
foreach($datasp as $dt1){
?>


   <tr>
	<td style="text-align:left;font-size:7pt;height: 20px;" width="5%"><strong><?php echo $no++; ?></strong></td>
	<td style="text-align:left;font-size:7pt;" width="35%"><strong><?php echo $dt1->nama_obat; ?></strong></td>
	<td style="text-align:left;font-size:7pt;" width="15%"><strong><?php echo $dt1->nama_satuan; ?></strong></td>
	<td style="text-align:left;font-size:7pt;" width="45%"><strong><?php echo number_format($dt1->qty_req,0); ?></strong></td>
   </tr>


   <?php } ?>

 </table>




</body>
</html>
<?php 
$out3_sum1 = ob_get_contents();
$obj_pdf->writeHTML($out3_sum1, true, false, true, false, "");

ob_end_clean(); //end MCU
$obj_pdf->Output("List_stokopname".$tglnow.".pdf");
?>

