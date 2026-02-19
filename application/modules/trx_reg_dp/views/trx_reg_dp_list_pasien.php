
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
	<style>
	.list_reg {
	  height:100vh;
	  overflow-y: scroll;
	}
	.btn {
		font-size: 12px;
		padding: 6px 14px;
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
                                            <h5>Page Title</h5><span>Menu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('Trx_reg_dp/'); ?>">List Menu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
									
										<div class="col-sm-12">
											<div class="card">
												<div class="card-header">
													<h5>Data Registrasi Pasien</h5>
												</div>
												<div class="card-block">
												
													<div class="row">
													
													<div class="col-sm-2">
													<!-- STATIC CONTROL -->
													<div class="form-group">
														<label class="col-sm-12 control-label">Nama Pasien</label>
														<div class="col-sm-12">
															<p class="form-control-static"><?php echo $data_reg->name; ?></p>
														</div>
													</div>
													</div>
													
													<div class="col-sm-2">
													<!-- STATIC CONTROL -->
													<div class="form-group">
														<label class="col-sm-12 control-label">No. RM</label>
														<div class="col-sm-12">
															<p class="form-control-static"><?php echo $data_reg->id_pasien; ?></p>
														</div>
													</div>
													</div>
													
													<div class="col-sm-2">
													<!-- STATIC CONTROL -->
													<div class="form-group">
														<label class="col-sm-12 control-label">No. Registrasi</label>
														<div class="col-sm-12">
															<p class="form-control-static"><?php echo $data_reg->id_reg; ?></p>
														</div>
													</div>
													</div>
													
													<!-- STATIC CONTROL -->
													<div class="col-sm-2">
													<div class="form-group">
														<label class="col-sm-12 control-label">Waktu Registrasi</label>
														<div class="col-sm-12">
															<p class="form-control-static"><?php echo $data_reg->regdate; ?></p>
														</div>
													</div>
													</div>
													
													
													
													<div class="col-sm-2">
													<!-- STATIC CONTROL -->
													<div class="form-group">
														<label class="col-sm-12 control-label">Asuransi</label>
														<div class="col-sm-12">
															<p class="form-control-static"><?php echo $data_reg->asuransi; ?></p>
														</div>
													</div>
													</div>
													<div class="col-sm-2">
													<!-- STATIC CONTROL -->
													<div class="form-group">
														<label class="col-sm-12 control-label">Dokter</label>
														<div class="col-sm-12">
															<p class="form-control-static"><?php echo $data_reg->dokter; ?></p>
														</div>
													</div>
													</div>
													</div>
												</div>
											</div>
											
					</div>
					
									
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="card">
                                                    <div class="container-fluid">
                                                        <!-- Main content -->
                                                        
                                                                <div class="card-header">
																	<h5>List Deposit</h5>
																</div>
																<div class="card-block">
																	
																	<div class="table-responsive">
																		<table class="table table-bordered table-hover table-striped table-responsive">
																			<thead>
																				<tr>
																					
																					<th scope="col">#</th>
																					<th scope="col">Id Reg</th>
																					<th scope="col">Trxdate</th>
																					<!-- <th scope="col">Id Cctype1</th> -->
																					<th scope="col">Note</th>
																					<th scope="col">Bank EDC</th>
																					<th scope="col">Nomor Kartu</th>
																					<th scope="col">Total<br>Dibayar Kartu</th>
																					<!-- <th scope="col">Id Cctype2</th> -->
																					<!-- <th scope="col">Id Bank2</th> -->
																					<!-- <th scope="col">Nocc2</th> -->
																					<!-- <th scope="col">Total Cc2</th> -->
																					<th scope="col">Cash</th>
																					<th scope="col">Total</th>
																					<!-- <th scope="col">Ret</th> -->
																					<!-- <th scope="col">Id Reg Csr</th> -->
																					<!-- <th scope="col">Id Cfb</th> -->
																					<!-- <th scope="col">Jnl Post</th> -->
																					<th scope="col">Created</th>
																					<th scope="col">Creator</th>
																					<!-- <th scope="col">Updated</th> -->
																					<!-- <th scope="col">Updater</th> -->
																					<th scope="col"></th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$no = 0;
																				$total_dp = 0;
																				foreach ($trx_reg_dp_data as $trx_reg_dp)
																				{
																					$no++;
																				?> 
																				<tr>
																					
																					<td><?php echo $no ?></td>
																					<td><?php echo $trx_reg_dp->id_reg ?></td>
																					<td><?php echo $trx_reg_dp->trxdate ?></td>
																					<!-- <td><?php echo $trx_reg_dp->id_cctype1 ?></td> -->
																					<td><?php echo $trx_reg_dp->note_dp ?></td>
																					<td><?php echo $trx_reg_dp->nama_bank ?></td>
																					<td><?php echo $trx_reg_dp->nocc1 ?></td>
																					<td align="right"><?php echo round($trx_reg_dp->total_cc1) ?></td>
																					<!-- <td><?php echo $trx_reg_dp->id_cctype2 ?></td> -->
																					<!-- <td><?php echo $trx_reg_dp->id_bank2 ?></td> -->
																					<!-- <td><?php echo $trx_reg_dp->nocc2 ?></td> -->
																					<!-- <td><?php echo $trx_reg_dp->total_cc2 ?></td> -->
																					<td align="right"><?php echo round($trx_reg_dp->total_cash) ?></td>
																					<td align="right"><?php echo round($trx_reg_dp->total) ?></td>
																					<!-- <td><?php echo $trx_reg_dp->ret ?></td> -->
																					<!-- <td><?php echo $trx_reg_dp->id_reg_csr ?></td> -->
																					<!-- <td><?php echo $trx_reg_dp->id_cfb ?></td> -->
																					<!-- <td><?php echo $trx_reg_dp->jnl_post ?></td> -->
																					<td><?php echo $trx_reg_dp->created ?></td>
																					<td><?php echo $trx_reg_dp->creator ?></td>
																					<!-- <td><?php echo $trx_reg_dp->updated ?></td> -->
																					<!-- <td><?php echo $trx_reg_dp->updater ?></td> -->
																					<td nowrap> 
																						<?php  
																						#$data_reg->ada_inv = 1;
																						if($data_reg->ada_inv != 1)
																						{
																							echo '<button type="button" class="btn btn-success waves-effect" onClick="javascript : openPopUp(\''. $trx_reg_dp->id_trx .'\');"><i class="fa fa-print"></i></button>'; 
																							#echo anchor(site_url("trx_reg_dp/update/".$trx_reg_dp->id_trx),"<img src=\"".base_url('assets/img/doc_edit.png')."\" style=\"max-height:20px;\">") . " &nbsp; ";
																							#echo anchor(site_url("trx_reg_dp/delete/".$trx_reg_dp->id_trx),"<img src=\"".base_url('assets/img/doc_delete.png')."\" style=\"max-height:20px;\">","onclick=\"javasciprt: return confirm('Yakin hapus ?');\"");
																						}
																						else
																						{
																							echo 'Invoice sudah terbit';
																						}
																						?> 
																					</td>
																				</tr> 
																				<?php
																					$total_dp += $trx_reg_dp->total;
																				}
																				?>
																			</tbody>
																			<tfoot>
																				<tr>
																					<td scope="col" colspan="7" align="right">Total : </td>
																					<th scope="col"><?php echo $total_dp ?></th>
																					<th>
																						<button type="button" class="btn btn-gede btn-success waves-effect btn-grd-success" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i> Refund Deposit </button>
																					</th>
																					<th></th>
																					<th></th>
																				</tr>
																			</tfoot>
																		</table>
																	</div>
																	
																</div>
																
															
															
														<!-- /.content -->
                                                    </div>
                                                </div>
                                            </div>
                                        
											<div class="col-sm-4">
												<form class="form-horizontal" action="<?php echo site_url('trx_reg_dp/create_action'); ?>" method="post" enctype="multipart/form-data">
													<div class="card">
														<div class="container-fluid">
															<!-- Main content -->

															<div class="card-header">
																<h5>Form Tambah - Deposit</h5>
															</div>
																<div class="card-block">
																	
																	<!-- TEXT -->
																	<div class="form-group row text-right">
																		<label for="id_reg" class="col-sm-6 control-label">Id Reg</label>
																		<div class="col-sm-6">
																			<input type="text" class="form-control" name="id_reg" id="id_reg" placeholder="Id Reg" value="<?php echo $id_reg; ?>" readonly />
																		</div>
																	</div>
																	<hr>
																	<div class="form-group row text-right">
																		<label for="id_bank1" class="col-sm-6 col-form-label text-right">Bank EDC </label>
																		<div class="col-sm-6">
																			<?php echo $dropdown_id_bank ?>
																		</div>
																	</div>
																	
																	<div class="form-group row text-right">
																		<label for="nocc1" class="col-sm-6 col-form-label text-right">Nomor Kartu </label>
																		<div class="col-sm-6">
																			<input type="text" class="form-control text-right" id="nocc1" name="nocc1" value="">
																		</div>
																	</div>
																	
																	<div class="form-group row text-right">
																		<label for="total_cc1" class="col-sm-6 col-form-label text-right">Jumlah Dibayar Kartu </label>
																		<div class="col-sm-6">
																			<input type="number" class="form-control text-right" id="total_cc1" name="total_cc1" value="0">
																		</div>
																	</div>
																	<hr>
																	<!-- TEXT -->
																	<div class="form-group row text-right">
																		<label for="total_cash" class="col-sm-6 control-label">Cash</label>
																		<div class="col-sm-6">
																			<input type="number" class="form-control text-right" name="total_cash" id="total_cash" placeholder="Total Cash" value="0" />
																		</div>
																	</div>
																	<hr>
																	<!-- TEXT -->
																	<div class="form-group row text-right">
																		<label for="total" class="col-sm-6 control-label">Total</label>
																		<div class="col-sm-6">
																			<input type="number" class="form-control text-right" name="total" id="total" placeholder="Total" value="0" readonly />
																		</div>
																	</div>
																	
																	<!-- TEXT -->
																	<div class="form-group row text-right">
																		<label for="total" class="col-sm-2 control-label">Note : </label>
																		<div class="col-sm-10">
																			<textarea id="note_dp" name="note_dp" style="width:100%;"  rows="6"></textarea>
																		</div>
																	</div>
																	
																	<!-- BUTTON -->
																	<!-- Standard button -->
																	<div class="form-group row text-right">
																		<div class="col-sm-12">
																			
																			<!-- Provides extra visual weight and identifies the success action in a set of buttons -->
																			<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('pembayaran'); ?>';">Kembali </button> &nbsp; &nbsp; &nbsp; 
																			<button type="submit" class="btn btn-success">Simpan</button>
																		</div>
																	</div>
															   
																</div>
																<!-- /.content -->
																									
														</div>
													</div>
												</form>
                                            </div>
                                        
										</div>
										
										
										
										<div class="row">
                                            
										</div>
										
										
										
										
										
										
										
										
										
                                    </div>
										</div>
                            </div>
                        </div>
					</div>
					<?php $this->theme->wrapper_close('theme_default'); ?>

<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<form id="form_refund_dp" method="post">
		<div class="modal-content">
			<!--
			<div class="modal-header">
				<h4 class="modal-title">Modal title</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			-->
			<div class="modal-body">
				<div class="card">
					<div class="card-header">
						<h5>Refund Deposit</h5>
					</div>
					<div class="card-block">
						<h4 class="sub-title">Masukan refund deposit yang akan ditambahkan</h4>
						
							
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Info Maksimum Refund</label>
								<div class="col-sm-8">
									<input type="number" class="form-control" id="max_total_refund_dp"  name="max_total_refund_dp" value="<?php echo  $total_dp ?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-4 col-form-label">Jumlah Refund</label>
								<div class="col-sm-8">
									<input type="number" class="form-control" id="dp_ret" name="dp_ret" value="0" min="0" max="<?php echo  $total_dp ?>">
								</div>
							</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
			</div>
		</div>
		</form>
	</div>
</div>


<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
<script>
$('#form_refund_dp').on( "submit", function(e) {
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: '<?php echo base_url('trx_reg_dp/refund_dp_act/'.$id_reg); ?>',
		data: $('#form_refund_dp').serialize(),
		success: function(response) {
			openPopUp_deposit(response,'Bukti Refund Deposit',(0));
			$('#form_refund_dp')[0].reset()
			$('#large-Modal').modal('hide');
			
			Swal.fire({
			  title: "OK",
			  text: "Refund Deposit Berhasil",
			  icon: "success",
			  confirmButtonColor: "#3085d6",
			  confirmButtonText: "OK"
			}).then((result) => {
					if (result.isConfirmed) {
						window.location.reload();
					}
				});
			
		},
		error: function() {
			Swal.fire({
			  icon: "error",
			  title: "Oops...",
			  text: "Ada yang salah nih",
			});
		}
	});
	return false;
});
function hitung_ulang()
{
	var total_cc1 = $('#total_cc1').val();
	var total_cash = $('#total_cash').val();
	
	var total = parseInt(total_cc1) + parseInt(total_cash);
	$('#total').val(total);
}
$('#total_cash').on('input',function(e){
	var total_cash = $('#total_cash').val();
	if(total_cash<0)
	{
		$('#total_cash').val(0);
	}
	hitung_ulang();
});
$('#total_cc1').on('input',function(e){
	var total_cc1 = $('#total_cc1').val();
	if(total_cc1<0)
	{
		$('#total_cc1').val(0);
	}
	hitung_ulang();
});

function openPopUp(id_trx) {
	let url = '<?php echo base_url('trx_reg_dp/cetak_invoice_dp_pos/') ?>'+id_trx;
	let height = 600;
	let width = 400;
	var left = ( screen.width - width ) / 2;
	var top = ( screen.height - height ) / 2;
	var newWindow = window.open( url, "Invoice Deposit POS", 'resizable = yes, width=' + width + ', height=' + height + ', top='+ top + ', left=' + left);
}
// ------------ CETAK INVOICE DEPOSIT ----------------------------------------
function openPopUp_deposit(id_trx,title,posisi) {
	let url = '<?php echo base_url('trx_reg_dp/cetak_invoice_dp_pos/') ?>'+id_trx;
	let height = 600;
	let width = 400;
	var left = (( screen.width - width ) / 2) + posisi;
	var top = ( screen.height - height ) / 2;
	var newWindow = window.open( url, title, 'resizable = yes, width=' + width + ', height=' + height + ', top='+ top + ', left=' + left);
}

</script>