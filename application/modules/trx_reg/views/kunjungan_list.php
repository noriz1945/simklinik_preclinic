
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?>
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datetimepicker-master/jquery.datetimepicker.css') ?>"/>
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
										
										
										
										
										<div class="row">
											
											<div class="col-sm-3">
												<div class="card" style="min-height:500px;">
													<div class="card-header">
														<h5>Data Registrasi Pasien</h5>
													</div>
													<div class="card-block">
													
														
														
														<div class="col-sm-12">
														<!-- STATIC CONTROL -->
														<div class="form-group">
															<label class="col-sm-12 control-label">Nama Pasien</label>
															<div class="col-sm-12">
																<p class="form-control-static"><?php echo $data_reg->name; ?></p>
															</div>
														</div>
														</div>
														
														<div class="col-sm-12">
														<!-- STATIC CONTROL -->
														<div class="form-group">
															<label class="col-sm-12 control-label">No. RM</label>
															<div class="col-sm-12">
																<p class="form-control-static"><?php echo $data_reg->id_pasien; ?></p>
															</div>
														</div>
														</div>
														
														<div class="col-sm-12">
														<!-- STATIC CONTROL -->
														<div class="form-group">
															<label class="col-sm-12 control-label">No. Registrasi</label>
															<div class="col-sm-12">
																<p class="form-control-static"><?php echo $data_reg->id_reg; ?></p>
															</div>
														</div>
														</div>
														
														<!-- STATIC CONTROL -->
														<div class="col-sm-12">
														<div class="form-group">
															<label class="col-sm-12 control-label">Waktu Registrasi</label>
															<div class="col-sm-12">
																<p class="form-control-static"><?php echo $data_reg->regdate; ?></p>
															</div>
														</div>
														</div>
														
														
														
														<div class="col-sm-12">
														<!-- STATIC CONTROL -->
														<div class="form-group">
															<label class="col-sm-12 control-label">Asuransi</label>
															<div class="col-sm-12">
																<p class="form-control-static"><?php echo $data_reg->asuransi; ?></p>
															</div>
														</div>
														</div>
														<div class="col-sm-12">
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
						
										
											<div class="col-md-9">
												<form action="<?php echo base_url('trx_reg/kunjungan_update') ?>" method="post">
													<div class="card" style="min-height:500px;">
														<div class="card-header">
															<h5>Update waktu kunjungan pasien</h5>
														</div>
														<div class="card-block">
														
															<table class="table table-bordered table-striped">
																<thead>
																	<tr>
																		<th scope="col" style="text-align: center;">#</th>
																		<th scope="col" style="text-align: center;">Kunjungan ke</th>
																		<th scope="col" style="text-align: center;">Waktu Kunjungan</th>
																		<th scope="col" style="text-align: center;">Update Waktu Kunjungan</th>
																		<th scope="col" style="text-align: center;">Updater</th>
																		<th scope="col" style="text-align: center;">Updated</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	#$arr_status = array('Open','Closed');
																	$no = 0;
																	$pre_subtotal = 0;
																	$curr_grup = "";
																	foreach ($data_kunj as $k => $v)
																	{
																	?> 
																	
																	<tr class="tr_<?php echo $no; ?>">
																		<td><?php echo $no+1; ?></td>
																		<td align="center">
																			<input type="hidden" id="id_kunj_<?php echo $k ?>" name="id_kunj[<?php echo $k ?>]" value="<?php echo $v->id_kunj ?>">
																			<?php echo $v->kunj_ke ?>
																		</td>
																		<td align="center">
																			<?php echo $v->kunjdate ?>
																		</td>
																		<td align="center">
																			<input type="text" class="form-control kunjdate text-center" id="kunjdate_<?php echo $k ?>" name="kunjdate[<?php echo $k ?>]" value="<?php echo $v->kunjdate ?>">
																		</td>
																		<td align="center">
																			<?php echo $v->updater ?>
																		</td>
																		<td align="center">
																			<?php echo $v->updated ?>
																		</td>
																	</tr> 
																	<?php
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
																						<input type="hidden" name="id_reg" value="<?php echo $id_reg; ?>" />
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
<script src="<?php echo base_url('assets/datetimepicker-master/jquery.datetimepicker.full.js') ?>"></script>
<script>
$('.kunjdate').datetimepicker({
	format: 'Y-m-d H:i',
	step: 30,
	maxDate: 0,
});
/*
$('#kunjdate_0').datetimepicker();
$('#kunjdate_0').datetimepicker({value:'2015/04/15 05:06'});
*/
</script>
