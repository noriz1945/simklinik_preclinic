
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<style>
	/*
	.bg-success {
		background: #00ced1 !important;
	}
	*/
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
                                            <h5>Page Title</h5><span>Menu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('pembayaran/'); ?>">List Menu</a></li>
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
                                                        <div class="" style="">
                                                            <div class="col-md-12 box-shadow--16dp" style="margin-top:30px;">
                                                                <div class="card-header">
																	<h5>List Closing Kasir  </h5>
																</div>
																<div class="card-block">
																	<div class="row">
																		
																		<div class="col-md-9">
																			
																			<form class="form-inline" action="<?php echo site_url('pembayaran/list_closing_kasir'); ?>" method="post">
																				<div class="form-group mb-2">
																					<label for="periode_start" class="sr-only">Dari</label>
																					<input type="text" class="form-control" id="periode_start" name="periode_start" placeholder="Dari" value="<?php echo $periode_start?>">
																				</div>
																				<div class="form-group mx-sm-2 mb-2">
																					<label for="periode_end" class="sr-only">Sampai</label>
																					<input type="text" class="form-control" id="periode_end" name="periode_end" placeholder="Sampai" value="<?php echo $periode_end?>">
																				</div>
																				<!--
																				<div class="form-group mx-sm-3 mb-2">
																					<?php #echo $dropdown_id_jenis_nakes ?>
																				</div>
																				-->
																				<!--
																				<div class="form-group mx-sm-3 mb-2">
																					<?php #echo $dropdown_id_nakes ?>
																				</div>
																				-->
																				<button type="submit" class="btn btn-success mb-2">Tampilkan</button>
																			</form>
																			
																		</div>
																		
																	</div>
																	<div class="table-responsive">
																		<table class="table table-bordered table-hover table-striped table-responsive">
																			<thead>
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col">Id Opening</th>
																					<th scope="col">Id Login</th>
																					<th scope="col">Nama Kasir</th>
																					<th scope="col">Waktu Opening </th>
																					<th scope="col">Waktu Closing </th>
																					<th scope="col">Saldo Awal </th>
																					<th scope="col">Total Tunai </th>
																					<th scope="col">Total Debit/Kredit/Qris</th>
																					<th scope="col">Total Dijamin Asuransi </th>
																					<th scope="col">Note Opening </th>
																					<th scope="col">Note Closing </th>
																					<th scope="col">Status / Fungsi</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$no=1;
																				foreach ($data_closing as $v)
																				{
																				?> 
																				<tr>
																					<td><?php echo $no ?></td>
																					<td><?php echo $v->id_opening ?></td>
																					<td><?php echo $v->username ?></td>
																					<td><?php echo $v->name ?></td>
																					<td><?php echo $v->opening_time ?></td>
																					<td><?php echo $v->closing_time ?></td>
																					<td><?php echo $v->saldo_awal ?></td>
																					<td><?php echo $v->total_cash ?></td>
																					<td><?php echo $v->total_non_cash ?></td>
																					<td><?php echo $v->total_asuransi ?></td>
																					<td><?php echo nl2br($v->note_opening) ?></td>
																					<td><?php echo nl2br($v->note_closing) ?></td>
																					
																					<td nowrap> 
																						<?php 
																							if($v->closing_time=='')
																							{
																								echo '<span class="badge badge-success">&nbsp;&nbsp;&nbsp;OPEN&nbsp;&nbsp;&nbsp;</span>';
																							}
																							else
																							{
																								echo '<span class="badge badge-warning">CLOSED</span>';
																						?>
																						<button type="button" class="btn btn-warning waves-effect" onclick="javascript : openPopUp_print_closing('<?php echo $v->id_opening ?>');"><i class="fa fa-print"></i></button>
																						<!--
																						<button type="button" class="btn btn-success waves-effect" onclick="javascript : openPopUp_export_xlsx_closing('<?php #echo $v->id_opening ?>');"><i class="fa fa-file-excel-o"></i></button>
																						-->
																						<?php 
																							} 
																						?>
																					</td>
																				</tr> 
																				<?php
																					$no++;
																				}
																				?>
																			</tbody>
																			<tfoot>
																				<tr>
																					
																				</tr>
																			</tfoot>
																		</table>	
																	</div>
																	
																	
																</div>
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

<script>
//var baseUrl = '/fastclinic_binamedika/';
function openPopUp(url) {
	let height = 900;
	let width = 1300;
	var left = ( screen.width - width ) / 2;
	var top = ( screen.height - height ) / 2;
	var newWindow = window.open( url, "Lembar Closing Kasir", 'resizable = yes, width=' + width + ', height=' + height + ', top='+ top + ', left=' + left);
}
function openPopUp_print_closing(id_opening) {
	let url = '<?php echo base_url('pembayaran/print_closing_kasir/') ?>'+id_opening;	
	openPopUp(url);
}
function openPopUp_export_xlsx_closing(id_opening) {
	let url = '<?php echo base_url('pembayaran/closing_export_xlsx/') ?>'+id_opening;	
	openPopUp(url);
}


var id_opening_auto_print = '<?php echo $auto_print_id_opening ?>';
if(id_opening_auto_print!='') openPopUp_print_closing(id_opening_auto_print);

//openPopUp('1123IV00008');

</script>