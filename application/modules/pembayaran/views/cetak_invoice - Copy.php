<!doctype html>
<html>
    <head> <?php #$this->theme->head('theme_default'); ?><title>Fast Clinic - Bina Medika</title>
        <style>
            html * {
                font-size: 13px !important;
                color: #000 !important;
                font-family: Arial !important;
            }

            .setelan_smarthis {}

            .setelan_smarthis tr {
                height: 20px;
            }

            .setelan_smarthis td {
                vertical-align: top;
            }
			.kotak {
				border-top-width: 1px;
				border-right-width: 1px;
				border-bottom-width: 1px;
				border-left-width: 1px;
				border-top-style: solid;
				border-right-style: solid;
				border-bottom-style: solid;
				border-left-style: solid;
				border-top-color: #000000;
				border-right-color: #000000;
				border-bottom-color: #000000;
				border-left-color: #000000;
			}
			.garis_atas {
				border-top-width: 1px;
				border-top-style: solid;
				border-top-color: #000000;
			}
        </style>
    </head>
    <body>
        <table class="setelan_smarthis" width="850" cellspacing="0" cellpadding="0" align="center">
            <col width="89">
            <col width="10">
            <col width="311">
					
            <col width="105">
            <col width="10">
            <col width="125">
            <col width="60">
            <tr>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td width="621" align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="7" align="right"><strong>KLINIK ZIA AESTHETIC</strong></td>
            </tr>
            <tr>
                <td colspan="7" align="right"><strong>JL.  Bhayangkara NO. 1B</strong></td>
            </tr>
            <tr>
                <td colspan="7" align="right"><strong>CIPOCOK JAYA, KOTA SERANG BANTEN</strong></td>
            </tr>
            <tr>
                <td colspan="7" align="center"><strong>INVOICE</strong></td>
            </tr>
            <tr>
                <td colspan="7" align="center"><?php echo $data_inv_header->id_inv ?></td>
            </tr>
            <tr>
                <td>Atas Nama</td>
                <td>:</td>
                <td><?php echo $data_inv_header->name ?></td>
                <td nowrap>No. MR</td>
                <td nowrap>:</td>
                <td colspan="2" nowrap><?php echo $data_inv_header->id_pasien ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $data_inv_header->address ?></td>
                <td nowrap>No. Registrasi</td>
                <td nowrap>:</td>
                <td colspan="2" nowrap><?php echo $data_inv_header->id_reg ?></td>
            </tr>
            <tr>
                <td>Penanggung</td>
                <td>:</td>
                <td><?php echo $data_inv_header->penanggung ?></td>
                <td nowrap>Waktu Reg</td>
                <td nowrap>:</td>
                <td colspan="2" nowrap><?php echo $data_inv_header->regdate ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap">Penjamin/Asuransi</td>
                <td>:</td>
                <td><?php echo ($data_inv_header->asuransi=='TUNAI')?'UMUM':$data_inv_header->asuransi ?></td>
                <td nowrap>No.Asuransi</td>
                <td nowrap>:</td>
                <td colspan="2" nowrap><?php echo $data_inv_header->card_id ?></td>
            </tr>
		</table>
		
		<table class="setelan_smarthis" width="850" cellspacing="0" cellpadding="0" align="center">
            <col width="89">
            <col width="10">
            <col width="311">
            <col width="105">
            <col width="10">
            <col width="125">
            <col width="60">
            <tr>
                <td colspan="2" align="center" class="kotak">Tanggal</td>
                <td align="center" class="kotak">Deskripsi</td>
                <td align="center" class="kotak">Qty</td>
                <td colspan="2" align="center" class="kotak">Tarif (Rp)</td>
                <td align="center" nowrap="nowrap" class="kotak">Disc</td>
                <td align="center" nowrap="nowrap" class="kotak"> &nbsp; Tuslah(Rp) &nbsp; </td>
                <td align="center" nowrap="nowrap" class="kotak"> &nbsp; Subtotal (Rp) &nbsp; </td>
            </tr>
			<?php
			#$this->load->library('Terbilang');
			$no = 1;
			$curr_header = "";
			$total = 0;
			foreach($data_inv_detail as $k => $v)
			{
				if($curr_header != $v->grup)
				{
					$tr_grup_header = '
						<tr>
							<td colspan="7"> '.$v->grup.' </td>
						</tr>';
					$curr_header = $v->grup;
				}
				else
				{
					$tr_grup_header = '';
				}
			?> 
			
            <?php echo $tr_grup_header ?>
            <tr>
                <td align="right" nowrap height="15"><?php echo $v->trxdate ?></td>
                <td></td>
                <td><?php echo $v->name ?></td>
                <td align="center"><?php echo $v->qty ?></td>
                <td colspan="2" align="right"><?php echo number_format($v->price,0,",",".") ?></td>
                <td align="right"><?php echo number_format($v->disc_m,0,",",".") ?></td>
                <td align="right"><?php echo number_format($v->tuslah,0,",",".") ?></td>
                <td align="right"><?php echo number_format($v->total,0,",",".") ?></td>
            </tr>
			<?php
				$total += $v->total;
				$no++;
			}
			?>
            
    </table>
		
		<table width="850" border="0" cellpadding="0" cellspacing="0" class="footer_halaman" align="center">
            <col width="89">
            <col width="10">
            <col width="311">
            <col width="105">
            <col width="10">
            <col width="125">
            <col width="60">
           
			
			
			
			
						<tr>
						  <td colspan="7" align="right" class="garis_atas">&nbsp;</td>
		  </tr>
						<tr>
							<td rowspan="5" align="right" valign="top" style="padding:10px;">Terbilang : </td>
							<td colspan="4" rowspan="5" align="left" valign="top" class="kotak" style="padding:10px;"><em># <?php echo $this->terbilang->number_to_words($data_inv_header->total) ?> #</em></td>
							<td align="right">Total = Rp </td>
							<td width="154" align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->subtotal,0,",",".") ?></td>
						</tr>
					<tr>
							<td align="right">Diskon (-) = Rp </td>
							<td align="right" nowrap="nowrap" class="garis_atas"><?php echo number_format($data_inv_header->vcdisc_m,0,",",".") ?></td>
			</tr>
					<tr>
							<td align="right">PPN (11%) (+) = Rp </td>
							<td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->ppn,0,",",".")  ?></td>
			</tr>
						<tr>
							<td align="right">Deposit (-) = Rp </td>
							<td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->total_dp,0,",",".") ?></td>
						</tr>
					<tr>
							<td align="right">Grand Total = Rp </td>
							<td align="right" nowrap="nowrap" class="garis_atas"><?php echo number_format($data_inv_header->total,0,",",".")  ?></td>
			</tr>
					<tr>
							<td align="right">&nbsp;</td>
							<td align="right">&nbsp;</td>
							<td align="right">&nbsp;</td>
							<td align="right">&nbsp;</td>
							<td align="right">&nbsp;</td>
							<td align="right">&nbsp;</td>
							<td align="right" class="garis_atas">&nbsp;</td>
			</tr>
						<tr>
							<td align="right">&nbsp;</td>
							<td colspan="4" rowspan="3" align="left" valign="top"></td>
							<td align="right">Jaminan Asuransi = Rp </td>
							<td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->total_noncash,0,",",".") ?></td>
						</tr>

					<tr>
							<td align="right">&nbsp;</td>
							<td align="right">Debit/Kredit = Rp </td>
							<td align="right" nowrap="nowrap"><?php echo number_format($data_inv_header->total_cc1,0,",",".") ?></td>
			</tr>
						<tr>
							<td align="right">&nbsp;</td>
							<td align="right">Tunai = Rp </td>
							<td align="right" nowrap="nowrap"><?php echo number_format(($data_inv_header->total_cash + $data_inv_header->kembalian),0,",",".") ?></td>
						</tr>
						<tr>
							<td align="right">&nbsp;</td>
							<td align="right">&nbsp;</td>
							<td align="right">&nbsp;</td>
							<td align="right">&nbsp;</td>
							<td align="right">&nbsp;</td>
							<td align="right">Kembali = Rp </td>
							<td align="right" class="garis_atas"><?php echo number_format($data_inv_header->kembalian,0,",",".") ?></td>
						</tr>
            <!--
  <tr><td colspan="5">{NAMA_PAKET}</td><td colspan="2" align="right">                       Rp. {TARIF_PAKET} </td></tr>
  -->
            <tr>
                <td width="86"></td>
                <td width="24"></td>
                <td width="102"></td>
                <td width="184"></td>
                <td width="78"></td>
                <td width="192"></td>
                <td width="154"></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center">&nbsp;</td>
              <td colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" align="center">SERANG, <?php echo $data_inv_header->invdate ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td colspan="2" align="center">Pasien</td>
                <td></td>
                <td colspan="2" align="center">PETUGAS</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td></td>
                <td align="center">&nbsp;</td>
                <td colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2" align="center">( <?php echo $data_inv_header->name ?> )</td>
              <td align="center">&nbsp;</td>
              <td colspan="2" align="center">( <?php echo $data_inv_header->creator ?> )</td>
            </tr>
            <tr>
                <td colspan="4"><i>Waktu cetak : <?php echo date('Y-m-d H:i') ?></i></td>
                <td align="center">&nbsp;</td>
                <td colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4"><i>Invoice ini berlaku sebagai kwitansi</i></td>
                <td align="center">&nbsp;</td>
                <td colspan="2" align="center">&nbsp;</td>
            </tr>
    </table>
        <div style="page-break-after:always">&nbsp;</div>
		<script>
			window.print();
		</script>
    </body>
</html>
<!-- end tpl_print.html -->