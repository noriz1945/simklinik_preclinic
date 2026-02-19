
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
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
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('Pembayaran/'); ?>">List Menu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
									
										<div class="container">
									
											<div class="row">
												
												<div class="col-md-6">
													<form class="form-horizontal" action="<?php echo site_url('pembayaran/closing_kasir_act'); ?>" method="post" enctype="multipart/form-data">
														<div class="card">
															<div class="container-fluid">
																<!-- Main content -->

																<div class="card-header">
																	<h5>Form - Closing Kasir</h5>
																</div>
																	<div class="card-block">
																		
																		<!-- TEXT -->
																		<div class="form-group row text-right">
																			<label for="username" class="col-sm-6 col-form-label">Username</label>
																			<div class="col-sm-6">
																				<input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?php echo $this->session->userdata['sp']->login_name; ?>" readonly />
																			</div>
																		</div>
																		<div class="form-group row text-right">
																			<label for="nama" class="col-sm-6 col-form-label">Nama Lengkap</label>
																			<div class="col-sm-6">
																				<input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $this->session->userdata['sp']->name; ?>" readonly />
																			</div>
																		</div>
																		
																		<div class="form-group row text-right">
																			<label for="waktu_opening" class="col-sm-6 col-form-label text-right">Waktu Opening</label>
																			<div class="col-sm-6">
																				<input type="text" class="form-control" id="waktu_opening" name="waktu_opening" value="<?php echo date('Y-m-d H:i') ?>" readonly>
																			</div>
																		</div>
																		
																		<div class="form-group row text-right">
																			<label for="saldo_awal" class="col-sm-6 col-form-label text-right">Saldo Awal (Cash)</label>
																			<div class="col-sm-6">
																				<input type="number" class="form-control text-right" id="saldo_awal" name="saldo_awal" value="0">
																			</div>
																		</div>
																		<hr>
																		
																		<!-- TEXT -->
																		<div class="form-group row text-right">
																			<label for="note_opening" class="col-sm-2 control-label">Note Opening : </label>
																			<div class="col-sm-10">
																				<textarea id="note_opening" name="note_opening" style="width:100%;"  rows="6"></textarea>
																			</div>
																		</div>
																		
																		<!-- TEXT -->
																		<div class="form-group row text-right">
																			<label for="note_closing" class="col-sm-2 control-label">Note Closing : </label>
																			<div class="col-sm-10">
																				<textarea id="note_closing" name="note_closing" style="width:100%;"  rows="6"></textarea>
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
											
												<div class="col-md-6">
													<form class="form-horizontal" action="<?php echo site_url('pembayaran/closing_kasir_act'); ?>" method="post" enctype="multipart/form-data">
														<div class="card">
															<div class="container-fluid">
																<!-- Main content -->

																<div class="card-header">
																	<h5>Form - Closing Kasir</h5>
																</div>
																	<div class="card-block">
																		
																		<!-- TEXT -->
																		<div class="form-group row text-right">
																			<label for="username" class="col-sm-6 col-form-label">Username</label>
																			<div class="col-sm-6">
																				<input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?php echo $this->session->userdata['sp']->login_name; ?>" readonly />
																			</div>
																		</div>
																		<div class="form-group row text-right">
																			<label for="nama" class="col-sm-6 col-form-label">Nama Lengkap</label>
																			<div class="col-sm-6">
																				<input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $this->session->userdata['sp']->name; ?>" readonly />
																			</div>
																		</div>
																		
																		<div class="form-group row text-right">
																			<label for="waktu_opening" class="col-sm-6 col-form-label text-right">Waktu Opening</label>
																			<div class="col-sm-6">
																				<input type="text" class="form-control" id="waktu_opening" name="waktu_opening" value="<?php echo date('Y-m-d H:i') ?>" readonly>
																			</div>
																		</div>
																		
																		<div class="form-group row text-right">
																			<label for="saldo_awal" class="col-sm-6 col-form-label text-right">Saldo Awal (Cash)</label>
																			<div class="col-sm-6">
																				<input type="number" class="form-control text-right" id="saldo_awal" name="saldo_awal" value="0">
																			</div>
																		</div>
																		<hr>
																		
																		<!-- TEXT -->
																		<div class="form-group row text-right">
																			<label for="note_opening" class="col-sm-2 control-label">Note Opening : </label>
																			<div class="col-sm-10">
																				<textarea id="note_opening" name="note_opening" style="width:100%;"  rows="6"></textarea>
																			</div>
																		</div>
																		
																		<!-- TEXT -->
																		<div class="form-group row text-right">
																			<label for="note_closing" class="col-sm-2 control-label">Note Closing : </label>
																			<div class="col-sm-10">
																				<textarea id="note_closing" name="note_closing" style="width:100%;"  rows="6"></textarea>
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
										
										</div>
										
										<div class="row">
                                            
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

</script>