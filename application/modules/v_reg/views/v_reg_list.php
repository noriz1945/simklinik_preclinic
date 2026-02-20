
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
                                            <h5>Laporan</h5><span>Laporan Registrasi berdasarkan periode</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('V_reg/'); ?>">Lap. Registrasi (Periodik)</a></li>
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
																	<h5>V_reg</h5>
																</div>
															-->
																<div class="card-block">
																	<div class="row">
																		
																		<div class="col-md-10">
                                                                            
                                                                            <form class="form-inline" action="<?php echo site_url('v_reg/index'); ?>" method="post">
                                                                            
                                                                                <!-- ================= DARI ================= -->
                                                                                <div class="form-group mb-2">
                                                                                    <label for="periode_start" class="sr-only">Dari</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="periode_start"
                                                                                           name="periode_start"
                                                                                           placeholder="Dari"
                                                                                           value="<?php echo $periode_start; ?>">
                                                                                </div>
                                                                            
                                                                                <!-- ================= SAMPAI ================= -->
                                                                                <div class="form-group mx-sm-3 mb-2">
                                                                                    <label for="periode_end" class="sr-only">Sampai</label>
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="periode_end"
                                                                                           name="periode_end"
                                                                                           placeholder="Sampai"
                                                                                           value="<?php echo $periode_end; ?>">
                                                                                </div>
                                                                            
                                                                                <!-- ================= DOKTER ================= -->
                                                                                <?php
                                                                                // GANTI option kosong bawaan formgenerator
                                                                                $dropdown_clean = preg_replace(
                                                                                    '/<option value="">\s*<\/option>/i',
                                                                                    '<option value="">Semua Dokter</option>',
                                                                                    $dropdown_id_dokter
                                                                                );
                                                                                ?>
                                                                                
                                                                                <div class="form-group mx-sm-3 mb-2">
                                                                                    <label for="id_dokter" class="sr-only">Dokter</label>
                                                                                    <?php echo $dropdown_clean; ?>
                                                                                </div>

                                                                            
                                                                                <!-- ================= SUBMIT ================= -->
                                                                                <button type="submit" class="btn btn-success mb-2">
                                                                                    <i class="fa fa-search"></i> Tampilkan
                                                                                </button>
                                                                            
                                                                            </form>
                                                                            
                                                                            </div>

																		<div class="col-md-2 text-right">
																			<h4 style="margin-top:1px;">Jumlah Registrasi : <?php echo $num_rows; ?></h4>
																		</div>
																	</div>
																	<div class="table-responsive container-fix">
																		<table id="dt_table" class="table table-bordered table-hover table-striped">
																			<thead style="position: sticky;top: 0" class="thead-light">
																			<!-- <thead> --> 
																				<tr>
																					<th scope="col">#</th>
																					
																					<th scope="col">Waktu Reg</th>
																					<th scope="col">No. Reg</th>
																					<th scope="col">No. RM</th>
																					<!--<th scope="col">Is Reg Aps</th>-->
																					<th scope="col">Nama Pasien</th>
																					<!--<th scope="col">Id Asuransi</th>-->
																					<th scope="col">Asuransi</th>
																					<!--<th scope="col">Id Dokter Prt1</th>-->
																					<th scope="col">Dokter</th>
																					
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$i=1;
																				foreach ($v_reg_data as $v_reg)
																				{
																				?> 
																				<tr>
																					<td><?php echo $i ?></td>
																					<td><?php echo $v_reg->regdate ?></td>
																					<td><?php echo $v_reg->id_reg ?></td>
																					<td><?php echo $v_reg->id_pasien ?></td>
																					<!--<td><?php #echo $v_reg->is_reg_aps ?></td>-->
																					<td><?php echo $v_reg->nama_pasien ?></td>
																					<!--<td><?php #echo $v_reg->id_asuransi ?></td>-->
																					<td><?php echo $v_reg->asuransi ?></td>
																					<!--<td><?php #echo $v_reg->id_dokter_prt1 ?></td>-->
																					<td><?php echo $v_reg->dokter ?></td>
																						 
																					</td>
																				</tr> 
																				<?php
																					$i++;
																				}
																				?>
																			</tbody>
																			<!--
																			<tfoot style="position: sticky;bottom: 0" class="thead-light">
																				<tr>
																					<th colspan="7">&nbsp;</th>
																				</tr>
																			</tfoot>
																			-->
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
	
new DataTable('#dt_table',{
	"pageLength": 50,
	searching: false, paging: false, info: false,"ordering": false,
	
	fixedHeader: true,
	fixedColumns: true,
	dom: 'Bfrtip',
        buttons: [
            //'copy', 'csv', 'excel', 'pdf', 'print',
			{extend:'print',text:'Print'},
			{extend:'excel',text:'Export to Excel'},
        ]
});
</script>

