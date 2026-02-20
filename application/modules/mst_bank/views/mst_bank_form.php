
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?></head> 
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
											<?php echo base_url('Mst_bank/'); ?>">List Menu</a></li>
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
															<h5>Form Tambah / Edit - Mst_bank</h5>
														</div>
														<div class="card-block">
														
														<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                                                            
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="nama_bank" class="col-sm-4 control-label">Nama Bank</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="Nama Bank" value="<?php echo $nama_bank; ?>" />
																</div>
															</div>
															
															<!-- RADIO -->
															<div class="form-group">
																<label class="col-sm-4 control-label">Is Kartu Debit Kredit</label>
																<div class="col-sm-12">
																	{radio-is_kartu_debit_kredit}
																</div>
															</div>
															
															<!-- RADIO -->
															<div class="form-group">
																<label class="col-sm-4 control-label">Is Aktif</label>
																<div class="col-sm-12">
																	{radio-is_aktif}
																</div>
															</div>
															
															<!--
															<div class="form-group">
																<label for="creator" class="col-sm-4 control-label">Creator</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="creator" id="creator" placeholder="Creator" value="<?php echo $creator; ?>" />
																</div>
															</div>
															
															
															<div class="form-group">
																<label for="created" class="col-sm-4 control-label">Created</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="created" id="created" placeholder="Created" value="<?php echo $created; ?>" />
																</div>
															</div>
															
															
															<div class="form-group">
																<label for="updater" class="col-sm-4 control-label">Updater</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="updater" id="updater" placeholder="Updater" value="<?php echo $updater; ?>" />
																</div>
															</div>
															
															
															<div class="form-group">
																<label for="updated" class="col-sm-4 control-label">Updated</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="updated" id="updated" placeholder="Updated" value="<?php echo $updated; ?>" />
																</div>
															</div>
															-->
															
                                                            <!-- BUTTON -->
                                                            <!-- Standard button -->
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <input type="hidden" name="id_bank" value="<?php echo $id_bank; ?>" />
                                                                    <!-- Provides extra visual weight and identifies the success action in a set of buttons -->
                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                    <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_bank'); ?>';">Kembali </button>
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



