
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> -->
	<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.css" rel="stylesheet">

	<title>Fast Clinic - Bina Medika</title>
	<style>
	
	.header { 
            position: sticky; 
            top:0; 
    } 
	.container-fix { 
		/* width: 600px; */ 
		height: 56vh; 
		overflow: auto; 
	} 
	h1{ 
		color: green; 
	} 
	
	.btn {
		padding: 4px 14px;
	}
	table.dataTable tfoot th, table.dataTable tfoot td {
		text-align: right;
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
                                            <h5>Laporan</h5><span>Pembagian jasa tindakan berdasarkan periode</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('V_jasmed/'); ?>">Jasa Medis (Periodik)</a></li>
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
																	<h5>V_jasmed</h5>
																</div>
															-->
																<div class="card-block">
																	<div class="row">
																		
																		<div class="col-md-10">
																			
																			<form class="form-inline" action="<?php echo site_url('v_jasmed/show_all'); ?>" method="post">
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
																		<div class="col-md-2 text-right">
																			<h4 style="margin-top:1px;">Jumlah Data : <?php echo $num_rows; ?></h4>
																		</div>
																	</div>
																	<form id="frm_all_jasmed">
																		
																		<div class="table-responsive container-fix">
																			<table id="dt_table" class="table table-bordered table-hover table-stripedx">
																				<thead style="position: sticky;top: 0" class="thead-light">
																				<!-- <thead> --> 
																					<tr>
																						<th scope="col">Jenis Nakes</th>
																						<th scope="col">Nakes</th>
																						<th scope="col">Id Pasien</th>
																						<th scope="col">Id Reg</th>
																						<th scope="col">Pasien</th>
																						<th scope="col">Asuransi</th>
																						<th scope="col">Id Inv</th>
																						<th scope="col">Invdate</th>
																						<th scope="col">Grup Tindakan /<br>Sub Grup Tindakan</th>
																						<th scope="col">Name</th>
																						<th scope="col">Tarif Satuan</th>
																						<th scope="col">Qty</th>
																						<th scope="col">Tarif</th>
																						<th scope="col">Share Vendor</th>
																						<th scope="col">Share Nakes</th>
																						<th scope="col">Share Rs</th>
																					</tr>
																				</thead>
																				<tbody>
																					<?php
																					$i=1;
																					$tarif = 0;
																					$share_vendor = 0;
																					$share_nakes = 0;
																					$share_rs = 0;
																					
																					$subtotal_tarif = 0;
																					$subtotal_share_vendor = 0;
																					$subtotal_share_nakes = 0;
																					$subtotal_share_rs = 0;
																					
																					$curr_id_inv = @$v_jasmed_data[0]->id_inv;
																					foreach ($v_jasmed_data as $k => $v_jasmed)
																					{
																					?> 
																					<tr>
																						<td><?php echo $v_jasmed->jenis_nakes ?></td>
																						<td><?php echo $v_jasmed->nakes ?></td>
																						<td><?php echo $v_jasmed->id_pasien ?></td>
																						<td><?php echo $v_jasmed->id_reg_text ?></td>
																						<td><?php echo $v_jasmed->pasien ?></td>
																						<td><?php echo $v_jasmed->asuransi ?></td>
																						<td><?php echo $v_jasmed->id_inv_text ?></td>
																						<td><?php echo $v_jasmed->tgl_inv ?></td>
																						<td><?php echo $v_jasmed->grup_tindakn ?>/ <br><?php echo $v_jasmed->sub_grup_tindakan ?></td>
																						<td><?php echo $v_jasmed->name ?></td>
																						<td><?php echo number_format($v_jasmed->tarif_satuan,0,",",".") ?></td>
																						<td><?php echo $v_jasmed->qty ?></td>
																						<td><?php echo number_format($v_jasmed->tarif,0,",",".") ?></td>
																						<td><?php echo number_format($v_jasmed->share_vendor,0,",",".") ?></td>
																						<td><?php echo number_format($v_jasmed->share_nakes,0,",",".") ?></td>
																						<td><?php echo number_format($v_jasmed->share_rs,0,",",".") ?></td>
																					</tr> 
																					<?php
																						$tarif 					+= $v_jasmed->tarif;
																						$share_vendor 			+= $v_jasmed->share_vendor;
																						$share_nakes 			+= $v_jasmed->share_nakes;
																						$share_rs 				+= $v_jasmed->share_rs;
																						
																						$subtotal_tarif 		+= $v_jasmed->tarif;
																						$subtotal_share_vendor 	+= $v_jasmed->share_vendor;
																						$subtotal_share_nakes 	+= $v_jasmed->share_nakes;
																						$subtotal_share_rs 		+= $v_jasmed->share_rs;
																						
																						if($curr_id_inv != @$v_jasmed_data[$k+1]->id_inv || empty($v_jasmed_data[$k+1]->id_inv))
																						{
																							$cetak_subtotal_nakes = '
																													<tr class="dnr" style="background-color:#f2f7f7">
																														<td></td>
																														<td></td>
																														<td></td>
																														<td></td>
																														<td></td>
																														<td></td>
																														<td></td>
																														<td></td>
																														<td></td>
																														<td></td>
																														<td align="right" style="font-weight: bold;font-style: italic;">Sub Total : </td>
																														<td></td>
																														<td align="right" style="font-weight: bold;font-style: italic;">'.number_format($subtotal_tarif,0,",",".").'</td>
																														<td align="right" style="font-weight: bold;font-style: italic;">'.number_format($subtotal_share_vendor,0,",",".").'</td>
																														<td align="right" style="font-weight: bold;font-style: italic;">'.number_format($subtotal_share_nakes,0,",",".").'</td>
																														<td align="right" style="font-weight: bold;font-style: italic;">'.number_format($subtotal_share_rs,0,",",".").'</td>
																													</tr>
																													';
																							echo $cetak_subtotal_nakes;
																							
																							$subtotal_tarif 		= 0;
																							$subtotal_share_vendor 	= 0;
																							$subtotal_share_nakes 	= 0;
																							$subtotal_share_rs 		= 0;
																							
																							$curr_id_inv = @$v_jasmed_data[$k+1]->id_inv;
																							$i++;
																						}
																					}
																					?>
																				</tbody>
																				<tfoot style="position: sticky;bottom: 0" class="thead-light">
																					<tr>
																						<th scope="col" colspan="10"></th>
																						<th scope="col" style="font-weight: bold;font-style: italic;">TOTAL : </th>
																						<th scope="col"></th>
																						<th scope="col"><?php echo number_format($tarif,0,",",".") ?></th>
																						<th scope="col"><?php echo number_format($share_vendor,0,",",".") ?></th>
																						<th scope="col"><?php echo number_format($share_nakes,0,",",".") ?></th>
																						<th scope="col"><?php echo number_format($share_rs,0,",",".") ?></th>
																					</tr>
																				</tfoot>
																			</table>
																		</div>
																		
																		<div class="row">
																			<div class="col-sm-12 text-right">
																			</div>
																		</div>
																	</form>
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
			body: function ( data, rowIdx, column, node ) {
				data = column === 10 ? data.replace( /[.]/g, '' ) : data;
				//data = column === 11 ? data.replace( /[.]/g, '' ) : data;
				data = column === 12 ? data.replace( /[.]/g, '' ) : data;
				data = column === 13 ? data.replace( /[.]/g, '' ) : data;
				data = column === 14 ? data.replace( /[.]/g, '' ) : data;
				data = column === 15 ? data.replace( /[.]/g, '' ) : data;
				
				data = data.replace(/<br\s*\/?>/ig, "\r\n");
				return data;
			},
			footer: function ( data, rowIdx, column, node ) {
				data = data.replace( /[.]/g, '' );
				return data;
			}
		},
		rows: ":not('.dnr')"
	}
};	

new DataTable('#dt_table',{
	"pageLength": 50,
	searching: false, paging: false, info: false,"ordering": false,
	
	fixedHeader: true,
	fixedColumns: true,
	dom: 'Bfrtip',
	buttons: [
		//'copy', 'csv', 'excel', 'pdf', 'print',
		{extend:'print',text:'Print'},
		$.extend( true, {}, buttonCommon, {
			extend: 'excel',text:'Export to Excel',footer: true,
		}),
	]
});
</script>

