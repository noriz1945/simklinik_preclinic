
<!doctype html>
<html>
    <head> <?php $this->theme->head('theme_default'); ?>
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
    </head>
    </head> <?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
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
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('Trx_reg/'); ?>">List Menu</a></li>
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
                                                        <div class="container" style="margin-top:20px;">
                                                            <div class="col-md-6 offset-md-3 card z-depth-5">
																<div class="card-header">
																	<h5>Trx_reg</h5>
																</div>
																<div class="card-block">
                                                                <form class="form-horizontal">
                                                                    
																	
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Pasien</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_pasien; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Reg</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_reg; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Trxdate</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $trxdate; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Cctype1</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_cctype1; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Bank1</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_bank1; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Nocc1</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $nocc1; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Total Cc1</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $total_cc1; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Cctype2</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_cctype2; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Bank2</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_bank2; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Nocc2</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $nocc2; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Total Cc2</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $total_cc2; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Total Cash</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $total_cash; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Total</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $total; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Ret</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $ret; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Reg Csr</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_reg_csr; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Cfb</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_cfb; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Jnl Post</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $jnl_post; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Created</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $created; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Creator</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $creator; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Updated</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $updated; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Updater</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $updater; ?></p>
																		</div>
																	</div>
																	
                                                                    <!-- BUTTON -->
                                                                    <!-- Standard button -->
                                                                    <div class="form-group">
                                                                        <div class="col-sm-2 col-sm-offset-5">
                                                                            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                                                            <!--<button type="button" class="btn btn-primary">Simpan</button>-->
                                                                            <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('trx_reg_dp'); ?>';">Kembali </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
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
