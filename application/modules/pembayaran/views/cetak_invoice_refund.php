<!doctype html>
<html>
    <head> <?php #$this->theme->head('theme_default'); ?><title>FastMedik - LYND</title>
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

            .ref{
    position: relative;
    z-index: 0;
    background: white;
    display: block;
    min-height: 40%;
    min-width: 100%;
    color: yellow;
    /*border: 2px solid black;*/
    height: 400px;
    
}

p{margin:0}

.ref:after{
    content: "REFUND";
    color:crimson;
    font-size: 120px;
    /* text-align: center; */
    position: absolute;
    top: 60%;
    left: 20%;
    transform: rotate(-45deg);
   
    opacity:0.1
}
        </style>
    </head>
    <div class="ref">
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
		      <td align="center"><strong><span lang="EN-US">KLINIK UTAMA</span></strong></td>
	      </tr>
		    <tr>
		      <td align="center"><strong><span lang="EN-US">LYND</span></strong></td>
	      </tr>
		    <tr>
		      <td align="center"><span lang="EN-US">JL. DR. Cipto Mangunkusumo</span><strong><span lang="EN-US"> </span></strong></td>
	      </tr>
		    <tr>
		      <td align="center"><span lang="EN-US">CILEDUG, KOTA TANGERANG</span></td>
	      </tr>
            <tr>
                <td width="84" height="1"></td>
                <td width="3"></td>
                <td width="537"></td>
                <td width="67"></td>
                <td width="3"></td>
                <td width="55"></td>
                <td width="99"></td>
            </tr>
            <tr>
                <td colspan="7" align="center"><strong>INVOICE</strong></td>
            </tr>
            <tr>
                <td colspan="7" align="center"><?php echo $data_inv_header->id_inv ?></td>
            </tr>
            <tr>
                <td colspan="7" align="center" height="5"></td>
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
                <td>Penjamin</td>
                <td>:</td>
                <td><?php echo $data_inv_header->asuransi ?></td>
                <td nowrap>&nbsp;</td>
                <td nowrap></td>
                <td colspan="2" nowrap>&nbsp;</td>
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
                <td colspan="2" align="center" class="kotak">Biaya (Rp)</td>
                <td align="center" class="kotak">Jumlah</td>
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
                <td align="right"><?php echo number_format($v->total,0,",",".") ?></td>
            </tr>
			<?php
				$total += $v->total;
				$no++;
			}
			?>
            
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
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
                <td align="left" valign="top">&nbsp;</td>
                <td colspan="4" align="left" valign="top">&nbsp;</td>
                <td align="right" class="garis_atas">Total(Rp) :</td>
                <td align="right" class="garis_atas"><?php echo number_format($total,0,",",".") ?></td>
            </tr>
            <tr>
                <td align="left" valign="top">Terbilang : </td>
                <td colspan="4" rowspan="2" align="left" valign="top">
                    <em># <?php echo $this->terbilang->number_to_words($total) ?> #</em>
                </td>
                <td align="right" nowrap></td>
                <td align="right"></td>
            </tr>
            <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" class="garis_atas">Grand Total(Rp) :</td>
                <td align="right" class="garis_atas"><?php echo number_format($total,0,",",".") ?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2">&nbsp;</td>
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
                <td colspan="2" align="center">KLINIK BINA MEDIKA</td>
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
                <td colspan="2" align="center">&nbsp;</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" align="center">&nbsp;</td>
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
                <td colspan="3">&nbsp;</td>
                <td></td>
                <td align="center">&nbsp;</td>
                <td colspan="2" align="center">( <?php echo $data_inv_header->creator ?> )</td>
            </tr>
            <tr>
                <td colspan="4"><?php echo $data_inv_header->invdate ?></td>
                <td align="center">&nbsp;</td>
                <td colspan="2" align="center">PETUGAS</td>
            </tr>
            <tr>
                <td colspan="4">- INVOICE INI BERLAKU SEBAGAI KWITANSI</td>
                <td align="center">&nbsp;</td>
                <td colspan="2" align="center">&nbsp;</td>
            </tr>
        </table>
        <div style="page-break-after:always">&nbsp;</div>
		<script>
			window.print();
		</script>
        </div>
    </body>
</html>
<!-- end tpl_print.html -->