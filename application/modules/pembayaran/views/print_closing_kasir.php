<!doctype html>
<html>

<head>
	<?php $this->theme->head('theme_default'); ?>
	<?php require_once(APPPATH . '../assets/app_hn/depofnc/mnu-cmp-css.php'); ?>
	<style>
		.list_reg {
			height: 100vh;
			overflow-y: scroll;
		}

		.btn {
			font-size: 12px;
			padding: 6px 14px;
		}

		table td {
			font-size: 9px;
		}

		table th {
			text-align: center;
		}

		body[themebg-pattern="theme1"] {
			background-image: none;
		}

		.card {
			margin-bottom: 5px;
		}
	</style>
</head>

<body>
	<div class="page-body">


		<table class="setelan_smarthis" width="90%" cellspacing="0" cellpadding="0" align="center">
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
				<td colspan="7" align="right"><strong>KLINIK LYND</strong></td>
			</tr>
			<tr>
				<td colspan="7" align="right"><strong>JL. Dr. Ciptomangunkusumo</strong></td>
			</tr>
			<tr>
				<td colspan="7" align="right"><strong>Ciledug, KOTA TANGERANG</strong></td>
			</tr>
			<tr>
				<td colspan="7" align="center">
					<H3>Closing Kasir</h3>
				</td>
			</tr>

		</table>



		<div class="container-fluid">
			<form class="form-horizontal" action="<?php echo site_url('pembayaran/closing_kasir_act'); ?>" method="post"
				enctype="multipart/form-data">
				<div class="col-md-12" id="rekap">

				</div>

				<div class="col-md-12">
					<div class="card">
						<!-- Main content -->
						<div class="card-header">
							<h5>Detail Transaksi</h5>
						</div>
						<div class="card-block">
							<h6>Invoice Pembayaran</h6>
							<table width="100%" border="1" cellpadding="4">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Id.Reg</th>
										<th scope="col">Nama</th>
										<th scope="col">Nama Asuransi</th>
										<th scope="col">No.Inv</th>
										<th scope="col">Total</th>
										<th scope="col">Diskon</th>
										<th scope="col">PPN</th>
										<th scope="col">Paid by Deposit</th>
										<th scope="col">Grand Total</th>
										<th scope="col">Jaminan Asuransi</th>
										<?php foreach ($data_bank as $bank) { ?>
											<th scope="col"><?php echo $bank->nama_bank ?></th>
										<?php } ?>
										<th scope="col">Tunai</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no_byr = 0;
									$total_subtotal = 0;
									$total_vcdisc_m = 0;
									$total_ppn = 0;
									$total_total_dp = 0;
									$total_total = 0;
									$total_total_asuransi = 0;
									$total_total_cc1 = 0;
									$total_total_cash = 0;
									$totals_per_bank = array();
									foreach ($data_bank as $bank) {
										$totals_per_bank[$bank->id_bank] = 0;
									}
									foreach ($data_inv as $k => $v) {
										$no_byr++;
										?>
										<tr>
											<td><?php echo $no_byr ?></td>
											<td><?php echo $v->id_reg ?></td>
											<td><?php echo $v->name ?></td>
											<td><?php echo $v->asuransi ?></td>
											<td><?php echo $v->id_inv ?></td>
											<td align="right"><?php echo number_format($v->subtotal, 0, ",", ".") ?></td>
											<td align="right"><?php echo number_format($v->vcdisc_m, 0, ",", ".") ?></td>
											<td align="right"><?php echo number_format($v->ppn, 0, ",", ".") ?></td>
											<td align="right"><?php echo number_format($v->total_dp, 0, ",", ".") ?></td>
											<td align="right"><?php echo number_format($v->total, 0, ",", ".") ?></td>
											<td align="right"><?php echo number_format($v->total_noncash, 0, ",", ".") ?>
											</td>
											<?php foreach ($data_bank as $bank) {
												$val_bank = 0;
												if ($v->id_bank1 == $bank->id_bank)
													$val_bank += $v->total_cc1;
												if (isset($v->id_bank2) && $v->id_bank2 == $bank->id_bank)
													$val_bank += $v->total_cc2;
												?>
												<td align="right"><?php echo number_format($val_bank, 0, ",", ".") ?></td>
											<?php } ?>
											<td align="right"><?php echo number_format($v->total_cash, 0, ",", ".") ?></td>
										</tr>
										<?php
										$total_subtotal += $v->subtotal;
										$total_vcdisc_m += $v->vcdisc_m;
										$total_ppn += $v->ppn;
										$total_total_dp += $v->total_dp;
										$total_total += $v->total;
										$total_total_asuransi += $v->total_noncash;
										$total_total_cc1 += $v->total_cc1;
										if (isset($v->total_cc2))
											$total_total_cc1 += $v->total_cc2;
										foreach ($data_bank as $bank) {
											if ($v->id_bank1 == $bank->id_bank) {
												$totals_per_bank[$bank->id_bank] += $v->total_cc1;
											}
											if (isset($v->id_bank2) && $v->id_bank2 == $bank->id_bank) {
												$totals_per_bank[$bank->id_bank] += $v->total_cc2;
											}
										}
										$total_total_cash += $v->total_cash;
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<td align="right" colspan="5">Total : </td>
										<td align="right"><?php echo number_format($total_subtotal, 0, ",", ".") ?></td>
										<td align="right"><?php echo number_format($total_vcdisc_m, 0, ",", ".") ?></td>
										<td align="right"><?php echo number_format($total_ppn, 0, ",", ".") ?></td>
										<td align="right"><?php echo number_format($total_total_dp, 0, ",", ".") ?></td>
										<td align="right"><?php echo number_format($total_total, 0, ",", ".") ?></td>
										<td align="right">
											<?php echo number_format($total_total_asuransi, 0, ",", ".") ?>
										</td>
										<?php foreach ($data_bank as $bank) { ?>
											<td align="right">
												<?php echo number_format($totals_per_bank[$bank->id_bank], 0, ",", ".") ?>
											</td>
										<?php } ?>
										<td align="right"><?php echo number_format($total_total_cash, 0, ",", ".") ?>
										</td>
									</tr>
								</tfoot>
							</table>

							<br><br>
							<h6>Invoice Refund</h6>
							<table width="100%" border="1" cellpadding="4">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Id.Reg</th>
										<th scope="col">Nama</th>
										<th scope="col">Nama Asuransi</th>
										<th scope="col">No.Inv</th>
										<th scope="col">Refund Total</th>
										<th scope="col">Refund Jaminan Asuransi</th>
										<th scope="col">Refund Tunai</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no_byr = 0;
									$total_ref_total = 0;
									$total_ref_asuransi = 0;
									$total_ref_total_cash = 0;
									foreach ($data_inv_refund as $k => $v) {
										$no_byr++;
										?>
										<tr>
											<td><?php echo $no_byr ?></td>
											<td><?php echo $v->id_reg ?></td>
											<td><?php echo $v->name ?></td>
											<td><?php echo $v->asuransi ?></td>
											<td><?php echo $v->id_inv ?></td>
											<td align="right"><?php echo number_format($v->refund_total, 0, ",", ".") ?>
											</td>
											<td align="right"><?php echo number_format($v->refund_asuransi, 0, ",", ".") ?>
											</td>
											<td align="right"><?php echo number_format($v->tunai, 0, ",", ".") ?></td>
										</tr>
										<?php
										$total_ref_total += $v->refund_total;
										$total_ref_asuransi += $v->refund_asuransi;
										$total_ref_total_cash += $v->tunai;
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<td align="right" colspan="5">Total : </td>
										<td align="right"><?php echo number_format($total_ref_total, 0, ",", ".") ?>
										</td>
										<td align="right"><?php echo number_format($total_ref_asuransi, 0, ",", ".") ?>
										</td>
										<td align="right">
											<?php echo number_format($total_ref_total_cash, 0, ",", ".") ?>
										</td>
									</tr>
								</tfoot>
							</table>


							<br><br>
							<h6>Deposit</h6>
							<table width="100%" border="1" cellpadding="4">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Id.Reg</th>
										<th scope="col">Nama</th>
										<th scope="col">Nama Asuransi</th>
										<th scope="col">Id Dp</th>
										<th scope="col">Dp Total</th>
										<?php foreach ($data_bank as $bank) { ?>
											<th scope="col">Dp <?php echo $bank->nama_bank ?></th>
										<?php } ?>
										<th scope="col">Dp Tunai</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no_byr = 0;
									$total_dp_total = 0;
									$total_dp_cc1 = 0;
									$total_dp_cash = 0;
									$totals_dp_per_bank = array();
									foreach ($data_bank as $bank) {
										$totals_dp_per_bank[$bank->id_bank] = 0;
									}
									foreach ($data_dp as $k => $v) {
										$no_byr++;
										?>
										<tr>
											<td><?php echo $no_byr ?></td>
											<td><?php echo $v->id_reg ?></td>
											<td><?php echo $v->name ?></td>
											<td><?php echo $v->asuransi ?></td>
											<td><?php echo $v->id_trx ?></td>
											<td align="right"><?php echo number_format($v->total, 0, ",", ".") ?></td>
											<?php foreach ($data_bank as $bank) {
												$val_dp_bank = 0;
												if ($v->id_bank1 == $bank->id_bank)
													$val_dp_bank += $v->total_cc1;
												if (isset($v->id_bank2) && $v->id_bank2 == $bank->id_bank)
													$val_dp_bank += $v->total_cc2;
												?>
												<td align="right"><?php echo number_format($val_dp_bank, 0, ",", ".") ?></td>
											<?php } ?>
											<td align="right"><?php echo number_format($v->total_cash, 0, ",", ".") ?></td>
										</tr>
										<?php
										$total_dp_total += $v->total;
										$total_dp_cc1 += $v->total_cc1;
										if (isset($v->total_cc2))
											$total_dp_cc1 += $v->total_cc2;
										foreach ($data_bank as $bank) {
											if ($v->id_bank1 == $bank->id_bank) {
												$totals_dp_per_bank[$bank->id_bank] += $v->total_cc1;
											}
											if (isset($v->id_bank2) && $v->id_bank2 == $bank->id_bank) {
												$totals_dp_per_bank[$bank->id_bank] += $v->total_cc2;
											}
										}
										$total_dp_cash += $v->total_cash;
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<td align="right" colspan="5">Total : </td>
										<td align="right"><?php echo number_format($total_dp_total, 0, ",", ".") ?></td>
										<?php foreach ($data_bank as $bank) { ?>
											<td align="right">
												<?php echo number_format($totals_dp_per_bank[$bank->id_bank], 0, ",", ".") ?>
											</td>
										<?php } ?>
										<td align="right"><?php echo number_format($total_dp_cash, 0, ",", ".") ?></td>
									</tr>
								</tfoot>
							</table>


							<br><br>
							<h6>Deposit Refund</h6>
							<table width="100%" border="1" cellpadding="4">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Id.Reg</th>
										<th scope="col">Nama</th>
										<th scope="col">Nama Asuransi</th>
										<th scope="col">Id Dp</th>
										<th scope="col">Refund Dp Total</th>
										<!--<th scope="col">Refund Dp Debit/Kredit/Qris</th>-->
										<th scope="col">Refund Dp Tunai</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no_byr = 0;
									$total_dp_ref_total = 0;
									#$total_dp_cc1 		= 0;
									$total_dp_ref_cash = 0;
									foreach ($data_dp_refund as $k => $v) {
										$no_byr++;
										?>
										<tr>
											<td><?php echo $no_byr ?></td>
											<td><?php echo $v->id_reg ?></td>
											<td><?php echo $v->name ?></td>
											<td><?php echo $v->asuransi ?></td>
											<td><?php echo $v->id_trx ?></td>
											<td align="right"><?php echo number_format(($v->total * -1), 0, ",", ".") ?>
											</td>
											<!--<td align="right"><?php #echo number_format(($v->total_cc1*-1),0,",",".") ?></td>-->
											<td align="right">
												<?php echo number_format(($v->total_cash * -1), 0, ",", ".") ?>
											</td>
										</tr>
										<?php
										$total_dp_ref_total += ($v->total * -1);
										#$total_dp_cc1 		+= ($v->total_cc1*-1);
										$total_dp_ref_cash += ($v->total_cash * -1);
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<td align="right" colspan="5">Total : </td>
										<td align="right"><?php echo number_format($total_dp_ref_total, 0, ",", ".") ?>
										</td>
										<!--<td align="right"><?php #echo number_format($total_dp_cc1,0,",",".") ?></td>-->
										<td align="right"><?php echo number_format($total_dp_ref_cash, 0, ",", ".") ?>
										</td>
									</tr>
								</tfoot>
							</table>

						</div>
					</div>
				</div>

				<?php
				$grand_total_tunai = $total_total_cash - $total_ref_total_cash + $total_dp_cash - $total_dp_ref_cash;
				$grand_total_cc1 = $total_total_cc1 + $total_dp_cc1;
				$grand_total_asuransi = $total_total_asuransi - $total_ref_asuransi;
				//$total_setoran_tunai	= $grand_total_tunai + $data_opening['saldo_awal'];
				$total_setoran_tunai = $grand_total_tunai;
				?>

				<div class="col-md-12" id="temp_rekap">
					<div class="card" id="div_card_rekap">

						<!-- Main content -->
						<div class="card-header">
							<h5>Rekap</h5>
						</div>
						<div class="card-block">

							<div class="row">
								<div class="col-md-4">
									<div class="row">
										<div class="col-sm-6 text-right">
											<label>ID Opening :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_opening['id_opening'] ?></label>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Nama :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_opening['name'] ?></label>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Waktu Opening :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_opening['opening_time'] ?></label>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Waktu Closing :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_opening['closing_time'] ?></label>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Saldo Awal :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_opening['saldo_awal'] ?></label>
										</div>
									</div>

								</div>

								<div class="col-md-4">
									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Jml. Inv. Pembayaran :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_header['jml_data_inv'] ?></label>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Jml. Inv. Refund :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_header['jml_data_inv_refund'] ?></label>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Jml. Inv. Deposit :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_header['jml_data_dp'] ?></label>
										</div>
									</div>


									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Jml. Inv. Deposit Refund :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_header['jml_data_dp_refund'] ?></label>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Jml. Inv. Semuanya :</label>
										</div>
										<div class="col-sm-6">
											<label><?php echo $data_header['jml_data_inv_all'] ?></label>
										</div>
									</div>

								</div>

								<div class="col-md-4">

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Total Tunai :</label>
										</div>
										<div class="col-sm-6 text-right" style="padding-right:50px;">
											<label><?php echo number_format($grand_total_tunai, 0, ",", ".") ?></label>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Total Non-Tunai (EDC/QRIS/TF) :</label>
										</div>
										<div class="col-sm-6 text-right" style="padding-right:50px;">
											<label><?php echo number_format($grand_total_cc1, 0, ",", ".") ?></label>
										</div>
									</div>
									<?php foreach ($data_bank as $bank) {
										$grand_bank = (isset($totals_per_bank[$bank->id_bank]) ? $totals_per_bank[$bank->id_bank] : 0)
											+ (isset($totals_dp_per_bank[$bank->id_bank]) ? $totals_dp_per_bank[$bank->id_bank] : 0);
										?>
										<div class="row">
											<div class="col-sm-6 text-right">
												<label>&nbsp;&nbsp;&bull; <?php echo $bank->nama_bank ?> :</label>
											</div>
											<div class="col-sm-6 text-right" style="padding-right:50px;">
												<label><?php echo number_format($grand_bank, 0, ",", ".") ?></label>
											</div>
										</div>
									<?php } ?>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Total Dijamin Asuransi :</label>
										</div>
										<div class="col-sm-6 text-right" style="padding-right:50px;">
											<label><?php echo number_format($grand_total_asuransi, 0, ",", ".") ?></label>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-6 text-right">
											<label>Total Setoran (Tunai) :</label>
										</div>
										<div class="col-sm-6 text-right" style="padding-right:50px;">
											<label><?php echo number_format($total_setoran_tunai, 0, ",", ".") ?></label>
										</div>
									</div>

								</div>

							</div>
							<hr>
							<div class="col-md-12">
								<div class="row">
									<div class="col-sm-2 text-right">
										<label>Note Opening :</label>
									</div>
									<div class="col-sm-10"
										style="border : black solid thin; min-height:60px;padding:10px;">
										<label><?php echo nl2br($data_opening['note_opening']) ?></label>
									</div>
								</div>
							</div>

						</div>
						<!-- /.content -->

					</div>
				</div>

				<div class="col-md-12">

					<div class="card">

						<!-- Main content -->
						<div class="card-header">
							<h5>Note Closing Kasir</h5>
						</div>
						<div class="card-block">

							<!-- TEXT -->
							<div class="form-group row text-right">
								<label for="note_closing" class="col-sm-2 control-label">Note Closing : </label>
								<div class="col-sm-10 text-left"
									style="border : black solid thin; min-height:60px; padding:10px;">
									<label><?php echo nl2br($data_opening['note_closing']) ?></label>
								</div>
							</div>


						</div>
						<!-- /.content -->


					</div>
				</div>

			</form>
		</div>


	</div>

</body>

</html>

<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH . '../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>
<script>
	$(function () {
		var $rekap = $('#div_card_rekap').clone();
		$('#rekap').html($rekap);

		$('#temp_rekap').remove();
	});

	setTimeout(function () { window.print(); }, 2000);

</script>