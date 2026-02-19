<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html>
<head>
	<?php $this->theme->head('theme_default'); ?>
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.css" rel="stylesheet">

	<title><?php echo isset($title)?htmlspecialchars($title):'Laporan Penjualan Obat'; ?></title>

	<style>
	.header { position: sticky; top:0; }
	.container-fix { height: 55vh; overflow: auto; }
	.btn { padding: 4px 14px; }
	</style>
</head>

<?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
<div class="loader-bg">
	<div class="loader-bar"></div>
</div>

<div id="pcoded" class="pcoded"> 
	<div class="pcoded-overlay-box"></div>
	<div class="pcoded-container navbar-wrapper">
		<div class="pcoded-main-container">
			<div class="pcoded-wrapper">
				<div class="pcoded-content">
					<div class="page-header card">
						<div class="row align-items-end">
							<div class="col-lg-8">
								<div class="page-header-title">
									<i class="feather icon-book bg-c-blue"></i>
									<div class="d-inline">
										<h5>Laporan</h5>
										<span>Laporan Penjualan Obat (eResep)</span>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="page-header-breadcrumb">
									<ul class="breadcrumb breadcrumb-title">
										<li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
										<li class="breadcrumb-item"><a href="<?php echo base_url('laporanpenjualanobat'); ?>">Lap. Penjualan Obat</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="pcoded-inner-content">
						<div class="main-body">
							<div class="page-wrapper">
								<div class="page-body">
									<div class="row">
										<div class="col-sm-12">
											<div class="card">
												<div class="container-fluid">
													<div class="card-block">

														<?php
															$filters = $filters ?? [];
															$q   = $filters['q'] ?? '';
															$inv = $filters['inv'] ?? '';
															$periode_start = $filters['from'] ?? '';
															$periode_end   = $filters['to'] ?? '';
													// Jumlah data harus mengikuti hasil filter (bukan hanya rows yang tampil / limited)
													$num_rows = (int)($total ?? (isset($rows) ? count($rows) : 0));

													// TOTAL gunakan summary dari model (biar konsisten walau paging/limit)
													$sum = $sum ?? (object)[];
													$totalqty = (float)($sum->total_qty ?? 0);
													$totalsubtotal = (float)($sum->total_subtotal ?? 0);
														?>

														<div class="row">
															<div class="col-md-11">
																<form class="form-inline" action="<?php echo site_url('laporanpenjualanobat'); ?>" method="get">
																	<div class="form-group mb-2">
																		<label for="periode_start" class="sr-only">Dari</label>
																		<input type="text" class="form-control" id="periode_start" name="from" placeholder="Dari" value="<?php echo htmlspecialchars($periode_start); ?>">
																	</div>
																	<div class="form-group mx-sm-3 mb-2">
																		<label for="periode_end" class="sr-only">Sampai</label>
																		<input type="text" class="form-control" id="periode_end" name="to" placeholder="Sampai" value="<?php echo htmlspecialchars($periode_end); ?>">
																	</div>

																	<div class="form-group mx-sm-3 mb-2">
																		<label class="sr-only">Cari</label>
																		<input type="text" class="form-control" name="q" placeholder="Cari ID/Nama Obat" value="<?php echo htmlspecialchars($q); ?>">
																	</div>

																	<div class="form-group mx-sm-3 mb-2">
																		<label class="sr-only">Invoice</label>
																		<input type="text" class="form-control" name="inv" placeholder="Invoice" value="<?php echo htmlspecialchars($inv); ?>">
																	</div>

																	<button type="submit" class="btn btn-success mb-2">Tampilkan</button>

																	<a class="btn btn-outline-success mb-2" style="margin-left:6px"
																	   href="<?php echo base_url('laporanpenjualanobat/export_csv?'.http_build_query($filters)); ?>">
																		Export CSV
																	</a>
																</form>
															</div>

															<div class="col-md-1 text-right">
																<span style="margin-top:1px;">Jum Data : <?php echo (int)$num_rows; ?></span>
															</div>
														</div>

														<div class="table-responsive container-fix">
															<table id="inv_table" class="table table-bordered table-hover table-striped">
																<thead style="position: sticky;top: 0" class="thead-light">
																	<tr>
																		<th>#</th>
																		<th>Tanggal</th>
																		<th>eResep</th>
																		<th>Reg</th>
																		<th>Invoice</th>
																		<th>ID Obat</th>
																		<th>Nama Obat</th>
																		<th class="text-right">Qty</th>
																		<th class="text-right">Harga</th>
																		<th class="text-right">Subtotal</th>
																		<th>Jenis</th>
																		<th class="text-center">Racik</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$i=1;
																	if(!empty($rows)){
																		foreach($rows as $r){
																$qty = (float)($r->qty_num ?? 0);
																$subtotal = (float)($r->subtotal ?? 0);
																	?>
																	<tr>
																		<td><?php echo $i; ?></td>
																		<td><?php echo htmlspecialchars((string)$r->eresepdate); ?></td>
																		<td><?php echo htmlspecialchars((string)$r->id_eresep); ?></td>
																		<td><?php echo htmlspecialchars((string)$r->id_reg); ?></td>
																		<td><?php echo htmlspecialchars((string)$r->id_inv); ?></td>
																		<td><?php echo htmlspecialchars((string)$r->id_trx_det); ?></td>
																		<td><?php echo htmlspecialchars((string)$r->name); ?></td>
																		<td class="text-right"><?php echo number_format($qty,2,",","."); ?></td>
																		<td class="text-right"><?php echo number_format((float)($r->harga_satuan ?? 0),0,",","."); ?></td>
																		<td class="text-right"><?php echo number_format($subtotal,0,",","."); ?></td>
																		<td><?php echo htmlspecialchars((string)($r->jenis_obat ?? '')); ?></td>
																		<td class="text-center"><?php echo ((int)($r->is_racikan ?? 0)===1?'Ya':'-'); ?></td>
																	</tr>
																	<?php
																			$i++;
																		}
																	}else{
																	?>
																	<tr><td colspan="12" class="text-center">Data tidak ditemukan (rules: invoice ada & status=0).</td></tr>
																	<?php } ?>
																</tbody>

																<tfoot style="position: sticky;bottom: 0" class="thead-light">
																	<tr>
																		<th colspan="7" class="text-right">TOTAL :</th>
																		<th class="text-right"><?php echo number_format((float)$totalqty,2,",","."); ?></th>
																		<th>&nbsp;</th>
																		<th class="text-right"><?php echo number_format((float)$totalsubtotal,0,",","."); ?></th>
																		<th colspan="2">&nbsp;</th>
																	</tr>
																</tfoot>
															</table>
														</div>

													</div><!-- /card-block -->
												</div><!-- /container-fluid -->
											</div><!-- /card -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- /pcoded-inner-content -->
				</div><!-- /pcoded-content -->

				<?php $this->theme->wrapper_close('theme_default'); ?>

				<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
				<script>
					$('#periode_start').datepicker({
						dateFormat: "yy-mm-dd",
						changeMonth: true,
						changeYear: true,
						maxDate: 0,
					});
					$('#periode_start').datepicker("option", "dateFormat", "yy-mm-dd");

					$('#periode_end').datepicker({
						dateFormat: "yy-mm-dd",
						changeMonth: true,
						changeYear: true,
						maxDate: 0,
					});
					$('#periode_end').datepicker("option", "dateFormat", "yy-mm-dd");
				</script>

				<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
				<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.js"></script>

				<script>
					var buttonCommon = {
						exportOptions: {
							format: {
								body: function ( data, row, column, node ) {
									// qty/harga/subtotal => remove thousand separators
									data = (column === 7 || column === 8 || column === 9) ? (data+'').replace( /[.]/g, '' ) : data;
									return data;
								}
							}
						}
					};

					new DataTable('#inv_table',{
						"pageLength": 50,
						searching: false, paging: false, info: false, "ordering": false,
						fixedHeader: true,
						fixedColumns: true,
						dom: 'Bfrtip',
						buttons: [
							{extend:'print',text:'Print'},
							$.extend( true, {}, buttonCommon, { extend: 'excel', text:'Export to Excel' }),
						]
					});
				</script>

			</div>
		</div>
	</div>
</div>
</html>
