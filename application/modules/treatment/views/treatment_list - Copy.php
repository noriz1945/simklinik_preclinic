
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?>
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
	<style>
	.form-group {
		margin-bottom: 1.0em;
	}
	input{
		text-transform: uppercase;
	}
	select.form-control {
		background-color: ghostwhite;
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
                                            <li class="breadcrumb-item"><a href="
											<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="
											<?php echo base_url('trx_reg/'); ?>">Registrasi</a></li>
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
																													
											<div class="col-md-12">
												<form action="<?php echo base_url('treatment/treament_update') ?>" method="post">
													<div class="card" style="min-height : 670px;">
														<div class="card-header">
															<h5>Ceklist treatment yang sudah dilakukan terhadap pasien</h5>
														</div>
														<div class="card-block">
														
															<table class="table table-bordered table-striped">
																<thead>
																	<tr>
																		<th scope="col" style="text-align: center;">#</th>
																		<th scope="col" style="text-align: center;">Item</th>
																		<th scope="col" style="text-align: center;">Jumlah</th>
																		<th scope="col" style="text-align: center;">Pilih<br>(yang sudah dilakukan)</th>
																		<th scope="col" style="text-align: center;">Dilakukan pada kunjungan ke</th>
																		<th scope="col" style="text-align: center;">Nakes<br>Operator</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	#$arr_status = array('Open','Closed');
																	$no = 0;
																	$pre_subtotal = 0;
																	$curr_grup = "";
																	foreach ($data_treatment as $k => $v)
																	{
																		if($curr_grup != $v->grup)
																		{
																			echo '	<tr class="table-info tr_'.$no,'">			
																						<td colspan="6" nowrap=""><span class="row_header_inv">'.$v->grup.'</span></td>		
																					</tr>';
																			$curr_grup = $v->grup;
																		}
																	?> 
																	
																	<tr class="tr_<?php echo $no; ?>">
																		<td><?php echo $no+1; ?></td>
																		<td id="td_name_<?php echo $no; ?>"><?php echo $v->name ?></td>
																		<td id="td_qty_<?php echo $no; ?>" style="text-align: center;"><?php echo $v->qty ?></td>
																		<td nowrap align="center"> 
																			<input type="checkbox" id="chk_id_trx[<?php echo $no ?>]" name="chk_id_trx[]" value="<?php echo $v->id_trx ?>" <?php echo $v->checked_treatment ?> onClick="javascript: return update_treatment('<?php echo $v->id_trx ?>','<?php echo $v->grup ?>');" />
																			<input type="hidden" id="val_id_group[<?php echo $no ?>]" name="val_id_group[]" value="<?php echo $v->id_group ?>" />
																			<input type="hidden" id="val_grup[<?php echo $no ?>]" name="val_grup[]" value="<?php echo $v->grup ?>" />
																		</td>
																		<td>
																			<?php echo $v->dropdown_kunj_ke ?>
																		</td>
																		<td>
																			<div class="row">
																				<div class="col-md-1 text-right">1.</div>
																				<div class="col-md-11">
																					<?php echo $v->dropdown_nakes ?>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-md-1 text-right">2.</div>
																				<div class="col-md-11">
																					<?php echo $v->dropdown_nakes2 ?>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-md-1 text-right">3.</div>
																				<div class="col-md-11">
																					<?php echo $v->dropdown_nakes3 ?>
																				</div>
																			</div>
																		</td>
																	</tr> 
																	<?php
																	#$pre_subtotal += $v->total;
																	$no++;
																	}
																	?>
																</tbody>
																<tfoot>
																	<tr>
																		<td colspan=6>
																			<div class="col-md-12 text-right">
																			<!-- BUTTON -->
																				<!-- Standard button -->
																				<div class="form-group">
																					<div class="col-sm-12">
																						<input type="text" name="id_reg" value="<?php echo $id_reg; ?>" />
																						<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('trx_reg'); ?>';">Kembali </button>
																						<button type="submit" class="btn btn-success">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																					</div>
																				</div>
																			</div>
																		</td>
																	</tr>
																</tfoot>
															</table>
														
														
														</div>
													</div>
													
												</form>
											</div>
											
										</div>
										
                                </div>
                            </div>
                        </div> 
					</div></div>
					<?php $this->theme->wrapper_close('theme_default'); ?>
					
<?php #$this->theme->script('theme_default'); ?> 
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?> 
<script>
function load_treatment()
{
	$.get("<?php echo base_url('trx_reg/inner_load_treatment/'.$id_reg); ?>", function( data ) {
	  $( "#div_treatment" ).html( data );
	});
}
var id_reg = "<?php echo $id_reg; ?>";
if(id_reg!='') load_treatment();

function update_treatment(id_trx,grup)
{
	var ret = true;
	if(grup=='FARMASI')
		reqUrl = '<?php echo base_url('trx_reg/update_treatment/') ?>'+ id_trx + '/FARMASI';
	else
		reqUrl = '<?php echo base_url('trx_reg/update_treatment/') ?>'+ id_trx + '/';
	
	$.ajax({
		//async: false,
		type: "GET",
		url: reqUrl,
		dataType: "text",
		beforeSend: function() {
			swal.fire({
				html: '<h5>Loading...</h5>',
				showConfirmButton: false,
				onRender: function() {
					 // there will only ever be one sweet alert open.
					 $('.swal2-content').prepend(sweet_loader);
				}
			});
		},
		success: function(data, textStatus) {
			Swal.fire({
			  title: "Update treatment berhasil !",
			  text: data,
			  icon: "success"
			});
			ret = true;
		},
		error: function (xhr, ajaxOptions, thrownError) {
			Swal.fire({
			  icon: "Gagal",
			  title: "Oops...",
			  text: "Ada yang salah nih, mungkin anda bisa coba beberapa saat lagi!",
			});
			location.reload(); 
		}
	});
	return ret;
}

</script>