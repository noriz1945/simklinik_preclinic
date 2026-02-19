<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html>
<head>
	<?php $this->theme->head('theme_default'); ?>
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.css" rel="stylesheet">

	<title><?php echo isset($title)?htmlspecialchars($title):'Laporan Stok Obat'; ?></title>

	<style>
	.header { position: sticky; top:0; }
	.container-fix { height: 55vh; overflow: auto; }
	.btn { padding: 4px 14px; }
	select.form-control{ background-color: ghostwhite; }
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
										<span>Laporan Stok Obat</span>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="page-header-breadcrumb">
									<ul class="breadcrumb breadcrumb-title">
										<li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
										<li class="breadcrumb-item"><a href="<?php echo base_url('laporanstokobat'); ?>">Lap. Stok Obat</a></li>
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
															$wrh = $filters['wrh'] ?? '';
															$q   = $filters['q'] ?? '';
															$periode_start = $filters['from'] ?? '';
															$periode_end   = $filters['to'] ?? '';
															$num_rows = isset($rows) ? count($rows) : 0;

															$totalstok = 0;
														?>

														<div class="row">
															<div class="col-md-11">
																<form class="form-inline" action="<?php echo site_url('laporanstokobat'); ?>" method="get">
																	<div class="form-group mb-2">
																		<label for="periode_start" class="sr-only">Dari</label>
																		<input type="text" class="form-control" id="periode_start" name="from" placeholder="Dari" value="<?php echo htmlspecialchars($periode_start); ?>">
																	</div>
																	<div class="form-group mx-sm-3 mb-2">
																		<label for="periode_end" class="sr-only">Sampai</label>
																		<input type="text" class="form-control" id="periode_end" name="to" placeholder="Sampai" value="<?php echo htmlspecialchars($periode_end); ?>">
																	</div>

																	<div class="form-group mx-sm-3 mb-2">
																		<label class="sr-only">Gudang</label>
																		<select class="form-control" name="wrh">
																			<option value="">-- Semua Gudang --</option>
																			<?php foreach(($wrh_list??[]) as $w): $val=(string)$w->id_wrh; ?>
																				<option value="<?php echo htmlspecialchars($val); ?>" <?php echo ($wrh===$val?'selected':''); ?>>
																					<?php echo ($val===''?'(kosong)':htmlspecialchars($val)); ?>
																				</option>
																			<?php endforeach; ?>
																		</select>
																	</div>

																	<div class="form-group mx-sm-3 mb-2">
																		<label class="sr-only">Cari</label>
																		<input type="text" class="form-control" name="q" placeholder="Cari ID/Nama Obat" value="<?php echo htmlspecialchars($q); ?>">
																	</div>

																	<button type="submit" class="btn btn-success mb-2">Tampilkan</button>

																	<a class="btn btn-outline-success mb-2" style="margin-left:6px"
																	   href="<?php echo base_url('laporanstokobat/export_csv?'.http_build_query($filters)); ?>">
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
																		<th scope="col">#</th>
																		<th scope="col">ID Obat</th>
																		<th scope="col">Nama Obat</th>
																		<th scope="col">Gudang</th>
																		<th scope="col" class="text-right">Stok</th>
																		<th scope="col">Terakhir Update</th>
																		<th scope="col" class="text-right">Harga Jual</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$i=1;
																	if(!empty($rows)){
																		foreach($rows as $r){
																			$stok = (int)($r->stok ?? 0);
																			$totalstok += $stok;
																	?>
																	<tr>
																		<td><?php echo $i; ?></td>
																		<td><?php echo htmlspecialchars((string)$r->id_fa); ?></td>
																		<td><?php echo htmlspecialchars((string)$r->name); ?></td>
																		<td><?php echo htmlspecialchars((string)($r->id_wrh ?? '')); ?></td>
																		<td class="text-right"><?php echo number_format($stok,0,",","."); ?></td>
																		<td><?php echo htmlspecialchars((string)($r->last_datetime ?? '')); ?></td>
																		<td class="text-right"><?php echo number_format((float)($r->sale_price ?? 0),0,",","."); ?></td>
																	</tr>
																	<?php
																			$i++;
																		}
																	}else{
																	?>
																	<tr><td colspan="7" class="text-center">Data tidak ditemukan.</td></tr>
																	<?php } ?>
																</tbody>

																<tfoot style="position: sticky;bottom: 0" class="thead-light">
																	<tr>
																		<th colspan="4" class="text-right">TOTAL :</th>
																		<th class="text-right"><?php echo number_format((float)$totalstok,0,",","."); ?></th>
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
									data = column === 4 ? (data+'').replace( /[.]/g, '' ) : data; // stok
									data = column === 6 ? (data+'').replace( /[.]/g, '' ) : data; // harga
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
