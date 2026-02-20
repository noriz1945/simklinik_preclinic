<?php
//////////////setup
// create new PDF document
$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
// set document information
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetAuthor('Rihan HR');
$obj_pdf->SetTitle('PDF Print Rincian Invoice');
$obj_pdf->SetSubject('HAN');

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

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
}

function terbilang($nilai){
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }     		
    return $hasil;
}

function tanggal_indo($tanggal, $cetak_hari = false){
    $hari = array ( 1 =>    'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            );
            
    $bulan = array (1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
    $split 	  = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    
    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}
?>
<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="id" lang="id">
    <body>
        <h3 style="padding-top: 3pt;text-indent: 0pt;text-align: right;">{NAMA_KLINIK}</h3>
        <h4 style="padding-top: 3pt;padding-left: 417pt;text-indent: 6pt;line-height: 120%;text-align: right;">{ALAMAT_KLINIK} <br/> Telp : {TELP_KLINIK}, Fax : {FAX_KLINIK}</h4>
        <p style="text-indent: 0pt;text-align: left;"><br/></p>
        <p style="text-indent: 0pt;text-align: left;"><br/></p>
        <h1 style="padding-top: 4pt;padding-left: 194pt;text-indent: 0pt;text-align: center;">INVOICE</h1>
        <p style="padding-top: 3pt;padding-left: 192pt;text-indent: 0pt;text-align: center;"><?php echo $id_reg_set; ?></p>

        <table border="0" width="100%">
        <tr>
            <td width="20%">Atas Nama</td>
            <td width="5%">:</td>
            <td width="25%"><?php echo $name_set; ?></td>

            <td width="20%">No. MR</td>
            <td width="5%">:</td>
            <td width="25%"><?php echo $id_pasien_set; ?></td>
        </tr>

        <tr>
            <td width="20%">Alamat</td>
            <td width="5%">:</td>
            <td width="25%"><?php echo $alamat_set; ?></td>

            <td width="20%">No. Registrasi</td>
            <td width="5%">:</td>
            <td width="25%"><?php echo $id_reg_set; ?></td>
        </tr>

        <tr>
            <td width="20%">&nbsp;</td>
            <td width="5%">&nbsp;</td>
            <td width="25%">&nbsp;</td>

            <td width="20%">Tanggal</td>
            <td width="5%">:</td>
            <td width="25%"><?php $regdate=date_create($tanggal_set); $regdate_set=date_format($regdate,"Y-m-d"); echo tanggal_indo($regdate_set); ?></td>
        </tr>

        <tr>
            <td width="20%">Penanggung</td>
            <td width="5%">:</td>
            <td width="25%"><?php echo $penanggung_set; ?></td>

            <td width="20%">No. Polis</td>
            <td width="5%">:</td>
            <td width="25%"><?php echo $polis_set; ?></td>
        </tr>

        <tr>
            <td width="20%">Penjamin</td>
            <td width="5%">:</td>
            <td width="25%"><?php echo $penjamin_set; ?></td>

            <td width="20%">Asal Perusahaan</td>
            <td width="5%">:</td>
            <td width="25%"><?php echo $asperu_set; ?></td>
        </tr>

        </table>


<br>
<table style="border-collapse:collapse;margin-left:5.46pt" cellspacing="0" border="0" width="100%">
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;height: 20px;" width="8%">Tanggal</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="52%">Deskripsi</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="3%">Qty</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="15%">Biaya (Rp)</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="7%">Disc (Rp)</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="15%">Jumlah</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<?php 
$no_1 =0; $subtotals=0;
foreach($rs_2 as $k2 => $v_2){  ?> 
<tr>
<td colspan="4"><p class="s1" style="padding-top: 1pt;padding-left: 2pt;text-indent: 0pt;text-align: left;"><b><?php echo $v_2['name_group']; ?></b></p></td>
</tr>
<?php 
$subtotals = array();
foreach($v_2['rs_3'] as $k3 => $v_3){ 
  if($v_3['id_paket']==NULL){
    $trxdate = date_create($v_3['trxdate']); 
    $datenyah = date_format($trxdate,"d/m/y");
  }else{
    $trxdate = ""; 
    $datenyah = "";
  }
  $totalwithqty = ($v_3['pricenya'] * $v_3['qtynya']);
$subtotal +=$totalwithqty;
$subtotals[$k2] += $v_3['pricenya'];

?>
<tr>
<td><?php echo $datenyah; ?></td>
<td><?php echo $v_3['name_tind']; ?></td>
<td style="text-align: right;"><?php echo $v_3['qtynya']; ?></td>
<td style="text-align: right;"><?php echo number_format($v_3['pricenya'],0); ?></td>
<td style="text-align: right;">0</td>
<td style="text-align: right;"><?php echo number_format($totalwithqty,0); ?></td>
</tr>

<?php } ?>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td style="text-align: right;">Subtotal :</td>
<td style="text-align: right;">0</td>
<td><p class="s1" style="padding-top: 1pt;padding-right: 1pt;text-indent: 0pt;text-align: right;"><?php echo number_format($subtotals[$k2],0); ?></p></td>
</tr>
<?php  } ?>
<br>
<tr style="height:19pt">
<td style="width:315pt"><p class="s1" style="padding-left: 2pt;text-indent: 0pt;text-align: left;">Terbilang   : # <?php echo penyebut($subtotal); ?> #</p></td>
<td style="width:48pt;border-top-style:solid;border-top-width:1pt"><p style="text-indent: 0pt;text-align: left;"><br/></p></td>
<td style="width:99pt;border-top-style:solid;border-top-width:1pt"><p class="s1" style="padding-top: 1pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">Total (Rp) :</p></td>
<td style="width:36pt;border-top-style:solid;border-top-width:1pt"><p style="text-indent: 0pt;text-align: left;"><br/></p></td>
<td style="width:58pt;border-top-style:solid;border-top-width:1pt"><p class="s1" style="padding-top: 1pt;padding-right: 1pt;text-indent: 0pt;text-align: right;"><?php echo number_format($subtotal,0); ?></p></td>
</tr>

<tr style="height:19pt">
<td style="width:315pt"><p style="text-indent: 0pt;text-align: left;"><br/></p></td>
<td style="width:48pt;border-bottom-style:solid;border-bottom-width:1pt"><p style="text-indent: 0pt;text-align: left;"><br/></p></td>
<td style="width:99pt;border-bottom-style:solid;border-bottom-width:1pt"><p class="s1" style="padding-top: 7pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">Disc. Akhir (Rp) :</p></td>
<td style="width:36pt;border-bottom-style:solid;border-bottom-width:1pt"><p style="text-indent: 0pt;text-align: left;"><br/></p></td>
<td style="width:58pt;border-bottom-style:solid;border-bottom-width:1pt"><p class="s1" style="padding-top: 7pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">0</p></td>
</tr>

<tr style="height:15pt"><td style="width:315pt"><p style="text-indent: 0pt;text-align: left;"><br/></p></td>
<td style="width:48pt;border-top-style:solid;border-top-width:1pt"><p style="text-indent: 0pt;text-align: left;"><br/></p></td>
<td style="width:99pt;border-top-style:solid;border-top-width:1pt"><p class="s1" style="padding-top: 2pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">Grand Total (Rp) :</p></td>
<td style="width:36pt;border-top-style:solid;border-top-width:1pt"><p style="text-indent: 0pt;text-align: left;"><br/></p></td>
<td style="width:58pt;border-top-style:solid;border-top-width:1pt"><p class="s1" style="padding-top: 2pt;padding-right: 1pt;text-indent: 0pt;text-align: right;"><?php echo number_format($subtotal,0); ?></p></td>
</tr>

<tr>
<td><p class="s1"><br/>Cara Pembayaran : Tunai</p></td>
</tr>

</table>

<table>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="20%" style="text-align: center;vertical-align: middle;">Penerima</td>
    <td width="5%">:</td>
    <td width="25%">&nbsp;</td>
 
    <td width="20%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="25%" style="text-align: center;vertical-align: middle;">{NAMA_KLINIK},</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="20%" style="text-align: center;vertical-align: middle;">(.......................................................)</td>
    <td width="5%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
 
    <td width="20%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="25%" style="text-align: center;vertical-align: middle;">(.......................................................)</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="20%" style="text-align: center;vertical-align: middle;"><?php echo tanggal_indo(date('Y-m-d'));  ?></td>
    <td width="5%">&nbsp;</td>
    <td width="25%">&nbsp;</td>
 
    <td width="20%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="25%" style="text-align: center;vertical-align: middle;">KASIR : {USERNAME}</td>
</tr>
<tr>
    <td width="40%" style="text-align: center;vertical-align: middle;">- INVOICE INI BERLAKU SEBAGAI KWITANSI.</td>
    <td width="5%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
 
    <td width="20%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="25%" style="text-align: center;vertical-align: middle;">&nbsp;</td>
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