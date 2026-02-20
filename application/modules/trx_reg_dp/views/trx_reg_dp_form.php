
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?></head> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
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
											<?php echo base_url('Trx_reg_dp/'); ?>">List Menu</a></li>
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
															<h5>Form Tambah / Edit - Trx_reg_dp</h5>
														</div>
														<div class="card-block">
														
														<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                                                            
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_pasien" class="col-sm-4 control-label">Id Pasien</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_pasien" id="id_pasien" placeholder="Id Pasien" value="<?php echo $id_pasien; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_reg" class="col-sm-4 control-label">Id Reg</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_reg" id="id_reg" placeholder="Id Reg" value="<?php echo $id_reg; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="trxdate" class="col-sm-4 control-label">Trxdate</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="trxdate" id="trxdate" placeholder="Trxdate" value="<?php echo $trxdate; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_cctype1" class="col-sm-4 control-label">Id Cctype1</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_cctype1" id="id_cctype1" placeholder="Id Cctype1" value="<?php echo $id_cctype1; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_bank1" class="col-sm-4 control-label">Id Bank1</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_bank1" id="id_bank1" placeholder="Id Bank1" value="<?php echo $id_bank1; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="nocc1" class="col-sm-4 control-label">Nocc1</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="nocc1" id="nocc1" placeholder="Nocc1" value="<?php echo $nocc1; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="total_cc1" class="col-sm-4 control-label">Total Cc1</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="total_cc1" id="total_cc1" placeholder="Total Cc1" value="<?php echo $total_cc1; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_cctype2" class="col-sm-4 control-label">Id Cctype2</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_cctype2" id="id_cctype2" placeholder="Id Cctype2" value="<?php echo $id_cctype2; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_bank2" class="col-sm-4 control-label">Id Bank2</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_bank2" id="id_bank2" placeholder="Id Bank2" value="<?php echo $id_bank2; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="nocc2" class="col-sm-4 control-label">Nocc2</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="nocc2" id="nocc2" placeholder="Nocc2" value="<?php echo $nocc2; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="total_cc2" class="col-sm-4 control-label">Total Cc2</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="total_cc2" id="total_cc2" placeholder="Total Cc2" value="<?php echo $total_cc2; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="total_cash" class="col-sm-4 control-label">Total Cash</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="total_cash" id="total_cash" placeholder="Total Cash" value="<?php echo $total_cash; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="total" class="col-sm-4 control-label">Total</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="ret" class="col-sm-4 control-label">Ret</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="ret" id="ret" placeholder="Ret" value="<?php echo $ret; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_reg_csr" class="col-sm-4 control-label">Id Reg Csr</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_reg_csr" id="id_reg_csr" placeholder="Id Reg Csr" value="<?php echo $id_reg_csr; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_cfb" class="col-sm-4 control-label">Id Cfb</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_cfb" id="id_cfb" placeholder="Id Cfb" value="<?php echo $id_cfb; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="jnl_post" class="col-sm-4 control-label">Jnl Post</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="jnl_post" id="jnl_post" placeholder="Jnl Post" value="<?php echo $jnl_post; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="created" class="col-sm-4 control-label">Created</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="created" id="created" placeholder="Created" value="<?php echo $created; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="creator" class="col-sm-4 control-label">Creator</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="creator" id="creator" placeholder="Creator" value="<?php echo $creator; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="updated" class="col-sm-4 control-label">Updated</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="updated" id="updated" placeholder="Updated" value="<?php echo $updated; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="updater" class="col-sm-4 control-label">Updater</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="updater" id="updater" placeholder="Updater" value="<?php echo $updater; ?>" />
																</div>
															</div>
															
															
                                                            <!-- BUTTON -->
                                                            <!-- Standard button -->
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <input type="hidden" name="id_trx" value="<?php echo $id_trx; ?>" />
                                                                    <!-- Provides extra visual weight and identifies the success action in a set of buttons -->
                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                    <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('trx_reg_dp'); ?>';">Kembali </button>
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
					</div></div>
					<?php $this->theme->wrapper_close('theme_default'); ?>
					
<?php #$this->theme->script('theme_default'); ?> 
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?> 



