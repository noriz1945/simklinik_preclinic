<?php
//////////////setup
// create new PDF document
$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$obj_pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
// set document information
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetAuthor('RHR');
$obj_pdf->SetTitle('PO '.$no_pj);
$obj_pdf->SetSubject('RHR');

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

<table border="0" width="100%" style="border-collapse: collapse;padding: 5px;">
<tr>
    <td style="border-top-width:1pt;text-align: left;vertical-align: middle;height: 20px;" width="47%">Kepada : <b><?php echo $row_1_a; ?></b></td>
    <td width="3%">&nbsp;</td>
    <td width="3%">&nbsp;</td>
    <td style="border-top-width:1pt;text-align: left;vertical-align: middle;height: 20px;" width="47%">PURCHASE ORDER</td>
</tr>
<tr>
    <td style="border-top-width:1pt;text-align: left;vertical-align: middle;height: 20px;font-weight:bold;" width="47%">&nbsp;</td>
    <td width="3%">&nbsp;</td>
    <td width="3%">&nbsp;</td>
    <td style="border-top-width:1pt;text-align: left;vertical-align: middle;height: 20px;font-weight:bold;" width="47%">&nbsp;</td>
</tr>
<tr>
    <td rowspan="2" style="text-align: left;vertical-align: middle;" width="50%"><?php echo $row_1_b; ?></td>
    <td width="3%">&nbsp;</td>
    <td width="3%">&nbsp;</td>
    <td style="text-align: left;vertical-align: middle;" width="22%">Nomor</td>
    <td style="text-align: left;vertical-align: middle;" width="22%"> : <?php echo $no_pj; ?></td>
</tr>
<tr>
    <td width="3%">&nbsp;</td>
    <td width="3%">&nbsp;</td>
    <td style="text-align: left;vertical-align: middle;" width="22%">Tanggal PO</td>
    <td style="text-align: left;vertical-align: middle;" width="22%"> : <?php echo $tgl_pj; ?></td>
</tr>

</table>


<br>
<table style="border-collapse: collapse;padding: 5px;" cellspacing="0" border="0" width="100%">
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;height: 20px;" width="8%">NO</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="12%">Kode Barang</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="28%">Nama Barang</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="10%">Kts.</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="17%">@Harga</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="10%">Diskon</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-right-width:1pt;text-align: center;vertical-align: middle;" width="15%">Total Harga</td>
</tr>
<?php $no=1; 
    $terbilangset=0;
    $subtotalset=0;
    $diskonset=0;
foreach($datalist as $dtlistpenjualan){ 
    $terbilangset += $dtlistpenjualan->subtotal;
    $subtotalset += $dtlistpenjualan->jumlah * $dtlistpenjualan->harga_satuan;
    $diskonset += $dtlistpenjualan->jumlah * $dtlistpenjualan->diskon_item;
    $totalall = $subtotalset - $diskonset;
?>
<tr>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: left;vertical-align: middle;"><?php echo $no++; ?></td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: left;vertical-align: middle;"><?php echo $dtlistpenjualan->id_bahan; ?></td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: left;vertical-align: middle;"><?php echo $dtlistpenjualan->nama_bahan; ?></td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: left;vertical-align: middle;"><?php echo number_format($dtlistpenjualan->jumlah,0); ?></td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: left;vertical-align: middle;"><?php echo number_format($dtlistpenjualan->harga_satuan,0); ?></td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: left;vertical-align: middle;"><?php echo number_format($dtlistpenjualan->diskon_item,0); ?></td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: left;vertical-align: middle;"><?php echo number_format($dtlistpenjualan->subtotal,0); ?></td>
</tr>
<?php } ?>


<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;text-align: left;vertical-align: middle;" width="40%">Alamat Pengiriman :</td>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;text-align: left;vertical-align: middle;height: 20px;" width="15%">Sub Total</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;text-align: right;vertical-align: middle;height: 20px;" width="25%"><b><?php echo number_format($subtotalset,0); ?></b></td>
</tr>

<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="15%">Diskon</td>
    <td style="text-align: right;vertical-align: middle;height: 20px;" width="25%"><b><?php echo number_format($diskonset,0); ?></b></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr>
    <td rowspan="3" style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: left;vertical-align: middle;height: 20px;" width="40%"><b><?php echo $alamat_pengiriman; ?></b></td>
    <td style="text-align: center;vertical-align: middle;height: 20px;" width="20%">&nbsp;</td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="15%">PPN ( % )</td>
    <td style="text-align: right;vertical-align: middle;height: 20px;" width="25%"><b>0</b></td>
</tr>
<tr>
    <td style="text-align: center;vertical-align: middle;height: 20px;" width="20%">&nbsp;</td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="15%">Biaya Lain - Lain</td>
    <td style="text-align: right;vertical-align: middle;height: 20px;" width="25%"><b>0</b></td>
</tr>
<tr>
    <td style="text-align: center;vertical-align: middle;height: 20px;" width="20%">&nbsp;</td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;text-align: left;vertical-align: middle;height: 20px;" width="15%"><b>Total</b></td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;text-align: right;vertical-align: middle;height: 20px;" width="25%"><b><?php echo number_format($totalall,0); ?></b></td>
</tr>

<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;text-align: left;vertical-align: middle;" width="40%">Keterangan :</td>
    <td width="10%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
</tr>

<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr>
    <td rowspan="3" style="border-style: solid;border-width: thin;border-top-width:1pt;border-bottom-width:1pt;border-left-width:1pt;border-right-width:1pt;text-align: left;vertical-align: middle;height: 20px;" width="40%"><b><?php echo $keterangan; ?></b></td>
    <td style="text-align: center;vertical-align: middle;height: 20px;" width="50%">&nbsp;</td>
</tr>
<tr>
    <td style="text-align: center;vertical-align: middle;height: 20px;" width="10%">&nbsp;</td>
</tr>
<tr>
    <td style="text-align: center;vertical-align: middle;height: 20px;" width="10%">&nbsp;</td>
</tr>

<tr>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="15%">Dibuat Oleh</td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: right;vertical-align: middle;height: 20px;" width="15%">Diketahui</td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: right;vertical-align: middle;height: 20px;" width="15%">Disetujui</td>
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
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;text-align: center;vertical-align: middle;height: 20px;" width="15%"><?php echo $created_by; ?><br>Admin</td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;text-align: center;vertical-align: middle;height: 20px;" width="15%"><?php echo $mengetahui_atasan; ?><br>SPV Finance & Accounting</td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="text-align: left;vertical-align: middle;height: 20px;" width="5%"></td>
    <td style="border-style: solid;border-width: thin;border-top-width:1pt;text-align: center;vertical-align: middle;height: 20px;" width="15%">Vendor</td>
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
$obj_pdf->Output("PO ".$no_pj.".pdf");
?>