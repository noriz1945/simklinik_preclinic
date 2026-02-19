
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> -->
	<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.css" rel="stylesheet">

	<title>Fastmedik - LYND Clinic</title>
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
                                            <h5>Laporan</h5><span>Laporan penjualan farmasi berdasarkan periode</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('V_inv_farm/'); ?>">Lap. Registrasi (Periodik)</a></li>
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
																	<h5>V_inv_farm</h5>
																</div>
															-->
																<div class="card-block">
																	<div class="row">
																		
																		<div class="col-md-10">
																			
																			<form class="form-inline" action="<?php echo site_url('v_inv_farm/index'); ?>" method="post">
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
																	<div class="table-responsive container-fix">
																		<table id="dt_table" class="table table-bordered table-hover table-stripedx">
																			<thead style="position: sticky;top: 0" class="thead-light">
																			<!-- <thead> --> 
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col">Nama Pasien</th>
																					<th scope="col">No. RM</th>
																					<th scope="col">No. Reg</th>
																					<!-- <th scope="col">Regdate</th> -->
																					<th scope="col">Tgl Reg</th>
																					<th scope="col">Reg/Aps</th>
																					<th scope="col">Asuransi</th>
																					<th scope="col">No. Resep</th>
																					<!-- <th scope="col">Eresepdate</th> -->
																					<th scope="col">Tgl. Eresep</th>
																					<!-- <th scope="col">Id Dokter</th> -->
																					<th scope="col">Dokter</th>
																					<!-- <th scope="col">Id Eresep Det</th> -->
																					<!-- <th scope="col">Id Trx Det</th> -->
																					<th scope="col">Obat/Alkes</th>
																					<!-- <th scope="col">Jenis Obat</th> -->
																					
																					<!-- <th scope="col">Dosis</th> -->
																					<!-- <th scope="col">Frekwensi</th> -->
																					<!-- <th scope="col">Tme</th> -->
																					<th scope="col">Harga Satuan</th>
																					<th scope="col">Qty</th>
																					<th scope="col">Subtotal</th>
																					<!-- <th scope="col">Note</th> -->
																					<!-- <th scope="col">Is Racikan</th> -->
																					<th scope="col">No. Inv</th>
																					<!-- <th scope="col">Status</th> -->
																					<!-- <th scope="col">Is Validasi</th> -->
																					<!-- <th scope="col">Created</th> -->
																					<!-- <th scope="col">Created By</th> -->
																					<!-- <th scope="col">Updated</th> -->
																					<!-- <th scope="col">Updated By</th> -->
																					<!-- <th scope="col">Invdate</th> -->
																					<th scope="col">Tgl. Inv</th>
																					
																					<!-- <th scope="col">Is Reg Aps</th> -->
																					
																					
																					<!-- <th scope="col">Id Asuransi</th> -->
																					
																					<!-- <th scope="col">Id Dokter Prt1</th> -->
																					<!-- <th scope="col">Dokter Prt1</th> -->
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$i=1;
																				$harga_satuan = 0;
																				$subtotal = 0;
																				$curr_id_reg = @$v_inv_farm_data[0]->id_reg;
																				$harga_satuan_reg = 0;
																				$subtotal_reg = 0;
																				foreach ($v_inv_farm_data as $k => $v_inv_farm)
																				{
																				?> 
																				<tr>
																					<td><?php echo $v_inv_farm->nomor ?></td>
																					<td><?php echo $v_inv_farm->nama_pasien ?></td>
																					<td><?php echo $v_inv_farm->id_pasien ?></td>
																					<td><?php echo $v_inv_farm->id_reg_text ?></td>
																					<!-- <td><?php #echo $v_inv_farm->regdate ?></td> -->
																					<td><?php echo $v_inv_farm->tgl_reg ?></td>
																					<td><?php echo $v_inv_farm->reg_text ?></td>
																					<td><?php echo $v_inv_farm->asuransi ?></td>
																					<td><?php echo $v_inv_farm->id_eresep ?></td>
																					<!-- <td><?php #echo $v_inv_farm->eresepdate ?></td> -->
																					<td><?php echo $v_inv_farm->tgl_eresep ?></td>
																					<!-- <td><?php #echo $v_inv_farm->id_dokter ?></td> -->
																					<td><?php echo $v_inv_farm->dokter ?></td>
																					<!-- <td><?php #echo $v_inv_farm->id_eresep_det ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->id_trx_det ?></td> -->
																					<td><?php echo $v_inv_farm->name ?></td>
																					<!-- <td><?php #echo $v_inv_farm->jenis_obat ?></td> -->
																					
																					<!-- <td><?php #echo $v_inv_farm->dosis ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->frekwensi ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->tme ?></td> -->
																					<td align="right"><?php echo number_format($v_inv_farm->harga_satuan,0,",",".") ?></td>
																					<td align="center"><?php echo $v_inv_farm->qty ?></td>
																					<td align="right"><?php echo number_format($v_inv_farm->subtotal,0,",",".") ?></td>
																					<!-- <td><?php #echo $v_inv_farm->note ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->is_racikan ?></td> -->
																					<td><?php echo $v_inv_farm->id_inv ?></td>
																					<!-- <td><?php #echo $v_inv_farm->status ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->is_validasi ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->created ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->created_by ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->updated ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->updated_by ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->invdate ?></td> -->
																					<td><?php echo $v_inv_farm->tgl_inv ?></td>
																					
																					<!-- <td><?php #echo $v_inv_farm->is_reg_aps ?></td> -->
																					
																					
																					<!-- <td><?php #echo $v_inv_farm->id_asuransi ?></td> -->
																					
																					<!-- <td><?php #echo $v_inv_farm->id_dokter_prt1 ?></td> -->
																					<!-- <td><?php #echo $v_inv_farm->dokter_prt1 ?></td> -->
																				</tr> 
																				<?php
																					$harga_satuan_reg 	+= $v_inv_farm->harga_satuan;
																					$subtotal_reg 		+= $v_inv_farm->subtotal;
																					if($curr_id_reg != @$v_inv_farm_data[$k+1]->id_reg || empty($v_inv_farm_data[$k+1]->id_reg))
																					{
																						$cetak_subtotal_reg = '
																												<tr style="background-color:#f2f7f7">
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
																													<!-- <td>'. number_format($harga_satuan_reg,0,",",".") .'</td> -->
																													<td></td>
																													<td></td>
																													<td align="right" style="font-weight: bold;font-style: italic;">'.number_format($subtotal_reg,0,",",".").'</td>
																													<td></td>
																													<td></td>
																												</tr>
																												';
																						echo $cetak_subtotal_reg;
																						
																						$harga_satuan_reg 	= 0;
																						$subtotal_reg 		= 0;
																						
																						$curr_id_reg = @$v_inv_farm_data[$k+1]->id_reg;
																						$i++;
																					}
																				
																					$subtotal += $v_inv_farm->subtotal;
																					$harga_satuan += $v_inv_farm->harga_satuan;
																					
																					
																				}
																				?>
																			</tbody>
																			<tfoot style="position: sticky;bottom: 0" class="thead-light">
																				<tr>
																					<th colspan="10">&nbsp;</th>
																					<th align="right">TOTAL : </th>
																					<th scope="col"><?php #echo number_format($harga_satuan,0,",",".") ?></th>
																					<th scope="col"></th>
																					<th scope="col"><?php echo number_format($subtotal,0,",",".") ?></th>
																					<th scope="col"></th>
																					<th scope="col"></th>
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
				data = column === 11 ? data.replace( '.', '' ) : data;
				//data = column === 12 ? data.replace( '.', '' ) : data;
				data = column === 13 ? data.replace( '.', '' ) : data;
				return data;
			}
		}
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
                extend: 'excel',text:'Export to Excel'
            }),
        ]
});
</script>

