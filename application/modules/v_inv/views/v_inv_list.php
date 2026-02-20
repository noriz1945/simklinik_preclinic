
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
                                            <h5>Laporan</h5><span>Laporan Invoice berdasarkan periode</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('V_inv/'); ?>">Lap. Inv (Periodik)</a></li>
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
                                                        
															<!--
                                                                <div class="card-header">
																	<h5>V_inv</h5>
																</div>
															-->
																<div class="card-block">
																	<div class="row">
																		
																		<div class="col-md-10">
																			
																			<form class="form-inline" action="<?php echo site_url('v_inv/index'); ?>" method="post">
																				<div class="form-group mb-2">
																					<label for="periode_start" class="sr-only">Dari</label>
																					<input type="text" class="form-control" id="periode_start" name="periode_start" placeholder="Dari" value="<?php echo $periode_start?>">
																				</div>
																				<div class="form-group mx-sm-3 mb-2">
																					<label for="periode_end" class="sr-only">Sampai</label>
																					<input type="text" class="form-control" id="periode_end" name="periode_end" placeholder="Sampai" value="<?php echo $periode_end?>">
																				</div>
																				<div class="form-group mx-sm-3 mb-2">
																					<label for="periode_end" class="sr-only">Dokter</label>
																					<?php echo $dropdown_id_dokter ?>
																				</div>
																				<button type="submit" class="btn btn-success mb-2">Tampilkan</button>
																			</form>
																			
																		</div>
																		<div class="col-md-2 text-right">
																			<h4 style="margin-top:1px;">Jumlah Invoice : <?php echo $num_rows; ?></h4>
																		</div>
																	</div>
																	<div class="table-responsive container-fix">
																		<table id="inv_table" class="table table-bordered table-hover table-striped">
																			<thead style="position: sticky;top: 0" class="thead-light">
																			<!-- <thead> --> 
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col">Waktu Inv</th>
																					<th scope="col">No. Inv</th>
																					<th scope="col">Tgl. Reg</th>
																					<th scope="col">No. Reg</th>
																					<th scope="col">No. RM</th>
																					<!--<th scope="col">Is Reg Aps</th>-->
																					<th scope="col">Nama Pasien</th>
																					<!--<th scope="col">Id Asuransi</th>-->
																					<th scope="col">Asuransi</th>
																					<!--<th scope="col">Id Dokter Prt1</th>-->
																					<th scope="col">Dokter</th>
																					<th scope="col">Total</th>
																					<th scope="col">Diskon(-)</th>
																					<th scope="col">PPN(+)</th>
																					<th scope="col">Grand Total</th>
																					<th scope="col">Total bayar dari Dp</th>
																					
																					<!--<th scope="col">Total<br>(Yang Harus Dibayar)</th>-->
																					
																					<th scope="col">Dijamin<br>Asuransi</th>
																					<th scope="col">Total CC/DC</th>
																					<th scope="col">Tunai</th>
																					<!--<th scope="col">Kembalian</th>-->
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$i=1;
																				$subtotal = 0;
																				$total_dp = 0;
																				$vppn = 0;
																				$vcdisc_m = 0;
																				$grand_total = 0;
																				$total_noncash = 0;
																				$total_cc1 = 0;
																				$total_cash = 0;
																				foreach ($v_inv_data as $v_inv)
																				{
																				?> 
																				<tr>
																					<td><?php echo $i ?></td>
																					<td><?php echo $v_inv->invdate ?></td>
																					<td><?php echo $v_inv->id_inv ?></td>
																					<td><?php echo $v_inv->tgl_reg ?></td>
																					<td><?php echo $v_inv->id_reg ?></td>
																					<td><?php echo $v_inv->id_pasien ?></td>
																					<!--<td><?php #echo $v_inv->is_reg_aps ?></td>-->
																					<td><?php echo $v_inv->nama_pasien ?></td>
																					<!--<td><?php #echo $v_inv->id_asuransi ?></td>-->
																					<td><?php echo $v_inv->asuransi ?></td>
																					<!--<td><?php #echo $v_inv->id_dokter_prt1 ?></td>-->
																					<td><?php echo $v_inv->dokter ?></td>
																					<td><?php echo number_format($v_inv->subtotal,0,",",".") ?></td>
																					
																					<td><?php echo number_format($v_inv->vcdisc_m,0,",",".") ?></td>
																					<td><?php echo number_format($v_inv->ppn,0,",",".") ?></td>
																					<td style="color:#c70000; font-weight:bold;"><?php echo number_format($v_inv->grand_total,0,",",".") ?></td>
																					<td><?php echo number_format($v_inv->total_dp,0,",",".") ?></td>
																					
																					<!--<td><?php #echo $v_inv->total ?></td>-->
																					
																					<td><?php echo number_format($v_inv->total_noncash,0,",",".") ?></td>
																					<td><?php echo number_format($v_inv->total_cc1,0,",",".") ?></td>
																					<td><?php echo number_format($v_inv->total_cash,0,",",".") ?></td>
																					<!--<td><?php #echo $v_inv->kembalian ?></td>-->
																					 
																						 
																					</td>
																				</tr> 
																				<?php
																					$subtotal += $v_inv->subtotal;
																					$total_dp += $v_inv->total_dp;
																					$vppn += $v_inv->ppn;
																					$vcdisc_m += $v_inv->vcdisc_m;
																					$grand_total += $v_inv->grand_total;
																					$total_noncash += $v_inv->total_noncash;
																					$total_cc1 += $v_inv->total_cc1;
																					$total_cash += $v_inv->total_cash;
																					
																					$i++;
																				}
																				?>
																			</tbody>
																			<tfoot style="position: sticky;bottom: 0" class="thead-light">
																			<!-- <thead> --> 
																				<tr>
																					<th colspan="8">&nbsp;</th>
																					<th align="right">TOTAL : </th>
																					<th scope="col"><?php echo number_format($subtotal,0,",",".") ?></th>
																					
																					<th scope="col"><?php echo number_format($vcdisc_m,0,",",".") ?></th>
																					<th scope="col"><?php echo number_format($vppn,0,",",".") ?></th>
																					<th scope="col" style="color:#c70000;"><?php echo number_format($grand_total,0,",",".") ?></th>
																					<th scope="col"><?php echo number_format($total_dp,0,",",".") ?></th>
																					
																					<!--<th scope="col">Total</th>-->
																					
																					<th scope="col"><?php echo number_format($total_noncash,0,",",".") ?></th>
																					<th scope="col"><?php echo number_format($total_cc1,0,",",".") ?></th>
																					<th scope="col"><?php echo number_format($total_cash,0,",",".") ?></th>
																					
																				</tr>
																			</tfoot>
																		</table>
																	</div>
																	<!--
																	<div class="row">
																		<div class="col-md-6">
																			
																		</div>
																		<div class="col-md-6 text-right"> <?php #echo $pagination ?> </div>
																	</div>
																	-->
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
				data = column === 9 ? data.replace( /[.]/g, '' ) : data;
				data = column === 10 ? data.replace( /[.]/g, '' ) : data;
				data = column === 11 ? data.replace( /[.]/g, '' ) : data;
				data = column === 12 ? data.replace( /[.]/g, '' ) : data;
				data = column === 13 ? data.replace( /[.]/g, '' ) : data;
				data = column === 14 ? data.replace( /[.]/g, '' ) : data;
				data = column === 15 ? data.replace( /[.]/g, '' ) : data;
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
			/*
			{
				extend:'pdfHtml5',
				text:'Export to PDF',
				orientation:'landscape',
				customize : function(doc){
					var colCount = new Array();
					$('#inv_table').find('tbody tr:first-child td').each(function(){
						if($(this).attr('colspan')){
							for(var i=1;i<=$(this).attr('colspan');$i++){
								colCount.push('*');
							}
						}else{ colCount.push('*'); }
					});
					doc.content[1].table.widths = colCount;
				}
			}
			*/
			
        ]
});
</script>

