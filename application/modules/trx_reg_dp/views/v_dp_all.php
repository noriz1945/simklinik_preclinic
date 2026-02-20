<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> -->
	<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.css" rel="stylesheet">

	<style>
	
	.header { 
            position: sticky; 
            top:0; 
    } 
	.container-fix { 
		/* width: 600px; */ 
		height: 55vh; 
		overflow: auto; 
	} 
	h1{ 
		color: green; 
	} 
	
	.btn {
		padding: 4px 14px;
	}
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
                                    <div class="page-header-title"><i class="feather icon-book bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Laporan</h5><span>Laporan Deposit Berdasarkan Periode</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('trx_reg_dp/dp_all'); ?>">Lap. Tindakan (Periodik)</a></li>
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
                                                        <!-- Main content -->
																<div class="card-block">
																	<div class="row">
																		
																		<div class="col-md-11">
																			
																			<form class="form-inline" action="<?php echo site_url('trx_reg_dp/dp_all'); ?>" method="post">
																				<div class="form-group mb-2">
																					<label for="periode_start" class="sr-only">Dari</label>
																					<input type="text" class="form-control" id="periode_start" name="periode_start" placeholder="Dari" value="<?php echo $periode_start?>">
																				</div>
																				<div class="form-group mx-sm-3 mb-2">
																					<label for="periode_end" class="sr-only">Sampai</label>
																					<input type="text" class="form-control" id="periode_end" name="periode_end" placeholder="Sampai" value="<?php echo $periode_end?>">
																				</div>
																				<button type="submit" class="btn btn-success mb-2">Tampilkan</button>
																			</form>
																			
																		</div>
																		
																		<div class="col-md-1 text-right">
																			<span style="margin-top:1px;">Jum Data : <?php echo $num_rows; ?></span>
																		</div>
																		
																	</div>
																	<div class="table-responsive container-fix">
																		<table id="inv_table" class="table table-bordered table-hover table-striped">
																			<thead style="position: sticky;top: 0" class="thead-light">
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col">Id Reg</th>
																					<th scope="col">Waktu Trx</th>
																					<th scope="col">Note</th>
																					<th scope="col">Bank EDC</th>
																					<th scope="col">Nomor Kartu</th>
																					<th scope="col">Total<br>Dibayar Kartu</th>
																					<th scope="col">Cash</th>
																					<th scope="col">Total</th>
																					<th scope="col">Created</th>
																					<th scope="col">Creator</th>
																					<th scope="col">Status Kasir</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$i=1;
																				$total = 0;
																				foreach ($dp_data as $data)
																				{
																					$note = "";
																					if($data->ret==1)
																					{
																						$note = "[ REFUND ]";
																					}
																					
																					if($data->ret==0 && $data->total<0)
																					{
																						$note = "[ DIGUNAKAN UNTUK PEMBAYARAN ]";
																					}
																				?> 
																				<tr>
																					<td><?php echo $i ?></td>
																					<td><?php echo $data->id_reg ?></td>
																					<td><?php echo $data->trxdate ?></td>
																					<!-- <td><?php echo $data->id_cctype1 ?></td> -->
																					<td><?php echo $note . $data->note_dp ?></td>
																					<td><?php echo $data->nama_bank ?></td>
																					<td><?php echo $data->nocc1 ?></td>
																					<td align="right"><?php echo round($data->total_cc1) ?></td>
																					<!-- <td><?php echo $data->id_cctype2 ?></td> -->
																					<!-- <td><?php echo $data->id_bank2 ?></td> -->
																					<!-- <td><?php echo $data->nocc2 ?></td> -->
																					<!-- <td><?php echo $data->total_cc2 ?></td> -->
																					<td align="right"><?php echo round($data->total_cash) ?></td>
																					<td align="right"><?php echo round($data->total) ?></td>
																					<!-- <td><?php echo $data->ret ?></td> -->
																					<!-- <td><?php echo $data->id_reg_csr ?></td> -->
																					<!-- <td><?php echo $data->id_cfb ?></td> -->
																					<!-- <td><?php echo $data->jnl_post ?></td> -->
																					<td><?php echo $data->created ?></td>
																					<td><?php echo $data->creator ?></td>
																					<!-- <td><?php echo $data->updated ?></td> -->
																					<!-- <td><?php echo $data->updater ?></td> -->
																					<td nowrap> 
																						<?php  
																						#$data_reg->ada_inv = 1;
																						if($data->ada_inv != 1)
																						{
																							echo '';
																						}
																						else
																						{
																							echo 'Closed';
																						}
																						?> 
																					</td>
																				</tr> 
																				<?php
																					$total += $data->total;
																					$i++;
																				}
																				?>
																			</tbody>
																			<tfoot style="position: sticky;bottom: 0" class="thead-light">
																			<!-- <thead> --> 
																				<tr>
																					<th colspan="7">&nbsp;</th>
																					<th align="right">TOTAL : </th>
																					<th align="right"><?php echo number_format($total,0,",",".") ?></th>
																					<th align="right"></th>
																					<th align="right"></th>
																				</tr>
																			</tfoot>
																		</table>
																	</div>
																</div>
															
                                                        
                                                        <!-- /.content -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<?php $this->theme->wrapper_close('theme_default'); ?>
					
<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
<script>		
	$('#periode_start').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		//yearRange: "-1:+1", // million years ago
		maxDate: 0,
	});
	$('#periode_start').datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$('#periode_end').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		//yearRange: "-1:+1", // million years ago
		maxDate: 0,
	});
	$('#periode_end').datepicker( "option", "dateFormat", "yy-mm-dd" );

</script>
<!-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.js"></script>

<script>
var buttonCommon = {
	exportOptions: {
		format: {
			body: function ( data, row, column, node ) {
				data = column === 6 ? data.replace( /[.]/g, '' ) : data;
				data = column === 7 ? data.replace( /[.]/g, '' ) : data;
				data = column === 8 ? data.replace( /[.]/g, '' ) : data;
				return data;
			}
		}
	}
};	
	
new DataTable('#inv_table',{
	"pageLength": 50,
	searching: false, paging: false, info: false,"ordering": false,
	
	fixedHeader: true,
	fixedColumns: true,
	dom: 'Bfrtip',
        buttons: [
            //'copy', 'csv', 'excel', 'pdf', 'print',
			{extend:'print',text:'Print'},
			$.extend( true, {}, buttonCommon, {
                extend: 'excel',text:'Export to Excel'
            }),			
        ]
});
</script>

