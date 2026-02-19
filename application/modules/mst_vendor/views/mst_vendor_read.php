
<!doctype html>
<html>
    <head> <?php $this->theme->head('theme_default'); ?>
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
																		<label class="col-sm-4 control-label">Vendor</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $vendor; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Alamat</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $alamat; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Nama Kontak</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $nama_kontak; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">No Telp</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $no_telp; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">No Hp Wa</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $no_hp_wa; ?></p>
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
																		<label class="col-sm-4 control-label">Created</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $created; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Updater</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $updater; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Updated</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $updated; ?></p>
																		</div>
																	</div>
																	
                                                                    <!-- BUTTON -->
                                                                    <!-- Standard button -->
                                                                    <div class="form-group">
                                                                        <div class="col-sm-2 col-sm-offset-5">
                                                                            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                                                            <!--<button type="button" class="btn btn-primary">Simpan</button>-->
                                                                            <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_vendor'); ?>';">Kembali </button>
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
